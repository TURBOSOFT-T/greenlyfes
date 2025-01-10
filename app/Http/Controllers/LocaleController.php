<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function change(Request $request)
    {
       /*  $locale = $request->input('locale');

        if (in_array($locale, ['fr', 'en', ])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }
 */
$locale = $request->input('locale', 'fr'); // Default to English if locale is not provided

if (in_array($locale, ['en', 'fr'])) {
    session(['locale' => $locale]);
}
        return redirect()->back();
    }
}