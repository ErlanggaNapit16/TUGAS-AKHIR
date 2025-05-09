<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskCemas;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();  // Mendapatkan ID user yang sedang login

        // Ambil semua task dan progres berdasarkan user yang login
        $tasks = TaskCemas::all();  // Ambil semua task
        $progress = Progress::where('user_id', $userId)->get();  // Ambil progres berdasarkan user yang login
        
        // Gabungkan task dengan progres dan hitung progres
        $tasksWithProgress = $tasks->map(function ($task) use ($progress, $userId) {
            // Cek apakah user sudah menyelesaikan task
            $taskProgress = $progress->firstWhere('task_id', $task->id);
            $task->progress = $taskProgress ? $taskProgress->status : 'Belum selesai';  // Tentukan status progres
            return $task;
        });

        // Menghitung persentase progres
        $completedTasks = $tasksWithProgress->filter(function ($task) {
            return $task->progress === 'Selesai';
        })->count();

        $totalTasks = $tasksWithProgress->count();
        $completionPercentage = ($totalTasks > 0) ? ($completedTasks / $totalTasks) * 100 : 0;

        return view('histori', [
            'tasksWithProgress' => $tasksWithProgress,
            'completionPercentage' => round($completionPercentage, 2),  // Menyimpan persentase progres
        ]);
    }

    // Menambahkan method taskDetail
    public function taskDetail($taskId)
    {
        // Mendapatkan task berdasarkan ID
        $task = TaskCemas::findOrFail($taskId);

        // Menampilkan halaman detail untuk task yang dipilih
        return view('task_detail', [
            'task' => $task
        ]);
    }
}
