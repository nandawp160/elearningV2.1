<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MasterKelasController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\JadwalPelajaranController;
// use App\Http\Controllers\AttendanceController;
// use App\Http\Controllers\AttendanceSessionController;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\BandingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TeachingAssignmentController;
use Illuminate\Support\Facades\Route;

// Public route - redirect to login
// Temporary route to preview error pages
Route::get('/test-error/{code}', function ($code) {
    if (view()->exists("errors.{$code}")) {
        return view("errors.{$code}");
    }
    abort(404);
});

Route::get('/', function () {
    return redirect()->route('login');
});

// Protected routes - require authentication
Route::middleware(['auth', 'verified'])->group(function () {

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Session Heartbeat
Route::post('/heartbeat', function () {
    return response()->json(['status' => 'active']);
})->name('heartbeat');

// Student Biodata Flow
Route::middleware(['auth'])->group(function () {
    Route::get('/student/biodata', [\App\Http\Controllers\SiswaBiodataController::class, 'create'])->name('student.biodata.create');
    Route::post('/student/biodata', [\App\Http\Controllers\SiswaBiodataController::class, 'store'])->name('student.biodata.store');
    Route::post('/student/biodata/password', [\App\Http\Controllers\SiswaBiodataController::class, 'updatePassword'])->name('student.password.update');
});

// Students Management
Route::post('students/approve-all', [SiswaController::class, 'approveAll'])->name('students.approve-all');
Route::post('students/{student}/approve', [SiswaController::class, 'approve'])->name('students.approve');
Route::post('students/generate-accounts', [SiswaController::class, 'generateAccounts'])->name('students.generate-accounts');
Route::post('students/auto-plot', [SiswaController::class, 'autoPlot'])->name('students.auto-plot');
Route::get('students/by-classes', [SiswaController::class, 'getByClasses'])->name('students.by-classes');
Route::post('students/bulk-graduate', [SiswaController::class, 'bulkGraduate'])->name('students.bulk-graduate');
Route::post('students/bulk-promote', [SiswaController::class, 'bulkPromote'])->name('students.bulk-promote');
Route::post('students/promote-students', [SiswaController::class, 'promoteStudents'])->name('students.promote-students');
Route::post('students/{student}/mutasi', [SiswaController::class, 'prosesMutasiKeluar'])->name('students.mutasi');
Route::resource('students', SiswaController::class);

// Courses Management
Route::resource('courses', MataPelajaranController::class);

// Teachers Management
Route::post('teachers/auto-plot', [GuruController::class, 'autoPlot'])->name('teachers.auto-plot');
Route::resource('teachers', GuruController::class);
Route::post('teachers/{teacher}/create-user', [GuruController::class, 'createUser'])->name('teachers.create-user');
Route::post('teachers/{teacher}/teaching-classes', [GuruController::class, 'updateTeachingClasses'])->name('teachers.update-teaching-classes');
Route::get('teachers/{teacher}/resolved-subjects', [GuruController::class, 'getResolvedSubjects'])->name('teachers.resolved-subjects');


// Classrooms Management
Route::get('rolling-kelas', [KelasController::class, 'rollingIndex'])->name('rolling-kelas.index');
Route::post('rolling-kelas', [KelasController::class, 'rollingStore'])->name('rolling-kelas.store');

// Master Kelas Management
Route::get('master-classes/export', [MasterKelasController::class, 'exportExcel'])->name('master-classes.export');
Route::resource('master-classes', MasterKelasController::class);

// Classrooms Management
Route::post('classrooms/generate', [KelasController::class, 'generateFromMaster'])->name('classrooms.generate');
Route::post('classrooms/import', [KelasController::class, 'import'])->name('classrooms.import');
Route::post('classrooms/clone', [KelasController::class, 'clone'])->name('classrooms.clone');
Route::resource('classrooms', KelasController::class);
Route::post('classrooms/{classroom}/enroll', [KelasController::class, 'enroll'])->name('classrooms.enroll');
Route::delete('classrooms/{classroom}/unenroll/{student}', [KelasController::class, 'unenroll'])->name('classrooms.unenroll');

// Subjects (Scheduling)
Route::resource('subjects', JadwalPelajaranController::class);

// Assignments Management
Route::resource('assignments', TugasController::class);
Route::get('assignments/student/subject/{subject}', [TugasController::class, 'studentDetail'])
    ->name('assignments.student.detail');
Route::get('assignments/teacher/subject/{subject}', [TugasController::class, 'teacherDetail'])
    ->name('assignments.teacher.detail');
Route::patch('assignments/teacher/subjects/{subject}/classes/{kelas}/ssl-threshold', [\App\Http\Controllers\TeacherSslSettingsController::class, 'update'])
    ->name('assignments.teacher.ssl-threshold.update');
Route::get('assignments/teacher/rekap/{subject}', [TugasController::class, 'rekapNilai'])
    ->name('assignments.teacher.rekap');

Route::get('/assignments/teacher/rekap/{subject}/export', [TugasController::class, 'exportRekapNilai'])
    ->name('assignments.teacher.rekap.export');

Route::get('/assignments/{assignment}/export-rekap', [TugasController::class, 'exportSingleAssignmentRekap'])
    ->name('assignments.export-rekap');


// Submissions Management (Grading)
Route::get('submissions/{submission}', [\App\Http\Controllers\PengumpulanController::class, 'show'])->name('submissions.show');
Route::post('submissions/{submission}/grade', [\App\Http\Controllers\PengumpulanController::class, 'grade'])->name('submissions.grade');
Route::post('submissions/{submission}/toggle-koreksi', [\App\Http\Controllers\PengumpulanController::class, 'toggleKoreksi'])->name('submissions.toggle-koreksi');
Route::post('submissions/{submission}/return-revision', [\App\Http\Controllers\PengumpulanController::class, 'returnForRevision'])->name('submissions.return-revision');

// Materials Management
Route::post('materials/{id}/complete', [MateriController::class, 'complete'])->name('materials.complete');
Route::post('materials/{id}/incomplete', [MateriController::class, 'incomplete'])->name('materials.incomplete');
Route::resource('materials', MateriController::class);

// Grades Management
Route::resource('grades', NilaiController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);

// [NONAKTIF - ARSIP] Attendance Management (Dinonaktifkan untuk Sidang Skripsi)
    // Route::delete('attendances/sessions/destroy', [AttendanceController::class, 'destroySession'])->name('attendances.destroy_session');
    // Route::resource('attendances', AttendanceController::class)->except(['show', 'edit', 'update']);

    // Super Admin Landing Page
    Route::get('/landing', [\App\Http\Controllers\SuperAdminController::class, 'landing'])
        ->middleware(['auth', 'verified'])->name('landing');

    // Wali Kelas Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('homeroom/dashboard', [WaliKelasController::class, 'index'])->name('homeroom.dashboard');
        Route::get('homeroom/students', [WaliKelasController::class, 'students'])->name('homeroom.students');
        Route::get('homeroom/attendance', [WaliKelasController::class, 'attendance'])->name('homeroom.attendance');
        Route::get('homeroom/rekap-nilai', [WaliKelasController::class, 'rekapNilai'])->name('homeroom.rekap_nilai');
        Route::get('homeroom/leger-nilai', [WaliKelasController::class, 'legerNilai'])->name('homeroom.leger_nilai');
        Route::get('homeroom/leger-nilai/export', [WaliKelasController::class, 'exportLegerMentahExcel'])->name('homeroom.leger_nilai.export');
        Route::get('homeroom/rekap-nilai/export', [WaliKelasController::class, 'exportLegerExcel'])->name('homeroom.rekap_nilai.export');
        Route::get('homeroom/appeals', [WaliKelasController::class, 'appeals'])->name('homeroom.appeals');
        Route::get('homeroom/academic-chart', [WaliKelasController::class, 'academicChart'])->name('homeroom.academic_chart');
        Route::get('homeroom/academic-chart/export', [WaliKelasController::class, 'exportExcel'])->name('homeroom.academic_chart.export');
    });

// [NONAKTIF - ARSIP] QR Attendance Sessions (Dinonaktifkan untuk Sidang Skripsi)
// Route::get('attendance_sessions/{attendanceSession}/refresh', [AttendanceSessionController::class, 'refresh'])->name('attendance_sessions.refresh');
// Route::resource('attendance_sessions', AttendanceSessionController::class);

// Profile Management
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::patch('/profile/guru', [ProfileController::class, 'updateGuru'])->name('profile.guru.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Private File Downloads
Route::get('/download/material/{material}', [\App\Http\Controllers\DownloadController::class, 'material'])->name('download.material');
Route::get('/preview/material/{material}', [\App\Http\Controllers\DownloadController::class, 'previewMaterial'])->name('preview.material');
Route::get('/download/assignment/{assignment}', [\App\Http\Controllers\DownloadController::class, 'assignment'])->name('download.assignment');
Route::get('/preview/assignment/{assignment}', [\App\Http\Controllers\DownloadController::class, 'previewAssignment'])->name('preview.assignment');
Route::get('/download/submission/{submission}', [\App\Http\Controllers\DownloadController::class, 'submission'])->name('download.submission');
Route::get('/preview/submission/{submission}', [\App\Http\Controllers\DownloadController::class, 'previewSubmission'])->name('preview.submission');
Route::get('/download/appeal/{appeal}', [\App\Http\Controllers\DownloadController::class, 'appeal'])->name('download.appeal');
Route::get('/preview/appeal/{appeal}', [\App\Http\Controllers\DownloadController::class, 'previewAppeal'])->name('preview.appeal');

// Reports
Route::get('/reports/system', [LaporanController::class, 'system'])->name('reports.system');

// Settings, accounts, and permission configurations protected by admin role check
Route::middleware(['is.superadmin'])->group(function () {
    Route::get('/settings', [PengaturanController::class, 'index'])->name('settings.index');
    Route::post('/settings', [PengaturanController::class, 'update'])->name('settings.update');
    Route::post('/settings/admin-view-year', [PengaturanController::class, 'changeAdminViewYear'])->name('settings.admin-view-year');
    Route::post('/settings/global-active-year', [PengaturanController::class, 'setGlobalActiveYear'])->name('settings.global-active-year');    Route::post('/settings/unlock-maintenance', [PengaturanController::class, 'unlockMaintenance'])->name('settings.unlock-maintenance');
    Route::post('/settings/lock-maintenance', [PengaturanController::class, 'lockMaintenance'])->name('settings.lock-maintenance');
    Route::post('/settings/add-academic-year', [PengaturanController::class, 'addAcademicYear'])->name('settings.add-academic-year');
    Route::post('/settings/delete-academic-year', [PengaturanController::class, 'deleteAcademicYear'])->name('settings.delete-academic-year');
    Route::post('/settings/edit-academic-year', [PengaturanController::class, 'editAcademicYear'])->name('settings.edit-academic-year');
    
    // Fitur Pemeliharaan Data (Maintenance) Super Admin
    Route::post('/settings/toggle-ssl-deadline-lock', [PengaturanController::class, 'toggleSslDeadlineLock'])->name('settings.toggle-ssl-deadline-lock');
    Route::post('/settings/bersihkan-cache', [PengaturanController::class, 'bersihkanCache'])->name('settings.bersihkan-cache');
    Route::get('/settings/cadangkan-db', [PengaturanController::class, 'cadangkanDatabase'])->name('settings.cadangkan-db');
    Route::post('/settings/pulihkan-db', [PengaturanController::class, 'pulihkanDatabase'])->name('settings.pulihkan-db');
    Route::post('/settings/reset-data', [PengaturanController::class, 'resetData'])->name('settings.reset-data');
    Route::get('/settings/ekspor-arsip', [PengaturanController::class, 'eksporArsip'])->name('settings.ekspor-arsip');
    
    // Fitur Manajemen Penyimpanan & Arsip
    Route::post('/settings/storage/freeze', [PengaturanController::class, 'freezeStorage'])->name('settings.storage.freeze');
    Route::post('/settings/storage/unfreeze', [PengaturanController::class, 'unfreezeStorage'])->name('settings.storage.unfreeze');
    Route::post('/settings/storage/export-class', [PengaturanController::class, 'eksporArsipKelas'])->name('settings.storage.export-class');
    Route::post('/settings/storage/archive-alumni', [PengaturanController::class, 'archiveAlumniSubmissions'])->name('settings.archive-alumni');
    Route::get('/settings/storage/download-alumni-archive/{filename}', [PengaturanController::class, 'downloadAlumniArchive'])->name('settings.download-alumni-archive');
    
    Route::get('/admin-accounts', [PengaturanController::class, 'userAccounts'])->name('admin.accounts');
    Route::get('/admin-accounts/export', [PengaturanController::class, 'exportUserAccounts'])->name('admin.accounts.export');
    Route::post('/admin-accounts/{user}/reset-password', [PengaturanController::class, 'resetPassword'])->name('admin.reset-password');
    Route::post('/admin-accounts/store', [PengaturanController::class, 'storeAdmin'])->name('admin.store-admin');
    Route::put('/admin-accounts/{user}', [PengaturanController::class, 'updateUser'])->name('admin.update-user');
    Route::post('/admin-accounts/{user}/toggle-status', [PengaturanController::class, 'toggleStatus'])->name('admin.toggle-status');
    
    Route::get('/permissions', [PengaturanController::class, 'permissions'])->name('permissions.index');
    Route::post('/permissions', [PengaturanController::class, 'savePermissions'])->name('permissions.store');
    Route::post('/permissions/add-role', [PengaturanController::class, 'addRole'])->name('permissions.addRole');
    Route::delete('/permissions/delete-role/{role}', [PengaturanController::class, 'deleteRole'])->name('permissions.deleteRole');
    Route::post('/permissions/unlock', [PengaturanController::class, 'unlockPermissions'])->name('permissions.unlock');
    Route::post('/permissions/lock', [PengaturanController::class, 'lockPermissions'])->name('permissions.lock');
    Route::get('/activity-logs', [PengaturanController::class, 'activityLogs'])->name('activity-logs.index');
    
    Route::get('/academic-years', [PengaturanController::class, 'index'])->name('academic-years.index');
    Route::get('/academic-years/archive-detail/{year}', [PengaturanController::class, 'archiveDetail'])->name('academic-years.archive-detail');
    Route::get('/academic-years/arsip-siswa/{year}', [PengaturanController::class, 'arsipSiswaDetail'])->name('academic-years.arsip-siswa');
    Route::get('/academic-years/alumni-detail/{year}', [PengaturanController::class, 'alumniDetail'])->name('academic-years.alumni');
    Route::get('/academic-years/mutasi-detail/{year}', [PengaturanController::class, 'mutasiDetail'])->name('academic-years.mutasi');
    
    // Excel Download Routes for Archives
    Route::get('/academic-years/download-archive-detail/{year}', [PengaturanController::class, 'downloadArchiveDetail'])->name('academic-years.download-archive-detail');
    Route::get('/academic-years/download-alumni/{year}', [PengaturanController::class, 'downloadAlumni'])->name('academic-years.download-alumni');
    Route::get('/academic-years/download-arsip-siswa/{year}', [PengaturanController::class, 'downloadArsipSiswa'])->name('academic-years.download-arsip-siswa');
    Route::get('/academic-years/download-mutasi/{year}', [PengaturanController::class, 'downloadMutasi'])->name('academic-years.download-mutasi');
    
    Route::get('/teaching-assignments', [TeachingAssignmentController::class, 'index'])->name('teaching-assignments.index');
    Route::post('/teaching-assignments', [TeachingAssignmentController::class, 'store'])->name('teaching-assignments.store');
    Route::delete('/teaching-assignments/group/{guruId}/{mapelId}', [TeachingAssignmentController::class, 'destroyGroup'])->name('teaching-assignments.destroy-group');
    Route::delete('/teaching-assignments/{id}', [TeachingAssignmentController::class, 'destroy'])->name('teaching-assignments.destroy');
    Route::post('/teaching-assignments/toggle-class-verified/{id}', [TeachingAssignmentController::class, 'toggleClassVerified'])->name('teaching-assignments.toggle-class-verified');
    Route::post('/teaching-assignments/toggle-all-verified', [TeachingAssignmentController::class, 'toggleAllVerified'])->name('teaching-assignments.toggle-all-verified');
    
    Route::get('/homeroom-setup', [KelasController::class, 'homeroomSetup'])->name('homeroom-setup.index');
    Route::post('/homeroom-setup', [KelasController::class, 'saveHomeroomSetup'])->name('homeroom-setup.store');
    Route::get('/classroom-monitoring', function() { return "Halaman Monitoring Kelas (Placeholder)"; })->name('classroom-monitoring.index');
    Route::get('/assignment-monitoring', function() { return "Halaman Monitoring Tugas (Placeholder)"; })->name('assignment-monitoring.index');
    Route::get('/submission-monitoring', function() { return "Halaman Submission Siswa (Placeholder)"; })->name('submission-monitoring.index');
});

// Assignments & Workflow Management for Teacher/Admin
Route::middleware(['auth'])->prefix('teacher')->group(function () {
    // 1. Pengampuan Saya
    Route::get('/assignments', [TugasController::class, 'index'])->name('assignments.index');
    
    // 2. Banding Submission
    Route::get('/submission-appeals', [BandingController::class, 'index'])->name('appeals.index');
    Route::get('/submission-appeals/{appeal}/overdue', [BandingController::class, 'getOverdueData'])->name('appeals.getOverdueData');
    Route::post('/submission-appeals/{appeal}/approve', [BandingController::class, 'approve'])->name('appeals.approve');
    Route::post('/submission-appeals/{appeal}/reject', [BandingController::class, 'reject'])->name('appeals.reject');

    // 3. Riwayat Recovery
    Route::get('/recovery-history', [BandingController::class, 'history'])->name('appeals.history');

    // 4. Histori Penguncian (Audit)
    Route::get('/locking-history', [BandingController::class, 'lockingHistory'])->name('appeals.locking_history');

    // 5. Mass Emergency Release (Super Admin)
    Route::post('/submission-appeals/mass-emergency-release', [BandingController::class, 'massEmergencyRelease'])->name('appeals.mass_emergency_release');
});

// Student Submission & Appeals
Route::middleware(['auth'])->group(function () {
    Route::post('/appeals/store', [BandingController::class, 'store'])->name('appeals.store');
    Route::post('assignments/{assignment}/verify-access', [TugasController::class, 'verifyAccess'])
        ->middleware(['submission.lock'])
        ->name('assignments.verify-access');
    Route::post('assignments/{assignment}/submit', [\App\Http\Controllers\PengumpulanController::class, 'store'])
        ->middleware(['submission.lock', 'throttle:3,1'])
        ->name('assignments.submit');
    Route::post('submissions/{assignment}', [\App\Http\Controllers\PengumpulanController::class, 'store'])
        ->middleware(['submission.lock', 'throttle:3,1'])
        ->name('submissions.store');
    Route::post('/assignments/{id}/banding', [TugasController::class, 'submitBanding'])
        ->middleware('throttle:3,1')
        ->name('siswa.assignments.banding');
    
    Route::get('/student/appeals', [BandingController::class, 'studentAppeals'])->name('student.appeals.status');
    Route::delete('/student/appeals/{appeal}/cancel', [BandingController::class, 'cancelAppeal'])->name('student.appeals.cancel');
});

}); // End auth middleware group

// Auth routes (login, register, etc.) from Breeze
require __DIR__.'/auth.php';
