@extends('back.layout')
@section('main')

    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">

                    <div class="container-xxl flex-grow-1 container-p-y">
                       
           
            <!-- end page title -->


            <div class="card radius-15">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-title">
                                <h5 class="mb-0 my-auto">
                                    Modifier  le témoignage
                                </h5>
                            </div>
                        </div>
                     
                    </div>
                    <hr />
                    <div class="container">
                      
                    
                        <form action="{{ route('testimoniales.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                    
                            <div class="form-group">
                                <label for="photo">Photo actuelle</label><br>
                                <img src="{{ asset('uploads/testimonials/' . $testimonial->photo) }}" alt="Photo Témoignage" width="100" height="100">
                            </div>
                    
                            <div class="form-group">
                                <label for="photo">Télécharger une nouvelle photo</label>
                                <input type="file" name="photo" class="form-control" id="photo">
                            </div>
                    
                            <div class="form-group">
                                <label for="message">Message du témoignage</label>
                                <textarea name="message" class="form-control" id="message">{{ $testimonial->message }}</textarea>
                            </div>
                    
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            <a  href="{{ route('testimonials.index') }}"  class="btn btn-secondary">Annuler</a>
                        </form>
                    </div>
             

                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
<!-- Modal Modifier -->



