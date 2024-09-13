<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Shop;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\{Category, Config, Follow, Page, Post, Product, User, Tag};
use App\Http\Requests\Front\SearchRequest;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function produits()
    {
      $categories = Category::has('products')->get();
        $users = User::all();
        $products = Product::latest()->paginate(12);
        $follows = Follow::all();
        $pages = Page::all();

        return view('front.shoppings.index', compact('categories', 'users', 'products', 'follows', 'pages'));
    }


    
    public function details($id){
        $product =Product:: findOrFail($id);
        $configs= Config::all();
        // Récupérer des produits similaires
    $similarProducts = Product::where('category_id', $product->category_id)
    ->where('id', '!=', $id)
    ->take(4)
    ->get();

      //  dd($product);
        return view('front.shoppings.details', compact('product','configs', 'similarProducts'));
    }

    public function products($id)
    {
        $categories = Category::has('products')->get();
        $current_category = Category::with('products')->findOrFail($id);
        $products = $current_category->products()->paginate(16);
      //  $products = $current_category->products;
        return view('front.shoppings.index', compact('current_category', 'categories', 'products'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $request)
    {
        $search = $request->search;
        $categories = Category::has('products')->get();
        $products = Product::where('name', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->paginate(10);
        $title = __('Produits nont trouvé avec la recherche: ') . '<strong>' . $search . '</strong>';
     
        return view('front.shoppings.index', compact('products', 'title','categories'));
    }


    public function detailsPost($id)
    {
        $categories = Category::latest()->paginate(6);
        $users = User::all();
        $product = Product::findOrFail($id);
        $products = Post::latest()->paginate(6);
        $follows = Follow::all();
        $pages = Page::all();

        return view('front.shoppings.product-details', compact('products', 'product','pages', 'users', 'follows', 'categories'));
    }


    /**
     * Display the specified post by slug.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $categories = Category::latest()->paginate(6);
        $users = User::all();
        $products = Product::findOrFail($id);
       // $product = Post::latest()->paginate(6);
        $follows = Follow::all();
        $pages = Page::all();


        return view('front.shoppings.product-details', compact('products', 'pages', 'users', 'follows', 'categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShopRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShopRequest  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}