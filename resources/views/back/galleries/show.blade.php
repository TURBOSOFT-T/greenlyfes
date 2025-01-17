@extends('back.layout')
@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Les détails sur  la gallerie </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('galleries.index') }}"> Back to List</a>
            </div>
        </div>
    </div>

    <div class="container">
        
        <h2>Nom: {{ $gallerie->titre }}</h2>
        <br>
        <p><strong>Created At: </strong> {{ $gallerie->created_at }}</p>

        <br>
        <p><strong>Description: </strong> {!! $gallerie->description !!}</p>

        <br>
        <img class="w-50" {{-- src="{{ url('public/image/Products/' . $room->image) }}" --}} src="{{ url('public/Image/' . $gallerie->image) }}">
        <br>
        <br>
    
        <br>

    </div>
    <br>
    <br>

    <a href="{{ route('galleries.index') }}" class="btn btn-primary">Back to  List</a>
    </div>

    </div>
@endsection
