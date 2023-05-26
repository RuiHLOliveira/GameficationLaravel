<?php

namespace App\Http\Controllers;

use App\Models\Personagem;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\PersonagemResource;
use App\Http\Requests\StorePersonagemRequest;
use App\Http\Requests\UpdatePersonagemRequest;

class PersonagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personagens = Personagem::all();
        return $personagens;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personagem  $personagem
     * @return \Illuminate\Http\Response
     */
    public function show($personagem)
    {
        return Personagem::findOrFail($personagem);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePersonagemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonagemRequest $request)
    {
        $personagem = Personagem::create($request->safe()->all());
        return $personagem;
        // $personagem = $personagem->find($personagem->id);
        // $personagem = new PersonagemResource($personagem);
        // return Response::json($personagem,201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePersonagemRequest  $request
     * @param  \App\Models\Personagem  $personagem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonagemRequest $request, $personagem)
    {
        $personagem = Personagem::findOrFail($personagem);
        $personagem->fill($request->safe()->all());
        $personagem->save();

        // $personagem = $personagem->find($personagem->id);
        $personagem = new PersonagemResource($personagem);
        
        return Response::json($personagem,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personagem  $personagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personagem $personagem)
    {
        //
    }
}
