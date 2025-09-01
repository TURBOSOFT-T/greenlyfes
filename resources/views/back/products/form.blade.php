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

                    <form method="post" id="productForm"
                        action="{{ Route::currentRouteName() === 'saveproducts.edit' ? route('saveproducts.update', $product->id) : route('saveproducts.store') }}"
                        enctype="multipart/form-data">

                        @if (Route::currentRouteName() === 'saveproducts.edit')
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
                                    <x-back.input title='Name' name='name' :value="isset($product) ? $product->name : ''" input='text'
                                        :required="true">
                                    </x-back.input>

                                    <x-back.card type='primary' title='Description'>
                                        <x-back.input name='short_description' {{-- id="description-editor" --}}
                                            :value="isset($product) ? $product->short_description : ''" input='textarea' rows=1
                                            :required="true">
                                        </x-back.input>
                                    </x-back.card>

                                    <x-back.input title='Price' name='price' :value="isset($product) ? $product->price : ''" input='number'
                                        :required="true">
                                        </x-back.input>
                                    <x-back.input title='Slug' name='slug' :value="isset($product) ? $product->slug : ''" input='text'
                                        :required="true">
                                    </x-back.input>


                                    <div class="form-group">
                                        <label><strong>Description :</strong></label>
                                        <textarea class="ckeditor form-control" name="description"></textarea>
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
                                            <strong>Category:</strong>
                                            <select name="category_id" id="category" class='form-control'>
                                                <option hidden>--Sales Category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </x-back.card>



                                <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                                    <label for="description">Image</label>
                                    @if (isset($product) && !$errors->has('image'))
                                        <div>
                                            <p><img src="{{ asset('images/thumbs/' . $product->image) }}"></p>
                                            <button id="changeImage" class="btn btn-warning">Changer d'image</button>
                                        </div>
                                    @endif
                                    <div id="wrapper">
                                        @if (!isset($product) || $errors->has('image'))
                                            <div class="custom-file">
                                                <input type="file" id="image" name="image" accept="image/*"
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

            $('#name').keyup(function() {
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
                .toLowerCase() // Convertir en minuscules
                .replace(/[^a-z0-9\s-]/g, '') // Supprimer les caractères spéciaux
                .replace(/\s+/g, '-') // Remplacer les espaces par des tirets
                .replace(/-+/g, '-'); // Réduire plusieurs tirets en un seul

            document.getElementById('slug').value = slug;
        });
    </script>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('productForm').addEventListener('submit', async function(e) {
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
                const response = await fetch(`/product/check-slug?slug=${encodeURIComponent(slug)}`);
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
