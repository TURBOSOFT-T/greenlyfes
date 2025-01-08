@extends('back.layout')
@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Les détails sur  la chambre </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('rooms.index') }}"> Back to List</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Nom: {{ $room->name }}</h2>
        <br>
        <p><strong>Created At: </strong> {{ $room->created_at }}</p>

        <br>
        <p><strong>Description: </strong> {!! $room->body !!}</p>

        <br>
        <img class="w-50" {{-- src="{{ url('public/image/Products/' . $room->image) }}" --}} src="{{ url('public/Image/' . $room->image) }}">
        <br>
        <br>
        <div class="col-md-6">

            <p>Les Autres images :</p>

            @foreach (json_decode($room->images) as $key => $image)
                <img class="card-img-top mb-3 product-image" src="{{ url('public/Image/' . $image) }}"
                    style="width: 100px; height: 100px;">
            @endforeach  
        </div>
        <br>

        <div class="product-action mb--20">
            <div class="addto-cart-btn">


                @if (isset($room->video))
                    <a class="rbt-btn btn-gradient hover-icon-reverse" id="play-video">
                        <span class="icon-reverse-wrapper">
                            <span class="btn-text"> Voir Détails en vidéo </span>
                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                        </span>
                    </a>


                    <!-- Le lecteur vidéo caché par défaut -->
                    <div id="video-container" style="display: none;">
                        <video width="640" height="360" controls>
                            <source src="{{ asset('storage/' . $room->video) }}" type="video/mp4">
                            Votre navigateur ne supporte pas la balise vidéo.
                        </video>
                    </div>
                @else
                    <p>Aucune vidéo disponible pour cette chambre.</p>
                @endif
            </div>

            <script>
                document.getElementById('play-video').addEventListener('click', function() {
                    var videoContainer = document.getElementById('video-container');
                    videoContainer.style.display = 'block'; // Afficher le conteneur vidéo

                    // Démarrer la lecture automatiquement
                    var video = videoContainer.querySelector('video');
                    video.play();
                });
            </script>

            <style>
                #video-container {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin-top: 20px;
                }
            </style>

        </div>


    </div>
    <br>
    <br>

    <a href="{{ route('rooms.index') }}" class="btn btn-primary">Back to room List</a>
    </div>

    </div>
@endsection
