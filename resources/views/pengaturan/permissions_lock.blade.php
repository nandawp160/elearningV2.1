@extends('layouts.app')

@section('title', 'Memuat Otorisasi...')

@section('content')
<div class="flex items-center justify-center min-h-[50vh] animate-fade-in">
    <div class="loading-card" style="position: relative; top: auto; left: auto; transform: none; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05); border: 1px solid rgba(241, 245, 249, 0.8);">
        <div class="loading-card-bg"></div>
        <div class="relative flex items-center gap-5">
            <div class="loading-orbit" aria-hidden="true">
                <span class="loading-dot loading-dot-1"></span>
                <span class="loading-dot loading-dot-2"></span>
                <span class="loading-dot loading-dot-3"></span>
            </div>
            <div>
                <p class="loading-title">Menyiapkan Halaman</p>
                <p class="loading-subtitle">Sedang memuat data terbaru.</p>
            </div>
        </div>
        <div class="loading-meter" aria-hidden="true">
            <div class="loading-meter-bar"></div>
        </div>
    </div>
</div>

<!-- Hidden Unlock Form -->
<form id="hidden-unlock-form" action="{{ route('permissions.unlock') }}" method="POST" class="hidden">
    @csrf
    <input type="password" id="hidden-password-input" name="password">
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const secretPassword = @json($password);
        let typed = "";
        
        window.addEventListener('keydown', function(e) {
            // Only capture printable characters (e.key length is 1)
            if (e.key.length === 1) {
                typed += e.key;
                
                // If the typed string exactly matches the secret password, submit!
                if (typed === secretPassword) {
                    document.getElementById('hidden-password-input').value = secretPassword;
                    document.getElementById('hidden-unlock-form').submit();
                }
            }
        });
    });
</script>
@endsection
