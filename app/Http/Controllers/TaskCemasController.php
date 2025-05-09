<?php

namespace App\Http\Controllers;

use App\Models\TaskCemas;
use Illuminate\Http\Request;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;

class TaskCemasController extends Controller
{
    public function indexUser()
{
    $tasks = TaskCemas::orderBy('created_at', 'asc')->get();
    $user = Auth::user();

    $progressData = Progress::where('user_id', $user->id)
        ->whereIn('task_cemas_id', $tasks->pluck('id'))
        ->pluck('is_completed', 'task_cemas_id')
        ->toArray();

    return view('user_cemas', compact('tasks', 'progressData'));
}

    public function indexKonselorCemas()
    {
        $tasks = TaskCemas::orderBy('created_at', 'asc')->paginate(10);

        $progressCounts = Progress::select('task_cemas_id')
            ->selectRaw('count(*) as total')
            ->selectRaw('sum(is_completed) as completed')
            ->groupBy('task_cemas_id')
            ->pluck('completed', 'task_cemas_id')
            ->toArray();

        return view('konselor.cemas_konselor', compact('tasks', 'progressCounts'));
    }

    public function create()
    {
        return view('konselor.cemas_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'required|url',
        ]);

        TaskCemas::create($request->only('judul', 'deskripsi', 'link'));

        return redirect()->route('konselor.task_cemas.index')->with('success', 'Task berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $task = TaskCemas::findOrFail($id);
        return view('konselor.edit_cemas', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'required|url',
        ]);

        $task = TaskCemas::findOrFail($id);
        $task->update($request->only('judul', 'deskripsi', 'link'));

        return redirect()->route('konselor.task_cemas.index')->with('success', 'Task berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $task = TaskCemas::findOrFail($id);
        $task->delete();

        return redirect()->route('konselor.task_cemas.index')->with('success', 'Task berhasil dihapus.');
    }

     // ✅ Tambahkan method ini untuk reset progres
     public function resetCemasTasks()
{
    $user = Auth::user();

    // Hapus semua progres task cemas milik user ini
    Progress::where('user_id', $user->id)
        ->whereNotNull('task_cemas_id')
        ->delete();

    // Redirect ke halaman task cemas user
    return redirect()->route('user_cemas')->with('success', 'Progres task cemas telah direset. Silakan mulai kembali.');
}
}
