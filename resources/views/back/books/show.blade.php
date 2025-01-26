@extends('back.layout')
@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Les détails sur votre logement </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Nom: {{ $book->name }}</h2>
        <br>
        <p><strong>Created At: </strong> {{ $book->created_at }}</p>

        <br>
        <p><strong>Description: </strong> {!! $book->body !!}</p>


        
        <br>
        <img class="w-50" {{-- src="{{ url('public/image/Products/' . $book->image) }}" --}} src="{{ url('public/Image/' . $book->image) }}">
        <br>
        <br>
        <div class="col-md-6">

            <p>Les Autres images :</p>

            @foreach (json_decode($book->images) as $key => $image)
                <img class="card-img-top mb-3 product-image" src="{{ url('public/Image/' . $image) }}"
                    style="width: 100px; height: 100px;">
            @endforeach
        </div>
        <br>

        <div class="product-action mb--20">
            <div class="addto-cart-btn">


                @if (isset($book->video))
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
                            <source src="{{ asset('storage/' . $book->video) }}" type="video/mp4">
                            Votre navigateur ne supporte pas la balise vidéo.
                        </video>
                    </div>
                @else
                    <p>Aucune vidéo disponible pour ce book.</p>
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

    <a href="{{ route('books.index') }}" class="btn btn-primary">Back to List</a>
    </div>

    </div>
@endsection
