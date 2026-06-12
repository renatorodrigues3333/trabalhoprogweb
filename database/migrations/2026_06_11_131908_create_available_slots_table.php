<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('available_slots', function (Blueprint $table) {

            $table->id();

            $table->foreignId('court_id')
                ->constrained('courts')
                ->cascadeOnDelete();

            $table->tinyInteger('day_of_week')
                ->comment('0=Sunday, 1=Monday ... 6=Saturday');

            $table->time('start_time');

            $table->time('end_time');

            $table->boolean('active')
                ->default(true);

            $table->timestamp('created_at')
                ->useCurrent();

            $table->timestamp('updated_at')
                ->useCurrent()
                ->useCurrentOnUpdate();

            $table->unique(
                ['court_id', 'day_of_week', 'start_time'],
                'uq_slot_court_day_start'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('available_slots');
    }
};
