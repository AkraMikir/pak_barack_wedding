<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.guests.index');
        }

        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $key = 'admin-login:'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            return back()->withErrors([
                'password' => "Terlalu banyak percobaan login yang gagal. Akun dikunci selama {$seconds} detik.",
            ])->withInput();
        }

        $validated = $request->validate([
            'password' => ['required', 'string'],
        ]);

        $storedPassword = Setting::get('admin_password');

        if (! $storedPassword) {
            $storedPassword = Hash::make('bangbaraklavana333wedding');
            Setting::set('admin_password', $storedPassword);
        }

        $isValid = Hash::check($validated['password'], $storedPassword);

        if ($isValid) {
            RateLimiter::clear($key);
            $request->session()->put('admin_authenticated', true);
            $request->session()->regenerate();

            return redirect()->route('admin.guests.index')->with('success', 'Selamat datang di Dashboard Admin.');
        }

        RateLimiter::hit($key, 60);

        $remaining = RateLimiter::remaining($key, 5);
        $errorMsg = $remaining > 0
            ? "Password admin tidak valid. Sisa percobaan: {$remaining} kali."
            : 'Terlalu banyak percobaan login yang gagal. Akun dikunci selama 60 detik.';

        return back()->withErrors(['password' => $errorMsg])->withInput();
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_authenticated');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda telah keluar dari sesi admin.');
    }
}
