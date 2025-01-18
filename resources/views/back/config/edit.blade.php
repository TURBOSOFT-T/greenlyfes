@extends('back.layout')
@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editer Paramètres</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('contactadmins.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <br><br><br>
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


    <form action="{{ route('contactadmins.update', $config->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="row">


            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <strong>E-mail:</strong>
                    <input type="text" name="email" value="{{ $config->email }}" class="form-control"
                        placeholder="Email">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <strong>Téléphone:</strong>
                    <input type="text" name="telephone" value="{{ $config->telephone }}" class="form-control"
                        placeholder="Téléphone">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Addresse:</strong>
                    <input type="text" name="addresse" value="{{ $config->addresse }}" class="form-control"
                        placeholder="Addresse">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <strong>Nombre de dossiers traités:</strong>
                    <input type="text" name="dossier" value="{{ $config->dossier ?? ' ' }}" class="form-control"
                        placeholder="Frais de transport">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <strong>Nombres d'années d'expériences:</strong>
                    <input type="text" name="annee" value="{{ $config->annee }}" class="form-control"
                        placeholder="Frais de transport">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <strong>Nombre de projets réalisés:</strong>
                    <input type="text" name="projet" value="{{ $config->projet }}" class="form-control"
                        placeholder="Frais de transport">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <strong>Nombre d'utilisateur:</strong>
                    <input type="text" name="utilisateur" value="{{ $config->utilisateur }}" class="form-control"
                        placeholder="Frais de transport">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('icon'))
                    <div>
                        <strong>Icon:</strong>
                        <p>{{-- <img class="w-50" src="{{ url('public/image/Products/' . $produit->image) }}"> --}}
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image" style="height: 5; with:5"
                                src="{{ url('public/Image/parametres/' . $config->icon) }}" height="50" width="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="icon">Icon:</label>
                            <input type="file" class="form-control-file" id="icon" name="icon">
                        </div>
                    </div>
                @endif
            </div>


            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('logo'))
                    <div>
                        <strong>Logo(170*50):</strong>
                        <p>{{-- <img class="w-50" src="{{ url('public/image/Products/' . $produit->image) }}"> --}}
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->logo) }}" width="50" height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="logo">Logo(170*50):</label>
                            <input type="file" class="form-control-file" id="logo" name="logo">
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('logo'))
                    <div>
                        <strong>Logo footer(170*50):</strong>
                        <p>{{-- <img class="w-50" src="{{ url('public/image/Products/' . $produit->image) }}"> --}}
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->image) }}" width="50" height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="image">Logo footer(170*50):</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('logoHeader'))
                    <div>
                        <strong>Logo Header(170*50):</strong>
                        <p>{{-- <img class="w-50" src="{{ url('public/image/Products/' . $produit->image) }}"> --}}
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->logoHeader) }}" width="50" height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="logoHeader">Logo Header(170*50):</label>
                            <input type="file" class="form-control-file" id="logo" name="logoHeader">
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('imagefooter'))
                    <div>
                        <strong>Image pour le footer(1920*591):</strong>
                        <p>{{-- <img class="w-50" src="{{ url('public/image/Products/' . $produit->image) }}"> --}}
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->imagefooter) }}" width="50"
                                height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="logo">Image footer(1920 * 591):</label>
                            <input type="file" class="form-control-file" id="imagefooter" name="imagefooter">
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('imagergister'))
                    <div>
                        <strong>Image pour Register(764*770):</strong>
                        <p>{{-- <img class="w-50" src="{{ url('public/image/Products/' . $produit->image) }}"> --}}
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->imagergister) }}" width="50"
                                height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="imagergister">Image register(764*770):</label>
                            <input type="file" class="form-control-file" id="imagergister" name="imagergister">
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('imagelogin'))
                    <div>
                        <strong>Image pour login(764*770):</strong>
                        <p>{{-- <img class="w-50" src="{{ url('public/image/Products/' . $produit->image) }}"> --}}
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->imagelogin) }}" width="50"
                                height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="imagelogin">Image login(764*770):</label>
                            <input type="file" class="form-control-file" id="imagelogin" name="imagelogin">
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('imageblog'))
                    <div>
                        <strong>Image pour le blog(1920*500):</strong>
                        <p>{{-- <img class="w-50" src="{{ url('public/image/Products/' . $produit->image) }}"> --}}
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->imageblog) }}" width="50"
                                height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="imageblog">Image blog(1920*500):</label>
                            <input type="file" class="form-control-file" id="imageblog" name="imageblog">
                        </div>
                    </div>
                @endif
            </div>



            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('imageabout'))
                    <div>
                        <strong>Image pourquoi choisir :</strong>
                        <p>{{-- <img class="w-50" src="{{ url('public/image/Products/' . $produit->image) }}"> --}}
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->imageabout) }}" width="50"
                                height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="imageabout">Image pourquoi choisir:</label>
                            <input type="file" class="form-control-file" id="imageabout" name="imageabout">
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('imagecontact'))
                    <div>
                        <strong>Image page contact(950*600) :</strong>
                        <p>{{-- <img class="w-50" src="{{ url('public/image/Products/' . $produit->image) }}"> --}}
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->imagecontact) }}" width="50"
                                height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="imagecontact">Page contact(950*600):</label>
                            <input type="file" class="form-control-file" id="imagecontact" name="imagecontact">
                        </div>
                    </div>
                @endif
            </div>

{{-- 
            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('imageeducation'))
                    <div>
                        <strong>Image entête école(1920*500):</strong>
                        <p>
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->imageeducation) }}" width="50"
                                height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="imageeducation">Image   entête école (1920*500):</label>
                            <input type="file" class="form-control-file" id="imageeducation" name="imageeducation">
                        </div>
                    </div>
                @endif
            </div> --}}

           {{--  <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('imagesante'))
                    <div>
                        <strong>Image pour entête santé(1920*500):</strong>
                        <p>
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->imagesante) }}" width="50"
                                height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="imagesante">Image entête santé(1920*500):</label>
                            <input type="file" class="form-control-file" id="imagesante" name="imagesante">
                        </div>
                    </div>
                @endif
            </div>
 --}}
 
{{-- 
            <div class="col-xs-12 col-sm-12 col-md-3">
                @if (isset($config) && !$errors->has('imageindustrielle'))
                    <div>
                        <strong>Image entête  pour produits  (1920*500):</strong>
                        <p>
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" />
                            <img class="card-img-top product-image"
                                src="{{ url('public/Image/parametres/' . $config->imageindustrielle) }}" width="50"
                                height="50">

                        </div>
                        </p>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="imageindustrielle">Image entête produits induxtriels(1920*500):</label>
                            <input type="file" class="form-control-file" id="imageindustrielle" name="imageindustrielle">
                        </div>
                    </div>
                @endif
            </div>
 --}}
            <br><br>
            <br><br>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" rows="4" cols="50" name="description" class="form-control"
                    placeholder="Ajouter le description" >{{ old('description', $config->description) }}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="mission" class="form-label">Pourquoi nous choisir(Bungalows et Espaces Privés)</label>
                <textarea id="mission" rows="4" cols="50" name="mission" class="form-control"
                    placeholder="Ajouter le description de votr mission" >{{ old('mission', $config->mission) }}</textarea>
                @error('mission')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <br><br>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="vision" class="form-label">Pourquoi nous choisir(Club House et Espaces Communautaires)</label>
                <textarea id="vision" rows="4" cols="50" name="vision" class="form-control"
                    placeholder="Ajouter le description de votre vision" >{{ old('vision', $config->vision) }}</textarea>
                @error('vision')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <br><br>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="valeurs" class="form-label">Pourquoi nous choisir(Séjours et Services Proposés)</label>
                <textarea id="valeurs" rows="4" cols="50" name="valeurs" class="form-control"
                    placeholder="Ajouter le description de vos valeurs" >{{ old('valeurs', $config->valeurs) }}</textarea>
                @error('valeurs')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <br><br>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="domaine" class="form-label">A propos de nous(Séjours Longs et Immersion)</label>
                <textarea id="domaine" rows="4" cols="50" name="domaine" class="form-control"
                    placeholder="Ajouter le description de votre domaine " >{{ old('domaine', $config->domaine) }}</textarea>
                @error('domaine')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <br><br>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="equipe" class="form-label">A propos de nous(Alimentation Saine et Locale)</label>
                <textarea id="equipe" rows="4" cols="50" name="equipe" class="form-control"
                    placeholder="Ajouter le description de votre équipe" >{{ old('equipe', $config->equipe) }}</textarea>
                @error('equipe')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="des_contact" class="form-label">Description page contact</label>
                <textarea id="des_contact" rows="4" cols="50" name="des_contact" class="form-control"
                    placeholder="Ajouter le description de la page contact" >{{ old('des_contact', $config->des_contact) }}</textarea>
                @error('des_contact')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Enregistrer </button>
            </div>
        </div>


    </form>
@endsection

{{-- 
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
 --}}
