<?php

namespace App\Http\Controllers\Front;
use App\Http\{
    Controllers\Controller,

};

use App\Repositories\PostRepository;


use App\Http\Requests\Front\ContactRequest;
use App\Models\Testimonial;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use Illuminate\Support\Facades\Request;
use App\Mail\TestimonialCreated; 
use Illuminate\Support\Facades\Mail;

class TestimonialController extends Controller
{

    public function index()
    {
       // $testimonials = Testimonial::all();
       $testimonials = Testimonial::paginate(10);
        return view('back.temoignages.index', compact('testimonials'));
       
    }

 
    public function store(ContactRequest $request)
    {

        if ($request->user()) {
            $request->merge([
                'user_id' => $request->user()->id,
              
                'email'   => $request->user()->email,
            ]);
        }
   
        $testimonial = Testimonial::create($request->all());
    
        if ($request->user()) {
            Mail::to($request->user()->email)->send(new TestimonialCreated($testimonial));
        }

        return back()->with ('success', 'Témoignage créé avec succès! Il sera valide après confirmation des administrateurs');
    }

    public function approve($id)
    {
        $testimonial = Testimonial::find($id);
        
        if ($testimonial) {
            $testimonial->active = true; 
            $testimonial->save();
            
            return redirect()->route('testimonials.index')
                             ->with('success', 'Témoignage approuvé avec succès.');
        }
    
        return redirect()->route('testimonials.index')
                         ->with('error', 'Témoignage introuvable.');
    }

    public function disapprove($id)
{
    $testimonial = Testimonial::find($id);

    if ($testimonial) {
        $testimonial->active = false; 
        $testimonial->save();

        return redirect()->route('testimonials.index')
                         ->with('success', 'Témoignage désapprouvé avec succès.');
    }

    return redirect()->route('testimonials.index')
                     ->with('error', 'Témoignage introuvable.');
}

 
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
    
        if ($testimonial) {
            $testimonial->delete();
    
            return redirect()->route('testimonials.index')
                             ->with('success', 'Témoignage supprimé avec succès.');
        }
    
        return redirect()->route('testimonials.index')
                         ->with('error', 'Témoignage introuvable.');
    }
    
}
