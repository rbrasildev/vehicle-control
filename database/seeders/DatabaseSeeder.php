<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(40)->create();

        $this->call(VeiculosSeeder::class);

        User::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->email()
        ]);
    }
}
