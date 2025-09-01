@extends('front.fixe')
@section('titre', 'Détails')
@section('body')

    <main>
        @php
            $config = DB::table('configs')->first();

        @endphp

        <head>
        @section('room')
            <meta name="description" content="{{ $room->name ?? ' ' }}">
            <meta name="author" content="greenlyfes.com">
            <meta property="og:title" content="{{ $room->nom }}">
            <meta property="og:description" content="{{ $room->description ?? '' }}">
            <meta property="og:image:width" content="1200">

            <meta property="og:image" content="{{ $room->image }}">
            <meta property="og:type" content="room">
            <meta property="og:price:amount" content="{{ $room->price }} DT">

            <meta property="og:availability" content="{{ $room->statut }}">

            <meta property="product:price:amount" content="{{ $room->price }} DT">

            <meta property="product:availability" content="{{ $room->statut }}">
            <meta name="robots" content="index, follow">


            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>{{ isset($room) && $room->seo_title ? $room->seo_title : config('app.name') }}</title>
            <meta name="description"
                content="{{ isset($room) && $room->meta_description ? $room->meta_description : __(config('app.description')) }}">
            <meta name="author" content="{{ isset($room) ? $room->user->name : __(config('app.author')) }}">
            @if (isset($room) && $room->meta_keywords)
                <meta name="keywords" content="{{ $room->meta_keywords }}">
            @endif


        @endsection

    </head>


    <main>


        <div class="breadcrumb__area breadcrumb__overlay breadcrumb__height p-relative fix"
            data-background="{{ url('public/Image/' . $room->book->cover ?? '') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content z-index text-center">
                            <div class="breadcrumb__section-title-box">
                                <h3 class="breadcrumb__title">{{ $room->name ?? '' }}</h3>
                            </div>
                            <div class="breadcrumb__list">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tp-product-details-area pt-130">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="tp-shop-details__wrapper">
                            <div class="tp-shop-details__tab-content-box mb-20">
                                <div class="tab-content" id="nav-tabContent">

                                    <div id="main-image" class="tp-shop-details__tab-big-img">
                                        <img id="zoom-image" src="{{ url('public/Image/' . $room->image) }}"
                                            data-zoom-image="{{ url('public/Image/' . $room->image) }}"
                                            alt="Main Image" width="700" height="500">
                                    </div>



                                </div>
                            </div>
                            <div class="tp-shop-details__tab-btn-box">

                                <nav>
                                    <div class="nav nav-tab" id="nav-tab" role="tablist">
                                        @if (!empty($room->images) && is_array(json_decode($room->images, true)))
                                            @foreach (json_decode($room->images) as $key => $image)
                                                <button class="nav-links thumbnail-btn"
                                                    data-image="{{ url('public/Image/' . $image) }}" type="button">
                                                    <img src="{{ url('public/Image/' . $image) }}"
                                                        alt="Thumbnail {{ $loop->index + 1 }}" loading="lazy">
                                                </button>
                                            @endforeach
                                        @else
                                            <p>No additional images available.</p>
                                        @endif
                                    </div>
                                </nav>

                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const thumbnailButtons = document.querySelectorAll('.thumbnail-btn');
                            const mainImage = document.querySelector('#main-image img');

                            thumbnailButtons.forEach(button => {
                                button.addEventListener('click', function() {
                                    const newImageSrc = this.getAttribute('data-image');
                                    mainImage.setAttribute('src', newImageSrc);
                                });
                            });
                        });

                        $(document).ready(function() {
                            $('#zoom-image').elevateZoom({
                                zoomType: "lens",
                                lensShape: "round",
                                lensSize: 200
                            });
                        });
                    </script>
                    <div class="col-xl-6 col-lg-6">

                        <div class="tp-shop-details__right-wrap">
                            <div class="tp-shop-details__tab-btn-box">
                                <nav>
                                    <div class="nav nav-tab" id="nav-tab" role="tablist">
                                        @if (!empty($room->images) && is_array(json_decode($room->images, true)))
                                            @foreach (json_decode($room->images) as $key => $image)
                                                <button class="nav-links thumbnail-btn"
                                                    data-image="{{ url('public/Image/' . $image) }}" type="button">
                                                    <img src="{{ url('public/Image/' . $image) }}"
                                                        alt="Thumbnail {{ $loop->index + 1 }}" loading="lazy"
                                                        height="50" width="50">
                                                </button>
                                            @endforeach
                                        @else
                                            <p>No additional images available.</p>
                                        @endif
                                    </div>
                                </nav>
                            </div>
                            <h3 class="tp-section-title">{{ $room->name ?? ' ' }}</h3>





                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Effectif</th>
                                        <th>Prix</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($room->attributes as $attribut)
                                        <tr>
                                            <td
                                                rowspan="{{ 1 + ($attribut->double_price ? 1 : 0) + ($attribut->triple_price ? 1 : 0) }}">
                                                {{ $attribut->surface }}
                                            </td>
                                            <td>Une personne</td>
                                            <td>{{ number_format($attribut->single_price, 0, ',', ' ') }}
                                                <x-devise></x-devise></td>
                                        </tr>

                                        @if ($attribut->double_price)
                                            <tr>
                                                <td>Deux personnes</td>
                                                <td>{{ number_format($attribut->double_price, 0, ',', ' ') }}
                                                    <x-devise></x-devise></td>
                                            </tr>
                                        @endif

                                        @if ($attribut->triple_price)
                                            <tr>
                                                <td>Trois personnes</td>
                                                <td>{{ number_format($attribut->triple_price, 0, ',', ' ') }}
                                                    <x-devise></x-devise></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>






                           
                            <script>
                                $(document).ready(function() {
                                    let selectedSurface = null;
                                    let selectedType = null;

                                    $('.surface-btn').on('click', function() {
                                        selectedSurface = $(this).data();
                                        $('.surface-btn').removeClass('btn-success').addClass('btn-outline-success');
                                        $(this).removeClass('btn-outline-success').addClass('btn-success');
                                        showPrice();
                                    });

                                    $('.type-btn').on('click', function() {
                                        selectedType = $(this).data('type');
                                        $('.type-btn').removeClass('btn-primary').addClass('btn-outline-primary');
                                        $(this).removeClass('btn-outline-primary').addClass('btn-primary');
                                        showPrice();
                                    });

                                    function showPrice() {
                                        if (selectedSurface && selectedType) {
                                            let price = selectedType === 'single' ? selectedSurface.single : selectedSurface.double;
                                            $('#showPrice').text(price);
                                        }
                                    }

                                    $('.reserver-btn').on('click', function(e) {
                                        if (!selectedSurface || !selectedType) {
                                            e.preventDefault();
                                            Swal.fire({
                                                icon: 'warning',
                                                title: 'Oops...',
                                                text: 'Veuillez sélectionner une surface et le type de chambre!',
                                            });
                                        }
                                    });
                                });
                            </script>


                            <div class="tp-shop-details__btn text-center mb-40">
                                <a class="tp-btn-theme"
                                    href="{{ url('reservation', ['id' => $room->id, 'slug' => Str::slug(Str::limit($room->name, 20))]) }}"
                                   ><span>Reserver</span></a>
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
                                                    aria-controls="home-1" aria-selected="true"><span>Description
                                                    </span></button>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="tab-content tp-content-tab" id="myTabContent-2">
                                        <div class="tab-para tab-pane fade show active" id="home-1"
                                            role="tabpanel" aria-labelledby="home-tab-1">
                                            <p class="mb-20" style="text-align: justify"> {!! $room->body !!}
                                            </p>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tp-product-area pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-product-title-box text-center mb-55">
                            <h4 class="tp-section-title">Les autres chambres pour les mêmes categories</h4>
                        </div>
                    </div>
                </div>


                <div class="row">
                    @foreach ($otherRooms as $room)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                            <div class="tp-product-item-2 mb-40">
                                <div class="tp-product-thumb-2 p-relative z-index-1 fix w-img">
                                    <div class="tp-project-3-thumb ">
                                        <a class="tp-project-3-thumb "
                                            href="{{ route('details-room', ['id' => $room->id, 'slug' => Str::slug(Str::limit($room->name, 10))]) }}">
                                            <img src="{{ url('public/Image/' . $room->image) }}" alt="">
                                        </a>
                                    </div>

                                </div>
                                <div class="tp-product-content-2">

                                    <h3 class="tp-product-title-2">
                                        <a
                                            href="{{ route('details-room', ['id' => $room->id, 'slug' => Str::slug(Str::limit($room->name, 10))]) }}">{{ $room->name ?? ' ' }}</a>
                                    </h3>
                                  
                                    <div class="tp-product-button">
                                        <a class="tp-btn-price w-100 text-center"
                                            href="{{ url('reservation', ['id' => $room->id, 'slug' => Str::slug(Str::limit($room->name, 20))]) }}">

                                            <span>Réserver</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
        <!-- product-area-end -->





    </main>
@endsection
