<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class Connexion extends Component
{


    
    public $email, $password;
    public function connexion()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'string|required',
        ],[
            'email.required' => 'Veuillez entrer votre email',
            'email.email' => 'Veuillez entrer un email valide',
            'email.exists' => 'Cet email n\'existe pas',
            'password.string' => 'Veuillez entrer votre mot de passe',
            'password.required' => 'Veuillez entrer votre mot de passe',
        ]);

        
        $user = User::where('email', $this->email)
            ->first();

            if (!$user) {
                session()->flash('error', 'Adresse e-mail ou mot de passe incorrect.');
            
            }
        if ($user && Hash::check($this->password, $user->password)) {
            if ($user->role == "user") {
              
                return redirect()->route('home');
            
            } else {
                Auth::login($user);
               
                return redirect()->route('admin');
            }


        } else {
            session()->flash('error', 'Adresse e-mail ou mot de passe incorrect.');
        }
    }
   


    public function render()
    {
        return view('livewire.auth.connexion');
    }
}
