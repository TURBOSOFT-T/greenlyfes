@extends('front.fixe')
@section('titre', 'Détails')
@section('body')

    <main>
        @php
            $config = DB::table('configs')->first();

        @endphp



        <main>

            <!-- breadcrumb area start -->
            <div class="breadcrumb__area breadcrumb__overlay breadcrumb__height p-relative fix"
                data-background="{{ url('public/Image/parametres/' . $config->imageeducation) }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content z-index text-center">
                                <div class="breadcrumb__section-title-box">
                                    <h3 class="breadcrumb__title">Les détails sur l'hôtel</h3>
                                </div>
                                <div class="breadcrumb__list">
                                    <span><a href="/">Home</a></span>

                                    <span class="dvdr"><i>/</i></span>
                                    <span><b>Détails hôtel</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb area end -->

            <!-- service details area start -->
            <div class="tp-sv-details-area fix pt-150 pb-145">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-7">
                            <div class="tp-sv-details-wrapper">
                                <h4 class="tp-section-title mb-20">{{ $ecole->title }}</h4>
                                <div class="tp-sv-details-top-text mb-30">
                                    <p>{{ $ecole->meta_description }}</p>
                                </div>
                                <div class="tp-sv-details-thumb mb-20">
                                    <img src="{{ url('public/Image/' . $ecole->image) }}" alt="">
                                </div>
                                <div class="tp-sv-details-text mb-15">
                                    <p>{{ $ecole->body }}</p>
                                </div>

                                <div class="row">
                                    <div class="tp-sv-details-text mt-50 mb-50">
                                        <h3 class="tp-sv-details-title mb-20">
                                            Les chambres disponibles
                                        </h3>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="tp-sv-details-list-box sv-list-2 mb-50">
                                            <ul>
                                                @foreach ($ecole->filieres as $filiere)
                                                    <li>
                                                        <span>
                                                            <svg width="22" height="22" viewBox="0 0 22 22"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M10.342 14.072L11.756 15.486L16 11.243L11.757 7L10.343 8.415L12.17 10.243H4.633V12.243H12.17L10.342 14.072Z"
                                                                    fill="currentcolor" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M18.778 18.778C23.074 14.482 23.074 7.518 18.778 3.222C14.482 -1.074 7.518 -1.074 3.222 3.222C-1.074 7.518 -1.074 14.482 3.222 18.778C7.518 23.074 14.482 23.074 18.778 18.778ZM17.364 17.364C19.0518 15.6762 20.0001 13.387 20.0001 11C20.0001 8.61304 19.0518 6.32384 17.364 4.636C15.6762 2.94816 13.387 1.99994 11 1.99994C8.61304 1.99994 6.32384 2.94816 4.636 4.636C2.94816 6.32384 1.99994 8.61304 1.99994 11C1.99994 13.387 2.94816 15.6762 4.636 17.364C6.32384 19.0518 8.61304 20.0001 11 20.0001C13.387 20.0001 15.6762 19.0518 17.364 17.364Z"
                                                                    fill="currentcolor" />
                                                            </svg>
                                                        </span>
                                                        <p>{{ $filiere->title ?? ' ' }}</p>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gx-30">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="tp-sv-details-banner">
                                            <img src="assets/img/service/details-1-2.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="tp-sv-details-banner">
                                            <img src="assets/img/service/details-1-3.jpg" alt="">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div class="tp-sv__sidebar-wrapper">
                                <div class="tp-sv__sidebar-widget mb-50">
                                    <h4 class="tp-sv__sidebar-title mb-35">Autres filières</h4>
                                    <div class="tp-sv__sidebar-widget-content">
                                        <ul>



                                            @foreach ($filieres as $filiere)
                                                <li class="active">
                                                    <a href="/filiere/{{ $filiere->id }}"
                                                        class="{{ isset($current_filiere) && $current_filiere->id === $filiere->id ? 'selected' : '' }}">
                                                        {{ Str::limit($filiere->title, 25) }}<span>{{ $filiere->ecoles->count() }}
                                                            <span>
                                                                <svg width="15" height="10" viewBox="0 0 15 10"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M14.1543 4.99974L9.5111 9.644L8.7559 8.88987L12.1127 5.53307H0.0668316V4.4664H12.1127L8.7559 1.11067L9.5111 0.355469L14.1543 4.99974Z"
                                                                        fill="currentcolor" />
                                                                </svg>
                                                            </span>
                                                    </a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>

                                <div class="tp-sv__sidebar-widget">
                                    <h4 class="tp-sv__sidebar-title mb-20">Pré-inscription gratuite</h4>
                                    <div class="tp-sv__sidebar-text mb-20">
                                        {{--  <p>Interactively are is our support the services sucking web-readiness.</p> --}}
                                    </div>
                                    <div class="tp-sv__contact-form">
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <form action="{{ route('inscription.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="ecole_id" value="{{ $ecole->id }}" />
                                            <div class="row gx-30">
                                                <div class="col-12 mb-20">
                                                    <div class="tp-contact-form-input-box">
                                                        <input name="nom" type="text" placeholder="Votre nom" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-20">
                                                    <div class="tp-contact-form-input-box">
                                                        <input name="prenom" type="text" placeholder="Votre prenom" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-20">
                                                    <div class="tp-contact-form-input-box">
                                                        <input name="email" type="email" placeholder="Email" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-20">
                                                    <div class="tp-contact-form-input-box">
                                                        <input name="telephone" type="tel" placeholder="Votre numéro whatsApp" required>
                                                    </div>
                                                </div>
                                               {{--  <div class="col-12 mb-20">
                                                   <label>Votre CNI ou Passport</label>
                                                   <div class="tp-contact-form-input-box">
                                                       <input name="image" type="file" placeholder="CNI ou Passport">
                                                   </div>
                                               </div> --}}
                                                <div class="col-12 mb-20">

                                                </div>
                                                <div class="col-12 mb-20">

                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            Sélectionnez Votre Filière
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            @if ($ecole->filieres->isNotEmpty())
                                                                @foreach ($ecole->filieres as $specialite)
                                                                    <li class="dropdown-item">
                                                                        <label>
                                                                            <input type="checkbox" name="filieres[]"
                                                                                value="{{ $specialite->id }}">
                                                                            {{ $specialite->title ?? 'Non spécifié' }}
                                                                        </label>
                                                                    </li>
                                                                @endforeach
                                                            @else
                                                                <li class="dropdown-item">Aucune spécialité disponible pour
                                                                    cet hôpital.</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>

                                                <style>
                                                    .dropdown-menu {
                                                        max-height: 200px;
                                                        overflow-y: auto;
                                                    }

                                                    .dropdown-item label {
                                                        cursor: pointer;
                                                        display: flex;
                                                        align-items: center;
                                                    }

                                                    .dropdown-item input[type="checkbox"] {
                                                        margin-right: 10px;
                                                    }
                                                </style>



                                                {{--    <div class="col-12 mb-20">
                                        <label>Choisissez la spécialité</label>
                                        @if ($ecole->filieres->isNotEmpty())
                                            <table>
                                                @php
                                                    $columns = 4; // Nombre de colonnes par ligne
                                                    $count = 0;
                                                @endphp
                                                <tr>
                                                    @foreach ($ecole->filieres as $specialite)
                                                        <td>
                                                            <label>
                                                                <input type="checkbox" name="filieres[]"
                                                                    value="{{ $specialite->id }}">
                                                                {{ $specialite->title ?? 'Non spécifié' }}
                                                            </label>
                                                        </td>
                                                        @php
                                                            $count++;
                                                        @endphp
                                                        @if ($count % $columns == 0)
                                                </tr>
                                                <tr>
                                        @endif
                                        @endforeach
                                        @if ($count % $columns != 0)
                                            @for ($i = 0; $i < $columns - ($count % $columns); $i++)
                                                <td></td>
                                            @endfor
                                        @endif
                                        </tr>
                                        </table>
                                    @else
                                        <p>Aucune spécialité disponible pour cet hôpital.</p>
                                        @endif
                                    </div>
                                    <style>
                                        table {
                                            width: 100%;
                                            border-collapse: collapse;
                                        }

                                        td {
                                            padding: 10px;
                                            text-align: center;
                                            border: 1px solid #ddd;
                                            /* Optionnel pour ajouter une bordure aux cellules */
                                        }

                                        label {
                                            cursor: pointer;
                                        }
                                    </style> --}}



                                                <div class="col-12 mb-30">
                                                    <label> Votre message</label>
                                                    <div class="tp-contact-form-textarea-box">
                                                        <textarea name="message" placeholder="Write Message"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="tp-btn-theme"><span>Confirmation</span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- service details area end -->



        </main>
    @endsection
