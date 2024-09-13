@extends('back.layout')
@section('main')

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editer les information sur: {{ $hopital->title }}</h2>
            </div>
            <br>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('hopitals.index') }}"> Retouener à la liste</a>
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


    <form id="updateForm" action="{{ route('hospitals.update', $hopital->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
 
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Nom :</strong>
                    <input type="text" name="name" value="{{ $hopital->title }}" class="form-control"
                        placeholder="Title" required>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label class="form-label" for="email"><strong>E-mail:</strong></label>
                    <input type="text" id="email" name="email" value="{{ old('email', $hopital->email) ?? '' }}" class="form-control" placeholder="Email" required>
                </div>
            </div>

            
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label class="form-label" for="telephone"><strong>Téléphone:</strong></label>
                    <input type="tel" id="telephone" name="telephone" value="{{ old('telephone', $hopital->telephone) ?? '' }}" class="form-control" placeholder="Téléphone" required>
                </div>
            </div>

            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label class="form-label" for="ville"><strong>Ville:</strong></label>
                    <input type="text" id="ville" name="ville" value="{{ old('ville', $hopital->ville) ?? '' }}" class="form-control" placeholder="Ville" required>
                </div>
            </div>

             <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label class="form-label" for="meta_keywords"><strong>Meta_keywords:</strong></label>
                    <input type="text" id="excerpt" name="meta_keywords" value="{{ old('meta_keywords', $hopital->meta_keywords) ?? '' }}" class="form-control" placeholder="Meta_keywords" required>
                </div>
            </div> -
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label class="form-label" for="seo_title"><strong>Seo_title:</strong></label>
                    <input type="text" id="seo_title" name="adresse" value="{{ old('seo_title', $hopital->seo_title) ?? '' }}" class="form-control" placeholder="seo_title" required>
                </div>
            </div>


             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label class="form-label" for="adresse"><strong>Adresse:</strong></label>
                    <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $hopital->adresse) ?? '' }}" class="form-control" placeholder="Adresse" required>
                </div>
            </div> 
           
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label class="form-label" for="excerpt"><strong>Excerpt:</strong></label>
                    <input type="text" id="excerpt" name="excerpt" value="{{ old('excerpt', $hopital->excerpt) ?? '' }}" class="form-control" placeholder="Excerpt" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label class="form-label" for="meta_description"><strong>Meta_description:</strong></label>
                    <input type="text" id="meta_description" name="meta_description" value="{{ old('meta_description', $hopital->meta_description) ?? '' }}" class="form-control" placeholder="meta_description" required>
                </div>
            </div>
          
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label class="form-label" for="active"><strong>Activation:</strong></label>
                    <input type="checkbox" id="active" v-model="form.active" class="form-check-input">
                    <label for="active" class="form-check-label">Active</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label class="form-label" for="excerpt"><strong>Excerpt:</strong></label>
                    <input type="text" id="excerpt" name="adresse" value="{{ old('excerpt', $hopital->excerpt) ?? '' }}" class="form-control" placeholder="Excerpt" required>
                </div>
            </div>
            <x-back.card
            type='warning'
            :outline="false"
            title='Specifications'
            :required="true">
            <x-back.input
                name='specialites'
                :values="isset($hopital) ? $hopital->specialites : collect()"
                input='selectMultiple'
                :options="$specialites">
            </x-back.input>
        </x-back.card> 


            @if (isset($hopital) && !$errors->has('image'))
                <div>
                    <p>
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                        <img class="card-img-top product-image" src="{{ url('public/Image/' . $hopital->image) }}">

                    </div>
                    </p>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                </div>
            @endif


            <div class="col-xs-12 col-sm-12 col-md-12">
                <label class="form-label">Description</label>
                <textarea rows="4" cols="50" name="body" value="{{ $hopital->body }}" class="form-control"
                    placeholder="Add content" required>{{ old('body', $hopital->body) }}</textarea>
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
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('updateForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche la soumission classique du formulaire

            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        return response.text();
                    } else {
                        return response.text().then(text => {
                            throw new Error(text);
                        });
                    }
                })
                .then(responseText => {
                    if (responseText.includes('Echec de mise à jour.')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: 'Echec de mise à jours.'
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès',
                            text: 'Mise à jour effectuée avec succès.'
                        });
                        // Optionnel : redirection après succès
                        setTimeout(() => {
                            window.location.href = "{{ route('hopitals.index') }}";
                        }, 2000);
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue. Veuillez réessayer plus tard.'
                    });
                });
        });
    });
</script>
