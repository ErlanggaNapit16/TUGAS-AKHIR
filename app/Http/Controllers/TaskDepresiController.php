<?php

namespace App\Http\Controllers;

use App\Models\TaskDepresi;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskDepresiController extends Controller
{
    public function indexUser()
{
    $tasks = TaskDepresi::orderBy('created_at', 'asc')->get();
    $user = Auth::user();

    $progressData = Progress::where('user_id', $user->id)
        ->whereIn('task_depresi_id', $tasks->pluck('id'))
        ->pluck('is_completed', 'task_depresi_id')
        ->toArray();

    return view('user_depresi', compact('tasks', 'progressData'));
}


    public function indexKonselorDepresi()
    {
        $tasks = TaskDepresi::orderBy('created_at', 'asc')->paginate(10);

        $progressCounts = Progress::select('task_depresi_id')
            ->selectRaw('count(*) as total')
            ->selectRaw('sum(is_completed) as completed')
            ->groupBy('task_depresi_id')
            ->pluck('completed', 'task_depresi_id')
            ->toArray();

        return view('konselor.depresi_konselor', compact('tasks', 'progressCounts'));
    }

    public function create()
    {
        return view('konselor.depresi_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'required|url',
        ]);

        TaskDepresi::create($request->only('judul', 'deskripsi', 'link'));

        return redirect()->route('konselor.task_depresi.index')->with('success', 'Task berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $task = TaskDepresi::findOrFail($id);
        return view('konselor.depresi_edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'required|url',
        ]);

        $task = TaskDepresi::findOrFail($id);
        $task->update($request->only('judul', 'deskripsi', 'link'));

        return redirect()->route('konselor.task_depresi.index')->with('success', 'Task berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $task = TaskDepresi::findOrFail($id);
        $task->delete();

        return redirect()->route('konselor.task_depresi.index')->with('success', 'Task berhasil dihapus.');
    }

    public function resetDepresiTasks()
    {
        $user = Auth::user();

        Progress::where('user_id', $user->id)
            ->whereNotNull('task_depresi_id')
            ->delete();

        return redirect()->route('user_depresi')->with('success', 'Progres task depresi telah direset.');
    }

    public function markAsCompleted($taskId)
    {
        $user = Auth::user();
        
        // Cek jika user tidak ada (belum login)
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        // Cek apakah task dengan ID tersebut ada
        $task = TaskDepresi::findOrFail($taskId);
    
        // Cek apakah progress sudah ada, jika tidak buat yang baru
        $progress = Progress::firstOrCreate(
            ['user_id' => $user->id, 'task_depresi_id' => $task->id],
            ['task_cemas_id' => null, 'is_completed' => false]
        );
    
        // Tandai task sebagai selesai
        $progress->is_completed = true;
        $progress->save();
    
        // Redirect kembali ke halaman user-depresi
        return redirect()->route('user_depresi')->with('success', 'Task berhasil ditandai sebagai selesai.');
    }
    
}
