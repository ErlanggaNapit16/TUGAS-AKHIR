<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateKonselorController extends Controller
{

    public function index()
{
    $konselors = User::where('role', 'konselor')->get();
    return view('admin.create_konselor_admin', compact('konselors'));
}
    public function create()
    {
        $konselors = User::where('role', 'konselor')->get();

        return view('admin.create_konselor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string|max:20',
            'age'      => 'nullable|integer',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'age'      => $request->age,
            'password' => Hash::make($request->password),
            'role'     => 'konselor',
        ]);

        return redirect()->route('admin.create_konselor_admin')->with('success', 'Konselor berhasil ditambahkan!');
    }

    public function destroy($id)
{
    $konselor = User::where('role', 'konselor')->findOrFail($id);
    $konselor->delete();

    return redirect()->route('admin.create_konselor_admin')->with('success', 'Konselor berhasil dihapus.');
}

}
