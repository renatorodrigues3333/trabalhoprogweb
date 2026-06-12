<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cash_register', function (Blueprint $table) {
            $table->id();

            $table->foreignId('arena_id')
                  ->constrained('arenas')
                  ->restrictOnDelete();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->restrictOnDelete();

            $table->timestamp('opened_at')
                  ->useCurrent();

            $table->timestamp('closed_at')
                  ->nullable();

            $table->decimal('opening_balance', 10, 2)
                  ->default(0);

            $table->decimal('closing_balance', 10, 2)
                  ->nullable();

            $table->text('notes')
                  ->nullable();

            $table->enum('status', [
                'open',
                'closed'
            ])->default('open');

            $table->timestamp('created_at')
                  ->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_register');
    }
};
