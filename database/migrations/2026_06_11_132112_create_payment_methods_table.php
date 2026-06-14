<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();

            $table->enum('type', [
                'pix',
                'card',
                'cash'
            ])->unique();

            // Texto exibido no formulário (ex.: "PIX", "Cartão", "Dinheiro")
            $table->string('label', 40);

            $table->boolean('active')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
