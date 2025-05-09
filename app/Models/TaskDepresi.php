<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDepresi extends Model
{
    use HasFactory;

    protected $table = 'task_depresis';

    protected $fillable = ['judul', 'deskripsi', 'link'];


    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }
}