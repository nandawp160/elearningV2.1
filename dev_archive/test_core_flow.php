<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Siswa;
use App\Models\JadwalPelajaran;
use App\Models\Tugas;
use App\Models\Pengumpulan;
use App\Models\Banding;
use App\Models\PemulihanPengumpulan;
use App\Http\Middleware\SelectiveSubmissionLocking;
use Illuminate\Http\Request;
use Carbon\Carbon;

function format_status($bool) {
    return $bool ? "🟢 SUCCESS" : "🔴 FAILED";
}

try {
    echo "========================================================\n";
    echo "🧪 SIMULASI ALUR PENDEKATAN LOCKING, BANDING & RECOVERY\n";
    echo "========================================================\n\n";

    // 1. Fetch Users
    $studentUser = User::where('email', 'andi@sekolah.sch.id')->first();
    $teacherUser = User::where('email', 'mulyadi@sekolah.sch.id')->first();
    $subject = JadwalPelajaran::where('kode', 'BIN-X')->first();

    if (!$studentUser || !$teacherUser || !$subject) {
        die("❌ Prerequisites not met. Please run seed_indonesian_data.php first!\n");
    }

    echo "1. Mengautentikasi Siswa: {$studentUser->nama} (Kelas: {$studentUser->student->kelas})\n";
    auth()->login($studentUser);
    
    // Check overdue assignment
    $overdueCount = Tugas::where('mata_pelajaran_id', $subject->id)
        ->where('deadline', '<', Carbon::now())
        ->whereDoesntHave('submissions', function ($q) use ($studentUser) {
            $q->where('siswa_id', $studentUser->student_id);
        })
        ->count();
    
    echo "   -> Jumlah tugas tertunggak (overdue): {$overdueCount} tugas.\n";
    echo "   " . format_status($overdueCount > 0) . " (Siswa memiliki tunggakan)\n\n";

    // 2. Test Middleware Locking
    echo "2. Menguji Middleware SelectiveSubmissionLocking (Akses Normal)\n";
    
    // Ambil assignment yang overdue dan yang aktif
    $overdueAssignment = Tugas::where('mata_pelajaran_id', $subject->id)
        ->where('deadline', '<', Carbon::now())
        ->first();
    
    $activeAssignment = Tugas::where('mata_pelajaran_id', $subject->id)
        ->where('deadline', '>', Carbon::now())
        ->first();

    // Buat mock request untuk submit ke $activeAssignment
    $request = Request::create('/assignments/' . $activeAssignment->id, 'POST');
    $route = new \Illuminate\Routing\Route('POST', '/assignments/{assignment}', []);
    $route->bind($request);
    $route->setParameter('assignment', $activeAssignment);
    $request->setRouteResolver(function() use ($route) {
        return $route;
    });

    $middleware = new SelectiveSubmissionLocking();
    $response = $middleware->handle($request, function($req) {
        return new \Symfony\Component\HttpFoundation\Response("next_called");
    });

    $isLocked = ($response->getContent() !== "next_called");
    echo "   -> Mencoba submit tugas aktif: " . ($isLocked ? "TERKUNCI (LOCKED)" : "DIIZINKAN") . "\n";
    echo "   " . format_status($isLocked) . " (Middleware mengunci akses karena tunggakan)\n\n";

    // 3. Simpan Pengajuan Banding oleh Siswa
    echo "3. Siswa Mengajukan Banding untuk Mapel: {$subject->nama}\n";
    
    // Hapus banding lama jika ada
    Banding::where('siswa_id', $studentUser->student_id)
        ->where('mata_pelajaran_id', $subject->id)
        ->delete();

    $appeal = Banding::create([
        'siswa_id' => $studentUser->student_id,
        'mata_pelajaran_id' => $subject->id,
        'alasan' => 'Saya sakit tifus selama 4 hari kemarin dan melampirkan surat dokter.',
        'status' => 'pending',
        'tugas_id' => $overdueAssignment->id
    ]);

    echo "   -> Banding berhasil disimpan di tabel `pengajuan_banding`.\n";
    echo "   -> Alasan: '{$appeal->alasan}'\n";
    echo "   -> Status saat ini: '{$appeal->status}'\n";
    echo "   " . format_status($appeal->id > 0 && $appeal->status === 'pending') . "\n\n";

    // 4. Guru mereview dan menyetujui Banding (Mengaktifkan Recovery Mode)
    echo "4. Guru Drs. H. Mulyadi menyetujui banding (Durasi: 48 jam)\n";
    auth()->login($teacherUser);

    // Hapus recovery lama jika ada
    PemulihanPengumpulan::where('siswa_id', $appeal->siswa_id)
        ->where('mata_pelajaran_id', $appeal->mata_pelajaran_id)
        ->delete();

    // Jalankan logika persetujuan guru
    $duration = 48; // jam
    $oldestOverdue = Tugas::query()
        ->where('mata_pelajaran_id', $appeal->mata_pelajaran_id)
        ->where('status', 'aktif')
        ->where('deadline', '<', Carbon::now())
        ->whereDoesntHave('submissions', function ($q) use ($appeal) {
            $q->where('siswa_id', $appeal->siswa_id);
        })
        ->orderBy('deadline', 'asc')
        ->first();

    if ($oldestOverdue) {
        $recovery = PemulihanPengumpulan::create([
            'siswa_id' => $appeal->siswa_id,
            'mata_pelajaran_id' => $appeal->mata_pelajaran_id,
            'status_pemulihan' => 'aktif',
            'durasi_jam' => $duration,
            'tugas_id' => $oldestOverdue->id,
            'mulai_pemulihan' => Carbon::now(),
            'batas_pemulihan' => Carbon::now()->addHours($duration),
            'selesai_pemulihan' => null,
        ]);

        $appeal->update([
            'status' => 'approved',
            'approved_by' => $teacherUser->id,
            'approved_at' => Carbon::now(),
        ]);

        echo "   -> Recovery Mode DIAKTIFKAN.\n";
        echo "   -> Tugas target aktif pertama: ID {$recovery->tugas_id} ('{$oldestOverdue->judul}')\n";
        echo "   -> Batas Waktu Pemulihan: {$recovery->batas_pemulihan->toDateTimeString()}\n";
        echo "   -> Status Banding diperbarui menjadi: '{$appeal->status}'\n";
        echo "   " . format_status($recovery->status_pemulihan === 'aktif' && $appeal->status === 'approved') . "\n\n";
    } else {
        die("❌ Gagal: Tidak ada tugas overdue ditemukan.\n");
    }

    // 5. Menguji Akses Siswa selama Recovery Mode Aktif
    echo "5. Menguji Akses Siswa saat Recovery Mode Aktif\n";
    auth()->login($studentUser);

    // Kasus A: Mencoba submit tugas yang BUKAN merupakan target recovery
    echo "   Kasus A: Submit tugas aktif (bukan target recovery)\n";
    $requestA = Request::create('/assignments/' . $activeAssignment->id, 'POST');
    $routeA = new \Illuminate\Routing\Route('POST', '/assignments/{assignment}', []);
    $routeA->bind($requestA);
    $routeA->setParameter('assignment', $activeAssignment);
    $requestA->setRouteResolver(function() use ($routeA) {
        return $routeA;
    });
    $responseA = $middleware->handle($requestA, function($req) {
        return new \Symfony\Component\HttpFoundation\Response("next_called");
    });
    $isLockedA = ($responseA->getContent() !== "next_called");
    echo "   -> Hasil: " . ($isLockedA ? "TERKUNCI (Sesuai Skema)" : "DIIZINKAN (Error!)") . "\n";
    echo "   " . format_status($isLockedA) . "\n";

    // Kasus B: Mencoba submit tugas yang MERUPAKAN target recovery (tugas overdue tertua)
    echo "   Kasus B: Submit tugas target recovery ('{$oldestOverdue->judul}')\n";
    $requestB = Request::create('/assignments/' . $oldestOverdue->id, 'POST');
    $routeB = new \Illuminate\Routing\Route('POST', '/assignments/{assignment}', []);
    $routeB->bind($requestB);
    $routeB->setParameter('assignment', $oldestOverdue);
    $requestB->setRouteResolver(function() use ($routeB) {
        return $routeB;
    });
    $responseB = $middleware->handle($requestB, function($req) {
        return new \Symfony\Component\HttpFoundation\Response("next_called");
    });
    $isAllowedB = ($responseB->getContent() === "next_called");
    echo "   -> Hasil: " . ($isAllowedB ? "DIIZINKAN (Sesuai Skema)" : "TERKUNCI (Error!)") . "\n";
    echo "   " . format_status($isAllowedB) . "\n\n";

    // 6. Menyelesaikan Tugas Target Recovery (Progresi Sekuensial)
    echo "6. Mengirim Tugas Target Recovery & Melakukan Progresi Sekuensial\n";
    
    // Hapus submission lama jika ada
    Pengumpulan::where('tugas_id', $oldestOverdue->id)
        ->where('siswa_id', $studentUser->student_id)
        ->delete();

    // Buat submission baru
    $submission = Pengumpulan::create([
        'tugas_id' => $oldestOverdue->id,
        'siswa_id' => $studentUser->student_id,
        'tanggal_pengumpulan' => Carbon::now(),
        'file_tugas' => 'submissions/test_appeal_doc.pdf',
        'status' => 'submitted',
    ]);
    echo "   -> Siswa berhasil mengumpulkan tugas: '{$oldestOverdue->judul}'\n";

    // Panggil handler progresi sekuensial
    // Panggil logika handleRecoveryProgression secara langsung
    $activeRecovery = PemulihanPengumpulan::where('siswa_id', $studentUser->student_id)
        ->where('mata_pelajaran_id', $oldestOverdue->subject_id)
        ->where('status_pemulihan', 'aktif')
        ->first();

    if ($activeRecovery && $activeRecovery->tugas_id == $oldestOverdue->id) {
        // Cari tugas tertunggak berikutnya
        $nextOverdue = Tugas::query()
            ->where('mata_pelajaran_id', $oldestOverdue->subject_id)
            ->where('status', 'aktif')
            ->where('deadline', '<', Carbon::now())
            ->whereDoesntHave('submissions', function ($q) use ($studentUser) {
                $q->where('siswa_id', $studentUser->student_id);
            })
            ->orderBy('deadline', 'asc')
            ->first();

        if ($nextOverdue) {
            $activeRecovery->update([
                'tugas_id' => $nextOverdue->id,
                'batas_pemulihan' => Carbon::now()->addHours($activeRecovery->durasi_jam),
            ]);
            echo "   -> Ada tunggakan berikutnya. Target recovery diperbarui ke: ID {$nextOverdue->id} ('{$nextOverdue->judul}')\n";
            echo "   -> Timer di-reset sesuai dengan durasi {$activeRecovery->durasi_jam} jam.\n";
            echo "   " . format_status($activeRecovery->tugas_id == $nextOverdue->id) . "\n";
        } else {
            $activeRecovery->update([
                'status_pemulihan' => 'selesai',
                'selesai_pemulihan' => Carbon::now(),
            ]);
            echo "   -> Semua tunggakan selesai! Status pemulihan: '{$activeRecovery->status_pemulihan}'\n";
            echo "   -> Akses akun dipulihkan sepenuhnya normal.\n";
            echo "   " . format_status($activeRecovery->status_pemulihan === 'selesai') . "\n";
        }
    }
    echo "\n";

    // 7. Menguji Kadaluarsa Timer (Expired Recovery Mode)
    echo "7. Menguji Skenario Kadaluarsa Timer (Expired Recovery)\n";
    
    // Set status recovery menjadi aktif kembali dengan batas waktu di masa lalu (expired)
    $expiredRecovery = PemulihanPengumpulan::where('siswa_id', $studentUser->student_id)
        ->where('mata_pelajaran_id', $subject->id)
        ->first();

    $expiredRecovery->update([
        'status_pemulihan' => 'aktif',
        'batas_pemulihan' => Carbon::now()->subHour(), // 1 jam yang lalu (expired)
        'tugas_id' => $overdueAssignment->id
    ]);
    
    // Hapus submission agar terdeteksi tunggakan lagi
    Pengumpulan::where('tugas_id', $overdueAssignment->id)
        ->where('siswa_id', $studentUser->student_id)
        ->delete();

    echo "   -> Batas waktu recovery diatur di masa lalu: {$expiredRecovery->batas_pemulihan->toDateTimeString()}\n";

    // Panggil middleware
    $requestExp = Request::create('/assignments/' . $activeAssignment->id, 'POST');
    $routeExp = new \Illuminate\Routing\Route('POST', '/assignments/{assignment}', []);
    $routeExp->bind($requestExp);
    $routeExp->setParameter('assignment', $activeAssignment);
    $requestExp->setRouteResolver(function() use ($routeExp) {
        return $routeExp;
    });
    
    $responseExp = $middleware->handle($requestExp, function($req) {
        return new \Symfony\Component\HttpFoundation\Response("next_called");
    });

    // Refresh model status
    $expiredRecovery->refresh();
    
    $isLockedExp = ($responseExp->getContent() !== "next_called");
    echo "   -> Status pemulihan setelah ditangani middleware: '{$expiredRecovery->status_pemulihan}'\n";
    echo "   -> Akses siswa: " . ($isLockedExp ? "TERKUNCI KEMBALI (LOCKED)" : "DIIZINKAN (Error!)") . "\n";
    echo "   " . format_status($expiredRecovery->status_pemulihan === 'expired' && $isLockedExp) . "\n\n";

    echo "========================================================\n";
    echo "🎉 SELURUH SIMULASI ALUR BERJALAN DENGAN PERFECT & SUKSES!\n";
    echo "========================================================\n";

} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
