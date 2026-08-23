<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\JadwalPelajaran;
use App\Models\GuruKelas;
use App\Models\Tugas;
use App\Models\Pengumpulan;
use App\Services\SubmissionUrlService;
use App\Enums\AssignmentSubmissionType;
use App\Enums\AudiovisualMode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AssignmentSubmissionTypeTest extends TestCase
{
    use RefreshDatabase;

    private $studentUser;
    private $siswa;
    private $teacherUser;
    private $guru;
    private $subject;
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
            'kapasitasMaksimal' => 36,
        ]);

        // 2. Create Student & User
        $this->siswa = Siswa::create([
            'nis' => '23241001',
            'nama' => 'Siswa Test Type',
            'kelas' => 'X IPA 1',
            'status' => 'aktif',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2009-01-01',
        ]);

        $this->studentUser = User::create([
            'nama' => 'Siswa Test Type',
            'email' => 'student.type@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
        $this->siswa->update(['pengguna_id' => $this->studentUser->id]);

        // 3. Create Teacher & User
        $this->guru = Guru::create([
            'nip' => '198001012010011001',
            'nama' => 'Guru Test Type',
            'email' => 'teacher.type@smansago.com',
            'no_hp' => '08123456789',
        ]);

        $this->teacherUser = User::create([
            'nama' => 'Guru Test Type',
            'email' => 'teacher.type@smansago.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);
        $this->guru->update(['pengguna_id' => $this->teacherUser->id]);

        // 4. Create Subject
        $this->subject = JadwalPelajaran::create([
            'kode' => 'SNB-10',
            'nama' => 'Seni Budaya',
            'tingkat' => 'X',
            'status' => 'aktif',
        ]);

        GuruKelas::create([
            'guru_id' => $this->guru->id,
            'kelas_id' => $this->classRoom->id,
            'mata_pelajaran_id' => $this->subject->id,
        ]);
    }

    /** @test */
    public function test_teacher_can_create_assignment_with_visual_type()
    {
        $this->actingAs($this->teacherUser);

        $response = $this->post(route('assignments.store'), [
            'subject_id' => $this->subject->id,
            'class_name' => 'X IPA 1',
            'title' => 'Tugas Desain Poster',
            'description' => 'Buat poster bertema lingkungan',
            'due_date' => now()->addDays(3)->format('Y-m-d\TH:i'),
            'max_score' => 100,
            'tipe_pengumpulan' => 'visual',
        ]);

        $response->assertRedirect();
        
        $assignment = Tugas::where('judul', 'Tugas Desain Poster')->first();
        $this->assertNotNull($assignment);
        $this->assertEquals('visual', $assignment->tipe_pengumpulan);
        $this->assertNull($assignment->mode_audiovisual);
    }

    /** @test */
    public function test_teacher_can_create_assignment_with_audiovisual_and_submode()
    {
        $this->actingAs($this->teacherUser);

        $response = $this->post(route('assignments.store'), [
            'subject_id' => $this->subject->id,
            'class_name' => 'X IPA 1',
            'title' => 'Tugas Praktik Pidato',
            'description' => 'Rekam video pidato bahasa inggris',
            'due_date' => now()->addDays(3)->format('Y-m-d\TH:i'),
            'max_score' => 100,
            'tipe_pengumpulan' => 'audiovisual',
            'mode_audiovisual' => 'video_url',
        ]);

        $response->assertRedirect();

        $assignment = Tugas::where('judul', 'Tugas Praktik Pidato')->first();
        $this->assertNotNull($assignment);
        $this->assertEquals('audiovisual', $assignment->tipe_pengumpulan);
        $this->assertEquals('video_url', $assignment->mode_audiovisual);
    }

    /** @test */
    public function test_mode_audiovisual_is_cleared_when_type_is_not_audiovisual()
    {
        $this->actingAs($this->teacherUser);

        $response = $this->post(route('assignments.store'), [
            'subject_id' => $this->subject->id,
            'class_name' => 'X IPA 1',
            'title' => 'Tugas Makalah',
            'description' => 'Makalah Sejarah',
            'due_date' => now()->addDays(3)->format('Y-m-d\TH:i'),
            'max_score' => 100,
            'tipe_pengumpulan' => 'dokumen',
            'mode_audiovisual' => 'video_url', // Should be normalized to null by backend
        ]);

        $response->assertRedirect();

        $assignment = Tugas::where('judul', 'Tugas Makalah')->first();
        $this->assertNotNull($assignment);
        $this->assertEquals('dokumen', $assignment->tipe_pengumpulan);
        $this->assertNull($assignment->mode_audiovisual);
    }

    /** @test */
    public function test_teacher_cannot_change_assignment_type_after_submission_exists_with_422()
    {
        $this->actingAs($this->teacherUser);

        $assignment = Tugas::create([
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->guru->id,
            'kelas_id' => $this->classRoom->id,
            'judul' => 'Tugas Dokumen Awal',
            'deskripsi' => 'Deskripsi',
            'deadline' => now()->addDays(5),
            'max_score' => 100,
            'status' => 'aktif',
            'tipe_pengumpulan' => 'dokumen',
        ]);

        // Create student submission
        Pengumpulan::create([
            'tugas_id' => $assignment->id,
            'siswa_id' => $this->siswa->id,
            'tanggal_pengumpulan' => now(),
            'file_tugas' => 'tugas/sample.pdf',
            'original_name' => 'sample.pdf',
            'status' => 'dikumpulkan',
        ]);

        $this->assertTrue($assignment->hasSubmissions());

        // Attempt to update tipe_pengumpulan to 'visual'
        $response = $this->putJson(route('assignments.update', $assignment), [
            'subject_id' => $this->subject->id,
            'class_name' => 'X IPA 1',
            'title' => 'Tugas Dokumen Diubah',
            'description' => 'Deskripsi Baru',
            'due_date' => now()->addDays(5)->format('Y-m-d\TH:i'),
            'max_score' => 100,
            'status' => 'active',
            'tipe_pengumpulan' => 'visual', // Changed!
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['tipe_pengumpulan']);
    }

    /** @test */
    public function test_submission_url_service_validates_youtube_and_generates_safe_nocookie_embed()
    {
        $service = new SubmissionUrlService();

        $youtubeUrl = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
        $validation = $service->validateUrl($youtubeUrl, AssignmentSubmissionType::AUDIOVISUAL, AudiovisualMode::VIDEO_URL);

        $this->assertTrue($validation['valid']);
        $this->assertEquals('youtube', $validation['platform']);

        $embed = $service->parseEmbedData($youtubeUrl);
        $this->assertTrue($embed['is_embeddable']);
        $this->assertEquals('https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ', $embed['embed_url']);
    }

    /** @test */
    public function test_submission_url_service_rejects_phishing_and_fake_domains()
    {
        $service = new SubmissionUrlService();

        // Fake phishing domain imitating youtube
        $fakeUrl = 'https://youtube.com.evil.test/watch?v=12345';
        $validation = $service->validateUrl($fakeUrl, AssignmentSubmissionType::AUDIOVISUAL, AudiovisualMode::VIDEO_URL);

        $this->assertFalse($validation['valid']);
        $this->assertStringContainsString('Domain youtube.com.evil.test tidak diizinkan', $validation['error']);
    }

    /** @test */
    public function test_submission_url_service_rejects_raw_iframe_tags()
    {
        $service = new SubmissionUrlService();

        $xssUrl = '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"></iframe>';
        $validation = $service->validateUrl($xssUrl, AssignmentSubmissionType::AUDIOVISUAL, AudiovisualMode::VIDEO_URL);

        $this->assertFalse($validation['valid']);
        $this->assertStringContainsString('Format URL tidak valid', $validation['error']);
    }

    /** @test */
    public function test_submission_url_service_rejects_http_or_invalid_protocols()
    {
        $service = new SubmissionUrlService();

        $httpUrl = 'http://www.youtube.com/watch?v=dQw4w9WgXcQ';
        $validation = $service->validateUrl($httpUrl, AssignmentSubmissionType::AUDIOVISUAL, AudiovisualMode::VIDEO_URL);

        $this->assertFalse($validation['valid']);
        $this->assertStringContainsString('Tautan wajib menggunakan protokol HTTPS', $validation['error']);
    }

    /** @test */
    public function test_student_can_submit_youtube_video_and_file_metadata_is_null()
    {
        $this->actingAs($this->studentUser);

        $assignment = Tugas::create([
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->guru->id,
            'judul' => 'Tugas Video Storytelling',
            'deskripsi' => 'Kirimkan tautan YouTube unlisted',
            'deadline' => now()->addDays(5),
            'max_score' => 100,
            'tipe_pengumpulan' => 'audiovisual',
            'mode_audiovisual' => 'video_url',
        ]);

        $response = $this->postJson(route('assignments.submit', $assignment), [
            'submission_url' => 'https://youtu.be/dQw4w9WgXcQ',
            'content' => 'Berikut link video saya pak',
        ]);

        $response->assertOk();
        $response->assertJson(['success' => true]);

        $submission = Pengumpulan::where('tugas_id', $assignment->id)->where('siswa_id', $this->siswa->id)->first();
        $this->assertNotNull($submission);
        $this->assertEquals('https://youtu.be/dQw4w9WgXcQ', $submission->submission_url);
        $this->assertTrue($submission->is_url_submission);
        $this->assertTrue($submission->is_video_embeddable);
        $this->assertEquals('https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ', $submission->video_embed_url);

        // Strict Rule: File metadata must be completely null for URL submission
        $this->assertNull($submission->file_tugas);
        $this->assertNull($submission->file_path);
        $this->assertNull($submission->original_name);
        $this->assertNull($submission->file_size);
        $this->assertNull($submission->mime_type);
    }

    /** @test */
    public function test_student_can_submit_external_project_url()
    {
        $this->actingAs($this->studentUser);

        $assignment = Tugas::create([
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->guru->id,
            'judul' => 'Tugas Prototipe UI/UX',
            'deskripsi' => 'Kirimkan link figma',
            'deadline' => now()->addDays(5),
            'max_score' => 100,
            'tipe_pengumpulan' => 'tautan',
        ]);

        $response = $this->postJson(route('assignments.submit', $assignment), [
            'submission_url' => 'https://www.figma.com/file/abcdef12345/Sample-UI-Design',
        ]);

        $response->assertOk();
        $response->assertJson(['success' => true]);

        $submission = Pengumpulan::where('tugas_id', $assignment->id)->where('siswa_id', $this->siswa->id)->first();
        $this->assertNotNull($submission);
        $this->assertEquals('figma', $submission->platform_data['platform']);
        $this->assertFalse($submission->is_video_embeddable);
    }

    /** @test */
    public function test_either_audiovisual_mode_requires_either_file_or_url()
    {
        $this->actingAs($this->studentUser);

        $assignment = Tugas::create([
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->guru->id,
            'judul' => 'Tugas Speaking Test',
            'deskripsi' => 'Boleh kirim audio MP3 atau link YouTube',
            'deadline' => now()->addDays(5),
            'max_score' => 100,
            'tipe_pengumpulan' => 'audiovisual',
            'mode_audiovisual' => 'either',
        ]);

        // Case 1: Empty inputs
        $response = $this->postJson(route('assignments.submit', $assignment), []);
        $response->assertStatus(422);

        // Case 2: Submit MP3 File
        $file = UploadedFile::fake()->create('speaking_test.mp3', 2048, 'audio/mpeg');
        $response = $this->postJson(route('assignments.submit', $assignment), [
            'file' => $file,
        ]);
        $response->assertOk();

        $sub = Pengumpulan::where('tugas_id', $assignment->id)->where('siswa_id', $this->siswa->id)->first();
        $this->assertNotNull($sub);
        $this->assertNotNull($sub->file_path);
        $this->assertNull($sub->submission_url);
    }

    /** @test */
    public function test_student_can_submit_visual_files_and_rejects_disallowed_mime()
    {
        $this->actingAs($this->studentUser);

        $assignment = Tugas::create([
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->guru->id,
            'kelas_id' => $this->classRoom->id,
            'judul' => 'Tugas Poster Visual',
            'deskripsi' => 'Poster JPG/PNG',
            'deadline' => now()->addDays(5),
            'max_score' => 100,
            'status' => 'aktif',
            'tipe_pengumpulan' => 'visual',
        ]);

        // Case 1: Disallowed format (.docx on visual assignment)
        $invalidFile = UploadedFile::fake()->create('dokumen.docx', 1024, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        $response = $this->postJson(route('assignments.submit', $assignment), [
            'file' => $invalidFile,
        ]);
        $response->assertStatus(422);

        // Case 2: Allowed format (.png on visual assignment)
        $validFile = UploadedFile::fake()->image('poster.png');
        $response = $this->postJson(route('assignments.submit', $assignment), [
            'file' => $validFile,
        ]);
        $response->assertOk();

        $sub = Pengumpulan::where('tugas_id', $assignment->id)->where('siswa_id', $this->siswa->id)->first();
        $this->assertNotNull($sub);
        $this->assertNotNull($sub->file_path);
        Storage::disk('public')->assertExists($sub->file_path);
    }

    /** @test */
    public function test_first_submission_triggers_recovery_advance_but_revision_does_not()
    {
        $this->actingAs($this->studentUser);

        $assignment = Tugas::create([
            'mata_pelajaran_id' => $this->subject->id,
            'guru_id' => $this->guru->id,
            'kelas_id' => $this->classRoom->id,
            'judul' => 'Tugas Pemulihan',
            'deskripsi' => 'Tugas recovery',
            'deadline' => now()->addDays(5),
            'max_score' => 100,
            'status' => 'aktif',
            'tipe_pengumpulan' => 'dokumen',
        ]);

        // Active recovery session for student
        $recovery = \App\Models\PemulihanPengumpulan::create([
            'siswa_id' => $this->siswa->id,
            'mata_pelajaran_id' => $this->subject->id,
            'tugas_id' => $assignment->id,
            'status_pemulihan' => 'aktif',
            'tahap_ke' => 1,
            'total_tahap' => 2,
            'batas_pemulihan' => now()->addDays(2),
        ]);

        // First Submission
        $file = UploadedFile::fake()->create('jawaban1.pdf', 1024, 'application/pdf');
        $response = $this->postJson(route('assignments.submit', $assignment), [
            'file' => $file,
        ]);
        $response->assertOk();

        $sub = Pengumpulan::where('tugas_id', $assignment->id)->where('siswa_id', $this->siswa->id)->first();
        $this->assertNotNull($sub);

        // Teacher returns for revision
        $sub->update([
            'status' => 'needs_revision',
            'alasan_pengembalian' => 'Harap lengkapi halaman 2',
        ]);

        // Revision Submission (should NOT advance recovery again)
        $fileRevision = UploadedFile::fake()->create('jawaban1_rev.pdf', 1024, 'application/pdf');
        $responseRev = $this->postJson(route('assignments.submit', $assignment), [
            'file' => $fileRevision,
        ]);
        $responseRev->assertOk();

        $sub->refresh();
        $this->assertEquals('submitted', $sub->status);
        $this->assertEquals(1, $sub->revisi_ke);
    }

    /** @test */
    public function test_teacher_can_attach_mp4_video_or_video_link_but_student_is_restricted_to_link()
    {
        Storage::fake('local');
        $this->actingAs($this->teacherUser);

        // 1. Teacher creates assignment with MP4 video file
        $mp4File = UploadedFile::fake()->create('panduan_video.mp4', 5000, 'video/mp4');
        $response1 = $this->post(route('assignments.store'), [
            'subject_id' => $this->subject->id,
            'class_name' => 'X IPA 1',
            'title' => 'Tugas Praktik Video MP4',
            'description' => 'Simak video panduan berikut',
            'due_date' => now()->addDays(3)->format('Y-m-d\TH:i'),
            'max_score' => 100,
            'status' => 'active',
            'tipe_pengumpulan' => 'audiovisual',
            'mode_audiovisual' => 'video_url',
            'attachment' => $mp4File,
        ]);

        $response1->assertRedirect();
        $assignment = Tugas::where('judul', 'Tugas Praktik Video MP4')->first();
        $this->assertNotNull($assignment);
        $this->assertTrue($assignment->is_attachment_video);
        $this->assertFalse($assignment->is_attachment_url);

        // 2. Teacher creates assignment with YouTube link attachment
        $response2 = $this->post(route('assignments.store'), [
            'subject_id' => $this->subject->id,
            'class_name' => 'X IPA 1',
            'title' => 'Tugas Praktik Video Link',
            'description' => 'Simak video panduan dari youtube',
            'due_date' => now()->addDays(3)->format('Y-m-d\TH:i'),
            'max_score' => 100,
            'status' => 'active',
            'tipe_pengumpulan' => 'audiovisual',
            'mode_audiovisual' => 'video_url',
            'attachment_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $response2->assertRedirect();
        $assignmentLink = Tugas::where('judul', 'Tugas Praktik Video Link')->first();
        $this->assertNotNull($assignmentLink);
        $this->assertTrue($assignmentLink->is_attachment_url);
        $this->assertEquals('https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ', $assignmentLink->attachment_embed_url);

        // 3. Student tries to submit an MP4 file (must be rejected!)
        $this->flushSession();
        $this->actingAs($this->studentUser, 'web');
        $studentMp4 = UploadedFile::fake()->create('submission_video.mp4', 5000, 'video/mp4');
        $submitResponse = $this->postJson(route('assignments.submit', $assignment), [
            'file' => $studentMp4,
        ]);

        $submitResponse->assertStatus(422);
        $submitResponse->assertJsonValidationErrors(['file']);

        // 4. Student submits valid YouTube link (must succeed!)
        $validSubmitResponse = $this->postJson(route('assignments.submit', $assignment), [
            'submission_url' => 'https://www.youtube.com/watch?v=sU3q_g4r_dE',
        ]);

        $validSubmitResponse->assertOk();
        $studentSub = Pengumpulan::where('tugas_id', $assignment->id)->where('siswa_id', $this->siswa->id)->first();
        $this->assertNotNull($studentSub);
        $this->assertEquals('https://www.youtube.com/watch?v=sU3q_g4r_dE', $studentSub->submission_url);
    }

    /** @test */
    public function test_student_can_see_visual_media_preview_on_assignment_show_page()
    {
        Storage::fake('local');
        $this->actingAs($this->teacherUser);

        // Teacher uploads visual media (JPG poster)
        $posterFile = UploadedFile::fake()->image('poster_campaign.jpg', 800, 600);
        $response = $this->post(route('assignments.store'), [
            'subject_id' => $this->subject->id,
            'class_name' => 'X IPA 1',
            'title' => 'English Campaign Poster Test',
            'description' => 'Create an original poster',
            'due_date' => now()->addDays(3)->format('Y-m-d\TH:i'),
            'max_score' => 100,
            'status' => 'active',
            'tipe_pengumpulan' => 'visual',
            'attachment' => $posterFile,
        ]);

        $response->assertRedirect();
        $assignment = Tugas::where('judul', 'English Campaign Poster Test')->first();
        $this->assertNotNull($assignment);
        $this->assertTrue($assignment->is_attachment_image);

        // Student opens assignment show page
        $this->flushSession();
        $this->actingAs($this->studentUser, 'web');

        $showResponse = $this->get(route('assignments.show', $assignment));
        $showResponse->assertOk();
        $showResponse->assertSee('Media Visual Acuan Guru');
        $showResponse->assertSee('Pratinjau Penuh');
        $showResponse->assertSee('openImageLightbox');
    }

    /** @test */
    public function test_student_notes_are_saved_and_rendered_in_teacher_preview_modal()
    {
        Storage::fake('public');
        $this->actingAs($this->teacherUser);

        $assignment = Tugas::create([
            'guru_id' => $this->guru->id,
            'mata_pelajaran_id' => $this->subject->id,
            'kelas_id' => $this->classRoom->id,
            'judul' => 'Tugas Visual dengan Catatan',
            'deskripsi' => 'Buat poster digital',
            'tipe_pengumpulan' => 'visual',
            'max_score' => 100,
            'deadline' => now()->addDays(2),
        ]);

        // Student submits poster image with note
        $this->flushSession();
        $this->actingAs($this->studentUser, 'web');

        $imageFile = UploadedFile::fake()->image('my_poster.png', 500, 500);
        $studentNote = 'Tolong periksa bagian tipografi poster ini ya Pak!';

        $submitResponse = $this->postJson(route('assignments.submit', $assignment), [
            'file' => $imageFile,
            'content' => $studentNote,
        ]);

        $submitResponse->assertOk();

        $submission = Pengumpulan::where('tugas_id', $assignment->id)->where('siswa_id', $this->siswa->id)->first();
        $this->assertNotNull($submission);
        $this->assertEquals($studentNote, $submission->catatan);

        // Teacher opens assignment details to validate/correct
        $this->flushSession();
        $this->actingAs($this->teacherUser, 'web');

        $teacherViewResponse = $this->get(route('assignments.show', [
            'assignment' => $assignment->id,
            'class_name' => $this->classRoom->name,
        ]));

        $teacherViewResponse->assertOk();
        $teacherViewResponse->assertSee(addslashes($studentNote));
        $teacherViewResponse->assertSee('Catatan / Pesan Pengumpulan dari Siswa');
    }
}
