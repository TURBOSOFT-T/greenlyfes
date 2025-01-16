@extends('back.layout')

@section('css')
    <style>
        .custom-file-label::after {
            content: "Parcourir";
        }
    </style>
@endsection

@section('main')
    <div class="container-fluid">
        @if (session()->has('alert'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('alert') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <form id="roomForm" method="post"
                        action="{{ Route::currentRouteName() === 'saverooms.edit' ? route('saverooms.update', $room->id) : route('saverooms.store') }}"
                        enctype="multipart/form-data">

                        @if (Route::currentRouteName() === 'saverooms.edit')
                            @method('PUT')
                        @endif

                        @csrf
                        <div class="row">
                            <div class="col-md-8">

                                <x-back.validation-errors :errors="$errors" />

                                @if (session('ok'))
                                    <x-back.alert type='success' title="{!! session('ok') !!}">
                                    </x-back.alert>
                                @endif

                                <x-back.card type='info' :outline="true" title=''>

                                    <x-back.input title='Name' name='name' :value="isset($room) ? $room->name : ''" input='text'
                                        :required="true">
                                    </x-back.input>
                                    <x-back.input title='Prix' name='price' :value="isset($room) ? $room->price : ''" input='text'
                                        :required="true">
                                    </x-back.input>

                                    <x-back.input title='Slug' name='slug' :value="isset($room) ? $room->slug : ''" input='text'
                                        :required="true">
                                    </x-back.input>

                                    <x-back.card type='primary' title='Excerpt'>
                                        <x-back.input name='excerpt' :value="isset($room) ? $room->excerpt : ''" input='textarea' :required="true">
                                        </x-back.input>
                                    </x-back.card>





                                    {{-- <div>
                                    <label for="images">Images (Many):</label>
                                    <input type="file" name="images[]" id="images" multiple required>
                                </div> --}}

                                    {{--     <x-back.card type='primary' title='Description'>
                                    <x-back.input name='description' id="description-editor"
                                        :value="isset($room) ? $room->description : ''" input='textarea' rows=10
                                        :required="true">
                                    </x-back.input>
                                </x-back.card> --}}

                                    {{--     <x-back.card type='primary' title='Description'>
                                    <textarea name="description" id="description-editor" rows="10" cols="130" required>
                                        {{ isset($room) ? $room->description : '' }}
                                    </textarea>
                                </x-back.card> --}}

                                    <div class="form-group">
                                        <label><strong>Description :</strong></label>
                                        <textarea class="ckeditor form-control" name="body"></textarea>
                                    </div>




                                </x-back.card>






                                <button type="submit" class="btn btn-primary">@lang('Submit')</button>

                            </div>

                            <div class="col-md-4">

                                {{--  <x-back.card type='primary' :outline="false" title='Publication'>
                                <x-back.input name='active' :value="isset($post) ? $post->active : false"
                                    input='checkbox' label="Active">
                                </x-back.input>
                            </x-back.card> --}}

                                <x-back.card type='warning' :outline="false" title='Categories' :required="true">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Logement:</strong>
                                            <select name="book_id" id="book_id" class='form-control'>
                                                <option hidden>-- Logement--</option>
                                                @foreach ($books as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </x-back.card>

{{-- 

                                <div class="form-group{{ $errors->has('cover') ? ' is-invalid' : '' }}">
                                    <label for="description">Image de la page</label>
                                    @if (isset($room) && !$errors->has('cover'))
                                        <div>
                                            <p><img src="{{ asset('images/thumbs/' . $room->cover) }}"></p>
                                            <button id="changeCover" class="btn btn-warning">Changer d'image</button>
                                        </div>
                                    @endif
                                    <div id="wrapper">
                                        @if (!isset($room) || $errors->has('cover'))
                                            <div class="custom-file">
                                                <input type="file" id="cover" name="cover"
                                                    class="{{ $errors->has('cover') ? ' is-invalid ' : '' }}custom-file-input"
                                                    required>
                                                <label class="custom-file-label" for="cover"></label>
                                                @if ($errors->has('cover'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('cover') }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div> --}}



                                <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                                    <label for="description">Image Principale</label>
                                    @if (isset($room) && !$errors->has('image'))
                                        <div>
                                            <p><img src="{{ asset('images/thumbs/' . $room->image) }}"></p>
                                            <button id="changeImage" class="btn btn-warning">Changer d'image</button>
                                        </div>
                                    @endif
                                    <div id="wrapper">
                                        @if (!isset($room) || $errors->has('image'))
                                            <div class="custom-file">
                                                <input type="file" id="image" name="image"
                                                    class="{{ $errors->has('image') ? ' is-invalid ' : '' }}custom-file-input"
                                                    required>
                                                <label class="custom-file-label" for="image"></label>
                                                @if ($errors->has('image'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('image') }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label> Autres Images suplémentaires</label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                </div>

                                <div class="form-group">
                                    <label for="video"><strong>Vidéo :</strong></label>
                                    <input type="file" class="form-control" name="video" accept="video/*">
                                </div>




                                <x-back.card type='info' :outline="false" title='SEO'>
                                    <x-back.input title='META Description' name='meta_description' :value="isset($produc) ? $room->meta_description : ''"
                                        input='textarea' :required="true">
                                    </x-back.input>
                                    <x-back.input title='META Keywords' name='meta_keywords' :value="isset($room) ? $room->meta_keywords : ''"
                                        input='textarea' :required="true">
                                    </x-back.input>
                                    <x-back.input title='SEO Title' name='seo_title' :value="isset($room) ? $room->seo_title : ''" input='text'
                                        :required="true">
                                    </x-back.input>
                                </x-back.card>


                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
@section('js')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
    <script>
        $(function() {
            $('#slug').keyup(function() {
                $(this).val(getSlug($(this).val()))
            })

            $('#title').keyup(function() {
                $('#slug').val(getSlug($(this).val()))
            })
        });
    </script>

    <script>
        $(document).ready(() => {
            $('form').on('change', '#image', e => {
                $(e.currentTarget).next('.custom-file-label').text(e.target.files[0].name);
            });
            $('#changeImage').click(e => {
                $(e.currentTarget).parent().hide();
                $('#wrapper').html(`
          <div id="image" class="custom-file">
            <input type="file" id="image" name="image" class="custom-file-input" required>
            <label class="custom-file-label" for="image"></label>
          </div>`);
            });
        });
    </script>


<script>
    $(document).ready(() => {
        $('form').on('change', '#cover', e => {
            $(e.currentTarget).next('.custom-file-label').text(e.target.files[0].name);
        });
        $('#changeCover').click(e => {
            $(e.currentTarget).parent().hide();
            $('#wrapper').html(`
      <div id="cover" class="custom-file">
        <input type="file" id="cover" name="cover" class="custom-file-input" required>
        <label class="custom-file-label" for="cover"></label>
      </div>`);
        });
    });
</script>



<script>
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name
            .toLowerCase()                 // Convertir en minuscules
            .replace(/[^a-z0-9\s-]/g, '') // Supprimer les caractères spéciaux
            .replace(/\s+/g, '-')         // Remplacer les espaces par des tirets
            .replace(/-+/g, '-');         // Réduire plusieurs tirets en un seul

        document.getElementById('slug').value = slug;
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('roomForm').addEventListener('submit', async function (e) {
    e.preventDefault(); // Empêche l'envoi du formulaire par défaut

    const name = document.getElementById('name').value.trim();
    const slug = document.getElementById('slug').value.trim();

    // Étape 1 : Vérification des champs obligatoires
    if (!name || !slug) {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Tous les champs doivent être remplis.',
        });
        return;
    }

    // Étape 2 : Vérification des doublons
    const slugExists = await checkSlugAvailability(slug);
    if (slugExists) {
        Swal.fire({
            icon: 'error',
            title: 'Doublon détecté',
            text: `Le slug "${slug}" est déjà utilisé. Choisissez un autre.`,
        });
        return;
    }

    // Étape 3 : Si tout est correct, soumettre le formulaire
    Swal.fire({
        icon: 'success',
        title: 'Succès',
        text: 'Formulaire validé avec succès !',
    }).then(() => {
        e.target.submit(); // Soumettre le formulaire
    });
});

// Fonction pour vérifier si le slug existe déjà
async function checkSlugAvailability(slug) {
    try {
        const response = await fetch(`/room/check-slug?slug=${encodeURIComponent(slug)}`);
        if (!response.ok) throw new Error('Erreur réseau');
        const result = await response.json();
        return result.exists; // Retourne true si le slug existe
    } catch (error) {
        console.error('Erreur lors de la vérification du slug :', error);
        Swal.fire({
            icon: 'error',
            title: 'Erreur serveur',
            text: 'Impossible de vérifier le slug actuellement.',
        });
        return true; // Empêche la soumission en cas de problème serveur
    }
}

</script>
@endsection

@endsection
