<?php

namespace Database\Factories;

use App\Models\Spama;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\spama>
 */
class spamaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     */

    // protected Model-> Spama::class;
        protected $this=spama::class;
    public function definition()
    {
        return [
            'nama_kegiatan' => $this->faker->word('5'),
            'penyelenggara' => $this->faker->company(),
            'penyelenggara' => $this->faker->text(5),
            'deskripsi_kegiatan' => $this->faker->text(5),
            'tanggal' => now(),
            // 'date'=> now(),
            'id_mahasiswa' => $this->faker->numberBetween(1,3)
        ];
    }
}
