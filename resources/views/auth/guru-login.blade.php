<x-guest-layout>
{{-- Full-screen background with school photo --}}
<div class="min-h-screen w-full flex items-center justify-center p-4 relative overflow-hidden" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    {{-- Background Image Layer --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/sekolah/sekolah.jpg') }}"
             alt="{{ \App\Models\Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo') }}"
             class="w-full h-full object-cover" />
        {{-- Dark gradient overlay for readability --}}
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900/80 via-slate-800/70 to-[#D65A20]/30"></div>
        {{-- Subtle animated grain/noise texture --}}
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 256 256%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.9%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22/%3E%3C/svg%3E');"></div>
    </div>

    {{-- Floating decorative orbs --}}
    <div class="absolute top-20 left-20 w-64 h-64 bg-[#D65A20]/20 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-20 right-20 w-80 h-80 bg-amber-500/15 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

    {{-- Login Card --}}
    <div class="w-full max-w-[440px] relative z-10">

        {{-- Card container with glassmorphism --}}
        <div class="bg-black/40 backdrop-blur-md rounded-3xl shadow-2xl shadow-black/50 border-2 overflow-hidden transition-all duration-500" style="border-color: rgba(214, 90, 32, 0.8);">


            {{-- Header with Logo --}}
            <div class="flex flex-col items-center justify-center pt-8 pb-5 px-8">
                {{-- School Logo --}}
                <div class="relative mb-4 group">
                    <div class="absolute -inset-2 bg-gradient-to-br from-[#D65A20]/20 to-amber-400/20 rounded-full blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <img src="{{ asset('assets/logo/logo.png') }}"
                         alt="Logo {{ \App\Models\Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo') }}"
                         class="relative w-36 h-36 object-contain drop-shadow-md transition-transform duration-300 hover:scale-105" />
                </div>

                {{-- Title --}}
                <h1 class="text-2xl text-white leading-tight flex items-center justify-center gap-2 mb-1">
                    <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <span class="font-bold tracking-widest uppercase">LOGIN GURU</span>
                </h1>
                <p class="text-[11px] text-white/70 mt-1 font-medium tracking-widest uppercase text-center">
                    Assignment Control System
                </p>

                {{-- School name badge --}}
                <div class="mt-3 px-4 py-1.5 bg-white/10 rounded-full border border-white/10">
                    <p class="text-[10px] text-white font-semibold tracking-wide">
                        <i class="fas fa-school text-[#D65A20] mr-1.5"></i>{{ strtoupper(\App\Models\Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo')) }}
                    </p>
                </div>
            </div>

            <x-auth-session-status class="mx-8 mb-4" :status="session('status')" />

            {{-- Form --}}
            <form method="POST" action="{{ route('guru.login.store') }}" class="px-8 pb-8 space-y-4">
                @csrf

                {{-- Username / Email --}}
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold text-white uppercase tracking-wider">
                        Username / Email Guru
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-user-tie text-white/50 text-sm group-focus-within:text-[#D65A20] transition-colors duration-200"></i>
                        </div>
                        <input id="email" type="text" name="email" value="{{ old('email') }}"
                               required autofocus autocomplete="username"
                               placeholder="Masukkan Username atau Email"
                               style="background-color: rgba(0,0,0,0.3); color: white;"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-white/20 bg-black/30 text-white text-sm
                                      focus:outline-none focus:ring-2 focus:ring-[#D65A20]/60 focus:border-[#D65A20] focus:bg-black/50
                                      transition-all duration-200 placeholder:text-white/40
                                      @error('email') border-red-400 ring-2 ring-red-400/20 @enderror" />
                    </div>
                    @error('email')
                        <p class="flex items-center gap-1 text-xs text-red-500 mt-1">
                            <i class="fas fa-exclamation-circle text-[10px]"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-1.5">
                    <label for="password" class="block text-xs font-bold text-white uppercase tracking-wider">
                        Password
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-white/50 text-sm group-focus-within:text-[#D65A20] transition-colors duration-200"></i>
                        </div>
                        <input id="password" type="password" name="password"
                               required autocomplete="current-password"
                               placeholder="Masukkan Password"
                               style="background-color: rgba(0,0,0,0.3); color: white;"
                               class="w-full pl-10 pr-12 py-3 rounded-xl border border-white/20 bg-black/30 text-white text-sm
                                      focus:outline-none focus:ring-2 focus:ring-[#D65A20]/60 focus:border-[#D65A20] focus:bg-black/50
                                      transition-all duration-200 placeholder:text-white/40
                                      @error('password') border-red-400 ring-2 ring-red-400/20 @enderror" />
                        <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-white/50 hover:text-[#D65A20] transition-colors duration-200">
                            <i id="eye-icon" class="fas fa-eye text-sm"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="flex items-center gap-1 text-xs text-red-500 mt-1">
                            <i class="fas fa-exclamation-circle text-[10px]"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="pt-3">
                    <button type="submit" id="login-btn"
                            class="w-full py-3 px-4 rounded-xl font-bold text-white text-sm
                                   bg-gradient-to-r from-[#D65A20] to-[#e06b2d]
                                   hover:from-[#c4521d] hover:to-[#D65A20]
                                   focus:outline-none focus:ring-2 focus:ring-[#D65A20]/50 focus:ring-offset-2
                                   shadow-lg shadow-[#D65A20]/25 hover:shadow-[#D65A20]/40
                                   transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 active:shadow-md
                                   flex items-center justify-center gap-2 group">
                        <i class="fas fa-right-to-bracket text-xs transition-transform duration-300 group-hover:translate-x-0.5"></i>
                        <span class="tracking-wider">LOGIN GURU</span>
                    </button>
                </div>
            </form>

            {{-- Footer --}}
            <div class="px-8 pb-6">
                <div class="border-t border-white/10"></div>
                <p class="text-center text-[10px] text-white/50 mt-4 font-medium">
                    Copyright &copy; {{ date('Y') }} SMA NEGERI 1 CEPOGO
                </p>
                <p class="text-center text-[8px] text-white/30 mt-1 font-medium tracking-wider">
                    Developed by Nanda Wido Prasojo
                </p>
            </div>
        </div>

        {{-- Subtle school motto below card --}}
        <p class="text-center text-[10px] text-white/50 mt-4 font-medium tracking-widest uppercase">
            Wasis Waskitha Hanuraga
        </p>
    </div>
</div>

{{-- Inline Styles for animations --}}
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .min-h-screen > .relative.z-10 {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

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
