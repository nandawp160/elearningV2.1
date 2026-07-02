<?php

// ===== SIDEBAR =====
$sidebar = <<<'BLADE'
<?php
$user = auth()->user();
$role = $user->role ?? '';
$currentRoute = request()->route()->getName();
function isActive($routes) {
    $current = request()->route()->getName();
    foreach ((array)$routes as $route) {
        if (str_starts_with($current, $route)) return true;
    }
    return false;
}
?>
<nav id="sidebar"
     class="fixed inset-y-0 left-0 z-30 flex flex-col w-72 bg-white dark:bg-slate-900 border-r border-gray-100 dark:border-slate-800 shadow-sm transition-transform duration-300 -translate-x-full md:translate-x-0"
     style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <!-- Logo -->
    <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-100 dark:border-slate-800">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow-md shadow-orange-500/25 flex-shrink-0">
            <i class="fas fa-school text-white text-base"></i>
        </div>
        <div class="overflow-hidden">
            <p class="font-bold text-gray-900 dark:text-white text-sm leading-tight truncate">SMA N 1 Cepogo</p>
            <p class="text-[11px] text-gray-400 dark:text-slate-500 truncate">Wasis Waskitha Hanuraga</p>
        </div>
        <!-- Mobile close button -->
        <button onclick="closeSidebar()" class="ml-auto md:hidden text-gray-400 hover:text-gray-600 dark:hover:text-slate-300 transition-colors">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-y-auto py-4 px-3">
        <ul class="space-y-0.5">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('dashboard') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-gauge-high w-4 text-center {{ isActive('dashboard') ? 'text-white' : 'text-gray-400' }}"></i>
                    Dashboard
                </a>
            </li>

            @if(in_array($role, ['super_admin', 'admin', 'guru']))
            <!-- Kelas -->
            <li>
                <a href="{{ route('classrooms.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('classrooms') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-chalkboard w-4 text-center {{ isActive('classrooms') ? 'text-white' : 'text-gray-400' }}"></i>
                    Kelas
                </a>
            </li>

            <!-- Mata Pelajaran -->
            <li>
                <a href="{{ route('subjects.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('subjects') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-book-open w-4 text-center {{ isActive('subjects') ? 'text-white' : 'text-gray-400' }}"></i>
                    Mata Pelajaran
                </a>
            </li>
            @endif

            <!-- Materi -->
            <li>
                <a href="{{ route('materials.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('materials') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-folder-open w-4 text-center {{ isActive('materials') ? 'text-white' : 'text-gray-400' }}"></i>
                    Materi
                </a>
            </li>

            <!-- Tugas -->
            <li>
                <a href="{{ route('assignments.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('assignments') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-clipboard-list w-4 text-center {{ isActive('assignments') ? 'text-white' : 'text-gray-400' }}"></i>
                    Tugas
                </a>
            </li>

            <!-- Nilai -->
            <li>
                <a href="{{ route('grades.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('grades') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-star-half-stroke w-4 text-center {{ isActive('grades') ? 'text-white' : 'text-gray-400' }}"></i>
                    Nilai
                </a>
            </li>

            @if(in_array($role, ['super_admin', 'admin', 'guru']))
            <!-- Absensi -->
            <li>
                <a href="{{ route('attendances.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('attendances') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-calendar-check w-4 text-center {{ isActive('attendances') ? 'text-white' : 'text-gray-400' }}"></i>
                    Absensi
                </a>
            </li>
            @endif

            @if($role === 'murid')
            <!-- Biodata (murid only) -->
            <li>
                <a href="{{ route('student.biodata.create') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('student.biodata') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-id-card w-4 text-center {{ isActive('student.biodata') ? 'text-white' : 'text-gray-400' }}"></i>
                    Biodata Saya
                </a>
            </li>
            @endif

            @if(in_array($role, ['super_admin', 'admin']))
            <!-- Data Siswa -->
            <li>
                <a href="{{ route('students.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('students') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-users w-4 text-center {{ isActive('students') ? 'text-white' : 'text-gray-400' }}"></i>
                    Data Siswa
                </a>
            </li>

            <!-- Data Guru -->
            <li>
                <a href="{{ route('teachers.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('teachers') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-chalkboard-user w-4 text-center {{ isActive('teachers') ? 'text-white' : 'text-gray-400' }}"></i>
                    Data Guru
                </a>
            </li>
            @endif

            @if(isset($isHomeroomClass) && $isHomeroomClass)
            <!-- Wali Kelas (homeroom teachers only) -->
            <li>
                <a href="{{ route('homeroom.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('homeroom') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-house-user w-4 text-center {{ isActive('homeroom') ? 'text-white' : 'text-gray-400' }}"></i>
                    Wali Kelas
                </a>
            </li>
            @endif

            @if(in_array($role, ['super_admin', 'admin']))
            <!-- Pengaturan -->
            <li>
                <a href="{{ route('settings.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ isActive('settings') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="fas fa-gear w-4 text-center {{ isActive('settings') ? 'text-white' : 'text-gray-400' }}"></i>
                    Pengaturan
                </a>
            </li>
            @endif

        </ul>
    </div>

    <!-- User Profile (bottom) -->
    <div class="border-t border-gray-100 dark:border-slate-800 p-4">
        <div class="flex items-center gap-3 px-2">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 dark:text-slate-500 truncate capitalize">{{ $role }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Keluar"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-900/20 dark:hover:text-red-400 transition-all duration-150">
                    <i class="fas fa-arrow-right-from-bracket text-sm"></i>
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Mobile overlay backdrop -->
<div id="sidebar-backdrop"
     class="fixed inset-0 bg-black/50 z-20 hidden md:hidden backdrop-blur-sm"
     onclick="closeSidebar()">
</div>

@push('scripts')
<script>
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
</script>
@endpush
BLADE;

file_put_contents('resources/views/components/sidebar.blade.php', $sidebar);
echo 'Sidebar written: ' . strlen($sidebar) . " bytes\n";

echo "All done!\n";
