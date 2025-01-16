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
        <link rel="stylesheet" href="{{ asset('css/form.css') }}">




        <!-- FullCalendar CSS -->
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
        <!-- FullCalendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
        <!-- Moment.js (nécessaire pour certaines fonctionnalités) -->
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

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
                                                        @error('nom')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-grp">
                                                        <label for="">Prénom :</label>
                                                        <input type="text" class="form-control" name="prenom"
                                                            value="{{ Auth::user()->last_name ?? ' ' }}" id="prenom"
                                                            required>

                                                        @error('prenom')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
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
                                                    <textarea name="address" class="form-control" id="address" cols="30" rows="" required></textarea>
                                                </div>



                                                <div class="col-md-6">
                                                    <div class="tp-checkout-input">
                                                        <label>Phone <span>*</span></label>
                                                        <input name="telephone" type="number" placeholder="" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="tp-checkout-input">
                                                        <label>Nombre de personnes <span>*</span></label>
                                                        <input name="nb_personnes" type="number" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                              

                                                    <button type="button" class="btn btn-info" id="showCalendarBtn" data-bs-toggle="modal" data-bs-target="#calendarModal" data-room-id="{{ $room->id }}">
                                                        Voir les périodes Réservées
                                                    </button>
                                                    
                                                </div>

                                                <div class="modal fade" id="calendarModal" tabindex="-1"
                                                    aria-labelledby="calendarModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="calendarModalLabel">Périodes
                                                                    Réservées</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div id="calendar"></div>
                                                                <!-- Conteneur pour FullCalendar -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-grp">
                                                            <label for="start_date">Date de début :</label>
                                                            <input type="date" class="form-control" name="date_debut"
                                                                id="date_debut" value="{{ old('date_debut') }}" required>
                                                            @error('date_debut')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-grp">
                                                            <label for="date_fin">Date de fin :</label>
                                                            <input type="date" class="form-control" name="date_fin"
                                                                id="date_fin" value="{{ old('date_fin') }}" required>
                                                            @error('date_fin')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-grp">
                                                            <label for="limit">Date Limite payement :</label>
                                                            <input type="date" class="form-control" name="limit"
                                                                id="limit" value="{{ old('limit') }}" required>
                                                            @error('limit')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="col-md-12">
                                                    <div class="tp-checkout-input">
                                                        <label for="">Message (optional)</label>

                                                        <textarea rows="4" cols="50" id="note" name="note" class="form-control"
                                                            placeholder="Add content">  </textarea>
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

                                                <th class="room-name">Chambre</th>

                                                <th class="room-total">Photo</th>
                                                <th class="room-total">Prix</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="cart_item">

                                                <td class="room-name">
                                                    {{ $room->name }} <strong class="room-quantity">

                                                </td>
                                                <td class="room-total">
                                                    <span class="amount"> <img
                                                            src="{{ url('public/Image/' . $room->image) }}"
                                                            alt="" width="200 " height="200 ">
                                                </td>

                                                <td class="room-price">

                                                    <span class="amount" id="room-price"
                                                        data-prix="{{ $room->getPrice() }}">
                                                        {{ number_format($room->getPrice(), 2) }} <x-devise></x-devise>
                                                    </span>
                                                </td>

                                            </tr>



                                        </tbody>

                                    </table>
                                </ul>

                                <br><br>


                                <!-- Affichage du prix total -->
                                <div class="form-grp">

                                    <div class="form-control" id="days_reserved">Nombre de jours réservés : 0</div>

                                </div>
                                <br>
                                <br>
                                <div class="form-control" id="prix-total">Total : 0
                                    <x-devise></x-devise>
                                </div>

                            </div>
                            <br><br><br>

                            <div class="tp-checkout-btn-wrapper">
                                <input type="submit" class="tp-btn-theme text-center w-100 check-btn"
                                    value="Confirmer la réservation">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>



        </section>


        <script>
            $(document).ready(function() {
                $('#reservation-form').on('change', 'input[name="date_debut"], input[name="date_fin"]', function() {
                    var date_debut = $('input[name="date_debut"]').val();
                    var date_fin = $('input[name="date_fin"]').val();
                    var prix_par_nuit = parseFloat($('#room-price').data(
                        'prix'));


                    if (date_debut && date_fin) {

                        var startDate = new Date(date_debut);
                        var endDate = new Date(date_fin);
                        var diffTime = endDate - startDate;
                        var diffDays = diffTime / (1000 * 3600 * 24);

                        if (diffDays > 0) {

                            var prix_total = diffDays * prix_par_nuit;


                            $('#prix-total').text('Prix total : ' + prix_total.toFixed(2) + 'DT');
                            $('#days_reserved').text('Nombre de jours réservés : ' + diffDays);
                        } else {

                            $('#prix-total').text('Veuillez sélectionner des dates valides.');
                            $('#days_reserved').text('Veuillez sélectionner des dates valides.');
                        }
                    }
                });

                // Validation du formulaire
                $('#reservation-form').on('submit', function(e) {
                    e.preventDefault(); // Empêcher la soumission pour la vérification

                    var room_id = $('input[name="room_id"]').val();
                    var date_debut = $('input[name="date_debut"]').val();
                    var date_fin = $('input[name="date_fin"]').val();
                    var limit = $('input[name="limit"]').val();
                    var nom = $('input[name="nom"]').val();
                    var prenom = $('input[name="prenom"]').val();

                    // Vérification des champs obligatoires
                    if (nom.trim() === '' || prenom.trim() === '' || !date_debut || !date_fin) {
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'Tous les champs sont obligatoires.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    // Vérification si la date de début est avant la date de fin
                    if (new Date(date_debut) >= new Date(date_fin)) {
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'La date de début doit être inférieure à la date de fin.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    // Vérification de la date limite de paiement
                    if (new Date(limit) >= new Date(date_debut)) {
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'La date limite de paiement doit être inférieure à la date de début.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    // Vérification de la disponibilité de la chambre
                    $.ajax({
                        url: '{{ url('/check-availability') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            room_id: room_id,
                            date_debut: date_debut,
                            date_fin: date_fin,
                            limit: limit
                        },
                        success: function(response) {
                            if (response.isBooked) {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'La chambre est déjà réservée pour cette période.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            } else {
                                $('#reservation-form')[0].submit();
                            }
                        }
                    });
                });
            });
        </script>


        <script>
            $(document).ready(function() {
                $('#date_debut, #date_fin').on('change', function() {
                    var room_id = $('input[name="room_id"]').val();
                    var date_debut = $('#date_debut').val();
                    var date_fin = $('#date_fin').val();

                    // Vérifier que les dates sont valides
                    if (date_debut && date_fin && new Date(date_debut) < new Date(date_fin)) {
                        $.ajax({
                            url: '/calculate-total-price',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                room_id: room_id,
                                date_debut: date_debut,
                                date_fin: date_fin
                            },
                            success: function(response) {
                                // Afficher le prix total et le nombre de nuits
                                $('#total_price').val(response
                                    .totalPrice); // Afficher le prix total
                                $('#number_of_nights').text(response
                                    .numberOfNights); // Afficher le nombre de nuits
                                $('#room_name').text(response
                                    .roomName); // Afficher le nom de la chambre
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'Une erreur est survenue lors du calcul du prix.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarInitialized = false; 
                var calendarEl = document.getElementById('calendar');
                $('#calendarModal').on('shown.bs.modal', function() {
                    var roomId = document.querySelector('#showCalendarBtn').getAttribute('data-room-id');
                    var occupiedPeriodsUrl = `/check-occupied-periods`;

                    if (!calendarInitialized) {
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            events: function(fetchInfo, successCallback, failureCallback) {
                                $.ajax({

                            
                                url: '/check-occupied-periods/' + roomId,
                            method: 'GET',
                                    success: function(data) {
                                        var events = data.map(function(period) {
                                            return {
                                                title: 'Réservée',
                                                start: period.date_debut,
                                                end: moment(period.date_fin)
                                                    .add(1, 'days').format(
                                                        'YYYY-MM-DD'),
                                                color: '#ff0000' 
                                            };
                                        });
                                        successCallback(events);
                                    },
                                    error: function() {
                                        alert(
                                            'Erreur lors du chargement des périodes.'
                                        );
                                    }
                                });
                            }
                        });

                        calendar.render();
                        calendarInitialized = true; 
                    }
                });


            });
        </script>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>




    </main>
@endsection
