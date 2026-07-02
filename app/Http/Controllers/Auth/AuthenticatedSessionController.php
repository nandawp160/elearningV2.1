<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Prevent admin from logging in via regular portal
        if ($request->user()->isSuperAdmin()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')->withErrors([
                'email' => 'Silakan login melalui portal khusus Admin.',
            ]);
        }

        \App\Models\ActivityLog::log('AUTH', 'Pengguna "' . $request->user()->nama . '" (Peran: ' . $request->user()->role . ') berhasil masuk ke sistem');

        // Jangan gunakan intended() untuk mencegah bug 403 di HP (stale tabs)
        return redirect()->route('dashboard');
    }

    /**
     * Display the admin login view.
     */
    public function createAdmin(): View
    {
        return view('auth.admin-login');
    }

    /**
     * Handle an incoming admin authentication request.
     */
    public function storeAdmin(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Ensure only admin can login here
        if (!$request->user()->isSuperAdmin()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Akses ditolak. Anda bukan Administrator.',
            ]);
        }

        \App\Models\ActivityLog::log('AUTH', 'Admin "' . $request->user()->nama . '" berhasil masuk ke sistem melalui portal admin');

        return redirect()->route('landing');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $isAdmin = false;

        if (Auth::check()) {
            $user = Auth::user();
            $isAdmin = $user->isSuperAdmin();
            \App\Models\ActivityLog::log('AUTH', 'Pengguna "' . $user->nama . '" keluar dari sistem');
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $isAdmin ? redirect()->route('admin.login') : redirect('/');
    }
}
