<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Front\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
  

    public function create()
    {
        return view('front.contact.contact');
    }
 public function about(){
    return view('front.about.about');
 }

 public function faq(){
    return view('front.faq.faq');
 }
   
    public function store(ContactRequest $request)
    {
        if($request->user()) {
            $request->merge([
                'user_id' => $request->user()->id,
                'name'    => $request->user()->name,
                'email'   => $request->user()->email,
            ]);
        }

        Contact::create ($request->all());

        return back()->with ('status', __('Your message has been recorded, we will respond as soon as possible.'));
    }
}
