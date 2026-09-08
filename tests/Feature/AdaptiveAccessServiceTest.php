<?php

namespace Tests\Feature;

use App\DTO\AdaptiveAccessResult;
use App\DTO\SubmissionDecision;
use App\Enums\AdaptiveAccessStatus;
use App\Models\Banding;
use App\Models\Guru;
use App\Models\GuruKelas;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\PelacakanMateri;
use App\Models\PemulihanPengumpulan;
use App\Models\Pengaturan;
use App\Models\Pengumpulan;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\User;
use App\Services\AdaptiveAccessService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdaptiveAccessServiceTest extends TestCase
{
    use RefreshDatabase;

    private Siswa $student;
    private User $studentUser;
    private Guru $teacher;
    private User $teacherUser;
    private Kelas $classRoom;
    private JadwalPelajaran $subjectMath;
    private JadwalPelajaran $subjectEnglish;
    private AdaptiveAccessService $service;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->service = app(AdaptiveAccessService::class);

        // 1. Create Class
        $this->classRoom = Kelas::create([
            'name' => 'X-IPA-1',
            'grade_level' => 'X',
            'tingkat' => 'X',
            'jurusan' => 'IPA',
            'tahunAjaran' => '2025/2026',
            'academic_year' => '2025/2026',
            'kapasitasMaksimal' => 36,
        ]);

        // 2. Create Student
        $this->student = Siswa::create([
            'nis' => '1001',
            'nama' => 'Siswa Test Adaptive',
            'kelas' => 'X-IPA-1',
            'status' => 'aktif',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2009-01-01',
        ]);
        $this->studentUser = User::create([
            'nama' => 'Siswa Test Adaptive',
            'email' => 'siswa.adaptive@sekolah.test',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
        $this->student->update(['pengguna_id' => $this->studentUser->id]);

        // 3. Create Teacher
        $this->teacher = Guru::create([
            'nip' => '2001',
            'nama' => 'Guru Matematika',
            'email' => 'guru.mtk@sekolah.test',
            'status' => 'aktif',
        ]);
        $this->teacherUser = User::create([
            'nama' => 'Guru Matematika',
            'email' => 'guru.mtk@sekolah.test',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);
        $this->teacher->update(['pengguna_id' => $this->teacherUser->id]);

        // 4. Create Subjects
        $this->subjectMath = JadwalPelajaran::create([
            'kode' => 'MAT-X',
            'nama' => 'Matematika',
            'tingkat' => 'X',
            'status' => 'aktif',
        ]);

        $this->subjectEnglish = JadwalPelajaran::create([
            'kode' => 'ENG-X',
            'nama' => 'Bahasa Inggris',
            'tingkat' => 'X',
            'status' => 'aktif',
        ]);

        // 5. Assign Teacher to Math in Class
        GuruKelas::create([
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->classRoom->id,
            'mata_pelajaran_id' => $this->subjectMath->id,
        ]);
    }

    protected function tearDown(): void
    {
        Pengaturan::setValue('ssl_threshold', '3');
        parent::tearDown();
    }

    private function createOverdueTask(JadwalPelajaran $subject, int $daysAgo = 2, ?int $classId = null): Tugas
    {
        return Tugas::create([
            'mata_pelajaran_id' => $subject->id,
            'kelas_id' => $classId ?? $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => "Tugas Overdue {$subject->nama} {$daysAgo} Hari",
            'deadline' => Carbon::now()->subDays($daysAgo),
            'status' => 'aktif',
        ]);
    }

    private function createActiveTask(JadwalPelajaran $subject, int $daysAhead = 2): Tugas
    {
        return Tugas::create([
            'mata_pelajaran_id' => $subject->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => "Tugas Aktif {$subject->nama}",
            'deadline' => Carbon::now()->addDays($daysAhead),
            'status' => 'aktif',
        ]);
    }

    /** 1. Siswa tanpa tunggakan berstatus NORMAL dan diizinkan submit */
    public function test_01_student_without_overdue_gets_normal_status_and_is_allowed_to_submit(): void
    {
        $task = $this->createActiveTask($this->subjectMath);

        $subjectResult = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::NORMAL, $subjectResult->status);
        $this->assertEquals(0, $subjectResult->jumlahTunggakan);
        $this->assertEquals('NO_OVERDUE', $subjectResult->reasonCode);

        $decision = $this->service->evaluateTaskSubmission($this->student, $task);
        $this->assertTrue($decision->allowed);
        $this->assertEquals(AdaptiveAccessStatus::NORMAL, $decision->sslStatus);
        $this->assertEquals('ALLOWED', $decision->reasonCode);
    }

    /** 2. Siswa dengan tunggakan di bawah batas (1-2) berstatus WARNING dan TETAP diizinkan submit */
    public function test_02_student_with_overdue_below_threshold_gets_warning_status_and_is_allowed_to_submit(): void
    {
        $overdue1 = $this->createOverdueTask($this->subjectMath, 3);
        $overdue2 = $this->createOverdueTask($this->subjectMath, 1);
        $activeTask = $this->createActiveTask($this->subjectMath);

        $subjectResult = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::WARNING, $subjectResult->status);
        $this->assertEquals(2, $subjectResult->jumlahTunggakan);
        $this->assertEquals('OVERDUE_BELOW_THRESHOLD', $subjectResult->reasonCode);
        $this->assertFalse($subjectResult->canAppeal);

        // Siswa submit tugas aktif -> diizinkan
        $decisionActive = $this->service->evaluateTaskSubmission($this->student, $activeTask);
        $this->assertTrue($decisionActive->allowed);
        $this->assertEquals(AdaptiveAccessStatus::WARNING, $decisionActive->sslStatus);
        $this->assertEquals('ALLOWED_WARNING', $decisionActive->reasonCode);

        // Siswa submit tugas terlambat -> TETAP diizinkan di bawah status WARNING
        $decisionOverdue = $this->service->evaluateTaskSubmission($this->student, $overdue1);
        $this->assertTrue($decisionOverdue->allowed);
        $this->assertEquals(AdaptiveAccessStatus::WARNING, $decisionOverdue->sslStatus);
    }

    /** 3. Siswa dengan >= 3 tunggakan berstatus LOCKED dan pengumpulan diblokir */
    public function test_03_student_with_overdue_at_or_above_threshold_gets_locked_status_and_is_blocked(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $this->createOverdueTask($this->subjectMath, 4 - $i);
        }
        $activeTask = $this->createActiveTask($this->subjectMath);

        $subjectResult = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::LOCKED, $subjectResult->status);
        $this->assertEquals(3, $subjectResult->jumlahTunggakan);
        $this->assertEquals('THRESHOLD_REACHED', $subjectResult->reasonCode);
        $this->assertTrue($subjectResult->canAppeal);

        $decision = $this->service->evaluateTaskSubmission($this->student, $activeTask);
        $this->assertFalse($decision->allowed);
        $this->assertEquals(AdaptiveAccessStatus::LOCKED, $decision->sslStatus);
        $this->assertEquals('LOCKED_BY_SSL', $decision->reasonCode);
        $this->assertTrue($decision->canAppeal);
    }

    /** 4. Siswa dalam Mode RECOVERY hanya boleh mengumpulkan tugas target */
    public function test_04_student_with_active_recovery_gets_recovery_status_and_can_only_submit_target_task(): void
    {
        $task1 = $this->createOverdueTask($this->subjectMath, 5);
        $task2 = $this->createOverdueTask($this->subjectMath, 3);
        $task3 = $this->createOverdueTask($this->subjectMath, 1);

        PemulihanPengumpulan::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectMath->id,
            'status_pemulihan' => 'aktif',
            'tipe_pemulihan' => 'normal',
            'durasi_jam' => 24,
            'tugas_id' => $task1->id,
            'mulai_pemulihan' => Carbon::now(),
            'batas_pemulihan' => Carbon::now()->addHours(24),
        ]);

        $subjectResult = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::RECOVERY, $subjectResult->status);
        $this->assertEquals($task1->id, $subjectResult->targetTugasId);

        // Submit tugas target (task1) -> Diizinkan
        $decisionTask1 = $this->service->evaluateTaskSubmission($this->student, $task1);
        $this->assertTrue($decisionTask1->allowed);
        $this->assertEquals('RECOVERY_TARGET_ALLOWED', $decisionTask1->reasonCode);

        // Submit tugas non-target (task2) -> Ditolak
        $decisionTask2 = $this->service->evaluateTaskSubmission($this->student, $task2);
        $this->assertFalse($decisionTask2->allowed);
        $this->assertEquals('RECOVERY_WRONG_TASK', $decisionTask2->reasonCode);
        $this->assertEquals($task1->id, $decisionTask2->targetTugasId);
    }

    /** 5. Mengumpulkan tugas target memajukan recovery sekuensial tanpa mereset waktu durasi */
    public function test_05_submitting_recovery_target_task_advances_sequentially_without_resetting_duration(): void
    {
        $task1 = $this->createOverdueTask($this->subjectMath, 5);
        $task2 = $this->createOverdueTask($this->subjectMath, 3);

        $fixedExpiry = Carbon::now()->addHours(18);

        $recovery = PemulihanPengumpulan::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectMath->id,
            'status_pemulihan' => 'aktif',
            'tipe_pemulihan' => 'normal',
            'durasi_jam' => 24,
            'tugas_id' => $task1->id,
            'mulai_pemulihan' => Carbon::now()->subHours(6),
            'batas_pemulihan' => $fixedExpiry,
        ]);

        // Simulasikan siswa submit task1
        Pengumpulan::create([
            'tugas_id' => $task1->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now(),
            'file_tugas' => 'submissions/1/dummy.pdf',
            'status' => 'late',
        ]);

        $this->service->advanceRecoveryAfterSubmission($this->student, $task1);

        $recovery->refresh();
        $this->assertEquals('aktif', $recovery->status_pemulihan);
        $this->assertEquals($task2->id, $recovery->tugas_id); // Target maju ke task 2
        $this->assertEquals($fixedExpiry->timestamp, $recovery->batas_pemulihan->timestamp); // Timer tetap (tidak reset unlimited)

        // Simulasikan siswa submit task2 (tugas terakhir)
        Pengumpulan::create([
            'tugas_id' => $task2->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now(),
            'file_tugas' => 'submissions/2/dummy.pdf',
            'status' => 'late',
        ]);

        $this->service->advanceRecoveryAfterSubmission($this->student, $task2);

        $recovery->refresh();
        $this->assertEquals('selesai', $recovery->status_pemulihan);
        $this->assertNotNull($recovery->selesai_pemulihan);
    }

    /** 6. Sesi recovery kedaluwarsa dievaluasi ulang secara dinamis (LOCKED / WARNING / NORMAL) */
    public function test_06_expired_recovery_dynamically_evaluates_back_to_locked_warning_or_normal(): void
    {
        $task1 = $this->createOverdueTask($this->subjectMath, 5);
        $task2 = $this->createOverdueTask($this->subjectMath, 3);
        $task3 = $this->createOverdueTask($this->subjectMath, 1);

        // Buat recovery yang sudah lewat waktu (expired)
        $recovery = PemulihanPengumpulan::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectMath->id,
            'status_pemulihan' => 'aktif',
            'tipe_pemulihan' => 'normal',
            'durasi_jam' => 24,
            'tugas_id' => $task1->id,
            'mulai_pemulihan' => Carbon::now()->subDays(2),
            'batas_pemulihan' => Carbon::now()->subHours(2), // Lewat 2 jam lalu
        ]);

        // Karena masih ada 3 tunggakan, evaluasi dinamis kembali ke LOCKED
        $result3 = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::LOCKED, $result3->status);
        $recovery->refresh();
        $this->assertEquals('expired', $recovery->status_pemulihan);

        // Jika siswa sempat menyelesaikan dan dinilai 2 tugas sebelum expired (sisa 1 tunggakan), statusnya WARNING (bukan LOCKED!)
        Pengumpulan::create(['tugas_id' => $task1->id, 'siswa_id' => $this->student->id, 'file_tugas' => 'f1.pdf', 'status' => 'graded']);
        Pengumpulan::create(['tugas_id' => $task2->id, 'siswa_id' => $this->student->id, 'file_tugas' => 'f2.pdf', 'status' => 'graded']);

        $result1 = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::WARNING, $result1->status);
        $this->assertEquals(1, $result1->jumlahTunggakan);
    }

    /** 7. Isolasi antar mata pelajaran: 3 tunggakan Matematika tidak mengunci Bahasa Inggris */
    public function test_07_cross_subject_isolation_prevents_math_overdue_from_locking_english(): void
    {
        // 3 tunggakan di Matematika
        for ($i = 1; $i <= 3; $i++) {
            $this->createOverdueTask($this->subjectMath, 4 - $i);
        }

        // 1 tugas aktif di Bahasa Inggris
        $taskEnglish = $this->createActiveTask($this->subjectEnglish);

        $mathResult = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::LOCKED, $mathResult->status);

        $englishResult = $this->service->evaluateSubjectAccess($this->student, $this->subjectEnglish);
        $this->assertEquals(AdaptiveAccessStatus::NORMAL, $englishResult->status);

        $decisionEnglish = $this->service->evaluateTaskSubmission($this->student, $taskEnglish);
        $this->assertTrue($decisionEnglish->allowed);
        $this->assertEquals(AdaptiveAccessStatus::NORMAL, $decisionEnglish->sslStatus);
    }

    /** 8. Pemeriksaan prasyarat materi terpisah dari status adaptif */
    public function test_08_prerequisite_material_check_is_separate_from_ssl_status(): void
    {
        $material = Materi::create([
            'title' => 'Materi Bab 1 Aljabar',
            'subject_id' => $this->subjectMath->id,
            'kelas_id' => $this->classRoom->id,
            'uploaded_by' => $this->teacher->id,
            'type' => 'document',
        ]);

        $taskWithPrereq = Tugas::create([
            'mata_pelajaran_id' => $this->subjectMath->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Tugas dengan Prasyarat',
            'deadline' => Carbon::now()->addDays(2),
            'status' => 'aktif',
            'prasyarat_materi_id' => $material->id,
        ]);

        // Siswa berstatus NORMAL pada mapel, tetapi belum menyelesaikan materi
        $decision = $this->service->evaluateTaskSubmission($this->student, $taskWithPrereq);
        $this->assertFalse($decision->allowed);
        $this->assertFalse($decision->prerequisiteMet);
        $this->assertEquals('PREREQUISITE_INCOMPLETE', $decision->reasonCode);
        $this->assertEquals($material->id, $decision->prerequisiteMaterialId);

        // Setelah materi diselesaikan
        PelacakanMateri::create([
            'siswa_id' => $this->student->id,
            'materi_id' => $material->id,
            'status' => 'selesai',
        ]);

        $decisionAfter = $this->service->evaluateTaskSubmission($this->student, $taskWithPrereq);
        $this->assertTrue($decisionAfter->allowed);
        $this->assertTrue($decisionAfter->prerequisiteMet);
    }

    /** 9. Threshold dinamis dari tabel pengaturan dipatuhi */
    public function test_09_dynamic_threshold_from_settings_is_respected(): void
    {
        Pengaturan::setValue('ssl_threshold', '2');

        // 2 tunggakan pada threshold=2 langsung memicu LOCKED
        $this->createOverdueTask($this->subjectMath, 3);
        $this->createOverdueTask($this->subjectMath, 1);

        $result = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::LOCKED, $result->status);
        $this->assertEquals(2, $result->threshold);
    }

    /** 10. Jika siswa sudah memiliki banding pending, can_appeal bernilai false */
    public function test_10_pending_appeal_disables_can_appeal_on_locked_status(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $this->createOverdueTask($this->subjectMath, 4 - $i);
        }

        Banding::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectMath->id,
            'alasan' => 'Sedang sakit',
            'status' => 'pending',
        ]);

        $result = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::LOCKED, $result->status);
        $this->assertEquals('PENDING', $result->appealStatus);
        $this->assertFalse($result->canAppeal); // Mencegah banding ganda
    }

    /** 11. Middleware menangani exception dan mengembalikan HTTP 503 (fail-closed) */
    public function test_11_middleware_catches_errors_and_returns_503_fail_closed(): void
    {
        $task = $this->createActiveTask($this->subjectMath);

        $this->actingAs($this->studentUser);

        // Simulasi error tidak terduga dengan melempar exception saat evaluasi
        $mockService = $this->createMock(AdaptiveAccessService::class);
        $mockService->method('evaluateTaskSubmission')->willThrowException(new \RuntimeException('Database connection lost'));
        $this->app->instance(AdaptiveAccessService::class, $mockService);

        $response = $this->postJson(route('assignments.submit', $task->id), [
            'file' => UploadedFile::fake()->create('jawaban.pdf', 100, 'application/pdf'),
        ]);

        $response->assertStatus(503);
        $response->assertJson([
            'success' => false,
            'message' => 'Evaluasi akses sementara tidak tersedia. Silakan mencoba kembali.',
        ]);
    }

    /** 12. Verifikasi status Normal, EWS (Early Warning System), dan Lock SSL beserta helper method & representasi badge */
    public function test_12_adaptive_status_normal_ews_and_lock_ssl_helpers_and_representations(): void
    {
        // 1. Kasus NORMAL: 0 tunggakan
        $resultNormal = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertTrue($resultNormal->isNormal());
        $this->assertFalse($resultNormal->isEws());
        $this->assertFalse($resultNormal->isLockSsl());
        $this->assertFalse($resultNormal->isRecovery());
        $this->assertEquals('Normal', $resultNormal->statusLabel());
        $this->assertStringContainsString('emerald', $resultNormal->badgeClass());
        $this->assertEquals('fas fa-check-circle', $resultNormal->icon());

        $arrayNormal = $resultNormal->toArray();
        $this->assertTrue($arrayNormal['is_normal']);
        $this->assertFalse($arrayNormal['is_ews']);
        $this->assertFalse($arrayNormal['is_lock_ssl']);
        $this->assertEquals('Normal', $arrayNormal['status_label']);

        // 2. Kasus EWS (Early Warning System): 1 tunggakan (di bawah threshold 3)
        $this->createOverdueTask($this->subjectMath, 2);
        $resultEws = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertFalse($resultEws->isNormal());
        $this->assertTrue($resultEws->isEws());
        $this->assertTrue($resultEws->isWarning());
        $this->assertFalse($resultEws->isLockSsl());
        $this->assertFalse($resultEws->isRecovery());
        $this->assertEquals('EWS (Peringatan Dini)', $resultEws->statusLabel());
        $this->assertStringContainsString('amber', $resultEws->badgeClass());
        $this->assertEquals('fas fa-exclamation-triangle', $resultEws->icon());

        $arrayEws = $resultEws->toArray();
        $this->assertFalse($arrayEws['is_normal']);
        $this->assertTrue($arrayEws['is_ews']);
        $this->assertFalse($arrayEws['is_lock_ssl']);
        $this->assertEquals('EWS (Peringatan Dini)', $arrayEws['status_label']);

        // 3. Kasus Lock SSL: >= 3 tunggakan (mencapai threshold)
        $this->createOverdueTask($this->subjectMath, 3);
        $this->createOverdueTask($this->subjectMath, 4);
        $resultLock = $this->service->evaluateSubjectAccess($this->student, $this->subjectMath);
        $this->assertFalse($resultLock->isNormal());
        $this->assertFalse($resultLock->isEws());
        $this->assertTrue($resultLock->isLockSsl());
        $this->assertTrue($resultLock->isLocked());
        $this->assertFalse($resultLock->isRecovery());
        $this->assertEquals('Lock SSL (Terkunci)', $resultLock->statusLabel());
        $this->assertStringContainsString('rose', $resultLock->badgeClass());
        $this->assertEquals('fas fa-lock', $resultLock->icon());

        $arrayLock = $resultLock->toArray();
        $this->assertFalse($arrayLock['is_normal']);
        $this->assertFalse($arrayLock['is_ews']);
        $this->assertTrue($arrayLock['is_lock_ssl']);
        $this->assertEquals('Lock SSL (Terkunci)', $arrayLock['status_label']);
    }
}
