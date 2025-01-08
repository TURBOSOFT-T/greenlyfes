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
                                                            value="{{ Auth::user()->name ?? ' '}}" id="nom" required>
                                                            @error('nom')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-grp">
                                                        <label for="">Prénom :</label>
                                                        <input type="text" class="form-control" name="prenom"
                                                            value="{{ Auth::user()->last_name ?? ' ' }}" id="prenom" required>

                                                            @error('prenom')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
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

                                                    <button type="button" class="btn btn-info" id="showModalBtn">Voir les périodes occupées </button>

                                                </div>


                                                
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-grp">
                                                            <label for="start_date">Date de début :</label>
                                                            <input type="date" class="form-control" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" required>
                                                            @error('date_debut')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-grp">
                                                            <label for="date_fin">Date de fin :</label>
                                                            <input type="date" class="form-control" name="date_fin"  id="date_fin" value="{{ old('date_fin') }}" required>
                                                            @error('date_fin')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-grp">
                                                            <label for="limit">Date Limite  payement :</label>
                                                            <input type="date" class="form-control" name="limit" id="limit" value="{{ old('limit') }}" required>
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
                                                        placeholder="Add content" >  </textarea>
                                                    @error('note')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror                                                    </div>
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
                            <h3 class="tp-checkout-place-title">Votre reservation</h3>
                            <div class="tp-order-info-list">
                                <ul>

                                    <table>
                                        <thead>
                                            <tr>
                                                
                                                <th class="room-name">Chambre</th>
                                          
                                                <th class="room-total">Image</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="cart_item">

                                                <td class="room-name">
                                                    {{ $room->name }} <strong class="room-quantity"> 

                                                </td>
                                                <td class="room-total">
                                                    <span class="amount">  <img src="{{ url('public/Image/' . $room->image) }}" alt=""  width="200 " height="200 ">
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </ul>


                            </div>
                            <br><br><br>

                            <div class="tp-checkout-btn-wrapper">
                                <input type="submit"  class="tp-btn-theme text-center w-100 check-btn"
                                    value="Confirmer la réservation">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>



        </section>

       
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#reservation-form').on('submit', function(e) {
            e.preventDefault(); // Empêcher la soumission du formulaire pour la vérification

            var room_id = $('input[name="room_id"]').val();
            var date_debut = $('input[name="date_debut"]').val();
            var date_fin = $('input[name="date_fin"]').val();
            var limit = $('input[name="limit"]').val();
            var nom = $('input[name="nom"]').val();
            var prenom = $('input[name="prenom"]').val();


            // Vérifier si le champ nom est vide
            if (nom.trim() === '') {
                Swal.fire({
                    title: 'Erreur!',
                    text: 'Le champ nom est obligatoire.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return; // Empêcher l'exécution de la suite si le nom est vide
            }

            // Vérifier si le champ prénom est vide
            if (prenom.trim() === '') {
                Swal.fire({
                    title: 'Erreur!',
                    text: 'Le champ prénom est obligatoire.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return; // Empêcher l'exécution de la suite si le prénom est vide
            }

             // Vérifier si la date de début est inférieure à la date de fin
             if (new Date(date_debut) >= new Date(date_fin)) {
                Swal.fire({
                    title: 'Erreur!',
                    text: 'La date de début doit être inférieure à la date de fin.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return; // Empêcher l'exécution de la requête AJAX si les dates ne sont pas valides
            }


             // Vérifier si la date de début est inférieure à la date de fin
             if (new Date(limit) >= new Date(date_debut)) {
                Swal.fire({
                    title: 'Erreur!',
                    text: 'La date limite de payement doit être inférieure à la date debut.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return; // Empêcher l'exécution de la requête AJAX si les dates ne sont pas valides
            }

            // Vérifier la disponibilité de la chambre via AJAX
            $.ajax({
                url: '{{ url('/check-availability') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    room_id: room_id,
                    date_debut: date_debut,
                    date_fin: date_fin
                },
                success: function(response) {
                    if (response.isBooked) {
                        // Afficher un message d'erreur si la chambre est déjà réservée
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'La chambre est déjà réservée pour cette période.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        // Soumettre le formulaire si la chambre est disponible
                        $('#reservation-form')[0].submit();
                    }
                }
            });
        });
    });
</script>



<!-- Modal -->
<div class="modal fade" id="reservationsModal" tabindex="-1" aria-labelledby="reservationsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationsModalLabel">Périodes réservées</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="calendar"></div> <!-- Contenant du calendrier -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


 <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

<script>
    $(document).ready(function() {
    // Ouvrir le modal lorsque le bouton est cliqué
    $('#showModalBtn').on('click', function() {
        $('#reservationsModal').modal('show'); // Ouvre le modal
    });

    // Charger les réservations pour un mois spécifique
    function loadReservations(month) {
        var roomId = $('input[name="room_id"]').val(); // Récupérer l'ID de la chambre

        $.ajax({
            url: '{{ url('/get-reservations-by-month') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                room_id: roomId,
                month: month // Passer le mois sélectionné
            },
            success: function(response) {
                var reservedPeriods = response;
                displayCalendar(reservedPeriods); // Afficher les réservations sur le calendrier
            }
        });
    }

    // Afficher le calendrier avec les périodes réservées
    function displayCalendar(reservedPeriods) {
        $('#calendar').empty(); // Réinitialiser le calendrier

        // Utilisez une bibliothèque comme FullCalendar ou une logique simple pour afficher le calendrier
        // Exemple simple : afficher les dates réservées sous forme de liste
        reservedPeriods.forEach(function(period) {
            $('#calendar').append('<p>Réservé du ' + period.start + ' au ' + period.end + '</p>');
        });
    }

    // Initialiser le calendrier pour le mois courant
    var currentMonth = moment().format('YYYY-MM');
    loadReservations(currentMonth); // Charger les réservations pour le mois actuel
});


function displayCalendar(reservedPeriods) {
    $('#calendar').empty(); // Réinitialiser le calendrier

    var events = reservedPeriods.map(function(period) {
        return {
            title: 'Réservé',
            start: period.start,
            end: period.end,
            color: 'red'
        };
    });

    // Initialisation de FullCalendar
    $('#calendar').fullCalendar({
        events: events,
        editable: false,
        droppable: false
    });
}


</script>
<style>
    .form-control{
        color: black !important;
        text-align: left !important;
        padding-left: 10px !important;
    }
</style>

    </main>
@endsection
