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
        Schema::create('reschedule_options', function (Blueprint $table) {
            $table->id();
            $table->uuid('schedule_id'); // sesuaikan tipe-nya
            $table->date('date');
            $table->time('time');
            $table->timestamps();
        
            // definisikan foreign key
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reschedule_options');
    }
};
