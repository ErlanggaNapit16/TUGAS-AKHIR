<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{

    // Menampilkan daftar pengumuman (dengan pagination)
    public function index()
    {
        $announcements = Announcement::latest()->paginate(10); // Pagination 10 item per halaman
        return view('konselor.pengumumankonselor', compact('announcements'));
    }

    // Menampilkan form tambah pengumuman
    public function create()
    {
        return view('konselor.create_pengumuman');
    }

    // Menyimpan pengumuman baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'link' => 'nullable|url',
        ]);

        Announcement::create($request->only(['title', 'content', 'link']));

        return redirect()->route('konselor.pengumuman')
            ->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    // Menampilkan form edit pengumuman
    public function edit(Announcement $announcement)
    {
        return view('konselor.edit_pengumuman', compact('announcement'));
    }

    // Memperbarui pengumuman yang ada
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'link' => 'nullable|url',
        ]);

        $announcement->update($request->only(['title', 'content', 'link']));

        return redirect()->route('konselor.pengumuman')
            ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    // Menghapus pengumuman
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('konselor.pengumuman')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }

    // Menampilkan pengumuman di homepage (5 pengumuman terbaru)
    public function homepage()
    {
        return Announcement::all(); // Mengembalikan data, bukan view

        $announcements = Announcement::latest()->take(5)->get(); // Ambil 5 pengumuman terbaru
        return view('homepage', compact('announcements'));
    }

    // Menampilkan detail pengumuman
    public function show(Announcement $announcement)
    {
        return view('announcement_detail', compact('announcement'));
    }


    // Menampilkan semua pengumuman di homepage
    public function showAnnouncements()
    {
        $announcements = Announcement::latest()->get();
        return view('homepage', compact('announcements'));
    }

    public function viewAll()
    {
        $announcements = Announcement::latest()->paginate(10); // Pagination 10 item per halaman
        return view('view_announcement', compact('announcements'));
    }

    public function konselorAnnouncementDetail($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('konselor.konselorannouncement_detail', compact('announcement'));
    }
}
