<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class AdminAuthController extends Controller
{
    // HALAMAN LOGIN ADMIN
    public function login()
    {
        // Jika admin sudah login, langsung ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        // Mengambil Site Key dari config/services.php
        $siteKey = config('services.recaptcha.site_key');

        // Menampilkan halaman login admin
        return response()->view('admin.login', compact('siteKey'));
    }

    // PROSES LOGIN ADMIN
    public function authenticate(Request $request)
    {
        // Validasi email, password, dan token CAPTCHA
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|string',
        ], [
            'g-recaptcha-response.required' =>
                'Silakan centang CAPTCHA terlebih dahulu.',
        ]);

        // Mengambil token CAPTCHA dari Google
        $captchaToken = $credentials['g-recaptcha-response'];

        // Memverifikasi CAPTCHA ke server Google
        try {
            $captchaResponse = Http::asForm()
                ->timeout(10)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => config('services.recaptcha.secret_key'),
                    'response' => $captchaToken,
                    'remoteip' => $request->ip(),
                ]);

        } catch (ConnectionException $e) {
            return back()
                ->withErrors([
                    'captcha' => 'Tidak dapat menghubungi server CAPTCHA. Periksa koneksi internet dan coba lagi.',
                ])
                ->withInput($request->only('email'));
        }

        // Jika Google tidak memberikan respons berhasil
        if (!$captchaResponse->successful()) {
            return back()
                ->withErrors([
                    'captcha' => 'Verifikasi CAPTCHA gagal. Silakan coba lagi.',
                ])
                ->withInput($request->only('email'));
        }

        // Memeriksa hasil verifikasi Google
        if (!$captchaResponse->json('success')) {
            return back()
                ->withErrors([
                    'captcha' => 'CAPTCHA tidak valid. Silakan centang ulang.',
                ])
                ->withInput($request->only('email'));
        }

        // Data email dan password untuk login
        $loginCredentials = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];

        // Memeriksa kecocokan email dan password
        if (Auth::attempt(
            $loginCredentials,
            $request->boolean('remember')
        )) {

            // Memperbarui session untuk keamanan
            $request->session()->regenerate();

            // Mengarahkan admin ke dashboard
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang di Dashboard Admin.');
        }

        // Jika login gagal
        return back()
            ->withErrors([
                'email' => 'Email atau password yang dimasukkan salah.',
            ])
            ->withInput($request->only('email'));
    }

    // PROSES LOGOUT ADMIN
    public function logout(Request $request)
    {
        // Logout akun
        Auth::logout();

        // Menghapus dan membuat ulang session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Kembali ke halaman login admin
        return redirect()->route('admin.login')
            ->with('success', 'Anda berhasil logout.');
    }
}