<?php
namespace App\Http\Controllers\Front;



use App\Http\{
    Controllers\Controller,
};
use App\Models\{Reservation, Room, Config};


use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Session;

use RealRashid\SweetAlert\Facades\Alert;
//use Illuminate\Support\Facade\Mail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationController extends Controller
{
       
  public function reservation($id)
  {
    $configs = Config::firstOrFail();
    $room =Room:: findOrFail($id);


    return view('front.reservations.checkout', compact('configs','room'));

  }


public function getReservationsByMonth(Request $request)
{
    $roomId = $request->room_id;
    $month = $request->month; // Le mois au format "Y-m" (ex : 2025-01)

    $reservations = Reservation::where('room_id', $roomId)
        ->whereBetween('date_debut', [$month . '-01', $month . '-31']) // Limiter aux dates du mois
        ->get();

    // Formater les périodes réservées
    $reservedPeriods = $reservations->map(function ($reservation) {
        return [
            'start' => Carbon::parse($reservation->date_debut)->format('Y-m-d'),
            'end' => Carbon::parse($reservation->date_fin)->format('Y-m-d')
        ];
    });

    return response()->json($reservedPeriods);
}

  
public function checkAvailability(Request $request)
{
    $roomId = $request->room_id;
    $dateDebut = $request->date_debut;
    $dateFin = $request->date_fin;

    $isBooked = Reservation::where('room_id', $roomId)
        ->where(function ($query) use ($dateDebut, $dateFin) {
            $query->whereBetween('date_debut', [$dateDebut, $dateFin])
                  ->orWhereBetween('date_fin', [$dateDebut, $dateFin]);
        })->exists();

    return response()->json(['isBooked' => $isBooked]);
}
  

  public function confirm(Request $request)
  {
    $request->validate([

      'nom' => ['required', 'string', 'max:255'],
      'prenom' => ['required', 'string', 'max:255'],
      'last_name' => ['nullable', 'string', 'max:255'],
      'email' => 'required',    
     //   'phone' => 'required',
        'address' => 'nullable',   
        'note' => 'nullable',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'date_debut' => [
        'required',
        'date',
        'after_or_equal:today',  
    ],
    [
      'email.required' => 'Veuillez entrer votre email',
      'nom.required' => 'Veuillez entrer votre nom',
      'prenom.required' => 'Veuillez entrer votre',
      'telephone.required' => 'Veuillez entrer votre numéro de téléphone',
      'adresse.required' => 'Veuillez entrer votre addresse',
 
    ]
  
    ]); 

    $connecte = Auth::user();
    $configs = config::firstOrFail();
 
if($connecte){
  $reservation = new Reservation([
     'nom' => $request->input('nom'),
     'prenom' => $request->input('prenom'),
     'email' => $request->input('email'),
     'address' => $request->input('adresse'),
     'telephone' => $request->input('telephone'),
     'note' => $request->input('note'),
     'user_id' => Auth::user()->id,
     'room_id' => $request->input('room_id'),
     'date_debut' => $request->input('date_debut'),
     'date_fin' => $request->input('date_fin'),
     'limit' => $request->input('limit'),
     'nb_personnes'=>$request->input('nb_personnes'),
     'order_at' => now(),
  
     'note' => $request->input('note'),
 
   ]);[
     'email.required' => 'Veuillez entrer votre email',
     'nom.required' => 'Veuillez entrer votre nom',
     'telephone.required' => 'Veuillez entrer votre numéro de téléphone',
     'adresse.required' => 'Veuillez entrer votre addresse',

   ];
} else{

  $reservation = new Reservation([


'nom' => $request->input('nom'),
'prenom' => $request->input('prenom'),

  'email' => $request->input('email'),
  'address' => $request->input('address'),
  'telephone' => $request->input('telephone'),
  'room_id' => $request->input('room_id'),
  'date_debut' => $request->input('date_debut'),
  'date_fin' => $request->input('date_fin'),
  'limit' => $request->input('limit'),
  'nb_personnes'=>$request->input('nb_personnes'),


 
  'note' => $request->input('note'),

    


   ]);[
     'email.required' => 'Veuillez entrer votre email',
     'nom.required' => 'Veuillez entrer votre nom',
     'telephone.required' => 'Veuillez entrer votre numéro de téléphone',
     'adresse.required' => 'Veuillez entrer votre addresse',

   ];
}

    $reservation->save();

    $user = new User([
      'first_name' => $request->input('nom'),
       
     // 'first_name' => $request->input('first_name'),
      'last_name' => $request->input('prenom'),
      'email' => $request->input('email'),
      'phone' => $request->input('phone'),
      'password' => Hash::make($request->input('phone')),
     'adress' => $request->input('adress'),
      
    ]);   
      
  $existingUsersWithEmail = User::where('email', $request['email'])->exists();
  if (!$existingUsersWithEmail) {
    $user->save();
}

   



    return redirect()->route('thank-yous');
  
}


 




  

  public function index(Request $request)
  {

    return view('front.reservations.thankyou');
  }

}
