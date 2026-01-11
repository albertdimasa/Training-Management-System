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
        Schema::create('order_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('order_headers')->onDelete('cascade');
            $table->foreignId('batch_id')->nullable()->constrained('training_batches')->onDelete('set null');
            $table->foreignId('course_id')->constrained('courses');
            $table->unsignedSmallInteger('qty_participant');
            $table->decimal('unit_price', 14, 2)->default(0);
            $table->decimal('discount_amt', 14, 2)->default(0);
            $table->decimal('tax_rate', 5, 2)->default(11.00);
            $table->decimal('line_total', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_lines');
    }
};
