@extends('back.layout')
@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit room</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('rooms.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
       @method('PUT')
<input type = "hidden" name = "id" value = "{{ $room->id }} " />

        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="name" value="{{ $room->name }}" class="form-control"
                        placeholder="Title" required>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Prix:</strong>
                    <input type="number" name="price" value="{{ $room->price }}" class="form-control"
                        placeholder="Prix" required>
                </div>
            </div> 

            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Slug:</strong>
                    <input type="text" name="slug" value="{{ $room->slug }}" class="form-control"
                        placeholder="Title" required>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Excerpt(m²):</strong>
                    <input type="text" name="excerpt" value="{{ $room->excerpt }}" class="form-control"
                        placeholder="Title" required>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Short_description(Prix):</strong>
                    <input type="text" name="meta_description" value="{{ $room->meta_description }}" class="form-control"
                        placeholder="Title" required>
                </div>
            </div>

          

            @if (isset($room) && !$errors->has('image'))
                <div>
                    <p>
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                        <img class="card-img-top room-image" src="{{ url('public/Image/' . $room->image) }}">

                    </div>
                    </p>
                    <div class="col-xs-6 col-sm-12 col-md-12">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>

                
                </div>
            @endif

            <div class="col-md-6">

                <p>Les Autres images :</p>
    
                @foreach (json_decode($room->images) as $key => $image)
                    <img class="card-img-top mb-3 room-image" src="{{ url('public/Image/' . $image) }}"
                        style="width: 100px; height: 100px;">
                @endforeach

                <div class="form-group">
                    <label>Images</label>
                    <input type="file" name="images[]"class="form-control-file" multiple >
                </div>
            </div>

<br>

            <div class="col-md-6">
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



            <div class="col-md-12">
                <label for="video"><strong>Nouvelle Vidéo :</strong></label>
                <input type="file"class="form-control-file"name="video" accept="video/*">
            </div>
            
            
           



            <div class="col-xs-12 col-sm-12 col-md-12">
                <label class="form-label">Content</label>
                <textarea rows="4" cols="50" name="boby" value="{{ $room->body }}" class="form-control"
                    placeholder="Add content" required> {!! $room->body !!}</textarea>
                @error('body')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>
@endsection
