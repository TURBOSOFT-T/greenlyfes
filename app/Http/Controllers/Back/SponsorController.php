<?php
namespace App\Http\Controllers\Back;

use App\Http\{
    Controllers\Controller,

};

use App\Models\Sponsor;
use App\Http\Requests\Back\ServiceRequest;
use App\Http\Requests\Back\SponsorRequest;
use App\Http\Requests\StoreSponsorRequest;
use App\Http\Requests\UpdateSponsorRequest;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()

    {
        $sponsors = Sponsor::latest()->paginate(5);
        return view('back.sponsors.index', compact('sponsors'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function create()
     {
         return view('back.sponsors.form');
     }
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSponsorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SponsorRequest $request)
    {

        
        $input = $request->all();

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/sponsors/', $filename);
            $input['image'] = $filename;

            Sponsor::create($input);
        }

            return back()
                ->with('success', 'File has been uploaded.');
                
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSponsorRequest  $request
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSponsorRequest $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Sponsor::find($id);
   //  dd($service);
        if ($service) {
            // Delete associated image
            $imagePath = public_path('public/Image/sponsors/' . $service->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
    
            // Delete service
            $service->delete();
    
            return back()->with('success', 'Sponsor has been deleted successfully.');
        } else {
            return back()->with('error', 'Sponsor not found.');
        }
    }

}
