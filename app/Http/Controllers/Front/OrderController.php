<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Config;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Session;

use RealRashid\SweetAlert\Facades\Alert;
//use Illuminate\Support\Facade\Mail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Stripe\Charge;
use Stripe\Stripe;

use Cart;
class OrderController extends Controller
{


    
 
  public function commander()
  {
    $configs = config::firstOrFail();
   // $paniers_session = session('cart');

   $paniers_session = session('cart', []);

  // Vérifier que $paniers_session est bien un tableau
  if (!is_array($paniers_session)) {
      $paniers_session = [];
  }
    $paniers = [];
    $total = 0;
    if(empty($paniers_session)){
      request()->session()->flash('error','La panier est vide !');
      return back();
  }
  

   $cart = session()->get('cart', []);

        $cartWithProducts = [];
        foreach ($cart as $key => $item) {
            $product = Product::find($item['product_id']); // Récupérer le produit associé
            if ($product) {
                $cartWithProducts[$key] = [
                    'surface' => $item['surface'],
                    'price' => $item['price'],
                    'product_name' => $product->name, // Ajouter le nom du produit
                    // 'product_image' => $product->image, // Ajouter l’image du produit
                    'product_image' => asset('public/Image/' . $product->image),
                    //     src="{{ url('public/Image/' . $produit->image) }}"
                ];
            }
        }

    return view('front.commandes.checkout', compact('configs', 'cartWithProducts'));
  }


  public function confirmOrder(Request $request)
  {
    $request->validate([

      'first_name' => ['nullable', 'string', 'max:255'],
      'name' => ['nullable', 'string', 'max:255'],
      'last_name' => ['nullable', 'string', 'max:255'],
      'email' => 'required',
     'payment_method' => 'required|in:bank_transfer,stripe',
      
     // 'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp',
     
        'phone' => 'required|numeric',
        'address' => 'nullable',
      
        'note' => 'nullable',
     
    // 'frais' => 'required',

    ],[
      'phone.required' => 'Le champ téléphone est obligatoire.',
      'phone.numeric'  => 'Le champ téléphone doit être un numéro valide.',
      'address.required' => 'Le champ adresse est obligatoire.',
     // 'frais.required' => 'Le champ frais de livraison est obligatoire.',
      'email.required' => 'Le champ email est obligatoire.',
      'email.email' => 'Le champ email doit être une adresse email valide.',
  ]); 

   // dd($request->all());

    $connecte = Auth::user();
    $configs = config::firstOrFail();

    $user = new User([
     
      'first_name' => $request->input('first_name'),
      'last_name' => $request->input('last_name'),
      'email' => $request->input('email'),
       
      'phone' => $request->input('phone'),
      'password' => Hash::make($request->input('phone')),
      'address' => $request->input('address'),
    
    ]);
  

    $existingUsersWithEmail = User::where('email', $request['email'])->exists();

    if (!$existingUsersWithEmail) {
     
      $user->save();
  }


 
if($connecte){


  $order = new Order([

  
     'last_name' => $request->input('last_name'),
    // 'name' => $request->input('name'),
     'first_name' => $request->input('first_name'),
     'email' => $request->input('email'),
     'address' => $request->input('adresse'),
     'phone' => $request->input('phone'),
     'note' => $request->input('note'),
     'user_id' => Auth::user()->id,
    // 'product_id' => $request->input('product_id'),
     'order_at' => now(),
   
     'note' => $request->input('note'),
 

  ]);
} else{

  $order = new Order([

  ///  'user_id' => auth()->user()->id,
 // 'user_id' => auth()->user()->id,
// 'name' => $request->input('name'),
  'last_name' => $request->input('last_name'),
  'first_name' => $request->input('first_name'),
  'email' => $request->input('email'),
  'address' => $request->input('address'),
  'phone' => $request->input('phone'),
 // 'product_id' => $request->input('product_id'),

 
  'note' => $request->input('note'),

    


   ]);
}
 /// dd($order);

    $order->save();

    $user = new User([
      'first_name' => $request->input('name'),
       
     // 'first_name' => $request->input('first_name'),
      'last_name' => $request->input('last_name'),
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

$cart = session()->get('cart', []);
$cartWithProducts = [];
$total = 0;

// Vérification si le panier contient des produits
foreach ($cart as $key => $item) {
    // Vérifier si 'product_id' existe dans chaque item du panier
    if (isset($item['product_id'])) {
        $product = Product::find($item['product_id']);
        
        if ($product) {
            // Ajouter les informations du produit au panier
            $cartWithProducts[$key] = [
                'product_id' => $item['product_id'],  // Ajout de la clé product_id
                'surface' => $item['surface'],
                'price' => $item['price'],
                'product_name' => $product->name, // Nom du produit
              ///  'product_image' => asset('public/Image/' . $product->image),
            ];
            // Calculer le total
            $total += $item['price'];
        }
    }
}

  
 ///dd($request->input('stripeToken')); 
if($request->input('stripeToken')){
  $stripeSecret = config("app.STRIPE_SECRET");
  Stripe::setApiKey($stripeSecret);



//dd($stripeSecret);
  try {
      $charge = Charge::create([
          "amount" => 100 * $total,
          "currency" => "eur",
          "source" => $request->stripeToken,
          "description" => "Paiement commande produit",
      ]);

  
          // Mise à jour du statut du paiement
          $order->update([
            'payment_status' => 'paid',
            'payment_method' =>'stripe',
            'transaction_id' => $charge->id,
        ]);

   
  // return response()->json(['success' => true]);
   session()->forget('cart');
   return redirect()->route('thank-you');
  } catch (\Exception $e) {
 return response()->json(['success' => false, 'message' => $e->getMessage()]);

  }
}

    

 session()->forget('cart');

    return redirect()->route('thank-you');
  
}
public function index(Request $request)
{

  return view('front.commandes.thankyou');
}




  


}