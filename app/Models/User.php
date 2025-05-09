<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasUuids;

    // Disable auto-incrementing and set key type to string
    public $incrementing = false;
    protected $keyType = 'string';

    

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'age',
        'role',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Set default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'role' => 'customer', // Default role 'customer'
    ];

    /**
     * Check if user has a specific role.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    

    public function prediksiPsikologis()
    {
        
        return $this->hasMany(PrediksiPsikologis::class);
    }
    
    public function isKonselor()
    {
        return $this->role === 'konselor';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'user_id');
    }

    public function progresses()
{
    return $this->hasMany(Progress::class);
}



    /**
     * Override boot method to generate UUID on creation
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
