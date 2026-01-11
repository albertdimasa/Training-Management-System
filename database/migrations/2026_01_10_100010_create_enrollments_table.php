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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_line_id')->nullable()->constrained('order_lines')->onDelete('set null');
            $table->foreignId('batch_id')->constrained('training_batches')->onDelete('cascade');
            $table->foreignId('participant_id')->constrained('participants')->onDelete('cascade');
            $table->enum('enroll_status', ['REGISTERED', 'CONFIRMED', 'ATTENDED', 'NO_SHOW', 'CANCELLED'])->default('REGISTERED');
            $table->decimal('score', 5, 2)->nullable();
            $table->timestamps();

            $table->unique(['batch_id', 'participant_id']);
            $table->index('batch_id');
            $table->index('participant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
