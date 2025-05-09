<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\Return_;

class AuthController extends Controller
{
    function tampilRegistrasi()
    {
        return view('/auth/registrasi');
    }

    function submitRegistrasi(Request $request)
{
    $user = new User();
    $user->name = $request->name;
    $user->phone = preg_match('/^\+62/', $request->phone) ? $request->phone : '+62' . ltrim($request->phone, '0');
    $user->email = $request->email;
    $user->age = $request->age; // <-- Tambahkan ini
    $user->password = bcrypt($request->password);
    $user->role = 'customer'; // Default role
    $user->save();

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
}


    function tampilLogin()
    {
        return view('/auth/login');
    }


    public function submitLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login dengan email dan password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate(); // Mengamankan sesi setelah login berhasil

            $user = Auth::user(); // Mendapatkan data pengguna yang login

            // Redirect berdasarkan peran pengguna
            if ($user->role === 'admin') {
                // Redirect ke halaman dashboard admin
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'konselor') {
                // Redirect ke halaman dashboard konselor
                return redirect()->route('konselor.dashboard');
            } else {
                // Redirect ke halaman customer
                return redirect()->route('homepage');
            }
        }

        // Jika login gagal
        return redirect()->back()->withErrors([
            'email' => 'Email atau password salah.'
        ]);
    }


    function logout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }
}
