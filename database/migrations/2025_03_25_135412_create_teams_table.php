<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama anggota
            $table->string('role'); // Jabatan
            $table->text('bio'); // Deskripsi singkat
            $table->string('image'); // Gambar
            $table->json('social_links')->nullable(); // Link sosial media
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};

