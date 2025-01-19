{{-- @include('sweetalert::alert')
 --}}@php
    $config = DB::table('configs')->first();
    $configs = DB::table('configs')->first();
    $service = DB::table('services')->get();
    $pages = DB::table('pages')->get();
@endphp
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('titre') - GREENLYFE </title>
 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($post) && $post->seo_title ? $post->seo_title : config('app.name') }}</title>
    <meta name="description"
        content="{{ isset($post) && $post->meta_description ? $post->meta_description : __(config('app.description')) }}">
    <meta name="author" content="{{ isset($post) ? $post->user->name : __(config('app.author')) }}">
    @if (isset($post) && $post->meta_keywords)
        <meta name="keywords" content="{{ $post->meta_keywords }}">
    @endif
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/Image/parametres/' . $config->icon) }}">
    {{--  <img class="card-img-top product-image" src="{{ url('public/Image/Parametres/' . $config->logo) }}"> --}}
    <!-- CSS here -->
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="/assets/css/swiper-bundle.css">
    <link rel="stylesheet" href="/assets/css/slick.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/font-awesome-pro.css">
    <link rel="stylesheet" href="/assets/css/spacing.css">
    <link rel="stylesheet" href="/assets/css/custom-animation.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    
        <!-- FullCalendar CSS -->
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
        <!-- FullCalendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
        <!-- Moment.js (nécessaire pour certaines fonctionnalités) -->
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>


    <script src="/Script.js"></script>

    @yield('header')
    @yield('room')
    @yield('logement')
    @livewireStyles

</head>

<body>


    <!-- Preloader -->


    {{--     <div class="preloader-wrapper" style="background-color: #171041;">
        <div class="preloader-container">
            <div class="preloader bounce-active">
                <img src="{{ url('public/Image/parametres/' . $config->logo) }}" alt="preloader">
            </div>
        </div>
    </div> --}}



    <!-- Preloader End -->

    <!-- back to top start -->
    <div class="back-to-top-wrapper">
        <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <!-- back to top end -->



    <!-- search popup start -->
    <div class="search__popup">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="search__wrapper">
                        <div class="search__top d-flex justify-content-between align-items-center">
                            <div class="search__logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ url('public/Image/parametres/' . $config->logo) }}" alt=""
                                        width="5" height="5">
                                </a>
                            </div>
                            <div class="search__close">
                                <button type="button" class="search__close-btn search-close-btn">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="search__form">
                            <form action="#">
                                <div class="search__input">
                                    <input class="search-input-field" type="text"
                                        placeholder="Type here to search...">
                                    <span class="search-focus-border"></span>
                                    <button type="submit">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search popup end -->


    <!-- tp-offcanvus-area-start -->
    <div class="tpoffcanvas-area">
        <div class="tpoffcanvas">
            <div class="tpoffcanvas__close-btn">
                <button class="close-btn"><i class="fal fa-times"></i></button>
            </div>
            <div class="tpoffcanvas__logo">
                <a href="{{ route('home') }}">
                    <img src="{{ url('public/Image/parametres/' . $config->logo) }}" alt="logo white" width="5"
                        height="5">
                </a>
            </div>
            <div class="tpoffcanvas__title">
                {{--  <p>{{ $config->description }}</p> --}}
            </div>
            <div class="tp-main-menu-mobile d-xl-none"></div>
            <div class="tpoffcanvas__contact-info">
                <div class="tpoffcanvas__contact-title">
                    <h5>Contact us</h5>
                </div>

                <ul>
                    <li>
                        <i class="fa-light fa-location-dot"></i>
                        <a href="https://www.google.com/maps/@23.8223586,90.3661283,15z"
                            target="_blank">{{ $config->addresse }}</a>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        {{ $config->email }}
                    </li>
                    <li>
                        <i class="fal fa-phone-alt"></i>
                        {{ $config->telephone }}
                    </li>
                </ul>


            </div>
            <div class="tp-footer-widget footer-col-2">
                <h4 class="tp-footer-widget-title">Nos pages</h4>

                <div class="tp-footer-widget-list">

                    <ul>

                        @foreach ($pages as $page)
                            <li><a href="{{ url('page', $page->slug) }}">{{ $page->title }}</a></li>
                        @endforeach

                    </ul>
                </div>

                <div class="tp-footer-widget footer-col-3">
                    <h4 class="tp-footer-widget-title">Nos liens</h4>
                    <div class="tp-footer-widget-list">
                        <ul>
                            @foreach ($follows as $follow)
                                <li><a href="{{ $follow->href }}">{{ $follow->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tpoffcanvas__input">

            </div>
            <div class="tpoffcanvas__social">
                <div class="social-icon">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="body-overlay"></div>
    <!-- tp-offcanvus-area-end -->

    <header class="tp-header-height">
        <!-- header top area start -->
        <div class="tp-header-top-area tp-header-top-height black-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-4 col-md-6 col-sm-6 d-none d-sm-block">


                    </div>
                    <div class="col-xl-7 col-lg-8 col-md-6 col-sm-6">
                        <div class="tp-header-top-right text-center text-sm-end">

                            <ul>
                                <li class="d-none d-lg-inline-block">

                                    <span>
                                        <svg width="17" height="21" viewBox="0 0 17 21" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.80179 6.21464C1.50413 4.25214 2.89007 2.48495 5.00726 1.83651C5.38317 1.72146 5.78882 1.75415 6.14146 1.92793C6.49409 2.10171 6.76714 2.40347 6.90491 2.77167L7.58382 4.58417C7.69297 4.87573 7.71254 5.19324 7.64002 5.49599C7.5675 5.79875 7.4062 6.07293 7.17679 6.28339L5.15726 8.13573C5.05766 8.22724 4.98344 8.34296 4.94182 8.47165C4.9002 8.60034 4.8926 8.73761 4.91976 8.87011L4.93773 8.95136L4.98773 9.15526C5.03226 9.32714 5.09945 9.56933 5.19398 9.85839C5.38148 10.4326 5.6807 11.2045 6.12601 11.9756C6.57132 12.7467 7.09007 13.392 7.4932 13.8412C7.70315 14.0751 7.9226 14.3003 8.15101 14.5162L8.21351 14.574C8.31452 14.6635 8.43699 14.7252 8.56897 14.7533C8.70095 14.7814 8.83796 14.7748 8.96663 14.7342L11.5807 13.9115C11.8777 13.8182 12.1958 13.8156 12.4943 13.9043C12.7927 13.993 13.0579 14.1688 13.2557 14.4092L14.4924 15.9107C15.008 16.5357 14.9471 17.4545 14.3541 18.0068C12.7338 19.517 10.5057 19.8271 8.9557 18.5803C7.05581 17.0479 5.45414 15.179 4.2307 13.067C2.99714 10.9563 2.17308 8.63098 1.80179 6.21464ZM6.55648 8.97245L8.23304 7.43495C8.69185 7.01404 9.01446 6.46566 9.15951 5.86016C9.30455 5.25465 9.26541 4.61962 9.0471 4.03651L8.36742 2.22401C8.09013 1.48349 7.54086 0.87659 6.83158 0.527032C6.1223 0.177474 5.30641 0.111574 4.55023 0.342765C1.92132 1.14745 -0.189618 3.50448 0.257257 6.44901C0.658037 9.05997 1.54782 11.5719 2.87991 13.8529C4.1995 16.1305 5.92697 18.1459 7.97601 19.7982C10.3002 21.6654 13.4049 21.0287 15.4198 19.1498C15.9963 18.6125 16.3461 17.8754 16.3979 17.0891C16.4498 16.3027 16.1997 15.5261 15.6987 14.9178L14.4619 13.4162C14.0662 12.9353 13.5358 12.5836 12.9387 12.4062C12.3417 12.2289 11.7053 12.234 11.1112 12.4209L8.94163 13.1037C8.84452 13.0038 8.74945 12.902 8.65648 12.7982C8.2106 12.3049 7.81612 11.7675 7.47913 11.1943C7.15108 10.6158 6.88277 10.0053 6.67835 9.37245C6.635 9.23996 6.59437 9.1066 6.55648 8.97245Z"
                                                fill="currentcolor" />
                                        </svg>
                                    </span>
                                    <a class="text-anim" href="#"> {{ $config->telephone }} </a>
                                </li>
                                <li>

                                    <span>
                                        <svg width="21" height="17" viewBox="0 0 21 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.0839844 2.24984C0.0839844 1.6973 0.303478 1.1674 0.694179 0.776698C1.08488 0.385997 1.61478 0.166504 2.16732 0.166504H18.834C19.3865 0.166504 19.9164 0.385997 20.3071 0.776698C20.6978 1.1674 20.9173 1.6973 20.9173 2.24984V14.7498C20.9173 15.3024 20.6978 15.8323 20.3071 16.223C19.9164 16.6137 19.3865 16.8332 18.834 16.8332H2.16732C1.61478 16.8332 1.08488 16.6137 0.694179 16.223C0.303478 15.8323 0.0839844 15.3024 0.0839844 14.7498V2.24984ZM3.74961 2.24984L10.5007 8.15713L17.2517 2.24984H3.74961ZM18.834 3.63421L11.1871 10.3259C10.9972 10.4923 10.7532 10.5841 10.5007 10.5841C10.2481 10.5841 10.0041 10.4923 9.81419 10.3259L2.16732 3.63421V14.7498H18.834V3.63421Z"
                                                fill="currentcolor" />
                                        </svg>
                                    </span>
                                    <a class="text-anim">{{ $config->email }} </a>
                                </li>

                            </ul>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- header top area end -->

        <!-- header area start -->
        <div id="header-sticky" class="tp-header-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-4 col-6">
                        <div class="tp-header-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ url('public/Image/parametres/' . $config->logo) }}" alt="logo black"
                                    height="100" width="100">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-6 d-none d-xl-block">
                        <div class="tp-header-main-menu text-xxl-end text-center">
                            <nav class="tp-main-menu-content">
                                <ul>
                                    <li class="has-dropdown">
                                        <a href="/">
                                            {{ \App\Helpers\TranslationHelper::TranslateText('Accueil') }}
                                        </a>

                                    </li>

                                    {{--       <li class="has-dropdown">
                                        <a href="#">Nos activités</a>
                                        <ul class="submenu tp-submenu">
                                           <li><a href="{{ url('produits') }}">Produits artisanaux</a></li>
                                         
                                           <li><a href="{{ url('hopitaux') }}">La santé</a></li>
                                           
                                          
                                        </ul>
                                     </li> --}}
                                    {{--   <li><a href="{{ url('produits') }}">Produits </a></li>  --}}
                                    <li><a href="{{ url('blog') }}">
                                        {{ \App\Helpers\TranslationHelper::TranslateText('Actualités') }}
                                    </a></li>
                                    <li><a href="{{ route('contacts.create') }}">Contact</a></li>
                                    @guest
                                        <li>
                                            <a href="{{ url('login') }}">Connexion</a>
                                        </li>
                                    @else
                                        @if (auth()->user()->role != 'user')
                                            <li><a href="{{ url('admin') }}"
                                                    class="nav-item nav-link">Administration</a>
                                            </li>
                                        @endif

                                    @endguest




                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-8 col-6">
                        <div class="tp-header-right d-flex align-items-center justify-content-end">
                            <div class="tp-header-right-icon d-none d-lg-block">
                                <button class="search-open-btn">
                                    <span>
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.4994 17.4998L13.761 13.7548M15.8327 8.74984C15.8327 10.6285 15.0864 12.4301 13.758 13.7585C12.4296 15.0869 10.628 15.8332 8.74935 15.8332C6.87073 15.8332 5.06906 15.0869 3.74068 13.7585C2.41229 12.4301 1.66602 10.6285 1.66602 8.74984C1.66602 6.87122 2.41229 5.06955 3.74068 3.74116C5.06906 2.41278 6.87073 1.6665 8.74935 1.6665C10.628 1.6665 12.4296 2.41278 13.758 3.74116C15.0864 5.06955 15.8327 6.87122 15.8327 8.74984Z"
                                                stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                    </span>
                                </button>
                          

                            </div>
                            @if (auth()->user())
                                <div class="tp-header-btn d-flex  p-1 d-sm-inline-block d-inline-block"
                                    style=" height: 60px;  line-height: 60px;   padding: 0 ;  display: inline-block;font-weight: 700;font-size: 18px; ">
                                    {{-- <a class="tp-btn-theme" href="contact.html"><span>Get Started Now</span></a> --}}
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle p-3 " type="button"
                                            id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ Auth::user()->name }} 
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2"
                                            style="padding:0%; font-size:100%;padding:0%">

                                          {{--   <a href="{{ route('rents') }}" class="cursor-pointer mx-auto lg:mx-0 bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-110 duration-300 ease-in-out">
                                                Mon tableau de bord
                                              </a> --}}
                                            {{--  <a class="dropdown-item" href="{{ route('rents') }}">
                                                <i class="bx bx-tachometer text-left"></i>
                                                <span>Mes réservations</span>
                                            </a> --}}

                                            {{-- <a class="dropdown-item" href="{{ route('favories') }}">
                                                <i class="bx bx-tachometer"></i>
                                                <span>Mes favoris</span>

                                            </a> --}}
                                            {{--  <a class="dropdown-item" href="{{ route('profile') }}">
                                                <i class="bx bx-tachometer"></i>
                                                <span>Paramètres</span>

                                            </a> --}}

                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                                
                                                {{ \App\Helpers\TranslationHelper::TranslateText('Déconnexion') }}
                                            </a>
                                            {{-- <a class="nav-link" href="{{ route('dashboard') }}">Dashboad</a> --}}
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <style>
                                 
                           
                        </style>


                          
{{-- 
                            <div class="custom-dropdown">
                                <form action="{{ route('locale.change') }}" method="POST">
                                    @csrf
                                    <div class="dropdown">
                                        <button class="dropbtn">
                                            {{ app()->getLocale() == 'fr' ? 'Français' : 'English' }}
                                        </button>
                                        <div class="dropdown-content">
                                            <button type="submit" name="locale" value="fr" class="dropdown-item">
                                                <img src="https://img.icons8.com/color/20/france-circular.png"
                                                    alt="fr">
                                                
                                                {{ \App\Helpers\TranslationHelper::TranslateText('Français') }}
                                            </button>
                                            <button type="submit" name="locale" value="en" class="dropdown-item">
                                                <img src="https://img.icons8.com/color/20/great-britain-circular.png"
                                                    alt="en">
                                                
                                                {{ \App\Helpers\TranslationHelper::TranslateText('Anglais') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
     --}}
                            <div class="tp-header-bar d-xl-none">
                                <button class="tp-menu-bar"><i class="fa-solid fa-bars"></i></button>
                            </div>
                        </div>
                    </div>


                    

                </div>
            </div>
        </div>
        <!-- header area end -->


    </header>

    <main>



        @yield('body')




    </main>

    <footer>
        <div class="tp-footer-bg tp-footer-overley responsive-background"
            data-background="{{ url('public/Image/parametres/' . $config->imagefooter) }}">


            <!-- footer area start -->
            <div class="tp-footer-area tp-footer-border pt-40 pb-5">

                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-50  wow tpfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".3s">
                            <div class="tp-footer-widget footer-col-1">
                                <div class="tp-footer-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ url('public/Image/parametres/' . $config->logo) }}"
                                            width="80" height="80" alt="logo footer">
                                    </a>
                                </div>


                                <div class="tp-footer-text">
                                    <p class="text-justify">{{ $config->description }}</p>
                                </div>
                                <div class="tp-footer-social">
                                    {{--  <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                    <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                                    <a href="#"><i class="fa-brands fa-twitter"></i></a> --}}

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-50  wow tpfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".5s">
                            <div class="tp-footer-widget footer-col-2">
                                <h4 class="tp-footer-widget-title">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Pages') }}
                                </h4>

                                <div class="tp-footer-widget-list">

                                    <ul>

                                        @foreach ($pages as $page)
                                            <li><a href="{{ url('page', $page->slug) }}">{{ $page->title }}</a></li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-50  wow tpfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".7s">
                            <div class="tp-footer-widget footer-col-3">
                                <h4 class="tp-footer-widget-title">
                                    {{ \App\Helpers\TranslationHelper::TranslateText(' Nos Liens') }}
                                </h4>
                                <div class="tp-footer-widget-list">
                                    <ul>
                                        @foreach ($follows as $follow)
                                            <li><a href="{{ $follow->href }}">{{ $follow->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-50  wow tpfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".9s">
                            <div
                                class="tp-footer-widget d-flex  justify-content-start justify-content-xl-end align-items-center footer-col-4">
                                <div>
                                    <h4 class="tp-footer-widget-title">
                                        {{ \App\Helpers\TranslationHelper::TranslateText('Nous contacter') }}
                                    </h4>
                                    <ul>
                                        <li>
                                            <div class="tp-footer-widget-contact-box d-flex align-items-center">
                                                <div class="tp-footer-widget-contact-icon">
                                                    <span>
                                                        <svg width="14" height="18" viewBox="0 0 14 18"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M1.63256 5.57171C1.39456 4.00171 2.50273 2.58796 4.1956 2.06921C4.49618 1.97717 4.82053 2.00332 5.10249 2.14234C5.38445 2.28137 5.60278 2.52278 5.71293 2.81734L6.25578 4.26734C6.34305 4.50058 6.3587 4.75459 6.30072 4.99679C6.24273 5.239 6.11375 5.45835 5.93032 5.62671L4.31554 7.10859C4.2359 7.18179 4.17656 7.27437 4.14328 7.37732C4.11 7.48027 4.10392 7.59009 4.12564 7.69609L4.14 7.76109L4.17998 7.92421C4.21559 8.06171 4.26931 8.25546 4.3449 8.48671C4.49482 8.94609 4.73407 9.56359 5.09013 10.1805C5.4462 10.7973 5.86098 11.3136 6.18332 11.673C6.35119 11.8601 6.52666 12.0402 6.70929 12.213L6.75927 12.2592C6.84004 12.3308 6.93796 12.3802 7.04349 12.4027C7.14902 12.4251 7.25856 12.4198 7.36145 12.3873L9.45161 11.7292C9.68909 11.6545 9.94346 11.6525 10.1821 11.7235C10.4207 11.7944 10.6327 11.935 10.7909 12.1273L11.7798 13.3286C12.1921 13.8286 12.1433 14.5636 11.6692 15.0055C10.3736 16.2136 8.59206 16.4617 7.35271 15.4642C5.83359 14.2383 4.55292 12.7432 3.57467 11.0536C2.58835 9.36505 1.92944 7.50479 1.63256 5.57171ZM5.43433 7.77796L6.77488 6.54796C7.14174 6.21123 7.3997 5.77253 7.51567 5.28813C7.63164 4.80372 7.60035 4.2957 7.42579 3.82921L6.88233 2.37921C6.66061 1.78679 6.22143 1.30127 5.6543 1.02163C5.08717 0.741979 4.4348 0.689259 3.83017 0.874212C1.72813 1.51796 0.0402634 3.40359 0.397577 5.75921C0.718034 7.84797 1.42949 9.85749 2.49461 11.6823C3.54973 13.5044 4.93098 15.1167 6.56936 16.4386C8.42777 17.9323 10.9102 17.423 12.5213 15.9198C12.9822 15.49 13.262 14.9004 13.3034 14.2712C13.3448 13.6421 13.1449 13.0209 12.7443 12.5342L11.7554 11.333C11.439 10.9482 11.0149 10.6669 10.5375 10.525C10.0601 10.3831 9.55123 10.3872 9.07619 10.5367L7.34146 11.083C7.26381 11.0031 7.18779 10.9216 7.11346 10.8386C6.75694 10.444 6.44152 10.014 6.17207 9.55546C5.90976 9.09262 5.69523 8.60427 5.53178 8.09796C5.49712 7.99197 5.46463 7.88528 5.43433 7.77796Z"
                                                                fill="white" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="tp-footer-widget-contact-text">
                                                    <b>
                                                        {{ \App\Helpers\TranslationHelper::TranslateText('Téléphone') }}
                                                        :</b>

                                                    <a class="text-anim" href="#"> {{ $config->telephone }}</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tp-footer-widget-contact-box d-flex align-items-center">
                                                <div class="tp-footer-widget-contact-icon">
                                                    <span>
                                                        <svg width="17" height="14" viewBox="0 0 17 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M-0.00976562 1.66667C-0.00976563 1.22464 0.165738 0.800716 0.478136 0.488155C0.790533 0.175595 1.21424 0 1.65603 0H14.9824C15.4242 0 15.8479 0.175595 16.1603 0.488155C16.4727 0.800716 16.6482 1.22464 16.6482 1.66667V11.6667C16.6482 12.1087 16.4727 12.5326 16.1603 12.8452C15.8479 13.1577 15.4242 13.3333 14.9824 13.3333H1.65603C1.21424 13.3333 0.790533 13.1577 0.478136 12.8452C0.165738 12.5326 -0.00976562 12.1087 -0.00976562 11.6667V1.66667ZM2.92121 1.66667L8.31923 6.3925L13.7173 1.66667H2.92121ZM14.9824 2.77417L8.86811 8.1275C8.71623 8.26065 8.52117 8.33405 8.31923 8.33405C8.11729 8.33405 7.92223 8.26065 7.77035 8.1275L1.65603 2.77417V11.6667H14.9824V2.77417Z"
                                                                fill="white" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="tp-footer-widget-contact-text">
                                                    <b>Email:</b>

                                                    <a class="text-anim" href="#"> {{ $config->email }}</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tp-footer-widget-contact-box d-flex align-items-center">
                                                <div class="tp-footer-widget-contact-icon">
                                                    <span>
                                                        <svg width="16" height="20" viewBox="0 0 16 20"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M7.98698 10.834C9.36697 10.834 10.4857 9.7147 10.4857 8.33398C10.4857 6.95327 9.36697 5.83398 7.98698 5.83398C6.60699 5.83398 5.48828 6.95327 5.48828 8.33398C5.48828 9.7147 6.60699 10.834 7.98698 10.834Z"
                                                                stroke="white" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M7.98742 1.66699C6.22023 1.66699 4.52542 2.36937 3.27582 3.61961C2.02623 4.86986 1.32422 6.56555 1.32422 8.33366C1.32422 9.91033 1.65904 10.942 2.57357 12.0837L7.98742 18.3337L13.4013 12.0837C14.3158 10.942 14.6506 9.91033 14.6506 8.33366C14.6506 6.56555 13.9486 4.86986 12.699 3.61961C11.4494 2.36937 9.7546 1.66699 7.98742 1.66699Z"
                                                                stroke="white" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="tp-footer-widget-contact-text">
                                                    <b>Location:</b>
                                                    <a class="text-anim" href="#" target="_blank">
                                                        {{ $config->addresse }} </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer area end -->

            <!-- copy-right area start -->
            <div class="tp-copyright-area tp-copyright-height" style="padding: 10px 0;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="tp-copyright-text text-center">
                                <p class="text-white" style="font-size: 12px;">
                                    Copyright @ {{ date('Y') }} GREENLYFES. Build by
                                    <a href="#" style="color: #11ee75;"><b>TURBOSOFT</b></a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- copy-right area end -->
        </div>

    </footer>

    <!-- JS here -->
    <script src="/assets/js/vendor/jquery.js"></script>
    <script src="/assets/js/vendor/waypoints.js"></script>
    <script src="/assets/js/bootstrap-bundle.js"></script>
    <script src="/assets/js/ajax-form.js"></script>
    <script src="/assets/js/imagesloaded-pkgd.js"></script>
    <script src="/assets/js/isotope-pkgd.js"></script>
    <script src="/assets/js/magnific-popup.js"></script>
    <script src="/assets/js/nice-select.js"></script>
    <script src="/assets/js/purecounter.js"></script>
    <script src="/assets/js/range-slider.js"></script>
    <script src="/assets/js/wow.js"></script>
    <script src="/assets/js/slick.js"></script>
    <script src="/assets/js/swiper-bundle.js"></script>
    <script src="/assets/js/main.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @livewireScripts
</body>

</html>
