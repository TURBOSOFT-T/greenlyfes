<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use App\Http\Requests\StoreLogementRequest;
use App\Http\Requests\UpdateLogementRequest;

class LogementController extends Controller
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
     * @param  \App\Http\Requests\StoreLogementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logement  $logement
     * @return \Illuminate\Http\Response
     */
    public function show(Logement $logement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logement  $logement
     * @return \Illuminate\Http\Response
     */
    public function edit(Logement $logement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLogementRequest  $request
     * @param  \App\Models\Logement  $logement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogementRequest $request, Logement $logement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logement  $logement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logement $logement)
    {
        //
    }
}
