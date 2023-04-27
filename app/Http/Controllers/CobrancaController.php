<?php

namespace App\Http\Controllers;

use App\Models\Cobranca;
use App\Models\Personagem;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StoreCobrancaRequest;
use App\Http\Requests\UpdateCobrancaRequest;

class CobrancaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Personagem $personagem)
    {
        $cobrancas = Cobranca::where(['personagem_id' => $personagem->id])->get();
        return $cobrancas;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cobranca  $cobranca
     * @return \Illuminate\Http\Response
     */
    public function show(Personagem $personagem, Cobranca $cobranca)
    {
        return Cobranca::where(['personagem_id' => $personagem->id, 'id' => $cobranca->id])->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCobrancaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCobrancaRequest $request, Personagem $personagem)
    {
        $cobranca = Cobranca::make($request->safe()->all());
        $cobranca->texto = $cobranca->texto ?? '';
        $cobranca->personagem_id = $personagem->id;
        $cobranca->save();
        return Response::json($cobranca, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCobrancaRequest  $request
     * @param  \App\Models\Cobranca  $cobranca
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCobrancaRequest $request, Personagem $personagem, Cobranca $cobranca)
    {
        $cobranca = Cobranca::where(['personagem_id' => $personagem->id, 'id' => $cobranca->id])->first();
        $cobranca = $cobranca->fill($request->safe()->all());
        $cobranca->save();
        return $cobranca;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cobranca  $cobranca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cobranca $cobranca)
    {
        //
    }
}
