<?php

namespace App\Http\Controllers;

use App\Models\Study;
use App\Models\Pembelajaran;
use Illuminate\Http\Request;

class StudyController extends Controller
{
    public function indexKonselorGabung()
    {
        $pembelajaran = Pembelajaran::latest()->paginate(10);
        $studies = Study::latest()->paginate(10);

        return view('Konselor.pembelajaran_konselor', compact('pembelajaran', 'studies'));
    }

    //     public function indexUser()
    // {
    //     $studies = Study::latest()->get();
    //     return view('pembelajaran_user', compact('studies'));
    // }


    public function indexKonselor()
    {
        $studies = Study::latest()->get();
        return view('Konselor.pembelajaran_konselor', compact('studies'));
    }


    public function create()
    {
        return view('konselor.study_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'required|url'
        ]);

        Study::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
        ]);

        return redirect()->route('konselor.pembelajaran_konselor')->with('success', 'Konten berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $study = Study::findOrFail($id);
        return view('Konselor.study_edit', compact('study'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'required|url'
        ]);

        $study = Study::findOrFail($id);
        $study->update($request->only('judul', 'deskripsi', 'link'));

        return redirect()->route('konselor.pembelajaran_konselor')->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $study = Study::findOrFail($id);
        $study->delete();

        return redirect()->route('konselor.pembelajaran_konselor')->with('success', 'Konten berhasil dihapus.');
    }
}
