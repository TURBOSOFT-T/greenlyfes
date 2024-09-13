@extends('back.layout')

@section('main')
@php
    $config = DB::table('configs')->first();
    $service =DB::table('services')->get();
@endphp
    <div class="page-content-wrapper">
        <div class="page-content">

            <!-- start page title -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item active">La informations générales</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!--end breadcrumb-->
            <div class="user-profile-page">
                <div class="card radius-15">
                    <div class="card-body">
                    
                   {{--   @livewire('configurations') --}}
                   <table class="table table-bordered">
                    <tr>
                        <th>Icon</th>
                        <th>Logo</th>
                
                        <th>Email</th>
                       {{--  <th>Frais de transport</th> --}}
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Description</th>
                        <th width="280px">Action</th>
                    </tr>
                    
                   
                    <tr>
                
                        <td> <img class="card-img-top product-image" width="50" height="50"  src="{{ url('public/Image/parametres/' . $config->icon) }}"></td>
                      
                        <td> <img class="card-img-top product-image" width="50" height="50"  src="{{ url('public/Image/parametres/' . $config->logo) }}"></td>
                        <td>{{ $config->email }}</td>
                      {{--   <td>{{ $config->frais }}</td> --}}
                        <td>{{ $config->telephone }}</td>
                        <td>{{ $config->addresse }}</td>
                        <td>{{ $config->description }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('contactadmins.edit',$config->id) }}">Modifier</a>
                        </td>
                    
                    </tr>
                   
                </table>
                     


                     <div>
                 
                    
                {{--     
                        <form method="post"
                        action="{{ route('contactadmins.store') }}"
                        enctype="multipart/form-data">
    
                     
                        @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="">Logo </label>
                                        <input type="file" name="logo" accept="image/*" class="form-control">
                                        @error('logo')
                                            <span class="text-danger small"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="">Icone</label>
                                        <input type="file" name ="icon" accept="image/*" class="form-control">
                                        @error('icon')
                                            <span class="text-danger small"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="">Frais de livraison</label>
                                        <input type="number" name="frais" step="0.1"  :value="isset($config) ? $config->frais : ''" class="form-control">
                                        @error('frais')
                                            <span class="text-danger small"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="">Email</label>
                                        <input type="mail" name="email" step="0.1" class="form-control">
                                        @error('email')
                                            <span class="text-danger small"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="">Telephone</label>
                                        <input type="number" name="telephone" step="0.1" class="form-control">
                                        @error('telephone')
                                            <span class="text-danger small"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="">Addresse</label>
                                        <input type="text" name="addresse" step="0.1" class="form-control">
                                        @error('addresse')
                                            <span class="text-danger small"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><strong>Description :</strong></label>
                                    <textarea   name="description"  rows="5" cols="200"></textarea>
                                    @error('description')
                                        <span class="text-danger small"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button class="btn btn-primary btn-sm" type="submit">
                                   
                                    <i class="ri-save-line me-1 fs-16 lh-1"></i>
                                    Enregistrer les changements
                                </button>
                            </div>
                        </form>
                     --}}
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>

    @endsection
