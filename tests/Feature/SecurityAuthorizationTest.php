<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\JadwalPelajaran;
use App\Models\Tugas;
use App\Models\GuruKelas;
use App\Models\Banding;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $teacherA;
    protected User $teacherB;
    protected User $studentA;
    protected User $studentB;
    protected Guru $guruA;
    protected Guru $guruB;
    protected Siswa $siswaA;
    protected Siswa $siswaB;
    protected Kelas $kelas1;
    protected Kelas $kelas2;
    protected MataPelajaran $courseMath;
    protected MataPelajaran $courseEnglish;
    protected JadwalPelajaran $scheduleMath;
    protected JadwalPelajaran $scheduleEnglish;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Create Admin
        $this->admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@test.com'
        ]);

        // 2. Create Classes
        $this->kelas1 = Kelas::create(['name' => 'XI F 1', 'grade_level' => 'XI', 'academic_year' => '2025/2026']);
        $this->kelas2 = Kelas::create(['name' => 'XI F 2', 'grade_level' => 'XI', 'academic_year' => '2025/2026']);

        // 3. Create Courses
        $this->courseMath = MataPelajaran::create([
            'kode' => 'MATH101', 'name' => 'Matematika', 'grade_level' => 'XI', 'status' => 'active', 'beban_jp' => 4
        ]);
        $this->courseEnglish = MataPelajaran::create([
            'kode' => 'ENG101', 'name' => 'Bahasa Inggris', 'grade_level' => 'XI', 'status' => 'active', 'beban_jp' => 4
        ]);

        // 4. Create Teachers
        $userTeacherA = User::factory()->create(['role' => 'guru', 'email' => 'teachera@test.com']);
        $this->guruA = Guru::create(['pengguna_id' => $userTeacherA->id, 'nip' => '1001', 'nama' => 'Guru A']);
        $this->teacherA = $userTeacherA;

        $userTeacherB = User::factory()->create(['role' => 'guru', 'email' => 'teacherb@test.com']);
        $this->guruB = Guru::create(['pengguna_id' => $userTeacherB->id, 'nip' => '1002', 'nama' => 'Guru B']);
        $this->teacherB = $userTeacherB;

        // Set Guru B as Homeroom Teacher of Kelas 2
        $this->kelas2->update(['homeroom_teacher_id' => $this->guruB->id]);

        // 5. Schedules (JadwalPelajaran maps to mata_pelajaran table)
        $this->scheduleMath = JadwalPelajaran::find($this->courseMath->id);
        $this->scheduleEnglish = JadwalPelajaran::find($this->courseEnglish->id);

        // 6. Assign Guru A -> Math XI F 1
        GuruKelas::create([
            'guru_id' => $this->guruA->id,
            'kelas_id' => $this->kelas1->id,
            'mata_pelajaran_id' => $this->scheduleMath->id
        ]);

        // Assign Guru B -> English XI F 2
        GuruKelas::create([
            'guru_id' => $this->guruB->id,
            'kelas_id' => $this->kelas2->id,
            'mata_pelajaran_id' => $this->scheduleEnglish->id
        ]);

        // 7. Create Students
        $userStudentA = User::factory()->create(['role' => 'siswa', 'email' => 'studenta@test.com']);
        $this->siswaA = Siswa::create([
            'pengguna_id' => $userStudentA->id, 'nis' => '2001', 'nama' => 'Siswa A', 'kelas' => 'XI F 1', 'status' => 'aktif'
        ]);
        $this->studentA = $userStudentA;

        $userStudentB = User::factory()->create(['role' => 'siswa', 'email' => 'studentb@test.com']);
        $this->siswaB = Siswa::create([
            'pengguna_id' => $userStudentB->id, 'nis' => '2002', 'nama' => 'Siswa B', 'kelas' => 'XI F 2', 'status' => 'aktif'
        ]);
        $this->studentB = $userStudentB;
    }

    /** 1. Student & Teacher cannot access or modify course admin endpoints */
    public function test_student_and_teacher_cannot_access_or_modify_courses_endpoints()
    {
        $this->actingAs($this->studentA);
        $this->get(route('courses.index'))->assertStatus(403);
        $this->get(route('courses.create'))->assertStatus(403);
        $this->post(route('courses.store'), ['code' => 'X', 'name' => 'X', 'grade_level' => 'X', 'status' => 'active', 'beban_jp' => 2])->assertStatus(403);

        $this->actingAs($this->teacherA);
        $this->get(route('courses.index'))->assertStatus(403);
    }

    /** 2. Non-admin cannot modify subjects (JadwalPelajaran) endpoints */
    public function test_student_cannot_modify_subjects_endpoints()
    {
        $this->actingAs($this->studentA);
        $this->post(route('subjects.store'), [])->assertStatus(403);
        $this->delete(route('subjects.destroy', $this->scheduleMath->id))->assertStatus(403);
    }

    /** 3. Student cannot show assignment of another class */
    public function test_student_cannot_show_assignment_of_other_class()
    {
        $taskClass2 = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleEnglish->id,
            'kelas_id' => $this->kelas2->id,
            'guru_id' => $this->guruB->id,
            'judul' => 'Task Class 2',
            'deskripsi' => 'Desc',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentA);
        $this->get(route('assignments.show', $taskClass2->id))->assertStatus(403);
    }

    /** 4. Student cannot download or preview assignment attachment of other class */
    public function test_student_cannot_download_or_preview_assignment_attachment_of_other_class()
    {
        $taskClass2 = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleEnglish->id,
            'kelas_id' => $this->kelas2->id,
            'guru_id' => $this->guruB->id,
            'judul' => 'Task Class 2',
            'deskripsi' => 'Desc',
            'deadline' => now()->addDays(2),
            'attachment' => 'tugas/dummy.pdf',
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentA);
        $this->get(route('download.assignment', $taskClass2->id))->assertStatus(403);
        $this->get(route('preview.assignment', $taskClass2->id))->assertStatus(403);
    }

    /** 5. Teacher cannot open teacherDetail of unassigned class */
    public function test_teacher_cannot_open_teacher_detail_of_unassigned_class_or_subject()
    {
        $this->actingAs($this->teacherA);
        // Teacher A tries to view detail of English for Class 2
        $this->get(route('assignments.teacher.detail', [
            'subject' => $this->scheduleEnglish->id,
            'class_name' => 'XI F 2'
        ]))->assertStatus(403);
    }

    /** 6. Teacher cannot view grade recap of unassigned class/subject */
    public function test_teacher_cannot_view_grade_recap_of_unassigned_class_or_subject()
    {
        $this->actingAs($this->teacherA);
        $this->get(route('assignments.teacher.rekap', [
            'subject' => $this->scheduleEnglish->id,
            'class_name' => 'XI F 2'
        ]))->assertStatus(403);
    }

    /** 7. Teacher cannot export recap of unassigned class/subject */
    public function test_teacher_cannot_export_recap_of_unassigned_class_or_subject()
    {
        $this->actingAs($this->teacherA);
        $this->get(route('assignments.teacher.rekap.export', [
            'subject' => $this->scheduleEnglish->id,
            'class_name' => 'XI F 2'
        ]))->assertStatus(403);
    }

    /** 8. Teacher cannot create cross assignment */
    public function test_teacher_cannot_create_or_update_cross_assignment()
    {
        $this->actingAs($this->teacherA);
        // Teacher A tries to create task for English in Class 2
        $this->post(route('assignments.store'), [
            'subject_id' => $this->scheduleEnglish->id,
            'title' => 'Cross Task',
            'description' => 'Desc',
            'due_date' => now()->addDays(2)->toDateTimeString(),
            'max_score' => 100,
            'class_name' => 'XI F 2'
        ])->assertStatus(403);
    }

    /** 9. Student cannot submit cross class assignment */
    public function test_student_cannot_submit_cross_class_assignment()
    {
        $taskClass2 = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleEnglish->id,
            'kelas_id' => $this->kelas2->id,
            'guru_id' => $this->guruB->id,
            'judul' => 'Task Class 2',
            'deskripsi' => 'Desc',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentA);
        $this->post(route('assignments.submit', $taskClass2->id), [
            'file' => \Illuminate\Http\UploadedFile::fake()->create('submission.pdf', 100)
        ])->assertStatus(403);
    }

    /** 10. Teacher cannot view appeals of unassigned class */
    public function test_teacher_cannot_view_appeals_of_unassigned_class()
    {
        $this->actingAs($this->teacherA);
        // Teacher A tries to view appeals for Class 2
        $this->get(route('appeals.index', ['class_id' => $this->kelas2->name]))
            ->assertStatus(403);
    }

    /** 11. Teacher cannot approve appeal of unassigned class or subject */
    public function test_teacher_cannot_approve_appeal_of_unassigned_class_or_subject()
    {
        $appealClass2 = Banding::create([
            'siswa_id' => $this->siswaB->id,
            'mata_pelajaran_id' => $this->scheduleEnglish->id,
            'alasan' => 'Sakit',
            'status' => 'ditinjau'
        ]);

        $this->actingAs($this->teacherA);
        $this->post(route('appeals.approve', $appealClass2->id), ['duration' => 24])
            ->assertStatus(403);
    }

    /** 12. Teacher cannot reject appeal of unassigned class or subject */
    public function test_teacher_cannot_reject_appeal_of_unassigned_class_or_subject()
    {
        $appealClass2 = Banding::create([
            'siswa_id' => $this->siswaB->id,
            'mata_pelajaran_id' => $this->scheduleEnglish->id,
            'alasan' => 'Sakit',
            'status' => 'ditinjau'
        ]);

        $this->actingAs($this->teacherA);
        $this->post(route('appeals.reject', $appealClass2->id), ['tanggapan_guru' => 'No'])
            ->assertStatus(403);
    }

    /** 13. Homeroom Teacher can view locking history of homeroom students across subjects */
    public function test_wali_kelas_can_view_locking_history_of_homeroom_students_across_subjects()
    {
        // Guru B is homeroom teacher of Class 2
        $this->actingAs($this->teacherB);
        $this->get(route('appeals.locking_history'))->assertStatus(200);
    }

    /** 14. Homeroom Teacher cannot approve appeal for subject not taught */
    public function test_wali_kelas_cannot_approve_appeal_for_subject_not_taught()
    {
        // Guru B is Homeroom of Class 2, but Math is taught by Guru A
        $appealMathClass2 = Banding::create([
            'siswa_id' => $this->siswaB->id,
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'alasan' => 'Sakit',
            'status' => 'ditinjau'
        ]);

        $this->actingAs($this->teacherB);
        $this->post(route('appeals.approve', $appealMathClass2->id), ['duration' => 24])
            ->assertStatus(403);
    }

    /** 15. Wali Kelas cannot reject appeal for subject not taught */
    public function test_wali_kelas_cannot_reject_appeal_for_subject_not_taught()
    {
        // Guru B is Homeroom of Class 2, but Math is taught by Guru A
        $appealMathClass2 = Banding::create([
            'siswa_id' => $this->siswaB->id,
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'alasan' => 'Sakit',
            'status' => 'ditinjau'
        ]);

        $this->actingAs($this->teacherB);
        $this->post(route('appeals.reject', $appealMathClass2->id), ['tanggapan_guru' => 'No'])
            ->assertStatus(403);
    }

    /** 16. Wali Kelas can view appeal status of homeroom students across subjects */
    public function test_wali_kelas_can_view_appeal_status_of_homeroom_students_across_subjects()
    {
        // Guru B is homeroom teacher of Class 2
        $this->actingAs($this->teacherB);
        $this->get(route('appeals.history'))->assertStatus(200);
    }

    /** 17. Regular teacher cannot view other class locking history */
    public function test_regular_teacher_cannot_view_other_class_locking_history()
    {
        // Guru A is regular teacher without homeroom
        $this->actingAs($this->teacherA);
        $response = $this->get(route('appeals.history', ['class_id' => $this->kelas2->name]));
        $response->assertStatus(200);
        $recoveries = $response->viewData('recoveries');
        $this->assertCount(0, $recoveries);
    }

    /** 18. Teacher cannot update assignment into unassigned class or subject */
    public function test_teacher_cannot_update_assignment_to_unassigned_class_or_subject()
    {
        $taskClass1 = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Task Class 1',
            'deskripsi' => 'Desc',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->teacherA);
        // Teacher A tries to update task to English in Class 2
        $this->put(route('assignments.update', $taskClass1->id), [
            'subject_id' => $this->scheduleEnglish->id,
            'title' => 'Updated Task',
            'description' => 'Updated Desc',
            'due_date' => now()->addDays(3)->toDateTimeString(),
            'max_score' => 100,
            'status' => 'active',
            'class_name' => 'XI F 2'
        ])->assertStatus(403);
    }

    /** 19. Teacher cannot destroy unassigned assignment */
    public function test_teacher_cannot_destroy_unassigned_assignment()
    {
        $taskClass2 = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleEnglish->id,
            'kelas_id' => $this->kelas2->id,
            'guru_id' => $this->guruB->id,
            'judul' => 'Task Class 2',
            'deskripsi' => 'Desc',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->teacherA);
        $this->delete(route('assignments.destroy', $taskClass2->id))->assertStatus(403);
    }

    /** 20. Student cannot submit appeal when not locked or not eligible */
    public function test_student_cannot_submit_appeal_when_not_locked_or_not_eligible()
    {
        $activeTaskMath = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Active Math Task',
            'deskripsi' => 'Desc',
            'deadline' => now()->addDays(5), // Active task, NOT past deadline
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentA);
        // Student A tries to submit appeal for active task not past deadline
        $this->post(route('siswa.assignments.banding', $activeTaskMath->id), [
            'kategori_alasan' => 'Sakit',
            'penjelasan' => 'Penjelasan lebih dari 50 karakter untuk keperluan pengujian validasi kelayakan pengajuan.',
        ])->assertStatus(403);
    }

    /** 21. Teacher cannot update assignment using class_name spoof */
    public function test_teacher_cannot_update_assignment_using_class_name_spoof()
    {
        // Guru A teaches Math in Class 1 and English in Class 2
        GuruKelas::create([
            'guru_id' => $this->guruA->id,
            'kelas_id' => $this->kelas2->id,
            'mata_pelajaran_id' => $this->scheduleEnglish->id
        ]);

        $taskClass1Math = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Math Task Class 1',
            'deskripsi' => 'Desc',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->teacherA);
        // Teacher A submits update for Math Task (which is in Class 1) with subject_id = English and class_name = Class 2.
        // Since assignment remains in Class 1 where Teacher A does not teach English, this MUST return 403.
        $this->put(route('assignments.update', $taskClass1Math->id), [
            'subject_id' => $this->scheduleEnglish->id,
            'title' => 'Updated Task',
            'description' => 'Updated Desc',
            'due_date' => now()->addDays(3)->toDateTimeString(),
            'max_score' => 100,
            'status' => 'active',
            'class_name' => $this->kelas2->name
        ])->assertStatus(403);
    }

    /** 22. Assigned teacher can legitimately update own assignment */
    public function test_assigned_teacher_can_legitimately_update_own_assignment()
    {
        $taskClass1Math = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Math Task Class 1',
            'deskripsi' => 'Desc',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->teacherA);
        $response = $this->put(route('assignments.update', $taskClass1Math->id), [
            'subject_id' => $this->scheduleMath->id,
            'title' => 'Updated Valid Math Task',
            'description' => 'Updated Desc',
            'due_date' => now()->addDays(3)->toDateTimeString(),
            'max_score' => 100,
            'status' => 'active',
            'class_name' => $this->kelas1->name
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('tugas', [
            'id' => $taskClass1Math->id,
            'judul' => 'Updated Valid Math Task'
        ]);
    }

    /** 23. Assigned teacher can legitimately destroy own assignment */
    public function test_assigned_teacher_can_legitimately_destroy_own_assignment()
    {
        $taskClass1Math = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Task To Delete',
            'deskripsi' => 'Desc',
            'deadline' => now()->addDays(2),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->teacherA);
        $response = $this->delete(route('assignments.destroy', $taskClass1Math->id));
        $response->assertRedirect();
        $this->assertSoftDeleted('tugas', ['id' => $taskClass1Math->id]);
    }

    /** 24. Eligible locked student can submit appeal */
    public function test_eligible_locked_student_can_submit_appeal()
    {
        $overdueTaskMath = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Overdue Math Task 1',
            'deskripsi' => 'Desc',
            'deadline' => now()->subDays(3),
            'status' => 'aktif'
        ]);

        $overdueTaskMath2 = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Overdue Math Task 2',
            'deskripsi' => 'Desc',
            'deadline' => now()->subDays(2),
            'status' => 'aktif'
        ]);

        $overdueTaskMath3 = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Overdue Math Task 3',
            'deskripsi' => 'Desc',
            'deadline' => now()->subDays(1),
            'status' => 'aktif'
        ]);

        $this->actingAs($this->studentA);

        // Path A: BandingController::store()
        $resStore = $this->post(route('appeals.store'), [
            'subject_id' => $this->scheduleMath->id,
            'reason' => 'Permohonan banding karena sakit'
        ]);
        $resStore->assertRedirect();
        $this->assertDatabaseHas('pengajuan_banding', [
            'siswa_id' => $this->siswaA->id,
            'mata_pelajaran_id' => $this->scheduleMath->id
        ]);

        // Path B: TugasController::submitBanding() for another overdue assignment
        $overdueTaskMath2 = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Overdue Math Task 2',
            'deskripsi' => 'Desc',
            'deadline' => now()->subDays(1),
            'status' => 'aktif'
        ]);

        $resSubmit = $this->post(route('siswa.assignments.banding', $overdueTaskMath2->id), [
            'kategori_alasan' => 'Sakit',
            'penjelasan' => 'Penjelasan lebih dari 50 karakter untuk permohonan banding tugas matematika.',
        ]);
        $resSubmit->assertRedirect();
        $this->assertDatabaseHas('pengajuan_banding', [
            'siswa_id' => $this->siswaA->id,
            'tugas_id' => $overdueTaskMath2->id
        ]);
    }

    /** 25. Assigned teacher can access, approve, and reject appeal */
    public function test_assigned_teacher_can_access_approve_and_reject_appeal()
    {
        $overdueTask = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Overdue Task For Recovery 1',
            'deskripsi' => 'Desc',
            'deadline' => now()->subDays(3),
            'status' => 'aktif'
        ]);

        $overdueTask2 = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Overdue Task For Recovery 2',
            'deskripsi' => 'Desc',
            'deadline' => now()->subDays(2),
            'status' => 'aktif'
        ]);

        $overdueTask3 = Tugas::create([
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'kelas_id' => $this->kelas1->id,
            'guru_id' => $this->guruA->id,
            'judul' => 'Overdue Task For Recovery 3',
            'deskripsi' => 'Desc',
            'deadline' => now()->subDays(1),
            'status' => 'aktif'
        ]);

        $appealMath = Banding::create([
            'siswa_id' => $this->siswaA->id,
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'alasan' => 'Sakit',
            'status' => 'ditinjau'
        ]);

        $this->actingAs($this->teacherA);

        // Can approve
        $resApprove = $this->post(route('appeals.approve', $appealMath->id), ['duration' => 24]);
        $resApprove->assertRedirect();
        $this->assertDatabaseHas('pengajuan_banding', [
            'id' => $appealMath->id,
            'status' => 'diterima'
        ]);

        // Create another appeal for reject testing
        $appealMath2 = Banding::create([
            'siswa_id' => $this->siswaA->id,
            'mata_pelajaran_id' => $this->scheduleMath->id,
            'alasan' => 'Alasan tidak valid',
            'status' => 'ditinjau'
        ]);

        // Can reject
        $resReject = $this->post(route('appeals.reject', $appealMath2->id), ['tanggapan_guru' => 'Ditolak']);
        $resReject->assertRedirect();
        $this->assertDatabaseHas('pengajuan_banding', [
            'id' => $appealMath2->id,
            'status' => 'ditolak'
        ]);
    }
}
