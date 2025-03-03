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


use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Exception\CardException;




class ReservationController extends Controller
{
       
  public function reservation($id)
  {
    $configs = Config::firstOrFail();
    $room =Room:: findOrFail($id);
    return view('front.reservations.checkout', compact('configs','room'));
  }







  public function confirm(Request $request)
  {
    $request->validate([
      'nom' => ['required', 'string', 'max:255'],
      'prenom' => ['required', 'string', 'max:255'],
      'last_name' => ['nullable', 'string', 'max:255'],
      'payment_method' => 'required|string',
    //  'nb_mois' => 'required|integer|min:1',
   

  
  
    ]
    , [
      'nom.required' => 'Le champ nom est obligatoire.',
      'prenom.required' => 'Le champ prénom est obligatoire.',
      'payment_method.required' => 'Veuillez choisir une méthode de paiement.',
  ]
  ); 
//($request->all());

//dd($request->input('stripeToken'));
    $connecte = Auth::user();
    $configs = config::firstOrFail();

    $room = Room::find($request->input('room_id'));

 
if($connecte){
  $reservation = new Reservation([
     'nom' => $request->input('nom'),
     'prenom' => $request->input('prenom'),
     'email' => $request->input('email'),
     'adresse' => $request->input('adresse'),
     'telephone' => $request->input('telephone'),
     'note' => $request->input('note'),
     'user_id' => Auth::user()->id,
     'room_id' => $request->input('room_id'),
     
     'nb_mois'=>$request->input('nb_mois'),
     'order_at' => now(),
  
     'note' => $request->input('note'),
 
  ]);
} else{

  $reservation = new Reservation([
'nom' => $request->input('nom'),
'prenom' => $request->input('prenom'),
  'email' => $request->input('email'),
  'addresse' => $request->input('addresse'),
  'telephone' => $request->input('telephone'),
  'room_id' => $request->input('room_id'),
 
  'nb_mois'=>$request->input('nb_mois'),
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
     'adresse' => $request->input('adresse'),
      
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
     'adresse' => $request->input('adresse'),
    
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


//dd($totalPrice);
$items=   Reservations_item::create([
  'reservation_id' => $reservation->id,


  'room_id' => $request->input('room_id'),
  'nb_mois'=>$request->input('nb_mois'),

   'user_id' => $user->id,
  
 //   'total' => $totalPrice,

 'created_at' => now(),
  


]);

if ($request->payment_method === 'stripe') {


  Stripe::setApiKey(env('STRIPE_SECRET'));

  try {
      $charge = Charge::create([
          "amount" => 1000, // Montant en centimes
          "currency" => "eur",
          "source" => $request->stripeToken,
        ///  "client" =>  $request->input('nom'),
          "description" => "Paiement réservation chambre",

          'metadata' => [
                  //  'order_id' => $->id,
                    'user_id' => $user->id,
                    'montant total' => 1000 ,
                ],
      ]);

  
          // Mise à jour du statut du paiement
          $reservation->update([
            'payment_status' => 'paid',
            'payment_method' =>'stripe',
            'transaction_id' => $charge->id,
        ]);


        

   
   return  redirect()->route('thank-yous');
  } catch (\Exception $e) {
 return response()->json(['success' => false, 'message' => $e->getMessage()]);

  }
}



    return redirect()->route('thank-yous');
  
}


 




  

  public function index(Request $request)
  {

    return view('front.reservations.thankyou');
  }


  public function message(Request $request)
  {

    return view('front.reservations.payement');
  }

}
