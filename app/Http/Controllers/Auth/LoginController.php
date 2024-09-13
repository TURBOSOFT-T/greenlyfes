<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Front\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
  
   public function create()
   {
       return view('auth.register');
   }

   public function store(RegisterRequest $request)
   {
  /*      $request->validate([
           'last_name' => 'required|string|max:255',
           'first_name' => 'required|string|max:255',
           'email' => 'required|email|unique:users,email',
           'password' => 'required|string|min:8|confirmed',
       ], [
           'last_name.required' => 'Le champ nom de famille est obligatoire.',
           'first_name.required' => 'Le champ prénom est obligatoire.',
           'email.required' => 'Le champ email est obligatoire.',
           'email.email' => 'Veuillez entrer une adresse email valide.',
           'email.unique' => 'Cet email est déjà pris.',
           'password.required' => 'Le champ mot de passe est obligatoire.',
           'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
           'password.confirmed' => 'Les mots de passe ne correspondent pas.',
       ]); */

       $personal_info = new User();

       $personal_info->first_name        = $request->first_name;
       $personal_info->last_name         = $request->last_name;
       $personal_info->email = $request->email;
       $personal_info->password = Hash::make($request->password);
       if ($request->file('image_path')) {
           $picture       = !empty($request->file('image_path')) ? $request->file('image_path')->getClientOriginalName() : '';
           $request->file('image_path')->move(public_path('assets/images/'), $picture);
       }
       $personal_info->image_path        = isset($picture) && !empty($picture) ? $picture : '';
       $personal_info->save();



       event(new Registered($personal_info));


       Auth::login($personal_info);

       return redirect(RouteServiceProvider::HOME);
   }
}
