<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class panier_client extends Controller
{
    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        $surface = $request->surface;
        $price = $request->price;




        $cart = session()->get('cart', []);

        $key = $product_id . '-' . $surface;

        if (!isset($cart[$key])) {
            $cart[$key] = [
                'product_id' => $product_id,
                'surface' => $surface,
                'price' => $price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart_count' => count($cart),
            'cart' => $cart
        ]);
    }
    public function removeCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['surface'] == $request->surface) {
                unset($cart[$key]);
            }
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function getCart()
    {
        $cart = session()->get('cart', []);

        $cartWithProducts = [];
        foreach ($cart as $key => $item) {
            $product = Product::find($item['product_id']); // Récupérer le produit associé
            if ($product) {
                $cartWithProducts[$key] = [
                    'surface' => $item['surface'],
                    'price' => $item['price'],
                    'product_name' => $product->name, // Ajouter le nom du produit
                    // 'product_image' => $product->image, // Ajouter l’image du produit
                    'product_image' => asset('public/Image/' . $product->image),
                    //     src="{{ url('public/Image/' . $produit->image) }}"
                ];
            }
        }

        return response()->json($cartWithProducts);
    }



    public function showCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $surface = \App\Models\Surface::where('surface', $item['surface'])->first();
            if ($surface) {
                $total += $surface->price;
            }
        }

        return response()->json([
            'cart' => $cart,
            'total' => $total
        ]);
    }



    public function count_panier()
    {
        // Vérifier si la session 'panier' existe, sinon initialiser une session vide
        if (!session()->has('cart')) {
            session(['cart' => []]);
        }

        // Récupérer le panier de la session
        $panier_temporaire = session('cart');
        $total = count($panier_temporaire);
        $list = [];
        $montant_total = 0;

        foreach ($panier_temporaire as $data) {
            $produit = Product::select('id', 'image', 'prix', 'nom')->find($data['id_produit']);
            if ($produit) {
                $list[] = [
                    '
                     <div class="cartmini__widget">
                            <div class="cartmini__widget-item">
                                <div class="cartmini__thumb">
                                    <a href="/details-produits/' . $produit->id . '">
                                        <img src="' . Storage::url($produit->photo) . '" alt="">
                                    </a>
                                </div>
                                <div class="cartmini__content">
                                    <h5 class="cartmini__title">
                                    <a href="/details-produits/' . $produit->id . '">' . Str::limit($produit->nom, 15) . '</a>
                                    </h5> 
                                    <div class="cartmini__price-wrapper">

                                        <span class="price text-success">
                                            <b>' . $produit->getPrice() . ' DT</b>
                                        </span> 
                                        <span  class="count"> x ' . $data['quantite'] . '</span>

                                    </div>
                                </div>
                                <a href="#" class="cartmini__del" onclick="DeleteToCart(' . $produit->id . ')">
                                <i class="fa-regular fa-xmark"></i>
                                </a>
                            </div>
                        </div>
                    '
                ];
                $montant_total += $data["quantite"] * intval($produit->getPrice());
            }
        }

        return response()->json(
            [
                "total" => $total,
                "list" => $list,
                "montant_total" => $montant_total
            ]
        );
    }










    public function contenu_mon_panier()
    {
        return view('front.cart');
    }








    public function cart()
    {

        $cart = session()->get('cart', []);

        $cartWithProducts = [];
        foreach ($cart as $key => $item) {
            $product = Product::find($item['product_id']); // Récupérer le produit associé
            if ($product) {
                $cartWithProducts[$key] = [
                    'surface' => $item['surface'],
                    'price' => $item['price'],
                    'product_name' => $product->name, // Ajouter le nom du produit
                    // 'product_image' => $product->image, // Ajouter l’image du produit
                    'product_image' => asset('public/Image/' . $product->image),
                    //     src="{{ url('public/Image/' . $produit->image) }}"
                ];
            }
        }
        return view('front.cart.cart ', compact('cartWithProducts'));
    }



    public function add(Request $request)
    {
        $id_produit = $request->input('id_produit');
        //   $type = $request->input('type', 'produit');
        $quantite = $request->input('quantite', 1);

        $user = Auth::user();


        $produit = produits::where('id', $id_produit)
            ->first();


        //verifier que le produit existe et est disponible
        if (!$produit) {
            return response()->json([
                'statut' => false,
                'message' => "Produit introuvable !",
            ]);
        }









        $panier = session('cart', []);
        $produit_existe = false;

        foreach ($panier as &$item) {
            if ($item['id_produit'] == $id_produit) {
                $item['quantite'] += $quantite;
                $produit_existe = true;
                break;
            }
        }

        if (!$produit_existe) {
            $panier[] = [
                'id_produit' => $id_produit,
                'quantite' => $quantite,
            ];
        }

        session(['cart' => $panier]);

        return response()->json([
            'statut' => true,
            'message' => "Produit ajouté"
        ]);
    }











    public function delete_produit(Request $request)
    {
        //delete d'un produit du panier session panier 
        $id_produit = $request->input('id_produit');
        $panier = session('cart', []);
        foreach ($panier as $key => $item) {
            if ($item['id_produit'] == $id_produit) {
                unset($panier[$key]);
                break;
            }
        }
        session(['cart' => $panier]);
        return response()->json([
            "statut" => true,
            "message" => "produit supprimé",
        ]);
    }
}
