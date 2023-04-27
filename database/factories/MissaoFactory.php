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
        $descricao = $this->faker->text(300);
        $tipo = $this->faker->randomElement([Missao::TIPO_DIARIA, Missao::TIPO_SEMANAL, Missao::TIPO_UNICA]);
        $situacao = $this->faker->randomElement([Missao::SITUACAO_ATIVA, Missao::SITUACAO_PAUSADA, Missao::SITUACAO_FALHA]);

        if($tipo == Missao::TIPO_DIARIA) {
            $prazo = (new DateTime())->format('Y-m-d');
        } elseif ($tipo = Missao::TIPO_SEMANAL) {
            $prazo = (new DateTime('tomorrow'))->format('Y-m-d');
        } else {
            $prazo = (new DateTime('tomorrow'))->format('Y-m-d');
        }

        // $datadesde = $this->faker->dateTime();
        // $lembrete = $this->faker->datetime();
        return [
            'titulo' => $titulo,
            'descricao' => $descricao,
            'tipo' => $tipo,
            'prazo' => $prazo,
            'situacao' => $situacao,
            // 'historia_id' => null,
            // 'dificuldade_id' => null,
            // 'personagem_id' => $personagem_id,
        ];
    }
}
