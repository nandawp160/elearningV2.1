<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Periksa jika user adalah siswa
            if ($user->isStudent() && $user->student) {
                $status = $user->student->status;
                
                // Jika statusnya mutasi atau lulus, maka akses ditolak
                if (in_array($status, ['mutasi', 'lulus'])) {
                    $statusLabel = $status === 'lulus' ? 'Alumni (Lulus)' : 'Mutasi/Keluar';
                    
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    $msg = "Akun Anda telah ditutup secara otomatis karena berstatus {$statusLabel}. Anda tidak dapat lagi masuk ke portal E-Learning.";
                    
                    return redirect()->route('login')
                        ->with('error_mutasi', $msg)
                        ->withErrors(['email' => $msg]);
                }
            }
        }

        return $next($request);
    }
}
