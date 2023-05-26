<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PersonagemResource extends JsonResource /*implements JsonSerializable*/
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
            'nivel' => $this->nivel,
        ];
    }
}
