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
        <meta property="og:image:width" content="1200" >
      
        <meta property="og:image" content="{{ $room->image }}">
        <meta property="og:type" content="room">
        <meta property="og:price:amount" content="{{ $room->price }} DT">

        <meta property="og:availability" content="{{ $room->statut }}">

        <meta property="product:price:amount" content="{{ $room->price }} DT">

        <meta property="product:availability" content="{{ $room->statut }}">
        <meta name="robots" content="index, follow">


        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($room) && $room->seo_title ? $room->seo_title :  config('app.name') }}</title>
        <meta name="description" content="{{ isset($room) && $room->meta_description ? $room->meta_description : __(config('app.description')) }}">
        <meta name="author" content="{{ isset($room) ? $room->user->name : __(config('app.author')) }}">
        @if(isset($room) && $room->meta_keywords)
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
                                    {{-- <span><a href="index.html">Home</a></span>
                        <span class="dvdr"><i>/</i></span>
                        <span class="dvdr">Pages</span>
                        <span class="dvdr"><i>/</i></span>
                        <span><b>Products Details</b></span> --}}
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
                                                data-zoom-image="{{ url('public/Image/' . $room->image) }}" alt="Main Image"
                                                width="700" height="500">
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
                                <h3 class="tp-section-title">{{ $room->name ?? ' ' }}</h3>
                                <div class="tp-shop-details__price pb-10">

                                    <ul>
                                        <span>Responsable:</span> <span> {{ $room->user->name ?? ' ' }}</span>
                                    </ul>
                                </div>
                                {{--    <div class="tp-shop-details__ratting mb-20">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span class="review-text">(5)</span>
                            </div> --}}

                            <div class="tp-project-3-content">
                                <span class="tp-product-price-2 new-price">{{ $room->price ?? '' }} <x-devise></x-devise></span>
                            </div>
                                <div class="tp-shop-details__color d-flex align-items-center mb-20">

                                </div>
                                <div class="tp-shop-details__text-2 mb-25">
                                    <p style="text-align:justify">
                                        {!! $room->meta_description ?? ' ' !!}

                                    </p>
                                </div>
                                <div class="tp-shop-details__product-info mb-35">
                                    {{-- <span class="mb-15 d-block">Last 24 Stock Ready To Buy</span> --}}
                                    <ul>
                                        <li>Appartement:<span> {{ $room->book->name ?? '' }}</span> </li>
                                    </ul>
                                </div>
                                <div class="tp-shop-details__quantity-wrap  mb-30 d-flex align-items-center">

                                </div>
                                <div class="tp-shop-details__btn text-center mb-40">
                                    <a class="tp-btn-theme"
                                        href="{{ url('reservation', ['id' => $room->id, 'slug' => Str::slug(Str::limit($room->name, 20))]) }}"
                                        {{--   href="{{ url('reservation', $room->id) }}" --}}><span>Reserver</span></a>
                                </div>



                                {{-- <div class="tp-shop-details__social">
                        <span>Partagez:</span>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-vimeo-v"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                     </div>  --}}
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
                                                {{--  <li class="nav-item" role="presentation">
                                                <button class="nav-links" id="information-tab" data-bs-toggle="tab" data-bs-target="#additional-information" type="button" role="tab" aria-controls="additional-information" aria-selected="false"><span>Contacts</span></button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-links" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false"><span>Commentaires</span></button>
                                            </li> --}}
                                            </ul>
                                        </div>
                                        <div class="tab-content tp-content-tab" id="myTabContent-2">
                                            <div class="tab-para tab-pane fade show active" id="home-1" role="tabpanel"
                                                aria-labelledby="home-tab-1">
                                                <p class="mb-20" style="text-align: justify"> {!! $room->body !!}
                                                </p>

                                            </div>
                                            <div class="tab-pane fade" id="additional-information" role="tabpanel"
                                                aria-labelledby="information-tab">
                                                <div class="product__details-info table-responsive mb-50">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td class="add-info">Weight</td>
                                                                <td class="add-info-list"> 2 lbs</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="add-info">Dimensions</td>
                                                                <td class="add-info-list"> 12 × 16 × 19 in</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="add-info">Product</td>
                                                                <td class="add-info-list"> Purchase this product on
                                                                    rag-bone.com</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="add-info">Color</td>
                                                                <td class="add-info-list"> Gray, Black</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="add-info">Size</td>
                                                                <td class="add-info-list"> S, M, L, XL</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="add-info">Model</td>
                                                                <td class="add-info-list"> Model </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="add-info">Shipping</td>
                                                                <td class="add-info-list"> Standard shipping: $5,95L</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="add-info">Care Info</td>
                                                                <td class="add-info-list"> Machine Wash up to 40ºC/86ºF
                                                                    Gentle Cycle</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="add-info">Brand</td>
                                                                <td class="add-info-list"> Kazen</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="reviews" role="tabpanel"
                                                aria-labelledby="reviews-tab">
                                                <div class="product-details-review">
                                                    <h3 class="tp-comments-title mb-35">3 reviews for “Wide Cotton Tunic
                                                        extreme hammer”</h3>
                                                    <div class="latest-comments mb-55">
                                                        <ul>
                                                            <li>
                                                                <div class="comments-box d-flex">
                                                                    <div class="comments-avatar mr-25">
                                                                        <img src="assets/img/product/client.png"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="comments-text">
                                                                        <div
                                                                            class="comments-top d-sm-flex align-items-start justify-content-between mb-5">
                                                                            <div class="avatar-name">
                                                                                <b>Siarhei Dzenisenka</b>
                                                                                <div class="comments-date mb-20">
                                                                                    <span>March 27, 2018 9:51 am</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="user-rating">
                                                                                <ul>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fal fa-star"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <p class="m-0">Lorem ipsum dolor sit amet,
                                                                            consectetur adipiscing elit. Curabitur vulputate
                                                                            vestibulum Phasellus rhoncus, dolor eget viverra
                                                                            pretium, dolor tellus aliquet nunc, vitae
                                                                            ultricies erat elit eu lacus. Vestibulum non
                                                                            justo consectetur, cursus ante, tincidunt
                                                                            sapien. Nulla quis diam sit amet turpis interdum
                                                                            accumsan quis nec enim. Vivamus faucibus ex sed
                                                                            nibh egestas elementum. Mauris et bibendum dui.
                                                                            Aenean consequat pulvinar luctus. Suspendisse
                                                                            consectetur tristique tortor</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="comments-box d-flex">
                                                                    <div class="comments-avatar mr-25">
                                                                        <img src="assets/img/product/client-2.png"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="comments-text">
                                                                        <div
                                                                            class="comments-top d-sm-flex align-items-start justify-content-between mb-5">
                                                                            <div class="avatar-name">
                                                                                <b>Tommy Jarvis </b>
                                                                                <div class="comments-date mb-20">
                                                                                    <span>March 27, 2018 9:51 am</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="user-rating">
                                                                                <ul>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fal fa-star"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <p class="m-0">We have covered many special
                                                                            events
                                                                            such as fireworks, fairs, parades, races, walks,
                                                                            awards ceremonies, fashion shows, sporting
                                                                            events, and even a memorial service.
                                                                            Lorem ipsum dolor sit amet, consectetur
                                                                            adipiscing elit. Curabitur vulputate vestibulum
                                                                            Phasellus rhoncus, dolor eget viverra pretium,
                                                                            dolor tellus aliquet nunc, vitae ultricies erat
                                                                            elit eu lacus. Vestibulum non justo consectetur,
                                                                            cursus ante, tincidunt sapien. Nulla quis diam
                                                                            sit amet turpis interdum accumsan quis nec enim.
                                                                            Vivamus faucibus ex sed nibh egestas elementum.
                                                                            Mauris et bibendum dui. Aenean consequat
                                                                            pulvinar luctus. Suspendisse consectetur</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="comments-box d-flex">
                                                                    <div class="comments-avatar mr-25">
                                                                        <img src="assets/img/product/client-3.png"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="comments-text">
                                                                        <div
                                                                            class="comments-top d-sm-flex align-items-start justify-content-between mb-5">
                                                                            <div class="avatar-name">
                                                                                <b>Johnny Cash</b>
                                                                                <div class="comments-date mb-20">
                                                                                    <span>March 27, 2018 9:51 am</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="user-rating">
                                                                                <ul>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li><a href="#"><i
                                                                                                class="fal fa-star"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <p class="m-0">This is cardigan is a comfortable
                                                                            warm classic piece. Great to layer with a light
                                                                            top and you can dress up or down given the jewel
                                                                            buttons. I'm 5'8” 128lbs a 34A and the Small fit
                                                                            fine.</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-details-comment pb-100">
                                                        <div class="comment-title mb-20">
                                                            <h3>Add a review</h3>
                                                            <p>Your email address will not be published. Required fields are
                                                                marked*</p>
                                                        </div>
                                                        <div class="comment-rating mb-20 d-flex">
                                                            <span>Overall ratings</span>
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="comment-input-box">
                                                            <form action="#">
                                                                <div class="row">
                                                                    <div class="col-xxl-12">
                                                                        <div class="comment-input">
                                                                            <textarea placeholder="Your review..."></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <div class="comment-input">
                                                                            <input type="text"
                                                                                placeholder="Your Name*">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <div class="comment-input">
                                                                            <input type="email"
                                                                                placeholder="Your Email*">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-12">
                                                                        <div class="comment-submit">
                                                                            <button type="submit"
                                                                                class="tp-btn-theme"><span>Submit</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
                                <h4 class="tp-section-title">Les autres chambres pour: {{ $room->book->name ?? '' }}</h4>
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
                                        <div class="tp-product-price-wrapper-2 mb-15">
                                            <span class="tp-product-price-2 new-price">$155.00</span>
                                        </div>
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


            <!-- contact area start -->
         {{--    <div class="tp-contact-2-area theme-bg-2 pt-75 pb-55 z-index">
                <div class="container">
                    <div class="tp-contact-2-bg white-bg tp-contact-2-style-2">
                        <div class="row align-items-center">
                            <div class="col-xl-4 d-none d-xl-block">
                                <div class="tp-contact-2-logo">
                                    <a href="index.html"><img src="/assets/img/logo/logo-black.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="tp-contact-2-right">
                                    <div
                                        class="tp-contact-2-right-content d-flex align-items-center justify-content-between">
                                        <div class="tp-contact-2-box p-relative">
                                            <div class="tp-contact-2-icon">
                                                <span>
                                                    <svg width="13" height="18" viewBox="0 0 13 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.40889 5.57171C1.18267 4.00171 2.23598 2.58796 3.84505 2.06921C4.13074 1.97717 4.43904 2.00332 4.70704 2.14234C4.97504 2.28137 5.18256 2.52278 5.28727 2.81734L5.80324 4.26734C5.88619 4.50058 5.90107 4.75459 5.84595 4.99679C5.79083 5.239 5.66824 5.45835 5.49389 5.62671L3.95905 7.10859C3.88335 7.18179 3.82695 7.27437 3.79532 7.37732C3.76368 7.48027 3.75791 7.59009 3.77855 7.69609L3.7922 7.76109L3.8302 7.92421C3.86405 8.06171 3.91511 8.25546 3.98695 8.48671C4.12945 8.94609 4.35686 9.56359 4.6953 10.1805C5.03374 10.7973 5.42799 11.3136 5.73436 11.673C5.89392 11.8601 6.06071 12.0402 6.2343 12.213L6.2818 12.2592C6.35857 12.3308 6.45164 12.3802 6.55195 12.4027C6.65226 12.4251 6.75638 12.4198 6.85417 12.3873L8.84086 11.7292C9.06658 11.6545 9.30836 11.6525 9.53517 11.7235C9.76199 11.7944 9.9635 11.935 10.1139 12.1273L11.0538 13.3286C11.4456 13.8286 11.3993 14.5636 10.9487 15.0055C9.71724 16.2136 8.02386 16.4617 6.84586 15.4642C5.40195 14.2383 4.18468 12.7432 3.25486 11.0536C2.31736 9.36505 1.69107 7.50479 1.40889 5.57171ZM5.02245 7.77796L6.29664 6.54796C6.64534 6.21123 6.89052 5.77253 7.00076 5.28813C7.11099 4.80372 7.08124 4.2957 6.91533 3.82921L6.39877 2.37921C6.18803 1.78679 5.77059 1.30127 5.23153 1.02163C4.69248 0.741979 4.0724 0.689259 3.4977 0.874212C1.49973 1.51796 -0.104579 3.40359 0.235047 5.75921C0.539639 7.84797 1.21587 9.85749 2.22827 11.6823C3.23115 13.5044 4.54403 15.1167 6.1013 16.4386C7.8677 17.9323 10.2273 17.423 11.7585 15.9198C12.1967 15.49 12.4626 14.9004 12.502 14.2712C12.5414 13.6421 12.3513 13.0209 11.9705 12.5342L11.0306 11.333C10.7298 10.9482 10.3267 10.6669 9.87297 10.525C9.41922 10.3831 8.93555 10.3872 8.48402 10.5367L6.83517 11.083C6.76137 11.0031 6.68911 10.9216 6.61845 10.8386C6.27959 10.444 5.97978 10.014 5.72367 9.55546C5.47435 9.09262 5.27043 8.60427 5.11508 8.09796C5.08214 7.99197 5.05125 7.88528 5.02245 7.77796Z"
                                                            fill="currentcolor" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="tp-contact-2-text">
                                                <span>Phone:</span>
                                                <a class="text-anim-2" href="tel:6845550102">(684) 555-0102</a>
                                            </div>
                                        </div>
                                        <div class="tp-contact-2-box p-relative">
                                            <div class="tp-contact-2-icon">
                                                <span>
                                                    <svg width="18" height="14" viewBox="0 0 18 14"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17.3327 1.99967C17.3327 1.08301 16.5827 0.333008 15.666 0.333008H2.33268C1.41602 0.333008 0.666016 1.08301 0.666016 1.99967V11.9997C0.666016 12.9163 1.41602 13.6663 2.33268 13.6663H15.666C16.5827 13.6663 17.3327 12.9163 17.3327 11.9997V1.99967ZM15.666 1.99967L8.99935 6.16634L2.33268 1.99967H15.666ZM15.666 11.9997H2.33268V3.66634L8.99935 7.83301L15.666 3.66634V11.9997Z"
                                                            fill="currentcolor" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="tp-contact-2-text">
                                                <span>Email:</span>
                                                <a class="text-anim-2"
                                                    href="mailto:manhhachkt08@gmail.com">manhhachkt08@gmail.com</a>
                                            </div>
                                        </div>
                                        <div class="tp-contact-2-box location p-relative">
                                            <div class="tp-contact-2-icon">
                                                <span>
                                                    <svg width="16" height="20" viewBox="0 0 16 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8 10.834C9.38071 10.834 10.5 9.7147 10.5 8.33398C10.5 6.95327 9.38071 5.83398 8 5.83398C6.61929 5.83398 5.5 6.95327 5.5 8.33398C5.5 9.7147 6.61929 10.834 8 10.834Z"
                                                            stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M8.00065 1.66699C6.23254 1.66699 4.53685 2.36937 3.28661 3.61961C2.03636 4.86986 1.33398 6.56555 1.33398 8.33366C1.33398 9.91033 1.66898 10.942 2.58398 12.0837L8.00065 18.3337L13.4173 12.0837C14.3323 10.942 14.6673 9.91033 14.6673 8.33366C14.6673 6.56555 13.9649 4.86986 12.7147 3.61961C11.4645 2.36937 9.76876 1.66699 8.00065 1.66699Z"
                                                            stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="tp-contact-2-text">
                                                <span>Location:</span>
                                                <a class="text-anim-2" href="#" target="_blank">Elgin, Celina,
                                                    Delaware 10299</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- contact area end -->






        </main>
    @endsection
