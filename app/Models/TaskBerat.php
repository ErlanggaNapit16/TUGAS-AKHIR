<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TaskBerat extends Model
{
    use HasFactory;

    protected $table = 'task_berats';

    protected $fillable = ['judul', 'deskripsi', 'link'];



   public function progresses()
    {
        return $this->hasMany(Progress::class);
    }
}
