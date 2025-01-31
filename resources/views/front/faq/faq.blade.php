@extends('front.fixe')
@section('titre', "Contact")
@section('body')
    <main>
@php

$config = DB::table('configs')->first();
$configs = DB::table('configs')->first();
@endphp




      <!-- breadcrumb area start -->
      <div class="breadcrumb__area breadcrumb__overlay breadcrumb__height p-relative fix"
         data-background="{{ url('public/Image/parametres/' . $config->imagesante) }}">
         <div class="container">
            <div class="row">
               <div class="col-xxl-12">
                  <div class="breadcrumb__content z-index text-center">
                     <div class="breadcrumb__section-title-box">
                        <h3 class="breadcrumb__title">FAQ</h3>
                     </div>
                     <div class="breadcrumb__list">
                        <span><a href="index.html">Home</a></span>
                        <span class="dvdr"><i>/</i></span>
                        <span class="dvdr">FAQ</span>
                        <span class="dvdr"><i>/</i></span>
                        <span><b>FAQ</b></span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- breadcrumb area end -->

  <br>
  <br>
     <!-- faq area start -->
     <div class="tp-faq-area p-relative pb-125">
        <div class="container">
           <div class="row">
              <div class="col-xl-12">
                 <div class="tp-faq-title-box text-center pb-50">
                    <span class="tp-section-subtitle">Informations sur les séjours en Tunisie</span>
                    <h4 class="tp-section-title">Lisez ces astuces de voyage avant de faire une reservation pour un séjour</h4>
                 </div>
              </div>
           </div>
           <div class="row justify-content-center">
              <div class="col-xl-11">
                 <div class="tp-custom-accordion-2">
                    <div class="accordion" id="accordionExample">
                       <div class="accordion-items tp-faq-active">
                          <h2 class="accordion-header" id="headingOne">
                             <button class="accordion-buttons show" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Dans quelles villes en Tunisie est-il préférable de séjourner ?
                             </button>
                          </h2>
                          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                                Sousse est une ville à ne pas manquer lors de votre visite en Tunisie. Célèbre pour ses hôtels élégants, cette ville tunisienne dispose d'un réseau de transport fiable qui comprend des bus et des trains, desservant les principaux sites et les villes des alentours. Hammamet est une autre ville à visiter pendant vos vacances en Tunisie.     </div>
                          </div>
                       </div>
                       <div class="accordion-items">
                          <h2 class="accordion-header" id="headingTwo">
                             <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Pourquoi un long séjour en Tunisie est-il préférable ?
                             </button>
                          </h2>
                          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                                <p>Un long séjour en Tunisie vous permet de découvrir les sites touristiques de 
                                     Tunisie. Vous aurez la chance de découvrir des hôtels, des restaurants, des bars, des boutiques, des gares, des marchés et des plages. Vous pourrez également rencontrer des gens qui vous aideront à vous détendre et à vous détendre.
                                     </p>
                                     <p>
                                        Une retraite qui vous fait rêver : soleil, mer, confort et qualité de vie exceptionnelle !

                                     </p>
                                </div>
                          </div>
                       </div>
                       <div class="accordion-items">
                          <h2 class="accordion-header" id="headingThree">
                             <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Pourquoi prendre une retraite  en Tunisie?
                             </button>
                          </h2>
                          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                                <p>
                                    La Tunisie est un pays qui offre une grande variété de sites touristiques, notamment des 
                                     sites de la région de Sousse et de la région de Hammamet.
                                </p>
                                <p>
                                    Découvrez le secret d'une retraite heureuse : soleil, confort et pouvoir d'achat accru !
                                </p>
                                <p>
                                    Pouvez-vous imaginer une retraite avec des soins médicaux de qualité, des avantages fiscaux et une qualité de vie exceptionnelle 
                                </p>
                                </div>
                          </div>
                       </div>
                      {{--  <div class="accordion-items">
                          <h2 class="accordion-header" id="headingFour">
                             <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                How Can I Migrate To Another Site?
                             </button>
                          </h2>
                          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing  which looks characteristic words etc.
                             </div>
                          </div>
                       </div>
                       <div class="accordion-items">
                          <h2 class="accordion-header" id="headingTwo2">
                             <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                How Does About Online Services?
                             </button>
                          </h2>
                          <div id="collapseTwo2" class="accordion-collapse collapse" aria-labelledby="headingTwo2"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing  which looks characteristic words etc.
                             </div>
                          </div>
                       </div>
                       <div class="accordion-items">
                          <h2 class="accordion-header" id="headingThree3">
                             <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                Can I Develop My Website Without Code?
                             </button>
                          </h2>
                          <div id="collapseThree3" class="accordion-collapse collapse" aria-labelledby="headingThree3"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing  which looks characteristic words etc.
                             </div>
                          </div>
                       </div>
                       <div class="accordion-items">
                          <h2 class="accordion-header" id="headingFour4">
                             <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour4" aria-expanded="false" aria-controls="collapseFour">
                                How Many Sites I Can Create At Once?
                             </button>
                          </h2>
                          <div id="collapseFour4" class="accordion-collapse collapse" aria-labelledby="headingFour4"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing  which looks characteristic words etc.
                             </div>
                          </div>
                       </div> --}}
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
     <!-- faq area end -->


     <!-- contact area start -->
     <div class="tp-contact-2-area theme-bg-2 pt-75 pb-55 z-index">         
        <div class="container">
           <div class="tp-contact-2-bg white-bg tp-contact-2-style-2">
              <div class="row align-items-center">
                 <div class="col-xl-4 d-none d-xl-block">
                    <div class="tp-contact-2-logo">
                       <a href="#"><img src="{{ url('public/Image/parametres/' . $config->logo) }}" width="100" height="100" alt=""></a>
                    </div>
                 </div>
                 <div class="col-xl-8">
                    <div class="tp-contact-2-right">
                       <div class="tp-contact-2-right-content d-flex align-items-center justify-content-between">
                          <div class="tp-contact-2-box p-relative">
                             <div class="tp-contact-2-icon">
                                <span>
                                   <svg width="13" height="18" viewBox="0 0 13 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M1.40889 5.57171C1.18267 4.00171 2.23598 2.58796 3.84505 2.06921C4.13074 1.97717 4.43904 2.00332 4.70704 2.14234C4.97504 2.28137 5.18256 2.52278 5.28727 2.81734L5.80324 4.26734C5.88619 4.50058 5.90107 4.75459 5.84595 4.99679C5.79083 5.239 5.66824 5.45835 5.49389 5.62671L3.95905 7.10859C3.88335 7.18179 3.82695 7.27437 3.79532 7.37732C3.76368 7.48027 3.75791 7.59009 3.77855 7.69609L3.7922 7.76109L3.8302 7.92421C3.86405 8.06171 3.91511 8.25546 3.98695 8.48671C4.12945 8.94609 4.35686 9.56359 4.6953 10.1805C5.03374 10.7973 5.42799 11.3136 5.73436 11.673C5.89392 11.8601 6.06071 12.0402 6.2343 12.213L6.2818 12.2592C6.35857 12.3308 6.45164 12.3802 6.55195 12.4027C6.65226 12.4251 6.75638 12.4198 6.85417 12.3873L8.84086 11.7292C9.06658 11.6545 9.30836 11.6525 9.53517 11.7235C9.76199 11.7944 9.9635 11.935 10.1139 12.1273L11.0538 13.3286C11.4456 13.8286 11.3993 14.5636 10.9487 15.0055C9.71724 16.2136 8.02386 16.4617 6.84586 15.4642C5.40195 14.2383 4.18468 12.7432 3.25486 11.0536C2.31736 9.36505 1.69107 7.50479 1.40889 5.57171ZM5.02245 7.77796L6.29664 6.54796C6.64534 6.21123 6.89052 5.77253 7.00076 5.28813C7.11099 4.80372 7.08124 4.2957 6.91533 3.82921L6.39877 2.37921C6.18803 1.78679 5.77059 1.30127 5.23153 1.02163C4.69248 0.741979 4.0724 0.689259 3.4977 0.874212C1.49973 1.51796 -0.104579 3.40359 0.235047 5.75921C0.539639 7.84797 1.21587 9.85749 2.22827 11.6823C3.23115 13.5044 4.54403 15.1167 6.1013 16.4386C7.8677 17.9323 10.2273 17.423 11.7585 15.9198C12.1967 15.49 12.4626 14.9004 12.502 14.2712C12.5414 13.6421 12.3513 13.0209 11.9705 12.5342L11.0306 11.333C10.7298 10.9482 10.3267 10.6669 9.87297 10.525C9.41922 10.3831 8.93555 10.3872 8.48402 10.5367L6.83517 11.083C6.76137 11.0031 6.68911 10.9216 6.61845 10.8386C6.27959 10.444 5.97978 10.014 5.72367 9.55546C5.47435 9.09262 5.27043 8.60427 5.11508 8.09796C5.08214 7.99197 5.05125 7.88528 5.02245 7.77796Z" fill="currentcolor" />
                                   </svg>
                                </span>
                             </div>
                             <div class="tp-contact-2-text">
                                <span>Téléphone:</span>
                                <a class="text-anim-2" href="tel:6845550102">{{ $config->telephone ?? ' ' }}</a>
                             </div>
                          </div>
                          <div class="tp-contact-2-box p-relative">
                             <div class="tp-contact-2-icon">
                                <span>
                                   <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M17.3327 1.99967C17.3327 1.08301 16.5827 0.333008 15.666 0.333008H2.33268C1.41602 0.333008 0.666016 1.08301 0.666016 1.99967V11.9997C0.666016 12.9163 1.41602 13.6663 2.33268 13.6663H15.666C16.5827 13.6663 17.3327 12.9163 17.3327 11.9997V1.99967ZM15.666 1.99967L8.99935 6.16634L2.33268 1.99967H15.666ZM15.666 11.9997H2.33268V3.66634L8.99935 7.83301L15.666 3.66634V11.9997Z" fill="currentcolor" />
                                    </svg>
                                </span>
                             </div>
                             <div class="tp-contact-2-text">
                                <span>Email:</span>
                                <a class="text-anim-2" href="mailto:manhhachkt08@gmail.com">{{ $config->email ?? ' ' }}</a>
                             </div>
                          </div>
                          <div class="tp-contact-2-box location p-relative">
                             <div class="tp-contact-2-icon">
                                <span>
                                   <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M8 10.834C9.38071 10.834 10.5 9.7147 10.5 8.33398C10.5 6.95327 9.38071 5.83398 8 5.83398C6.61929 5.83398 5.5 6.95327 5.5 8.33398C5.5 9.7147 6.61929 10.834 8 10.834Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                      <path d="M8.00065 1.66699C6.23254 1.66699 4.53685 2.36937 3.28661 3.61961C2.03636 4.86986 1.33398 6.56555 1.33398 8.33366C1.33398 9.91033 1.66898 10.942 2.58398 12.0837L8.00065 18.3337L13.4173 12.0837C14.3323 10.942 14.6673 9.91033 14.6673 8.33366C14.6673 6.56555 13.9649 4.86986 12.7147 3.61961C11.4645 2.36937 9.76876 1.66699 8.00065 1.66699Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                             </div>
                             <div class="tp-contact-2-text">
                                <span>Location:</span>
                                <a class="text-anim-2" href="#" target="_blank">   {{ $config->addresse ?? ' ' }}</a>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
     <!-- contact area end -->


</main>
@endsection
