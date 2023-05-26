<?php

namespace App\Http\Controllers;

use App\Models\Anotacao;
use App\Models\Personagem;
use App\Http\Requests\StoreAnotacaoRequest;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\UpdateAnotacaoRequest;

class AnotacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Personagem $personagem)
    {
        // sleep(10);
        $anotacoes = Anotacao::where('personagem_id', $personagem->id)->get();
        return $anotacoes;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anotacao  $anotacao
     * @return \Illuminate\Http\Response
     */
    public function show($personagem, $anotacao)
    {
        // set_time_limit(5);
        // sleep(10);
        return Anotacao::where(['personagem_id' => $personagem, 'id' => $anotacao])->first();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAnotacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($personagem, StoreAnotacaoRequest $request)
    {
        $anotacao = Anotacao::make($request->safe()->all());
        $anotacao->personagem_id = $personagem;
        $anotacao->save();
        return Response::json($anotacao,201);
    }

    /**
     * Update the specified resource in storage.
     *ar
     * @param  \App\Http\Requests\UpdateAnotacaoRequest  $request
     * @param  \App\Models\Anotacao  $anotacao
     * @return \Illuminate\Http\Response
     */
    public function update($personagem, $anotacao, UpdateAnotacaoRequest $request)
    {
        $anotacao = Anotacao::where(['personagem_id' => $personagem, 'id' => $anotacao])->first();
        $anotacao = $anotacao->fill($request->safe()->all());
        $anotacao->save();
        return $anotacao;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anotacao  $anotacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anotacao $anotacao)
    {
        //
    }
}
