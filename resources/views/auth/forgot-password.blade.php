<x-guest-layout>
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md card">
        <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Lupa Password</h1>
        <p class="text-sm text-slate-500 mt-2">Masukkan email Anda, kami akan mengirimkan tautan reset password.</p>

        <x-auth-session-status class="mt-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="mt-4 space-y-4">
            @csrf
            <div>
                <label for="email" class="field-label">Email</label>
                <input id="email" class="input" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <button class="w-full btn btn-primary" type="submit">Kirim Tautan Reset</button>
        </form>
    </div>
</div>
</x-guest-layout>
