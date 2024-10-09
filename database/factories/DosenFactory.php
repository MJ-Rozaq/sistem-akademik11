<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory()->create(['role' => 'dosen'])->id,
            'kelas_id' => null,
            'name'=> fake()->name(),
            'nip' => fake()->unique()->randomNumber(8),
            'kode_dosen' => fake()->unique()->randomNumber(8),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
