<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    public function definition(): array
    {
        $categoria = Categoria::inRandomOrder()->firstOrFail();

        return [
            'nome' => fake()->randomElement([
                'Chaveiro personalizado',
                'Marcador de página',
                'Suporte para celular',
                'Enfeite de Natal',
                'Porta-cartão',
            ]),
            'quantidade_estoque' => fake()->numberBetween(0, 100),
            'categoria_id' => Categoria::factory(),
            'user_id' => $categoria->user_id,
        ];
    }
}