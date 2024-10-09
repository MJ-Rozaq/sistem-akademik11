<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(['role' => 'mahasiswa'])->id,
            'name' => fake()->name(),
            'nim' => fake()->unique()->randomNumber(8),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'kelas_id' => Kelas::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
