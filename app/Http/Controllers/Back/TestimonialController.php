<?php

namespace App\Http\Controllers\Front;

use App\Repositories\PostRepository;
use App\Http\Controllers\Controller;

use App\Http\Requests\Front\ContactRequest;
use App\Models\Testimonial;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use Illuminate\Support\Facades\Request;

class TestimonialController extends Controller
{
    protected $dataTable;
    public function index()
    {
        return app()->make($this->dataTable)->render('back.shared.index');
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




}
