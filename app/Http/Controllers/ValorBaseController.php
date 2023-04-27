<?php

namespace App\Http\Controllers;

use App\Models\ValorBase;
use App\Http\Requests\StoreValorBaseRequest;
use App\Http\Requests\UpdateValorBaseRequest;

class ValorBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valoresBase = Valorbase::all();
        if(count($valoresBase) == 0){
            $valorBase = ValorBase::create();
            $valoresBase = Valorbase::all();
        }
        return $valoresBase;
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
     * @param  \App\Http\Requests\StoreValorBaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValorBaseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ValorBase  $valorBase
     * @return \Illuminate\Http\Response
     */
    public function show(ValorBase $valorBase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ValorBase  $valorBase
     * @return \Illuminate\Http\Response
     */
    public function edit(ValorBase $valorBase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateValorBaseRequest  $request
     * @param  \App\Models\ValorBase  $valorBase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateValorBaseRequest $request, ValorBase $valorBase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ValorBase  $valorBase
     * @return \Illuminate\Http\Response
     */
    public function destroy(ValorBase $valorBase)
    {
        //
    }
}
