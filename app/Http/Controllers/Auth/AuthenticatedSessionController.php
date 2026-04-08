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
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses Login dan Pengalihan Berdasarkan Role.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // AMBIL DATA USER YANG LOGIN
        $user = Auth::user();

        // LOGIKA PENGECEKAN ROLE (Mencegah Login Salah Opsi)
        if ($request->role_choice && $user->role !== $request->role_choice) {
            // Logout kembali karena role tidak sesuai pilihan di UI
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Kirim pesan error spesifik
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => "Maaf, akun Anda tidak terdaftar sebagai " . ucfirst($request->role_choice) . ".",
            ]);
        }

        // LOGIKA PENGALIHAN BERDASARKAN ROLE (Redirect ke Dashboard yang sesuai)
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        } 
        
        if ($user->role === 'organizer') {
            return redirect()->intended(route('organizer.dashboard'));
        }

        // Default jika role-nya 'customer'
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}