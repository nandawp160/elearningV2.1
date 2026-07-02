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