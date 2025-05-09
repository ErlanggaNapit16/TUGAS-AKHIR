<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCemas extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'deskripsi', 'link',
    ];

    public function progresses()
{
    return $this->hasMany(Progress::class);
}

}
