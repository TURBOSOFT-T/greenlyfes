<?php

namespace App\Http\Controllers;

use App\Models\Attribut;
use App\Http\Requests\StoreAttributRequest;
use App\Http\Requests\UpdateAttributRequest;

class AttributController extends Controller
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
     * @param  \App\Http\Requests\StoreAttributRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttributRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attribut  $attribut
     * @return \Illuminate\Http\Response
     */
    public function show(Attribut $attribut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribut  $attribut
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribut $attribut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttributRequest  $request
     * @param  \App\Models\Attribut  $attribut
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttributRequest $request, Attribut $attribut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribut  $attribut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribut $attribut)
    {
        //
    }
}
