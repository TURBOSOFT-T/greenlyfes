<?php
namespace App\Http\Controllers\Front;



use App\Http\{
    Controllers\Controller,
};
use App\Models\{Reservation, Room, Reservations_item,Config};


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


public function getReservationsByMonth(Request $request,$id)
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
    // Validate input
    $validated = $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'date_debut' => 'required|date|before:date_fin',
        'date_fin' => 'required|date|after:date_debut',
        'limit' => 'required|date|before:date_debut', // Ensure limit is before date_debut
    ]);

    $roomId = $validated['room_id'];
    $dateDebut = Carbon::parse($validated['date_debut']);
    $dateFin = Carbon::parse($validated['date_fin']);
    $limit = Carbon::parse($validated['limit']);

    // Check for overlapping reservations
    $isBooked = Reservation::where('room_id', $roomId)
        ->where(function ($query) use ($dateDebut, $dateFin) {
            $query->whereBetween('date_debut', [$dateDebut, $dateFin])
                  ->orWhereBetween('date_fin', [$dateDebut, $dateFin])
                  ->orWhere(function ($query) use ($dateDebut, $dateFin) {
                      $query->where('date_debut', '<=', $dateDebut)
                            ->where('date_fin', '>=', $dateFin);
                  });
        })->exists();

    return response()->json(['isBooked' => $isBooked]);
}


public function calculateTotalPrice(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'date_debut' => 'required|date|before:date_fin',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        // Récupérer la chambre et ses informations
        $room = Room::find($request->room_id);

        // Récupérer les dates de début et de fin
        $date_debut = Carbon::parse($request->date_debut);
        $date_fin = Carbon::parse($request->date_fin);

        // Calculer le nombre de nuits
        $numberOfNights = $date_debut->diffInDays($date_fin);

        // Calculer le prix total (prix par nuit * nombre de nuits)
        $totalPrice = $room->price * $numberOfNights;

        // Retourner la réponse en JSON avec le prix total
        return response()->json([
            'totalPrice' => number_format($totalPrice, 2),
            'numberOfNights' => $numberOfNights,
            'roomName' => $room->name,
        ]);
    }


    public function checkOccupiedPeriods(Request $request)
{
    $occupiedPeriods = Reservation::select('date_debut', 'date_fin')->get();

    return response()->json($occupiedPeriods);
}

public function getOccupiedPeriods($roomId)
{
    // Logique pour récupérer les périodes occupées pour cette chambre
    $periods = Reservation::where('room_id', $roomId)->get();

    return response()->json($periods);
}



  public function confirm(Request $request)
  {
    $request->validate([
      'nom' => ['required', 'string', 'max:255'],
      'prenom' => ['required', 'string', 'max:255'],
      'last_name' => ['nullable', 'string', 'max:255'],
      'email' => 'required',    
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

    $room = Room::find($request->input('room_id'));

 
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
 
  ]);
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
  ]);
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
      

if (!$connecte) {
  $existingUser = User::where('email', $request->input('email'))->first();
  if (!$existingUser) {
      $user = User::create([
      'first_name' => $request->input('nom'),
      'last_name' => $request->input('prenom'),
      'email' => $request->input('email'),
      'phone' => $request->input('telephone'),
      'password' => Hash::make($request->input('telephone')),
     'adress' => $request->input('adress'),
    
      ]);
  } else {
      // Utilisateur existant
      $user = $existingUser;
  }
} else {
  // Utilisateur connecté
  $user = $connecte;
}

$room = Room::find($request->input('room_id'));

    // Calcul de la durée du séjour
    $date_debut = Carbon::parse($request->input('date_debut'));
    $date_fin = Carbon::parse($request->input('date_fin'));
    $duration = $date_debut->diffInDays($date_fin);
    
    // Calcul du prix total (prix par nuit * durée)
    $totalPrice = $room->getPrice() * $duration;
    
//dd($totalPrice);
$items=   Reservations_item::create([
  'reservation_id' => $reservation->id,


  'room_id' => $request->input('room_id'),
  'nb_personnes'=>$request->input('nb_personnes'),

   'user_id' => $user->id,
    'prix' => $room->getPrice(),
    'prix_unitaire' => $room->getPrice(),
    'total' => $totalPrice,

 'created_at' => now(),
  


]);


   



    return redirect()->route('thank-yous');
  
}


 




  

  public function index(Request $request)
  {

    return view('front.reservations.thankyou');
  }

}
