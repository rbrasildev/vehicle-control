<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VeiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Quantidade de veículos para gerar
        $quantidade = 20;

        for ($i = 0; $i < $quantidade; $i++) {
            DB::table('veiculos')->insert([
                'placa' => strtoupper(Str::random(3)) . '-' . rand(1000, 9999),
                'marca' => fake()->company(),
                'modelo' => fake()->word(),
                'ano' => fake()->year(),
                'chassi' => strtoupper(Str::random(17)),
            ]);
        }
    }
}
