@extends('front.fixe')
@section('titre', 'Paiement')
@section('body')
    <main>

        {{--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/form.css') }}">


        <section class="tp-checkout-area pb-150 pt-150">
            <style>
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
            </style>
            <div class="container">
                <div class="row">


                    <div class="col-lg-7">
                        <div class="tp-checkout-bill-area">
                            <h3 class="tp-checkout-bill-title">Les informations personnelles</h3>
                            <div class="tp-checkout-bill-form">

                                @if ($errors->any())
                                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                                @endif




                                <form action="{{ route('order.confirm') }}"  method="post" id="payment-form">
                                    @csrf
                                    {{--  <input type="hidden" name="product_id" value="{{ $product->id }}" /> --}}
                                    <div class="d-flex justify-content-center pagination-lg">
                                        <div class="customer-details">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-grp">
                                                        <label for="">Nom :</label><span class="error-message"
                                                            id="name-error"></span><br>
                                                        <input type="text" class="form-control" name="first_name"
                                                            value="{{ Auth::user()->name ?? ' ' }}" id="name" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-grp">
                                                        <label for="">Prénom :</label><span class="error-message"
                                                            id="name-error"></span><br>
                                                        <input type="text" class="form-control" name="last_name"
                                                            value="{{ Auth::user()->last_name ?? ' ' }}" id="prenom"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-grp">
                                                        <label for="">Email :</label><span class="error-message"
                                                            id="email-error"></span><br>
                                                        <input type="text" class="form-control" name="email"
                                                            value="{{ Auth::user()->email ?? ' ' }}" id="email"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-grp">
                                                        <label for="">Téléphone :</label><span class="error-message"
                                                            id="phone-error"></span><br>
                                                        <input type="number" class="form-control" name="phone"
                                                            value="{{ Auth::user()->phone ?? ' ' }}" id="phone"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="form-grp">
                                                    <label for="">Address :</label><span class="error-message"
                                                        id="address-error"></span><br>
                                                    <textarea name="address" class="form-control" id="address" cols="30" rows="" required></textarea>
                                                </div>
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
                            <h3 class="tp-checkout-place-title">Votre commande</h3>
                            <div class="tp-order-info-list">
                                <ul>

                                    <table>
                                        <thead>
                                            <tr>

                                                {{--  <th class="product-name">Product</th>
                                                <th class="product-total">Photo</th> --}}

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="cart_item">

                                                {{--   <td class="product-name">
                                                    {{ $produit->name }} <strong class="product-quantity"> 

                                                </td> --}}
                                                {{--  <td class="product-total">
                                                    <span class="amount"> <img
                                                            src="{{ url('public/Image/' . $produit->image) }}"
                                                            alt="" width="200 " height="200 ">
                                                </td>
                                                <br>
                                                <td>
                                                    <span class="amount" id="product-price"
                                                        data-prix="{{ $produit->price }}">
                                                        {{ number_format($produit->price, 2) }} <x-devise></x-devise>
                                                    </span>
                                                </td> --}}

                                            </tr>

                                        </tbody>

                                    </table>
                                </ul>


                            </div>


                            <div class="tp-checkout-btn-wrapper">





                                <div class="tp-checkout-terms">
                                    <div class="tp-checkout-terms-title">Les moyens de paiement</div>
                                    <br>

                                    <div class="tp-checkout-terms-content">
                                        <label>
                                            <input type="radio" name="payment_method" value="bank_transfer" checked>
                                            Virement bancaire
                                        </label>
                                      {{--   <label>
                                            <input type="radio" name="payment_method" value="stripe">
                                            Paiement par carte (Stripe)
                                        </label> --}}
                                    </div>
                                </div>
                                <div id="bank-info" style="display: block;">
                                    <br>
                                    <p><strong>Informations bancaires pour le virement :</strong></p>
                                    Veuillez envoyer un chèque à “B & P Dr. Spruth”,<br>
                                    Galtschinisweg 16, CH-7324 Vilters SG, Vilters-Wangs,<br>
                                    Switzerland
                                    Compte bancaire : {{ $configs->compte }} <br>
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
                                <input type="submit" id="submit-btn" onclick="submitPaymentForm()"
                                    class="tp-btn-theme text-center w-100 check-btn" value="Confirmer la commande">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                document.getElementById('payment-form').addEventListener('submit', function(event) {
                    event.preventDefault(); // Empêcher l'envoi par défaut

                    let form = this;
                    let formData = new FormData(form);

                    fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'error') {
                                let errorMessages = '';
                                for (const [key, messages] of Object.entries(data.errors)) {
                                    errorMessages += `<p>${messages.join('<br>')}</p>`;
                                }

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreurs de validation',
                                    html: errorMessages,
                                    confirmButtonText: 'OK'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Succès',
                                    text: data.message,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    form.submit(); // Soumettre le formulaire après succès
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Erreur:', error);
                        });
                });
            </script>


            <script src="https://js.stripe.com/v3/"></script>

            <script>
                document.addEventListener("DOMContentLoaded", function() {

                    var stripe = Stripe('{{ config('services.stripe.key') }}');
                    // console.log("Test key:", stripe);
                    var elements = stripe.elements();
                    var card = elements.create("card");
                    card.mount("#card-element");
                    var form = document.getElementById("payment-form");

                    form.addEventListener("submit", function(event) {
                        event.preventDefault();
                        stripe.createToken(card).then(function(result) {
                            //  console.log("Token Stripe généré avec succès :", result.token.id);
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
                        const cardElement = document.getElementById('card-element');
                        const paymentForm = document.getElementById('payment-form');
                        const submitBtn = document.getElementById('submit-btn');


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

                /*  function submitPaymentForm() {
                     const paymentForm = document.getElementById('payment-form');
                     const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

                     if (paymentMethod === 'bank_transfer') {

                         paymentForm.submit();
                     }

                 } */

                function submitPaymentForm() {
                    // Récupérer les valeurs des champs

                    const firstName = document.getElementById('name').value.trim();
                    const lastName = document.getElementById('prenom').value.trim();
                    const email = document.getElementById('email').value.trim();
                    const phone = document.getElementById('phone').value.trim();
                    const address = document.getElementById('address').value.trim();

                    if (!firstName || !lastName || !email || !phone || !address) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Champs manquants',
                            text: 'Tous les champs obligatoires doivent être remplis.',
                            confirmButtonText: 'OK'
                        });
                        return; // Ne pas soumettre le formulaire
                    }

                    // Validation du format de l'email
                    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                    if (!emailPattern.test(email)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Email invalide',
                            text: 'Veuillez entrer un email valide.',
                            confirmButtonText: 'OK'
                        });
                        return; // Ne pas soumettre le formulaire
                    }

                    // Validation du format du numéro de téléphone

                    if (!(phone)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Numéro de téléphone invalide',
                            text: 'Veuillez entrer un numéro de téléphone valide (10 chiffres).',
                            confirmButtonText: 'OK'
                        });
                        return; // Ne pas soumettre le formulaire
                    }

                    // Validation de l'adresse
                    if (!address) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Adresse manquante',
                            text: 'Veuillez entrer une adresse valide.',
                            confirmButtonText: 'OK'
                        });
                        return; // Ne pas soumettre le formulaire
                    }

                    // Vérification de la méthode de paiement
                    const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
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
                        document.getElementById('payment-form').submit();
                    }

                }
            </script>



            <!-- SweetAlert Script -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <!-- Validation Script -->
            <script>
                document.getElementById('payment-form').addEventListener('submit', function(event) {
                    event.preventDefault(); // Empêcher l'envoi immédiat du formulaire

                    // Récupérer les valeurs des champs
                    let lastName = document.getElementById('prenom').value.trim();
                    let phone = document.getElementById('phone').value.trim();
                    let address = document.getElementById('address').value.trim();

                    // Vérifier si tous les champs obligatoires sont remplis
                    if (!lastName || !phone || !address) {
                        // Afficher une alerte SweetAlert si un champ est manquant
                        Swal.fire({
                            icon: 'error',
                            title: 'Champs manquants',
                            text: 'Veuillez remplir tous les champs obligatoires.',
                            confirmButtonText: 'OK'
                        });
                        return; // Ne pas soumettre le formulaire
                    }

                    // Si tout est valide, soumettre le formulaire
                    // this.submit();
                });
            </script>


        </section>




        <style>
            .form-control {
                color: black !important;
                text-align: left !important;
                padding-left: 10px !important;
            }
        </style>

    </main>
@endsection
