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
        Schema::create('training_batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_code')->unique();
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('trainer_id')->nullable()->constrained('instructors')->onDelete('set null');
            $table->foreignId('venue_id')->nullable()->constrained('venues')->onDelete('set null');
            $table->enum('execution_type', ['PUBLIC', 'INHOUSE', 'ONLINE']);
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedTinyInteger('quota');
            $table->enum('status', ['PLANNED', 'OPEN', 'ONGOING', 'COMPLETED', 'CANCELLED'])->default('PLANNED');
            $table->timestamps();

            $table->index(['start_date', 'end_date']);
            $table->index('course_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_batches');
    }
};
