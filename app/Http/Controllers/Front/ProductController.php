<?php

namespace App\Http\Controllers\Front;

use App\Repositories\PostRepository;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductImage;
use Illuminate\Http\Request;

use Illuminate\Http\Response;


class ProductController extends Controller
{




    
    public function __invoke(Request $request, Product $product)
    {
        if ($product->active || $request->user()->admin) {

            return view('front.products.index', compact('product'));
        }
        return redirect(route('home'));
    }

    
    public function show(string $id): Response
    {
        return response()->view('front.products.index', [
            'product' => Product::findOrFail($id),
        ]);
    }


    public function cart()
    {
        return view('front.cart.index');
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "originalPrice" => $product->originalPrice,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function clearAllCart()
    {
        //\Cart::clear();
        session()->forget('cart');
       // session()->flash('success', 'All Item Cart Clear Successfully !');

        //return redirect()->route('cart.list');
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function proceed()
    {
        $products = Product::all();

        //return view('checkout', compact('products'));
        return view('front.commandes.checkout');
    }

    public function index(Request $request)
    {
        $orderRefId = $request->input('orderRefId'); // Get the orderRefId from the request

      //  return view('thankyou', compact('orderRefId'));
        return view('front.commandes.thankyou',compact('orderRefId'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
