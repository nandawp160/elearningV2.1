<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\JadwalPelajaran;
use App\Models\GuruKelas;
use App\Models\Tugas;
use App\Models\Pengumpulan;
use App\Models\Nilai;
use App\Services\AdaptiveAccessService;
use App\Enums\AdaptiveAccessStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SubmissionValidationAndRevisionTest extends TestCase
{
    use RefreshDatabase;

    private User $teacherUser;
    private Guru $teacher;
    private User $studentUser;
    private Siswa $student;
    private Kelas $kelas;
    private JadwalPelajaran $subject;
    private Tugas $task;
    private AdaptiveAccessService $adaptiveService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\Illuminate\Routing\Middleware\ThrottleRequests::class);
        Storage::fake('public');

        $this->adaptiveService = app(AdaptiveAccessService::class);

        $this->kelas = Kelas::create([
            'name' => 'XII F 3.1',
            'grade_level' => 'XII',
            'tingkat' => 'XII',
            'tahun_ajaran' => '2025/2026',
            'academic_year' => '2025/2026',
        ]);

        $this->teacher = Guru::create([
            'nama' => 'Lanjar Setyowati, S.Pd',
            'nip' => '198001012005012001',
            'email' => 'lanjar@smansago.sch.id',
            'status' => 'aktif',
        ]);

        $this->teacherUser = User::create([
            'nama' => 'Lanjar Setyowati, S.Pd',
            'email' => 'lanjar@smansago.sch.id',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);
        $this->teacher->update(['pengguna_id' => $this->teacherUser->id]);

        $this->subject = JadwalPelajaran::create([
            'kode' => 'BIG-TL',
            'nama' => 'Bahasa Inggris Tingkat Lanjut',
            'tingkat' => 'XII',
            'status' => 'aktif',
        ]);

        GuruKelas::create([
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->kelas->id,
            'mata_pelajaran_id' => $this->subject->id,
        ]);

        $this->student = Siswa::create([
            'nama' => 'ALMIRA IKSANIA PUTRI',
            'nis' => '25109',
            'kelas' => 'XII F 3.1',
            'status' => 'aktif',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '2008-05-15',
        ]);

        $this->studentUser = User::create([
            'nama' => 'ALMIRA IKSANIA PUTRI',
            'email' => 'almira@student.smansago.sch.id',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
        $this->student->update(['pengguna_id' => $this->studentUser->id]);

        $this->task = Tugas::create([
            'judul' => 'Tugas 1 Analisis Teks Analytical Exposition',
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->kelas->id,
            'deadline' => Carbon::now()->subDays(2),
            'status' => 'aktif',
            'max_score' => 100,
            'type' => 'essay',
        ]);
    }

    public function test_teacher_can_return_student_submission_for_revision_with_notes(): void
    {
        $submission = Pengumpulan::create([
            'tugas_id' => $this->task->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now()->subDays(1),
            'file_tugas' => 'submissions/sample.pdf',
            'status' => 'submitted',
            'original_name' => 'sample.pdf',
        ]);

        // Beri nilai terlebih dahulu
        Nilai::create([
            'submission_id' => $submission->id,
            'subject_id' => $this->subject->id,
            'student_id' => $this->student->id,
            'type' => 'assignment',
            'score' => 80,
            'max_score' => 100,
            'graded_by' => $this->teacher->id,
            'graded_at' => Carbon::now(),
        ]);

        $response = $this->actingAs($this->teacherUser)
            ->postJson(route('submissions.return-revision', $submission), [
                'alasan' => 'Berkas kosong dan tidak ada teks esai. Harap unggah berkas yang benar.',
            ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'status_label' => 'Return Jawaban',
                'status_type' => 'needs_revision',
            ]);

        $submission->refresh();
        $this->assertEquals('needs_revision', $submission->status);
        $this->assertTrue($submission->is_needs_revision);
        $this->assertEquals('Berkas kosong dan tidak ada teks esai. Harap unggah berkas yang benar.', $submission->alasan_pengembalian);
        $this->assertNotNull($submission->dikembalikan_pada);
        $this->assertEquals($this->teacherUser->id, $submission->dikembalikan_oleh);

        // Grade should be deleted upon return
        $this->assertNull($submission->grade);
    }

    public function test_unauthorized_user_cannot_return_submission(): void
    {
        $submission = Pengumpulan::create([
            'tugas_id' => $this->task->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now()->subDays(1),
            'file_tugas' => 'submissions/sample.pdf',
            'status' => 'submitted',
            'original_name' => 'sample.pdf',
        ]);

        $response = $this->actingAs($this->studentUser)
            ->postJson(route('submissions.return-revision', $submission), [
                'alasan' => 'Mencoba mengembalikan sendiri.',
            ]);

        $response->assertStatus(403);
    }

    public function test_returned_submission_counts_as_overdue_in_adaptive_access_service(): void
    {
        // Siswa mengunggah berkas asal-asalan (awalnya status submitted)
        $submission = Pengumpulan::create([
            'tugas_id' => $this->task->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now()->subDays(1),
            'file_tugas' => 'submissions/fake.pdf',
            'status' => 'submitted',
            'original_name' => 'fake.pdf',
        ]);

        // Saat berstatus submitted, tunggakan = 0
        $statusBefore = $this->adaptiveService->evaluateSubjectAccess($this->student, $this->subject);
        $this->assertEquals(0, $statusBefore->jumlahTunggakan);
        $this->assertEquals(AdaptiveAccessStatus::NORMAL, $statusBefore->status);

        // Guru mengembalikan jawaban karena tidak valid
        $res = $this->actingAs($this->teacherUser)
            ->postJson(route('submissions.return-revision', $submission), [
                'alasan' => 'Berkas corrupt / tidak terbaca.',
            ]);
        $res->assertOk();

        $submission->refresh();
        $this->assertEquals('needs_revision', $submission->status);

        // Setelah dikembalikan, tugas deadline lampau langsung terhitung kembali sebagai tunggakan!
        $statusAfter = $this->adaptiveService->evaluateSubjectAccess($this->student, $this->subject);
        $this->assertEquals(1, $statusAfter->jumlahTunggakan);
        $this->assertEquals(AdaptiveAccessStatus::WARNING, $statusAfter->status);
    }

    public function test_student_can_resubmit_and_replace_returned_submission(): void
    {
        $oldFile = UploadedFile::fake()->create('old_fake.pdf', 100);
        $oldPath = $oldFile->store('submissions/' . $this->task->id . '/' . $this->student->id, 'public');

        $submission = Pengumpulan::create([
            'tugas_id' => $this->task->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now()->subDays(1),
            'file_tugas' => $oldPath,
            'status' => 'needs_revision',
            'original_name' => 'old_fake.pdf',
            'alasan_pengembalian' => 'Harap upload esai lengkap.',
            'dikembalikan_pada' => Carbon::now(),
            'dikembalikan_oleh' => $this->teacherUser->id,
            'revisi_ke' => 0,
        ]);

        // Cek evaluasi akses mengizinkan revisi
        $decision = $this->adaptiveService->evaluateTaskSubmission($this->student, $this->task);
        $this->assertTrue($decision->allowed);
        $this->assertEquals('REVISION_ALLOWED', $decision->reasonCode);

        // Siswa mengunggah berkas baru
        $newFile = UploadedFile::fake()->create('essay_revisi_almira.pdf', 250);

        $response = $this->actingAs($this->studentUser)
            ->post(route('submissions.store', $this->task), [
                'file' => $newFile,
            ]);

        $response->assertSessionHas('success');

        $submission->refresh();
        $this->assertEquals('late', $submission->status); // Deadline lampau -> status late
        $this->assertEquals('essay_revisi_almira.pdf', $submission->original_name);
        $this->assertEquals(1, $submission->revisi_ke);
        $this->assertNull($submission->alasan_pengembalian);
        $this->assertNull($submission->dikembalikan_pada);
        $this->assertNull($submission->dikembalikan_oleh);

        // Berkas lama di storage terhapus
        Storage::disk('public')->assertMissing($oldPath);
        // Berkas baru tersimpan
        Storage::disk('public')->assertExists($submission->file_tugas);
    }

    public function test_multiple_returned_submissions_trigger_ssl_locked_and_allow_targeted_revisions(): void
    {
        // 1. Setup 3 tugas lampau (Tugas 1, 2, 3) dan 1 tugas aktif baru (Tugas 4)
        $task1 = $this->task; // deadline 2 hari lalu

        $task2 = Tugas::create([
            'judul' => 'Tugas 2 Review Jurnal',
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->kelas->id,
            'deadline' => Carbon::now()->subDays(5),
            'status' => 'aktif',
            'max_score' => 100,
            'type' => 'essay',
        ]);

        $task3 = Tugas::create([
            'judul' => 'Tugas 3 Analisis Puisi',
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->kelas->id,
            'deadline' => Carbon::now()->subDays(8),
            'status' => 'aktif',
            'max_score' => 100,
            'type' => 'essay',
        ]);

        $task4New = Tugas::create([
            'judul' => 'Tugas 4 Materi Baru',
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->kelas->id,
            'deadline' => Carbon::now()->addDays(3),
            'status' => 'aktif',
            'max_score' => 100,
            'type' => 'essay',
        ]);

        // 2. Siswa mengunggah berkas asal-asalan ke Tugas 1, 2, dan 3
        $sub1 = Pengumpulan::create([
            'tugas_id' => $task1->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now()->subDays(3),
            'file_tugas' => 'submissions/fake1.pdf',
            'status' => 'submitted',
            'original_name' => 'fake1.pdf',
        ]);

        $sub2 = Pengumpulan::create([
            'tugas_id' => $task2->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now()->subDays(6),
            'file_tugas' => 'submissions/fake2.pdf',
            'status' => 'submitted',
            'original_name' => 'fake2.pdf',
        ]);

        $sub3 = Pengumpulan::create([
            'tugas_id' => $task3->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now()->subDays(9),
            'file_tugas' => 'submissions/fake3.pdf',
            'status' => 'submitted',
            'original_name' => 'fake3.pdf',
        ]);

        // Kondisi awal sebelum diretur: Tunggakan = 0, Status NORMAL
        $statusInitial = $this->adaptiveService->evaluateSubjectAccess($this->student, $this->subject);
        $this->assertEquals(0, $statusInitial->jumlahTunggakan);
        $this->assertEquals(AdaptiveAccessStatus::NORMAL, $statusInitial->status);

        // 3. Guru memeriksa dan me-retur ketiga tugas karena tidak valid (misal berkas kosong/corrupt)
        $this->teacherUser->refresh();
        $this->actingAs($this->teacherUser)->postJson(route('submissions.return-revision', $sub1), ['alasan' => 'File kosong'])->assertOk();
        $this->actingAs($this->teacherUser)->postJson(route('submissions.return-revision', $sub2), ['alasan' => 'File corrupt'])->assertOk();
        $this->actingAs($this->teacherUser)->postJson(route('submissions.return-revision', $sub3), ['alasan' => 'Format salah'])->assertOk();

        $sub1->refresh();
        $sub2->refresh();
        $sub3->refresh();
        $this->assertEquals('needs_revision', $sub1->status);
        $this->assertEquals('needs_revision', $sub2->status);
        $this->assertEquals('needs_revision', $sub3->status);

        // 4. Evaluasi Subject Access: Total tunggakan menjadi 3 (mencapai threshold default = 3) -> Status LOCKED
        $statusAfterReturn = $this->adaptiveService->evaluateSubjectAccess($this->student, $this->subject);
        $this->assertEquals(3, $statusAfterReturn->jumlahTunggakan);
        $this->assertEquals(AdaptiveAccessStatus::LOCKED, $statusAfterReturn->status);

        // 5. Cek akses pengumpulan tugas:
        // - Tugas baru (Task 4) HARUS DIBLOKIR dengan alasan LOCKED_BY_RETURNED_TASKS
        $decisionTask4 = $this->adaptiveService->evaluateTaskSubmission($this->student, $task4New);
        $this->assertFalse($decisionTask4->allowed);
        $this->assertEquals('LOCKED_BY_RETURNED_TASKS', $decisionTask4->reasonCode);
        $this->assertEquals(3, $decisionTask4->returnedCount);

        // - Tugas yang diretur (Task 1, 2, 3) TETAP DIIZINKAN untuk direvisi (Upload Ulang)
        $decisionTask1 = $this->adaptiveService->evaluateTaskSubmission($this->student, $task1);
        $this->assertTrue($decisionTask1->allowed);
        $this->assertEquals('REVISION_ALLOWED', $decisionTask1->reasonCode);

        // 6. Siswa mengunggah perbaikan untuk Tugas 1
        $this->flushSession();
        $this->studentUser->refresh();
        $fixedFile = UploadedFile::fake()->create('jawaban_sah_task1.pdf', 200);
        $res = $this->actingAs($this->studentUser)
            ->post(route('submissions.store', $task1), [
                'file' => $fixedFile,
            ]);
        $res->assertSessionHas('success');

        // 7. Guru memvalidasi dan memberi nilai pada perbaikan Tugas 1
        $this->flushSession();
        $this->teacherUser->refresh();
        $gradeRes = $this->actingAs($this->teacherUser)->post(route('submissions.grade', $sub1->fresh()), [
            'score' => 90,
            'feedback' => 'Revisi tugas telah diperiksa dan disetujui.',
        ]);
        $gradeRes->assertSessionHas('success');

        // 8. Setelah Tugas 1 divalidasi guru: tunggakan berkurang dari 3 menjadi 2 -> Status turun dari LOCKED ke WARNING
        $statusAfterFix = $this->adaptiveService->evaluateSubjectAccess($this->student, $this->subject);
        $this->assertEquals(2, $statusAfterFix->jumlahTunggakan);
        $this->assertEquals(AdaptiveAccessStatus::WARNING, $statusAfterFix->status);

        // Akses Tugas 4 (tugas baru) otomatis TERBUKA KEMBALI karena tunggakan < threshold!
        $decisionTask4AfterFix = $this->adaptiveService->evaluateTaskSubmission($this->student, $task4New);
        $this->assertTrue($decisionTask4AfterFix->allowed);
        $this->assertEquals('ALLOWED_WARNING', $decisionTask4AfterFix->reasonCode);
    }

    public function test_late_unvalidated_submissions_remain_overdue_and_trigger_ssl_lock(): void
    {
        // Setup 3 tugas lampau (deadlines in the past)
        $t1 = $this->task;
        $t2 = Tugas::create([
            'judul' => 'Tugas 2',
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->kelas->id,
            'deadline' => Carbon::now()->subDays(4),
            'status' => 'aktif',
            'max_score' => 100,
            'type' => 'essay',
        ]);
        $t3 = Tugas::create([
            'judul' => 'Tugas 3',
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->kelas->id,
            'deadline' => Carbon::now()->subDays(6),
            'status' => 'aktif',
            'max_score' => 100,
            'type' => 'essay',
        ]);
        $t4New = Tugas::create([
            'judul' => 'Tugas 4 Minggu Ini',
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->kelas->id,
            'deadline' => Carbon::now()->addDays(3),
            'status' => 'aktif',
            'max_score' => 100,
            'type' => 'essay',
        ]);

        // Siswa mengumpulkan berkas terlambat (status: late) pada t1, t2, t3
        Pengumpulan::create([
            'tugas_id' => $t1->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now()->subDays(1),
            'file_tugas' => 'submissions/late1.pdf',
            'status' => 'late',
            'original_name' => 'late1.pdf',
        ]);
        Pengumpulan::create([
            'tugas_id' => $t2->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now()->subDays(1),
            'file_tugas' => 'submissions/late2.pdf',
            'status' => 'late',
            'original_name' => 'late2.pdf',
        ]);
        Pengumpulan::create([
            'tugas_id' => $t3->id,
            'siswa_id' => $this->student->id,
            'tanggal_pengumpulan' => Carbon::now()->subDays(1),
            'file_tugas' => 'submissions/late3.pdf',
            'status' => 'late',
            'original_name' => 'late3.pdf',
        ]);

        // Sebelum divalidasi guru: ketiga tugas terlambat tetap dihitung sebagai tunggakan aktif -> Status LOCKED!
        $status = $this->adaptiveService->evaluateSubjectAccess($this->student, $this->subject);
        $this->assertEquals(3, $status->jumlahTunggakan);
        $this->assertEquals(AdaptiveAccessStatus::LOCKED, $status->status);

        // Tugas baru (t4New) terblokir oleh SSL
        $decT4 = $this->adaptiveService->evaluateTaskSubmission($this->student, $t4New);
        $this->assertFalse($decT4->allowed);
        $this->assertEquals('LOCKED_BY_SSL', $decT4->reasonCode);
    }

    public function test_empty_zero_byte_file_is_rejected_by_validator(): void
    {
        // File 0 byte (empty)
        $emptyFile = UploadedFile::fake()->create('empty.pdf', 0);

        $this->flushSession();
        $this->studentUser->refresh();

        $response = $this->actingAs($this->studentUser)
            ->post(route('submissions.store', $this->task), [
                'file' => $emptyFile,
            ]);

        $response->assertSessionHasErrors(['file']);
    }
}


