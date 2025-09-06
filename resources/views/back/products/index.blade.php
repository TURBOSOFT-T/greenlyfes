@extends('back.layout')


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


            <th>Prix</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $produit)
            <tr>

                <td>{{ $produit->id }}</td>
                <td>{{ $produit->name }}</td>


                <td>{{ $produit->price }}</td>
                <td>

                

                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addSurfaceModal{{ $produit->id }}">
                        <i class="fas fa-plus"></i> Ajouter Surface
                    </button>
                    

                    <a class="btn btn-info" href="{{ route('products.show', $produit->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('products.edit', $produit->id) }}">Edit</a>
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['products.destroy', $produit->id],
                        'style' => 'display:inline',
                    ]) !!}
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-outline-danger btn-flat show_confirm" data-toggle="tooltip"
                        title='Delete'>Delete</button>

                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>


    @foreach ($products as $produit)
    <div class="modal fade" id="addSurfaceModal{{ $produit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une Surface pour {{ $produit->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  action="{{ route('surface.store') }}"  method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="product_id" value="{{ $produit->id }}">
    
                        <div class="form-group">
                            <label>Surface</label>
                            <input type="text" name="surface" class="form-control" placeholder="Surface ex: 300m²">
                        </div>
    
                        <div class="form-group">
                            <label>Prix</label>
                            <input type="number" name="price" class="form-control" placeholder="Prix">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    
    
    <div class="d-flex justify-content-center pagination-lg">
        {!! $products->links('pagination::bootstrap-4') !!}
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
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
