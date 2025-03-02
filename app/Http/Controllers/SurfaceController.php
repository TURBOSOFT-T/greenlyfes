<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreSurfaceRequest;
use App\Http\Requests\UpdateSurfaceRequest;
use App\Models\Surface;
use Illuminate\Http\Request;

class SurfaceController extends Controller
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
     * @param  \App\Http\Requests\StoreSurfaceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'surface' => 'required',
            'price' => 'required|numeric',
            'product_id' => 'required'
        ]);

        Surface::create($request->all());

        return back()->with('success', 'Surface ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surface  $surface
     * @return \Illuminate\Http\Response
     */
    public function show(Surface $surface)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surface  $surface
     * @return \Illuminate\Http\Response
     */
    public function edit(Surface $surface)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSurfaceRequest  $request
     * @param  \App\Models\Surface  $surface
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSurfaceRequest $request, Surface $surface)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surface  $surface
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surface $surface)
    {
        //
    }
}
