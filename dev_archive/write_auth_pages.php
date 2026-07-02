<?php

$login = <<<'BLADE'
<x-guest-layout>
<div class="min-h-screen flex" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <!-- LEFT PANEL: Dark Navy with Book Illustration -->
    <div class="hidden lg:flex lg:w-3/5 relative bg-[#0F172A] flex-col p-12 overflow-hidden">

        <!-- Ambient glow blobs -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-orange-500/20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/3 -right-24 w-80 h-80 bg-orange-600/15 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-1/3 w-64 h-64 bg-amber-400/10 rounded-full blur-2xl"></div>
        </div>

        <!-- School Logo -->
        <div class="relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow-lg shadow-orange-500/30">
                    <i class="fas fa-school text-white text-lg"></i>
                </div>
                <div>
                    <span class="text-white font-bold text-base leading-tight block">SMA N 1 Cepogo</span>
                    <span class="text-slate-400 text-xs">Wasis Waskitha Hanuraga</span>
                </div>
            </div>
        </div>

        <!-- Book SVG Illustration -->
        <div class="relative z-10 flex-1 flex flex-col items-center justify-center">
            <div class="w-72 h-72 mb-8 relative">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/4 w-48 h-48 bg-orange-500/25 rounded-full blur-3xl"></div>
                <svg viewBox="0 0 240 240" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full relative z-10">
                    <!-- Light rays -->
                    <line x1="120" y1="125" x2="120" y2="40"  stroke="#E87722" stroke-width="3"   stroke-linecap="round" opacity="0.85"/>
                    <line x1="120" y1="125" x2="72"  y2="58"  stroke="#E87722" stroke-width="2"   stroke-linecap="round" opacity="0.55"/>
                    <line x1="120" y1="125" x2="168" y2="58"  stroke="#E87722" stroke-width="2"   stroke-linecap="round" opacity="0.55"/>
                    <line x1="120" y1="125" x2="45"  y2="82"  stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round" opacity="0.35"/>
                    <line x1="120" y1="125" x2="195" y2="82"  stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round" opacity="0.35"/>
                    <!-- Star dots -->
                    <circle cx="120" cy="36"  r="5"   fill="#E87722" opacity="0.95"/>
                    <circle cx="72"  cy="53"  r="3.5" fill="#E87722" opacity="0.7"/>
                    <circle cx="168" cy="53"  r="3.5" fill="#E87722" opacity="0.7"/>
                    <circle cx="45"  cy="77"  r="2.5" fill="#F59E0B" opacity="0.5"/>
                    <circle cx="195" cy="77"  r="2.5" fill="#F59E0B" opacity="0.5"/>
                    <!-- Open Book Left Page -->
                    <rect x="20" y="125" width="92" height="78" rx="5" fill="#1E3A5F" stroke="#3B82F6" stroke-width="1.5"/>
                    <!-- Book spine -->
                    <rect x="112" y="123" width="16" height="82" rx="3" fill="#E87722"/>
                    <!-- Open Book Right Page -->
                    <rect x="128" y="125" width="92" height="78" rx="5" fill="#1E3A5F" stroke="#E87722" stroke-width="1.5"/>
                    <!-- Left page lines -->
                    <line x1="36" y1="148" x2="96" y2="148" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                    <line x1="36" y1="162" x2="96" y2="162" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                    <line x1="36" y1="176" x2="80" y2="176" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" opacity="0.4"/>
                    <!-- Right page lines -->
                    <line x1="144" y1="148" x2="204" y2="148" stroke="#E87722" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                    <line x1="144" y1="162" x2="204" y2="162" stroke="#E87722" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                    <line x1="144" y1="176" x2="188" y2="176" stroke="#E87722" stroke-width="2" stroke-linecap="round" opacity="0.4"/>
                    <!-- Floating pencil -->
                    <g transform="translate(26,55) rotate(-25)">
                        <rect x="0" y="0" width="9" height="32" rx="2" fill="#E87722" opacity="0.75"/>
                        <polygon points="0,32 9,32 4.5,42" fill="#F5F5DC" opacity="0.75"/>
                        <rect x="0" y="0" width="9" height="6" rx="2" fill="#F59E0B" opacity="0.75"/>
                    </g>
                    <!-- Floating ruler -->
                    <g transform="translate(180,48) rotate(20)">
                        <rect x="0" y="0" width="9" height="36" rx="2" fill="#60A5FA" opacity="0.6"/>
                        <line x1="2" y1="8"  x2="7" y2="8"  stroke="white" stroke-width="1" opacity="0.7"/>
                        <line x1="2" y1="16" x2="7" y2="16" stroke="white" stroke-width="1" opacity="0.7"/>
                        <line x1="2" y1="24" x2="7" y2="24" stroke="white" stroke-width="1" opacity="0.7"/>
                    </g>
                    <!-- Atom symbol -->
                    <g transform="translate(198,152)">
                        <circle cx="0" cy="0" r="3" fill="#E87722" opacity="0.8"/>
                        <ellipse cx="0" cy="0" rx="11" ry="5" stroke="#E87722" stroke-width="1.5" opacity="0.5" fill="none"/>
                        <ellipse cx="0" cy="0" rx="11" ry="5" stroke="#F59E0B" stroke-width="1.5" opacity="0.5" fill="none" transform="rotate(60)"/>
                        <ellipse cx="0" cy="0" rx="11" ry="5" stroke="#F59E0B" stroke-width="1.5" opacity="0.5" fill="none" transform="rotate(120)"/>
                    </g>
                    <!-- Math formulas -->
                    <text x="18" y="120" fill="#60A5FA" font-size="11" opacity="0.65" font-family="monospace">E=mc2</text>
                    <text x="190" y="122" fill="#E87722" font-size="11" opacity="0.6" font-family="monospace">dx</text>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white text-center mb-3 leading-snug">
                Platform Pembelajaran<br>
                <span class="text-orange-400">Digital Terbaik</span>
            </h1>
            <p class="text-slate-400 text-center text-sm max-w-sm leading-relaxed">
                Kelola kelas, pantau tugas, dan lihat perkembangan belajar<br>dalam satu sistem yang terintegrasi.
            </p>
        </div>

        <!-- Stats pills -->
        <div class="relative z-10 flex gap-3 justify-center mt-6">
            <div class="px-4 py-2 rounded-full bg-white/10 border border-white/15 backdrop-blur-sm">
                <span class="text-white text-xs font-medium">100+ Materi</span>
            </div>
            <div class="px-4 py-2 rounded-full bg-white/10 border border-white/15 backdrop-blur-sm">
                <span class="text-white text-xs font-medium">50+ Kelas</span>
            </div>
            <div class="px-4 py-2 rounded-full bg-white/10 border border-white/15 backdrop-blur-sm">
                <span class="text-white text-xs font-medium">Akses 24/7</span>
            </div>
        </div>
    </div>

    <!-- RIGHT PANEL: Login Form -->
    <div class="flex-1 flex items-center justify-center p-8 bg-white dark:bg-slate-900">
        <div class="w-full max-w-md">

            <!-- Mobile-only logo -->
            <div class="lg:hidden flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center">
                    <i class="fas fa-school text-white text-base"></i>
                </div>
                <span class="font-bold text-gray-900 dark:text-white text-base">SMA N 1 Cepogo</span>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-1.5">Masuk ke Akun Anda</h2>
                <p class="text-gray-500 dark:text-slate-400 text-sm">Gunakan email dan password yang terdaftar.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1.5">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400 text-sm"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               required autofocus autocomplete="username"
                               placeholder="nama@sekolah.sch.id"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 {{ $errors->get('email') ? 'border-red-400' : '' }}" />
                    </div>
                    @error('email')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-orange-600 hover:text-orange-700 transition-colors">Lupa Password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400 text-sm"></i>
                        </div>
                        <input id="password" type="password" name="password"
                               required autocomplete="current-password"
                               placeholder="........"
                               class="w-full pl-10 pr-12 py-3 rounded-xl border border-gray-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 {{ $errors->get('password') ? 'border-red-400' : '' }}" />
                        <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-slate-300 transition-colors">
                            <i id="eye-icon" class="fas fa-eye text-sm"></i>
                        </button>
                    </div>
                    @error('password')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Remember me -->
                <label for="remember_me" class="inline-flex items-center gap-2.5 cursor-pointer select-none">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="w-4 h-4 rounded border-gray-300 text-orange-500 focus:ring-orange-500 cursor-pointer" />
                    <span class="text-sm text-gray-600 dark:text-slate-400">Ingat saya di perangkat ini</span>
                </label>

                <!-- Submit button -->
                <button type="submit"
                        class="w-full py-3 px-4 rounded-xl font-semibold text-white text-sm
                               bg-gradient-to-r from-orange-500 to-orange-600
                               hover:from-orange-600 hover:to-orange-700
                               shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40
                               transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0
                               flex items-center justify-center gap-2">
                    <i class="fas fa-right-to-bracket"></i>
                    Masuk
                </button>

                <!-- Register link -->
                <p class="text-center text-sm text-gray-500 dark:text-slate-400 pt-1">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-orange-600 hover:text-orange-700 transition-colors">
                        Daftar Sekarang &rarr;
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const pwd  = document.getElementById('password');
    const icon = document.getElementById('eye-icon');
    if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        pwd.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
</x-guest-layout>
BLADE;

file_put_contents('resources/views/auth/login.blade.php', $login);
echo 'Login written: ' . strlen($login) . " bytes\n";

// ===== REGISTER PAGE =====
$register = <<<'BLADE'
<x-guest-layout>
<div class="min-h-screen flex" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <!-- LEFT PANEL -->
    <div class="hidden lg:flex lg:w-2/5 relative bg-[#0F172A] flex-col p-12 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-orange-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-amber-400/10 rounded-full blur-2xl"></div>
        </div>
        <div class="relative z-10 flex items-center gap-3 mb-auto">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow-lg shadow-orange-500/30">
                <i class="fas fa-school text-white text-lg"></i>
            </div>
            <div>
                <span class="text-white font-bold text-base leading-tight block">SMA N 1 Cepogo</span>
                <span class="text-slate-400 text-xs">Wasis Waskitha Hanuraga</span>
            </div>
        </div>
        <div class="relative z-10 flex-1 flex flex-col items-center justify-center text-center">
            <div class="w-24 h-24 rounded-3xl bg-orange-500/20 border border-orange-500/30 flex items-center justify-center mb-6">
                <i class="fas fa-user-plus text-4xl text-orange-400"></i>
            </div>
            <h1 class="text-2xl font-bold text-white mb-3 leading-snug">Bergabung dengan<br><span class="text-orange-400">SMA N 1 Cepogo</span></h1>
            <p class="text-slate-400 text-sm max-w-xs leading-relaxed">Daftarkan diri Anda untuk mengakses platform pembelajaran digital yang terintegrasi.</p>
        </div>
        <div class="relative z-10 mt-8">
            <p class="text-slate-500 text-xs text-center">Sudah punya akun?
                <a href="{{ route('login') }}" class="text-orange-400 font-semibold hover:text-orange-300 transition-colors">Masuk di sini</a>
            </p>
        </div>
    </div>

    <!-- RIGHT PANEL: Register Form -->
    <div class="flex-1 flex items-center justify-center p-8 bg-white dark:bg-slate-900">
        <div class="w-full max-w-md">

            <div class="lg:hidden flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center">
                    <i class="fas fa-school text-white text-base"></i>
                </div>
                <span class="font-bold text-gray-900 dark:text-white text-base">SMA N 1 Cepogo</span>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-1.5">Buat Akun Baru</h2>
                <p class="text-gray-500 dark:text-slate-400 text-sm">Isi data berikut untuk mendaftar.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1.5">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               required autofocus autocomplete="name"
                               placeholder="Nama lengkap Anda"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200" />
                    </div>
                    @error('name')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1.5">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400 text-sm"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               required autocomplete="username"
                               placeholder="nama@sekolah.sch.id"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200" />
                    </div>
                    @error('email')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400 text-sm"></i>
                        </div>
                        <input id="password" type="password" name="password"
                               required autocomplete="new-password"
                               placeholder="Min. 8 karakter"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200" />
                    </div>
                    @error('password')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1.5">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-shield-halved text-gray-400 text-sm"></i>
                        </div>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               required autocomplete="new-password"
                               placeholder="Ulangi password"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200" />
                    </div>
                    @error('password_confirmation')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Submit -->
                <div class="pt-1">
                    <button type="submit"
                            class="w-full py-3 px-4 rounded-xl font-semibold text-white text-sm
                                   bg-gradient-to-r from-orange-500 to-orange-600
                                   hover:from-orange-600 hover:to-orange-700
                                   shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40
                                   transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0
                                   flex items-center justify-center gap-2">
                        <i class="fas fa-user-plus"></i>
                        Daftar Sekarang
                    </button>
                </div>

                <p class="text-center text-sm text-gray-500 dark:text-slate-400 pt-1">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-orange-600 hover:text-orange-700 transition-colors">
                        Masuk di sini &rarr;
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>
</x-guest-layout>
BLADE;

file_put_contents('resources/views/auth/register.blade.php', $register);
echo 'Register written: ' . strlen($register) . " bytes\n";

echo "All auth pages done!\n";
