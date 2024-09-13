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
                                                
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Photo</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="cart_item">

                                                <td class="product-name">
                                                    {{ $produit->name }} <strong class="product-quantity"> 

                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">  <img src="{{ url('public/Image/' . $produit->image) }}" alt=""  width="200 " height="200 ">
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </ul>


                            </div>
                            <br><br><br>

                            <div class="tp-checkout-btn-wrapper">
                                <input type="submit" class="tp-btn-theme text-center w-100 check-btn"
                                    value="Confirmer la commande">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

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
