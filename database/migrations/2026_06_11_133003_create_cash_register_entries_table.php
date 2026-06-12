<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cash_register_entries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cash_register_id')
                  ->constrained('cash_register')
                  ->restrictOnDelete();

            $table->foreignId('booking_id')
                  ->nullable()
                  ->constrained('bookings')
                  ->nullOnDelete();

            $table->enum('type', [
                'income',
                'expense'
            ]);

            $table->decimal('amount', 10, 2);

            $table->string('description', 255);

            $table->timestamp('created_at')
                  ->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_register_entries');
    }
};
