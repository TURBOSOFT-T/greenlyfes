@extends('front.fixe')
@section('titre', 'Accueil')
@section('body')
    <main>

        @php

        $configs = DB::table('configs')->first();
            @endphp

        <!-- breadcrumb area end -->

        <!-- login area start -->

        <div class="tp-login-area pt-150 pb-150 fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-7 col-xl-6 col-lg-6">
                        <div class="tp-login-left">
                            <div class="tp-login-thumb">
                                <img src="{{ url('public/Image/parametres/' . $configs->imagergister) }}"  style="height : 200; height :200 " alt="preloader">
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-5 col-xl-6 col-lg-6">
                        <div class="tp-sign-up-wrapper">
                            <div class="tp-contact-wrap">
                                <style>
                                    h6 {
                                        font-size: 24pt;
                                        /* Taille du titre de 24 points */
                                    }
                                </style>
                                <h6 class="tp-sectione mb-25" style="front-size :12">Créer votre compte chez JKL-CONSULTING
                                </h6>
                                <br><br>
                                {{--  --}} {{--  @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                                <!-- Validation Errors -->


                                @if ($errors->any())
                                    <div class="alert-box alert-box--error">
                                        <div style="padding-bottom:1rem">@lang('Whoops! Something went wrong.')</div>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <span class="alert-box__close"></span>
                                    </div>
                                @endif


                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row gx-30">
                                        <div class="col-12 mb-20">
                                            <div class="tp-contact-input-box p-relative">
                                                <input name="first_name" type="text" placeholder="Votre nom"
                                                    id="first_name" value="{{ old('first_name') }}" required>
                                                <span class="tp-contact-icon">
                                                    <svg width="14" height="18" viewBox="0 0 14 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6.9987 11.6449C10.6142 11.6449 13.6654 12.2324 13.6654 14.4991C13.6654 16.7667 10.5942 17.3333 6.9987 17.3333C3.38401 17.3333 0.332031 16.7458 0.332031 14.4791C0.332031 12.2116 3.40318 11.6449 6.9987 11.6449ZM6.9987 0.666656C9.44795 0.666656 11.4104 2.62834 11.4104 5.07587C11.4104 7.52339 9.44795 9.48591 6.9987 9.48591C4.55028 9.48591 2.58704 7.52339 2.58704 5.07587C2.58704 2.62834 4.55028 0.666656 6.9987 0.666656Z"
                                                            fill="#578B07" />
                                                    </svg>
                                                </span>
                                                @error('first_name')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="tp-contact-input-box p-relative">
                                                <input name="last_name" type="text" placeholder="Votre prénom"
                                                    id="last_name" value="{{ old('last_name') }}" required>
                                                <span class="tp-contact-icon">
                                                    <svg width="14" height="18" viewBox="0 0 14 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6.9987 11.6449C10.6142 11.6449 13.6654 12.2324 13.6654 14.4991C13.6654 16.7667 10.5942 17.3333 6.9987 17.3333C3.38401 17.3333 0.332031 16.7458 0.332031 14.4791C0.332031 12.2116 3.40318 11.6449 6.9987 11.6449ZM6.9987 0.666656C9.44795 0.666656 11.4104 2.62834 11.4104 5.07587C11.4104 7.52339 9.44795 9.48591 6.9987 9.48591C4.55028 9.48591 2.58704 7.52339 2.58704 5.07587C2.58704 2.62834 4.55028 0.666656 6.9987 0.666656Z"
                                                            fill="#578B07" />
                                                    </svg>
                                                </span>
                                                @error('last_name')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">

                                            <div class="tp-contact-input-box p-relative">
                                                <input id="email" type="email" placeholder="Votre mail"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email">
                                                <span class="tp-contact-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-13 0 50 30"
                                                        fill="currentColor">
                                                        <path
                                                            d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM20 7.23792L12.0718 14.338L4 7.21594V19H20V7.23792ZM4.51146 5L12.0619 11.662L19.501 5H4.51146Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 mb-20">

                                            <div class="tp-contact-input-box p-relative">
                                                <input id="password" type="password" placeholder="Votre mot de passe"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password">
                                                <span class="tp-contact-icon">
                                                    <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M7.9886 0.666687C10.5459 0.666687 12.6036 2.67901 12.6036 5.16336V6.44114C14.0389 6.88915 15.0846 8.18847 15.0846 9.74036V13.8544C15.0846 15.7757 13.4918 17.3334 11.5282 17.3334H4.4753C2.51077 17.3334 0.917969 15.7757 0.917969 13.8544V9.74036C0.917969 8.18847 1.96459 6.88915 3.39904 6.44114V5.16336C3.40751 2.67901 5.46519 0.666687 7.9886 0.666687ZM7.99707 10.1536C7.59061 10.1536 7.26037 10.4766 7.26037 10.874V12.7125C7.26037 13.1182 7.59061 13.4412 7.99707 13.4412C8.41199 13.4412 8.74224 13.1182 8.74224 12.7125V10.874C8.74224 10.4766 8.41199 10.1536 7.99707 10.1536ZM8.00554 2.11589C6.28657 2.11589 4.88938 3.474 4.88091 5.1468V6.26144H11.1217V5.16336C11.1217 3.48228 9.7245 2.11589 8.00554 2.11589Z"
                                                            fill="#578B07" />
                                                    </svg>
                                                </span>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">

                                            <div class="tp-contact-input-box p-relative">
                                                <input id="password-confirm" placeholder="Confirmer le mot de passe"
                                                    type="password" class="form-control" name="password_confirmation"
                                                    required autocomplete="new-password">
                                                <span class="tp-contact-icon">
                                                    <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M7.9886 0.666687C10.5459 0.666687 12.6036 2.67901 12.6036 5.16336V6.44114C14.0389 6.88915 15.0846 8.18847 15.0846 9.74036V13.8544C15.0846 15.7757 13.4918 17.3334 11.5282 17.3334H4.4753C2.51077 17.3334 0.917969 15.7757 0.917969 13.8544V9.74036C0.917969 8.18847 1.96459 6.88915 3.39904 6.44114V5.16336C3.40751 2.67901 5.46519 0.666687 7.9886 0.666687ZM7.99707 10.1536C7.59061 10.1536 7.26037 10.4766 7.26037 10.874V12.7125C7.26037 13.1182 7.59061 13.4412 7.99707 13.4412C8.41199 13.4412 8.74224 13.1182 8.74224 12.7125V10.874C8.74224 10.4766 8.41199 10.1536 7.99707 10.1536ZM8.00554 2.11589C6.28657 2.11589 4.88938 3.474 4.88091 5.1468V6.26144H11.1217V5.16336C11.1217 3.48228 9.7245 2.11589 8.00554 2.11589Z"
                                                            fill="#578B07" />
                                                    </svg>
                                                </span>
                                                @error('password_confirmation')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>
                                    <button class="tp-btn-theme w-100" type="submit"><span>Enregistrer</span></button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- login area end -->




    </main>

@endsection
