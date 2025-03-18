<div class="table-responsive-sm">
    
    <table class="table">
        <thead>
            <tr>
                <th class="product-thumbnail">Images</th>
                <th class="cart-product-name">Produit</th>
                <th class="product-price">Surface</th>

                <th class="product-subtotal">Rrix</th>
                <th class="product-remove">Action</th>
            </tr>
        </thead>
    
        <tbody>
            @forelse ($cartWithProducts as $key => $details)
            @php
              //  $total = $details['total'];
                $total += $details['price'] ;
            @endphp
                <tr data-id="{{ $key }}">
                    <td class="product-thumbnail">
                        <a href="#">
                            <img height="50" width="50" src="{{ $details['product_image'] }}" alt="Product Image">
                        </a>
                    </td>
                    <td data-th="Produit">
                        <a href="#">{{ $details['product_name'] }}</a>
                    </td>
                    <td data-th="Surface">{{ $details['surface'] }}</td>
                    <td data-th="Prix">{{ $details['price'] }} €</td>
                    <td class="actions" data-th="">
                        <button class="remove-from-cart" wire:click="delete({{ $details['product_id'] }})">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="text-center p-3">
                            <img width="64" height="64"
                                src="https://img.icons8.com/pastel-glyph/64/578b07/shopping-cart--v2.png"
                                alt="shopping-cart--v2" /><br>
                            <h6>Aucun produit dans le panier.</h6>
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

                        <li>Total <span>{{ $total }} €</span></li>
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
