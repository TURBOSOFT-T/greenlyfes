<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
{{--  --}}
    {{-- <div> --}}
{{-- 
        @php
            $config = DB::table('configs')->first();
    
        @endphp
    
        
        <div class="rbt-breadcrumb-default ptb--100 ptb_md--50 ptb_sm--30 bg-gradient-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-inner text-center">
                            <h2 class="title">Connexion</h2>
                            <ul class="page-list">
                                <li class="rbt-breadcrumb-item"><a href="#">Accueil</a></li>
                                <li>
                                    <div class="icon-right"><i class="feather-chevron-right"></i></div>
                                </li>
                                <li class="rbt-breadcrumb-item active">Connexion</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
        <div class="rbt-elements-area bg-color-white rbt-section-gap">
            <div class="container">
                <div class="row justify-content-md-center">
    
    
                    <div class="col-lg-6" style="background-color:rgba(67, 62, 54, 0.06);">
                        <div class="d-flex justify-content-center" style="background-color:rgba(204, 158, 82, 0.06);">
                            <br><br>
                            <a href="#">
                                <img src="{{ url('public/Image/parametres/' . $config->logo) }}" alt=""
                                    width="100" height="100">
                            </a>
                        </div>
    
                        <div class="rbt-contact-form contact-form-style-1 max-width-auto"
                            style="background-color:rgba(124, 111, 90, 0.06);">
    
                            <h4 class="row justify-content-md-center" class="title">Login</h4>
                            <h6 class="row justify-content-md-center">Pour se connecter, veuillez saisir votre e-mail et
                            </h6>
                            <h6 class="row justify-content-md-center"> votre mot de passe</h6>
    
                            @if (session()->has('error'))
                                <div class="alert alert-danger p-3 small">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success p-3 small">
                                    {{ session('success') }}
                                </div>
                            @endif
    
    
                            <form class="max-width-auto" wire:submit.prevent='connexion'>
                                @csrf
                                <div class="form-group">
                                    <input type="email" value="{{ old('email') }}"  wire:model.lazy="email"
                                        autofocus />
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                    <label>Votre Email *</label>
                                    <span class="focus-border"></span>
                                </div>
                                <div class="form-group">
                                    <input type="password"  wire:model.lazy="password"
                                         />
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                    <label>Mot de passe *</label>
                                    <span class="focus-border"></span>
                                </div>
    
                                <div class="row mb--30">
                                    <div class="col-lg-6">
                                        <div class="rbt-checkbox">
                                            <input type="checkbox" id="rememberme" name="rememberme">
                                            <label for="rememberme">Se souvenir de moi</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="rbt-lost-password text-end">
                                            <a class="rbt-btn-link"  href="{{ route('forgotpassword') }}">Mot de passes perdu?</a>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="form-submit-group">
                                    <button type="submit" class="rbt-btn btn-md btn-gradient hover-icon-reverse w-100">
                                        <span class="icon-reverse-wrapper">
                                            <span class="btn-text">Connexion</span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                            <br>
    
                            <p class="text-center">
                                <span>Nouvelle su notre platform?</span>
                                <a href="{{ route('register') }}">
                                    <span>Créer un compte</span>
                                </a>
                            </p>
                        </div>
                    </div>
    
    
    
                </div>
            </div>
        </div>
    
    
    
    </div> --}}

        <!-- Session Status -->
        <x-auth.session-status :status="session('status')" />
        <!-- Validation Errors -->
        <x-auth.validation-errors :errors="$errors" />

        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
            Session::forget('success');
            @endphp
        </div>
        @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row gx-30">
                    <div class="col-12 mb-20">
                        <div class="tp-contact-input-box p-relative">
                            <input type="email" class="form-control" id="email"
                                name="email" placeholder="Email Address" required />
                            <span class="tp-contact-icon">
                                <svg width="14" height="18" viewBox="0 0 14 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.9987 11.6449C10.6142 11.6449 13.6654 12.2324 13.6654 14.4991C13.6654 16.7667 10.5942 17.3333 6.9987 17.3333C3.38401 17.3333 0.332031 16.7458 0.332031 14.4791C0.332031 12.2116 3.40318 11.6449 6.9987 11.6449ZM6.9987 0.666656C9.44795 0.666656 11.4104 2.62834 11.4104 5.07587C11.4104 7.52339 9.44795 9.48591 6.9987 9.48591C4.55028 9.48591 2.58704 7.52339 2.58704 5.07587C2.58704 2.62834 4.55028 0.666656 6.9987 0.666656Z"
                                        fill="#578B07" />
                                </svg>
                            </span>
                        </div>
                        @error('email')
                            <span class="small text-danger"> {{ $email }} </span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-20">
                        <div class="tp-contact-input-box p-relative">
                            <input type="password" class="form-control" id="password"
                                placeholder="Password" name="password" required />
                            <span class="tp-contact-icon">
                                <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.9886 0.666687C10.5459 0.666687 12.6036 2.67901 12.6036 5.16336V6.44114C14.0389 6.88915 15.0846 8.18847 15.0846 9.74036V13.8544C15.0846 15.7757 13.4918 17.3334 11.5282 17.3334H4.4753C2.51077 17.3334 0.917969 15.7757 0.917969 13.8544V9.74036C0.917969 8.18847 1.96459 6.88915 3.39904 6.44114V5.16336C3.40751 2.67901 5.46519 0.666687 7.9886 0.666687ZM7.99707 10.1536C7.59061 10.1536 7.26037 10.4766 7.26037 10.874V12.7125C7.26037 13.1182 7.59061 13.4412 7.99707 13.4412C8.41199 13.4412 8.74224 13.1182 8.74224 12.7125V10.874C8.74224 10.4766 8.41199 10.1536 7.99707 10.1536ZM8.00554 2.11589C6.28657 2.11589 4.88938 3.474 4.88091 5.1468V6.26144H11.1217V5.16336C11.1217 3.48228 9.7245 2.11589 8.00554 2.11589Z"
                                        fill="#578B07" />
                                </svg>
                            </span>
                        </div>
                        @error('password')
                            <span class="small text-danger"> {{ $email }} </span>
                        @enderror
                    </div>
                </div>
                <button class="tp-btn-theme w-100" type="submit"><span>Connexion</span></button>
                <div
                    class="tp-sign-up-mail mt-25 mb-25 d-flex justify-content-center align-items-center">

                </div>

                <div class="tp-login-forgot">
                    <span>
                        Vous n'avez pas de compte ?
                    </span>
                    <a href="{{ url('register') }}">M'inscrire </a>
                    <a class="forget" {{-- href="{{ route('forgot-password') }}" --}}>Mot de passe oublié</a>
                </div>
            </form>
    
</div>
