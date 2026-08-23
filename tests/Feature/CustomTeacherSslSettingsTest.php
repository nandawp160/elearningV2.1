<?php

namespace Tests\Feature;

use App\Enums\AdaptiveAccessStatus;
use App\Models\ActivityLog;
use App\Models\Guru;
use App\Models\GuruKelas;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\PemulihanPengumpulan;
use App\Models\Pengaturan;
use App\Models\Pengumpulan;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\User;
use App\Services\AdaptiveAccessService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CustomTeacherSslSettingsTest extends TestCase
{
    use RefreshDatabase;

    private User $teacherUser;
    private Guru $teacher;
    private User $otherTeacherUser;
    private Guru $otherTeacher;
    private Kelas $classA;
    private Kelas $classB;
    private Kelas $classC;
    private JadwalPelajaran $subjectMath;
    private JadwalPelajaran $subjectEnglish;
    private Siswa $studentA;
    private Siswa $studentB;
    private AdaptiveAccessService $adaptiveService;

    protected function setUp(): void
    {
        parent::setUp();
        Pengaturan::clearCache();

        $this->adaptiveService = app(AdaptiveAccessService::class);

        // 1. Classes
        $this->classA = Kelas::create(['name' => 'XII F 3.1', 'tingkat' => 'XII', 'jurusan' => 'F', 'academic_year' => '2025/2026', 'tahunAjaran' => '2025/2026']);
        $this->classB = Kelas::create(['name' => 'XII F 3.2', 'tingkat' => 'XII', 'jurusan' => 'F', 'academic_year' => '2025/2026', 'tahunAjaran' => '2025/2026']);
        $this->classC = Kelas::create(['name' => 'XI MIPA 1', 'tingkat' => 'XI', 'jurusan' => 'MIPA', 'academic_year' => '2025/2026', 'tahunAjaran' => '2025/2026']);

        // 2. Teachers & Users
        $this->teacher = Guru::create(['nama' => 'Guru Matematika', 'nip' => '19800101', 'jenis_kelamin' => 'Laki-laki', 'status' => 'aktif']);
        $this->teacherUser = User::create([
            'nama' => 'Guru Matematika',
            'email' => 'math.teacher@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
            'is_active' => true,
        ]);
        $this->teacher->update(['pengguna_id' => $this->teacherUser->id]);

        $this->otherTeacher = Guru::create(['nama' => 'Guru Lain', 'nip' => '19850202', 'jenis_kelamin' => 'Perempuan', 'status' => 'aktif']);
        $this->otherTeacherUser = User::create([
            'nama' => 'Guru Lain',
            'email' => 'other.teacher@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
            'is_active' => true,
        ]);
        $this->otherTeacher->update(['pengguna_id' => $this->otherTeacherUser->id]);

        // 3. Master Subjects & Schedules
        $this->subjectMath = JadwalPelajaran::create([
            'kode' => 'MAT-XII',
            'nama' => 'Matematika Peminatan',
            'tingkat' => 'XII',
            'status' => 'aktif',
        ]);

        $this->subjectEnglish = JadwalPelajaran::create([
            'kode' => 'ENG-XII',
            'nama' => 'Bahasa Inggris',
            'tingkat' => 'XII',
            'status' => 'aktif',
        ]);

        // 4. Teaching Assignments (GuruKelas)
        // Teacher teaches Math in Class A and Class B
        GuruKelas::create(['guru_id' => $this->teacher->id, 'kelas_id' => $this->classA->id, 'mata_pelajaran_id' => $this->subjectMath->id, 'ssl_threshold' => null]);
        GuruKelas::create(['guru_id' => $this->teacher->id, 'kelas_id' => $this->classB->id, 'mata_pelajaran_id' => $this->subjectMath->id, 'ssl_threshold' => null]);

        // Other Teacher teaches English in Class A
        GuruKelas::create(['guru_id' => $this->otherTeacher->id, 'kelas_id' => $this->classA->id, 'mata_pelajaran_id' => $this->subjectEnglish->id, 'ssl_threshold' => null]);

        // 5. Students
        $this->studentA = Siswa::create(['nis' => '1001', 'nama' => 'Siswa Kelas A', 'kelas' => 'XII F 3.1', 'status' => 'aktif', 'jenis_kelamin' => 'Laki-laki']);
        $this->studentB = Siswa::create(['nis' => '1002', 'nama' => 'Siswa Kelas B', 'kelas' => 'XII F 3.2', 'status' => 'aktif', 'jenis_kelamin' => 'Perempuan']);
    }

    /** @test */
    public function test_default_resolution_uses_school_default_or_fallback_three()
    {
        // No global setting -> Fallback 3
        $resolution = $this->adaptiveService->resolveThreshold($this->studentA, $this->subjectMath->id);
        $this->assertEquals(3, $resolution->effectiveThreshold);
        $this->assertEquals('SYSTEM_FALLBACK', $resolution->source);
        $this->assertNull($resolution->teacherOverride);

        // With global school setting
        Pengaturan::setValue('ssl_threshold', '4');
        $resolution2 = $this->adaptiveService->resolveThreshold($this->studentA, $this->subjectMath->id);
        $this->assertEquals(4, $resolution2->effectiveThreshold);
        $this->assertEquals('SCHOOL_DEFAULT', $resolution2->source);
        $this->assertEquals(4, $resolution2->schoolDefault);

        // Reset global setting
        Pengaturan::where('key', 'ssl_threshold')->delete();
        Pengaturan::clearCache();
    }

    /** @test */
    public function test_teacher_can_update_threshold_for_single_class()
    {
        $this->actingAs($this->teacherUser);

        $response = $this->patchJson(route('assignments.teacher.ssl-threshold.update', [
            'subject' => $this->subjectMath->id,
            'kelas' => $this->classA->id,
        ]), [
            'mode' => 'custom',
            'ssl_threshold' => 1,
            'apply_all_classes' => false,
        ]);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
            'mode' => 'custom',
            'effective_threshold' => 1,
            'source' => 'TEACHER_OVERRIDE',
        ]);

        // Verify Class A has threshold 1
        $gkA = GuruKelas::where('guru_id', $this->teacher->id)->where('kelas_id', $this->classA->id)->first();
        $this->assertEquals(1, $gkA->ssl_threshold);

        // Verify Class B is unchanged (null)
        $gkB = GuruKelas::where('guru_id', $this->teacher->id)->where('kelas_id', $this->classB->id)->first();
        $this->assertNull($gkB->ssl_threshold);
    }

    /** @test */
    public function test_student_in_class_a_is_locked_at_one_overdue_while_class_b_is_not()
    {
        // 1. Set threshold = 1 for Class A
        GuruKelas::where('guru_id', $this->teacher->id)
            ->where('kelas_id', $this->classA->id)
            ->update(['ssl_threshold' => 1]);

        // 2. Create 1 overdue task in Math for Class A
        Tugas::create([
            'mata_pelajaran_id' => $this->subjectMath->id,
            'kelas_id' => $this->classA->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Tugas 1 Overdue',
            'status' => 'aktif',
            'deadline' => Carbon::now()->subDay(),
            'tipe_pengumpulan' => 'dokumen',
        ]);

        // Evaluate Student A (Class A with threshold 1) -> Must be LOCKED
        $resA = $this->adaptiveService->evaluateSubjectAccess($this->studentA, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::LOCKED, $resA->status);
        $this->assertEquals(1, $resA->jumlahTunggakan);
        $this->assertEquals(1, $resA->threshold);
        $this->assertEquals('TEACHER_OVERRIDE', $resA->thresholdSource);

        // Evaluate Student B (Class B with threshold default 3) -> 0 overdue in Class B -> Must be NORMAL
        $resB = $this->adaptiveService->evaluateSubjectAccess($this->studentB, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::NORMAL, $resB->status);
        $this->assertEquals(0, $resB->jumlahTunggakan);
        $this->assertEquals(3, $resB->threshold);
        $this->assertEquals('SYSTEM_FALLBACK', $resB->thresholdSource);
    }

    /** @test */
    public function test_teacher_can_apply_threshold_to_all_active_taught_classes()
    {
        $this->actingAs($this->teacherUser);

        $response = $this->patchJson(route('assignments.teacher.ssl-threshold.update', [
            'subject' => $this->subjectMath->id,
            'kelas' => $this->classA->id,
        ]), [
            'mode' => 'custom',
            'ssl_threshold' => 2,
            'apply_all_classes' => true,
        ]);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
            'effective_threshold' => 2,
        ]);

        // Both Class A and Class B must have ssl_threshold = 2
        $this->assertEquals(2, GuruKelas::where('guru_id', $this->teacher->id)->where('kelas_id', $this->classA->id)->value('ssl_threshold'));
        $this->assertEquals(2, GuruKelas::where('guru_id', $this->teacher->id)->where('kelas_id', $this->classB->id)->value('ssl_threshold'));

        // Other teacher's English subject in Class A must remain unchanged (null)
        $this->assertNull(GuruKelas::where('guru_id', $this->otherTeacher->id)->where('kelas_id', $this->classA->id)->value('ssl_threshold'));
    }

    /** @test */
    public function test_teacher_can_revert_to_default_mode_setting_database_value_to_null()
    {
        // Given existing custom threshold
        GuruKelas::where('guru_id', $this->teacher->id)->update(['ssl_threshold' => 5]);

        $this->actingAs($this->teacherUser);

        $response = $this->patchJson(route('assignments.teacher.ssl-threshold.update', [
            'subject' => $this->subjectMath->id,
            'kelas' => $this->classA->id,
        ]), [
            'mode' => 'default',
            'ssl_threshold' => 99, // Even if manipulated in request, mode=default forces null
            'apply_all_classes' => false,
        ]);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
            'mode' => 'default',
            'source' => 'SYSTEM_FALLBACK',
        ]);

        $this->assertNull(GuruKelas::where('guru_id', $this->teacher->id)->where('kelas_id', $this->classA->id)->value('ssl_threshold'));
    }

    /** @test */
    public function test_validation_rejects_out_of_range_and_invalid_thresholds()
    {
        $this->actingAs($this->teacherUser);

        $invalidValues = [0, -1, 11, 20, 99, 'abc'];

        foreach ($invalidValues as $val) {
            $response = $this->patchJson(route('assignments.teacher.ssl-threshold.update', [
                'subject' => $this->subjectMath->id,
                'kelas' => $this->classA->id,
            ]), [
                'mode' => 'custom',
                'ssl_threshold' => $val,
                'apply_all_classes' => false,
            ]);

            $response->assertStatus(422);
        }
    }

    /** @test */
    public function test_unauthorized_teacher_receives_http_403()
    {
        // Other teacher tries to update Math in Class A (not their subject)
        $this->actingAs($this->otherTeacherUser);

        $response = $this->patchJson(route('assignments.teacher.ssl-threshold.update', [
            'subject' => $this->subjectMath->id,
            'kelas' => $this->classA->id,
        ]), [
            'mode' => 'custom',
            'ssl_threshold' => 2,
        ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function test_active_recovery_session_remains_highest_priority_after_threshold_changes()
    {
        // 1. Create task and overdue
        $task = Tugas::create([
            'mata_pelajaran_id' => $this->subjectMath->id,
            'guru_id' => $this->teacher->id,
            'judul' => 'Tugas Recovery Test',
            'status' => 'aktif',
            'deadline' => Carbon::now()->subDays(2),
            'tipe_pengumpulan' => 'dokumen',
        ]);

        // 2. Active recovery record
        PemulihanPengumpulan::create([
            'siswa_id' => $this->studentA->id,
            'mata_pelajaran_id' => $this->subjectMath->id,
            'tugas_id' => $task->id,
            'status_pemulihan' => 'aktif',
            'batas_pemulihan' => Carbon::now()->addHours(24),
        ]);

        // 3. Teacher changes threshold to 5 (lenient)
        GuruKelas::where('guru_id', $this->teacher->id)->where('kelas_id', $this->classA->id)->update(['ssl_threshold' => 5]);

        // 4. Status must still be RECOVERY, not WARNING or NORMAL
        $result = $this->adaptiveService->evaluateSubjectAccess($this->studentA, $this->subjectMath);
        $this->assertEquals(AdaptiveAccessStatus::RECOVERY, $result->status);
        $this->assertTrue($result->isRecovery());
        $this->assertEquals($task->id, $result->targetTugasId);
    }

    /** @test */
    public function test_audit_log_is_recorded_when_threshold_is_updated()
    {
        $this->actingAs($this->teacherUser);

        $this->patchJson(route('assignments.teacher.ssl-threshold.update', [
            'subject' => $this->subjectMath->id,
            'kelas' => $this->classA->id,
        ]), [
            'mode' => 'custom',
            'ssl_threshold' => 2,
            'apply_all_classes' => false,
        ]);

        $log = ActivityLog::where('action', 'SSL_THRESHOLD_UPDATED')->latest()->first();
        $this->assertNotNull($log);
        $this->assertEquals($this->teacherUser->id, $log->user_id);
        $this->assertStringContainsString('Matematika Peminatan', $log->description);
        $this->assertStringContainsString('XII F 3.1', $log->description);
    }
}
