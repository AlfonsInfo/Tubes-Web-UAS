<?php

namespace Database\Factories;

use App\Models\PengambilanMatakuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PengambilanMatakuliahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $this=PengambilanMatakuliah::class;

    public function definition()
    {
        return [
            'id_mahasiswa' => $this->faker->numberBetween(1,3),
            'id_matkul' => $this->faker->numberBetween(1,3),
        ];
    }
}
