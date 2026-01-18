<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // =====================
    // SHOW LOGIN
    // =====================
    public function index()
    {
        // if (Auth::check()) {
        //     return redirect()->route('dashboard');
        // }

        return view('login.form_login');
    }

    // =====================
    // PROCESS LOGIN
    // =====================
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        if (Auth::attempt([
            $loginField => $request->username,
            'password'  => $request->password
        ])) {
            $request->session()->regenerate();

            $user = Auth::user();

            // cek role user
            if ($user->hasRole('supervisor|admin')) {
                return redirect()->route('admin.dashboard'); // route admin
            }

            // user biasa
            return redirect()->route('settings.index'); // route user biasa
        }

        return back()->with('error', 'Username atau password salah');
    }


    // =====================
    // SHOW REGISTER
    // =====================
    public function showRegister()
    {
        // if (Auth::check()) {
        //     return redirect()->route('dashboard');
        // }

        return view('login.form_register');
    }

    // =====================
    // PROCESS REGISTER
    // =====================
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
        ]);

        User::create([
            'name'     => $request->username,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
