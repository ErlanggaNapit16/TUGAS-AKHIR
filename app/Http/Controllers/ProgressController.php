<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function markAsCompleted($taskId)
    {
        Progress::updateOrCreate(
            ['user_id' => Auth::id(), 'task_cemas_id' => $taskId],
            ['is_completed' => true]
        );

        return redirect()->back()->with('success', 'Progress diperbarui!');
    }
}

