@extends('back.layout')
{{-- @section('content') --}}

@section('main')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-start">
            <h2>Diaporama</h2>
        </div>
        <div class="float-end">
            <a class="btn btn-outline-success" href="{{ route('diaporamas.create') }}"> Créer un nouveau </a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
   

    <ul class="list-group">
        @foreach ($pdfs as $pdf)
            <li class="list-group-item">
                <strong>{{ $pdf->file_name }}</strong> 
                <a href="{{ route('diaporamas.show', $pdf->id) }}" class="btn btn-info btn-sm float-right ml-2">View</a>
                <form action="{{ route('diaporamas.destroy', $pdf->id) }}" method="POST" class="float-right">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
{{--     @foreach ($diaporamas as $produit)
    <tr>

        <td>{{ $produit->id }}</td>
      

    </tr>
    @endforeach --}}
</table>
<div class="d-flex justify-content-center pagination-lg">
  {{--  {!! $diaporamas->links('pagination::bootstrap-4') !!} --}}
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script>


@endsection
