@extends('front.fixe')
@section('titre','Login')
@section('body')
<main>

    @php

$configs = DB::table('configs')->first();
    @endphp

    
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

        <!-- login area start -->
        <div class="tp-login-area pt-150 pb-150 fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-7 col-xl-6 col-lg-6">
                        <div class="tp-login-left">
                            <div class="tp-login-thumb">
                                <img src="{{ url('public/Image/parametres/' . $configs->imagelogin) }}"  style="height : 200; height :200 " alt="preloader">
                            </div>
                        </div>
                    </div>  
               
                    <div class="col-xxl-5 col-xl-6 col-lg-6">
                        <div class="tp-sign-up-wrapper">
                            <div class="tp-contact-wrap">
                                <h4 class="tp-section-title mb-25">Se connecter</h4>
     
                            
 @livewire('auth.connexion')


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- login area end -->




</main>
@endsection
