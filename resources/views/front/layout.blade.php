@extends('front.fixe')
@section('titre', 'Accueil')
@section('body')

    <main>
        @php
            $config = DB::table('configs')->first();
            $service = DB::table('services')->get();
            $sponsors = DB::table('sponsors')->get();
        @endphp




        <!-- slider area start -->

        <div class="container-fluid px-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($homes as $key => $home)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img class="d-block w-100" src="{{ url('public/Image/' . $home->image) }}" alt="Image">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="container">
                                    <style>
                                        .custom-text-white {
    color: white !important;
}

                                    </style>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10 text-center">
                                            <p class="fs-5 fw-medium custom-text-white text-primary text-uppercase animated slideInRight">
                                                {{ $home->title }}
                                            </p>
                                            <h1 class="display-10 mb-10 text-white animated slideInRight">
                                                {!!  $home->body !!}
                                            </h1>
                                            <a href="#" class="btn btn-primary py-3 px-5 animated slideInRight">
                                                {{ \App\Helpers\TranslationHelper::TranslateText('Voir plus') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>


<style>
    .responsive-image {
    width: 100%;      /* L'image occupe toute la largeur */
    height: 300px;    /* Hauteur fixe */
    object-fit: cover; /* Ajuste le contenu sans déformer */
}


@media (max-width: 768px) {
    .responsive-image {
        max-width: 100%; /* Pleine largeur sur mobile */
        height: auto;
    }
}


</style>

        <!-- choose area start -->
        <div class="tp-choose-3-area tp-choose-style-2 fix p-relative pt-150 pb-110">
            <div class="tp-choose-3-shape  d-sm-block" >
                <img class="img-fluid" src="{{ url('public/Image/parametres/' . $config->imageabout) }}" height="300" width="400"
                    alt="">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6  wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
                        <div class="tp-choose-left">
                            <div class="tp-choose-title-box mb-20">
                                <span class="tp-section-subtitle">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Porquoi nous choisir') }} ?
                                </span>
                                <h3>
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Infrastructure et Aménagement') }}
                                </h3>
                            </div>
                            <div class="tp-choose-box d-flex align-items-start">
                                <div class="tp-choose-icon">
                                    <span>
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                </div>
                                <div class="tp-choose-content" style="text-align: justify">
                                    <h5 class="tp-choose-title">
                                        {{ \App\Helpers\TranslationHelper::TranslateText('Bungalows et Espaces Privés') }}
                                    </h5>
                                    <p>
                                        {!! \App\Helpers\TranslationHelper::TranslateText($config->mission ?? '') !!}
                                    </p>
                                </div>
                            </div>
                            <div class="tp-choose-box d-flex align-items-start">
                                <div class="tp-choose-icon">
                                    <span>
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                </div>
                                <div class="tp-choose-content" style="text-align: justify">
                                    <h5 class="tp-choose-title">
                                        {{ \App\Helpers\TranslationHelper::TranslateText('Club House et Espaces Communautaires') }}</h5>
                                    <p>



                                        {{ $config->vision ?? ' ' }}
                                        {!! \App\Helpers\TranslationHelper::TranslateText($config->vision ?? '') !!}
                                    </p>
                                </div>
                            </div>
                            <div class="tp-choose-box d-flex align-items-start">
                                <div class="tp-choose-icon">
                                    <span>
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                </div>
                                <div class="tp-choose-content" style="text-align: justify">
                                    <h5 class="tp-choose-title">

                                        {{ \App\Helpers\TranslationHelper::TranslateText('Espaces Communs et Activités') }}
                                    </h5>
                                    <p>

                                        {!! \App\Helpers\TranslationHelper::TranslateText($config->valeurs ?? '') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".7s">
                        <div class="tp-choose-3-thumb-box p-relative">
                            <div class="tp-choose-3-award"  style="width: 100%; max-width: 800px; margin: auto;">
                                <img class="img-fluid" src="{{ url('public/Image/parametres/' . $config->imageabout) }}" alt=""
                                    width="1200" height="600">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- choose area end -->


        <!-- service-area-start -->
        <div class="tp-service-4-area fix p-relative theme-bg-2 pt-145 pb-150">
            <div class="tp-service-4-shape tp-float-bob-y d-none d-lg-block">
                <img src="assets/img/shape/service/shape-4-1.png" alt="">
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5">
                        <div class="tp-service-4-title-box text-center mb-55">
                            <span class="tp-section-subtitle">
                                {{ \App\Helpers\TranslationHelper::TranslateText(' KDO CONCIERGERIE') }}
                            </span>
                            {{-- <h4 class="tp-section-title">Our Awesome & Best
                       Services</h4> --}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-service-4-wrap">
                            <div class="swiper-container tp-service-4-active">
                                <div class="swiper-wrapper">
                                    @if ($logements->isEmpty())
                                    <div class="alert alert-info">
                                        <p>Aucun logement n'est disponible pour le moment.</p>
                                    </div>
                                @else
                                    @foreach ($logements as $logement)
                                        <div class="swiper-slide">
                                            <div class="tp-service-4-item text-center">
                                                <div class="tp-service-4-thumb  image-container">
                                                    <img src="{{ url('public/Image/' . $logement->image) }}"
                                                        alt="">
                                                </div>
                                                <div class="tp-service-4-content">

                                                    <h4 class="tp-service-4-title"><a class="text-anim-3"
                                                            href="{{ route('details-logement', ['id' => $logement->id, 'slug' => Str::slug(Str::limit($logement->name, 10))]) }}">{{ $logement->name ?? '' }}</a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif


                                </div>
                                <div class="tp-slider-dots text-center mt-40"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service-area-end -->

        <!-- project area start -->
        <div class="tp-project-3-area fix pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row justify-content-center">
                            <div class="col-xl-5">
                                <div class="tp-service-4-title-box text-center mb-55">
                                    <span class="tp-section-subtitle">
                                        {{ \App\Helpers\TranslationHelper::TranslateText('Les dernière publications') }}</span>
                                    </span>
                                    {{-- <h4 class="tp-section-title">Our Awesome & Best
                               Services</h4> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row grid gx-30">
                    @if ($rooms->isEmpty())
                        <div class="alert alert-info">
                            <p>Aucune chambre n'est disponible pour le moment.</p>
                        </div>
                    @else
                        @foreach ($rooms as $room)
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30 grid-item cat3 cat2 cat4">
                                <div class="tp-project-3-item">
                                    <div class="tp-project-3-thumb ">
                                        <img src="{{ url('public/Image/' . $room->image) }}" alt="">
                                    </div>
                                    <div class="tp-project-3-content">
                                        <span class="tp-product-price-2 new-price">{{ $room->price ?? '' }}
                                            <x-devise></x-devise></span>
                                    </div>

                                    <div class="tp-project-3-content">
                                        <h4 class="tp-project-3-title mb-20"><a class="text-anim-3"
                                                href="{{ route('details-room', ['id' => $room->id, 'slug' => Str::slug(Str::limit($room->name, 20))]) }}">{{ $room->name ?? '' }}</a>
                                        </h4>

                                    </div>

                                </div>
                            </div>
                        @endforeach



                    @endif


                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="basic-pagination text-center mt-20">
                            <nav>
                                <ul>

                                    {!! $rooms->links('pagination::bootstrap-4') !!}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 
    <div class="tp-video-2-area theme-bg-2 pt-145 pb-150">
        <div class="container">
           <div class="row">
              <div class="col-xl-12">
                 <div class="tp-video-2-title-box text-center mb-55">
                    <h4 class="tp-section-title">Star Nursery , Follow Us <br>
                       For The Latest Gardening Updates</h4>
                 </div>
              </div>
           </div>
           <div class="tp-video-2-wrap">
              <div class="row align-items-center">
                 <div class="col-xl-7 col-lg-6">
                    <div class="tp-video-2-thumb p-relative">
                       <img src="assets/img/video/video-bg-2.jpg" alt="">
                       <div class="tp-video-play-icon">
                          <a class="popup-video" href="https://www.youtube.com/watch?v=PO_fBTkoznc">
                             <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                   d="M4.99941 3.00009L4.99941 21.0001C4.99998 21.1823 5.05024 21.361 5.14478 21.5168C5.23933 21.6726 5.37457 21.7996 5.53596 21.8843C5.69735 21.9689 5.87877 22.008 6.06069 21.9972C6.24261 21.9864 6.41815 21.9262 6.56841 21.8231L19.5684 12.8231C20.1074 12.4501 20.1074 11.5521 19.5684 11.1781L6.56841 2.17809C6.41846 2.07391 6.24284 2.01282 6.06061 2.00145C5.87839 1.99008 5.69653 2.02887 5.5348 2.1136C5.37307 2.19833 5.23765 2.32576 5.14326 2.48205C5.04887 2.63834 4.99912 2.81751 4.99941 3.00009ZM17.2424 12.0001L6.99941 19.0921L6.99941 4.90809L17.2424 12.0001Z"
                                   fill="currentcolor" />
                             </svg>
                          </a>
                       </div>
                    </div>
                 </div>
                 <div class="col-xl-5 col-lg-6">
                    <div class="tp-video-2-right">
                       <div class="tp-video-2-title-box mb-20">
                          <span class="tp-section-subtitle">Only The Best Quality</span>
                          <h4 class="tp-section-title">Your Favorite Plant
                             Gardening Guides</h4>
                       </div>
                       <div class="tp-video-2-text mb-25">
                          <p>Enthusiastically matrix future-proof platforms garden leadingedge impact digital
                             photography services.</p>
                       </div>
                       <div class="tp-video-2-list-box">
                          <ul>
                             <li>
                                <span>
                                   <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path
                                         d="M10.342 14.072L11.756 15.486L16 11.243L11.757 7L10.343 8.415L12.17 10.243H4.633V12.243H12.17L10.342 14.072Z"
                                         fill="currentcolor" />
                                      <path fill-rule="evenodd" clip-rule="evenodd"
                                         d="M18.778 18.778C23.074 14.482 23.074 7.518 18.778 3.222C14.482 -1.074 7.518 -1.074 3.222 3.222C-1.074 7.518 -1.074 14.482 3.222 18.778C7.518 23.074 14.482 23.074 18.778 18.778ZM17.364 17.364C19.0518 15.6762 20.0001 13.387 20.0001 11C20.0001 8.61304 19.0518 6.32384 17.364 4.636C15.6762 2.94816 13.387 1.99994 11 1.99994C8.61304 1.99994 6.32384 2.94816 4.636 4.636C2.94816 6.32384 1.99994 8.61304 1.99994 11C1.99994 13.387 2.94816 15.6762 4.636 17.364C6.32384 19.0518 8.61304 20.0001 11 20.0001C13.387 20.0001 15.6762 19.0518 17.364 17.364Z"
                                         fill="currentcolor" />
                                   </svg>
                                </span>
                                Starting Seeds Outdoors
                             </li>
                             <li>
                                <span>
                                   <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path
                                         d="M10.342 14.072L11.756 15.486L16 11.243L11.757 7L10.343 8.415L12.17 10.243H4.633V12.243H12.17L10.342 14.072Z"
                                         fill="currentcolor" />
                                      <path fill-rule="evenodd" clip-rule="evenodd"
                                         d="M18.778 18.778C23.074 14.482 23.074 7.518 18.778 3.222C14.482 -1.074 7.518 -1.074 3.222 3.222C-1.074 7.518 -1.074 14.482 3.222 18.778C7.518 23.074 14.482 23.074 18.778 18.778ZM17.364 17.364C19.0518 15.6762 20.0001 13.387 20.0001 11C20.0001 8.61304 19.0518 6.32384 17.364 4.636C15.6762 2.94816 13.387 1.99994 11 1.99994C8.61304 1.99994 6.32384 2.94816 4.636 4.636C2.94816 6.32384 1.99994 8.61304 1.99994 11C1.99994 13.387 2.94816 15.6762 4.636 17.364C6.32384 19.0518 8.61304 20.0001 11 20.0001C13.387 20.0001 15.6762 19.0518 17.364 17.364Z"
                                         fill="currentcolor" />
                                   </svg>
                                </span>
                                Pest, Weed & fertilization
                             </li>
                             <li>
                                <span>
                                   <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path
                                         d="M10.342 14.072L11.756 15.486L16 11.243L11.757 7L10.343 8.415L12.17 10.243H4.633V12.243H12.17L10.342 14.072Z"
                                         fill="currentcolor" />
                                      <path fill-rule="evenodd" clip-rule="evenodd"
                                         d="M18.778 18.778C23.074 14.482 23.074 7.518 18.778 3.222C14.482 -1.074 7.518 -1.074 3.222 3.222C-1.074 7.518 -1.074 14.482 3.222 18.778C7.518 23.074 14.482 23.074 18.778 18.778ZM17.364 17.364C19.0518 15.6762 20.0001 13.387 20.0001 11C20.0001 8.61304 19.0518 6.32384 17.364 4.636C15.6762 2.94816 13.387 1.99994 11 1.99994C8.61304 1.99994 6.32384 2.94816 4.636 4.636C2.94816 6.32384 1.99994 8.61304 1.99994 11C1.99994 13.387 2.94816 15.6762 4.636 17.364C6.32384 19.0518 8.61304 20.0001 11 20.0001C13.387 20.0001 15.6762 19.0518 17.364 17.364Z"
                                         fill="currentcolor" />
                                   </svg>
                                </span>
                                Landscape Maintenance
                             </li>
                             <li>
                                <span>
                                   <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path
                                         d="M10.342 14.072L11.756 15.486L16 11.243L11.757 7L10.343 8.415L12.17 10.243H4.633V12.243H12.17L10.342 14.072Z"
                                         fill="currentcolor" />
                                      <path fill-rule="evenodd" clip-rule="evenodd"
                                         d="M18.778 18.778C23.074 14.482 23.074 7.518 18.778 3.222C14.482 -1.074 7.518 -1.074 3.222 3.222C-1.074 7.518 -1.074 14.482 3.222 18.778C7.518 23.074 14.482 23.074 18.778 18.778ZM17.364 17.364C19.0518 15.6762 20.0001 13.387 20.0001 11C20.0001 8.61304 19.0518 6.32384 17.364 4.636C15.6762 2.94816 13.387 1.99994 11 1.99994C8.61304 1.99994 6.32384 2.94816 4.636 4.636C2.94816 6.32384 1.99994 8.61304 1.99994 11C1.99994 13.387 2.94816 15.6762 4.636 17.364C6.32384 19.0518 8.61304 20.0001 11 20.0001C13.387 20.0001 15.6762 19.0518 17.364 17.364Z"
                                         fill="currentcolor" />
                                   </svg>
                                </span>
                                Lawn & Garden Care
                             </li>
                          </ul>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div> --}}
        <!-- project area end -->
        {{--
        <div class="tp-service-area tp-service-bg pt-105 z-index-2 fix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="tp-service-title-box mb-55">
                            <span class="tp-section-subtitle">les dernières publications</span>

                        </div>
                    </div>
                </div>
                <div class="row gx-30">
                    @php

                        $prods = DB::table('products')->latest()->take(9)->get();

                    @endphp
                    @foreach ($prods as $key => $produit)
                        <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".3s">
                            <div class="tp-service-item text-center">
                                <div class="tp-service-thumb-box p-relative">
                                    <div class="tp-service-thumb">
                                        <img src="{{ url('public/Image/' . $produit->image) }}" width="200 "
    height="200 " border-radius="8px" class="rounded shadow" alt="">
    </div>
    <div class="tp-service-icon">

    </div>
    </div>
    <div class="tp-service-content">
        <h4 class="tp-service-title"><a class="text-anim-2" href="{{ route('details-produits', ['id' => $produit->id, 'slug' => Str::slug(Str::limit($produit->name, 10))]) }}">{{ $produit->name }}</a>
        </h4>

        <div class="tp-service-link">
            <a href="{{ route('details-produits', ['id' => $produit->id, 'slug' => Str::slug(Str::limit($produit->name, 10))]) }}">
                Details Produit
                <span>
                    <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1543 4.99974L9.5111 9.644L8.7559 8.88987L12.1127 5.53307H0.0668316V4.4664H12.1127L8.7559 1.11067L9.5111 0.355469L14.1543 4.99974Z" fill="currentcolor" />
                    </svg>
                </span>
            </a>
        </div>
    </div>
    </div>
    </div>
    @endforeach

    <div class="text-center mt-30">
        <a href="{{ url('produits') }}" class="tp-btn">Voir tous les produits</a>
    </div>
    <style>
        .tp-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1723c7;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .tp-btn:hover {
            background-color: #0f1a92;
            text-decoration: none;
        }

    </style>
    </div>

    </div>

    </div>
    </div> --}}



        <!-- choose area start -->
        <div class="tp-choose-area tp-choose-style-2 fix p-relative pt-150 pb-110">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="tp-choose-left">
                            <div class="tp-choose-title-box mb-20" style="text-align: justify">
                                <span class="tp-section-subtitle">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Séjours et Services Proposés') }}
                                </span>
                                <h6>
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Transformez vos défis en opportunités avec GREENLYFE') }}
                                </h6>
                            </div>
                            <div class="tp-choose-text" style="text-align: justify">
                                <p> Parce que nous nous engageons à transformer vos
                                    défis en opportunités grâce à notre mission clairement définie, notre vision ambitieuse
                                    et nos
                                    archives impressionnantes.</p>
                            </div>
                            <div class="tp-choose-box d-flex align-items-start">
                                <div class="tp-choose-icon">
                                    <span>
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                </div>

                                <div class="tp-choose-content" style="text-align: justify">
                                    <h5 class="tp-choose-title">Séjours Longs et Immersion</p>
                                        <p>
                                            {{ $config->domaine ?? ' ' }}
                                        </p>
                                </div>

                            </div>
                            <div class="tp-choose-box d-flex align-items-start">
                                <div class="tp-choose-icon">
                                    <span>
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                </div>
                                <div class="tp-choose-content" style="text-align: justify">
                                    <h5 class="tp-choose-title">Alimentation Saine et Locale</h5>
                                    <p>
                                        {{ $config->equipe ?? ' ' }}
                                    </p>
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="tp-funfact-2-wrap">
                            <div class="row gx-30">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="tp-funfact-2-left">
                                        <div class="tp-funfact-2-item text-center tp-funfact-style-yellow mb-30">
                                            <div class="tp-funfact-2-icon">
                                                <span>
                                                    <svg width="79" height="80" viewBox="0 0 79 80"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M70.7709 3.99549L63.8419 0.16277C63.4469 -0.0538617 62.9696 -0.0538617 62.5746 0.16277L55.6292 3.99549C52.2717 5.84519 49.6878 8.87804 48.3711 12.5275C47.7128 11.4276 46.8898 10.4278 45.9353 9.59459C46.8076 5.26195 44.0261 1.04596 39.7634 0.16277C35.5007 -0.720422 31.3038 2.07913 30.448 6.41177C30.234 7.4616 30.234 8.5281 30.448 9.57793C25.9384 13.5273 25.0168 20.2429 28.3084 25.2754C27.5842 25.9586 26.9259 26.7252 26.3499 27.5584C25.7738 26.7252 25.1155 25.9586 24.3749 25.2754C27.6665 20.2429 26.7449 13.5273 22.2353 9.59459C23.1076 5.26195 20.3261 1.04596 16.0634 0.16277C11.8007 -0.720422 7.60386 2.07913 6.74803 6.41177C6.64928 6.92835 6.58344 7.4616 6.58344 7.99485C6.58344 8.5281 6.63282 9.06135 6.73157 9.57793C2.22199 13.5106 1.30033 20.2429 4.59199 25.2754C1.64595 28.0416 -0.0163372 31.9244 0.000121064 35.9904C0.0165794 43.5725 5.71115 49.8881 13.1668 50.588V53.3209H2.63345C1.90928 53.3209 1.31679 53.9208 1.31679 54.6541V59.9865C1.31679 60.7197 1.90928 61.3197 2.63345 61.3197H2.7322L3.95012 78.7502C3.99949 79.4501 4.57553 79.9833 5.26678 79.9833H23.7001C24.3913 79.9833 24.9674 79.4501 25.0168 78.7502L26.2511 61.3197H26.4322L27.6665 78.7502C27.7159 79.4501 28.292 79.9833 28.9832 79.9833H47.4165C48.1078 79.9833 48.6838 79.4501 48.7332 78.7502L49.9675 61.3197H50.0663C50.7905 61.3197 51.383 60.7197 51.383 59.9865V54.6541C51.383 53.9208 50.7905 53.3209 50.0663 53.3209H39.533V50.588C46.034 49.9881 51.3171 45.0723 52.4692 38.5733C54.2796 39.0565 56.1065 39.4065 57.9663 39.6398V60.7697L53.0782 65.7189C52.8313 65.9689 52.6996 66.3022 52.6996 66.6688V78.6669C52.6996 79.4001 53.2921 80 54.0163 80H72.4496C73.1738 80 73.7663 79.4001 73.7663 78.6669V66.6688C73.7663 66.3189 73.6346 65.9689 73.3877 65.7189L68.4667 60.7697V39.6398C71.6431 39.2399 74.7538 38.49 77.7656 37.3735L78.1277 37.2402C78.6544 37.0569 79 36.5403 79 35.9904V18.0266C79 12.1775 75.84 6.79504 70.7709 3.99549ZM2.63345 35.9904C2.61699 32.7076 3.93366 29.5747 6.2872 27.3251C7.02782 28.0416 7.85073 28.6582 8.73948 29.1581L10.0232 26.8252C5.56303 24.3256 3.95012 18.6598 6.41886 14.1439C6.7974 13.4606 7.25823 12.8274 7.7849 12.2442C8.29511 13.0774 8.9699 13.7939 9.74344 14.3938L11.3234 12.2608C9.00282 10.4945 8.52553 7.14499 10.2701 4.79536C12.0147 2.44574 15.3228 1.96248 17.6434 3.72887C19.964 5.49525 20.4413 8.84471 18.6968 11.1943L20.8034 12.7941C20.9351 12.6108 21.0668 12.4275 21.182 12.2442C24.6876 15.9936 24.523 21.8926 20.8199 25.4421C20.2932 25.942 19.7172 26.3752 19.0918 26.7419L20.4084 29.0415C21.2313 28.5582 21.9884 27.975 22.6797 27.3084C25.0332 29.5581 26.3499 32.7076 26.3334 35.9737C26.3334 42.0727 21.7909 47.2052 15.8001 47.8885V44.5223L23.3215 36.9069L21.4618 35.0239L15.8001 40.7729V21.876L20.6882 16.9268L18.8284 15.0437L15.8001 18.1099V9.32797H13.1668V34.1073L10.1549 31.0578L8.29511 32.9409L13.1668 37.8734V47.9051C7.17594 47.2219 2.63345 42.0894 2.63345 35.9904ZM22.4822 77.3171H6.48469L5.34907 61.3197H23.5849L22.4822 77.3171ZM25.0168 58.6534H3.95012V55.9872H25.0168V58.6534ZM15.8001 53.3209V50.588C20.0299 50.1881 23.8811 47.9385 26.3334 44.4057C28.7857 47.9385 32.6369 50.1881 36.8667 50.588V53.3209H15.8001ZM46.1821 77.3171H30.2011L29.0655 61.3197H47.3013L46.1821 77.3171ZM48.7167 55.9872V58.6534H27.6501V55.9872H48.7167ZM46.1657 44.8556C44.3223 46.5554 41.9853 47.6218 39.5001 47.9051V39.2065L45.7048 32.9242L43.8451 31.0412L39.5001 35.4405V24.5422L44.3882 19.593L42.5284 17.71L39.5001 20.7761V9.32797H36.8667V18.1099L33.8549 15.0604L31.9951 16.9434L36.8832 21.8926V35.4571L32.5547 31.0745L30.6949 32.9575L36.8996 39.2399V47.9385C33.0649 47.5052 29.6909 45.2056 27.8311 41.7894C29.3947 38.09 29.3947 33.924 27.8476 30.2246C28.4236 29.1581 29.1642 28.1916 30.0365 27.3584C30.7772 28.075 31.6001 28.6915 32.4888 29.1915L33.7726 26.8585C29.3124 24.3589 27.7159 18.6931 30.1682 14.1772C30.5467 13.494 31.0076 12.8607 31.5342 12.2775C32.0444 13.1107 32.7192 13.8273 33.4928 14.4272L35.0728 12.2942C32.7522 10.5278 32.2749 7.17832 34.0194 4.82869C35.764 2.47907 39.0721 1.99581 41.3928 3.76219C43.7134 5.52858 44.1907 8.87804 42.4461 11.2277L44.5528 12.8274C44.6844 12.6441 44.8161 12.4608 44.9313 12.2775C48.4369 16.0269 48.2723 21.926 44.5692 25.4754C44.0426 25.9753 43.4665 26.4086 42.8411 26.7752L44.1578 29.0748C45.425 28.3416 46.5278 27.3584 47.4494 26.2086V35.9904C47.4494 36.5569 47.7951 37.0569 48.3217 37.2402L48.6838 37.3735C49.0953 37.5235 49.5232 37.6734 49.9511 37.8067C49.4903 40.523 48.1736 43.0226 46.1657 44.8556ZM71.1 67.202V77.3171H55.3V67.202L60.1882 62.2528C60.435 62.0029 60.5667 61.6696 60.5667 61.303V39.8897C61.439 39.9397 62.3277 39.9731 63.2 39.9731C64.0723 39.9731 64.9611 39.9397 65.8334 39.8897V61.3197C65.8334 61.6696 65.965 62.0195 66.2119 62.2695L71.1 67.202ZM76.3667 35.0572C67.8413 38.0567 58.5588 38.0567 50.0334 35.0572V18.0266C50.0334 13.1607 52.6667 8.66141 56.8965 6.32845L63.2 2.84567L69.5036 6.32845C73.7333 8.66141 76.3667 13.1607 76.3667 18.0266V35.0572Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M63.1992 7.99487V10.6611C67.5607 10.6611 71.0992 14.2439 71.0992 18.6598V26.6586H73.7325V18.6598C73.7325 12.7774 69.009 7.99487 63.1992 7.99487Z"
                                                            fill="currentcolor" />
                                                        <path d="M73.7329 29.3247H71.0996V31.9909H73.7329V29.3247Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M62.2621 64.3691L58.3121 68.3685C58.0653 68.6184 57.9336 68.9517 57.9336 69.3183V73.3177C57.9336 74.0509 58.5261 74.6508 59.2503 74.6508H67.1502C67.8744 74.6508 68.4669 74.0509 68.4669 73.3177V69.3183C68.4669 68.9684 68.3352 68.6184 68.0884 68.3685L64.1384 64.3691C63.6117 63.8525 62.7888 63.8525 62.2621 64.3691ZM65.8336 71.9846H60.5669V69.8682L63.2003 67.202L65.8336 69.8682V71.9846Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M18.4451 65.1302L17.127 74.4668L19.7337 74.8441L21.0518 65.5075L18.4451 65.1302Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M42.1463 65.1312L40.8281 74.4678L43.4349 74.845L44.753 65.5085L42.1463 65.1312Z"
                                                            fill="currentcolor" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <h4 class="tp-funfact-2-number"><i class="purecounter"
                                                    data-purecounter-duration="1"
                                                    data-purecounter-end="{{ $config->projet ?? ' ' }}">0</i>+</h4>
                                            <span>Project réalisés</span>
                                        </div>
                                        <div class="tp-funfact-2-item text-center tp-funfact-style-border mb-30">
                                            <div class="tp-funfact-2-icon">
                                                <span>
                                                    <svg width="79" height="80" viewBox="0 0 79 80"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M51.3245 20.6897L43.9955 19.6552L40.6852 12.9379C40.5709 12.7084 40.3956 12.5157 40.179 12.3817C39.9623 12.2476 39.713 12.1775 39.4591 12.1793C39.2061 12.1814 38.9587 12.2547 38.7446 12.3911C38.5304 12.5276 38.358 12.7217 38.2467 12.9517L34.9909 19.6828L27.6619 20.8C27.4096 20.8371 27.1727 20.9451 26.978 21.1117C26.7833 21.2784 26.6387 21.497 26.5607 21.7427C26.4826 21.9884 26.4742 22.2514 26.5365 22.5017C26.5987 22.752 26.729 22.9796 26.9127 23.1586L32.2391 28.3724L31.0267 35.8621C30.9781 36.1207 31.0035 36.3879 31.1001 36.6324C31.1966 36.8768 31.3603 37.0881 31.5716 37.2414C31.8016 37.41 32.0778 37.5016 32.3617 37.5035C32.5842 37.5066 32.804 37.4545 33.002 37.3517L39.5 33.7517L46.1206 37.2414C46.3372 37.3461 46.5772 37.3911 46.8164 37.3717C47.0556 37.3523 47.2855 37.2693 47.4829 37.131C47.6942 36.9777 47.8578 36.7664 47.9544 36.522C48.051 36.2776 48.0764 36.0103 48.0278 35.7517L46.6655 28.3586L51.9511 23.1035C52.1493 22.9355 52.2961 22.7138 52.3746 22.4645C52.453 22.2152 52.4597 21.9484 52.394 21.6953C52.3283 21.4422 52.1929 21.2133 52.0035 21.0352C51.8141 20.8571 51.5786 20.7373 51.3245 20.6897ZM44.3905 26.8966C44.2308 27.053 44.1112 27.2467 44.0424 27.4607C43.9735 27.6746 43.9574 27.9024 43.9955 28.1241L44.9491 33.4759L40.1811 30.9655C39.9858 30.8616 39.7684 30.8073 39.5477 30.8073C39.327 30.8073 39.1096 30.8616 38.9142 30.9655L34.1599 33.5172L35.0454 28.1655C35.0834 27.9438 35.0673 27.716 34.9985 27.502C34.9296 27.2881 34.8101 27.0944 34.6503 26.9379L30.7951 23.1724L36.108 22.3586C36.3262 22.3254 36.5332 22.239 36.7112 22.1069C36.8892 21.9748 37.0328 21.8008 37.1297 21.6L39.5 16.731L41.8976 21.5862C41.9974 21.7862 42.1439 21.9585 42.3243 22.0883C42.5047 22.218 42.7136 22.3014 42.9329 22.331L48.2321 23.0897L44.3905 26.8966ZM78.6924 11.531C78.5643 11.3753 78.4039 11.2501 78.2226 11.1643C78.0413 11.0785 77.8436 11.0342 77.6435 11.0345H63.1898L64.0208 1.50346C64.0379 1.31217 64.0153 1.11937 63.9545 0.937426C63.8937 0.755478 63.7961 0.588386 63.6679 0.446854C63.5396 0.305322 63.3836 0.192468 63.2098 0.115522C63.036 0.0385751 62.8482 -0.00076825 62.6585 1.13636e-05H16.3415C16.1518 -0.00076825 15.964 0.0385751 15.7902 0.115522C15.6164 0.192468 15.4604 0.305322 15.3321 0.446854C15.2039 0.588386 15.1063 0.755478 15.0455 0.937426C14.9847 1.11937 14.9621 1.31217 14.9792 1.50346L15.8102 11.0345H1.35654C1.15641 11.0342 0.958668 11.0785 0.777372 11.1643C0.596076 11.2501 0.435684 11.3753 0.307599 11.531C0.183048 11.6853 0.0929817 11.865 0.0435969 12.0579C-0.00578792 12.2508 -0.0133185 12.4522 0.0215235 12.6483L1.0296 18.4414C1.81829 23.0934 4.02702 27.3782 7.34529 30.6935C10.6636 34.0087 14.9245 36.1877 19.5292 36.9241C20.8285 39.665 22.6653 42.1095 24.9277 44.1085C27.1901 46.1075 29.8307 47.6193 32.6887 48.5517V66.2069H22.4717C20.6652 66.2069 18.9327 66.9335 17.6553 68.2269C16.378 69.5202 15.6603 71.2744 15.6603 73.1034V78.6207C15.6603 78.9865 15.8039 79.3373 16.0593 79.596C16.3148 79.8547 16.6613 80 17.0226 80H61.9774C62.3387 80 62.6852 79.8547 62.9407 79.596C63.1961 79.3373 63.3397 78.9865 63.3397 78.6207V73.1034C63.3397 71.2744 62.622 69.5202 61.3447 68.2269C60.0673 66.9335 58.3348 66.2069 56.5283 66.2069H46.3113V48.5517C49.1693 47.6193 51.8099 46.1075 54.0723 44.1085C56.3347 42.1095 58.1715 39.665 59.4708 36.9241C64.0755 36.1877 68.3364 34.0087 71.6547 30.6935C74.973 27.3782 77.1817 23.0934 77.9704 18.4414L78.9785 12.6483C79.0133 12.4522 79.0058 12.2508 78.9564 12.0579C78.907 11.865 78.817 11.6853 78.6924 11.531ZM3.69964 17.931L2.97764 13.7931H16.0554L17.4177 29.1586C17.4858 29.8897 17.5948 30.6069 17.731 31.3104L17.8536 31.9586C17.9762 32.469 18.0988 32.9793 18.2486 33.4897C18.2486 33.6138 18.2486 33.7517 18.344 33.8759C14.6356 32.9489 11.2748 30.9467 8.67359 28.1145C6.07239 25.2823 4.34378 21.7432 3.69964 17.931ZM60.6151 73.1034V77.2414H18.3849V73.1034C18.3849 72.006 18.8154 70.9535 19.5819 70.1775C20.3483 69.4015 21.3878 68.9655 22.4717 68.9655H56.5283C57.6122 68.9655 58.6517 69.4015 59.4181 70.1775C60.1846 70.9535 60.6151 72.006 60.6151 73.1034ZM43.5868 49.6552V66.2069H35.4132V49.6552H43.5868ZM39.5 46.8966C35.7217 46.8942 32.0256 45.7795 28.8619 43.688C25.6982 41.5966 23.2035 38.6188 21.6816 35.1172C20.8246 33.1693 20.2951 31.0901 20.115 28.9655L18.6709 12.4138L17.8263 2.75863H61.1737L58.8851 28.9655C58.7093 31.1131 58.1798 33.2157 57.3184 35.1862C55.785 38.6738 53.2856 41.6362 50.123 43.7147C46.9604 45.7932 43.2704 46.8984 39.5 46.8966ZM75.3004 17.931C74.6564 21.7396 72.9293 25.2753 70.3306 28.105C67.7319 30.9346 64.3745 32.9354 60.6696 33.8621C61.1458 32.3322 61.4608 30.7556 61.6096 29.1586L62.9718 13.7931H76.0496L75.3004 17.931Z"
                                                            fill="currentcolor" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <h4 class="tp-funfact-2-number"><i class="purecounter"
                                                    data-purecounter-duration="1"
                                                    data-purecounter-end="{{ $config->dossier ?? '' }}">0</i>+</h4>
                                            <span>Les dossiers traités</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="tp-funfact-2-right">
                                        <div class="tp-funfact-2-item text-center tp-funfact-style-border mb-30">
                                            <div class="tp-funfact-2-icon">
                                                <span>
                                                    <svg width="101" height="80" viewBox="0 0 101 80"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M30.7357 14.2167C30.7357 14.8548 30.7055 15.5031 30.6351 16.1413C30.6351 16.1514 30.5647 16.6579 30.6049 16.354C30.5848 16.5059 30.5546 16.6579 30.5345 16.8098C30.4842 17.1137 30.4238 17.4075 30.3534 17.7114C30.2226 18.2887 30.0516 18.856 29.8504 19.4232C29.8001 19.5549 29.7498 19.6967 29.6994 19.8284C29.5385 20.264 29.8202 19.5752 29.629 19.9905C29.5184 20.2437 29.3976 20.5071 29.2668 20.7502C29.0153 21.2364 28.7437 21.7024 28.4318 22.1582C28.3614 22.2696 28.2809 22.3709 28.2004 22.4824C27.9489 22.8369 28.3916 22.2595 28.1199 22.5938C27.9489 22.7862 27.7879 22.9888 27.6169 23.1813C27.4458 23.3636 27.2648 23.546 27.0837 23.7182C26.9931 23.7992 26.9026 23.8802 26.802 23.9613C26.7617 23.9917 26.4398 24.255 26.7215 24.0322C26.3392 24.3259 25.9367 24.5792 25.5142 24.802C25.4136 24.8527 25.3029 24.9033 25.2023 24.954C24.8502 25.1262 25.5041 24.8527 25.1319 24.9844C24.9105 25.0654 24.6993 25.1464 24.4679 25.2072C24.2465 25.268 24.0151 25.3085 23.7938 25.3591C23.4316 25.4402 24.0252 25.3591 23.7938 25.3591C23.663 25.3591 23.5222 25.3895 23.3813 25.3895C23.1499 25.3997 22.9085 25.3997 22.6771 25.3895C22.5563 25.3794 22.4457 25.3693 22.3249 25.3591C21.9326 25.3288 22.6469 25.43 22.2646 25.349C21.8018 25.2477 21.3692 25.1363 20.9265 24.9742C20.5543 24.8425 21.2082 25.116 20.8561 24.9438C20.7555 24.8932 20.6448 24.8425 20.5442 24.7919C20.3329 24.6805 20.1317 24.5589 19.9305 24.4374C19.7293 24.3057 19.5281 24.1639 19.3369 24.022C19.5784 24.2044 19.4073 24.0727 19.357 24.0322C19.2363 23.9207 19.1055 23.8195 18.9848 23.708C18.6125 23.3636 18.2705 22.9787 17.9485 22.5938C17.6769 22.2696 18.1196 22.8369 17.868 22.4824C17.7876 22.3709 17.7171 22.2696 17.6366 22.1582C17.4857 21.9354 17.3348 21.7125 17.204 21.4795C16.0873 19.5954 15.4837 17.3568 15.3629 15.1891C15.3227 14.5408 15.3227 13.8925 15.3629 13.2442C15.383 12.9505 15.4032 12.6669 15.4333 12.3731C15.4434 12.2414 15.4635 12.1097 15.4836 11.9781C15.4434 12.2414 15.534 11.664 15.544 11.6134C15.6446 11.0157 15.7855 10.4282 15.9565 9.84072C16.0269 9.60774 16.0974 9.37477 16.1778 9.14179C16.2281 8.99997 16.2784 8.86829 16.3288 8.73661C16.3589 8.64544 16.3992 8.55427 16.4294 8.46311C16.369 8.60492 16.369 8.59479 16.4394 8.43272C16.6708 7.92624 16.9123 7.4299 17.194 6.94368C17.3046 6.75122 17.4254 6.55876 17.5562 6.37643C17.6266 6.265 17.7071 6.15358 17.7876 6.05228C17.8379 5.98138 17.8882 5.91047 17.9485 5.83956C17.8479 5.97125 17.8479 5.97125 17.9485 5.83956C18.2805 5.45464 18.6125 5.06972 18.9848 4.72532C19.1357 4.5835 19.2967 4.45182 19.4476 4.32014C19.1659 4.55311 19.4778 4.29988 19.5281 4.25936C19.6589 4.16819 19.7896 4.07703 19.9305 3.98586C20.1317 3.85418 20.3329 3.74275 20.5442 3.63133C20.6448 3.58068 20.7555 3.53003 20.8561 3.47939C21.2082 3.30718 20.5543 3.58068 20.9265 3.449C21.3692 3.29706 21.8118 3.1755 22.2646 3.0742C22.6469 2.99317 21.9326 3.09446 22.3249 3.06408C22.4457 3.05395 22.5563 3.04382 22.6771 3.03369C22.9085 3.02356 23.1499 3.02356 23.3813 3.03369C23.4719 3.03369 24.0856 3.12485 23.6731 3.05395C23.9447 3.10459 24.2063 3.15524 24.4679 3.22615C24.7295 3.29705 24.981 3.38822 25.2325 3.48952C24.8804 3.3477 25.2425 3.49964 25.3029 3.53003C25.4236 3.59081 25.5444 3.65159 25.6651 3.72249C25.8965 3.84405 26.1078 3.98586 26.3291 4.12768C26.4297 4.19858 26.5303 4.26949 26.6209 4.34039C26.7517 4.44169 26.7517 4.44169 26.6007 4.33027C26.6611 4.38091 26.7315 4.43156 26.7919 4.48221C27.2044 4.83674 27.5968 5.23179 27.9489 5.6471C28.0294 5.7484 28.1099 5.84969 28.1903 5.95099C27.9791 5.68762 28.3111 6.12319 28.3513 6.17384C28.5324 6.42708 28.7034 6.69044 28.8644 6.96394C29.1763 7.48055 29.4479 8.02754 29.6793 8.58466C29.5586 8.29091 29.7296 8.7366 29.7397 8.75686C29.8101 8.9392 29.8705 9.12153 29.9308 9.30386C30.0415 9.628 30.1421 9.96228 30.2327 10.2966C30.3132 10.5903 30.3836 10.8841 30.4439 11.1778C30.4741 11.3298 30.5043 11.4817 30.5345 11.6336C30.5445 11.6843 30.6351 12.2617 30.5949 11.9983C30.6955 12.7175 30.7256 13.4671 30.7357 14.2167C30.7357 15.0068 31.4299 15.7766 32.2448 15.7361C33.0597 15.6956 33.7539 15.0676 33.7539 14.2167C33.7338 9.19243 31.6613 3.2768 26.8824 0.936878C24.7898 -0.0963329 22.3249 -0.329312 20.1216 0.521567C17.7876 1.42309 15.9464 3.16537 14.6486 5.3027C11.7411 10.1041 11.6002 16.435 13.8236 21.5201C15.7553 25.9264 20.2424 29.492 25.2224 28.1448C30.3735 26.7469 33.0497 21.2263 33.6332 16.2932C33.7137 15.6044 33.7539 14.9156 33.7539 14.2167C33.7539 13.4266 33.0597 12.6567 32.2448 12.6972C31.4198 12.7276 30.7357 13.3658 30.7357 14.2167Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M13.1193 27.2533C8.67243 28.1447 4.78899 30.8999 2.42473 34.7998C1.25768 36.7345 0.483006 38.9225 0.181184 41.1611C-0.00996944 42.5793 9.12532e-05 43.9873 9.12532e-05 45.4155C9.12532e-05 46.7121 9.12532e-05 48.0087 9.12532e-05 49.3154C9.12532e-05 50.1359 0.694281 50.8348 1.5092 50.8348C2.8674 50.8348 4.22559 50.8348 5.57373 50.8348C8.83341 50.8348 12.083 50.8348 15.3427 50.8348C19.2664 50.8348 23.18 50.8348 27.1037 50.8348C30.5042 50.8348 33.9148 50.8348 37.3153 50.8348C38.9653 50.8348 40.6253 50.8855 42.2652 50.8348C42.2853 50.8348 42.3155 50.8348 42.3356 50.8348C43.1203 50.8348 43.885 50.1359 43.8447 49.3154C43.8045 48.4949 43.1807 47.796 42.3356 47.796C40.9774 47.796 39.6192 47.796 38.2711 47.796C35.0114 47.796 31.7618 47.796 28.5021 47.796C24.5784 47.796 20.6648 47.796 16.7411 47.796C13.3406 47.796 9.93002 47.796 6.5295 47.796C4.8896 47.796 3.21952 47.7048 1.57962 47.796C1.5595 47.796 1.52932 47.796 1.5092 47.796C2.01224 48.3024 2.51527 48.8089 3.01831 49.3154C3.01831 47.1274 2.9177 44.909 3.03843 42.7211C3.04849 42.478 3.06861 42.2348 3.09879 42.0019C3.09879 41.9715 3.15916 41.4954 3.10885 41.8398C3.12898 41.7182 3.13904 41.6068 3.15916 41.4853C3.2497 40.9484 3.36037 40.4217 3.50122 39.8949C3.63201 39.3986 3.79298 38.9124 3.97408 38.4363C3.98414 38.4059 4.15517 37.9804 4.02438 38.2843C4.06462 38.183 4.11493 38.0716 4.16523 37.9703C4.28596 37.6968 4.41675 37.4335 4.5576 37.1701C4.78899 36.7244 5.04051 36.2989 5.31215 35.8836C5.43288 35.6912 5.56367 35.5088 5.69446 35.3265C5.71458 35.2961 5.98622 34.9416 5.78501 35.205C5.86549 35.0935 5.95604 34.9922 6.03652 34.8909C6.69047 34.0907 7.43497 33.3715 8.22976 32.7232C7.97824 32.9258 8.32031 32.6523 8.35049 32.6321C8.46116 32.551 8.57183 32.47 8.67243 32.3991C8.93401 32.2168 9.19559 32.0446 9.45717 31.8825C9.91996 31.5989 10.3928 31.3456 10.8858 31.1228C10.916 31.1126 11.3285 30.9303 11.0166 31.062C11.1574 31.0012 11.3083 30.9404 11.4593 30.8898C11.7309 30.7885 12.0126 30.6872 12.2943 30.6062C12.8275 30.4441 13.3607 30.3225 13.904 30.2111C14.6988 30.049 15.1616 29.0969 14.9604 28.3371C14.7491 27.4761 13.9241 27.0912 13.1193 27.2533Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M44.0862 35.6506C41.8024 31.3253 37.6775 28.2156 32.8987 27.2533C32.124 27.1013 31.2286 27.4761 31.0374 28.3169C30.8664 29.0766 31.2588 30.0186 32.0938 30.1908C32.5968 30.2921 33.0999 30.4036 33.5828 30.5555C33.8444 30.6365 34.1059 30.7176 34.3675 30.8189C34.4882 30.8594 34.5989 30.91 34.7196 30.9505C35.1724 31.1126 34.4782 30.829 34.9108 31.0316C35.8766 31.4671 36.8022 32.004 37.6574 32.632C37.7177 32.6827 37.919 32.8346 37.758 32.7131C37.8686 32.8042 37.9894 32.8954 38.1 32.9967C38.2912 33.1588 38.4723 33.3209 38.6534 33.4931C39.0458 33.8678 39.4281 34.2629 39.7802 34.6681C39.8607 34.7592 39.9412 34.8605 40.0216 34.9517C40.0719 35.0125 40.2329 35.2151 40.1122 35.053C40.2933 35.286 40.4643 35.5392 40.6353 35.7823C40.9372 36.2382 41.2189 36.7142 41.4804 37.2005C41.8628 37.9197 42.8588 38.1526 43.5429 37.7475C44.2673 37.3018 44.4685 36.38 44.0862 35.6506Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M12.4443 29.7959C15.211 32.1054 17.9878 34.4149 20.7545 36.7346C21.1569 37.0689 21.5493 37.4031 21.9517 37.7273C22.6258 38.2844 23.4105 38.2945 24.0846 37.7273C26.8513 35.4178 29.628 33.1082 32.3947 30.7987C32.7971 30.4644 33.1895 30.1302 33.5919 29.806C34.2157 29.2793 34.1352 28.1954 33.5919 27.6586C32.9682 27.0305 32.0828 27.1318 31.4591 27.6586C28.6924 29.9681 25.9156 32.2776 23.1489 34.5871C22.7465 34.9214 22.3541 35.2557 21.9517 35.5798C22.666 35.5798 23.3703 35.5798 24.0846 35.5798C21.3179 33.2703 18.5411 30.9608 15.7744 28.6411C15.372 28.3068 14.9796 27.9726 14.5772 27.6484C13.9534 27.1217 13.058 27.0305 12.4443 27.6484C11.9111 28.1853 11.8105 29.2691 12.4443 29.7959Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M67.2461 14.2167C67.2662 19.2409 69.3387 25.1566 74.1176 27.4965C76.2102 28.5297 78.6751 28.7627 80.8784 27.9118C83.2125 27.0103 85.0536 25.268 86.3514 23.1307C89.2589 18.3293 89.3998 11.9983 87.1764 6.9133C85.2447 2.50696 80.7576 -1.05863 75.7776 0.288593C70.6265 1.68647 67.9503 7.20705 67.3668 12.1401C67.2863 12.8289 67.2562 13.5177 67.2461 14.2167C67.2461 15.0068 67.9403 15.7766 68.7552 15.7361C69.5802 15.6956 70.2643 15.0676 70.2643 14.2167C70.2643 13.5785 70.2945 12.9302 70.3649 12.2921C70.3649 12.2819 70.4353 11.7755 70.3951 12.0794C70.4152 11.9274 70.4454 11.7755 70.4655 11.6235C70.5158 11.3196 70.5762 11.0259 70.6466 10.722C70.7774 10.1446 70.9484 9.57736 71.1497 9.01011C71.2 8.87842 71.2503 8.73661 71.3006 8.60493C71.4615 8.16936 71.1798 8.85816 71.371 8.44285C71.4817 8.18962 71.6024 7.92625 71.7332 7.68314C71.9847 7.19692 72.2563 6.73097 72.5682 6.27514C72.6386 6.16371 72.7191 6.06242 72.7996 5.95099C73.0511 5.59646 72.6085 6.17384 72.8801 5.83957C73.0511 5.64711 73.2121 5.44452 73.3831 5.25206C73.5542 5.06972 73.7353 4.88739 73.9164 4.71519C74.0069 4.63416 74.0974 4.55312 74.1981 4.47208C74.2383 4.44169 74.5602 4.17833 74.2785 4.40118C74.6608 4.10742 75.0633 3.85418 75.4858 3.63133C75.5864 3.58069 75.6971 3.53004 75.7977 3.47939C76.1498 3.30719 75.4959 3.58069 75.8681 3.449C76.0895 3.36797 76.3007 3.28693 76.5321 3.22615C76.7535 3.16537 76.9849 3.12486 77.2062 3.07421C76.9748 3.07421 77.5684 2.99317 77.2062 3.07421C77.337 3.07421 77.4778 3.04382 77.6187 3.04382C77.8501 3.03369 78.0915 3.03369 78.3229 3.04382C78.4437 3.05395 78.5543 3.06408 78.6751 3.07421C79.0674 3.1046 78.3531 3.0033 78.7354 3.08434C79.1982 3.18563 79.6308 3.29706 80.0735 3.45913C80.4458 3.59081 79.7918 3.31732 80.1439 3.48952C80.2445 3.54017 80.3552 3.59082 80.4558 3.64146C80.6671 3.75289 80.8683 3.87444 81.0695 3.996C81.2707 4.12768 81.472 4.26949 81.6631 4.41131C81.4216 4.22898 81.5927 4.36066 81.643 4.40118C81.7637 4.5126 81.8945 4.6139 82.0152 4.72532C82.3875 5.06972 82.7295 5.45465 83.0515 5.83957C83.3231 6.16371 82.8805 5.59646 83.132 5.95099C83.2125 6.06242 83.2829 6.16371 83.3634 6.27514C83.5143 6.49799 83.6652 6.72084 83.796 6.95381C84.9127 8.8379 85.5164 11.0765 85.6371 13.2442C85.6773 13.8925 85.6773 14.5408 85.6371 15.1891C85.617 15.4829 85.5968 15.7665 85.5667 16.0603C85.5566 16.1919 85.5365 16.3236 85.5164 16.4553C85.5566 16.1919 85.4661 16.7693 85.456 16.82C85.3554 17.4176 85.2145 18.0051 85.0435 18.5926C84.9731 18.8256 84.9027 19.0586 84.8222 19.2916C84.7719 19.4334 84.7216 19.5651 84.6713 19.6967C84.6411 19.7879 84.6008 19.8791 84.5707 19.9702C84.631 19.8284 84.631 19.8386 84.5606 20.0006C84.3292 20.5071 84.0877 21.0035 83.806 21.4897C83.6954 21.6821 83.5746 21.8746 83.4439 22.0569C83.3734 22.1683 83.2929 22.2798 83.2125 22.3811C83.1622 22.452 83.1118 22.5229 83.0515 22.5938C83.1521 22.4621 83.1521 22.4621 83.0515 22.5938C82.7195 22.9787 82.3875 23.3636 82.0152 23.708C81.8643 23.8498 81.7033 23.9815 81.5524 24.1132C81.8341 23.8802 81.5223 24.1335 81.472 24.174C81.3412 24.2652 81.2104 24.3563 81.0695 24.4475C80.8683 24.5792 80.6671 24.6906 80.4558 24.802C80.3552 24.8527 80.2445 24.9033 80.1439 24.954C79.7918 25.1262 80.4458 24.8527 80.0735 24.9844C79.6308 25.1363 79.1882 25.2579 78.7354 25.3591C78.3531 25.4402 79.0674 25.3389 78.6751 25.3693C78.5543 25.3794 78.4437 25.3895 78.3229 25.3997C78.0915 25.4098 77.8501 25.4098 77.6187 25.3997C77.5281 25.3997 76.9144 25.3085 77.3269 25.3794C77.0553 25.3288 76.7937 25.2781 76.5321 25.2072C76.2706 25.1363 76.019 25.0451 75.7675 24.9438C76.1196 25.0856 75.7575 24.9337 75.6971 24.9033C75.5764 24.8425 75.4556 24.7818 75.3349 24.7109C75.1035 24.5893 74.8922 24.4475 74.6709 24.3057C74.5703 24.2348 74.4697 24.1639 74.3791 24.093C74.2484 23.9917 74.2484 23.9917 74.3993 24.1031C74.3389 24.0524 74.2685 24.0018 74.2081 23.9511C73.7956 23.5966 73.4033 23.2016 73.0511 22.7862C72.9706 22.685 72.8902 22.5837 72.8097 22.4824C73.0209 22.7457 72.6889 22.3102 72.6487 22.2595C72.4676 22.0063 72.2966 21.7429 72.1356 21.4694C71.8237 20.9528 71.5521 20.4058 71.3207 19.8487C71.4414 20.1424 71.2704 19.6967 71.2603 19.6765C71.1899 19.4942 71.1295 19.3118 71.0692 19.1295C70.9585 18.8053 70.8579 18.4711 70.7673 18.1368C70.6869 17.843 70.6164 17.5493 70.5561 17.2555C70.5259 17.1036 70.4957 16.9516 70.4655 16.7997C70.4555 16.7491 70.3649 16.1717 70.4052 16.435C70.3045 15.6956 70.2643 14.946 70.2643 14.2065C70.2643 13.4164 69.5701 12.6466 68.7552 12.6871C67.9403 12.7378 67.2461 13.3658 67.2461 14.2167Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M68.1002 27.2534C63.3214 28.2157 59.1965 31.3356 56.9127 35.6609C56.5304 36.3902 56.7316 37.312 57.456 37.7374C58.1401 38.1426 59.1361 37.9197 59.5184 37.1904C59.78 36.7042 60.0516 36.2281 60.3635 35.7723C60.5144 35.5494 60.6754 35.3165 60.8364 35.1037C60.9269 34.9822 60.7559 35.1949 60.9169 35.0024C61.0074 34.891 61.108 34.7695 61.1986 34.658C61.5406 34.263 61.8927 33.8882 62.2751 33.5337C62.4763 33.3513 62.6775 33.169 62.8787 32.9867C62.9692 32.9056 63.0699 32.8246 63.1604 32.7537C63.2409 32.6929 63.2409 32.6929 63.1503 32.7638C63.2107 32.7233 63.2711 32.6727 63.3314 32.6321C64.1866 31.994 65.1122 31.4672 66.078 31.0215C66.3195 30.9101 66.0579 31.0317 66.1987 30.9709C66.3195 30.9304 66.4301 30.8797 66.5509 30.8392C66.8326 30.7379 67.1143 30.6366 67.406 30.5556C67.899 30.4036 68.402 30.2922 68.9051 30.1909C69.6999 30.0288 70.1627 29.0767 69.9615 28.317C69.72 27.4762 68.895 27.0913 68.1002 27.2534Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M58.6437 50.8348C59.9919 50.8348 61.3501 50.8348 62.6982 50.8348C65.9478 50.8348 69.1974 50.8348 72.447 50.8348C76.3808 50.8348 80.3145 50.8348 84.2382 50.8348C87.6387 50.8348 91.0393 50.8348 94.4398 50.8348C96.0998 50.8348 97.7598 50.8855 99.4098 50.8348C99.4299 50.8348 99.4601 50.8348 99.4802 50.8348C100.295 50.8348 100.989 50.1359 100.989 49.3154C100.989 48.191 100.989 47.0768 100.989 45.9524C100.989 44.6862 101.04 43.3997 100.919 42.1437C100.486 37.4334 98.1924 33.1284 94.4599 30.2415C92.5383 28.7525 90.2445 27.6889 87.8601 27.2533C87.0854 27.1115 86.2001 27.466 85.9988 28.3169C85.8278 29.0563 86.2202 30.0389 87.0552 30.1908C88.0412 30.3732 89.0171 30.6568 89.9426 31.0519C89.6308 30.9202 90.0433 31.1025 90.0734 31.1126C90.1539 31.1532 90.2344 31.1937 90.3149 31.2241C90.5564 31.3456 90.7978 31.4672 91.0292 31.5989C91.4819 31.8521 91.9145 32.1256 92.3371 32.4193C92.4276 32.4801 92.5182 32.551 92.6087 32.6118C92.6389 32.6321 92.981 32.9056 92.7295 32.703C92.9005 32.8448 93.0715 32.9866 93.2426 33.1385C93.645 33.4931 94.0273 33.8679 94.3995 34.2629C94.5706 34.4452 94.7315 34.6276 94.8825 34.82C94.9529 34.9112 95.0233 34.9922 95.0937 35.0834C95.3754 35.4278 94.9328 34.8403 95.1843 35.205C95.4962 35.6507 95.808 36.0964 96.0797 36.5623C96.3211 36.9776 96.5425 37.4031 96.7437 37.8386C96.794 37.9399 96.8342 38.0514 96.8845 38.1526C97.0656 38.568 96.7839 37.8792 96.9449 38.2945C97.0455 38.5578 97.1361 38.8111 97.2266 39.0744C97.3876 39.5606 97.5284 40.057 97.6391 40.5635C97.6995 40.8167 97.7498 41.0699 97.79 41.3232C97.8101 41.4447 97.8302 41.5562 97.8504 41.6777C97.8806 41.8601 97.8806 41.8702 97.8504 41.698C97.8604 41.7891 97.8705 41.8904 97.8806 41.9816C98.0013 43.1769 97.961 44.3924 97.961 45.5978C97.961 46.8336 97.961 48.0694 97.961 49.3052C98.4641 48.7988 98.9671 48.2923 99.4701 47.7858C98.122 47.7858 96.7638 47.7858 95.4157 47.7858C92.1661 47.7858 88.9165 47.7858 85.6668 47.7858C81.7331 47.7858 77.7994 47.7858 73.8757 47.7858C70.4751 47.7858 67.0746 47.7858 63.6741 47.7858C62.0141 47.7858 60.3541 47.7352 58.7041 47.7858C58.684 47.7858 58.6538 47.7858 58.6337 47.7858C57.8489 47.7858 57.0843 48.4848 57.1246 49.3052C57.1749 50.1359 57.7986 50.8348 58.6437 50.8348Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M67.4072 29.7958C70.1739 32.1053 72.9506 34.4149 75.7173 36.7244C76.1198 37.0587 76.5121 37.3929 76.9146 37.7171C77.5886 38.2742 78.3734 38.2843 79.0474 37.7171C81.8141 35.4076 84.5909 33.098 87.3576 30.7784C87.76 30.4441 88.1524 30.1098 88.5548 29.7857C89.1786 29.2589 89.0981 28.1751 88.5548 27.6382C87.9311 27.0102 87.0457 27.1115 86.422 27.6382C83.6553 29.9477 80.8785 32.2573 78.1118 34.5769C77.7094 34.9112 77.317 35.2455 76.9146 35.5696C77.6289 35.5696 78.3331 35.5696 79.0474 35.5696C76.2807 33.2601 73.504 30.9506 70.7373 28.641C70.3349 28.3068 69.9425 27.9725 69.5401 27.6483C68.9163 27.1216 68.0209 27.0304 67.4072 27.6483C66.874 28.1852 66.7834 29.2691 67.4072 29.7958Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M39.7696 43.3795C39.7898 48.4038 41.8623 54.3194 46.6411 56.6593C48.7337 57.6925 51.1986 57.9255 53.4019 57.0746C55.736 56.1731 57.5771 54.4308 58.875 52.2935C61.7825 47.4921 61.9233 41.1612 59.6999 36.0761C57.7683 31.6698 53.2812 28.1042 48.3011 29.4514C43.15 30.8493 40.4739 36.3699 39.8904 41.303C39.8099 41.9918 39.7696 42.6806 39.7696 43.3795C39.7696 44.1696 40.4638 44.9395 41.2787 44.8989C42.1037 44.8584 42.7879 44.2304 42.7879 43.3795C42.7879 42.7414 42.818 42.0931 42.8885 41.4549C42.8885 41.4448 42.9589 40.9383 42.9186 41.2422C42.9388 41.0903 42.9689 40.9383 42.9891 40.7864C43.0394 40.4825 43.0997 40.1887 43.1702 39.8848C43.301 39.3075 43.472 38.7402 43.6732 38.1729C43.7235 38.0413 43.7738 37.8995 43.8241 37.7678C43.9851 37.3322 43.7034 38.021 43.8945 37.6057C44.0052 37.3525 44.1259 37.0891 44.2567 36.846C44.5082 36.3598 44.7799 35.8938 45.0918 35.438C45.1622 35.3266 45.2427 35.2253 45.3232 35.1138C45.5747 34.7593 45.132 35.3367 45.4036 35.0024C45.5747 34.81 45.7356 34.6074 45.9067 34.4149C46.0777 34.2326 46.2588 34.0502 46.4399 33.878C46.5304 33.797 46.621 33.716 46.7216 33.6349C46.7618 33.6045 47.0838 33.3412 46.8021 33.564C47.1844 33.2703 47.5868 33.017 48.0094 32.7942C48.11 32.7435 48.2206 32.6929 48.3213 32.6422C48.6734 32.47 48.0194 32.7435 48.3917 32.6118C48.613 32.5308 48.8243 32.4498 49.0557 32.389C49.277 32.3282 49.5084 32.2877 49.7298 32.2371C49.4984 32.2371 50.0919 32.156 49.7298 32.2371C49.8605 32.2371 50.0014 32.2067 50.1422 32.2067C50.3736 32.1965 50.6151 32.1965 50.8465 32.2067C50.9672 32.2168 51.0779 32.2269 51.1986 32.2371C51.591 32.2674 50.8767 32.1661 51.259 32.2472C51.7218 32.3485 52.1544 32.4599 52.5971 32.622C52.9693 32.7537 52.3154 32.4802 52.6675 32.6524C52.7681 32.703 52.8788 32.7537 52.9794 32.8043C53.1906 32.9157 53.3919 33.0373 53.5931 33.1588C53.7943 33.2905 53.9955 33.4323 54.1867 33.5741C53.9452 33.3918 54.1162 33.5235 54.1665 33.564C54.2873 33.6754 54.418 33.7767 54.5388 33.8882C54.911 34.2326 55.2531 34.6175 55.575 35.0024C55.8467 35.3266 55.404 34.7593 55.6555 35.1138C55.736 35.2253 55.8064 35.3266 55.8869 35.438C56.0378 35.6608 56.1887 35.8837 56.3195 36.1167C57.4363 38.0007 58.0399 40.2394 58.1606 42.4071C58.2009 43.0554 58.2009 43.7037 58.1606 44.352C58.1405 44.6457 58.1204 44.9293 58.0902 45.2231C58.0802 45.3548 58.06 45.4865 58.0399 45.6181C58.0802 45.3548 57.9896 45.9322 57.9795 45.9828C57.8789 46.5804 57.7381 47.168 57.5671 47.7555C57.4966 47.9885 57.4262 48.2214 57.3457 48.4544C57.2954 48.5962 57.2451 48.7279 57.1948 48.8596C57.1646 48.9508 57.1244 49.0419 57.0942 49.1331C57.1546 48.9913 57.1546 49.0014 57.0841 49.1635C56.8527 49.67 56.6113 50.1663 56.3296 50.6525C56.2189 50.845 56.0982 51.0374 55.9674 51.2198C55.897 51.3312 55.8165 51.4426 55.736 51.5439C55.6857 51.6148 55.6354 51.6857 55.575 51.7566C55.6756 51.6249 55.6756 51.6249 55.575 51.7566C55.243 52.1416 54.911 52.5265 54.5388 52.8709C54.3879 53.0127 54.2269 53.1444 54.076 53.2761C54.3577 53.0431 54.0458 53.2963 53.9955 53.3368C53.8647 53.428 53.7339 53.5192 53.5931 53.6103C53.3919 53.742 53.1906 53.8534 52.9794 53.9649C52.8788 54.0155 52.7681 54.0662 52.6675 54.1168C52.3154 54.289 52.9693 54.0155 52.5971 54.1472C52.1544 54.2991 51.7117 54.4207 51.259 54.522C50.8767 54.603 51.591 54.5017 51.1986 54.5321C51.0779 54.5423 50.9672 54.5524 50.8465 54.5625C50.6151 54.5726 50.3736 54.5726 50.1422 54.5625C50.0517 54.5625 49.438 54.4713 49.8505 54.5422C49.5788 54.4916 49.3173 54.441 49.0557 54.37C48.7941 54.2991 48.5426 54.208 48.2911 54.1067C48.6432 54.2485 48.281 54.0965 48.2206 54.0662C48.0999 54.0054 47.9792 53.9446 47.8585 53.8737C47.6271 53.7521 47.4158 53.6103 47.1945 53.4685C47.0938 53.3976 46.9932 53.3267 46.9027 53.2558C46.7719 53.1545 46.7719 53.1545 46.9228 53.2659C46.8624 53.2153 46.792 53.1646 46.7317 53.114C46.3192 52.7595 45.9268 52.3644 45.5747 51.9491C45.4942 51.8478 45.4137 51.7465 45.3332 51.6452C45.5445 51.9086 45.2125 51.473 45.1722 51.4224C44.9912 51.1691 44.8201 50.9058 44.6591 50.6323C44.3473 50.1157 44.0756 49.5687 43.8442 49.0115C43.965 49.3053 43.7939 48.8596 43.7839 48.8393C43.7134 48.657 43.6531 48.4747 43.5927 48.2923C43.482 47.9682 43.3814 47.6339 43.2909 47.2996C43.2104 47.0059 43.14 46.7121 43.0796 46.4184C43.0494 46.2664 43.0193 46.1145 42.9891 45.9625C42.979 45.9119 42.8885 45.3345 42.9287 45.5979C42.8281 44.8584 42.7879 44.1088 42.7879 43.3694C42.7879 42.5793 42.0937 41.8094 41.2787 41.85C40.4638 41.8905 39.7596 42.5286 39.7696 43.3795Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M59.5888 59.3436C60.0818 59.4348 60.5748 59.5563 61.0577 59.6981C61.3193 59.7792 61.5808 59.8602 61.8324 59.9514C61.9128 59.9818 62.0034 60.0122 62.0839 60.0425C62.1342 60.0628 62.6473 60.2857 62.3455 60.1438C63.2509 60.549 64.1061 61.0352 64.9109 61.6025C65.0216 61.6835 65.1323 61.7646 65.2329 61.8456C65.585 62.109 65.0116 61.6531 65.3536 61.9368C65.5246 62.0786 65.6957 62.2204 65.8667 62.3723C66.2691 62.7269 66.6514 63.1118 67.0136 63.5068C67.1645 63.6689 67.3155 63.8411 67.4563 64.0133C67.5469 64.1146 67.6273 64.226 67.7078 64.3273C67.5066 64.064 67.7783 64.4286 67.7984 64.4489C68.0901 64.8541 68.3618 65.2694 68.6133 65.7049C68.8648 66.1405 69.0962 66.5862 69.3075 67.042C69.3678 67.1636 69.4181 67.2953 69.4785 67.4168C69.3678 67.1535 69.4785 67.4371 69.5087 67.4979C69.6194 67.7815 69.72 68.0651 69.8105 68.3487C69.9614 68.8147 70.0922 69.2908 70.1928 69.7669C70.2532 70.0201 70.2934 70.2734 70.3437 70.5367C70.3639 70.6785 70.394 70.8203 70.4041 70.9622C70.3639 70.6887 70.4142 71.0533 70.4142 71.1242C70.5349 72.3195 70.4946 73.5351 70.4946 74.7405C70.4946 75.9763 70.4946 77.2121 70.4946 78.4479C70.9977 77.9414 71.5007 77.4349 72.0038 76.9284C70.5751 76.9284 69.1465 76.9284 67.7179 76.9284C64.2972 76.9284 60.8867 76.9284 57.466 76.9284C53.321 76.9284 49.1659 76.9284 45.0209 76.9284C41.4493 76.9284 37.8677 76.9284 34.2962 76.9284C32.5557 76.9284 30.785 76.8272 29.0545 76.9284C29.0344 76.9284 29.0042 76.9284 28.9841 76.9284C29.4871 77.4349 29.9902 77.9414 30.4932 78.4479C30.4932 76.3004 30.4127 74.1428 30.5133 71.9954C30.5234 71.7016 30.5435 71.418 30.5737 71.1242C30.5838 71.0331 30.5938 70.9318 30.6039 70.8406C30.5636 71.1749 30.624 70.7089 30.624 70.6785C30.7145 70.1214 30.8353 69.5643 30.9761 69.0173C31.1069 68.5513 31.2578 68.0854 31.4289 67.6296C31.4691 67.5181 31.5093 67.4168 31.5597 67.3054C31.4389 67.6093 31.61 67.194 31.62 67.1636C31.7307 66.9104 31.8514 66.6672 31.9721 66.4241C32.2035 65.9784 32.4551 65.5429 32.7267 65.1276C32.8474 64.9351 32.9782 64.7528 33.109 64.5704C33.1895 64.459 33.27 64.3476 33.3505 64.2463C33.1593 64.4995 33.5014 64.064 33.5315 64.0234C34.1654 63.2536 34.8696 62.5851 35.6242 61.9368C35.9562 61.6531 35.3827 62.109 35.7449 61.8456C35.8757 61.7544 35.9964 61.6633 36.1272 61.5721C36.3687 61.3999 36.6101 61.248 36.8516 61.0859C37.3144 60.8023 37.7872 60.549 38.2702 60.316C38.3909 60.2553 38.5116 60.2046 38.6424 60.1438C38.3406 60.2755 38.8537 60.0628 38.904 60.0425C39.1555 59.9412 39.4171 59.8501 39.6787 59.769C40.2421 59.5867 40.8256 59.4449 41.4091 59.3335C42.214 59.1815 42.6667 58.2091 42.4655 57.4595C42.2341 56.6188 41.4091 56.244 40.6042 56.3959C36.1675 57.2468 32.2538 60.0729 29.8996 63.9424C28.7225 65.8771 27.9579 68.0651 27.646 70.3037C27.4549 71.7219 27.4649 73.1299 27.4649 74.5581C27.4649 75.8547 27.4649 77.1513 27.4649 78.458C27.4649 79.2785 28.1591 79.9774 28.974 79.9774C30.4027 79.9774 31.8313 79.9774 33.2599 79.9774C36.6806 79.9774 40.0911 79.9774 43.5118 79.9774C47.6568 79.9774 51.8119 79.9774 55.9569 79.9774C59.5285 79.9774 63.1101 79.9774 66.6816 79.9774C68.4221 79.9774 70.1828 80.0281 71.9233 79.9774C71.9434 79.9774 71.9736 79.9774 71.9937 79.9774C72.8086 79.9774 73.5028 79.2785 73.5028 78.458C73.5028 77.3539 73.5028 76.2498 73.5028 75.1457C73.5028 73.9099 73.5531 72.6538 73.4525 71.4281C73.0702 66.8395 70.8971 62.4736 67.2853 59.6171C65.2631 58.0166 62.9189 56.8821 60.3836 56.3959C59.6089 56.244 58.7135 56.6086 58.5224 57.4595C58.3715 58.2192 58.7638 59.1815 59.5888 59.3436Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M39.9303 58.9589C42.697 61.2684 45.4738 63.5779 48.2405 65.8875C48.6429 66.2218 49.0353 66.556 49.4377 66.8802C50.1118 67.4373 50.8965 67.4474 51.5706 66.8802C54.3373 64.5706 57.1141 62.2611 59.8808 59.9414C60.2832 59.6072 60.6756 59.2729 61.078 58.9488C61.7017 58.422 61.6213 57.3382 61.078 56.8013C60.4542 56.1733 59.5689 56.2746 58.9451 56.8013C56.1784 59.1108 53.4017 61.4204 50.635 63.74C50.2325 64.0743 49.8402 64.4086 49.4377 64.7327C50.152 64.7327 50.8563 64.7327 51.5706 64.7327C48.8039 62.4232 46.0271 60.1137 43.2604 57.8041C42.858 57.4698 42.4656 57.1356 42.0632 56.8114C41.4395 56.2847 40.5441 56.1935 39.9303 56.8114C39.3871 57.3483 39.2965 58.4321 39.9303 58.9589Z"
                                                            fill="currentcolor" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <h4 class="tp-funfact-2-number"><i class="purecounter"
                                                    data-purecounter-duration="1"
                                                    data-purecounter-end="{{ $config->utilisateur ?? ' ' }}">0</i>+</h4>
                                            <span>Utilisateurs</span>
                                        </div>
                                        <div class="tp-funfact-2-item text-center tp-funfact-style-theme mb-30">
                                            <div class="tp-funfact-2-icon">
                                                <span>
                                                    <svg width="90" height="80" viewBox="0 0 90 80"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M51.6642 53.8373C54.4033 51.7593 56.1979 48.548 56.1979 44.8644C56.1979 38.6307 51.192 33.6248 44.9582 33.6248C38.7244 33.6248 33.7185 38.6307 33.7185 44.8644C33.7185 48.548 35.5131 51.7593 38.2522 53.8373C33.0574 55.0651 28.996 59.4099 28.3348 64.888L27.2959 73.672C27.0125 75.9388 28.5237 78.0167 30.6961 78.489C35.2297 79.4335 40.0467 80.0002 44.9582 80.0002C49.8696 80.0002 54.5922 79.5279 59.2203 78.489C61.3927 78.0167 62.9039 75.8443 62.6205 73.672L61.5816 64.888C60.826 59.4099 56.859 55.0651 51.6642 53.8373ZM44.8637 37.9695C48.6418 37.9695 51.7587 41.0864 51.7587 44.8644C51.7587 48.6425 48.6418 51.7593 44.8637 51.7593C41.0857 51.7593 37.9688 48.6425 37.9688 44.8644C38.0633 41.0864 41.0857 37.9695 44.8637 37.9695ZM31.5462 74.1442L32.5851 65.3603C33.1518 61.0155 36.741 57.8042 41.0857 57.8042H48.6418C52.9865 57.8042 56.6701 61.0155 57.1424 65.3603L58.1813 74.1442C49.6807 76.0333 40.1412 76.0333 31.5462 74.1442Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M82.0779 37.2137C78.4888 37.2137 75.4663 39.6694 74.7107 42.9752H63.8489C63.4711 39.1027 61.9599 35.608 59.5986 32.68L67.2491 25.0295C68.3825 25.6907 69.7048 26.1629 71.1216 26.1629C75.3719 26.1629 78.7721 22.7627 78.7721 18.5124C78.7721 14.2621 75.3719 10.8619 71.1216 10.8619C66.8713 10.8619 63.4711 14.2621 63.4711 18.5124C63.4711 19.9292 63.8489 21.2515 64.6045 22.3849L56.954 30.0354C54.1204 27.6741 50.6257 26.1629 46.7532 25.7851V15.0177C50.059 14.1677 52.5148 11.2397 52.5148 7.65053C52.5148 3.40024 49.1145 0 44.8642 0C40.6139 0 37.2137 3.40024 37.2137 7.65053C37.2137 11.2397 39.6694 14.1677 42.9752 15.0177V25.8796C39.1027 26.2574 35.608 27.7686 32.7745 30.1299L25.124 22.4793C25.7851 21.3459 26.2574 20.0236 26.2574 18.6068C26.2574 14.3566 22.8571 10.9563 18.6068 10.9563C14.3566 10.9563 10.9563 14.3566 10.9563 18.6068C10.9563 22.8571 14.3566 26.2574 18.6068 26.2574C20.0236 26.2574 21.3459 25.8796 22.4793 25.124L30.1299 32.7745C27.7686 35.608 26.2574 39.1027 25.8796 42.9752H15.0177C14.1676 39.6694 11.2397 37.2137 7.65053 37.2137C3.40024 37.2137 0 40.6139 0 44.8642C0 49.1145 3.40024 52.5148 7.65053 52.5148C11.2397 52.5148 14.2621 50.059 15.0177 46.7532H25.7851C25.8796 48.17 26.1629 49.5868 26.6352 50.9091C26.9185 51.6647 27.5797 52.137 28.4297 52.137C28.6187 52.137 28.8076 52.137 28.9965 52.0425C29.941 51.6647 30.5077 50.6257 30.1299 49.6812C29.6576 48.17 29.3743 46.5643 29.3743 44.9587C29.3743 36.4581 36.2692 29.4687 44.8642 29.4687C53.4593 29.4687 60.3542 36.3636 60.3542 44.9587C60.3542 46.5643 60.0708 48.17 59.5986 49.6812C59.2208 50.6257 59.7875 51.6647 60.732 52.0425C61.6765 52.3259 62.7155 51.8536 63.0933 50.9091C63.5655 49.5868 63.7544 48.2645 63.9433 46.8477H74.7107C75.5608 50.1535 78.4888 52.6092 82.0779 52.6092C86.3282 52.6092 89.7284 49.209 89.7284 44.9587C89.7284 40.6139 86.3282 37.2137 82.0779 37.2137ZM7.65053 48.7367C5.47816 48.7367 3.68359 46.9421 3.68359 44.7698C3.68359 42.5974 5.47816 40.8028 7.65053 40.8028C9.8229 40.8028 11.6175 42.5974 11.6175 44.7698C11.6175 46.9421 9.8229 48.7367 7.65053 48.7367ZM71.2161 14.6399C73.3884 14.6399 75.183 16.4345 75.183 18.6068C75.183 20.7792 73.3884 22.5738 71.2161 22.5738C69.0437 22.5738 67.2491 20.7792 67.2491 18.6068C67.2491 16.4345 69.0437 14.6399 71.2161 14.6399ZM40.9917 7.65053C40.9917 5.47816 42.7863 3.68359 44.9587 3.68359C47.131 3.68359 48.9256 5.47816 48.9256 7.65053C48.9256 9.8229 47.131 11.6175 44.9587 11.6175C42.6918 11.523 40.9917 9.8229 40.9917 7.65053ZM18.6068 22.3849C16.4345 22.3849 14.6399 20.5903 14.6399 18.4179C14.6399 16.2456 16.4345 14.451 18.6068 14.451C20.7792 14.451 22.5738 16.2456 22.5738 18.4179C22.5738 20.5903 20.7792 22.3849 18.6068 22.3849ZM82.0779 48.8312C79.9055 48.8312 78.111 47.0366 78.111 44.8642C78.111 42.6919 79.9055 40.8973 82.0779 40.8973C84.2503 40.8973 86.0449 42.6919 86.0449 44.8642C86.0449 47.0366 84.2503 48.8312 82.0779 48.8312Z"
                                                            fill="currentcolor" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <h4 class="tp-funfact-2-number"><i class="purecounter"
                                                    data-purecounter-duration="1"
                                                    data-purecounter-end="{{ $config->annee ?? ' ' }}">0</i>+</h4>
                                            <span>Années d'expériences</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- choose area end -->

        <!-- project area start -->
        <div class="tp-project-2-area fix pb-130">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row justify-content-center">
                            <div class="col-xl-5">
                                <div class="tp-service-4-title-box text-center mb-55">
                                    <span class="tp-section-subtitle">
                                        {{ \App\Helpers\TranslationHelper::TranslateText('Galleries') }}</span>
                                    </span>
                                    {{-- <h4 class="tp-section-title">Our Awesome & Best
                           Services</h4> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-project-2-wrapper">
                            <div class="swiper-container tp-project-2-active">
                                <div class="swiper-wrapper">
                                    @if ($galleries->isEmpty())
                                    <div class="alert alert-info">
                                        <p>Aucune gallerie n'est disponible pour le moment.</p>
                                    </div>
                                @else
                                    @foreach ($galleries as $gallery)
                                        <div class="swiper-slide">
                                            <div class="tp-project-2-item p-relative">





                                                <div class="tp-project-2-thumb">
                                                    <img src="{{ url('public/Image/' . $gallery->image) }}"
                                                        alt="" width="300" height="300">
                                                </div>
                                                <div class="tp-project-2-content z-index">
                                                    {{--   <span>Garde</span> --}}
                                                    <h4 class="tp-project-2-title"><a class="text-anim"
                                                            href="#">{{ $gallery->titre ?? '' }}</a></h4>
                                                </div>
                                                <div class="tp-project-2-button">
                                                    <a class="tp-btn-project" data-bs-toggle="modal"
                                                        data-bs-target="#galleryModal" data-title="{{ $gallery->titre }}"
                                                        data-description="{{ $gallery->description }}"
                                                        data-image="{{ url('public/Image/' . $gallery->image) }}"
                                                        href="#"><span>Voir plus</span>
                                                        <i>
                                                            <svg width="15" height="10" viewBox="0 0 15 10"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M14.1543 4.99974L9.5111 9.644L8.7559 8.88987L12.1127 5.53307H0.0668316V4.4664H12.1127L8.7559 1.11067L9.5111 0.355469L14.1543 4.99974Z"
                                                                    fill="currentcolor" />
                                                            </svg>
                                                        </i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @endif
                                


                                </div>
                                <div class="tp-slider-dots mt-40 text-center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalLabel">Détails</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img id="modal-image" src="" alt="" class="img-fluid mb-4" />
                        </div>
                        <h4 id="modal-title"></h4>
                        <p id="modal-description"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var galleryModal = document.getElementById('galleryModal');
                galleryModal.addEventListener('show.bs.modal', function(event) {
                    // Récupère le bouton qui déclenche le modal
                    var button = event.relatedTarget;

                    // Récupère les données
                    var title = button.getAttribute('data-title');
                    var description = button.getAttribute('data-description');
                    var image = button.getAttribute('data-image');

                    // Met à jour les éléments du modal
                    var modalTitle = galleryModal.querySelector('#modal-title');
                    var modalDescription = galleryModal.querySelector('#modal-description');
                    var modalImage = galleryModal.querySelector('#modal-image');

                    modalTitle.textContent = title;
                    modalDescription.textContent = description;
                    modalImage.src = image;
                });
            });
        </script>
        <!-- project area end -->

        <!-- contact area start -->
        <div class="tp-contact-area tp-contact-2-style-2 tp-contact-style-3 theme-bg-2 p-relative">
            <div class="tp-contact-shape-1 ">
                <img src="{{ url('public/Image/parametres/' . $config->imagecontact) }}" width="500" height="405"
                    alt="logo">
            </div>


            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="tp-contact-3-left">
                            <div class="tp-contact-3-title-box mb-20">
                                <span class="tp-section-subtitle">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Nous contactez') }}
                                </span>
                                <h4 class="tp-section-title"></h4>
                            </div>


                            <div class="tp-contact-3-text mb-25" style="text-align: justify">
                                <p> {{ $config->des_contact ?? ' ' }}</p>
                            </div>

                            <div class="tp-contact-2-box p-relative mb-25">
                                <div class="tp-contact-2-icon">
                                    <span>
                                        <svg width="13" height="18" viewBox="0 0 13 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.40889 5.57171C1.18267 4.00171 2.23598 2.58796 3.84505 2.06921C4.13074 1.97717 4.43904 2.00332 4.70704 2.14234C4.97504 2.28137 5.18256 2.52278 5.28727 2.81734L5.80324 4.26734C5.88619 4.50058 5.90107 4.75459 5.84595 4.99679C5.79083 5.239 5.66824 5.45835 5.49389 5.62671L3.95905 7.10859C3.88335 7.18179 3.82695 7.27437 3.79532 7.37732C3.76368 7.48027 3.75791 7.59009 3.77855 7.69609L3.7922 7.76109L3.8302 7.92421C3.86405 8.06171 3.91511 8.25546 3.98695 8.48671C4.12945 8.94609 4.35686 9.56359 4.6953 10.1805C5.03374 10.7973 5.42799 11.3136 5.73436 11.673C5.89392 11.8601 6.06071 12.0402 6.2343 12.213L6.2818 12.2592C6.35857 12.3308 6.45164 12.3802 6.55195 12.4027C6.65226 12.4251 6.75638 12.4198 6.85417 12.3873L8.84086 11.7292C9.06658 11.6545 9.30836 11.6525 9.53517 11.7235C9.76199 11.7944 9.9635 11.935 10.1139 12.1273L11.0538 13.3286C11.4456 13.8286 11.3993 14.5636 10.9487 15.0055C9.71724 16.2136 8.02386 16.4617 6.84586 15.4642C5.40195 14.2383 4.18468 12.7432 3.25486 11.0536C2.31736 9.36505 1.69107 7.50479 1.40889 5.57171ZM5.02245 7.77796L6.29664 6.54796C6.64534 6.21123 6.89052 5.77253 7.00076 5.28813C7.11099 4.80372 7.08124 4.2957 6.91533 3.82921L6.39877 2.37921C6.18803 1.78679 5.77059 1.30127 5.23153 1.02163C4.69248 0.741979 4.0724 0.689259 3.4977 0.874212C1.49973 1.51796 -0.104579 3.40359 0.235047 5.75921C0.539639 7.84797 1.21587 9.85749 2.22827 11.6823C3.23115 13.5044 4.54403 15.1167 6.1013 16.4386C7.8677 17.9323 10.2273 17.423 11.7585 15.9198C12.1967 15.49 12.4626 14.9004 12.502 14.2712C12.5414 13.6421 12.3513 13.0209 11.9705 12.5342L11.0306 11.333C10.7298 10.9482 10.3267 10.6669 9.87297 10.525C9.41922 10.3831 8.93555 10.3872 8.48402 10.5367L6.83517 11.083C6.76137 11.0031 6.68911 10.9216 6.61845 10.8386C6.27959 10.444 5.97978 10.014 5.72367 9.55546C5.47435 9.09262 5.27043 8.60427 5.11508 8.09796C5.08214 7.99197 5.05125 7.88528 5.02245 7.77796Z"
                                                fill="currentcolor" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="tp-contact-2-text">
                                    <span>
                                        {{ \App\Helpers\TranslationHelper::TranslateText('Téléphone') }}:</span>
                                    <a class="text-anim-2" href="#">{{ $config->telephone }}</a>
                                </div>
                            </div>
                            <div class="tp-contact-2-box p-relative mb-25">
                                <div class="tp-contact-2-icon">
                                    <span>
                                        <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.3327 1.99967C17.3327 1.08301 16.5827 0.333008 15.666 0.333008H2.33268C1.41602 0.333008 0.666016 1.08301 0.666016 1.99967V11.9997C0.666016 12.9163 1.41602 13.6663 2.33268 13.6663H15.666C16.5827 13.6663 17.3327 12.9163 17.3327 11.9997V1.99967ZM15.666 1.99967L8.99935 6.16634L2.33268 1.99967H15.666ZM15.666 11.9997H2.33268V3.66634L8.99935 7.83301L15.666 3.66634V11.9997Z"
                                                fill="currentcolor" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="tp-contact-2-text">
                                    <span>Email:</span>
                                    <a class="text-anim-2" href="#">{{ $config->email }}</a>
                                </div>
                            </div>
                            <div class="tp-contact-2-box location p-relative">
                                <div class="tp-contact-2-icon">
                                    <span>
                                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
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
                                    <a class="text-anim-2" href="#" target="_blank">{{ $config->addresse }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="tp-contact-wrap">
                            <h4 class="tp-contact-title"></h4>
                            <form method="post" action="{{ route('contacts.store') }}">
                                @csrf
                                <div class="row gx-30">
                                    <div class="col-md-12 mb-20">
                                        <div class="tp-contact-input-box p-relative">
                                            <input name="name" type="text" value="{{ old('name') }}" required
                                                placeholder="Votre nom">
                                            <span class="tp-contact-icon">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M7.877 12.5853L7.99611 12.5853L8.26007 12.5861C10.502 12.5982 15.754 12.8041 15.754 16.3045C15.754 19.55 11.4406 19.9837 8.0854 20L7.49393 19.9997C5.25199 19.9876 0 19.7818 0 16.2823C0 12.9682 4.495 12.5853 7.877 12.5853ZM7.877 14.1009C3.646 14.1009 1.5 14.8354 1.5 16.2823C1.5 17.7433 3.646 18.4849 7.877 18.4849C12.108 18.4849 14.254 17.7504 14.254 16.3045C14.254 14.8415 12.108 14.1009 7.877 14.1009ZM17.2041 5.98014C17.6181 5.98014 17.9541 6.31963 17.9541 6.73793L17.954 8.00525L19.25 8.00606C19.664 8.00606 20 8.34555 20 8.76385C20 9.18215 19.664 9.52163 19.25 9.52163L17.954 9.52082L17.9541 10.7906C17.9541 11.2089 17.6181 11.5484 17.2041 11.5484C16.7901 11.5484 16.4541 11.2089 16.4541 10.7906L16.454 9.52082L15.16 9.52163C14.746 9.52163 14.41 9.18215 14.41 8.76385C14.41 8.34555 14.746 8.00606 15.16 8.00606L16.454 8.00525L16.4541 6.73793C16.4541 6.31963 16.7901 5.98014 17.2041 5.98014ZM7.877 0C10.81 0 13.195 2.41077 13.195 5.37321C13.195 8.33565 10.81 10.7464 7.877 10.7464H7.846C6.427 10.7414 5.097 10.1786 4.1 9.16416C3.102 8.14873 2.555 6.80088 2.55997 5.37018C2.55997 2.41077 4.945 0 7.877 0ZM7.877 1.51557C5.773 1.51557 4.05997 3.24636 4.05997 5.37321C4.056 6.40279 4.448 7.3677 5.163 8.09619C5.879 8.82366 6.833 9.2268 7.849 9.23084L7.877 9.97954V9.23084C9.982 9.23084 11.695 7.50006 11.695 5.37321C11.695 3.24636 9.982 1.51557 7.877 1.51557Z"
                                                        fill="currentcolor" />
                                                </svg>
                                            </span>
                                        </div>
                                        @error('nom')
                                            <span class="small text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-20">
                                        <div class="tp-contact-input-box p-relative">
                                            <input name="email" type="email" value="{{ old('email') }}" required
                                                placeholder="Votre Email">
                                            <span class="tp-contact-icon">
                                                <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.3327 1.99992C17.3327 1.08325 16.5827 0.333252 15.666 0.333252H2.33268C1.41602 0.333252 0.666016 1.08325 0.666016 1.99992V11.9999C0.666016 12.9166 1.41602 13.6666 2.33268 13.6666H15.666C16.5827 13.6666 17.3327 12.9166 17.3327 11.9999V1.99992ZM15.666 1.99992L8.99935 6.16658L2.33268 1.99992H15.666ZM15.666 11.9999H2.33268V3.66659L8.99935 7.83325L15.666 3.66659V11.9999Z"
                                                        fill="currentcolor" />
                                                </svg>
                                            </span>
                                        </div>
                                        @error('email')
                                            <span class="small text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-50">
                                        <div class="tp-contact-input-box p-relative">
                                            <textarea name="message" rows="12" cols="35">
                                            {{ \App\Helpers\TranslationHelper::TranslateText('Laissez votre message') }}.</textarea><br>

                                            <span class="tp-contact-icon">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18.3243 3.33341C18.3243 2.41675 17.5827 1.66675 16.666 1.66675H3.33268C2.41602 1.66675 1.66602 2.41675 1.66602 3.33341V13.3334C1.66602 14.2501 2.41602 15.0001 3.33268 15.0001H14.9993L18.3327 18.3334L18.3243 3.33341ZM16.666 3.33341V14.3084L15.691 13.3334H3.33268V3.33341H16.666ZM4.99935 10.0001H14.9993V11.6667H4.99935V10.0001ZM4.99935 7.50008H14.9993V9.16675H4.99935V7.50008ZM4.99935 5.00008H14.9993V6.66675H4.99935V5.00008Z"
                                                        fill="currentcolor" />
                                                </svg>
                                            </span>
                                        </div>
                                        @error('message')
                                            <span class="small text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="tp-btn-theme" type="submit">
                                    <span>
                                        {{ \App\Helpers\TranslationHelper::TranslateText('Envoyer') }}
                                    </span>
                                </button>
                                <p class="ajax-response"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact area end -->

        <!-- testimonial area strat -->
        <div class="tp-testimonial-area tp-testimonial-style-2 pt-135 pb-150 fix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-testimonial-title-box text-center mb-45">
                            <h4 class="tp-section-title">
                                {{ \App\Helpers\TranslationHelper::TranslateText('Ce que pensent nos clients') }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-testimonial-wrapper">
                            <div class="swiper-container tp-testimonial-3-active">
                                <div class="swiper-wrapper">
                       

                                    @if ($testimonials->isEmpty())
                                    <div class="alert alert-info">
                                        <p> {{ \App\Helpers\TranslationHelper::TranslateText('Aucun témoignage disponible.') }}</p>
                                    </div>
                                @else
                                        @foreach ($testimonials as $testimonial)
                                            <div class="swiper-slide">
                                                <div class="tp-testimonial-item text-center">
                                                    <div class="tp-testimonial-avatar">
                                                        <img src="assets/img/testimonial/testi-3-1.png" alt="">
                                                    </div>
                                                    <div class="tp-testimonial-author-info">
                                                        <p class="pb-5">{{ $testimonial->message }}
                                                        </p>
                                                        <h4 class="tp-testimonial-title">{{ $testimonial->name }}</h4>
                                                        {{-- <span>CEO Manager</span> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    @endif

                                </div>
                                <div class="tp-slider-dots text-center mt-40"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-30">
                    <button type="button" class="tp-btn-theme"{{-- class="btn btn-primary" --}} data-bs-toggle="modal"
                        data-bs-target="#exampleModal">

                        {{ \App\Helpers\TranslationHelper::TranslateText('Laissez un témoignage') }}
                    </button>
                </div>

                <div id="successMessage" class="alert alert-success" style="display:none;"></div>
                <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>


                <!-- Button trigger modal -->

            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Témoignage</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>



                    <div class="modal-body">
                        <form id="testimonialForm" action="{{ route('testimonial.store') }}" method="POST"
                            class="testimonial-form p-4 rounded shadow-sm bg-light">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="name" class="form-label text-muted">Nom</label>
                                <input type="text" class="form-control border-0 rounded-pill shadow-sm" id="name"
                                    name="name" placeholder="Votre nom" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="testimonial" class="form-label text-muted">Message</label>
                                <textarea class="form-control border-0 rounded-3 shadow-sm" id="testimonial" name="message" rows="8"
                                    placeholder="Votre message" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="tp-btn-theme">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Envoyer') }}
                                </button>
                            </div>
                        </form>

                        @if ($errors->any())
                            <div class="alert alert-danger mt-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif


                    </div>



                </div>
            </div>
        </div>







        <!-- testimonial area end -->

        <!-- work area start -->

        <!-- project area start -->
        <div class="tp-project-2-area fix pb-130">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-project-2-wrapper">
                            <div class="swiper-container tp-project-2-active">
                                <div class="swiper-wrapper">
                                    @php

                                        $products = DB::table('products')->latest()->take(15)->get();

                                    @endphp
                                    @if ($products)
                                        @foreach ($products as $product)
                                            <div class="swiper-slide">
                                                <div class="tp-project-2-item p-relative">
                                                    <div class="tp-project-2-thumb">
                                                        <img src="{{ url('public/Image/' . $product->image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="tp-project-2-content z-index">
                                                        {{-- <span>Gardening</span> --}}
                                                        <h4 class="tp-project-2-title"><a class="text-anim"
                                                                href="{{ route('details-produits', ['id' => $product->id, 'slug' => Str::slug(Str::limit($product->name, 10))]) }}">{{ $product->name ?? ' ' }}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="tp-project-2-button">
                                                        <a class="tp-btn-project"
                                                            href="{{ route('details-produits', ['id' => $product->id, 'slug' => Str::slug(Str::limit($product->name, 20))]) }}"><span>
                                                                Voir détails</span>
                                                            <i>
                                                                <svg width="15" height="10" viewBox="0 0 15 10"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M14.1543 4.99974L9.5111 9.644L8.7559 8.88987L12.1127 5.53307H0.0668316V4.4664H12.1127L8.7559 1.11067L9.5111 0.355469L14.1543 4.99974Z"
                                                                        fill="currentcolor" />
                                                                </svg>
                                                            </i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    @endif

                                </div>
                                <div class="tp-slider-dots mt-40 text-center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- project area end -->


        <!-- faq area end -->

        <!-- service area start -->
        <div class="tp-service-3-area tp-service-3-inner-style  fix pt-105 pb-100 p-relative">
            {{--   <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="tp-testimonial-title-box text-center mb-60">
                        <span class="tp-section-subtitle">Nos services</span>
                  
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($services as $service)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="tp-service-3-item text-center mb-30 p-relative">
                        <div class="tp-service-3-icon pb-20">
                            <span>
                                <style>
                                    .tp-service-thumb {
                                        height: 100;
                                        width: 100;
                                        overflow: hidden;
                                        border-radius: 10%;

                                    }

                                </style>
                                <div class="tp-service-thumb">
                                    <img src="{{ url('public/Image/Services/' . $service->image) }}" width="200" height="200" border-radius="8" class="rounded shadow" alt="">
                                </div>
                            </span>
                        </div>
                        <div class="tp-service-3-content">
                            <h4 class="tp-service-3-title mb-20"><a class="text-anim-3" href="#">{{ $service->title }}</a></h4>



                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal" data-title="{{ $service->title }}" data-body="{{ $service->body }}" data-image="{{ url('public/Image/Services/' . $service->image) }}">
                                Voir détails
                            </button>


                        </div>
                    </div>
                </div>
                @endforeach
 --}}
            <!-- Modal Structure -->
            <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="serviceModalLabel">Détails sur le service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4 id="modal-service-title"></h4>
                            <p id="modal-service-body"></p>
                            <img id="modal-service-image" src="" alt="" class="img-fluid">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var serviceModal = document.getElementById('serviceModal');
                    serviceModal.addEventListener('show.bs.modal', function(event) {
                        var button = event.relatedTarget;
                        var title = button.getAttribute('data-title');
                        var body = button.getAttribute('data-body');
                        var image = button.getAttribute('data-image');

                        var modalTitle = serviceModal.querySelector('#modal-service-title');
                        var modalBody = serviceModal.querySelector('#modal-service-body');
                        var modalImage = serviceModal.querySelector('#modal-service-image');

                        modalTitle.textContent = title;
                        modalBody.textContent = body;
                        modalImage.src = image;
                    });
                });
            </script>






        </div>
        </div>
        </div>

        <!-- brand area start -->
        <div class="tp-brand-area pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-brand-wrap">
                            <div class="swiper-container tp-brand-active">

                                <div class="swiper-wrapper">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand area end -->




        <!-- blog area start -->
        <div class="tp-blog-area pt-140 pb-130 fix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-blog-title-box text-center mb-60">
                            <span class="tp-section-subtitle">Les actualités</span>
                            <h4 class="tp-section-title"></h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        @if ($posts->isEmpty())
                        <div class="alert alert-info">
                            <p>Aucune actualité n'est disponible pour le moment.</p>
                        </div>
                    @else
                        <div class="tp-blog-wrapper">
                            <div class="swiper-container tp-blog-active">
                                <div class="swiper-wrapper">
                                  
                                    @foreach ($posts as $post)
                                        <div class="swiper-slide">
                                            <div class="tp-blog-item">
                                                <div class="tp-blog-thumb">
                                                    <a
                                                        href="{{ url('details-blog', ['id' => $post->id, 'slug' => Str::slug(Str::limit($post->title, 10))]) }}">



                                                        <img class="w-100" width="200" height="300"
                                                            src="{{ url('public/Image/posts/' . $post->image) }}">
                                                    </a>
                                                </div>
                                                <div class="tp-blog-content p-relative">


                                                    <h4 class="tp-blog-title mb-5">
                                                        <a class="text-anim-3"
                                                            href="{{ url('details-blog', ['id' => $post->id, 'slug' => Str::slug(Str::limit($post->title, 10))]) }}">{{ $post->title }}</a>
                                                    </h4>
                                                    <p class="mb-0 pb-20">{{ $post->meta_description }}</p>
                                                    <a class="tp-blog-link"
                                                        href="{{ url('details-blog', ['id' => $post->id, 'slug' => Str::slug(Str::limit($post->title, 10))]) }}">
                                                        <i class="fa-light fa-arrow-right-long"></i>
                                                        Voir détails
                                                        <i class="fa-light fa-arrow-right-long"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach



                                </div>
                                <div class="tp-slider-dots z-index text-center mt-50"></div>
                            </div>
                            <div class="text-center mt-30">
                                <a class="tp-btn-theme" href="{{ url('blog') }}" class="tp-btn">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Voir toutes les nouvelles') }}
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- blog area end -->





        <!-- brand area start -->
        <div class="tp-brand-area pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-brand-wrap">
                            <div class="swiper-container tp-brand-active">
                                <div class="swiper-wrapper">
                                    @foreach ($sponsors as $sponsor)
                                        <div class="swiper-slide">
                                            <div class="tp-brand-thumb text-center">
                                                <img class="w-100"
                                                    src="{{ url('public/Image/sponsors/' . $sponsor->image) }}"
                                                    width="150" height="150" alt="">
                                            </div>
                                        </div>
                                    @endforeach




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand area end -->


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        @yield('scripts')

    </main>
@endsection
