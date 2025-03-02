@extends('front.fixe')
@section('titre', 'Détails sur le produit')
@section('body')

    <main>
        @php
            $config = DB::table('configs')->first();
            $service = DB::table('services')->get();
        @endphp

        <head>
        @section('product')
            <meta name="description" content="{{ $product->name ?? ' ' }}">
            <meta name="author" content="greenlyfes.com">
            <meta property="og:title" content="{{ $product->nom }}">
            <meta property="og:description" content="{{ $product->description ?? '' }}">
            <meta property="og:description" content="{{ $product->meta_description ?? '' }}">

            <meta property="og:image:width" content="1200">

            <meta property="og:image" content="{{ $product->image }}">
            <meta property="og:type" content="product">
            <meta property="og:price:amount" content="{{ $product->price }} DT">

            <meta property="og:availability" content="{{ $product->statut }}">

            <meta property="product:price:amount" content="{{ $product->price }} DT">

            <meta property="logemment:availability" content="{{ $product->statut }}">
            <meta name="robots" content="index, follow">


            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>{{ isset($product) && $product->seo_title ? $product->seo_title : config('app.name') }}</title>
            <meta name="description"
                content="{{ isset($product) && $product->meta_description ? $product->meta_description : __(config('app.description')) }}">
            @if (isset($product) && $product->meta_keywords)
                <meta name="keywords" content="{{ $product->meta_keywords }}">
            @endif


        @endsection

    </head>




    <main>

        <!-- breadcrumb area start -->
        <div class="breadcrumb__area breadcrumb__overlay breadcrumb__height p-relative fix"
            data-background="{{ url('public/Image/parametres/' . $config->imageindustrielle) }}">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content z-index text-center">
                            <div class="breadcrumb__section-title-box">
                                <h3 class="breadcrumb__title">Les détails </h3>
                            </div>
                            <div class="breadcrumb__list">
                                <span><a href="/">Home</a></span>

                                <span class="dvdr"><i>/</i></span>
                                <span><b>Détails</b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!--product-details-area-start -->
        <div class="tp-product-details-area pt-130">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="tp-shop-details__wrapper">
                            <div class="tp-shop-details__tab-content-box mb-20">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                                        aria-labelledby="nav-one-tab">
                                        <div class="tp-shop-details__tab-big-img">
                                            <img src="{{ url('public/Image/' . $product->image) }}" alt=""
                                                width="700 " height="500 ">
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                              <div class="tp-shop-details__tab-big-img">
                                 <img src="assets/img/product/pro-1-2.jpg" alt="">
                              </div>
                           </div>
                           <div class="tab-pane fade" id="nav-three" role="tabpanel" aria-labelledby="nav-three-tab">
                              <div class="tp-shop-details__tab-big-img">
                                 <img src="assets/img/product/pro-1-3.jpg" alt="">
                              </div>
                           </div>
                           <div class="tab-pane fade" id="nav-four" role="tabpanel" aria-labelledby="nav-four-tab">
                              <div class="tp-shop-details__tab-big-img">
                                 <img src="assets/img/product/pro-1-1.jpg" alt="">
                              </div>
                           </div> --}}
                                </div>
                            </div>
                            <div class="tp-shop-details__tab-btn-box">
                                {{--   <nav>
                           <div class="nav nav-tab" id="nav-tab" role="tablist">
                              <button class="nav-links active" id="nav-one-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-one" type="button" role="tab" aria-controls="nav-one"
                                 aria-selected="true">
                                 <img src="assets/img/product/pro-sm-1-1.jpg" alt="">
                              </button>
                              <button class="nav-links" id="nav-two-tab" data-bs-toggle="tab" data-bs-target="#nav-two"
                                 type="button" role="tab" aria-controls="nav-two" aria-selected="false">
                                 <img src="assets/img/product/pro-sm-1-2.jpg" alt="">
                              </button>
                              <button class="nav-links" id="nav-three-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-three" type="button" role="tab" aria-controls="nav-three"
                                 aria-selected="false">
                                 <img src="assets/img/product/pro-sm-1-3.jpg" alt="">
                              </button>
                              <button class="nav-links" id="nav-four-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-four" type="button" role="tab" aria-controls="nav-four"
                                 aria-selected="false">
                                 <img src="assets/img/product/pro-1-1.jpg" alt="">
                              </button>
                           </div>
                        </nav> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="tp-shop-details__right-wrap">
                            <h3 class="tp-section-title">{{ $product->name }}</h3>
                            <div class="tp-shop-details__price pb-10">
                                {{--   {{ $product->price }}   <x-devise></x-devise> --}}

                            </div>
                            <div class="tp-shop-details__ratting mb-20">

                            </div>
                            <div class="tp-shop-details__color d-flex align-items-center mb-20">

                            </div>
                            <div>
                                <h3>{{ $product->short_description ?? ' ' }} </h3>

                            </div>
                           {{--  <br>
                            <div class="tp-shop-details__text-2 mb-25">
                                <p>{!! Str::limit($product->description, 50) !!} </p>
                            </div> --}}
                            <div class="tp-shop-details__product-info mb-35">
{{-- 
                                <ul>
                                    <li>Categorie:<span> {{ $product->categories->title ?? ' ' }}</span></li>
                                </ul> --}}
                            </div>

                          
                            <h4>Choisir la Surface :</h4>
                            <div class="mb-3">
                                @foreach ($product->surfaces as $surface)
                                    <button class="btn btn-outline-success surface-btn"
                                        data-price="{{ $surface->price }}" data-surface="{{ $surface->surface }}">
                                        {{ $surface->surface }}
                                    </button>
                                @endforeach
                            </div>

                            <h4>Prix : <span id="showPrice">Séllectionnez une surface</span> <x-devise></x-devise></h4>

                            <script>
                                $(document).ready(function() {
                                    $('.surface-btn').on('click', function() {
                                        let price = $(this).data('price');
                                        let surface = $(this).data('surface');

                                        $('#showPrice').text(price);

                                        // Enlève la classe active sur tous les boutons
                                        $('.surface-btn').removeClass('btn-success').addClass('btn-outline-success');

                                        // Ajoute la classe active seulement sur le bouton cliqué
                                        $(this).removeClass('btn-outline-success').addClass('btn-success');
                                    });
                                });
                            </script>


                            <div class="tp-shop-details__quantity-wrap  mb-30 d-flex align-items-center">


                            </div>
                      
                                {{-- <a class="tp-btn-theme"
                                onclick="AddToCart( {{ $product->id }} )" ><span>Ajouter au panier</span></a> --}}
                           
                                 <button type="button" class="tp-btn-theme" id="addToCartBtn">
                                 <i class="fa fa-shopping-cart"></i> Ajouter au panier
                             </button>

                           
                              </div>
                            <div class="tp-shop-details__social">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="productdetails-tabs mt-50">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-12">
                                <div class="product-additional-tab">
                                    <div class="pro-details-nav theme-bg-2 mb-40">
                                        <ul class="nav nav-tabs pro-details-nav-btn justify-content-center"
                                            id="myTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-links active" id="home-tab-1" data-bs-toggle="tab"
                                                    data-bs-target="#home-1" type="button" role="tab"
                                                    aria-controls="home-1" aria-selected="true"><span>
                                                        Détails du produit</span></button>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                    <div class="tab-content tp-content-tab" id="myTabContent-2">
                                        <div class="tab-para tab-pane fade show active" id="home-1"
                                            role="tabpanel" aria-labelledby="home-tab-1">
                                            <p class="mb-20 text-center">{!! $product->description !!} </p>

                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- product-details-area-end -->
        
        <script>
         $(document).ready(function() {
    showCart(); // 🛒 Affichage automatique
});

        </script>
<script>
$(document).ready(function () {
    let selectedSurface = null; // Stocke la surface sélectionnée

    console.log("Script chargé !"); // Étape 1

    // Étape 2 : Sélection de surface
    $('.surface-btn').on('click', function () {
        selectedSurface = $(this).data('surface'); 
        let price = $(this).data('price');
        selectedPrice = $(this).data('price');
        console.log("Surface sélectionnée :", selectedSurface);
       
        console.log("Prix :", selectedPrice);

        $('#showPrice').text(price);
        $('#showPrice').text(selectedPrice);

        $('.surface-btn').removeClass('btn-success').addClass('btn-outline-success');
        $(this).removeClass('btn-outline-success').addClass('btn-success');
    });

    // Étape 3 : Ajout au panier
    $('#addToCartBtn').on('click', function () {
        console.log("Bouton Ajouter au Panier cliqué !");

        if (!selectedSurface) {
            console.log("Aucune surface sélectionnée !");
            Swal.fire({
                icon: 'warning',
                title: 'Veuillez sélectionner une surface !',
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        $.ajax({
            url: "{{ route('cart.add') }}", // Route backend
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: "{{ $product->id }}",
                surface: selectedSurface,
                price: selectedPrice,
               
            },
            beforeSend: function () {
                console.log("Envoi des données AJAX...");
            },
            success: function (response) {
                console.log("Produit ajouté avec succès !");
                console.log(response);

                
                $('#cartCount').text(response.cart_count);
                showCart(); 
                Swal.fire({
                    icon: 'success',
                    title: 'Produit ajouté au panier avec succès !',
                    timer: 2000,
                    showConfirmButton: false
                });
            },
            error: function (xhr) {
                console.log("Erreur AJAX :", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur lors de l\'ajout au panier',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });
});

</script>


<script>
   function refreshCart() {
       $.ajax({
           url: "{{ route('cart.get') }}",
           type: "GET",
           success: function(response) {
               console.log("Contenu du Panier:", response);

               let cartHTML = '';
               if (Object.keys(response).length > 0) {
                   $.each(response, function(key, item) {
                       cartHTML += `
                           <div class="cart-item">
                              <div class="cartmini__widget">
                            <div class="cartmini__widget-item">

                     <li>${item.surface} - Prix: ${item.price} <x-devise></x-devise>
            <button onclick="removeItem('${item.surface}')" class="btn btn-danger btn-sm ml-3">
                <i class="fa fa-trash"></i>
            </button>
        </li>

            </div>
                 </div>
                           </div>
                       `;
                   });
               } else {
                   cartHTML = "<p>Votre panier est vide</p>";
               }

               $('#cartContent').html(cartHTML);
           }
       });
   }

   $(document).ready(function() {
       refreshCart(); // Appel automatique au chargement

       $('#addToCartBtn').on('click', function() {
           setTimeout(function() {
               refreshCart(); // Mise à jour automatique après ajout
           }, 500);
       });
   });
</script>

<script>

function showCart() {
    $.ajax({
        url: "{{ route('cart.show') }}",
        type: "GET",
        success: function(response) {
            console.log("Panier:", response.cart);
            console.log("Total:", response.total);

            $('#cartItems').empty();
            $.each(response.cart, function(key, item) {
                $('#cartItems').append(`

                
                 <div class="cartmini__widget">
                            <div class="cartmini__widget-item">

                     <li>${item.surface} - Prix: ${item.price} <x-devise></x-devise>
            <button onclick="removeItem('${item.surface}')" class="btn btn-danger btn-sm ml-3">
                <i class="fa fa-trash"></i>
            </button>
        </li>

            </div>
                 </div>

                `);
            });

            $('#cartTotal').text(response.total);
           
        }
    });
}

</script>

<script>

   function removeItem(surface) {
    $.ajax({
        url: "{{ route('cart.remove') }}",
        type: "POST",
        data: {
            surface: surface,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            console.log("Produit supprimé:", surface);
            $('#cartCount').text(response.cart_count);
          
            refreshCart()
            showCart(); 
          
            Swal.fire({
                title: 'Supprimé!',
                text: 'Produit retiré du panier',
                icon: 'success',
                timer: 3000
            });
           
        }
    });
}

</script>


    </main>
@endsection
