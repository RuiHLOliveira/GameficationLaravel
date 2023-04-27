<?php

namespace App\Http\Controllers;

use App\Models\Missao;
use App\Models\Personagem;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StoreMissaoRequest;
use App\Http\Requests\UpdateMissaoRequest;
use DateTime;

class MissaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Personagem $personagem)
    {
        $missoes = Missao::where('personagem_id', $personagem->id)->get();
        return $missoes;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Missao  $missao
     * @return \Illuminate\Http\Response
     */
    public function show(Personagem $personagem, Missao $missao)
    {
        return Missao::where(['personagem_id' => $personagem->id, 'id' => $missao->id])->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMissaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Personagem $personagem, StoreMissaoRequest $request)
    {
        $missao = Missao::make($request->safe()->all());
        $missao->descricao = $missao->descricao ?? '';
        $missao->prazo = (new DateTime())->format('Y-m-d');
        $missao->situacao = Missao::SITUACAO_ATIVA;
        $missao->personagem_id = $personagem->id;
        $missao->save();
        return Response::json($missao, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMissaoRequest  $request
     * @param  \App\Models\Missao  $missao
     * @return \Illuminate\Http\Response
     */
    public function update(Personagem $personagem, Missao $missao, UpdateMissaoRequest $request)
    {
        $missao = Missao::where(['personagem_id' => $personagem->id, 'id' => $missao->id])->first();
        $missao = $missao->fill($request->safe()->all());
        $missao->save();
        return $missao;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Missao  $missao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Missao $missao)
    {
        //
    }
}
