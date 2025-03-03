@extends('front.fixe')
@section('titre', 'Reservation')
@section('body')
    <main>
        <!-- CSS pour DateRangePicker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <!-- JavaScript pour DateRangePicker -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        {{-- <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    --}}


        <style>
            #card-element {
                border: 1px solid #4b11ea;
                border-radius: 10px;
                padding: 10px;
                font-size: 16px;
            }

            .tp-checkout-terms-title {
                color: #16d71d;
                /* Changer la couleur du texte ici */
                font-size: 24px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
            }

            .tp-checkout-terms-content label {
                font-size: 16px;
                font-weight: 600;
                color: #4CAF50;
                /* Couleur verte */


                cursor: pointer;
            }

            .tp-checkout-terms-title {
                font-size: 20px;
                font-weight: bold;
                display: flex;
                align-items: center;
                gap: 10px;
                /* Espacement entre le titre et le badge */
            }

            .badge {
                background-color: #007bff;
                color: white;
                padding: 5px 10px;
                border-radius: 12px;
                font-size: 14px;
                font-weight: normal;
            }
        </style>
        <section class="tp-checkout-area pb-150 pt-150">

            <div class="container">
                <div class="row">


                    <div class="col-lg-7">
                        <div class="tp-checkout-bill-area">
                            <h3 class="tp-checkout-bill-title">Les informations personnelles</h3>
                            <div class="tp-checkout-bill-form">

                                @if ($errors->any())
                                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                                @endif


                                @if (Session::has('alert.config'))
                                    <script>
                                        Swal.fire(@json(Session::get('alert.config')));
                                    </script>
                                @endif

                                <form id="reservation-form" action="{{ route('store.reservation') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="room_id" value="{{ $room->id }}" />
                                    <div class="d-flex justify-content-center pagination-lg">
                                        <div class="customer-details">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-grp">
                                                        <label for="">Nom :</label>
                                                        <input type="text" class="form-control" name="nom"
                                                            value="{{ Auth::user()->name ?? ' ' }}" id="nom" required>
                                                        <span class="text-danger" id="error-nom"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-grp">
                                                        <label for="">Prénom :</label>
                                                        <input type="text" class="form-control" name="prenom"
                                                            value="{{ Auth::user()->last_name ?? ' ' }}" id="prenom"
                                                            required>

                                                        <span class="text-danger" id="error-prenom"></span>
                                                    </div>
                                                </div>
                                                <div class="form-grp">
                                                    <label for="">Email :</label><span class="error-message"
                                                        id="email-error"></span><br>
                                                    <input type="text" class="form-control" name="email"
                                                        value="{{ Auth::user()->email ?? ' ' }}" id="email" required>
                                                </div>
                                                <div class="form-grp">
                                                    <label for="">Address :</label><span class="error-message"
                                                        id="address-error"></span><br>
                                                    <textarea name="adresse" class="form-control" id="address" cols="30" rows="" required></textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="tp-checkout-input">
                                                        <label>Phone <span>*</span></label>
                                                        <input name="telephone" type="number" placeholder="" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="tp-checkout-input">
                                                        <label>Nombre de mois <span>*</span></label>
                                                        <input name="nb_mois" type="number" id="nb_mois" placeholder=""
                                                            required>
                                                    </div>
                                                </div>


                                                <br><br>
                                                <div class="col-md-12">
                                                    <div class="tp-checkout-input">
                                                        <label for="">Message (optional)</label>

                                                        <textarea rows="4" cols="50" id="note" name="note" class="form-control" placeholder="Add content">  </textarea>
                                                        @error('note')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>



                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- checkout place order -->
                        <div class="tp-checkout-place">
                            <h3 class="tp-checkout-place-title">Votre réservation</h3>
                            <div class="tp-order-info-list">
                                <ul>

                                    <table>
                                        <thead>
                                            <tr>



                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="cart_item">


                                                <td class="room-total">
                                                    <span class="amount"> <img
                                                            src="{{ url('public/Image/' . $room->image) }}" alt=""
                                                            width="200 " height="200 ">
                                                </td>

                                                <td class="room-price">


                                                </td>

                                            </tr>



                                        </tbody>

                                    </table>
                                </ul>

                                <br>

                                <div class="mb-3">
                                    @foreach ($room->attributes as $attribut)
                                        <button type="button" class="btn btn-outline-success surface-btn"
                                            data-single="{{ $attribut->single_price }}"
                                            data-double="{{ $attribut->double_price }}"
                                            data-surface="{{ $attribut->surface }}">
                                            {{ $attribut->surface }}
                                        </button>
                                    @endforeach
                                </div>


                                <div class="mb-3">
                                    <button type="button" class="btn btn-outline-primary type-btn"
                                        data-type="single">Une personne</button>
                                    <button type="button" class="btn btn-outline-primary type-btn"
                                        data-type="double">Deuxième personne</button>
                                </div>

                                <h4>Prix : <span id="showPrice">Sélectionnez une surface</span> <x-devise></x-devise></h4>




                                <br><br>


                                <div class="form-control" id="prix-total">Total : 0
                                    <x-devise></x-devise>
                                </div>

                            </div>





                            <br>
                            <div class="tp-checkout-terms">
                                <div class="tp-checkout-terms-title">Les moyens de paiement</div>
                                <br>
                                <div class="tp-checkout-terms-content">
                                    <label>
                                        <input type="radio" name="payment_method" value="bank_transfer" checked>
                                        Virement bancaire
                                    </label>
                                    <label>
                                        <input type="radio" name="payment_method" value="stripe">
                                        Paiement par carte (Stripe)
                                    </label>
                                </div>
                            </div>

                            <div id="bank-info" style="display: block;">
                                <p><strong>Informations bancaires pour le virement :</strong></p>
                                Veuillez envoyer un chèque à “B & P Dr. Spruth”,<br>
                                Galtschinisweg 16, CH-7324 Vilters SG, Vilters-Wangs,<br>
                                Switzerland
                            </div>

                            <div class="tp-checkout-btn-wrapper">

                                <br>

                                <div class="form-group" id="stripe-form-group" style="display: none;">
                                    <div id="card-element"></div>
                                    <input type="hidden" name="stripeToken" id="stripeToken">
                                    <div id="card-errors" class="text-danger"></div>
                                </div>
                            </div>
                            <br>

                            <div class="tp-checkout-btn-wrapper">
                                {{--   <input type="submit" class="tp-btn-theme text-center w-100 check-btn" onclick="submitPaymentForm()" value="Confirmer la réservation">
                             --}}
                                <input type="submit" class="tp-btn-theme text-center w-100 check-btn"
                                    onclick="submitPaymentForm(event)" value="Confirmer la réservation">


                            </div>

                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </section>



        <script src="https://js.stripe.com/v3/"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var stripe = Stripe('{{ config('services.stripe.key') }}');
                console.log("Test key:", stripe);
                var elements = stripe.elements();
                var card = elements.create("card");
                card.mount("#card-element");
                var form = document.getElementById("reservation-form");

                form.addEventListener("submit", function(event) {
                    event.preventDefault();
                    stripe.createToken(card).then(function(result) {
                        console.log("Token Stripe généré avec succès :", result.token.id);
                        document.getElementById("stripeToken").value = result.token.id;
                        form.submit();


                    });
                });
            });
        </script>

        <script>
            document.querySelectorAll('input[name="payment_method"]').forEach((input) => {
                input.addEventListener('change', function() {
                    const bankInfo = document.getElementById('bank-info');
                    const stripeFormGroup = document.getElementById('stripe-form-group');
                    const paymentForm = document.getElementById('reservation-form');
                    if (this.value === 'stripe') {
                        bankInfo.style.display = 'none';
                        stripeFormGroup.style.display = 'block';


                    } else if (this.value === 'bank_transfer') {
                        bankInfo.style.display = 'block';
                        stripeFormGroup.style.display = 'none';
                        // paymentForm.submit(); 
                    }
                });
            });

            function submitPaymentForm() {
                e.preventDefault();
                const form = document.getElementById('reservation-form');
                const nom = document.getElementById('nom').value.trim();
                const prenom = document.getElementById('prenom').value.trim();
                const paymentMethod = document.querySelector('input[name="payment_method"]:checked');

                if (paymentMethod.value === 'stripe') {
                    const stripeToken = document.getElementById('stripeToken').value;
                    if (!stripeToken) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Token Stripe manquant',
                            text: 'Veuillez générer un token Stripe avant de soumettre.',
                            confirmButtonText: 'OK'
                        });
                        return; // Ne pas soumettre le formulaire
                    }
                    // Sinon, soumettre le formulaire normalement
                    document.getElementById('reservation-form').submit();
                }
              
                if (nom === "" || prenom === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur de saisie',
                        text: 'Veuillez remplir tous les champs obligatoires (Nom et Prénom).',
                        confirmButtonText: 'OK'
                    });
                    return; // Stopper la soumission
                }

           

                if (!paymentMethod) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Méthode de paiement manquante',
                        text: 'Veuillez sélectionner une méthode de paiement.',
                        confirmButtonText: 'OK'
                    });
                    return; // Ne pas soumettre le formulaire
                }

                // Si tout est valide, soumettre le formulaire
                if (paymentMethod.value === 'bank_transfer') {
                    document.getElementById('reservation-form').submit();
                }

                Swal.fire({
                    title: 'Confirmation',
                    text: 'Voulez-vous confirmer votre réservation ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, confirmer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Envoi du formulaire
                    }
                });


            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    </main>
@endsection
