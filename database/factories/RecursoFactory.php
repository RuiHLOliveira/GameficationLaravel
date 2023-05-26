<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RecursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nome = $this->faker->name();
        return [
            'nome' => $nome,
        ];
    }
}
