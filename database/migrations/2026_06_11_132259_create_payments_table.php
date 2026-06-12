<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                  ->constrained('bookings')
                  ->restrictOnDelete();

            $table->foreignId('payment_method_id')
                  ->constrained('payment_methods')
                  ->restrictOnDelete();

            $table->decimal('amount', 10, 2);

            $table->enum('status', [
                'pending',
                'paid',
                'refunded'
            ])->default('pending');

            $table->string('pix_transaction_id', 100)
                  ->nullable();

            $table->string('receipt_url', 500)
                  ->nullable();

            $table->enum('origin', [
                'online',
                'local'
            ]);

            $table->timestamp('paid_at')
                  ->nullable();

            $table->timestamp('created_at')
                  ->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
