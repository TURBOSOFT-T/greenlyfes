<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\HomeComposer;
use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\{ Blade, View, Route };
use Cart;
use Illuminate\Pagination\Paginator;
use Stripe\Stripe;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
 
    

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

      //  Stripe::setApiKey(config('services.stripe.secret'));

        // Désactiver la vérification SSL temporairement
       Stripe::setVerifySslCerts(false);
        
        setlocale(LC_TIME, config('app.locale'));
        Paginator::useTailwind();

        View::composer(['front.layout', 'front.index','front.fixe', 'front.blogs.details'], HomeComposer::class);

        View::composer('back.layout', function ($view) {
            $title = config('titles.' . Route::currentRouteName());
            $view->with(compact('title'));
        });

        Blade::if('request', function ($url) {
            return request()->is($url);
        });
        View::composer(['front.layout', 'detailsproducts.show', 'products.show'], function ($view) {
            $view->with([
                //'cartCount' => Cart::getTotalQuantity(),
               // 'cartTotal' => Cart::getTotal(),
            ]);
        });
    }
}