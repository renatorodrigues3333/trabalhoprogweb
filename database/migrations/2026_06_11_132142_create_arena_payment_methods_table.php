<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arena_payment_methods', function (Blueprint $table) {
            $table->id();

            $table->foreignId('arena_id')
                  ->constrained('arenas')
                  ->restrictOnDelete();

            $table->foreignId('payment_method_id')
                  ->constrained('payment_methods')
                  ->restrictOnDelete();

            $table->boolean('active')->default(true);

            $table->timestamp('created_at')
                  ->useCurrent();

            $table->unique([
                'arena_id',
                'payment_method_id'
            ], 'uq_arena_payment_method');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arena_payment_methods');
    }
};
