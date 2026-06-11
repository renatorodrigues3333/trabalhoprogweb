<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quadras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arena_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('nome'); // Adicionar campo para nome da quadra
            $table->enum('tipo', ['futebol', 'basquete', 'volei', 'tenis', 'outros']); // Adicionar campo para tipo da quadra, com opções pré-definidas
            $table->decimal('preco_hora', 8, 2); // Adicionar campo para preço por hora da quadra, com formato decimal
            $table->boolean('ativo')->default(true); // Adicionar campo para indicar se a quadra está ativa ou não, com valor padrão como true
            $table->timestamps();
        });
          
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quadras');
    }
};
