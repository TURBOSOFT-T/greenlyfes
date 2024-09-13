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

use Cart;
class OrderController extends Controller
{


    
  public function commandes($id)
  {
    $configs = Config::firstOrFail();
    $produit =Product:: findOrFail($id);
   // dd($produit);
  
    return view('front.commandes.checkout', compact('configs','produit'));

  }

  public function confirmOrder(Request $request)
  {
    $request->validate([

      'first_name' => ['nullable', 'string', 'max:255'],
      'name' => ['nullable', 'string', 'max:255'],
      'last_name' => ['nullable', 'string', 'max:255'],
      'email' => 'required',
      
     // 'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp',
     
        'phone' => 'required',
        'address' => 'nullable',
      
        'note' => 'nullable',
     
    // 'frais' => 'required',

    ]); 


    $connecte = Auth::user();
    $configs = config::firstOrFail();


 
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
     'product_id' => $request->input('product_id'),
     'order_at' => now(),
   
     'note' => $request->input('note'),
 

   ]);[
     'email.required' => 'Veuillez entrer votre email',
     'nom.required' => 'Veuillez entrer votre nom',
     'phone.required' => 'Veuillez entrer votre numéro de téléphone',
     'adresse.required' => 'Veuillez entrer votre addresse',

   ];
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
  'product_id' => $request->input('product_id'),

 
  'note' => $request->input('note'),

    


   ]);[
     'email.required' => 'Veuillez entrer votre email',
     'nom.required' => 'Veuillez entrer votre nom',
     'phone.required' => 'Veuillez entrer votre numéro de téléphone',
     'adresse.required' => 'Veuillez entrer votre addresse',

   ];
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
  
  
    
      
  $existingUsersWithEmail = User::where('email', $request['email'])->exists();

  if (!$existingUsersWithEmail) {
   
   

 
    $user->save();
}
//$produit = Product::find($request['product_id']);
   $items = OrderProduct :: create([
    'order_id' => $order->id,
    'product_id' => $request->input('product_id'),

  ]); 
// dd($items);
   



    return redirect()->route('thank-you');
  
}


 




  

  public function index(Request $request)
  {

    return view('front.commandes.thankyou');
  }

}