<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembelajarans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->longText('deskripsi')->nullable(); // Ganti dari text ke longText
            $table->enum('tipe', ['video', 'gambar']); // Hanya dua jenis konten
            $table->string('konten'); // Path ke file (gambar/video)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelajarans');
    }
};
