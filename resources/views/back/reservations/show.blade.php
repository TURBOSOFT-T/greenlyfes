@extends('back.layout')


@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Détails de la réservation') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-md-4 text-right">{{ __('Nom') }}:</label>
                        <div class="col-md-8">
                            <p>{{ $reservation->nom }}</p>
                        </div>

                        
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 text-right">{{ __('Prénom') }}:</label>
                        <div class="col-md-8">
                            <p>{{ $reservation->prenom }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 text-right">{{ __('Téléphone') }}:</label>
                        <div class="col-md-8">
                            <p>{{ $reservation->telephone }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 text-right">{{ __('Email') }}:</label>
                        <div class="col-md-8">
                            <p>{{ $reservation->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 text-right">{{ __('Date ') }}:</label>
                        <div class="col-md-8">
                            <p>{{ $reservation->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 text-right">{{ __('Message') }}:</label>
                        <div class="col-md-8">
                            <p>{{ $reservation->note ?? __('Aucun message') }}</p>
                        </div>
                    </div>

                    

                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                                {{ __('Retour à la liste des réservations') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection