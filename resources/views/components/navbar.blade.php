<nav class="sticky top-0 z-20 w-full border-b border-slate-200/70 dark:border-slate-800/70 bg-white/80 dark:bg-slate-950/70 backdrop-blur">
    <div class="mx-auto w-full max-w-[1400px] px-6 md:px-10 py-4 flex items-center justify-between gap-4">
        <!-- Left Section: Hamburger Menu & Dynamic Page Title -->
        <div class="flex items-center gap-4">
            <!-- Hamburger menu button -->
            <button onclick="openSidebar()" class="lg:hidden text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white focus:outline-none transition-colors duration-150">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h2 class="hidden sm:block text-lg font-semibold text-slate-800 dark:text-slate-200 truncate">
                @yield('title', 'Dashboard')
            </h2>
        </div>

        <!-- Right Section: User Dropdown -->
        <div class="flex items-center gap-3">
            <!-- Dark Mode Toggle (Dinonaktifkan) -->

            <!-- User Dropdown (Minimalist Layout matching mockup) -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-3 text-slate-700 dark:text-slate-200 font-semibold focus:outline-none hover:text-slate-900 dark:hover:text-white transition">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800 dark:text-slate-200 leading-none mb-0.5">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] font-medium text-slate-400 dark:text-slate-500">
                            @if(auth()->user()->isTeacher())
                                @if(request()->routeIs('homeroom.*'))
                                    Wali Kelas
                                @else
                                    Guru Mata Pelajaran
                                @endif
                            @elseif(auth()->user()->isStudent())
                                Siswa
                            @else
                                Administrator
                            @endif
                        </p>
                    </div>
                    <!-- Round Avatar -->
                    <div class="w-9 h-9 rounded-full bg-slate-200 dark:bg-slate-800 flex items-center justify-center overflow-hidden border border-slate-200 dark:border-slate-700 ml-1">
                        <img alt="Avatar" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=e2e8f0&color=475569&bold=true" />
                    </div>
                    <i class="fas fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" style="display: none;"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     @click.away="open = false" 
                     class="bg-white dark:bg-slate-950 border border-slate-200/70 dark:border-slate-800/70 min-w-56 absolute right-0 mt-3 p-2 rounded-2xl shadow-2xl z-50">
                    
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 text-sm py-2.5 px-4 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800/70 text-slate-700 dark:text-slate-200 transition">
                        <i class="fas fa-user-circle text-slate-400"></i>
                        Profil Saya
                    </a>
                    <a href="{{ route('settings.index') }}" class="flex items-center gap-3 text-sm py-2.5 px-4 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800/70 text-slate-700 dark:text-slate-200 transition">
                        <i class="fas fa-cog text-slate-400"></i>
                        Pengaturan
                    </a>

                    @if(auth()->user()->isHomeroomTeacher() || auth()->user()->isSuperAdmin())
                        @if(request()->routeIs('homeroom.*'))
                            <a href="{{ route('dashboard') }}" 
                               onclick="event.preventDefault(); switchDashboard('{{ route('dashboard') }}', 'Pengajar');"
                               class="flex items-center gap-3 text-sm py-2.5 px-4 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800/70 text-slate-700 dark:text-slate-200 transition">
                                <i class="fas fa-chalkboard-teacher text-slate-400"></i>
                                Dashboard Pengajar
                            </a>
                        @else
                            <a href="{{ route('homeroom.dashboard') }}" 
                               onclick="event.preventDefault(); switchDashboard('{{ route('homeroom.dashboard') }}', 'Wali Kelas');"
                               class="flex items-center gap-3 text-sm py-2.5 px-4 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800/70 text-slate-700 dark:text-slate-200 transition">
                                <i class="fas fa-user-shield text-slate-400"></i>
                                Dashboard Wali Kelas
                            </a>
                        @endif
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
if (typeof window.switchDashboard === 'undefined') {
    window.switchDashboard = function(url, roleName) {
        if (window.showCustomConfirm) {
            window.showCustomConfirm({
                title: 'Konfirmasi Perpindahan',
                message: 'Apakah Anda yakin ingin beralih ke Dashboard ' + roleName + '?',
                confirmText: 'Ya, Beralih',
                type: 'warning',
                callback: function() {
                    window.location.href = url;
                }
            });
        } else {
            if (confirm('Apakah Anda yakin ingin beralih ke Dashboard ' + roleName + '?')) {
                window.location.href = url;
            }
        }
    };
}
</script>

