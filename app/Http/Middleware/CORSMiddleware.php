<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CORSMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Intercepts OPTIONS requests


        //Pass the request to the next middleware

        $response = $next($request);

        $response->header('Access-Control-Allow-Origin',"*");
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'PUT, GET, POST, DELETE, OPTIONS, PATCH');
        $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        $response->header('Access-Control-Allow-Credentials', 'true');
        $response->header('Accept', 'application/json');
        $response->header('Access-Control-Expose-Headers', 'location');

        return $response;
    }
}