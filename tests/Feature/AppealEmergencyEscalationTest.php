<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\Banding;
use App\Models\Guru;
use App\Models\GuruKelas;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\PemulihanPengumpulan;
use App\Models\Pengumpulan;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AppealEmergencyEscalationTest extends TestCase
{
    use RefreshDatabase;

    private $studentUser;
    private $student;
    private $student2;
    private $studentUser2;
    private $teacherUser;
    private $teacher;
    private $homeroomTeacherUser;
    private $homeroomTeacher;
    private $adminUser;
    private $subjectA;
    private $classRoom;
    private $classRoom2;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        // 1. Create Homeroom Teacher
        $this->homeroomTeacher = Guru::create([
            'nip' => '198501012010011002',
            'nama' => 'Wali Kelas Test',
            'email' => 'walikelas@smansago.com',
            'status' => 'aktif',
        ]);
        $this->homeroomTeacherUser = User::create([
            'nama' => 'Wali Kelas Test',
            'email' => 'walikelas@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);
        $this->homeroomTeacher->update(['pengguna_id' => $this->homeroomTeacherUser->id]);

        // 2. Create Classes
        $this->classRoom = Kelas::create([
            'name' => 'X-1',
            'grade_level' => 'X',
            'tingkat' => 'X',
            'jurusan' => 'Umum',
            'tahunAjaran' => '2025/2026',
            'academic_year' => '2025/2026',
            'kapasitasMaksimal' => 36,
            'homeroom_teacher_id' => $this->homeroomTeacher->id,
        ]);

        $this->classRoom2 = Kelas::create([
            'name' => 'X-2',
            'grade_level' => 'X',
            'tingkat' => 'X',
            'jurusan' => 'Umum',
            'tahunAjaran' => '2025/2026',
            'academic_year' => '2025/2026',
            'kapasitasMaksimal' => 36,
        ]);

        // 3. Create Students
        $this->student = Siswa::create([
            'nis' => '23241001',
            'nama' => 'Siswa Kelas 1',
            'kelas' => 'X-1',
            'status' => 'aktif',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2009-01-01',
        ]);
        $this->studentUser = User::create([
            'nama' => 'Siswa Kelas 1',
            'email' => 'siswa1@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
        $this->student->update(['pengguna_id' => $this->studentUser->id]);

        $this->student2 = Siswa::create([
            'nis' => '23241002',
            'nama' => 'Siswa Kelas 2',
            'kelas' => 'X-2',
            'status' => 'aktif',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '2009-02-02',
        ]);
        $this->studentUser2 = User::create([
            'nama' => 'Siswa Kelas 2',
            'email' => 'siswa2@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
        $this->student2->update(['pengguna_id' => $this->studentUser2->id]);

        // 4. Create Subject Teacher
        $this->teacher = Guru::create([
            'nip' => '198001012010011001',
            'nama' => 'Guru Mapel Test',
            'email' => 'gurumapel@smansago.com',
            'status' => 'aktif',
        ]);
        $this->teacherUser = User::create([
            'nama' => 'Guru Mapel Test',
            'email' => 'gurumapel@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);
        $this->teacher->update(['pengguna_id' => $this->teacherUser->id]);

        // 5. Create Super Admin
        $this->adminUser = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 6. Create Subject & Assignment Mapping
        $this->subjectA = JadwalPelajaran::create([
            'kode' => 'MAT-X',
            'nama' => 'Matematika',
            'tingkat' => 'X',
            'status' => 'aktif',
        ]);

        GuruKelas::create([
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->classRoom->id,
            'mata_pelajaran_id' => $this->subjectA->id,
        ]);

        GuruKelas::create([
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->classRoom2->id,
            'mata_pelajaran_id' => $this->subjectA->id,
        ]);
    }

    private function createOverdueTasks($count = 3, $student = null, $classRoom = null)
    {
        $student = $student ?? $this->student;
        $classRoom = $classRoom ?? ($student->kelas === 'X-2' ? $this->classRoom2 : $this->classRoom);
        $tasks = collect();
        for ($i = 1; $i <= $count; $i++) {
            $tasks->push(Tugas::create([
                'mata_pelajaran_id' => $this->subjectA->id,
                'kelas_id' => $classRoom->id,
                'guru_id' => $this->teacher->id,
                'judul' => "Tugas Overdue {$student->id} - {$i}",
                'deadline' => Carbon::now()->subDays($count - $i + 1),
                'status' => 'aktif',
            ]));
        }
        return $tasks;
    }

    /** 1. Guru mapel dapat menyetujui banding dalam 24 jam pertama -> mode normal */
    public function test_01_subject_teacher_can_approve_within_initial_window(): void
    {
        $tasks = $this->createOverdueTasks(3);

        $appeal = Banding::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'alasan' => 'Sakit demam',
            'status' => 'ditinjau',
            'tingkat_eskalasi' => 'guru',
            'created_at' => Carbon::now()->subHours(2),
        ]);

        $this->actingAs($this->teacherUser);

        $response = $this->post(route('appeals.approve', $appeal->id), [
            'duration' => 48,
            'tanggapan_guru' => 'Disetujui, silakan kerjakan.',
        ]);

        $response->assertRedirect();
        $appeal->refresh();
        $this->assertEquals('approved', $appeal->status);

        $recovery = PemulihanPengumpulan::where('siswa_id', $this->student->id)->first();
        $this->assertNotNull($recovery);
        $this->assertEquals('aktif', $recovery->status_pemulihan);
        $this->assertEquals('normal', $recovery->tipe_pemulihan);
        $this->assertEquals($tasks->first()->id, $recovery->tugas_id);
    }

    /** 2. Wali kelas diblokir jika mencoba memproses banding < 24 jam saat guru aktif */
    public function test_02_wali_kelas_cannot_approve_early_when_subject_teacher_is_active(): void
    {
        $this->createOverdueTasks(3);

        $appeal = Banding::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'alasan' => 'Izin keluarga',
            'status' => 'ditinjau',
            'tingkat_eskalasi' => 'guru',
            'created_at' => Carbon::now()->subHours(5), // < 24 jam
        ]);

        $this->actingAs($this->homeroomTeacherUser);

        $response = $this->post(route('appeals.approve', $appeal->id), [
            'duration' => 48,
        ]);

        $response->assertStatus(403);
    }

    /** 3. Wali kelas dapat memproses banding siswa kelasnya jika banding > 24 jam (ter-eskalasi) */
    public function test_03_wali_kelas_can_approve_when_appeal_is_escalated_or_older_than_24_hours(): void
    {
        $tasks = $this->createOverdueTasks(3);

        $appeal = Banding::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'alasan' => 'Izin keluarga',
            'status' => 'ditinjau',
            'tingkat_eskalasi' => 'wali_kelas',
            'created_at' => Carbon::now()->subHours(26), // > 24 jam
        ]);

        $this->actingAs($this->homeroomTeacherUser);

        $response = $this->post(route('appeals.approve', $appeal->id), [
            'duration' => 48,
            'tanggapan_guru' => 'Disetujui oleh Wali Kelas.',
        ]);

        $response->assertRedirect();
        $appeal->refresh();
        $this->assertEquals('approved', $appeal->status);

        $recovery = PemulihanPengumpulan::where('siswa_id', $this->student->id)->first();
        $this->assertNotNull($recovery);
        $this->assertEquals('emergency_override', $recovery->tipe_pemulihan);
        $this->assertEquals($this->homeroomTeacherUser->id, $recovery->dibuka_oleh);

        // Assert emergency log created
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'EMERGENCY_OVERRIDE',
            'user_id' => $this->homeroomTeacherUser->id,
        ]);
    }

    /** 4. Wali kelas TIDAK DAPAT memproses banding untuk siswa dari kelas lain */
    public function test_04_wali_kelas_cannot_approve_appeal_for_student_in_different_class(): void
    {
        $this->createOverdueTasks(3, $this->student2);

        $appealClass2 = Banding::create([
            'siswa_id' => $this->student2->id, // Siswa kelas X-2 (bukan perwalian)
            'mata_pelajaran_id' => $this->subjectA->id,
            'alasan' => 'Izin sakit',
            'status' => 'ditinjau',
            'tingkat_eskalasi' => 'wali_kelas',
            'created_at' => Carbon::now()->subHours(30),
        ]);

        $this->actingAs($this->homeroomTeacherUser);

        $response = $this->post(route('appeals.approve', $appealClass2->id), [
            'duration' => 48,
        ]);

        $response->assertStatus(403);
    }

    /** 5. Jika guru mapel statusnya nonaktif, Wali Kelas dapat menyetujui langsung tanpa menunggu 24 jam */
    public function test_05_wali_kelas_can_approve_immediately_if_subject_teacher_is_inactive(): void
    {
        $this->createOverdueTasks(3);

        // Set subject teacher status to nonaktif
        $this->teacher->update(['status' => 'nonaktif']);

        $appeal = Banding::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'alasan' => 'Guru sakit/nonaktif',
            'status' => 'ditinjau',
            'tingkat_eskalasi' => 'guru',
            'created_at' => Carbon::now()->subHours(2), // Masih baru (<24 jam)
        ]);

        $this->actingAs($this->homeroomTeacherUser);

        $response = $this->post(route('appeals.approve', $appeal->id), [
            'duration' => 24,
            'tanggapan_guru' => 'Disetujui darurat karena guru nonaktif.',
        ]);

        $response->assertRedirect();
        $appeal->refresh();
        $this->assertEquals('approved', $appeal->status);
    }

    /** 6. Artisan command mengeskalasi banding ke wali_kelas (>24j) dan admin (>48j) */
    public function test_06_console_command_escalates_to_wali_kelas_and_admin_according_to_sla(): void
    {
        $this->createOverdueTasks(3);

        $appeal25h = Banding::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'alasan' => 'Banding 25 Jam',
            'status' => 'ditinjau',
            'tingkat_eskalasi' => 'guru',
        ]);
        $appeal25h->created_at = Carbon::now()->subHours(25);
        $appeal25h->save(['timestamps' => false]);

        $appeal50h = Banding::create([
            'siswa_id' => $this->student2->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'alasan' => 'Banding 50 Jam',
            'status' => 'ditinjau',
            'tingkat_eskalasi' => 'guru',
        ]);
        $appeal50h->created_at = Carbon::now()->subHours(50);
        $appeal50h->save(['timestamps' => false]);

        $this->artisan('appeals:escalate-sla')->assertExitCode(0);

        $appeal25h->refresh();
        $this->assertEquals('wali_kelas', $appeal25h->tingkat_eskalasi);

        $appeal50h->refresh();
        $this->assertEquals('admin', $appeal50h->tingkat_eskalasi);
    }

    /** 7. Artisan command memicu Provisional Unlock 24 jam jika pending > 24 jam tanpa mengubah status banding menjadi approved */
    public function test_07_console_command_triggers_provisional_unlock_without_marking_appeal_as_approved(): void
    {
        $tasks = $this->createOverdueTasks(3);

        $appeal = Banding::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'alasan' => 'Menunggu guru',
            'status' => 'ditinjau',
            'tingkat_eskalasi' => 'guru',
        ]);
        $appeal->created_at = Carbon::now()->subHours(26);
        $appeal->save(['timestamps' => false]);

        $this->artisan('appeals:escalate-sla')->assertExitCode(0);

        $appeal->refresh();
        // Status banding TETAP pending/ditinjau (Bukan approved!)
        $this->assertEquals('pending', $appeal->status);
        $this->assertTrue((bool)$appeal->is_provisional_unlocked);
        $this->assertNotNull($appeal->provisional_unlocked_at);

        // Record pemulihan dibuat dengan tipe provisional
        $recovery = PemulihanPengumpulan::where('siswa_id', $this->student->id)->first();
        $this->assertNotNull($recovery);
        $this->assertEquals('aktif', $recovery->status_pemulihan);
        $this->assertEquals('provisional', $recovery->tipe_pemulihan);
        $this->assertEquals($tasks->first()->id, $recovery->tugas_id);

        $this->assertDatabaseHas('activity_logs', [
            'action' => 'PROVISIONAL_UNLOCK',
        ]);
    }

    /** 8. Dalam status provisional recovery, siswa dapat submit tugas dan target otomatis maju ke tugas berikutnya (submit-driven) */
    public function test_08_provisional_recovery_allows_submission_and_advances_to_next_task(): void
    {
        $tasks = $this->createOverdueTasks(3);
        $t1 = $tasks[0];
        $t2 = $tasks[1];
        $t3 = $tasks[2];

        $recovery = PemulihanPengumpulan::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'status_pemulihan' => 'aktif',
            'tipe_pemulihan' => 'provisional',
            'durasi_jam' => 24,
            'tugas_id' => $t1->id,
            'mulai_pemulihan' => Carbon::now(),
            'batas_pemulihan' => Carbon::now()->addHours(24),
        ]);

        $this->actingAs($this->studentUser);

        // Submit target tugas 1
        $file = UploadedFile::fake()->create('tugas1.pdf', 100, 'application/pdf');
        $res = $this->post(route('assignments.submit', $t1->id), ['file' => $file]);
        $res->assertRedirect();

        $recovery->refresh();
        // Target langsung berpindah ke t2 tanpa menunggu guru menilai
        $this->assertEquals('aktif', $recovery->status_pemulihan);
        $this->assertEquals($t2->id, $recovery->tugas_id);
    }

    /** 9. Super Admin dapat melakukan Pelepasan Darurat Massal (Mass Emergency Release) */
    public function test_09_superadmin_can_perform_mass_emergency_release_with_audit_log(): void
    {
        $this->createOverdueTasks(3, $this->student);
        $this->createOverdueTasks(3, $this->student2);

        $this->actingAs($this->adminUser);

        $response = $this->post(route('appeals.mass_emergency_release'), [
            'target_type' => 'all',
            'duration' => 48,
            'alasan_darurat' => 'Gangguan jaringan sekolah selama ujian berlangsung',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $rec1 = PemulihanPengumpulan::where('siswa_id', $this->student->id)->first();
        $rec2 = PemulihanPengumpulan::where('siswa_id', $this->student2->id)->first();

        $this->assertNotNull($rec1);
        $this->assertNotNull($rec2);
        $this->assertEquals('emergency_override', $rec1->tipe_pemulihan);
        $this->assertEquals('emergency_override', $rec2->tipe_pemulihan);

        $this->assertDatabaseHas('activity_logs', [
            'action' => 'MASS_EMERGENCY_RELEASE',
            'user_id' => $this->adminUser->id,
        ]);
    }

    /** 10. Menolak banding menghentikan (expire) sesi provisional unlock */
    public function test_10_rejecting_appeal_expires_provisional_unlock_session(): void
    {
        $tasks = $this->createOverdueTasks(3);

        $appeal = Banding::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'alasan' => 'Alasan palsu',
            'status' => 'ditinjau',
            'tingkat_eskalasi' => 'wali_kelas',
            'created_at' => Carbon::now()->subHours(25),
            'is_provisional_unlocked' => true,
        ]);

        $recovery = PemulihanPengumpulan::create([
            'siswa_id' => $this->student->id,
            'mata_pelajaran_id' => $this->subjectA->id,
            'status_pemulihan' => 'aktif',
            'tipe_pemulihan' => 'provisional',
            'durasi_jam' => 24,
            'tugas_id' => $tasks->first()->id,
            'mulai_pemulihan' => Carbon::now(),
            'batas_pemulihan' => Carbon::now()->addHours(24),
        ]);

        $this->actingAs($this->homeroomTeacherUser);

        $response = $this->post(route('appeals.reject', $appeal->id), [
            'tanggapan_guru' => 'Bukti surat dokter palsu.',
        ]);

        $response->assertRedirect();
        $appeal->refresh();
        $this->assertEquals('rejected', $appeal->status);

        $recovery->refresh();
        $this->assertEquals('expired', $recovery->status_pemulihan);
    }
}
