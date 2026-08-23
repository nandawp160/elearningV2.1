<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pengaturan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TeacherAutoPlotTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Pengaturan::setValue('tahun_ajaran_aktif', '2025/2026');

        $this->admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }

    private function createTeacher(string $nama, string $nip, ?int $specializationId = null, array $allowedGrades = [], ?string $entryYear = null): Guru
    {
        $user = User::create([
            'nama' => $nama,
            'email' => strtolower(str_replace([' ', '.'], '', $nama)) . '@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $guru = Guru::create([
            'nip' => $nip,
            'nama' => $nama,
            'email' => $user->email,
            'no_hp' => '0812345678',
            'specialization_id' => $specializationId,
            'status' => 'aktif',
            'pengguna_id' => $user->id,
            'allowed_grades' => $allowedGrades,
        ]);

        if ($entryYear) {
            $guru->setAttribute('entry_academic_year', $entryYear);
        }

        if ($specializationId) {
            $guru->mataPelajaranDiajarkan()->sync([$specializationId]);
        }

        return $guru;
    }

    /** 1. Target-year delete only */
    public function test_1_delete_target_year_only(): void
    {
        $subject = MataPelajaran::create(['kode' => 'INF-X', 'nama' => 'Informatika', 'tingkat' => 'X', 'status' => 'aktif', 'beban_jp' => 4]);
        $teacher = $this->createTeacher('Guru Informatika', '199001012020011001', $subject->id);

        $kelas2024 = Kelas::create(['name' => 'X 2024', 'grade_level' => 'X', 'academic_year' => '2024/2025']);
        $kelas2025 = Kelas::create(['name' => 'X 2025', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        DB::table('guru_kelas')->insert([
            ['guru_id' => $teacher->id, 'kelas_id' => $kelas2024->id, 'mata_pelajaran_id' => $subject->id, 'created_at' => now(), 'updated_at' => now()],
            ['guru_id' => $teacher->id, 'kelas_id' => $kelas2025->id, 'mata_pelajaran_id' => $subject->id, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $response = $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        $response->assertRedirect(route('teaching-assignments.index'));

        // Historical year 2024/2025 mapping preserved
        $this->assertDatabaseHas('guru_kelas', ['kelas_id' => $kelas2024->id, 'guru_id' => $teacher->id]);
    }

    /** 2. Teacher without subject capability is never assigned */
    public function test_2_teacher_without_subject_capability_is_never_assigned(): void
    {
        $subjectMat = MataPelajaran::create(['kode' => 'MAT-X', 'nama' => 'Matematika (Umum)', 'tingkat' => 'X', 'status' => 'aktif', 'beban_jp' => 4]);
        $subjectInf = MataPelajaran::create(['kode' => 'INF-X', 'nama' => 'Informatika', 'tingkat' => 'X', 'status' => 'aktif', 'beban_jp' => 4]);

        $teacherMat = $this->createTeacher('Guru Math Only', '199001012020011002', $subjectMat->id);
        $kelas = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        // Teacher Math Only must not get assigned to Informatika
        $this->assertDatabaseMissing('guru_kelas', [
            'guru_id' => $teacherMat->id,
            'mata_pelajaran_id' => $subjectInf->id,
        ]);
    }

    /** 3. allowed_grades restricts grade levels */
    public function test_3_allowed_grades_restricts_grade_levels(): void
    {
        $subject = MataPelajaran::create(['kode' => 'PNC-1', 'nama' => 'Pendidikan Pancasila', 'status' => 'aktif', 'beban_jp' => 2]);
        $teacherGradeXOnly = $this->createTeacher('Guru Grade X', '199001012020011003', $subject->id, ['X']);

        $kelasXI = Kelas::create(['name' => 'XI 1', 'grade_level' => 'XI', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        $this->assertDatabaseMissing('guru_kelas', [
            'guru_id' => $teacherGradeXOnly->id,
            'kelas_id' => $kelasXI->id,
        ]);
    }

    /** 4. Future entry academic year teacher is excluded */
    public function test_4_entry_academic_year_incompatible_teacher_is_excluded(): void
    {
        $subject = MataPelajaran::create(['kode' => 'BIN-1', 'nama' => 'Bahasa Indonesia', 'status' => 'aktif', 'beban_jp' => 4]);
        $teacherFuture = $this->createTeacher('Guru Future', '199001012020011004', $subject->id);

        Guru::retrieved(function ($guru) {
            if ($guru->nip === '199001012020011004') {
                $guru->entry_academic_year = '2026/2027';
            }
        });

        $kelas = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        $this->assertDatabaseMissing('guru_kelas', [
            'guru_id' => $teacherFuture->id,
            'kelas_id' => $kelas->id,
        ]);
    }

    /** 5. Projected load under target 30 is prioritized */
    public function test_5_projected_load_under_target_30_is_prioritized(): void
    {
        $subject = MataPelajaran::create(['kode' => 'BIG-1', 'nama' => 'Bahasa Inggris', 'status' => 'aktif', 'beban_jp' => 4]);

        $guruHeavy = $this->createTeacher('Guru Heavy Load', '199001012020011005', $subject->id);
        $guruHeavy->update(['tugas_tambahan_jtm' => 28]); // load 28 JTM

        $guruLight = $this->createTeacher('Guru Light Load', '199001012020011006', $subject->id);
        $guruLight->update(['tugas_tambahan_jtm' => 10]); // load 10 JTM

        $kelas = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        // Light load teacher must be picked first
        $this->assertDatabaseHas('guru_kelas', [
            'guru_id' => $guruLight->id,
            'kelas_id' => $kelas->id,
        ]);
    }

    /** 6. Hard max 44 JTM is strictly enforced */
    public function test_6_hard_max_44_jtm_is_strictly_enforced(): void
    {
        $subject = MataPelajaran::create(['kode' => 'PJOK-1', 'nama' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'status' => 'aktif', 'beban_jp' => 4]);
        $teacher = $this->createTeacher('Guru Maxed', '199001012020011007', $subject->id);
        $teacher->update(['tugas_tambahan_jtm' => 42]); // load 42 + 4 = 46 > 44

        $kelas = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        $this->assertDatabaseMissing('guru_kelas', [
            'guru_id' => $teacher->id,
            'kelas_id' => $kelas->id,
        ]);
    }

    /** 7. Sole teacher hard cap strictly stops at 44 (no 120 JTM bypass) */
    public function test_7_sole_teacher_hard_cap_strictly_stops_at_44(): void
    {
        $subject = MataPelajaran::create(['kode' => 'SNB-1', 'nama' => 'Seni dan Budaya', 'status' => 'aktif', 'beban_jp' => 4]);
        $soleTeacher = $this->createTeacher('Guru Sole Seni', '199001012020011008', $subject->id);
        $soleTeacher->update(['tugas_tambahan_jtm' => 42]); // load 42 + 4 = 46 > 44

        $kelas = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        $response = $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        $response->assertSessionHas('unassigned');
        $this->assertDatabaseMissing('guru_kelas', [
            'guru_id' => $soleTeacher->id,
            'kelas_id' => $kelas->id,
        ]);
    }

    /** 8. Scarce subject processed before flexible subject */
    public function test_8_scarce_subject_processed_before_flexible_subject(): void
    {
        $subCommon = MataPelajaran::create(['kode' => 'MLK-1', 'nama' => 'Muatan Lokal Bahasa Daerah', 'status' => 'aktif', 'beban_jp' => 2]);
        $subScarce = MataPelajaran::create(['kode' => 'BK-1', 'nama' => 'Bimbingan dan Konseling/Konselor (BP/BK)', 'status' => 'aktif', 'beban_jp' => 2]);

        // Flexible teacher can teach both, but is the ONLY one who can teach BK
        $teacherFlexible = $this->createTeacher('Guru Flexible', '199001012020011009');
        $teacherFlexible->mataPelajaranDiajarkan()->sync([$subCommon->id, $subScarce->id]);

        $teacherCommonOnly = $this->createTeacher('Guru Mulok Only', '199001012020011010', $subCommon->id);

        $kelas = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        // Scarce subject (BK) must be assigned to flexible teacher
        $this->assertDatabaseHas('guru_kelas', [
            'guru_id' => $teacherFlexible->id,
            'mata_pelajaran_id' => $subScarce->id,
            'kelas_id' => $kelas->id,
        ]);
    }

    /** 9. Flexible teacher protected for scarce slot */
    public function test_9_flexible_teacher_not_consumed_early(): void
    {
        $subPai = MataPelajaran::create(['kode' => 'PAI-1', 'nama' => 'Pendidikan Agama Islam dan Budi Pekerti', 'status' => 'aktif', 'beban_jp' => 3]);
        $subInf = MataPelajaran::create(['kode' => 'INF-1', 'nama' => 'Informatika', 'status' => 'aktif', 'beban_jp' => 3]);

        $teacherMulti = $this->createTeacher('Guru Multi', '199001012020011011');
        $teacherMulti->mataPelajaranDiajarkan()->sync([$subPai->id, $subInf->id]);

        $teacherPaiOnly = $this->createTeacher('Guru PAI Only', '199001012020011012', $subPai->id);

        $kelas = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        // Multi teacher should be preserved for Informatika slot (1 candidate), while PAI goes to PAI Only
        $this->assertDatabaseHas('guru_kelas', ['guru_id' => $teacherMulti->id, 'mata_pelajaran_id' => $subInf->id]);
        $this->assertDatabaseHas('guru_kelas', ['guru_id' => $teacherPaiOnly->id, 'mata_pelajaran_id' => $subPai->id]);
    }

    /** 10. Equal load tie break uses guru.id ASC */
    public function test_10_equal_load_tie_break_uses_guru_id_asc(): void
    {
        $subject = MataPelajaran::create(['kode' => 'INF-1', 'nama' => 'Informatika', 'status' => 'aktif', 'beban_jp' => 4]);

        $guru1 = $this->createTeacher('Guru A', '199001012020011013', $subject->id);
        $guru2 = $this->createTeacher('Guru B', '199001012020011014', $subject->id);

        $kelas = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        $firstGuruId = min($guru1->id, $guru2->id);

        $this->assertDatabaseHas('guru_kelas', [
            'guru_id' => $firstGuruId,
            'kelas_id' => $kelas->id,
        ]);
    }

    /** 11. Idempotent execution produces identical mapping */
    public function test_11_idempotent_execution_produces_identical_mapping(): void
    {
        $subject = MataPelajaran::create(['kode' => 'BIN-1', 'nama' => 'Bahasa Indonesia', 'status' => 'aktif', 'beban_jp' => 4]);
        $teacher = $this->createTeacher('Guru Indo', '199001012020011015', $subject->id);
        $kelas = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        // First run
        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);
        $mapping1 = DB::table('guru_kelas')->get()->toArray();

        // Second run
        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);
        $mapping2 = DB::table('guru_kelas')->get()->toArray();

        $this->assertEquals(count($mapping1), count($mapping2));
        $this->assertEquals($mapping1[0]->guru_id, $mapping2[0]->guru_id);
    }

    /** 12. Grade X core contract includes Informatika, not Sejarah or integration guessing */
    public function test_12_grade_x_core_contract_includes_informatika_not_sejarah_or_integration_guessing(): void
    {
        $subInf = MataPelajaran::create(['kode' => 'INF-1', 'nama' => 'Informatika', 'status' => 'aktif', 'beban_jp' => 4]);
        $subSj = MataPelajaran::create(['kode' => 'SEJ-1', 'nama' => 'Sejarah', 'status' => 'aktif', 'beban_jp' => 2]);

        $teacherInf = $this->createTeacher('Guru Inf', '199001012020011016', $subInf->id);
        $teacherSj = $this->createTeacher('Guru Sej', '199001012020011017', $subSj->id);

        $kelasX = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        // Grade X must get Informatika, but NOT Sejarah
        $this->assertDatabaseHas('guru_kelas', ['kelas_id' => $kelasX->id, 'mata_pelajaran_id' => $subInf->id]);
        $this->assertDatabaseMissing('guru_kelas', ['kelas_id' => $kelasX->id, 'mata_pelajaran_id' => $subSj->id]);
    }

    /** 13. Fase F core contract includes Sejarah */
    public function test_13_fase_f_core_contract_includes_sejarah(): void
    {
        $subSj = MataPelajaran::create(['kode' => 'SEJ-1', 'nama' => 'Sejarah', 'status' => 'aktif', 'beban_jp' => 2]);
        $teacherSj = $this->createTeacher('Guru Sej', '199001012020011018', $subSj->id);

        $kelasXI = Kelas::create(['name' => 'XI 1', 'grade_level' => 'XI', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        $this->assertDatabaseHas('guru_kelas', ['kelas_id' => $kelasXI->id, 'mata_pelajaran_id' => $subSj->id]);
    }

    /** 14. Fase F ambiguous electives are not auto-assigned */
    public function test_14_fase_f_ambiguous_electives_are_not_auto_assigned(): void
    {
        $subFisika = MataPelajaran::create(['kode' => 'FIS-1', 'nama' => 'Fisika', 'status' => 'aktif', 'beban_jp' => 4]);
        $teacherFisika = $this->createTeacher('Guru Fisika', '199001012020011019', $subFisika->id);

        $kelasXI = Kelas::create(['name' => 'XI F 1', 'grade_level' => 'XI', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        // Electives are MANUAL_REQUIRED, so Fisika must not be auto-assigned
        $this->assertDatabaseMissing('guru_kelas', ['kelas_id' => $kelasXI->id, 'mata_pelajaran_id' => $subFisika->id]);
    }

    /** 15. F1/F2/F3/F4 rombel naming does not infer elective package */
    public function test_15_rombel_naming_f1_f2_f3_f4_does_not_infer_elective_package(): void
    {
        $subEko = MataPelajaran::create(['kode' => 'EKO-1', 'nama' => 'Ekonomi', 'status' => 'aktif', 'beban_jp' => 4]);
        $teacherEko = $this->createTeacher('Guru Ekonomi', '199001012020011020', $subEko->id);

        $kelasF3 = Kelas::create(['name' => 'XI F 3.1', 'grade_level' => 'XI', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        $this->assertDatabaseMissing('guru_kelas', ['kelas_id' => $kelasF3->id, 'mata_pelajaran_id' => $subEko->id]);
    }

    /** 16. No candidate results in unassigned without invalid DB row */
    public function test_16_no_candidate_results_in_unassigned_without_invalid_row(): void
    {
        $subPai = MataPelajaran::create(['kode' => 'PAI-1', 'nama' => 'Pendidikan Agama Islam dan Budi Pekerti', 'status' => 'aktif', 'beban_jp' => 3]);
        // No teacher created for PAI

        $kelas = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        $response = $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        $response->assertSessionHas('unassigned');
        $this->assertDatabaseMissing('guru_kelas', ['kelas_id' => $kelas->id, 'mata_pelajaran_id' => $subPai->id]);
    }

    /** 17. One class + one subject => max one teacher */
    public function test_17_unique_assignment_per_class_subject(): void
    {
        $subBin = MataPelajaran::create(['kode' => 'BIN-1', 'nama' => 'Bahasa Indonesia', 'status' => 'aktif', 'beban_jp' => 4]);

        $g1 = $this->createTeacher('Guru Indo 1', '199001012020011021', $subBin->id);
        $g2 = $this->createTeacher('Guru Indo 2', '199001012020011022', $subBin->id);

        $kelas = Kelas::create(['name' => 'X 1', 'grade_level' => 'X', 'academic_year' => '2025/2026']);

        $this->from(route('teaching-assignments.index'))
            ->actingAs($this->admin)
            ->post(route('teachers.auto-plot'), ['tahun_ajaran' => '2025/2026']);

        $assignedCount = DB::table('guru_kelas')
            ->where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $subBin->id)
            ->count();

        $this->assertEquals(1, $assignedCount);
    }
}
