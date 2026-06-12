<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('arena_id')
                ->constrained('arenas')
                ->restrictOnDelete();

            $table->string('name', 80);

            $table->text('description')
                ->nullable();

            $table->decimal('hourly_rate', 10, 2);

            $table->boolean('active')
                ->default(true);

            $table->timestamp('created_at')
                ->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};