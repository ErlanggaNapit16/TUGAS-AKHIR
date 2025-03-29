<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    $data = $request->only('email', 'password');

    if (Auth::attempt($data)) {
        $request->session()->regenerate();

        // Redirect berdasarkan peran pengguna
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role === 'konselor') {
            return redirect()->route('konselor.dashboard');
        } else {
            return redirect()->route('homepage');
        }
    }

    return redirect()->back()->with('gagal', 'Email atau password salah.');
}



    function logout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }
}
