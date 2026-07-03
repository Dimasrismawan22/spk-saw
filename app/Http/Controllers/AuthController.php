<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // =====================================================
    // HALAMAN LOGIN
    // =====================================================
    public function showLoginForm()
    {
        // Jika user sudah login, langsung arahkan ke halaman siswa
        if (Auth::check()) {
            return redirect('/siswa');
        }

        return view('auth.login');
    }

    // =====================================================
    // PROSES LOGIN
    // =====================================================
    public function login(Request $request)
    {
        // =========================
        // VALIDASI INPUT
        // =========================
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // =========================
        // PROSES LOGIN
        // =========================
        if (Auth::attempt($credentials)) {

            // Keamanan session login
            $request->session()->regenerate();

            return redirect('/siswa')
                ->with('success', 'Masuk berhasil. Selamat datang.');
        }

        // =========================
        // JIKA LOGIN GAGAL
        // =========================
        return back()
            ->withErrors([
                'email' => 'Email atau kata sandi salah.',
            ])
            ->onlyInput('email');
    }

    // =====================================================
    // LOGOUT
    // =====================================================
    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Hapus session lama
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Keluar berhasil.');
    }
}