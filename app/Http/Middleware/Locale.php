<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle($request, Closure $next)
{
    if (!session ()->has ('locale')) {
        session (['locale' => $request->getPreferredLanguage (config ('app.locales'))]);
    }
    $locale = session ('locale');
    app ()->setLocale ($locale);
    setlocale (LC_TIME, app()->environment('local') ? $locale : config('locale.languages')[$locale][1]);
    return $next ($request);
}
}
