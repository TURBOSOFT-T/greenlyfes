<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\{Category, Page, Follow, Home, Project, Service, Post, Testimonial};
use Cart;

class HomeComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'categories' => Category::has('posts')->get(),
            'categorie' => Category::has('products')->get(),
            'pages'      => Page::select('slug', 'title')->get(),
            'follows'    => Follow::all(),
            'homes' => Home::all(),
            'services'=>Service::all(),
            'project'=>Project::all(),
            'posts'=>Post::select('*')->take('8')->get(),
            'testimonials' => Testimonial::where('active', true)->latest()->take(50)->get(),
           // 'cartCount' => Cart::getTotalQuantity(),
          //  'cartTotal' => Cart::getTotal(),
            
        ]);
    }
}