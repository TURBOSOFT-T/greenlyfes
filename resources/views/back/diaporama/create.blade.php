@extends('back.layout')
{{-- @section('content') --}}

@section('main')

<form action="{{ route('diaporamas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="pdf" required>
    <button type="submit">Convertir en Diaporama</button>
</form>

@endsection