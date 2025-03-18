<?php

namespace App\Http\Livewire\Panier;

use Livewire\Component;
use App\Models\Product;
use App\Models\Surface;

class Panier extends Component
{

    public $total = 0;

    public function render()
    {
        $cart = session()->get('cart', []);
        $cartWithProducts = [];
        $total = 0;
    
        // Vérification si le panier contient des produits
        foreach ($cart as $key => $item) {
            // Vérifier si 'product_id' existe dans chaque item du panier
            if (isset($item['product_id'])) {
                $product = Product::find($item['product_id']);
                
                if ($product) {
                    // Ajouter les informations du produit au panier
                    $cartWithProducts[$key] = [
                        'product_id' => $item['product_id'],  // Ajout de la clé product_id
                        'surface' => $item['surface'],
                        'price' => $item['price'],
                        'product_name' => $product->name, // Nom du produit
                        'product_image' => asset('public/Image/' . $product->image),
                    ];
                    // Calculer le total
                    $total += $item['price'];
                }
            }
        }


        return view('livewire.panier.panier',  compact('cartWithProducts', 'total'));
    }



    public function update($product_id, $quantite)
    {
        //find produit in session car and update quantity
        $panier = session('cart', []);
        $produit_existe = false;

        foreach ($panier as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantite'] = $quantite;
                $produit_existe = true;
                break;
            }
        }

        if (!$produit_existe) {
            $panier[] = [
                'product_id' => $product_id,
                'quantite' => $quantite,
            ];
        }

        session(['cart' => $panier]);

        $this->total = 0;
    }





    public function delete($product_id)
    {
        //delete produit from cart
        $panier = session('cart', []);
        $produit_existe = false;

        foreach ($panier as $key => &$item) {
            if ($item['product_id'] == $product_id) {
                unset($panier[$key]);
                $produit_existe = true;
                break;
            }
        }

        if (!$produit_existe) {
            $panier[] = [
                'product_id' => $product_id,
                'quantite' => 1,
            ];
        }

        session(['cart' => $panier]);

        $this->total = 0;
    }
}
