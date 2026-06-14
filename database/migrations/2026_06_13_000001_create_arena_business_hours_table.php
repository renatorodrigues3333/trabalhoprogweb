<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arena_business_hours', function (Blueprint $table) {

            $table->id();

            $table->foreignId('arena_id')
                  ->constrained('arenas')
                  ->cascadeOnDelete();

            // 0 = Domingo, 1 = Segunda ... 6 = Sábado
            $table->unsignedTinyInteger('day_of_week');

            // Cada linha é UM intervalo de funcionamento.
            // Um dia pode ter vários (ex.: manhã e tarde, com pausa de almoço).
            $table->time('opens_at');

            $table->time('closes_at');

            $table->timestamp('created_at')
                  ->useCurrent();

            $table->timestamp('updated_at')
                  ->useCurrent()
                  ->useCurrentOnUpdate();

            $table->index([
                'arena_id',
                'day_of_week'
            ], 'idx_arena_day');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arena_business_hours');
    }
};
