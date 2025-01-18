<?php
namespace App\Http\Controllers\Back;

use App\DataTables\RoomsDataTable;
use App\Http\{
    Controllers\Controller,
};
use App\Models\{Reservation,Room, Config};
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
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
    public function create($room_id = null)
    {
        $room = $room_id ? Room::findOrFail($room_id) : null;

        $configs = Config::firstOrFail();
      //  $room =Room:: findOrFail($id);
    
    
    
   //  return view('back.reservations.checkout', compact('room'));
return view('front.reservations.checkout', compact('configs','room'));
    }


    public function reservation($id)
    {
      $configs = Config::firstOrFail();
      $room =Room:: findOrFail($id);
  
  
      return view('front.reservations.checkout', compact('configs','room'));
  
    }
  
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('back.reservations.show', compact('reservation'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('back.reservations.edit', compact('reservation'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
