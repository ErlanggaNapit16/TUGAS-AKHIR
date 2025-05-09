<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $fillable = ['user_id', 'task_cemas_id', 'task_depresi_id','task_berat_id' ,'is_completed'];  // Tambahkan task_depresi_id ke $fillable

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taskCemas()
    {
        return $this->belongsTo(TaskCemas::class);
    }

    public function taskDepresi()
    {
        return $this->belongsTo(TaskDepresi::class);
    }

    public function taskBerat()
    {
        return $this->belongsTo(TaskBerat::class);
    }
}

