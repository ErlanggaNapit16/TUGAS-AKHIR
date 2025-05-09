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
        
        Schema::create('studies', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Kolom judul
            $table->text('deskripsi')->nullable(); // Kolom deskripsi
            $table->text('link'); // Kolom link, karena hanya ada link yang disimpan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studies');
    }
};
