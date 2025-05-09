<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->unsignedBigInteger('task_cemas_id')->nullable();
            $table->unsignedBigInteger('task_depresi_id')->nullable(); // Menambahkan kolom task_depresi_id
            $table->unsignedBigInteger('task_berat_id')->nullable();


            

            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_cemas_id')->references('id')->on('task_cemas')->onDelete('cascade');
            $table->foreign('task_depresi_id')->references('id')->on('task_depresis')->onDelete('cascade'); // perbaiki ini
            $table->foreign('task_berat_id')->references('id')->on('task_berats')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
