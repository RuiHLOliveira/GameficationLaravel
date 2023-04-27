<?php

namespace App\Http\Controllers;

use App\Models\Dificuldade;
use App\Http\Requests\StoreDificuldadeRequest;
use App\Http\Requests\UpdateDificuldadeRequest;

class DificuldadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDificuldadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDificuldadeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dificuldade  $dificuldade
     * @return \Illuminate\Http\Response
     */
    public function show(Dificuldade $dificuldade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dificuldade  $dificuldade
     * @return \Illuminate\Http\Response
     */
    public function edit(Dificuldade $dificuldade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDificuldadeRequest  $request
     * @param  \App\Models\Dificuldade  $dificuldade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDificuldadeRequest $request, Dificuldade $dificuldade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dificuldade  $dificuldade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dificuldade $dificuldade)
    {
        //
    }
}
