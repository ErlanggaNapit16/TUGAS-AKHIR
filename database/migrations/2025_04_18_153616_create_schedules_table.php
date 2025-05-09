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
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade'); // User yang request
            $table->foreignUuid('konselor_id')->constrained('users')->onDelete('cascade'); // Konselor yg dituju
            $table->date('date');
            $table->time('time');
            // ✅ Tambahkan status 'rejected' ke enum
            $table->enum('status', ['requested', 'reschedule', 'approved', 'pending_reschedule', 'rejected'])->default('requested');
            $table->timestamps();
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
