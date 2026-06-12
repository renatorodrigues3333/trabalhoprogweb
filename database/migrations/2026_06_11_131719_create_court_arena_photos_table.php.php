<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('court_arena_photos', function (Blueprint $table) {

            $table->id();

            $table->string('url', 500);

            $table->string('description', 255)
                ->nullable();

            $table->integer('order')
                ->default(0);

            $table->timestamp('created_at')
                ->useCurrent();

            $table->foreignId('court_id')
                ->nullable()
                ->constrained('courts');

            $table->foreignId('arena_id')
                ->nullable()
                ->constrained('arenas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('court_arena_photos');
    }
};
