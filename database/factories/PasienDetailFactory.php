<?php

namespace Database\Factories;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PasienDetail>
 */
class PasienDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ids = Pasien::all(['id']);
        return [
            'id_pasien' =>  fake()->randomElement($ids),
            'nama' => fake()->name(),
            'tgl_lahir' => fake()->date(),
        ];
    }
}
