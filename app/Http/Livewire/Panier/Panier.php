<?php

namespace App\Http\Livewire\Panier;

use Livewire\Component;
use App\Models\Product;
use App\Models\Surface;
class Panier extends Component
{

    public $total =0;

    public function render()
    {
        $paniers_session = session('cart');
       // $paniers = session('cart');
        $paniers = [];
        //  dd($paniers_session);
        if($paniers_session){
            foreach($paniers_session as $panier){
                $paniers[] = Product::find($panier['product_id']);  
                }
                }
                foreach($paniers as $produit){
                    $surface = Surface::where('product_id', $produit->id)->first();
                    if($surface){
                        $produit->surface = $surface->value;
                    }
                }
                foreach($paniers as $produit){
                    $this->total += $produit->price * $produit->surface;
                }
             //   return view('livewire.panier.panier', compact("paniers"));



       
       // return view('livewire.front.panier', compact("paniers"));
        return view('livewire.panier.panier', compact("paniers"));
    }



    public function update($product_id,$quantite){
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

        $this->total =0 ;
    }





    public function delete($product_id){
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

        $this->total =0 ;
    }


  
}
