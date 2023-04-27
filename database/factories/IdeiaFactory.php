<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IdeiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $titulo = $this->faker->text(50);
        $texto = $this->faker->text(300);
        return [
            'titulo' => $titulo,
            'texto' => $texto,
        ];
    }
}
