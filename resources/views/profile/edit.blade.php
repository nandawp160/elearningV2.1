@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-4xl mx-auto pb-12">
    <!-- Header Area -->
    <div class="flex justify-between items-center mb-6 mt-4">
        <div>
            <h1 class="page-title text-2xl font-bold text-slate-900 dark:text-white">Pengaturan Profil</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola informasi akun, biodata, dan preferensi keamanan Anda.</p>
        </div>
    </div>

    <!-- The unified form -->
    <form id="profile-update-form" method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Section 1 -->
        <div class="bg-white dark:bg-slate-900 shadow-sm rounded-xl p-8 border border-slate-200">
            <h2 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-1">Informasi Dasar</h2>
            <p class="text-sm text-slate-500 mb-6 pb-6 border-b border-slate-100">Perbarui nama dan alamat email akun Anda.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <x-text-input id="name" name="name" type="text" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Alamat Email</label>
                    <div class="relative">
                        <x-text-input id="email" name="email" type="email" class="block w-full rounded-md border-slate-200 bg-slate-50 text-slate-400 cursor-not-allowed pr-10 shadow-sm" :value="old('email', $user->email)" required autocomplete="username" readonly />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-lock text-slate-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            @if(!auth()->user()->isTeacher())
            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-4">
                <x-primary-button class="bg-orange-600 hover:bg-orange-700 font-bold px-6 py-2.5">Simpan Perubahan</x-primary-button>
                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm font-semibold text-emerald-600">
                        <i class="fas fa-check-circle mr-1"></i> Tersimpan
                    </p>
                @endif
            </div>
            @endif
        </div>

        <!-- Section 2 -->
        @if(auth()->user()->isTeacher())
        <div class="bg-white dark:bg-slate-900 shadow-sm rounded-xl p-8 border border-slate-200">
            <h2 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-1">Biodata Kepegawaian</h2>
            <p class="text-sm text-slate-500 mb-6 pb-6 border-b border-slate-100">Informasi spesifik kepegawaian Anda. Beberapa kolom dikelola oleh administrator.</p>
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nip" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">NIP (Nomor Induk Pegawai)</label>
                        <x-text-input id="nip" name="nip" type="text" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" :value="old('nip', $user->teacher->nip ?? '')" />
                        <x-input-error class="mt-2" :messages="$errors->get('nip')" />
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="spesialisasi" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-0">Spesialisasi (Mata Pelajaran)</label>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Hanya Admin</span>
                        </div>
                        <x-text-input id="spesialisasi" name="spesialisasi" type="text" class="block w-full rounded-md border-slate-200 bg-slate-50 text-slate-400 cursor-not-allowed shadow-sm" :value="old('spesialisasi', $user->teacher->spesialisasi ?? '')" readonly />
                    </div>
                </div>

                <div>
                    <label for="no_hp" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nomor Handphone</label>
                    <x-text-input id="no_hp" name="no_hp" type="text" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" :value="old('no_hp', $user->teacher->no_hp ?? '')" />
                    <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                </div>

                <div>
                    <label for="alamat" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Alamat Lengkap</label>
                    <textarea id="alamat" name="alamat" rows="4" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 resize-none">{{ old('alamat', $user->teacher->alamat ?? '') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-4">
                <x-primary-button class="bg-orange-600 hover:bg-orange-700 font-bold px-6 py-2.5">Simpan Perubahan</x-primary-button>
                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm font-semibold text-emerald-600">
                        <i class="fas fa-check-circle mr-1"></i> Tersimpan
                    </p>
                @endif
            </div>
        </div>
        @endif
    </form>

    <!-- Section 3: Password -->
    <div class="bg-white dark:bg-slate-900 shadow-sm rounded-xl p-8 border border-slate-200 mt-6">
        <h2 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-1">Keamanan Akun</h2>
        <p class="text-sm text-slate-500 mb-6 pb-6 border-b border-slate-100">Pastikan Anda menggunakan kata sandi yang kuat dan unik demi keamanan.</p>
        
        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div>
                <label for="update_password_current_password" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Password Saat Ini</label>
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div x-data="{ show: false }" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="update_password_password" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Password Baru</label>
                    <div class="relative">
                        <x-text-input id="update_password_password" name="password" x-bind:type="show ? 'text' : 'password'" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 pr-10" autocomplete="new-password" />
                        <button type="button" @click="show = !show" title="Tampilkan/Sembunyikan Sandi Baru" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 focus:outline-none">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" x-bind:type="show ? 'text' : 'password'" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="pt-2 flex items-center gap-4">
                <x-primary-button class="bg-orange-600 hover:bg-orange-700 font-bold px-6 py-2.5">{{ __('Perbarui Password') }}</x-primary-button>
                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm font-semibold text-emerald-600">
                        <i class="fas fa-check-circle mr-1"></i> Password diperbarui
                    </p>
                @endif
            </div>
        </form>
    </div>

    @if(!auth()->user()->isTeacher())
    <div class="bg-red-50 dark:bg-red-900/10 shadow-sm ring-1 ring-red-200 dark:ring-red-900/30 rounded-xl p-8 mt-6">
        <header class="mb-6 pb-6 border-b border-red-200 dark:border-red-900/30">
            <h2 class="text-xl font-bold text-red-700 dark:text-red-400">Hapus Akun</h2>
            <p class="text-sm text-red-600 dark:text-red-300 mt-1">Hapus akun Anda secara permanen dari sistem.</p>
        </header>
        @include('profile.partials.delete-user-form')
    </div>
    @endif
</div>
@endsection
