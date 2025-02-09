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

            <div class="container">
                <div class="row">


                    <div class="col-lg-7">
                        <div class="tp-checkout-bill-area">
                            <h3 class="tp-checkout-bill-title">Les informations personnelles</h3>
                            <div class="tp-checkout-bill-form">

                                @if ($errors->any())
                                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                                @endif
                              

                               

                                <form action="{{ route('order.confirm') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $produit->id }}" />
                                    <div class="d-flex justify-content-center pagination-lg">
                                        <div class="customer-details">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-grp">
                                                        <label for="">Nom :</label><span class="error-message"
                                                            id="name-error"></span><br>
                                                        <input type="text" class="form-control" name="first_name"
                                                            value="{{ Auth::user()->name ?? ' '}}" id="fname" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-grp">
                                                        <label for="">Prénom :</label><span class="error-message"
                                                            id="name-error"></span><br>
                                                        <input type="text" class="form-control" name="last_name"
                                                            value="{{ Auth::user()->last_name ?? ' ' }}" id="fname" required>
                                                    </div>
                                                </div>
                                                <div class="form-grp">
                                                    <label for="">Email :</label><span class="error-message"
                                                        id="email-error"></span><br>
                                                    <input type="text" class="form-control" name="email"
                                                        value="{{ Auth::user()->email  ?? ' '}}" id="email" required>
                                                </div>
                                                <div class="form-grp">
                                                    <label for="">Address :</label><span class="error-message"
                                                        id="address-error"></span><br>
                                                    <textarea name="address" class="form-control" id="address" cols="30" rows="" required></textarea>
                                                </div>

                                                

                                                <div class="col-md-12">
                                                    <div class="tp-checkout-input">
                                                        <label>Phone <span>*</span></label>
                                                        <input name="phone" type="number" placeholder="" required>
                                                    </div>
                                                </div>




                                                <div class="col-md-12">
                                                    <div class="tp-checkout-input">
                                                        <label for="">Message (optional)</label>
                                                     {{--    <textarea type="text" name="note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea> --}}

                                                     <textarea rows="4" cols="50" id="note" name="note" class="form-control"
                                                        placeholder="Add content" >  </textarea>
                                                    @error('note')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>


                                    {{--  <div class="d-flex justify-content-center pagination-lg">

                                    <input type="submit" class="btn btn-warning check-btn" value="Confirm Order">
                                </div> --}}
                                    {{-- </form> --}}
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
                                                <td class="product-total">
                                                    <span class="amount">  <img src="{{ url('public/Image/' . $produit->image) }}" alt=""  width="200 " height="200 ">
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </ul>


                            </div>
                            <br>

                            <div class="tp-checkout-btn-wrapper">

                                <div class="tp-checkout-terms-title">Payement par virement bancaire </div>
                                <div class="tp-checkout-terms-content">
                                    <ul>

                                        <table style="width:100%; border-collapse: collapse; border: 2px solid black;">
                                            <tbody>
                                                <tr class="cart_item">
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        Kontoinhaber / Beneficiary Name / Titulaire du compte
                                                    </td>
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        R.G. Beratung & Projektentwicklung <br>Dr. Spruth AG
                                                    </td>
                                                </tr>

                                                <tr class="cart_item">
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        Bank Name / <br>
                                                        Nom de la banque

                                                    </td>
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        CREDIT SUISSE AG
                                                    </td>
                                                </tr>

                                                <tr class="cart_item">
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        Bank Adresse / <br>
                                                        Adresse de la banque


                                                    </td>
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        Bahnhofstrasse 12, CH-7000 Chur
                                                    </td>
                                                </tr>


                                                <tr class="cart_item">
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        Bankkontakt / <br>
                                                        Contact / <br>
                                                        Contact de la banque



                                                    </td>
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        Thomas Philipp <br>
                                                        Telefon: +41 81 255 62 56 <br>
                                                        E-Mail: thomas.philipp@credit-suisse.com

                                                    </td>
                                                </tr>

                                                <tr class="cart_item">
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        Zeichnungsberechtigter / <br>
                                                        Account Signatory / <br>
                                                        Signataire autorisé


                                                    </td>
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        Reinhard Gerhard Spruth

                                                    </td>
                                                </tr>


                                                <tr class="cart_item">
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        IBAN USD

                                                    </td>
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        CH 85 0483 5187 1945 9200 0

                                                    </td>
                                                </tr>
                                                <tr class="cart_item">
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        IBAN CHF


                                                    </td>
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        CH 22 0483 5187 1945 9100 0

                                                    </td>
                                                </tr>
                                                <tr class="cart_item">
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        IBAN EURO


                                                    </td>
                                                    <td style="border: 1px solid black; padding: 10px;">
                                                        CH 58 0483 5187 1945 9200 1

                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </ul>


                                </div>

                                
                                <br>
                                <div class="tp-checkout-terms">
                                    <div class="tp-checkout-terms-title">Mode de paiement</div>
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
                                <br>

                                <div id="stripe-payment-form" style="display: none;">

                                    <div class="form-group">

                                        <div id="card-element"></div>
                                        <input type="hidden" name="stripeToken" id="stripeToken">
                                        <div id="card-errors" class="text-danger"></div>

                                    </div>
                                </div>
                                <br>
                                <input type="submit" class="tp-btn-theme text-center w-100 check-btn"
                                    value="Confirmer la commande">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>



            <script src="https://js.stripe.com/v3/"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                // Create a Stripe client.
                let stripe = Stripe('{{ config('app.STRIPE_KEY') }}')
                let elements = stripe.elements();
                let card = elements.create("card");
                card.mount("#card-element");

                let paymentMethodRadios = document.querySelectorAll("input[name='payment_method']");
                let stripePaymentForm = document.getElementById("stripe-payment-form");

                paymentMethodRadios.forEach(radio => {
                    radio.addEventListener("change", function() {
                        if (this.value === "stripe") {
                            stripePaymentForm.style.display = "block";
                        } else {
                            stripePaymentForm.style.display = "none";
                        }
                    });
                });

                let form = document.getElementById("reservation-form");
                let submitButton = document.getElementById("submit-button");

                form.addEventListener("submit", function(event) {
                    if (document.querySelector("input[name='payment_method']:checked").value === "stripe") {
                        event.preventDefault();
                        submitButton.disabled = true;
                        stripe.createToken(card).then(function(result) {
                            if (result.error) {
                                document.getElementById("card-errors").textContent = result.error
                                    .message;
                                submitButton.disabled = false;
                            } else {
                                document.getElementById("stripeToken").value = result.token.id;
                                form.submit();
                            }
                        });
                    }
                });
            });
        </script>

        </section>




<style>
    .form-control{
        color: black !important;
        text-align: left !important;
        padding-left: 10px !important;
    }
</style>

    </main>
@endsection
