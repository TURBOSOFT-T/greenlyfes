<?php

namespace App\Http\Controllers;

use App\Models\Reservations_item;
use App\Http\Requests\StoreReservations_itemRequest;
use App\Http\Requests\UpdateReservations_itemRequest;

class ReservationsItemController extends Controller
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
     * @param  \App\Http\Requests\StoreReservations_itemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservations_itemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservations_item  $reservations_item
     * @return \Illuminate\Http\Response
     */
    public function show(Reservations_item $reservations_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservations_item  $reservations_item
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservations_item $reservations_item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservations_itemRequest  $request
     * @param  \App\Models\Reservations_item  $reservations_item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservations_itemRequest $request, Reservations_item $reservations_item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservations_item  $reservations_item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservations_item $reservations_item)
    {
        //
    }
}
