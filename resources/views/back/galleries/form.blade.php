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
    @if(session()->has('alert'))
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

                <form method="post"
                    action="{{ Route::currentRouteName() === 'galleries.edit' ? route('galleries.update', $gallery->id) : route('savegalleries.store') }}"
                    enctype="multipart/form-data">

                    @if(Route::currentRouteName() === 'galleries.edit')
                    @method('PUT')
                    @endif

                    @csrf
                    <div class="row">
                        <div class="col-md-8">

                            <x-back.validation-errors :errors="$errors" />

                            @if(session('ok'))
                            <x-back.alert type='success' title="{!! session('ok') !!}">
                            </x-back.alert>
                            @endif

                            <x-back.card type='info' :outline="true" title=''>
                                <x-back.input title='Title' name='titre' :value="isset($gallery) ? $gallery->titre : ''"
                                    input='text' :required="true">
                                </x-back.input>
                               {{--  <x-back.input title='Slug' name='slug' :value="isset($gallery) ? $gallery->slug : ''"
                                    input='text' :required="true">
                                </x-back.input> --}}

                               {{--  <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                                    <label for="description">Image(640*516):</label>
                                    @if(isset($home) && !$errors->has('image'))
                                    <div>
                                        <p><img src="{{ asset('images/thumbs/' . $gallery->image) }}"></p>
                                        <button id="changeImage" class="btn btn-warning">Changer d'image</button>
                                    </div>
                                    @endif
                                    <div id="wrapper">
                                        @if(!isset($gallery) || $errors->has('image'))
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
                                </div> --}}

                              

                               <x-back.card type='primary' title='Description'>
                               <x-back.input name='description'
                                    :value="isset($gallery) ? $gallery->description : ''" input='textarea' rows=5
                                    :required="true">
                                </x-back.input> 

                            {{--     <div class="form-group">
                                    <label><strong>Description :</strong></label>
                                    <textarea class="ckeditor form-control" name="description"></textarea>
                                </div> --}}
                            </x-back.card>
                            </x-back.card>



                            <button type="submit" class="btn btn-primary">@lang('Submit')</button>

                        </div>

                        
                        <div class="col-md-4">

                       

                           


                            <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                                <label for="description">Image(640*516):</label>
                                @if(isset($home) && !$errors->has('image'))
                                <div>
                                    <p><img src="{{ asset('images/thumbs/' . $gallery->image) }}"></p>
                                    <button id="changeImage" class="btn btn-warning">Changer d'image</button>
                                </div>
                                @endif
                                <div id="wrapper">
                                    @if(!isset($gallery) || $errors->has('image'))
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
                                <label for="video"><strong>Vidéo :</strong></label>
                                <input type="text" class="form-control" name="video" >
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
    $(function()
        {
            $('#slug').keyup(function () {
              $(this).val(getSlug($(this).val()))
            })

            $('#title').keyup(function () {
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
          </div>`
        );
      });
    });
</script>

@endsection

@endsection


{{--
@section('js')
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
          </div>`
        );
      });
    });
</script>
@endsection --}}
