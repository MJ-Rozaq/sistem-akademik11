<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\kaprodi>
 */
class kaprodiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory()->create(['role' => 'kaprodi'])->id,
            'name'=> fake()->name(),
            'nip' => fake()->unique()->randomNumber(8),
            'kode_dosen' => fake()->unique()->randomNumber(8),
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
