@extends('back.layout')
{{-- @section('content') --}}

@section('main')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-start">
           
        </div>
        <div class="float-end">
             <a class="btn btn-outline-success" href="{{ route('sponsors.create') }}"> Créer un nouveau  sponsor</a> 
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

        <th>Image</th>
        <th>Description</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($sponsors as $sponsor)
    <tr>

        <td>{{ $sponsor->id }}</td>
        <td>{{ $sponsor->titre }}</td>
        <td> <img  width="150"  height="150" src="{{ url('public/Image/Sponsors/' . $sponsor->image) }}"></td>
      
      
        <td>{{ $sponsor->description}}</td>
        <td>
           {{--  <a href="{{ route('sponsors.edit', $sponsor->id) }}">Editer</a>  --}}
            
            {!! Form::open(['method' => 'DELETE','route' => ['sponsors.destroy',
            $sponsor->id],'style'=>'display:inline']) !!}
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
   {!! $sponsors->links('pagination::bootstrap-4') !!}
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
