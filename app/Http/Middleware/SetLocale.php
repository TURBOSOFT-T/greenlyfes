<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupérer la langue depuis la session ou utiliser la langue par défaut (config locale)
      //  $locale = Session::get('locale', config('app.locale'));
     //  $locale = Session::get('locale', 'fr');
        
        // Définir la langue de l'application
       // App::setLocale($locale);
       if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }

    return $next($request);

      //  return $next($request);
    }
}
