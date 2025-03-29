<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\File;

class CarouselController extends Controller
{
    public function index()
{
    // Ambil semua data carousel dari database
    $carousels = Carousel::all();

    // Kirim data ke view
    return view('Konselor.carousel_konselor', compact('carousels'));
}

public function homepage()
{
    
    $carousels = Carousel::all();
    return Carousel::all(); // Mengembalikan data, bukan view

    return view('homepage', compact('carousels'));
}


    public function create()
    {
        return view('Konselor.carousel_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Ambil file dari request
        $image = $request->file('image');
        
        // Buat nama unik untuk file
        $imageName = time() . '_' . $image->getClientOriginalName();

        // Simpan gambar di folder public/carousel_images/
        $image->move(public_path('carousel_images'), $imageName);

        // Simpan data ke database dengan path yang bisa diakses langsung
        Carousel::create([
            'image' => 'carousel_images/' . $imageName, // Simpan path relatif
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('konselor.carousel')->with('success', 'Carousel berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('Konselor.carousel_edit', compact('carousel'));
    }

    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if (File::exists(public_path($carousel->image))) {
                File::delete(public_path($carousel->image));
            }

            // Ambil file dari request
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Simpan gambar di folder public/carousel_images/
            $image->move(public_path('carousel_images'), $imageName);

            // Update path gambar di database
            $carousel->image = 'carousel_images/' . $imageName;
        }

        $carousel->title = $request->title;
        $carousel->description = $request->description;
        $carousel->save();

        return redirect()->route('konselor.carousel')->with('success', 'Carousel berhasil diubah!');
    }

    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);

        // Hapus gambar dari folder public jika ada
        if (File::exists(public_path($carousel->image))) {
            File::delete(public_path($carousel->image));
        }

        $carousel->delete();

        return redirect()->route('konselor.carousel')->with('success', 'Carousel berhasil dihapus!');
    }
}
