<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrediksiPsikologis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gejala',
        'hasil_prediksi',
    ];

    protected $casts = [
        'gejala' => 'array',
    ];

      // Relasi dengan User (PrediksiPsikologis belongsTo User)
      public function user()
      {
          return $this->belongsTo(User::class); // Menunjukkan bahwa setiap PrediksiPsikologis berhubungan dengan satu User
      }
      
}
