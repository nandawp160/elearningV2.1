<x-guest-layout>
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md card">
        <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Reset Password</h1>
        <p class="text-sm text-slate-500 mt-2">Buat password baru untuk akun Anda.</p>

        <form method="POST" action="{{ route('password.store') }}" class="mt-4 space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label for="email" class="field-label">Email</label>
                <input id="email" class="input" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="field-label">Password</label>
                <input id="password" class="input" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation" class="field-label">Konfirmasi Password</label>
                <input id="password_confirmation" class="input" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button class="w-full btn btn-primary" type="submit">Reset Password</button>
        </form>
    </div>
</div>
</x-guest-layout>
