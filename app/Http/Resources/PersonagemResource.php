<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonagemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'nome' => $this->nome,
            'historia' => $this->historia,
            'objetivos' => $this->objetivos,
            'exp' => $this->exp,
            'exptotal' => $this->exptotal,
            'ouro' => $this->ouro,
            'ourototal' => $this->ourototal,
            'nivel' => $this->nivel,
            'prestigio' => $this->prestigio,
        ];
    }
}
