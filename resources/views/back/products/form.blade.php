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
                    action="{{ Route::currentRouteName() === 'saveproducts.edit' ? route('saveproducts.update', $product->id) : route('saveproducts.store') }}"
                    enctype="multipart/form-data">

                    @if(Route::currentRouteName() === 'saveproducts.edit')
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
                                <x-back.input title='Name' name='name' :value="isset($product) ? $product->name : ''"
                                    input='text' :required="true">
                                </x-back.input>
                                <x-back.input title='Slug' name='slug' :value="isset($product) ? $product->slug : ''"
                                    input='text' :required="true">
                                </x-back.input>

                              {{--   <x-back.input title='Stock' name='stock' :value="isset($product) ? $product->stock : ''"
                                    input='number' :required="true">
                                </x-back.input>
                                <x-back.input title='Stock alert' name='stock_alert'
                                    :value="isset($product) ? $product->stock_alert : ''" input='number'
                                    :required="true">
                                </x-back.input>
 --}}



                                {{-- <div>
                                    <label for="images">Images (Many):</label>
                                    <input type="file" name="images[]" id="images" multiple required>
                                </div> --}}

                                <x-back.card type='primary' title='Description'>
                                    <x-back.input name='description'
                                        :value="isset($product) ? $product->description : ''" input='textarea' rows=10
                                        :required="true">
                                    </x-back.input>
                                </x-back.card>
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
                                @if(isset($product) && !$errors->has('image'))
                                <div>
                                    <p><img src="{{ asset('images/thumbs/' . $product->image) }}"></p>
                                    <button id="changeImage" class="btn btn-warning">Changer d'image</button>
                                </div>
                                @endif
                                <div id="wrapper">
                                    @if(!isset($product) || $errors->has('image'))
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

                         



                        </div>
                    </div>


                </form>

            </div>
        </div>
    </div>
</div>
@section('js')

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
