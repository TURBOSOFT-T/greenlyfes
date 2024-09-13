@extends('back.layout')
@section('main')
<div class="row">
    <div class="col-lg-12 margin-tb">
        
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('homes.index') }}"> Back</a>
        </div>
    </div>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form action="{{ route('heros.update',$home->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" value="{{ $home->title }}" class="form-control" placeholder="Title"
                    required>
            </div>
        </div>

       
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Slug:</strong>
                <input type="text" name="slug" value="{{ $home->slug }}" class="form-control" placeholder="Title"
                    required>
            </div>
        </div>

        @if(isset($home) && !$errors->has('image'))
        <div>
            <p>
<div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
    <img class="card-img-top product-image" src="{{ url('public/Image/' . $home->image) }}">

</div>
            </p>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
        </div>
        @endif


        <div class="col-xs-12 col-sm-12 col-md-12">
            <label class="form-label">Content</label>
            <textarea rows="4" cols="50" name="body" value="{{ $home->body }}" class="form-control"
                placeholder="Add content" required></textarea>
            @error('body')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

 
</form>


@endsection
