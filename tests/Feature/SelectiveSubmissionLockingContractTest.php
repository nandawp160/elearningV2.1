<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\JadwalPelajaran;
use App\Models\GuruKelas;
use App\Models\Tugas;
use App\Models\Pengumpulan;
use App\Models\Banding;
use App\Models\PemulihanPengumpulan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SelectiveSubmissionLockingContractTest extends TestCase
{
    use RefreshDatabase;

    private $studentUser;
    private $student;
    private $teacherUser;
    private $teacher;
    private $subjectA;
    private $subjectB;
    private $classRoom;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        // 1. Create Class Room
        $this->classRoom = Kelas::create([
            'name' => 'X IPA 1',
            'tingkat' => 'X',
            'jurusan' => 'IPA',
            'tahunAjaran' => '2025/2026',
            'kapasitasMaksimal' => 36
        ]);

        // 2. Create Student & User
        $this->student = Siswa::create([
            'nis' => '23241001',
            'nama' => 'Siswa Test SSL',
            'kelas' => 'X IPA 1',
            'status' => 'aktif',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2009-01-01'
        ]);

        $this->studentUser = User::create([
            'nama' => 'Siswa Test SSL',
            'email' => 'student.ssl@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);
        $this->student->update(['pengguna_id' => $this->studentUser->id]);

        // 3. Create Teacher & User
        $this->teacher = Guru::create([
            'nip' => '198001012010011001',
            'nama' => 'Guru Test SSL',
            'email' => 'teacher.ssl@smansago.com',
            'no_hp' => '08123456789'
        ]);

        $this->teacherUser = User::create([
            'nama' => 'Guru Test SSL',
            'email' => 'teacher.ssl@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'guru'
        ]);
        $this->teacher->update(['pengguna_id' => $this->teacherUser->id]);

        // 4. Create Subjects
        $this->subjectA = JadwalPelajaran::create([
            'kode' => 'MTK-10',
            'nama' => 'Matematika',
            'tingkat' => 'X',
            'status' => 'aktif'
        ]);

        $this->subjectB = JadwalPelajaran::create([
            'kode' => 'BIN-10',
            'nama' => 'Bahasa Indonesia',
            'tingkat' => 'X',
            'status' => 'aktif'
        ]);

        // 5. Assign Teacher to Subjects in Class
        GuruKelas::create([
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->classRoom->id,
            'mata_pelajaran_id' => $this->subjectA->id
        ]);

        GuruKelas::create([
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->classRoom->id,
            'mata_pelajaran_id' => $this->subjectB->id
        ]);
    }

    /** 1. 1 overdue A -> submit overdue A allowed, DB submission exists, status late/terlambat */
    public function test_1_single_overdue_assignment_can_be_submitted_as_late(): void
    {
        $overdueA1 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Tugas Overdue A1',
            'deskripsi' => 'Deskripsi',
            'deadline' => now()->subDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentUser);

        $file = UploadedFile::fake()->create('jawaban_a1.pdf', 100, 'application/pdf');
        $response = $this->post(route('assignments.submit', $overdueA1->id), [
            'file' => $file
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pengumpulan_tugas', [
            'tugas_id' => $overdueA1->id,
            'siswa_id' => $this->student->id,
            'status' => 'terlambat'
        ]);
    }

    /** 2. 2 overdue A + active A3 -> POST A3 allowed and submission exists */
    public function test_2_two_overdue_assignments_do_not_trigger_ssl_lock(): void
    {
        Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A1',
            'deadline' => now()->subDays(3),
            'status' => 'aktif'
        ]);

        Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A2',
            'deadline' => now()->subDays(2),
            'status' => 'aktif'
        ]);

        $activeA3 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Aktif A3',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentUser);

        $file = UploadedFile::fake()->create('jawaban_a3.pdf', 100, 'application/pdf');
        $response = $this->post(route('assignments.submit', $activeA3->id), [
            'file' => $file
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pengumpulan_tugas', [
            'tugas_id' => $activeA3->id,
            'siswa_id' => $this->student->id
        ]);
    }

    /** 3. 3 overdue A + active A4 -> POST A4 blocked SSL, no submission A4 */
    public function test_3_three_overdue_assignments_triggers_ssl_lock_on_new_assignment(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Tugas::create([
                'mata_pelajaran_id' => $this->subjectA->id,
                'kelas_id' => $this->classRoom->id,
                'guru_id' => $this->teacher->id,
                'judul' => "Overdue A{$i}",
                'deadline' => now()->subDays(4 - $i),
                'status' => 'aktif'
            ]);
        }

        $activeA4 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Aktif A4',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentUser);

        $file = UploadedFile::fake()->create('jawaban_a4.pdf', 100, 'application/pdf');
        $response = $this->post(route('assignments.submit', $activeA4->id), [
            'file' => $file
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('submission_locked');
        $this->assertDatabaseMissing('pengumpulan_tugas', [
            'tugas_id' => $activeA4->id,
            'siswa_id' => $this->student->id
        ]);
    }

    /** 4. 2 overdue A + 1 overdue B + active A3 + active B2 -> global overdue = 3 -> A3 allowed, B2 allowed */
    public function test_4_cross_subject_overdue_below_threshold_does_not_lock(): void
    {
        // 2 overdue A
        Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A1',
            'deadline' => now()->subDays(3),
            'status' => 'aktif'
        ]);
        Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A2',
            'deadline' => now()->subDays(2),
            'status' => 'aktif'
        ]);

        // 1 overdue B
        Tugas::create([
            'mata_pelajaran_id' => $this->subjectB->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue B1',
            'deadline' => now()->subDays(2),
            'status' => 'aktif'
        ]);

        // Active assignments
        $activeA3 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Aktif A3',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $activeB2 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectB->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Aktif B2',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentUser);

        // Submit A3 -> ALLOWED
        $fileA3 = UploadedFile::fake()->create('jawaban_a3.pdf', 100, 'application/pdf');
        $resA3 = $this->post(route('assignments.submit', $activeA3->id), ['file' => $fileA3]);
        $resA3->assertRedirect();
        $this->assertDatabaseHas('pengumpulan_tugas', ['tugas_id' => $activeA3->id, 'siswa_id' => $this->student->id]);

        // Submit B2 -> ALLOWED
        $fileB2 = UploadedFile::fake()->create('jawaban_b2.pdf', 100, 'application/pdf');
        $resB2 = $this->post(route('assignments.submit', $activeB2->id), ['file' => $fileB2]);
        $resB2->assertRedirect();
        $this->assertDatabaseHas('pengumpulan_tugas', ['tugas_id' => $activeB2->id, 'siswa_id' => $this->student->id]);
    }

    /** 5. 3 overdue A + active A4 + active B1 -> A4 blocked, no A4 submission, B1 allowed, B1 submission exists */
    public function test_5_ssl_lock_is_selective_per_subject(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Tugas::create([
                'mata_pelajaran_id' => $this->subjectA->id,
                'kelas_id' => $this->classRoom->id,
                'guru_id' => $this->teacher->id,
                'judul' => "Overdue A{$i}",
                'deadline' => now()->subDays(4 - $i),
                'status' => 'aktif'
            ]);
        }

        $activeA4 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Aktif A4',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $activeB1 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectB->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Aktif B1',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentUser);

        // Submit A4 -> BLOCKED
        $fileA4 = UploadedFile::fake()->create('jawaban_a4.pdf', 100, 'application/pdf');
        $resA4 = $this->post(route('assignments.submit', $activeA4->id), ['file' => $fileA4]);
        $resA4->assertRedirect();
        $resA4->assertSessionHas('submission_locked');
        $this->assertDatabaseMissing('pengumpulan_tugas', ['tugas_id' => $activeA4->id, 'siswa_id' => $this->student->id]);

        // Submit B1 -> ALLOWED
        $fileB1 = UploadedFile::fake()->create('jawaban_b1.pdf', 100, 'application/pdf');
        $resB1 = $this->post(route('assignments.submit', $activeB1->id), ['file' => $fileB1]);
        $resB1->assertRedirect();
        $this->assertDatabaseHas('pengumpulan_tugas', ['tugas_id' => $activeB1->id, 'siswa_id' => $this->student->id]);
    }

    /** 6. 1/2 overdue A -> direct POST appeal rejected/not eligible */
    public function test_6_appeal_rejected_when_overdue_below_threshold(): void
    {
        Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A1',
            'deadline' => now()->subDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentUser);

        $response = $this->post(route('appeals.store'), [
            'subject_id' => $this->subjectA->id,
            'reason' => 'Permohonan banding 1 overdue'
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('pengajuan_banding', [
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id
        ]);
    }

    /** 7. >=3 overdue A -> legitimate student can appeal A */
    public function test_7_appeal_accepted_when_subject_reaches_threshold(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Tugas::create([
                'mata_pelajaran_id' => $this->subjectA->id,
                'kelas_id' => $this->classRoom->id,
                'guru_id' => $this->teacher->id,
                'judul' => "Overdue A{$i}",
                'deadline' => now()->subDays(4 - $i),
                'status' => 'aktif'
            ]);
        }

        $this->actingAs($this->studentUser);

        $response = $this->post(route('appeals.store'), [
            'subject_id' => $this->subjectA->id,
            'reason' => 'Permohonan banding 3 overdue'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pengajuan_banding', [
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id
        ]);
    }

    /** 8. >=3 overdue A + unlocked B -> appeal B rejected */
    public function test_8_cannot_appeal_unlocked_subject_b(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Tugas::create([
                'mata_pelajaran_id' => $this->subjectA->id,
                'kelas_id' => $this->classRoom->id,
                'guru_id' => $this->teacher->id,
                'judul' => "Overdue A{$i}",
                'deadline' => now()->subDays(4 - $i),
                'status' => 'aktif'
            ]);
        }

        $this->actingAs($this->studentUser);

        $response = $this->post(route('appeals.store'), [
            'subject_id' => $this->subjectB->id,
            'reason' => 'Permohonan banding mapel B tanpa overdue'
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('pengajuan_banding', [
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectB->id
        ]);
    }

    /** 9. Teacher A approve -> recovery active A -> oldest overdue A selected */
    public function test_9_teacher_approval_activates_recovery_mode_for_oldest_task(): void
    {
        $oldestA1 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A1 Tertua',
            'deadline' => now()->subDays(5),
            'status' => 'aktif'
        ]);

        Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A2',
            'deadline' => now()->subDays(3),
            'status' => 'aktif'
        ]);

        Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A3',
            'deadline' => now()->subDays(1),
            'status' => 'aktif'
        ]);

        $appeal = Banding::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'alasan' => 'Sakit',
            'status' => 'ditinjau'
        ]);

        $this->actingAs($this->teacherUser);

        $response = $this->post(route('appeals.approve', $appeal->id), ['duration' => 24]);
        $response->assertRedirect();

        $this->assertDatabaseHas('pemulihan_akses', [
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'tugas_id' => $oldestA1->id,
            'status_pemulihan' => 'aktif'
        ]);
    }

    /** 10. Recovery target A1 -> attempt non-target A2/A4 FIRST blocked recovery -> then A1 allowed */
    public function test_10_only_active_recovery_task_can_be_submitted(): void
    {
        $oldestA1 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A1',
            'deadline' => now()->subDays(5),
            'status' => 'aktif'
        ]);

        $nextA2 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A2',
            'deadline' => now()->subDays(3),
            'status' => 'aktif'
        ]);

        PemulihanPengumpulan::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'tugas_id' => $oldestA1->id,
            'status_pemulihan' => 'aktif',
            'durasi_jam' => 24,
            'mulai_pemulihan' => now(),
            'batas_pemulihan' => now()->addHours(24)
        ]);

        $this->actingAs($this->studentUser);

        // Attempt non-target A2 FIRST -> BLOCKED
        $fileA2 = UploadedFile::fake()->create('jawaban_a2.pdf', 100, 'application/pdf');
        $resA2 = $this->post(route('assignments.submit', $nextA2->id), ['file' => $fileA2]);
        $resA2->assertRedirect();
        $resA2->assertSessionHas('submission_locked');
        $this->assertDatabaseMissing('pengumpulan_tugas', ['tugas_id' => $nextA2->id, 'siswa_id' => $this->student->id]);

        // Attempt target A1 -> ALLOWED
        $fileA1 = UploadedFile::fake()->create('jawaban_a1.pdf', 100, 'application/pdf');
        $resA1 = $this->post(route('assignments.submit', $oldestA1->id), ['file' => $fileA1]);
        $resA1->assertRedirect();
        $this->assertDatabaseHas('pengumpulan_tugas', ['tugas_id' => $oldestA1->id, 'siswa_id' => $this->student->id]);
    }

    /** 11. After A1 submitted: remaining overdue = 2 -> recovery remains active -> target advances A2 -> Strict Clearance not bypassed */
    public function test_11_recovery_mode_maintains_strict_clearance_even_when_count_drops_below_threshold(): void
    {
        $a1 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A1',
            'deadline' => now()->subDays(5),
            'status' => 'aktif'
        ]);

        $a2 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A2',
            'deadline' => now()->subDays(3),
            'status' => 'aktif'
        ]);

        $a3 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A3',
            'deadline' => now()->subDays(1),
            'status' => 'aktif'
        ]);

        $recovery = PemulihanPengumpulan::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'tugas_id' => $a1->id,
            'status_pemulihan' => 'aktif',
            'durasi_jam' => 24,
            'mulai_pemulihan' => now(),
            'batas_pemulihan' => now()->addHours(24)
        ]);

        $this->actingAs($this->studentUser);

        // Submit A1
        $fileA1 = UploadedFile::fake()->create('jawaban_a1.pdf', 100, 'application/pdf');
        $this->post(route('assignments.submit', $a1->id), ['file' => $fileA1]);

        // Assert recovery remains active and advanced to A2
        $recovery->refresh();
        $this->assertEquals('aktif', $recovery->status_pemulihan);
        $this->assertEquals($a2->id, $recovery->tugas_id);

        // Attempt submit A3 before A2 -> BLOCKED (Strict Clearance)
        $fileA3 = UploadedFile::fake()->create('jawaban_a3.pdf', 100, 'application/pdf');
        $resA3 = $this->post(route('assignments.submit', $a3->id), ['file' => $fileA3]);
        $resA3->assertRedirect();
        $resA3->assertSessionHas('submission_locked');
    }

    /** 12. After final overdue cleared -> recovery status selesai */
    public function test_12_recovery_mode_completes_when_all_overdue_cleared(): void
    {
        $a1 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Only Overdue A1',
            'deadline' => now()->subDays(5),
            'status' => 'aktif'
        ]);

        $recovery = PemulihanPengumpulan::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'tugas_id' => $a1->id,
            'status_pemulihan' => 'aktif',
            'durasi_jam' => 24,
            'mulai_pemulihan' => now(),
            'batas_pemulihan' => now()->addHours(24)
        ]);

        $this->actingAs($this->studentUser);

        $fileA1 = UploadedFile::fake()->create('jawaban_a1.pdf', 100, 'application/pdf');
        $this->post(route('assignments.submit', $a1->id), ['file' => $fileA1]);

        $recovery->refresh();
        $this->assertEquals('selesai', $recovery->status_pemulihan);
    }

    /** 13. Teacher rejects appeal -> DB canonical Banding status = ditolak -> no active recovery for student + subject */
    public function test_13_rejected_appeal_does_not_create_recovery_record(): void
    {
        $appeal = Banding::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'alasan' => 'Alasan tidak valid',
            'status' => 'ditinjau'
        ]);

        $this->actingAs($this->teacherUser);

        $response = $this->post(route('appeals.reject', $appeal->id), [
            'tanggapan_guru' => 'Banding ditolak'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pengajuan_banding', [
            'id' => $appeal->id,
            'status' => 'ditolak'
        ]);

        $this->assertDatabaseMissing('pemulihan_akses', [
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'status_pemulihan' => 'aktif'
        ]);
    }

    /** 14. Recovery / SSL A -> normal submission B unaffected */
    public function test_14_recovery_on_subject_a_does_not_affect_subject_b(): void
    {
        $a1 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectA->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Overdue A1',
            'deadline' => now()->subDays(5),
            'status' => 'aktif'
        ]);

        PemulihanPengumpulan::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'tugas_id' => $a1->id,
            'status_pemulihan' => 'aktif',
            'durasi_jam' => 24,
            'mulai_pemulihan' => now(),
            'batas_pemulihan' => now()->addHours(24)
        ]);

        $activeB1 = Tugas::create([
            'mata_pelajaran_id' => $this->subjectB->id,
            'kelas_id' => $this->classRoom->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Aktif B1',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentUser);

        // Normal submit B1 -> ALLOWED
        $fileB1 = UploadedFile::fake()->create('jawaban_b1.pdf', 100, 'application/pdf');
        $response = $this->post(route('assignments.submit', $activeB1->id), ['file' => $fileB1]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pengumpulan_tugas', [
            'tugas_id' => $activeB1->id,
            'siswa_id' => $this->student->id
        ]);
    }
}
