<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Métodos de pagamento disponíveis para as arenas escolherem.
     * Para adicionar/remover uma opção, edite a lista abaixo
     * (e o enum em create_payment_methods_table, se for um tipo novo).
     */
    public function run(): void
    {
        $metodos = [
            ['type' => 'pix',  'label' => 'PIX'],
            ['type' => 'card', 'label' => 'Cartão'],
            ['type' => 'cash', 'label' => 'Dinheiro'],
        ];

        foreach ($metodos as $metodo) {
            PaymentMethod::updateOrCreate(
                ['type' => $metodo['type']],
                ['label' => $metodo['label'], 'active' => true]
            );
        }
    }
}
