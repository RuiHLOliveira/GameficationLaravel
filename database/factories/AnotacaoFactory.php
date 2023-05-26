<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnotacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $texto = $this->faker->text(50);
        $lembrete = $this->faker->dateTimeBetween('now', '+1 week');
        return [
            'texto' => $texto,
            'lembrete' => $lembrete,
        ];
    }
}
