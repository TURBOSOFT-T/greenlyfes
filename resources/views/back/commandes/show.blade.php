@extends('back.layout')
@section('main')



<div class="row">
    <div class="col-lg-12 margin-tb">
       
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('commandes.index') }}"> Back to order List</a>
        </div>
    </div>
</div>

<!-- resources/views/commandes/show.blade.php -->
<h1>Détails de la Commande</h1>
<p><strong>Nom:</strong> {{ $commande->last_name }} {{ $commande->first_name }}</p>
<p><strong>Téléphone:</strong> {{ $commande->phone }}</p>
<p><strong>Message:</strong> {{ $commande->note }}</p>
<p><strong>Date de Commande:</strong> {{ $commande->created_at }}</p>

<h2>Produits:</h2>
<ul>
    @foreach($commande->products as $product)
        <li>
            {{ $product->products->name ?? ''}}
            <img width="100" height="100" src="{{ url('public/Image/' . $product->products->image) }}">
        </li>
    @endforeach
</ul>



    <a href="{{ route('commandes.index') }}" class="btn btn-primary">Back to order List</a>
</div>

</div>
@endsection
