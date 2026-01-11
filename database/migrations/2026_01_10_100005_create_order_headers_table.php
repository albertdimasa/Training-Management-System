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
        Schema::create('order_headers', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->unique();
            $table->date('order_date');
            $table->foreignId('client_id')->constrained('clients');
            $table->enum('resource_type', ['TRANSACTION_BASED', 'ACCRUAL_BASED'])->default('TRANSACTION_BASED');
            $table->enum('status', ['DRAFT', 'CONFIRMED', 'CANCELLED', 'COMPLETED'])->default('DRAFT');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['client_id', 'order_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_headers');
    }
};
