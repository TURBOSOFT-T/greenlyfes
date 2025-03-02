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
    <p><strong>Original Price: </strong> {{ $produit->price }}</p>
    
    <br>
    <p><strong>Description: </strong> {!! $produit->description !!}</p>

    <br>
    <img class="w-50" {{-- src="{{ url('public/image/Products/' . $produit->image) }}" --}} src="{{ url('public/Image/' . $produit->image) }}">
    {{-- <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                        <img class="card-img-top product-image" src="{{ url('public/Image/Products/' . $produit->image) }}">

                    </div> --}}
    <br>
    {{-- <div class="col-md-6">

        <p>Les Autres images :</p>

        @foreach (json_decode($produit->images) as $key => $image)
            <img class="card-img-top mb-3 product-image" src="{{ url('public/Image/' . $image) }}"
                style="width: 100px; height: 100px;">
        @endforeach  
    </div> --}}

    <div class="col-md-6">
        <p>Les Autres images :</p>
    
        @if ($produit->images != null && json_decode($produit->images))
            @foreach (json_decode($produit->images) as $key => $image)
                <div style="display: inline-block; text-align: center; margin: 5px;">
                    <img class="card-img-top mb-3 product-image" src="{{ url('public/Image/' . $image) }}"
                        style="width: 100px; height: 100px;">
    
                    <button type="button" class="btn btn-danger btn-sm deleteImage" 
                        data-id="{{ $produit->id }}" 
                        data-image="{{ $image }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            @endforeach
        @else
            <p>Aucune image disponible 🔥</p>
        @endif
    </div>
    
    <br>

    <td>
        @foreach($produit->surfaces as $surface)
            {{ $surface->surface }} - {{ $surface->price }} $ <br>
        @endforeach
    </td>
    

    <a href="{{ route('products.index') }}" class="btn btn-primary">Back to product List</a>
</div>

</div>
@endsection
