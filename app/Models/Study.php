<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $fillable = [
        'judul', 'deskripsi', 'link'
    ];
}
