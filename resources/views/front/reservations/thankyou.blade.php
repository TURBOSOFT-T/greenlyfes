@extends('front.fixe')
@section('titre', "Félicitation pour votre réservation")
@section('body')
    <main> 
        <br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-ms-6 mx-auto">
                    <div class="mt-5 mb-5">
                        <div class="card-body card-bodyx text-center ">
                            <h5 class="text-success">
                                <div>
                                    <img width="96" height="96" src="https://img.icons8.com/pulsar-line/96/578b07/order-completed.png" alt="order-completed"/>
                                </div>
                                <b>
                                    Félicitation pour votre réservation !
                                </b>
                            </h5>
                            <p>
                                Votre réservation a été enregistrée avec succès.
                            </p>
                            <br>
                            <div class="order-id">
                                <a href="{{ url('home') }}" class="btn btn-success" style="background-color: #578b07;">
                                    Continuer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>
    </main>

    <style>
        .card-bodyx{
            margin-bottom: 20px;
            margin-top: 20px;
        }
    </style>
@endsection
