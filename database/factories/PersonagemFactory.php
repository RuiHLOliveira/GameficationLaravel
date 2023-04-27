<?php

namespace Database\Factories;

use App\Models\Personagem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonagemFactory extends Factory
{
    
    protected $model = Personagem::class;
    
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
            'historia' => 'Exemplo de história',
            'objetivos' => 'Exemplo de objetivos',
            'exp' => 0,
            'exptotal' => 0,
            'ouro' => 0,
            'ourototal' => 0,
            'nivel' => 1,
            'prestigio' => null,
        ];
    }
}
