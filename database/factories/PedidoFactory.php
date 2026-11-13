<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Item;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pedido>
 */
class PedidoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'quantidade' => fake()->numberBetween(1, 10),
            'endereco_entrega' => fake()->address(),
            'prazo_entrega' => fake()
                ->dateTimeBetween('now', '+15 days')
                ->format('Y-m-d'),
            'status' => 'pendente',
            'user_id' => User::firstOrFail()->id,
            'cliente_id' => Cliente::inRandomOrder()->firstOrFail()->id,
            'item_id' => Item::inRandomOrder()->firstOrFail()->id,
        ];
    }
}