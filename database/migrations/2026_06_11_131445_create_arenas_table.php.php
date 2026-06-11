<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arenas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('owner_id')
                ->constrained('owners')
                ->restrictOnDelete();

            $table->string('name', 120);

            $table->text('description')
                ->nullable();

            $table->string('address', 255);

            $table->string('phone', 20)
                ->nullable();

            $table->string('contact_email', 150)
                ->nullable();

            $table->timestamp('business_hours')
                ->nullable();

            $table->boolean('active')
                ->default(true);

            $table->timestamp('created_at')
                ->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arenas');
    }
};
