<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'kelas_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
