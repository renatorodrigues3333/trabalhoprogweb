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
        Schema::create('arenas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('nome');
            $table->string('telefone') ->nullable(); // Permitir que o campo telefone seja nulo, caso o usuário não queira fornecer essa informação
            
            $table->string('Endereco');// Adicionar campo para número do endereço
            $table->string('descricao')->nullable(); // Adicionar campo para complemento do endereço, permitindo que seja nulo
            $table->string('logo')->nullable(); // Adicionar campo para armazenar o caminho da logo da arena, permitindo que seja nulo
            $table->string('imagem')->nullable(); // Adicionar campo para armazenar o caminho da imagem da arena, permitindo que seja nulo
            $table->boolean('ativo')->default(true); // Adicionar campo para indicar se a arena está ativa ou não, com valor padrão como true
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arenas');
    }
};
