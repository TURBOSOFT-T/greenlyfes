@extends('back.layout')
@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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


    <form action="{{ route('products.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="name" value="{{ $produit->name }}" class="form-control"
                        placeholder="Title" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="text" name="price" value="{{ $produit->price }}" class="form-control"
                        placeholder="Title" required>
                </div>
            </div>



            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Slug:</strong>
                    <input type="text" name="slug" value="{{ $produit->slug }}" class="form-control"
                        placeholder="Title" required>
                </div>
            </div>

            @if (isset($produit) && !$errors->has('image'))
                <div>
                    <p>
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                        @if ($produit->image)
                            <div class="mt-2">
                                <img src="{{ asset('public/Image/' . $produit->image) }}" alt="Image" width="120">
                            </div>
                        @endif
                    </div>
                    </p>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                </div>
            @endif

            <div class="col-md-6">

                <p>Les Autres images :</p>

                @if ($produit->images != null && json_decode($produit->images))
                    @foreach (json_decode($produit->images) as $key => $image)
                        <div style="display: inline-block; text-align: center; margin: 5px;">
                            <img class="card-img-top mb-3 product-image" src="{{ url('public/Image/' . $image) }}"
                                style="width: 100px; height: 100px;">

                            <button type="button" class="btn btn-danger btn-sm deleteImage" data-id="{{ $produit->id }}"
                                data-image="{{ $image }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    <p>Aucune image disponible 🔥</p>
                @endif


                <div class="form-group">
                    <label>Images</label>
                    <input type="file" name="images[]"class="form-control-file" multiple>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label class="form-label">Meta description</label>
                <textarea rows="4" cols="50" name="short_description" value="{!! $produit->short_description !!}" class="form-control"
                    placeholder="Add content" required> {!! $produit->short_description !!}</textarea>
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <label class="form-label">Content</label>
                <textarea rows="4" cols="50" name="description" value="{!! $produit->description !!}" class="form-control"
                    placeholder="Add content" required> {!! $produit->description !!}</textarea>
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>



            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>


@endsection
