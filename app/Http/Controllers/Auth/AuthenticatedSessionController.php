<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
    // Validate the incoming request data
    /* $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string',
    ],[
        'email.required' => 'Veuillez entrer votre email',
        'email.email' => 'Veuillez entrer un email valide',
        'email.exists' => 'Cet email n\'existe pas',
        'password.string' => 'Veuillez entrer votre mot de passe',
        'password.required' => 'Veuillez entrer votre mot de passe',
    ]);

    // Attempt to authenticate the user
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        
        if ($user->role == "user") {
            return redirect()->route('home');
        } 
            else {
                Auth::login($user);
            
                return redirect()->route('dashboard');
        }
    }

    
    return redirect("login")->withErrors("message", 'Vérifiez que votre email et mot de passe sont corrects.'); */

    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);
  

    $credentials = $request->only('email', 'password');
    $validator = Validator::make($credentials, [
        'email' => ['required', 'email', 'exists:users,email'],
        'password' => ['required','string'],
    ],[
        'email.required' => 'Veuillez entrer votre email',
        'email.email' => 'Veuillez entrer un email valide',
        'email.exists' => 'Cet email n\'existe pas',
        'password.string' => 'Veuillez entrer votre mot de passe',
        'password.required' => 'Veuillez entrer votre mot de passe',
    ]);
  
    if (Auth::attempt($credentials)) {
        return redirect()->route('home')
                     ->with('success', 'Vous vous êtes connecté avec succès');

    }

    return redirect("login")->withSuccess('Oppes! Veillez entrer les informations valides.');
;

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
