<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class RescheduleOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'date',
        'time',
    ];
}