@extends('back.layout')
@section('main')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Ajouter les attributs  pour : {{ $room->name }}</h3>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('rooms.index') }}"> Back to List</a>
        </div>
    </div>
</div>


<form action="{{ route('store.attribut') }}" method="POST">
    @csrf
    <input type="hidden" name="room_id" value="{{ $room->id }}">

    <div class="modal-body">
        <input type="hidden" name="product_id" value="{{ $room->id }}">

        <div class="form-group">
            <label>Surface</label>
            <input type="text" name="surface" class="form-control" placeholder="Surface ex: 300m²">
        </div>

        <div class="form-group">
            <label>Prix</label>
            <input type="tet" name="single_price" class="form-control" placeholder="Prix">
        </div>
        <div class="form-group">
            <label>Prix du double</label>
            <input type="text" name="double_price" class="form-control" placeholder="Prix du double">
    </div>
    </div>
    <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>

<br>
<a href="{{ route('rooms.index') }}" class="btn btn-primary">Back to room List</a>
@endsection