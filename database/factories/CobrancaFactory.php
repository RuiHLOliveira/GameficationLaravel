<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CobrancaFactory extends Factory
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
        $datadesde = $this->faker->dateTime();
        $lembrete = $this->faker->datetime();
        return [
            'titulo' => $titulo,
            'texto' => $texto,
            'datadesde' => $datadesde,
            'lembrete' => $lembrete
        ];
    }
}
