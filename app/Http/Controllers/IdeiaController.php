<?php

namespace App\Http\Controllers;

use App\Models\Ideia;
use App\Models\Personagem;
use App\Http\Requests\StoreIdeiaRequest;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\UpdateIdeiaRequest;

class IdeiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Personagem $personagem)
    {
        // sleep(10);
        $ideias = Ideia::where('personagem_id', $personagem->id)->get();
        return $ideias;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ideia  $ideia
     * @return \Illuminate\Http\Response
     */
    public function show(Personagem $personagem, Ideia $ideia)
    {
        // set_time_limit(5);
        // sleep(10);
        return Ideia::where(['personagem_id' => $personagem->id, 'id' => $ideia->id])->first();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIdeiaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Personagem $personagem, StoreIdeiaRequest $request)
    {
        $ideia = Ideia::make($request->safe()->all());
        $ideia->texto = $ideia->texto ?? '';
        $ideia->personagem_id = $personagem->id;
        $ideia->save();
        return Response::json($ideia,201);
    }

    /**
     * Update the specified resource in storage.
     *ar
     * @param  \App\Http\Requests\UpdateIdeiaRequest  $request
     * @param  \App\Models\Ideia  $ideia
     * @return \Illuminate\Http\Response
     */
    public function update(Personagem $personagem, Ideia $ideia, UpdateIdeiaRequest $request)
    {
        $ideia = Ideia::where(['personagem_id' => $personagem->id, 'id' => $ideia->id])->first();
        $ideia = $ideia->fill($request->safe()->all());
        $ideia->save();
        return $ideia;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ideia  $ideia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ideia $ideia)
    {
        //
    }
}
