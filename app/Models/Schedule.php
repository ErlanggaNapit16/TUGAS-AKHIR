<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'konselor_id',
        'date',
        'time',
        'status'
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rescheduleOptions()
    {
        return $this->hasMany(RescheduleOption::class);
    }

    public function konselor()
    {
        return $this->belongsTo(User::class, 'konselor_id');
    }
}
