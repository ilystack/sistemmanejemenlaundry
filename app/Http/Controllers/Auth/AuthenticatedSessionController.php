<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ActivityLogger;
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
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $role = $request->route('role', 'admin'); // Default ke admin jika tidak ada
        return view('auth.login', ['role' => $role]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Invalidate other sessions (Single Device Login)
        Auth::logoutOtherDevices($request->password);

        $user = Auth::user();

        // Get the role from route parameter
        $loginRole = $request->route('role');

        // Validate if user's role matches the login form role
        if ($loginRole && $user->role !== $loginRole) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Akun ini tidak terdaftar sebagai ' . ucfirst($loginRole) . '. Silakan gunakan form login yang sesuai.',
            ])->onlyInput('email');
        }

        // Log login activity
        ActivityLogger::logAuth('login', $user->name);

        // Cek apakah role user sesuai dengan role login yang dipilih (opsional, tapi bagus untuk security)
        // Kalau mau strict:
        // $loginRole = $request->route('role');
        // if ($loginRole && $user->role !== $loginRole) {
        //    Auth::logout();
        //    return redirect()->route('login.' . $loginRole)->withErrors(['email' => 'Akun ini tidak terdaftar sebagai ' . $loginRole]);
        // }

        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Selamat datang, ' . $user->name . '!');
        } elseif ($user->role === 'karyawan') {
            return redirect()->intended(route('karyawan.dashboard'))->with('success', 'Selamat datang, ' . $user->name . '!');
        } else {
            return redirect()->intended(route('customer.dashboard'))->with('success', 'Selamat datang, ' . $user->name . '!');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $userName = Auth::user()?->name;

        // Log logout activity before logging out
        if ($userName) {
            ActivityLogger::logAuth('logout', $userName);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout');
    }
}
