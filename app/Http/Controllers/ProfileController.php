<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File; // Tambahkan ini



class ProfileController extends Controller
{
    // Tampilkan halaman edit profil
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    // Menampilkan halaman profil pengguna
    public function show()
    {
        return view('Konsoler.profile_konselor', ['user' => Auth::user()]);
    }



    // Update data profil pengguna
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            // Hapus gambar lama jika ada
            if (!empty($user->profile_image) && File::exists(public_path($user->profile_image))) {
                File::delete(public_path($user->profile_image));
            }

            // Ambil file dari request
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Simpan gambar di folder public/profile_images/
            $file->move(public_path('profile_images'), $filename);

            // Update path gambar di database
            $user->profile_image = 'profile_images/' . $filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
    }


    // Mengupdate password pengguna
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.konselor')->with('success', 'Password berhasil diperbarui.');
    }

    // Menampilkan halaman profil konselor
    public function showKonselorProfile()
    {
        return view('Konselor.profile_konselor', [
            'user' => Auth::user(),
        ]);
    }


}
