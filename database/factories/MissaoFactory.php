<?php

namespace Database\Factories;

use App\Models\Missao;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class MissaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $titulo = $this->faker->text(50);
        $historia = $this->faker->text(300);
        $descricao = $this->faker->text(300);
        $dificuldade = $this->faker->randomElement([1,2,3]);
        $tipo = $this->faker->randomElement(Missao::getEnumTipos());
        $situacao = $this->faker->randomElement(Missao::getEnumSituacoes());

        if($tipo == Missao::TIPO_DIARIA) {
            $prazo = (new DateTime())->format('Y-m-d');
        } elseif ($tipo = Missao::TIPO_SEMANAL) {
            $prazo = (new DateTime('tomorrow'))->format('Y-m-d');
        } else {
            $prazo = (new DateTime('tomorrow'))->format('Y-m-d');
        }

        return [
            'titulo' => $titulo,
            'historia' => $historia,
            'descricao' => $descricao,
            'tipo' => $tipo,
            'prazo' => $prazo,
            'situacao' => $situacao,
            'dificuldade' => $dificuldade,
            // 'historia_id' => null,
        ];
    }
}
