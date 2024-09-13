@extends('back.layout')
@section('main')



<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Les détail sur un Produit </h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back to Product List</a>
        </div>
    </div>
</div>

<div class="container">
    <h2>Title: {{ $produit->name }}</h2>
    <br>
    <p><strong>Created At: </strong> {{ $produit->created_at }}</p>
    
    <br>
    <p><strong>Description: </strong> {{ $produit->description }}</p>

    <br>
    <img class="w-50" {{-- src="{{ url('public/image/Products/' . $produit->image) }}" --}} src="{{ url('public/Image/' . $produit->image) }}">
    {{-- <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                        <img class="card-img-top product-image" src="{{ url('public/Image/Products/' . $produit->image) }}">

                    </div> --}}
    <br>
    <br>

    <a href="{{ route('products.index') }}" class="btn btn-primary">Back to product List</a>
</div>

</div>
@endsection
