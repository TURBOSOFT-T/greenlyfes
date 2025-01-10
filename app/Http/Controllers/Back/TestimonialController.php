<?php

namespace App\Http\Controllers\Back;

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
    protected $dataTable;
   
    public function index()
    {
       // $testimonials = Testimonial::all();
       $testimonials = Testimonial::paginate(10);
        return view('back.temoignages.index', compact('testimonials'));
       
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTestimonialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        if($request->user()) {
            $request->merge([
                'user_id' => $request->user()->id,
                'name'    => $request->user()->name,
                'email'   => $request->user()->email,
            ]);
        }

        Testimonial::create ($request->all());

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
