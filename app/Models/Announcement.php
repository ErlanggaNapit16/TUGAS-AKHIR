<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'link', 'created_at', 'updated_at'];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}