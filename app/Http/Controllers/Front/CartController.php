<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;


use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = Cart::getContent();
        $total = Cart::getTotal();

        return view('front.cart.index', compact('content', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->id);

        Cart::add(
            [
                'id' => $product->id,
                'name' => $product->name,
                'originalPrice' => $product->originalPrice,
                'quantity' => $request->quantity,
               'attributes' => [],
               'associatedModel' => $product,
            ]
        );

        return redirect()->back()->with('cart', 'ok');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::update($id, [
            'quantity' => ['relative' => false, 'value' => $request->quantity],
        ]);

        return redirect(route('panier.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return redirect(route('panier.index'));
    }
}
