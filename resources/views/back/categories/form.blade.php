@extends('back.layout')

@section('main')

    <form method="post"
        action="{{ Route::currentRouteName() === 'categories.edit' ? route('categories.update', $category->id) : route('categories.store') }}">

        @if (Route::currentRouteName() === 'categories.edit')
            @method('PUT')
        @endif

        @csrf

        <div class="row">
            <div class="col-md-12">

                <x-back.validation-errors :errors="$errors" />

                @if (session('ok'))
                    <x-back.alert type='success' title="{!! session('ok') !!}">
                    </x-back.alert>
                @endif

                <x-back.card type='info' :outline="true" title=''>
                    <x-back.input title='Title' name='title' :value="isset($category) ? $category->title : ''" input='text' :required="true">
                    </x-back.input>
                    <x-back.input title='Slug' name='slug' :value="isset($category) ? $category->slug : ''" input='text' :required="true">
                    </x-back.input>



                    <x-back.card type='primary' title='Description'>
                        <x-back.input name='body' :value="isset($category) ? $category->body : ''" input='textarea' rows=5 :required="true">
                        </x-back.input>
                    </x-back.card>
                </x-back.card>

                <button type="submit" class="btn btn-primary">@lang('Submit')</button>

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
