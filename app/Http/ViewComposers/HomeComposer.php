<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\{Category, Room,Page, Follow, Home, Project, Service, Post, Testimonial, Book, Gallery, Gallerie};
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
            'rooms' => Room::select('*')->latest()->paginate(9),
            'galleries' => Gallerie::select('*')->latest()->get(),

            'logements' =>Book::with('rooms')->latest()->paginate(20),
     
            
        ]);
    }
}