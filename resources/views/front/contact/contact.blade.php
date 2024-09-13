@extends('front.fixe')
@section('titre', 'Contact')
@section('body')
    <main>
        @php

            $config = DB::table('configs')->first();
            $configs = DB::table('configs')->first();
        @endphp

        <!-- contact area start -->
        <div class="tp-contact-area tp-contact-2-style-2 tp-contact-style-3 tp-contact-inner-style p-relative fix">
            <div class="tp-contact-shape-2 d-none d-xl-block">
                <img  src="{{ url('public/Image/parametres/' . $config->imagecontact) }}" alt=""  width="850" height="600">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-contact-3-title-box text-center mb-20">
                            <h4 class="tp-section-title mb-20">Contact </h4>
                            {{-- <span class="tp-section-subtitle text-black">Get Free Estimatet</span> --}}
                        </div>
                    </div>
                </div>
                <div class="tp-contact-top-wrap mb-120">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="tp-contact-2-box p-relative mb-25">
                                <div class="tp-contact-2-icon my-auto">
                                    <span>
                                        <svg width="13" height="18" viewBox="0 0 13 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.40889 5.57171C1.18267 4.00171 2.23598 2.58796 3.84505 2.06921C4.13074 1.97717 4.43904 2.00332 4.70704 2.14234C4.97504 2.28137 5.18256 2.52278 5.28727 2.81734L5.80324 4.26734C5.88619 4.50058 5.90107 4.75459 5.84595 4.99679C5.79083 5.239 5.66824 5.45835 5.49389 5.62671L3.95905 7.10859C3.88335 7.18179 3.82695 7.27437 3.79532 7.37732C3.76368 7.48027 3.75791 7.59009 3.77855 7.69609L3.7922 7.76109L3.8302 7.92421C3.86405 8.06171 3.91511 8.25546 3.98695 8.48671C4.12945 8.94609 4.35686 9.56359 4.6953 10.1805C5.03374 10.7973 5.42799 11.3136 5.73436 11.673C5.89392 11.8601 6.06071 12.0402 6.2343 12.213L6.2818 12.2592C6.35857 12.3308 6.45164 12.3802 6.55195 12.4027C6.65226 12.4251 6.75638 12.4198 6.85417 12.3873L8.84086 11.7292C9.06658 11.6545 9.30836 11.6525 9.53517 11.7235C9.76199 11.7944 9.9635 11.935 10.1139 12.1273L11.0538 13.3286C11.4456 13.8286 11.3993 14.5636 10.9487 15.0055C9.71724 16.2136 8.02386 16.4617 6.84586 15.4642C5.40195 14.2383 4.18468 12.7432 3.25486 11.0536C2.31736 9.36505 1.69107 7.50479 1.40889 5.57171ZM5.02245 7.77796L6.29664 6.54796C6.64534 6.21123 6.89052 5.77253 7.00076 5.28813C7.11099 4.80372 7.08124 4.2957 6.91533 3.82921L6.39877 2.37921C6.18803 1.78679 5.77059 1.30127 5.23153 1.02163C4.69248 0.741979 4.0724 0.689259 3.4977 0.874212C1.49973 1.51796 -0.104579 3.40359 0.235047 5.75921C0.539639 7.84797 1.21587 9.85749 2.22827 11.6823C3.23115 13.5044 4.54403 15.1167 6.1013 16.4386C7.8677 17.9323 10.2273 17.423 11.7585 15.9198C12.1967 15.49 12.4626 14.9004 12.502 14.2712C12.5414 13.6421 12.3513 13.0209 11.9705 12.5342L11.0306 11.333C10.7298 10.9482 10.3267 10.6669 9.87297 10.525C9.41922 10.3831 8.93555 10.3872 8.48402 10.5367L6.83517 11.083C6.76137 11.0031 6.68911 10.9216 6.61845 10.8386C6.27959 10.444 5.97978 10.014 5.72367 9.55546C5.47435 9.09262 5.27043 8.60427 5.11508 8.09796C5.08214 7.99197 5.05125 7.88528 5.02245 7.77796Z"
                                                fill="currentcolor" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="tp-contact-2-text my-auto">
                                    <b>{{ $config->telephone ?? '' }} </b>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="tp-contact-2-box p-relative mb-25">
                                <div class="tp-contact-2-icon my-auto">
                                    <span>
                                        <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.3327 1.99967C17.3327 1.08301 16.5827 0.333008 15.666 0.333008H2.33268C1.41602 0.333008 0.666016 1.08301 0.666016 1.99967V11.9997C0.666016 12.9163 1.41602 13.6663 2.33268 13.6663H15.666C16.5827 13.6663 17.3327 12.9163 17.3327 11.9997V1.99967ZM15.666 1.99967L8.99935 6.16634L2.33268 1.99967H15.666ZM15.666 11.9997H2.33268V3.66634L8.99935 7.83301L15.666 3.66634V11.9997Z"
                                                fill="currentcolor" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="tp-contact-2-text my-auto small">
                                    <b>{{ $config->email ?? '-' }}</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="tp-contact-2-box location p-relative">
                                <div class="tp-contact-2-icon my-auto">
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
                                <div class="tp-contact-2-text my-auto small box ">
                                    <b>{{ $configs->addresse ?? '-' }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="tp-contact-3-left" style="text-align: justify">
                            <div class="tp-contact-3-title-box mb-15">
                                <span class="tp-section-subtitle">Nous contactez</span>
                                <h4 class="tp-section-title">Travaillons et créons
                                    Account</h4>
                            </div>
                            <p> {{$config->des_contact ?? ' '}}</p>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="tp-contact-wrap">
                            <h4 class="tp-contact-title">Nous contactez</h4>
                            <span>Prendre un rendez-vous</span>
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
                                            {{--  <textarea name="message" type="text" row="5" required placeholder="Votre message"> --}}

                                            <textarea name="message" rows="12" cols="35">Laissez votre message.</textarea><br>

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
                                    <span>Envoyer</span>
                                </button>
                                <p class="ajax-response"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact area end -->

        <style>
            .tp-contact-2-text {
                height: 30px !important;
            }
        </style>
    </main>
@endsection
