<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Tugas;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TugasRedesignTest extends TestCase
{
    use RefreshDatabase;

    private $teacherUser;
    private $subject;
    private $classroom;
    private $teacher;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Create specialized subject
        $this->subject = JadwalPelajaran::create([
            'kode' => 'TIK-1',
            'nama' => 'TIK 1',
            'deskripsi' => 'Teknologi Informasi dan Komunikasi 1',
            'tingkat' => 'X',
            'status' => 'aktif'
        ]);

        // 2. Create class room
        $this->classroom = Kelas::withoutGlobalScopes()->create([
            'name' => 'X IPA 1',
            'grade_level' => 'X',
            'major' => 'IPA',
            'max_students' => 50,
            'academic_year' => '2025/2026'
        ]);

        // 3. Create teacher user
        $this->teacherUser = User::create([
            'nama' => 'Guru TIK',
            'email' => 'gurutik@guru.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'guru'
        ]);

        // 4. Create teacher
        $this->teacher = Guru::create([
            'nip' => '198801012015011001',
            'nama' => 'Guru TIK',
            'email' => 'gurutik@guru.smansago.com',
            'no_hp' => '081234567890',
            'spesialisasi' => 'TIK 1',
            'specialization_id' => $this->subject->id,
            'status' => 'aktif',
            'pengguna_id' => $this->teacherUser->id
        ]);

        // 5. Connect class room to teacher
        $this->teacher->kelasDiampu()->attach($this->classroom->id);
    }

    private function getTeacherUser()
    {
        return $this->teacherUser;
    }

    public function test_assignments_page_can_be_rendered_for_teacher(): void
    {
        $teacher = $this->getTeacherUser();

        $response = $this->actingAs($teacher)->get(route('assignments.teacher.detail', $this->subject));
        $response->assertStatus(200);
        $response->assertSee('Tambah Tugas');
        $response->assertSee('selectedSubjectId'); // Check Alpine js logic present
    }

    public function test_teacher_detail_page_loads_correct_student_count_for_class(): void
    {
        $teacher = $this->getTeacherUser();

        // Create some students in the classroom
        \App\Models\Siswa::create([
            'nis' => 'S-001',
            'nama' => 'Siswa A',
            'kelas' => $this->classroom->name,
            'status' => 'aktif',
            'phone' => '081234',
            'address' => 'Addr',
            'gender' => 'Laki-laki',
            'date_of_birth' => '2009-01-01',
            'entry_year' => '2025'
        ]);

        \App\Models\Siswa::create([
            'nis' => 'S-002',
            'nama' => 'Siswa B',
            'kelas' => $this->classroom->name,
            'status' => 'aktif',
            'phone' => '081234',
            'address' => 'Addr',
            'gender' => 'Perempuan',
            'date_of_birth' => '2009-01-01',
            'entry_year' => '2025'
        ]);

        // Access the page with class_name query param
        $response = $this->actingAs($teacher)->get(route('assignments.teacher.detail', [
            'subject' => $this->subject->id,
            'class_name' => $this->classroom->name
        ]));

        $response->assertStatus(200);
        // Verify that the studentCount variable sent to the view is 2
        $response->assertViewHas('studentCount', 2);
    }

    public function test_create_assignment_with_valid_data(): void
    {
        $teacher = $this->getTeacherUser();
        $subjectId = $this->subject->id;

        $title = 'Tugas Uji Coba Unit Test ' . uniqid();
        $description = 'Deskripsi tugas uji coba unit test';
        $dueDate = Carbon::now()->addDays(5)->format('Y-m-d\TH:i');

        $response = $this->actingAs($teacher)->post('/assignments', [
            'subject_id' => $subjectId,
            'title' => $title,
            'description' => $description,
            'due_date' => $dueDate,
            'max_score' => 100,
            'type' => 'essay',
            'status' => 'active'
        ]);

        $response->assertRedirect();
        
        // Assert it exists in the database
        $this->assertDatabaseHas('tugas', [
            'judul' => $title,
            'deskripsi' => $description,
            'mata_pelajaran_id' => $subjectId,
            'max_score' => 100
        ]);
    }

    public function test_validation_error_keeps_modal_open_and_preserves_old_inputs(): void
    {
        $teacher = $this->getTeacherUser();
        $subjectId = $this->subject->id;
        $description = 'Deskripsi tugas tanpa judul';
        $dueDate = Carbon::now()->addDays(5)->format('Y-m-d\TH:i');

        // Post without title
        $response = $this->actingAs($teacher)->post('/assignments', [
            'subject_id' => $subjectId,
            'description' => $description,
            'due_date' => $dueDate,
            'max_score' => 100,
            'type' => 'essay',
            'status' => 'active'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title']);
        
        // Follow redirect to index page where the modal is
        $indexResponse = $this->actingAs($teacher)->get('/assignments');
        
        // Assert that old input for subject_id is present in the response
        $indexResponse->assertSee($subjectId);
    }

    public function test_student_submission_saves_metadata_and_serializes_appends(): void
    {
        // 1. Create a student record
        $student = \App\Models\Siswa::create([
            'nis' => '23241002',
            'name' => 'Siswa Andi',
            'kelas' => 'X IPA 1',
            'status' => 'active',
            'phone' => '081234567891',
            'address' => 'Test Address 2',
            'gender' => 'Laki-laki',
            'date_of_birth' => '2009-01-01',
            'entry_year' => '2025'
        ]);

        // 2. Create the associated student user
        $studentUser = User::create([
            'nama' => 'Siswa Andi',
            'email' => 'andi@siswa.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);
        $student->update(['pengguna_id' => $studentUser->id]);

        // 3. Create an assignment
        $assignment = Tugas::create([
            'judul' => 'Tugas Percobaan',
            'deskripsi' => 'Kerjakan tugas berikut',
            'deadline' => Carbon::now()->addDays(2),
            'guru_id' => $this->teacher->id,
            'mata_pelajaran_id' => $this->subject->id,
            'status' => 'active'
        ]);

        // 4. Submit assignment via POST request with a fake PDF file
        $fakeFile = \Illuminate\Http\UploadedFile::fake()->create('jawaban_tugas.pdf', 256, 'application/pdf');

        $response = $this->actingAs($studentUser)->post("/assignments/{$assignment->id}/submit", [
            'file' => $fakeFile,
            'content' => 'Ini catatan tugas'
        ]);

        // Assert redirect or ok status
        $response->assertStatus(302); // Redirect back

        // 5. Assert the submission record exists with correct metadata in DB
        $submission = \App\Models\Pengumpulan::where('tugas_id', $assignment->id)
            ->where('siswa_id', $student->id)
            ->first();

        $this->assertNotNull($submission);
        $this->assertEquals('jawaban_tugas.pdf', $submission->original_name);
        $this->assertEquals('application/pdf', $submission->mime_type);
        $this->assertGreaterThan(0, $submission->file_size);

        // 6. Convert model to array/JSON and assert appended accessors are present
        $jsonArray = $submission->toArray();
        $this->assertArrayHasKey('assignment_id', $jsonArray);
        $this->assertArrayHasKey('student_id', $jsonArray);
        $this->assertArrayHasKey('submission_date', $jsonArray);
        $this->assertArrayHasKey('file_path', $jsonArray);
        $this->assertArrayHasKey('original_name', $jsonArray);
        $this->assertArrayHasKey('file_size', $jsonArray);
        $this->assertArrayHasKey('attachment_url', $jsonArray);

        $this->assertEquals($assignment->id, $jsonArray['assignment_id']);
        $this->assertEquals($student->id, $jsonArray['student_id']);
        $this->assertNotNull($jsonArray['submission_date']);
    }

    public function test_teacher_can_toggle_submission_correction_status(): void
    {
        $teacher = $this->getTeacherUser();

        // 1. Create a student record
        $student = \App\Models\Siswa::create([
            'nis' => '23241003',
            'name' => 'Siswa Budi',
            'kelas' => 'X IPA 1',
            'status' => 'active',
            'phone' => '081234567892',
            'address' => 'Test Address 3',
            'gender' => 'Laki-laki',
            'date_of_birth' => '2009-01-01',
            'entry_year' => '2025'
        ]);

        // 2. Create an assignment
        $assignment = Tugas::create([
            'judul' => 'Tugas Matematika',
            'deskripsi' => 'Kerjakan halaman 10',
            'deadline' => Carbon::now()->addDays(2),
            'guru_id' => $this->teacher->id,
            'mata_pelajaran_id' => $this->subject->id,
            'status' => 'active',
            'max_score' => 100
        ]);

        // 3. Create a submission
        $submission = \App\Models\Pengumpulan::create([
            'tugas_id' => $assignment->id,
            'siswa_id' => $student->id,
            'tanggal_pengumpulan' => Carbon::now(),
            'file_tugas' => 'submissions/test.pdf',
            'status' => 'submitted',
            'original_name' => 'test.pdf',
            'file_path' => 'submissions/test.pdf',
            'file_size' => 1024,
            'mime_type' => 'application/pdf',
        ]);

        // 4. Toggle correction status (first toggle: mark as corrected)
        $response = $this->actingAs($teacher)->post(route('submissions.toggle-koreksi', $submission), [
            'feedback' => 'Selesai dengan catatan Bagus!'
        ]);
        $response->assertStatus(302); // Redirects back
        
        // Assert grade was created
        $this->assertDatabaseHas('grades', [
            'submission_id' => $submission->id,
            'score' => 100,
            'max_score' => 100,
            'feedback' => 'Selesai dengan catatan Bagus!'
        ]);
        $this->assertEquals('graded', $submission->fresh()->status);

        // 5. Toggle correction status (second toggle: cancel correction)
        $response = $this->actingAs($teacher)->post(route('submissions.toggle-koreksi', $submission));
        $response->assertStatus(302);
        
        // Assert grade was deleted
        $this->assertDatabaseMissing('grades', [
            'submission_id' => $submission->id
        ]);
        $this->assertEquals('submitted', $submission->fresh()->status);
    }

    public function test_teacher_can_toggle_submission_correction_status_via_ajax(): void
    {
        $teacher = $this->getTeacherUser();

        // 1. Create a student record
        $student = \App\Models\Siswa::create([
            'nis' => '23241004',
            'name' => 'Siswa Joko',
            'kelas' => 'X IPA 1',
            'status' => 'active',
            'phone' => '081234567893',
            'address' => 'Test Address 4',
            'gender' => 'Laki-laki',
            'date_of_birth' => '2009-01-01',
            'entry_year' => '2025'
        ]);

        // 2. Create an assignment
        $assignment = Tugas::create([
            'judul' => 'Tugas IPA',
            'deskripsi' => 'Kerjakan halaman 15',
            'deadline' => Carbon::now()->addDays(2),
            'guru_id' => $this->teacher->id,
            'mata_pelajaran_id' => $this->subject->id,
            'status' => 'active',
            'max_score' => 100
        ]);

        // 3. Create a submission
        $submission = \App\Models\Pengumpulan::create([
            'tugas_id' => $assignment->id,
            'siswa_id' => $student->id,
            'tanggal_pengumpulan' => Carbon::now(),
            'file_tugas' => 'submissions/test.pdf',
            'status' => 'submitted',
            'original_name' => 'test.pdf',
            'file_path' => 'submissions/test.pdf',
            'file_size' => 1024,
            'mime_type' => 'application/pdf',
        ]);

        // 4. Toggle via AJAX (first toggle: mark as completed/graded)
        $response = $this->actingAs($teacher)->postJson(
            route('submissions.toggle-koreksi', $submission),
            ['feedback' => 'Sangat rapi!']
        );
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_graded' => true,
            'status_label' => 'Sudah Dikoreksi'
        ]);

        $this->assertEquals('graded', $submission->fresh()->status);
        $this->assertDatabaseHas('grades', [
            'submission_id' => $submission->id,
            'feedback' => 'Sangat rapi!'
        ]);

        // 5. Toggle via AJAX (second toggle: cancel correction)
        $response = $this->actingAs($teacher)->postJson(
            route('submissions.toggle-koreksi', $submission),
            []
        );
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_graded' => false,
            'status_label' => 'Perlu Koreksi'
        ]);

        $this->assertEquals('submitted', $submission->fresh()->status);
        $this->assertDatabaseMissing('grades', [
            'submission_id' => $submission->id
        ]);
    }
}

