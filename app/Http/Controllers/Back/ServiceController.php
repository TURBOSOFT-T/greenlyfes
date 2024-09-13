<?php

namespace App\Http\Controllers\Back;

use App\DataTables\ServicesDataTable;
use App\Http\{
    Controllers\Controller,
};
use App\Http\Requests\Back\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Symfony\Component\HttpKernel\DependencyInjection\ResettableServicePass;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()

    {
        $services = Service::latest()->paginate(5);
        return view('back.services.index', compact('services'));
    }


    public function create()
    {
        return view('back.services.form');
    }


    public function store(ServiceRequest $request)
    {

        
        $input = $request->all();

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/Services/', $filename);
            $input['image'] = $filename;

            Service::create($input);
        }

            return back()
                ->with('success', 'File has been uploaded.');
                
        }
    


    

        public function show(string $id): Response
        {
            return response()->view('back.services.show', [
                'produit' => Service::findOrFail($id),
            ]);
        }
    
        public function edit(string $id): Response
        {

            return response()->view('back.services.edit', [
                'service' => Service::findOrFail($id),
            ]);
        }
    
    
    
        public function update(ServiceRequest $request, $id)
        {
    
    
    
            $user = Auth::user();
          //  $article = Service::findOrFail($id);
    
        //  $input = $request->all();
            $input =
            Service::findOrFail($id);
            $img = Service::find($id);
            File::delete(public_path('/public/Image/Services/' . $img->image));
    
            if ($request->hasFile('image')) {
    
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('public/Image/Services/', $filename);
                $input['image'] = $filename;
            }
    
            $user->save($input);
    
    
    
    
    
            return redirect()->route('services.index')->with('success', 'Service updated successfully!');
        }
        public function destroy($id)
        {
            $service = Service::find($id);
       //  dd($service);
            if ($service) {
                // Delete associated image
                $imagePath = public_path('public/Image/services/' . $service->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
        
                // Delete service
                $service->delete();
        
                return back()->with('success', 'Service has been deleted successfully.');
            } else {
                return back()->with('error', 'Service not found.');
            }
        }
  






    public function alert(Service $home)
    {
        return view('back.homes.destroy', ['home' => $home]);
    }
}