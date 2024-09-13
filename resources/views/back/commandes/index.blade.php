@extends('back.layout')
{{-- @section('content') --}}

@section('main')


<div class="row">
    <div class="col-lg-12 margin-tb">
      
        <div class="float-end">
           {{--  <a class="btn btn-outline-success" href="{{ route('products.create') }}"> Créer un</a> --}}
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
   
        <th>Nom </th>
        <th>Téléphone</th>
       {{--  <th>Article</th> --}}

      
     
        <th>Date de  commande</th>
        <th width="380px">Action</th>
    </tr>
    @foreach ($commandes as $commande)
    <tr>

       
        <td>{{ $commande->last_name ?? ' ' }} {{$commande->first_name ?? ' '}}</td>
      
        <td>{{$commande->phone}}</td>
    {{--     <td>@foreach($commande->products as $product)
            <li>
                {{ $product->products->name}} 
                <img  width="100" height="100" src="{{ url('public/Image/' . $product->products->image) }}">
            </li>
        @endforeach
    
 
    </td> --}}
       
        <td>{{ $commande->created_at ?? ' '}}</td>
        <td>
         
           {{--   <a class="btn btn-info" href="{{ route('commandes.show',$commande->id) }}">Détails</a>  --}}
           <a class="btn btn-primary" href="{{ route('commandes.envoyer-facture', $commande->id) }}" data-toggle="tooltip" title="Envoyer Facture">Envoyer Facture</a>
  
           <a class="btn btn-success" href="{{ route('commandes.facture', $commande->id) }}" data-toggle="tooltip" title="Facture">Générer Facture</a>
   
           <a class="btn btn-info" href="{{ route('commandes.show', $commande->id) }}" data-toggle="tooltip" title="Détails">Détails</a>
   
            
           {!! Form::open(['method' => 'DELETE','route' => ['commandes.destroy',
            $commande->id],'style'=>'display:inline']) !!}
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
   {!! $commandes->links('pagination::bootstrap-4') !!}
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
