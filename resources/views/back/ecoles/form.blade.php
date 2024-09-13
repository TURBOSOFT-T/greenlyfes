@extends('back.layout')

@section('css')
    <style>
        #holder img {
            height: 100%;
            width: 100%;
        }
    </style>
@endsection

@section('main')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Afficher les messages de succès --}}
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


    <form method="post" enctype="multipart/form-data"
        action="{{ Route::currentRouteName() === 'saveecole.edit' ? route('saveecole.update', $ecole->id) : route('saveecole.store') }}">

        @if (Route::currentRouteName() === 'saveecole.edit')
            @method('PUT')
        @endif

        @csrf
        {{-- <label for="active">Active:</label>
        <input type="checkbox" name="active" id="active"> --}}
        <div class="row">
            <div class="col-md-8">

                <x-back.validation-errors :errors="$errors" />

                @if (session('ok'))
                    <x-back.alert type='success' title="{!! session('ok') !!}">
                    </x-back.alert>
                @endif

                <x-back.card type='primary' title='Title'>
                    <x-back.input name='title' :value="isset($ecole) ? $ecole->title : ''" input='text' :required="true">
                    </x-back.input>
                </x-back.card>

                <x-back.card type='primary' title='Excerpt'>
                    <x-back.input name='excerpt' :value="isset($ecole) ? $ecole->excerpt : ''" input='textarea' :required="true">
                    </x-back.input>
                </x-back.card>

                <x-back.card type='primary' title='Body'>
                    <x-back.input name='body' :value="isset($ecole) ? $ecole->body : ''" input='textarea' rows=10 :required="true">
                    </x-back.input>
                </x-back.card>

                <button type="submit" class="btn btn-primary">@lang('Submit')</button>

            </div>
            <div class="col-md-4">

                <x-back.card type='primary' :outline="false" title='Publication'>
                    <x-back.input name='active' :value="isset($ecole) ? $ecole->active : false" input='checkbox' label="Active">
                    </x-back.input>
                </x-back.card>

                   <x-back.card
                    type='warning'
                    :outline="false"
                    title='Filieres'
                    :required="true">
                    <x-back.input
                        name='filieres'
                        :values="isset($ecole) ? $ecole->filieres : collect()"
                        input='selectMultiple'
                        :options="$filieres">
                    </x-back.input>
                </x-back.card> 

              {{--   <x-back.card type='warning' :outline="false" title='Filieres' :required="true">

                    @foreach ($filieres as $id => $title)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="filieres[]"
                                id="filiere_{{ $id }}" value="{{ $title }}"
                                @if (isset($ecole) && $ecole->filieres->pluck('title')->contains($title)) checked @endif>
                            <label class="form-check-label" for="filiere_{{ $id }}">
                                {{ $title }}
                            </label>
                        </div>
                    @endforeach

                </x-back.card> --}}





                <x-back.card type='success' :outline="false" title='Slug'>
                    <x-back.input name='slug' :value="isset($ecole) ? $ecole->slug : ''" input='text' :required="true">
                    </x-back.input>
                </x-back.card>

                <x-back.card type='primary' :outline="false" title='Image'>

                    <div id="holder" class="text-center" style="margin-bottom:15px;">
                        @isset($ecole)
                            <img style="width:90%;" src="{{ getImage($ecole, true) }}" alt="">
                        @endisset
                    </div>

                    {{--   <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary text-white" class="btn btn-outline-secondary" type="button">Button</a>
                      </div>
                      <input id="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" type="text" name="image" value="{{ old('image', isset($ecole) ? getImage($ecole) : '') }}" required>
                      @if ($errors->has('image'))
                          <div class="invalid-feedback">
                              {{ $errors->first('image') }}
                          </div>
                      @endif
                    </div> --}}

                    <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                        <label for="description">Image</label>
                        @if (isset($ecole) && !$errors->has('image'))
                            <div>
                                <p><img src="{{ asset('images/thumbs/' . $ecole->image) }}"></p>
                                <button id="changeImage" class="btn btn-warning">Changer d'image</button>
                            </div>
                        @endif
                        <div id="wrapper">
                            @if (!isset($ecole) || $errors->has('image'))
                                <div class="custom-file">
                                    <input type="file" id="image" name="image"
                                        class="{{ $errors->has('image') ? ' is-invalid ' : '' }}custom-file-input" required>
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


                </x-back.card>

                <x-back.card type='info' :outline="false" title='SEO'>
                    <x-back.input title='META Description' name='meta_description' :value="isset($ecole) ? $ecole->meta_description : ''" input='textarea'
                        :required="true">
                    </x-back.input>
                    <x-back.input title='META Keywords' name='meta_keywords' :value="isset($ecole) ? $ecole->meta_keywords : ''" input='textarea'
                        :required="true">
                    </x-back.input>
                    <x-back.input title='SEO Title' name='seo_title' :value="isset($ecole) ? $ecole->seo_title : ''" input='text' :required="true">
                    </x-back.input>
                </x-back.card>

            </div>
        </div>


    </form>



@section('js')
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
@endsection

@endsection

@section('js')
@include('back.shared.editorScript')
@endsection
