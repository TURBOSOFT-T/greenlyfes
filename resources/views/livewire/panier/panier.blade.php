<div class="table-responsive-sm">
    <table class="table">
        <thead>
            <tr>
                <th class="product-thumbnail">Images</th>
                <th class="cart-product-name">Produit</th>
                <th class="product-price">Surface</th>
             {{--    <th class="product-price">Prix U.</th>
                <th class="product-quantity">Qté</th> --}}
                <th class="product-subtotal">Total</th>
                <th class="product-remove">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($paniers ?? [] as $id => $details)
           
                <tr data-id="{{ $id }}">
                    <td class="product-thumbnail">
                        <a href="#">
                            {{-- <img src="{{ Storage::url($details['image']) }}" alt=""> --}}
                        </a>
                    </td>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-9">
                                <h6 class="nomargin">
                                    <a href="#">
                                         {{ $details['name'] }} 
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price"> {{ $details['surface'] }} m² </td>
                    <td data-th="Price"> {{ $details['price'] }}  </td>
                    {{-- <td data-th="">
                        <div class="tp-shop-details__quantity-box">
                            <div class="tp-shop-details__quantity">
                                <div class="tp-cart-minus" wire:click="update({{$details['id_produit']}},{{ $details['quantite'] - 1 }})">
                                    <i class="fal fa-minus"></i>
                                </div>
                                <input type="text" value="{{ $details['quantite'] }}">
                                <div class="tp-cart-plus" wire:click="update({{$details['product_id']}},{{ $details['quantite'] + 1 }})">
                                    <i class="fal fa-plus"></i>
                                </div>
                            </div>
                        </div> 
                    </td> --}}
                   {{--  <td data-th="Subtotal" class="text-center">
                        {{ $details['price'] * $details['quantite'] }}
                        DT
                    </td> --}}
                    <td class="actions" data-th="">
                        <button class=" remove-from-cart" wire:click="delete({{ $details['product_id'] }})">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="6">
                        <div class="text-center p-3">
                            <img width="64" height="64" src="https://img.icons8.com/pastel-glyph/64/578b07/shopping-cart--v2.png" alt="shopping-cart--v2"/><br>

                            <h6>
                                Aucun produit dans le panier.
                            </h6>
                            <br>
                            <a href="/shop" class="btn btn-success btn-sm">
                            Ajouter des articles
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

    @if ($total > 0)
    <div class="row justify-content-end">
        <div class="col-xl-5 col-lg-5 col-md-7">
            <div class="cart-page-total">
                <h2>Montant total du panier</h2>
                <ul class="mb-20">

                    <li>Total <span>{{ $total }} DT</span></li>
                </ul>



                <a class="tp-btn-theme text-center w-100" href="{{ url('/commander') }}">
                    <span>
                        Commander
                    </span>
                </a>
                <a href="{{ url('shop') }}" class="btn btn-warning">
                    <i class="fa fa-angle-left"></i>
                    Continuer les achats
                </a>

            </div>
        </div>
    </div>
    @endif
    

</div>
