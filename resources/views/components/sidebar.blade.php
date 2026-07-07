<?php
$user = auth()->user();
$role = $user->role ?? '';
if ($role === 'siswa') $role = 'student';
if ($role === 'guru') $role = 'teacher';
if ($role === 'admin') $role = 'super_admin';
$currentRoute = request()->route()->getName();
if (!function_exists('isActive')) {
    function isActive($routes) {
        $current = request()->route()->getName();
        foreach ((array)$routes as $route) {
            if (str_starts_with($current, $route)) return true;
        }
        return false;
    }
}
?>

@if($role === 'student')
<style>
    /* CSS STUDENT SIDEBAR - CONSISTENT WITH SUPER ADMIN (ORANGE #D65A20) */
    #sidebar {
        background-color: #D65A20 !important;
        border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
    }
    #sidebar .border-b {
        border-color: rgba(255, 255, 255, 0.15) !important;
    }
    #sidebar .border-b p.text-gray-900,
    #sidebar .border-b p.dark\:text-white {
        color: #ffffff !important;
    }
    #sidebar .border-b p.text-[#D65A20] {
        color: rgba(255, 255, 255, 0.85) !important;
    }
    #sidebar button[onclick="closeSidebar()"] {
        color: rgba(255, 255, 255, 0.7) !important;
    }
    #sidebar button[onclick="closeSidebar()"]:hover {
        color: #ffffff !important;
    }
    .sidebar-student-link {
        color: rgba(255, 255, 255, 0.85) !important;
        background-color: transparent !important;
        transition: all 150ms ease-in-out;
        border: none !important;
        font-weight: 600 !important;
        display: flex;
        align-items: center;
    }
    .sidebar-student-link i {
        color: rgba(255, 255, 255, 0.85) !important;
        transition: all 150ms ease-in-out;
    }
    .sidebar-student-link:hover {
        background-color: rgba(255, 255, 255, 0.12) !important;
        color: #ffffff !important;
    }
    .sidebar-student-link:hover i {
        color: #ffffff !important;
    }
    .sidebar-student-link.active {
        background-color: rgba(255, 255, 255, 0.18) !important;
        color: #ffffff !important;
        border-left: 4px solid #ffffff !important;
        border-top-left-radius: 0px !important;
        border-bottom-left-radius: 0px !important;
    }
    .sidebar-student-link.active i {
        color: #ffffff !important;
    }
    #sidebar .text-slate-400.uppercase,
    #sidebar .text-gray-400.uppercase {
        color: rgba(255, 255, 255, 0.60) !important;
    }
    #sidebar .border-t {
        border-color: rgba(255, 255, 255, 0.15) !important;
    }
    #sidebar .border-t > div {
        background-color: rgba(255, 255, 255, 0.08) !important;
        border-radius: 0.75rem;
        padding: 0.75rem !important;
    }
    #sidebar .border-t p.text-gray-900,
    #sidebar .border-t p.dark\:text-white {
        color: #ffffff !important;
    }
    #sidebar .border-t p.text-slate-400,
    #sidebar .border-t p.dark\:text-slate-550 {
        color: rgba(255, 255, 255, 0.65) !important;
    }
    #sidebar .border-t button {
        color: rgba(255, 255, 255, 0.7) !important;
        border-color: rgba(255, 255, 255, 0.15) !important;
    }
    #sidebar .border-t button:hover {
        background-color: rgba(239, 68, 68, 0.2) !important;
        color: #ef4444 !important;
        border-color: rgba(239, 68, 68, 0.2) !important;
    }
    /* Avatar default badge or avatar wrapper for student */
    #sidebar .w-9.h-9.rounded-full.border-orange-100 {
        border-color: rgba(255, 255, 255, 0.2) !important;
        background: rgba(255, 255, 255, 0.2) !important;
    }
</style>
@else
<style>
    /* CSS REDESIGN SIDEBAR - SMAN 1 CEPOGO (ORANGE #D65A20) */
    
    /* 1. Background Sidebar */
    #sidebar {
        background-color: #D65A20 !important;
        border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
    }

    /* 2. Logo & Header Border */
    #sidebar .border-b {
        border-color: rgba(255, 255, 255, 0.15) !important;
    }
    #sidebar .border-b p.text-gray-900,
    #sidebar .border-b p.dark\:text-white {
        color: #ffffff !important;
    }
    #sidebar .border-b p.text-gray-400,
    #sidebar .border-b p.dark\:text-slate-500 {
        color: rgba(255, 255, 255, 0.65) !important;
    }

    /* 3. Mobile Close Button */
    #sidebar button[onclick="closeSidebar()"] {
        color: rgba(255, 255, 255, 0.7) !important;
    }
    #sidebar button[onclick="closeSidebar()"]:hover {
        color: #ffffff !important;
    }

    /* 4. Judul Kategori (Category Headers) */
    #sidebar .text-gray-400.uppercase {
        color: rgba(255, 255, 255, 0.60) !important;
    }

    /* 5. Menu Link (Default State) - Text & Icon */
    .sidebar-link {
        color: rgba(255, 255, 255, 0.85) !important;
        background-color: transparent !important;
        transition: all 150ms ease-in-out;
        border: none !important;
        box-shadow: none !important;
    }
    .sidebar-link i {
        color: rgba(255, 255, 255, 0.85) !important;
        transition: all 150ms ease-in-out;
    }

    /* 6. Hover Menu Link */
    .sidebar-link:hover {
        background-color: rgba(255, 255, 255, 0.12) !important;
        color: #ffffff !important;
    }
    .sidebar-link:hover i {
        color: #ffffff !important;
    }

    /* 7. Active Menu Link */
    .sidebar-link.active {
        background-color: rgba(255, 255, 255, 0.18) !important;
        color: #ffffff !important;
        border-left: 4px solid #ffffff !important;
        border-top-left-radius: 0px !important;
        border-bottom-left-radius: 0px !important;
    }
    .sidebar-link.active i {
        color: #ffffff !important;
    }

    /* 8. Submenu Link (Default State) */
    .sidebar-submenu-link {
        color: rgba(255, 255, 255, 0.75) !important;
        transition: all 150ms ease-in-out;
        display: flex;
        align-items: center;
        gap: 0.625rem;
        padding-top: 0.625rem;
        padding-bottom: 0.625rem;
        font-size: 14px;
        font-weight: 500;
    }
    .sidebar-submenu-link i {
        color: rgba(255, 255, 255, 0.4) !important;
        transition: all 150ms ease-in-out;
    }

    /* Submenu Link Hover State */
    .sidebar-submenu-link:hover {
        color: #ffffff !important;
    }
    .sidebar-submenu-link:hover i {
        color: rgba(255, 255, 255, 0.8) !important;
    }

    /* Submenu Link Active State */
    .sidebar-submenu-link.active {
        color: #ffffff !important;
        font-weight: 700 !important;
    }
    .sidebar-submenu-link.active i {
        color: #ffffff !important;
        opacity: 1 !important;
    }

    /* 9. Card User Bagian Bawah */
    #sidebar .border-t {
        border-color: rgba(255, 255, 255, 0.15) !important;
    }
    #sidebar .border-t > div {
        background-color: rgba(255, 255, 255, 0.08) !important;
        border-radius: 0.75rem;
        padding: 0.75rem !important;
    }
    #sidebar .border-t p.text-gray-900,
    #sidebar .border-t p.dark\:text-white {
        color: #ffffff !important;
    }
    #sidebar .border-t p.text-gray-400,
    #sidebar .border-t p.dark\:text-slate-500 {
        color: rgba(255, 255, 255, 0.65) !important;
    }
    #sidebar .border-t button {
        color: rgba(255, 255, 255, 0.7) !important;
    }
    #sidebar .border-t button:hover {
        background-color: rgba(239, 68, 68, 0.2) !important;
        color: #ef4444 !important;
    }

    /* Avatar default badge */
    #sidebar .w-9.h-9.rounded-full {
        background: rgba(255, 255, 255, 0.2) !important;
        color: #ffffff !important;
    }
</style>
@endif



<nav id="sidebar"
     class="fixed inset-y-0 left-0 z-30 flex flex-col w-72 bg-white dark:bg-slate-900 border-r border-gray-100 dark:border-slate-800 shadow-sm transition-transform duration-300 -translate-x-full lg:translate-x-0"
     style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <!-- Logo -->
    @if(request()->routeIs('homeroom.*'))
    <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-100 dark:border-slate-800 relative w-full">
        <img src="{{ asset('assets/logo/logo.jpeg') }}" alt="Logo SMAN 1 Cepogo" class="w-10 h-10 object-contain rounded-xl shadow-sm flex-shrink-0">
        <div class="overflow-hidden">
            <p class="font-bold text-gray-900 dark:text-white text-[15px] leading-tight tracking-wide">E_LEARNING</p>
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Portal Wali Kelas</p>
        </div>
        <!-- Mobile close button -->
        <button onclick="closeSidebar()" class="absolute top-6 right-6 lg:hidden text-gray-400 hover:text-white transition-colors">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>
    @elseif($role === 'student')
    <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-100 dark:border-slate-800 relative w-full">
        <img src="{{ asset('assets/logo/logo.jpeg') }}" alt="Logo SMAN 1 Cepogo" class="w-10 h-10 object-contain rounded-xl shadow-sm flex-shrink-0">
        <div class="overflow-hidden">
            <p class="font-bold text-gray-900 dark:text-white text-[15px] leading-tight tracking-wide">E_LEARNING</p>
            <p class="text-[11px] font-bold text-[#D65A20] uppercase tracking-wider">Portal Siswa</p>
        </div>
        <!-- Mobile close button -->
        <button onclick="closeSidebar()" class="absolute top-6 right-6 lg:hidden text-slate-450 hover:text-slate-650 transition-colors">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>
    @else
    <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-100 dark:border-slate-800">
        <img src="{{ asset('assets/logo/logo.jpeg') }}" alt="Logo SMAN 1 Cepogo" class="w-10 h-10 object-contain rounded-xl shadow-sm flex-shrink-0">
        <div class="overflow-hidden">
            <p class="font-bold text-gray-900 dark:text-white text-sm leading-tight truncate">SMA N 1 Cepogo</p>
            <p class="text-[11px] text-gray-400 dark:text-slate-500 truncate">Wasis Waskitha Hanuraga</p>
        </div>
        <!-- Mobile close button -->
        <button onclick="closeSidebar()" class="ml-auto lg:hidden text-gray-400 hover:text-gray-600 dark:hover:text-slate-300 transition-colors">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>
    @endif

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-y-auto py-4 px-3">
        <ul class="space-y-0.5">
            @if($role !== 'student')
                @if($role === 'teacher' && request()->routeIs('homeroom.*'))
                    <!-- Dashboard Wali Kelas -->
                    <li>
                        <a href="{{ route('homeroom.dashboard') }}"
                           class="sidebar-link flex items-center justify-between px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ request()->routeIs('homeroom.dashboard') ? 'active' : '' }}">
                            <div class="flex items-center gap-3.5">
                                <i class="fas fa-house-user w-5 text-center"></i>
                                Dashboard Utama
                            </div>
                            <i class="fas fa-chevron-right text-[10px] opacity-40"></i>
                        </a>
                    </li>
                @else
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="sidebar-link flex items-center justify-between px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ isActive('dashboard') ? 'active' : '' }}">
                            <div class="flex items-center gap-3.5">
                                <i class="fas fa-gauge-high w-5 text-center"></i>
                                @if($role === 'teacher')
                                    Dashboard Utama
                                @else
                                    Dashboard
                                @endif
                            </div>
                            @if(isActive('dashboard'))
                            <i class="fas fa-chevron-right text-[10px]"></i>
                            @endif
                        </a>
                    </li>
                @endif
            @endif

            @if($role === 'super_admin' || $role === 'admin')
                {{-- â”€â”€ DATA SECTION â”€â”€ --}}
                <div class="px-4 pt-4 pb-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-wider">
                    Data
                </div>
                <li>
                    <a href="{{ route('academic-years.index') }}"
                       class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ request()->routeIs('academic-years.*') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fas fa-calendar-alt w-5 text-center"></i>
                            Tahun Ajaran
                        </div>
                        <i class="fas fa-chevron-right text-[9px] opacity-40"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('students.index') }}"
                       class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ request()->routeIs('students.*') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fas fa-user-graduate w-5 text-center"></i>
                            Data Siswa
                        </div>
                        <i class="fas fa-chevron-right text-[9px] opacity-40"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teachers.index') }}"
                       class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fas fa-user-tie w-5 text-center"></i>
                            Data Guru
                        </div>
                        <i class="fas fa-chevron-right text-[9px] opacity-40"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('classrooms.index') }}"
                       class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ request()->routeIs('classrooms.*') || request()->routeIs('homeroom-setup.*') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fas fa-chalkboard w-5 text-center"></i>
                            Kelas
                        </div>
                        <i class="fas fa-chevron-right text-[9px] opacity-40"></i>
                    </a>
                </li>
                {{-- 
                <li>
                    <a href="{{ route('rolling-kelas.index') }}"
                       class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ request()->routeIs('rolling-kelas.*') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fas fa-exchange-alt w-5 text-center"></i>
                            Rolling Kelas
                        </div>
                        <i class="fas fa-chevron-right text-[9px] opacity-40"></i>
                    </a>
                </li>
                --}}
                <li>
                    <a href="{{ route('courses.index') }}"
                       class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fas fa-book-open w-5 text-center"></i>
                            Mata Pelajaran
                        </div>
                        <i class="fas fa-chevron-right text-[9px] opacity-40"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teaching-assignments.index') }}"
                       class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ request()->routeIs('teaching-assignments.*') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fas fa-network-wired w-5 text-center"></i>
                            Pengampuan Guru
                        </div>
                        <i class="fas fa-chevron-right text-[9px] opacity-40"></i>
                    </a>
                </li>

                {{-- â”€â”€ LAPORAN SECTION (TEMPORARILY HIDDEN) â”€â”€
                <div class="px-4 pt-4 pb-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-wider">
                    Laporan
                </div>
                <li>
                    <a href="{{ route('reports.system') }}"
                       class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fas fa-chart-pie w-5 text-center"></i>
                            Laporan
                        </div>
                        <i class="fas fa-chevron-right text-[9px] opacity-40"></i>
                    </a>
                </li>
                --}}

                {{-- â”€â”€ PENGATURAN SECTION â”€â”€ --}}
                <div class="px-4 pt-4 pb-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-wider">
                    Pengaturan
                </div>
                <li>
                    <a href="{{ route('permissions.index') }}"
                       class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fas fa-shield-halved w-5 text-center"></i>
                            Pengaturan Hak Akses
                        </div>
                        <i class="fas fa-chevron-right text-[9px] opacity-40"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.accounts') }}"
                       class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ request()->routeIs('admin.accounts') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fas fa-users-gear w-5 text-center"></i>
                            Akun Pengguna
                        </div>
                        <i class="fas fa-chevron-right text-[9px] opacity-40"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings.index') }}"
                       class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ request()->routeIs('settings.index') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fas fa-sliders w-5 text-center"></i>
                            Pengaturan Sistem
                        </div>
                        <i class="fas fa-chevron-right text-[9px] opacity-40"></i>
                    </a>
                </li>

            @elseif($role === 'teacher')
                @if(request()->routeIs('homeroom.*'))
                    {{-- â”€â”€ WALI KELAS STRUCTURE (Homeroom Context) â”€â”€ --}}
                    <div class="px-4 pt-4 pb-2 text-[11px] font-bold text-white/60 uppercase tracking-wider">
                        MONITORING KELAS
                    </div>
                    <li>
                        <a href="{{ route('homeroom.students') }}"
                           class="sidebar-link flex items-center justify-between px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ request()->routeIs('homeroom.students') ? 'active' : '' }}">
                            <div class="flex items-center gap-3.5">
                                <i class="fas fa-address-book w-5 text-center"></i>
                                Data Peserta Didik
                            </div>
                            <i class="fas fa-chevron-right text-[10px] opacity-40"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('homeroom.appeals') }}"
                           class="sidebar-link flex items-center justify-between px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ request()->routeIs('homeroom.appeals') ? 'active' : '' }}">
                            <div class="flex items-center gap-3.5">
                                <i class="fas fa-square-check w-5 text-center"></i>
                                Banding Keterlambatan
                            </div>
                            @php
                                $pendingAppealsCount = 0;
                                if (auth()->check()) {
                                    $teacherClass = \App\Models\Kelas::where('homeroom_teacher_id', auth()->user()->teacher_id)->first();
                                    if ($teacherClass) {
                                        $pendingAppealsCount = \App\Models\Banding::where('status', 'ditinjau')
                                            ->whereHas('student', function($q) use ($teacherClass) {
                                                $q->where('kelas', $teacherClass->name);
                                            })->count();
                                    }
                                }
                            @endphp
                            <div class="flex items-center gap-2">
                                @if($pendingAppealsCount > 0)
                                <span class="inline-flex items-center justify-center w-5 h-5 text-[10px] font-extrabold text-white bg-red-500 rounded-full shadow-sm">
                                    {{ $pendingAppealsCount }}
                                </span>
                                @endif
                                <i class="fas fa-chevron-right text-[10px] opacity-40"></i>
                            </div>
                        </a>
                    </li>

                    <div class="px-4 pt-4 pb-2 text-[11px] font-bold text-white/60 uppercase tracking-wider">
                        LAPORAN EKSEKUTIF
                    </div>
                    <li>
                        <a href="{{ route('homeroom.academic_chart') }}"
                           class="sidebar-link flex items-center justify-between px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ request()->routeIs('homeroom.academic_chart') ? 'active' : '' }}">
                            <div class="flex items-center gap-3.5">
                                <i class="fas fa-chart-pie w-5 text-center"></i>
                                Grafik Akademik
                            </div>
                            <i class="fas fa-chevron-right text-[10px] opacity-40"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('homeroom.rekap_nilai') }}"
                           class="sidebar-link flex items-center justify-between px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ request()->routeIs('homeroom.rekap_nilai') ? 'active' : '' }}">
                            <div class="flex items-center gap-3.5">
                                <i class="fas fa-circle-notch w-5 text-center"></i>
                                Leger Kepatuhan Tugas
                            </div>
                            <i class="fas fa-chevron-right text-[10px] opacity-40"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('homeroom.leger_nilai') }}"
                           class="sidebar-link flex items-center justify-between px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ request()->routeIs('homeroom.leger_nilai') ? 'active' : '' }}">
                            <div class="flex items-center gap-3.5">
                                <i class="fas fa-table w-5 text-center"></i>
                                Leger Nilai Tugas
                            </div>
                            <i class="fas fa-chevron-right text-[10px] opacity-40"></i>
                        </a>
                    </li>

                @else
                    {{-- â”€â”€ TEACHER STRUCTURE (Teacher Context) â”€â”€ --}}
                    <div class="px-4 pt-4 pb-2 text-[11px] font-bold text-white/60 uppercase tracking-wider">
                        MODUL AKADEMIK
                    </div>
                    <li>
                        <a href="{{ route('materials.index') }}"
                           class="sidebar-link flex items-center gap-3.5 px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ isActive('materials') ? 'active' : '' }}">
                            <i class="fas fa-folder-open w-5 text-center text-white/80"></i>
                            Materi Pembelajaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assignments.index') }}"
                           class="sidebar-link flex items-center gap-3.5 px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ isActive('assignments') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-list w-5 text-center text-white/80"></i>
                            Tugas & Evaluasi
                        </a>
                    </li>

                    <div class="px-4 pt-4 pb-2 text-[11px] font-bold text-white/60 uppercase tracking-wider">
                        RESOLUSI & BANDING
                    </div>
                    <li>
                        @php
                            $activeAppealsCount = 0;
                            if (auth()->check() && auth()->user()->isTeacher() && auth()->user()->guru) {
                                $activeAppealsCount = \App\Models\Banding::where('status', 'ditinjau')
                                    ->where('mata_pelajaran_id', auth()->user()->guru->specialization_id)
                                    ->count();
                            }
                        @endphp
                        <a href="{{ route('appeals.index') }}"
                           class="sidebar-link flex items-center justify-between px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ isActive('appeals') ? 'active' : '' }}">
                            <div class="flex items-center gap-3.5">
                                <i class="fas fa-file-shield w-5 text-center text-white/80"></i>
                                Daftar Pengajuan Banding
                            </div>
                            @if($activeAppealsCount > 0)
                                <span class="inline-flex items-center justify-center w-5 h-5 text-[10px] font-extrabold text-red-600 bg-white rounded-full shadow-md">
                                    {{ $activeAppealsCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    <div class="px-4 pt-4 pb-2 text-[11px] font-bold text-white/60 uppercase tracking-wider">
                        PENGATURAN PRIBADI
                    </div>
                    <li>
                        <a href="{{ route('profile.edit') }}"
                           class="sidebar-link flex items-center gap-3.5 px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ isActive('profile') ? 'active' : '' }}">
                            <i class="fas fa-user-gear w-5 text-center text-white/80"></i>
                            Profil Saya
                        </a>
                    </li>
                @endif

            @elseif($role === 'student')
                {{-- REDESIGNED STUDENT STRUCTURE --}}
                <div class="px-4 pt-4 pb-2 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                    MENU AKADEMIK
                </div>
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="sidebar-student-link flex items-center justify-between px-4 py-3 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ isActive('dashboard') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fa-regular fa-house w-5 text-center text-lg"></i>
                            Dashboard
                        </div>
                        @if(isActive('dashboard'))
                        <i class="fas fa-chevron-right text-[10px]"></i>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('materials.index') }}"
                       class="sidebar-student-link flex items-center justify-between px-4 py-3 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ isActive('materials') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fa-regular fa-folder-open w-5 text-center text-lg"></i>
                            Materi Pembelajaran
                        </div>
                        @if(isActive('materials'))
                        <i class="fas fa-chevron-right text-[10px]"></i>
                        @endif
                    </a>
                </li>
                <li>
                    @php
                        $pendingAssignmentsCount = 0;
                        if (auth()->check() && auth()->user()->isStudent() && auth()->user()->student) {
                            $studentId = auth()->user()->student->id;
                            $pendingAssignmentsCount = \App\Models\Tugas::where('status', 'aktif')
                                ->whereDoesntHave('submissions', function($q) use ($studentId) {
                                    $q->where('siswa_id', $studentId);
                                })->count();
                        }
                    @endphp
                    <a href="{{ route('assignments.index') }}"
                       class="sidebar-student-link flex items-center justify-between px-4 py-3 rounded-xl text-[14px] font-semibold transition-all duration-150 {{ isActive('assignments') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fa-regular fa-clipboard w-5 text-center text-lg"></i>
                            Daftar Tugas
                        </div>
                        <div class="flex items-center gap-2">
                            @if(isActive('assignments'))
                            <i class="fas fa-chevron-right text-[10px]"></i>
                            @endif
                        </div>
                    </a>
                </li>

                <div class="px-4 pt-6 pb-2 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                    RESOLUSI & BANDING
                </div>
                <li>
                    <a href="{{ route('student.appeals.status') }}"
                       class="sidebar-student-link flex items-center justify-between px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ isActive('student.appeals.status') ? 'active' : '' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fa-regular fa-clock w-5 text-center text-lg"></i>
                            Status Banding (SSL)
                        </div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.biodata.create') }}"
                       class="sidebar-student-link flex items-center gap-3.5 px-4 py-3 rounded-xl text-[15px] font-semibold transition-all duration-150 {{ isActive('student.biodata') ? 'active' : '' }}">
                        <i class="fas fa-id-card w-5 text-center"></i>
                        Biodata Saya
                    </a>
                </li>
            @endif

        </ul>
    </div>

    <!-- User Profile (bottom) -->
    <div class="border-t border-gray-100 dark:border-slate-800 p-4">
        <div class="flex items-center gap-3 px-2">
            @if($role === 'student')
                <div class="w-9 h-9 rounded-full bg-[#fdf2ec] text-[#D65A20] flex items-center justify-center font-bold text-sm flex-shrink-0 overflow-hidden border border-orange-100">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=fdf2ec&color=D65A20&bold=true" alt="Avatar" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[14px] font-bold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] font-medium text-slate-400 dark:text-slate-550 truncate capitalize">Siswa</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" onsubmit="event.preventDefault(); pendingLogoutForm = this; openLogoutModal();">
                    @csrf
                    <button type="submit" title="Keluar"
                            class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:bg-rose-50 hover:text-rose-600 dark:hover:bg-rose-950/30 dark:hover:text-rose-400 transition-all duration-200 border border-slate-100 dark:border-slate-800 hover:border-rose-100 dark:hover:border-rose-900/30 shadow-sm hover:shadow focus:outline-none">
                        <i class="fas fa-arrow-right-from-bracket text-xs"></i>
                    </button>
                </form>
            @else
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[15px] font-bold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[12px] font-medium text-gray-400 dark:text-slate-550 truncate capitalize">{{ $role }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" onsubmit="event.preventDefault(); pendingLogoutForm = this; openLogoutModal();">
                    @csrf
                    <button type="submit" title="Keluar"
                            class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-900/20 dark:hover:text-red-400 transition-all duration-150">
                        <i class="fas fa-arrow-right-from-bracket text-sm"></i>
                    </button>
                </form>
            @endif
        </div>
    </div>
</nav>

<!-- Mobile overlay backdrop -->
<div id="sidebar-backdrop"
     class="fixed inset-0 bg-black/50 z-20 hidden lg:hidden backdrop-blur-sm"
     onclick="closeSidebar()">
</div>

<!-- Custom Logout Confirmation Modal -->
<div id="logout-confirm-modal" class="fixed inset-0 z-[100] flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity duration-300"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white dark:bg-slate-900 rounded-2xl max-w-sm w-full mx-4 p-6 shadow-2xl border border-slate-100 dark:border-slate-800 transform transition-all duration-300 scale-95 opacity-0" id="logout-modal-content" style="z-index: 101;">
        <div class="flex flex-col items-center text-center">
            <!-- Icon -->
            <div class="w-16 h-16 rounded-full bg-rose-50 dark:bg-rose-950/30 text-rose-500 dark:text-rose-400 flex items-center justify-center text-2xl mb-4 shadow-inner">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            
            <!-- Title -->
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-2">Konfirmasi Keluar</h3>
            
            <!-- Description -->
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6 leading-relaxed">
                Apakah Anda yakin ingin mengakhiri sesi ini dan keluar dari sistem e-learning?
            </p>
            
            <!-- Action Buttons -->
            <div class="flex gap-3 w-full">
                <button type="button" onclick="closeLogoutModal()" 
                        class="flex-1 py-2.5 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition duration-150 focus:outline-none">
                    Batal
                </button>
                <button type="button" onclick="confirmLogout()" 
                        class="flex-1 py-2.5 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-sm font-semibold text-white transition duration-150 focus:outline-none shadow-lg shadow-rose-600/25">
                    Ya, Keluar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Custom Confirm Dialog Modal -->
<div id="custom-confirm-modal" class="fixed inset-0 z-[100] flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity duration-300"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white dark:bg-slate-900 rounded-2xl max-w-sm w-full mx-4 p-6 shadow-2xl border border-slate-100 dark:border-slate-800 transform transition-all duration-300 scale-95 opacity-0" id="custom-confirm-modal-content" style="z-index: 101;">
        <div class="flex flex-col items-center text-center">
            <!-- Icon -->
            <div id="custom-confirm-icon-container" class="w-16 h-16 rounded-full bg-rose-50 dark:bg-rose-950/30 text-rose-500 dark:text-rose-400 flex items-center justify-center text-2xl mb-4 shadow-inner">
                <i id="custom-confirm-icon" class="fas fa-trash-alt"></i>
            </div>
            
            <!-- Title -->
            <h3 id="custom-confirm-title" class="text-lg font-bold text-slate-800 dark:text-white mb-2">Konfirmasi Hapus</h3>
            
            <!-- Description -->
            <p id="custom-confirm-message" class="text-sm text-slate-500 dark:text-slate-400 mb-6 leading-relaxed">
                Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
            </p>
            
            <!-- Action Buttons -->
            <div class="flex gap-3 w-full">
                <button type="button" onclick="closeCustomConfirm()" 
                        class="flex-1 py-2.5 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition duration-150 focus:outline-none">
                    Batal
                </button>
                <button type="button" id="custom-confirm-btn" onclick="triggerCustomConfirm()" 
                        class="flex-1 py-2.5 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-sm font-semibold text-white transition duration-150 focus:outline-none shadow-lg shadow-rose-600/25">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let pendingLogoutForm = null;

function openLogoutModal() {
    const modal = document.getElementById('logout-confirm-modal');
    const content = document.getElementById('logout-modal-content');
    modal.classList.remove('hidden');
    // Force reflow/repaint to ensure transitions work
    modal.offsetHeight;
    content.classList.remove('scale-95', 'opacity-0');
    content.classList.add('scale-100', 'opacity-100');
}

function closeLogoutModal() {
    const modal = document.getElementById('logout-confirm-modal');
    const content = document.getElementById('logout-modal-content');
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
        pendingLogoutForm = null;
    }, 200);
}

function confirmLogout() {
    if (pendingLogoutForm) {
        pendingLogoutForm.submit();
    }
}

function openSidebar() {
    document.getElementById('sidebar').classList.remove('-translate-x-full');
    document.getElementById('sidebar-backdrop').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeSidebar() {
    document.getElementById('sidebar').classList.add('-translate-x-full');
    document.getElementById('sidebar-backdrop').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// --- GENERIC CUSTOM CONFIRMATION ---
let customConfirmCallback = null;

window.showCustomConfirm = function(options) {
    const modal = document.getElementById('custom-confirm-modal');
    const content = document.getElementById('custom-confirm-modal-content');
    const titleEl = document.getElementById('custom-confirm-title');
    const msgEl = document.getElementById('custom-confirm-message');
    const btnEl = document.getElementById('custom-confirm-btn');
    const iconContainer = document.getElementById('custom-confirm-icon-container');
    const iconEl = document.getElementById('custom-confirm-icon');
    
    titleEl.textContent = options.title || 'Konfirmasi';
    msgEl.textContent = options.message || 'Apakah Anda yakin ingin melanjutkan tindakan ini?';
    btnEl.textContent = options.confirmText || 'Ya, Lanjutkan';
    
    if (options.type === 'danger') {
        iconContainer.className = "w-16 h-16 rounded-full bg-rose-50 dark:bg-rose-950/30 text-rose-500 dark:text-rose-400 flex items-center justify-center text-2xl mb-4 shadow-inner";
        iconEl.className = "fas fa-trash-alt";
        btnEl.className = "flex-1 py-2.5 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-sm font-semibold text-white transition duration-150 focus:outline-none shadow-lg shadow-rose-600/25";
    } else {
        iconContainer.className = "w-16 h-16 rounded-full bg-amber-50 dark:bg-amber-950/30 text-amber-500 dark:text-amber-400 flex items-center justify-center text-2xl mb-4 shadow-inner";
        iconEl.className = "fas fa-exclamation-triangle";
        btnEl.className = "flex-1 py-2.5 px-4 rounded-xl bg-[#D65A20] hover:bg-[#be4e1a] text-sm font-semibold text-white transition duration-150 focus:outline-none shadow-lg shadow-orange-600/25";
    }
    
    customConfirmCallback = options.callback;
    
    modal.classList.remove('hidden');
    modal.offsetHeight;
    content.classList.remove('scale-95', 'opacity-0');
    content.classList.add('scale-100', 'opacity-100');
};

window.closeCustomConfirm = function() {
    const modal = document.getElementById('custom-confirm-modal');
    const content = document.getElementById('custom-confirm-modal-content');
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
        customConfirmCallback = null;
    }, 200);
};

window.triggerCustomConfirm = function() {
    if (customConfirmCallback) {
        customConfirmCallback();
    }
    window.closeCustomConfirm();
};

// --- OVERRIDE window.confirm TO USE CUSTOM MODAL ---
// This approach does NOT use capture-phase event listeners,
// so it will NEVER interfere with sidebar navigation or normal clicks.
(function() {
    const nativeConfirm = window.confirm.bind(window);

    window.confirm = function(message) {
        // Find the form/element that triggered confirm()
        const activeEl = document.activeElement;
        const form = activeEl ? activeEl.closest('form') : null;
        const isDanger = message.toLowerCase().includes('hapus') || message.toLowerCase().includes('dihapus');

        if (form) {
            // confirm() was called from a form's onsubmit handler
            const onsubmitAttr = form.getAttribute('onsubmit');

            window.showCustomConfirm({
                title: isDanger ? 'Konfirmasi Hapus' : 'Konfirmasi Tindakan',
                message: message,
                confirmText: isDanger ? 'Ya, Hapus' : 'Ya, Lanjutkan',
                type: isDanger ? 'danger' : 'warning',
                callback: function() {
                    if (onsubmitAttr) form.removeAttribute('onsubmit');
                    form.submit();
                    if (onsubmitAttr) form.setAttribute('onsubmit', onsubmitAttr);
                }
            });
            return false; // Prevent form submission
        }

        // confirm() was called from an onclick handler on a button/link
        if (activeEl) {
            const onclickAttr = activeEl.getAttribute('onclick');
            if (onclickAttr && onclickAttr.includes('confirm(')) {
                window.showCustomConfirm({
                    title: isDanger ? 'Konfirmasi Hapus' : 'Konfirmasi Tindakan',
                    message: message,
                    confirmText: isDanger ? 'Ya, Hapus' : 'Ya, Lanjutkan',
                    type: isDanger ? 'danger' : 'warning',
                    callback: function() {
                        activeEl.removeAttribute('onclick');
                        activeEl.click();
                        activeEl.setAttribute('onclick', onclickAttr);
                    }
                });
                return false; // Prevent default action
            }
        }

        // Fallback: use native confirm for any other context
        return nativeConfirm(message);
    };
})();
</script>
