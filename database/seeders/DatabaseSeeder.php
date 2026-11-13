<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@rotacerta.test'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
            ]
        );

        $this->call([
            CategoriaSeeder::class,
            ClienteSeeder::class,
            ItemSeeder::class,
            PedidoSeeder::class,
        ]);
    }
}