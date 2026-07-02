<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\JadwalPelajaran;
use App\Models\Tugas;
use App\Models\PelacakanMateri;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PelacakanBelajarTest extends TestCase
{
    use RefreshDatabase;

    private $studentUser;
    private $student;
    private $teacherUser;
    private $teacher;
    private $subject;
    private $classRoom;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        // 1. Buat Kelas
        $this->classRoom = Kelas::create([
            'name' => 'X IPA 1',
            'tingkat' => 'X',
            'jurusan' => 'IPA',
            'tahunAjaran' => '2025/2026',
            'kapasitasMaksimal' => 36
        ]);

        // 2. Buat Siswa & Akun User
        $this->student = Siswa::create([
            'nis' => '23241001',
            'nama' => 'Siswa Test',
            'kelas' => 'X IPA 1',
            'status' => 'aktif',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2009-01-01'
        ]);

        $this->studentUser = User::create([
            'nama' => 'Siswa Test',
            'email' => 'student@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);
        $this->student->update(['pengguna_id' => $this->studentUser->id]);

        // 3. Buat Guru & Akun User
        $this->teacher = Guru::create([
            'nip' => '198001012010011001',
            'nama' => 'Guru Test',
            'email' => 'teacher@smansago.com',
            'no_hp' => '08123456789'
        ]);

        $this->teacherUser = User::create([
            'nama' => 'Guru Test',
            'email' => 'teacher@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'guru'
        ]);
        $this->teacher->update(['pengguna_id' => $this->teacherUser->id]);

        // 4. Buat Jadwal Pelajaran (Subject)
        $this->subject = JadwalPelajaran::create([
            'kode' => 'MTK-10',
            'nama' => 'Matematika',
            'tingkat' => 'X',
            'status' => 'aktif'
        ]);
    }

    public function test_siswa_bisa_menandai_materi_selesai_dan_batal(): void
    {
        // Buat Materi (tugas dengan deadline jauh di depan)
        $materi = Tugas::create([
            'mata_pelajaran_id' => $this->subject->id,
            'judul' => 'Bab 1 Aljabar',
            'deskripsi' => 'Pengenalan Aljabar',
            'deadline' => Carbon::now()->addYears(5), // Materi
            'lampiran' => 'materi/aljabar.pdf',
            'guru_id' => $this->teacher->id,
            'status' => 'aktif'
        ]);

        // 1. Uji tandai selesai
        $response = $this->actingAs($this->studentUser)
            ->post(route('materials.complete', $materi->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('pelacakan_materi', [
            'siswa_id' => $this->student->id,
            'tugas_id' => $materi->id
        ]);

        // 2. Uji batalkan penyelesaian
        $response = $this->actingAs($this->studentUser)
            ->post(route('materials.incomplete', $materi->id));

        $response->assertRedirect();
        $this->assertDatabaseMissing('pelacakan_materi', [
            'siswa_id' => $this->student->id,
            'tugas_id' => $materi->id
        ]);
    }

    public function test_restrict_access_tugas_belum_membaca_materi(): void
    {
        // Buat Materi
        $materi = Tugas::create([
            'mata_pelajaran_id' => $this->subject->id,
            'judul' => 'Bab 1 Aljabar',
            'deskripsi' => 'Pengenalan Aljabar',
            'deadline' => Carbon::now()->addYears(5),
            'lampiran' => 'materi/aljabar.pdf',
            'guru_id' => $this->teacher->id,
            'status' => 'aktif'
        ]);

        // Buat Tugas dengan Prasyarat Materi
        $tugas = Tugas::create([
            'mata_pelajaran_id' => $this->subject->id,
            'judul' => 'Tugas 1 Aljabar',
            'deskripsi' => 'Kerjakan soal 1-5',
            'deadline' => Carbon::now()->addDays(5), // Tugas aktif
            'guru_id' => $this->teacher->id,
            'status' => 'aktif',
            'max_score' => 100,
            'prasyarat_materi_id' => $materi->id
        ]);

        // Coba kirim tugas tanpa menyelesaikan materi
        $file = UploadedFile::fake()->create('jawaban.pdf', 500);
        $response = $this->actingAs($this->studentUser)
            ->from(route('assignments.show', $tugas->id))
            ->post(route('assignments.submit', $tugas->id), [
                'file' => $file
            ]);

        // Harus gagal dan ter-redirect balik dengan pesan error prasyarat
        $response->assertRedirect(route('assignments.show', $tugas->id));
        $response->assertSessionHas('submission_locked');
        $this->assertDatabaseMissing('pengumpulan_tugas', [
            'siswa_id' => $this->student->id,
            'tugas_id' => $tugas->id
        ]);
    }

    public function test_restrict_access_tugas_lulus_setelah_membaca_materi(): void
    {
        // Buat Materi
        $materi = Tugas::create([
            'mata_pelajaran_id' => $this->subject->id,
            'judul' => 'Bab 1 Aljabar',
            'deskripsi' => 'Pengenalan Aljabar',
            'deadline' => Carbon::now()->addYears(5),
            'lampiran' => 'materi/aljabar.pdf',
            'guru_id' => $this->teacher->id,
            'status' => 'aktif'
        ]);

        // Buat Tugas dengan Prasyarat Materi
        $tugas = Tugas::create([
            'mata_pelajaran_id' => $this->subject->id,
            'judul' => 'Tugas 1 Aljabar',
            'deskripsi' => 'Kerjakan soal 1-5',
            'deadline' => Carbon::now()->addDays(5), // Tugas aktif
            'guru_id' => $this->teacher->id,
            'status' => 'aktif',
            'max_score' => 100,
            'prasyarat_materi_id' => $materi->id
        ]);

        // Tandai materi sebagai selesai oleh siswa
        PelacakanMateri::create([
            'siswa_id' => $this->student->id,
            'tugas_id' => $materi->id,
            'tanggal_selesai' => now()
        ]);

        // Kirim tugas setelah menyelesaikan materi
        $file = UploadedFile::fake()->create('jawaban.pdf', 500);
        $response = $this->actingAs($this->studentUser)
            ->post(route('assignments.submit', $tugas->id), [
                'file' => $file
            ]);

        // Harus sukses dikirim
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Tugas berhasil dikumpulkan.');
        $this->assertDatabaseHas('pengumpulan_tugas', [
            'siswa_id' => $this->student->id,
            'tugas_id' => $tugas->id
        ]);
    }
}
