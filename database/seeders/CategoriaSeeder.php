<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrFail();

        Categoria::factory()->count(5)->create([
            'user_id' => $user->id,
        ]);
    }
}