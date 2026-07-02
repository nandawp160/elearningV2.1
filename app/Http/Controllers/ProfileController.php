<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        if ($request->user()->isTeacher() && $request->user()->teacher) {
            $request->user()->teacher->update([
                'nip' => $request->nip,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the guru's specific information (NIP, Spesialisasi).
     */
    public function updateGuru(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        if (!$user->isTeacher() || !$user->teacher) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'nip' => ['required', 'string', 'max:50'],
            'spesialisasi' => ['required', 'string', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ]);

        $user->teacher->update([
            'nip' => $request->nip,
            'spesialisasi' => $request->spesialisasi,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return Redirect::route('profile.edit')->with('status', 'guru-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if ($request->user()->isTeacher()) {
            return back()->withErrors(['userDeletion' => 'Guru tidak diperbolehkan menghapus akun secara mandiri.']);
        }

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
