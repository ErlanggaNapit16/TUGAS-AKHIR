<?php

namespace App\Http\Controllers;

use App\Models\Pembelajaran;
use App\Models\Study;
use Illuminate\Http\Request;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;


class PembelajaranController extends Controller
{
    public function indexGabungan()
    {
        $pembelajaran = Pembelajaran::latest()->paginate(5, ['*'], 'pembelajaran_page'); // konten berupa file
        $studies = \App\Models\Study::latest()->paginate(5, ['*'], 'studies_page');

        return view('Konselor.pembelajaran_konselor', compact('pembelajaran', 'studies'));
    }
    public function indexUser()
    {
        $pembelajaran = Pembelajaran::latest()->paginate(6, ['*'], 'pembelajaran_page');
        $studies = \App\Models\Study::latest()->paginate(4, ['*'], 'studies_page');

        return view('pembelajaran_user', compact('pembelajaran', 'studies'));
    }


    public function create()
    {
        return view('Konselor.pembelajaran_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:5000',
            'tipe' => 'required|in:video,gambar',
            'konten_file' => 'required|file|mimes:mp4,mov,avi,jpg,jpeg,png|max:2097152', // 2GB
        ]);

        $path = null;

        if ($request->hasFile('konten_file')) {
            $file = $request->file('konten_file');
            $folder = 'konten_pembelajaran/' . $request->tipe;
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($folder), $filename);
            $path = $folder . '/' . $filename;
        }

        Pembelajaran::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tipe' => $request->tipe,
            'konten' => $path,
        ]);

        return redirect()->route('konselor.pembelajaran')->with('success', 'Konten berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pembelajaran = Pembelajaran::findOrFail($id);
        return view('Konselor.pembelajaran_edit', compact('pembelajaran'));
    }

    public function update(Request $request, $id)
    {
        $pembelajaran = Pembelajaran::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:5000',
            'tipe' => 'required|in:video,gambar',
            'file' => 'nullable|file|mimes:mp4,mov,avi,jpg,jpeg,png|max:2097152', // 2GB
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tipe' => $request->tipe,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama
            if (!empty($pembelajaran->konten) && file_exists(public_path($pembelajaran->konten))) {
                unlink(public_path($pembelajaran->konten));
            }

            // Simpan file baru
            $file = $request->file('file');
            $folder = 'konten_pembelajaran/' . $request->tipe;
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($folder), $filename);
            $data['konten'] = $folder . '/' . $filename;
        }

        $pembelajaran->update($data);

        return redirect()->route('konselor.pembelajaran')->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembelajaran = Pembelajaran::findOrFail($id);

        // Hapus file dari storage jika ada
        if (!empty($pembelajaran->konten) && file_exists(public_path($pembelajaran->konten))) {
            unlink(public_path($pembelajaran->konten));
        }

        // Hapus data dari database
        $pembelajaran->delete();

        return redirect()->route('konselor.pembelajaran')->with('success', 'Konten berhasil dihapus.');
    }

    public function uploadChunk(Request $request)
    {
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        if ($receiver->isUploaded()) {
            $save = $receiver->receive();

            if ($save->isFinished()) {
                $file = $save->getFile();
                $filePath = storage_path('app/uploads/');
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($filePath, $fileName);

                return response()->json([
                    'done' => true,
                    'filename' => $fileName,
                ]);
            }

            $handler = $save->handler();
            return response()->json([
                "done" => false,
                "percentage" => $handler->getPercentageDone(),
            ]);
        }

        throw new \Exception("No file uploaded");
    }

    public function show($id)
    {
        $pembelajaran = Pembelajaran::findOrFail($id); // Pastikan modelnya sesuai
        return view('detail_pembelajaran', compact('pembelajaran'));
    }

    public function showKonselor($id)
    {
        $pembelajaran = Pembelajaran::findOrFail($id);
        return view('Konselor.studi_detail', compact('pembelajaran'));
    }
}
