<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  // Tambahkan user_id agar bisa digunakan untuk mass assignment
        'message', 
    ];

    // Relasi ke User (Opsional, jika ada tabel users)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

