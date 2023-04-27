<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use App\Http\Requests\StoreRecursoRequest;
use App\Http\Requests\UpdateRecursoRequest;

class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recursos = Recurso::all();
        return $recursos;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function show(Recurso $recurso)
    {
        return Recurso::findOrFail($recurso->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecursoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecursoRequest $request)
    {
        $recurso = Recurso::create($request->safe()->all());
        return $recurso;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecursoRequest  $request
     * @param  \App\Models\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecursoRequest $request, Recurso $recurso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recurso $recurso)
    {
        //
    }
}
