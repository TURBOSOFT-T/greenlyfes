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
                    action="{{ Route::currentRouteName() === 'reservations.edit' ? route('reservations.update', $reservation->id) : route('savereservations.store') }}"
                    enctype="multipart/form-data">

                    @if(Route::currentRouteName() === 'reservations.edit')
                    @method('PUT')
                    @endif

                    @csrf

                      <!-- Champs du formulaire -->
    <input type="text" name="nom" value="{{ $reservation->nom }}">
    <input type="text" name="prenom" value="{{ $reservation->prenom }}">
    <input type="text" name="telephone" value="{{ $reservation->telephone }}">
    <input type="email" name="email" value="{{ $reservation->email }}">
    
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
               


                </form>

            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                {{ __('Retour à la liste des réservations') }}
            </a>
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
