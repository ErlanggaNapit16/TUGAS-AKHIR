<?php

namespace App\Http\Controllers;

use App\Models\TaskBerat;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskBeratController extends Controller
{
    // Menampilkan daftar task berat untuk user
    public function indexUser()
    {
        $tasks = TaskBerat::orderBy('created_at', 'asc')->get();
        $user = Auth::user();

        $progressData = Progress::where('user_id', $user->id)
            ->whereIn('task_berat_id', $tasks->pluck('id'))
            ->pluck('is_completed', 'task_berat_id')
            ->toArray();

        return view('user_berat', compact('tasks', 'progressData'));
    }

    // Menampilkan daftar task berat untuk konselor
    public function indexKonselorBerat()
    {
        $tasks = TaskBerat::orderBy('created_at', 'asc')->paginate(10);

        $progressCounts = Progress::select('task_berat_id')
            ->selectRaw('count(*) as total')
            ->selectRaw('sum(is_completed) as completed')
            ->groupBy('task_berat_id')
            ->pluck('completed', 'task_berat_id')
            ->toArray();

        return view('konselor.task_berat_konselor', compact('tasks', 'progressCounts'));
    }

    // Menampilkan form untuk membuat task berat baru
    public function create()
    {
        return view('konselor.berat_create');
    }

    // Menyimpan task berat baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'required|url',
        ]);

        TaskBerat::create($request->only('judul', 'deskripsi', 'link'));

        return redirect()->route('konselor.task_berat.index')->with('success', 'Task berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit task berat
    public function edit($id)
    {
        $task = TaskBerat::findOrFail($id);
        return view('konselor.berat_edit', compact('task'));
    }

    // Memperbarui task berat
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'required|url',
        ]);

        $task = TaskBerat::findOrFail($id);
        $task->update($request->only('judul', 'deskripsi', 'link'));

        return redirect()->route('konselor.task_berat.index')->with('success', 'Task berhasil diperbarui.');
    }

    // Menghapus task berat
    public function destroy($id)
    {
        $task = TaskBerat::findOrFail($id);
        $task->delete();

        return redirect()->route('konselor.task_berat.index')->with('success', 'Task berhasil dihapus.');
    }

    // Mereset progres task berat
    public function resetBeratTasks()
    {
        $user = Auth::user();

        Progress::where('user_id', $user->id)
            ->whereNotNull('task_berat_id')
            ->delete();

        return redirect()->route('user_berat')->with('success', 'Progres task berat telah direset.');
    }

    // Menandai task berat sebagai selesai
    public function markAsCompleted($taskId)
    {
        $user = Auth::user();
        
        // Cek jika user tidak ada (belum login)
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        // Cek apakah task dengan ID tersebut ada
        $task = TaskBerat::findOrFail($taskId);
    
        // Cek apakah progress sudah ada, jika tidak buat yang baru
        $progress = Progress::firstOrCreate(
            ['user_id' => $user->id, 'task_berat_id' => $task->id],
            ['task_cemas_id' => null, 'task_depresi_id' => null, 'is_completed' => false]
        );
    
        // Tandai task sebagai selesai
        $progress->is_completed = true;
        $progress->save();
    
        // Redirect kembali ke halaman user-berat
        return redirect()->route('user_berat')->with('success', 'Task berhasil ditandai sebagai selesai.');
    }
}
