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
        Auth::logoutOtherDevices($request->password);

        // Prevent admin from logging in via regular student portal
        if ($request->user()->isSuperAdmin()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')->withErrors([
                'email' => 'Silakan login melalui portal khusus Admin.',
            ]);
        }

        // Prevent alumni (status lulus) from logging in
        if ($request->user()->isStudent() && $request->user()->student && $request->user()->student->status === 'lulus') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            $msg = 'Akun Anda berstatus Alumni (Lulus). Akses ke portal E-Learning telah ditutup.';
            return redirect()->route('login')
                ->with('error_alumni', $msg)
                ->withErrors(['email' => $msg]);
        }

        // Prevent teachers from logging in via regular student portal
        if ($request->user()->isTeacher()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')->withErrors([
                'email' => 'Akses ditolak. Silakan login melalui portal khusus Guru.',
            ]);
        }

        \App\Models\ActivityLog::log('AUTH', 'Siswa "' . $request->user()->nama . '" (NIS: ' . ($request->user()->student->nis ?? '-') . ') berhasil masuk ke sistem');

        // Jangan gunakan intended() untuk mencegah bug 403 di HP (stale tabs)
        return redirect()->route('dashboard');
    }

    /**
     * Display the guru login view.
     */
    public function createGuru(): View
    {
        return view('auth.guru-login');
    }

    /**
     * Handle an incoming guru authentication request.
     */
    public function storeGuru(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        Auth::logoutOtherDevices($request->password);

        // Ensure only teacher can login here
        if (!$request->user()->isTeacher()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('guru.login')->withErrors([
                'email' => 'Akses ditolak. Portal ini khusus untuk Guru.',
            ]);
        }

        \App\Models\ActivityLog::log('AUTH', 'Guru "' . $request->user()->nama . '" berhasil masuk ke sistem melalui portal guru');

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
        Auth::logoutOtherDevices($request->password);

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
        $isTeacher = false;

        if (Auth::check()) {
            $user = Auth::user();
            $isAdmin = $user->isSuperAdmin();
            $isTeacher = $user->isTeacher();
            \App\Models\ActivityLog::log('AUTH', 'Pengguna "' . $user->nama . '" keluar dari sistem');
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($isAdmin) {
            return redirect()->route('admin.login');
        } elseif ($isTeacher) {
            return redirect()->route('guru.login');
        } else {
            return redirect()->route('login');
        }
    }
}
