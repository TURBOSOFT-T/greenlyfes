@extends('front.fixe')
@section('titre', 'FAQ')
@section('body')
    <main>
        @php

            $config = DB::table('configs')->first();
            $configs = DB::table('configs')->first();
        @endphp




        <!-- breadcrumb area start -->
       {{--  <div class="breadcrumb__area breadcrumb__overlay breadcrumb__height p-relative fix"
            data-background="{{ url('public/Image/parametres/' . $config->imagesante) }}">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content z-index text-center">
                            <div class="breadcrumb__section-title-box">
                                <h3 class="breadcrumb__title">Séjour en Tunisie</h3>
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
        </div> --}}
        <!-- breadcrumb area end -->

        <br>
        <br>
        <!-- faq area start -->
        <div class="tp-faq-area p-relative pb-125">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-faq-title-box text-center pb-50">
                            <span class="tp-section-subtitle">Tout savoir sur votre séjour en Tunisie</span>
                            <h4 class="tp-section-title">Lisez ces astuces de voyage avant de faire une reservation pour un
                                séjour en Tunisie</h4>
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
                                            1. Informations Générales sur les Résidences
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Caractéristiques des Résidences <br>
                                            • Quels types de résidences sont disponibles ? Appartements, villas, studios,
                                            etc. <br>
                                            • Quelle est la taille des résidences ? Surface en m² ou nombre de pièces. <br>
                                            • Les résidences sont-elles meublées ? Oui ou non, avec détails sur les
                                            équipements. <br>
                                            • Puis-je demander des aménagements spécifiques ? Possibilité d’ajouter meubles
                                            ou équipements. <br>
                                            Commodités et Services <br>
                                            • Quelles commodités sont incluses ? Piscine, Wi-Fi, salle de sport, etc. <br>
                                            • Y a-t-il un service de nettoyage ? Fréquence et conditions. <br>
                                            • Y a-t-il un service de conciergerie ou réception ? Disponibilité du personnel.
                                            <br>
                                            • Y a-t-il un service de maintenance ? Support pour réparations. <br>
                                            • Y a-t-il un parking ? Accès et conditions. <br>
                                            Tarifs et Réservations <br>
                                            • Quels sont les tarifs ? Prix selon type et durée. <br>
                                            • Y a-t-il des réductions ? Pour séjours longs ou clients réguliers. <br>
                                            • Comment réserver ? En ligne, téléphone ou agence. <br>
                                            • Puis-je visiter avant de réserver ? Modalités de visite. <br>
                                            • Quelles sont les conditions d’annulation ? Politique et pénalités. <br>
                                            Règles et Logistique <br>
                                            • Quels sont les horaires d’arrivée et de départ ? Heures fixes ou flexibles.
                                            <br>
                                            • Les animaux domestiques sont-ils autorisés ? Règles applicables. <br>
                                            • Quelle est la durée minimale/maximale de location ? Périodes possibles. <br>
                                            • Quelles sont les restrictions d’âge ? Conditions pour louer. <br>
                                            • Quelle est la politique sur le bruit ? Règles de voisinage. <br>


                                            Sécurité <br>
                                            • Quel est le niveau de sécurité ? Mesures en place. <br>
                                            • Y a-t-il des caméras ou gardiens ? Surveillance active. <br>
                                            • Comment contacter le personnel en urgence ? Procédures rapides. <br>



                                        </div>
                                    </div>
                                    <div class="accordion-items">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-buttons collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                2. Aspects Légaux et Administratifs
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                             Visas et Entrée <br>
                                             •	Quel visa pour un séjour de 1 à 6 mois ? Types selon durée.  <br>
                                             •	Comment obtenir un visa ? Démarches et contacts. <br>
                                             •	Ai-je besoin d’une assurance voyage/santé ? Obligations ou conseils. <br>
                                             •	Y a-t-il des restrictions par nationalité ? Règles spécifiques. <br>
                                             Location et Contrats <br>
                                             •	Quels documents fournir pour louer ? Passeport, contrat, etc. <br> 
                                             •	Quelles démarches pour louer à long terme ? Étapes administratives. <br>
                                             •	Y a-t-il des restrictions d’utilisation ? Ex. : sous-location interdite. <br>
                                             •	Y a-t-il des taxes ou frais supplémentaires ? Coûts additionnels. <br>
                                             •	Comment sont facturées les utilités ? Eau, électricité, etc.  <br>
                                             •	Y a-t-il des pénalités pour résiliation anticipée ? Conditions de rupture. <br>
                                             Droits et Obligations <br>
                                             •	Quels sont mes droits en tant que locataire ? Protections légales. <br> 
                                             •	Comment résoudre un litige avec le propriétaire ? Recours juridiques. <br>
                                             •	Comment obtenir une assurance habitation ? Options disponibles. <br>
                                             •	Quelles sont les lois sur la location ? Cadre légal tunisien. <br>
                                             Vie Pratique <br>
                                             •	Comment obtenir une carte de séjour (>90 jours) ? Procédure pour séjour prolongé. <br>
                                             •	Puis-je ouvrir un compte bancaire ? Conditions pour résidents temporaires. <br>
                                             •	Ai-je besoin d’un permis de travail pour télétravailler ? Règles pour nomades numériques. <br>
                                             
                                                <p>
                                                    Une retraite qui vous fait rêver : soleil, mer, confort et qualité de
                                                    vie exceptionnelle !

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-items">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-buttons collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                3. Vivre en Tunisie
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                             Coût et Commodités <br>
                                             •	Quel est le coût de la vie ? Estimation des dépenses. <br>
                                             •	Y a-t-il des supermarchés ou pharmacies à proximité ? Accès aux essentiels. <br>
                                             •	Quelles options de restauration ? Restaurants, livraison, etc. <br>
                                             Transports et Services <br>
                                             •	Comment me déplacer ? Transports publics, location de voiture. <br>
                                             •	Comment gérer déchets et recyclage ? Pratiques locales. <br>
                                             •	Y a-t-il des services de réparation ? Contacts hors résidence. <br>
                                             Santé et Infrastructure <br>
                                             •	Comment accéder aux soins de santé ? Système et cliniques. <br>
                                             •	Y a-t-il des médecins anglophones ou francophones ? Langues disponibles. <br>
                                             •	Quelle est la qualité de l’eau potable ? Conseils d’usage. <br>
                                             •	Y a-t-il des coupures d’eau/électricité ? Fiabilité des services. <br>
                                             Communauté et Loisirs <br>
                                             •	Y a-t-il des opportunités de bénévolat ? Activités communautaires. <br>
                                             •	Comment rencontrer expatriés ou locaux ? Groupes et événements. <br>
                                             •	Y a-t-il des clubs pour résidents ? Associations locales. <br>
                                             
                                            </div>
                                        </div>
                                    </div>
                                  <div class="accordion-items">
                          <h2 class="accordion-header" id="headingFour">
                             <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                4. Aspects Culturels et Sociaux
                             </button>
                          </h2>
                          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                              Langue et Communication <br>
                              •	Quelle langue est parlée ? Langues principales.  <br>
                              •	Dois-je apprendre l’arabe ou le français ? Conseils pratiques. <br>
                              Coutumes et Intégration <br>
                              •	Quelles sont les traditions locales ? Usages à connaître. <br>
                              •	Comment m’habiller en public ? Normes vestimentaires. <br>
                              •	Y a-t-il des restrictions culturelles/religieuses ? Points à respecter. <br>
                              •	Comment m’intégrer à la communauté ? Stratégies d’adaptation. <br>
                              Culture et Activités <br>
                              •	Comment participer à des festivals ? Accès aux événements. <br>
                              •	Y a-t-il des musées ou sites historiques ? Lieux à visiter. <br>
                              •	Comment apprendre l’histoire tunisienne ? Ressources et cours. <br>
                              •	Y a-t-il des services pour expatriés ? Soutien à l’adaptation. <br>
                                 
                           </div>
                          </div>
                       </div>
                       <div class="accordion-items">
                          <h2 class="accordion-header" id="headingTwo2">
                             <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                5. Spécificités du Bord de Mer
                             </button>
                          </h2>
                          <div id="collapseTwo2" class="accordion-collapse collapse" aria-labelledby="headingTwo2"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">


                              Accès et Qualité <br>
•	Quelle distance jusqu’à la plage ? Proximité exacte. <br>
•	Y a-t-il un accès direct ? Chemins disponibles. <br>
•	Quelle est la qualité de l’eau de mer ? État des plages. <br>
Activités et Sécurité <br>
•	Quelles activités nautiques ? Plongée, voile, etc. <br>
•	Y a-t-il des clubs de plage ? Installations sportives. <br>
•	Y a-t-il des zones surveillées ? Sécurité pour baignade. <br>
•	Quelles précautions en mer ? Conseils essentiels. <br>
Loisirs et Environnement <br>
•	Y a-t-il des restaurants en bord de mer ? Options côtières. <br>
•	Comment organiser des sorties en bateau ? Prestataires locaux. <br>
•	Y a-t-il des initiatives écologiques ? Actions pour l’environnement. <br>
•	Quelle est la meilleure période pour visiter ? Saisons optimales. <br>


                             </div>
                          </div>
                       </div>
                       <div class="accordion-items">
                          <h2 class="accordion-header" id="headingThree3">
                             <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                6. Segments Spécifiques
                             </button>
                          </h2>
                          <div id="collapseThree3" class="accordion-collapse collapse" aria-labelledby="headingThree3"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                              Pour les Retraités <br>
                              •	Y a-t-il des résidences adaptées ? Accessibilité pour mobilité réduite. <br>
                              •	Quelles activités pour seniors ? Loisirs et clubs. <br>
                              •	Y a-t-il des soins spécialisés ? Services médicaux ou à domicile. <br>
                              •	Y a-t-il des avantages fiscaux ? Bénéfices pour retraités. <br>
                              Pour les Familles <br>
                              •	Y a-t-il des écoles ou garderies ? Options éducatives. <br>
                              •	Y a-t-il des parcs ou activités ? Espaces pour enfants. <br>
                              •	Y a-t-il des services de garde ? Baby-sitting disponible. <br>
                              •	Comment assurer la sécurité familiale ? Mesures et ressources. <br>
                              Pour les Nomades Numériques <br>
                              •	Quelle qualité de connexion Internet ? Fiabilité et vitesse. <br>
                              •	Y a-t-il des espaces de coworking ? Lieux de travail. <br>
                              •	Y a-t-il des événements pour nomades ? Réseautage local. <br>
                              •	Comment gérer impôts et horaires ? Solutions pratiques. <br>
                                 
                           </div>
                          </div>
                       </div>
                       <div class="accordion-items">
                          <h2 class="accordion-header" id="headingFour4">
                             <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour4" aria-expanded="false" aria-controls="collapseFour">
                                7. Questions Avancées
                             </button>
                          </h2>
                          <div id="collapseFour4" class="accordion-collapse collapse" aria-labelledby="headingFour4"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                              
                              •	Quelles opportunités d’investissement immobilier ? Perspectives régionales.  <br>
                              •	Comment contribuer à des projets locaux ? Engagement éthique. <br>
                              •	Y a-t-il des pratiques durables ? Énergies renouvelables, etc. <br>
                              
                              
                              </div>
                          </div>
                       </div>
                                </div>

                                <a class="tp-btn-theme"href="#" {{-- class="btn btn-primary py-3 px-5 animated slideInRight" --}}>
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Voir plus') }}
                                </a>
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
                                    <a href="#"><img src="{{ url('public/Image/parametres/' . $config->logo) }}"
                                            width="100" height="100" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="tp-contact-2-right">
                                    <div
                                        class="tp-contact-2-right-content d-flex align-items-center justify-content-between">
                                        <div class="tp-contact-2-box p-relative">
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
                                                <span>Téléphone:</span>
                                                <a class="text-anim-2"
                                                    href="tel:6845550102">{{ $config->telephone ?? ' ' }}</a>
                                            </div>
                                        </div>
                                        <div class="tp-contact-2-box p-relative">
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
                                                <a class="text-anim-2"
                                                    href="mailto:manhhachkt08@gmail.com">{{ $config->email ?? ' ' }}</a>
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
                                                <a class="text-anim-2" href="#" target="_blank">
                                                    {{ $config->addresse ?? ' ' }}</a>
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
