@extends('back.layout')
{{-- @section('content') --}}

@section('main')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-start">
            <h2>Gestion des produits</h2>
        </div>
        <div class="float-end">
            <a class="btn btn-outline-success" href="{{ route('products.create') }}"> Créer un nouveau produit</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>

      
        <th>Description</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($products as $produit)
    <tr>

        <td>{{ $produit->id }}</td>
        <td>{{ $produit->name }}</td>
      
        
        <td>{{ $produit->description }}</td>
        <td>
            {{-- <form action="#" method="POST">

                <a class="btn btn-outline-primary" href="{{ route('products.show',$produit->id) }}">Details</a>

                <a class="btn btn-outline-success" href="{{ route('products.edit',$produit->id) }}">Update</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form> --}}
            <a class="btn btn-info" href="{{ route('products.show',$produit->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('products.edit',$produit->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['products.destroy',
            $produit->id],'style'=>'display:inline']) !!}
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button type="submit" class="btn btn-outline-danger btn-flat show_confirm" data-toggle="tooltip"
                title='Delete'>Delete</button>

            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-center pagination-lg">
   {!! $products->links('pagination::bootstrap-4') !!}
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
