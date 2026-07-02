<x-guest-layout>
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md card">
        <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Konfirmasi Password</h1>
        <p class="text-sm text-slate-500 mt-2">Masukkan password Anda untuk melanjutkan.</p>

        <form method="POST" action="{{ route('password.confirm') }}" class="mt-4 space-y-4">
            @csrf
            <div>
                <label for="password" class="field-label">Password</label>
                <input id="password" class="input" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <button class="w-full btn btn-primary" type="submit">Konfirmasi</button>
        </form>
    </div>
</div>
</x-guest-layout>
