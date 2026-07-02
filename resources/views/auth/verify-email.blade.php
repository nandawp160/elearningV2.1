<x-guest-layout>
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md card">
        <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Verifikasi Email</h1>
        <p class="text-sm text-slate-500 mt-2">
            Terima kasih sudah mendaftar. Silakan cek email Anda untuk melakukan verifikasi.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mt-4 text-sm text-emerald-600">
                Tautan verifikasi baru telah dikirim ke email Anda.
            </div>
        @endif

        <div class="mt-6 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button class="btn btn-primary" type="submit">Kirim Ulang Email</button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-slate-500 hover:text-slate-700">Keluar</button>
            </form>
        </div>
    </div>
</div>
</x-guest-layout>
