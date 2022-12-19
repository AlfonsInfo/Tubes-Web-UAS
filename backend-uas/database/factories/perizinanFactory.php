<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\perizinan>
 */
class perizinanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $this=perizinan::class;

    public function definition()
    {
        return [
            'pesan' => $this->faker->text(50),
            'tanggal_izin' => now(),
            'tanggal_selesai' => now(),
            'tipe' => 'sakit',
            'id_user' =>$this->faker->numberBetween(1,3),
            'status_perizinan' =>$this->faker->numberBetween(0,1),
        ];
    }
}
