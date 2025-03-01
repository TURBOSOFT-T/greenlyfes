<?php

namespace App\Http\Controllers\Back;

use App\DataTables\ProductsDataTable;
use App\Http\{
    Controllers\Controller,
};

use App\Http\Requests\Back\{ProductRequest,ProductUpdateRequest};


use App\Models\Product;

use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function __invoke(Request $request, Product $produit)
    {
        if ($produit->active || $request->user()->admin) {
            return view('products.show', compact('produit'));
        }
        return redirect(route('home'));
    }

    protected $dataTable;

    public function index()
    {     $products=
        Product::latest()->paginate(5);;
        return view('back.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('back.products.form', compact('categories'));
    }
 


    public function store(ProductRequest $request)
    {
        $validated = $request->validate([
        
            'slug' => 'nullable|string|max:255',
        ]);
   
        $user = Auth::user();
   
   // Générer le slug si vide
   $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        

        $user = Auth::user();


        $input = $request->all();

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/', $filename);
            $input['image'] = $filename;
        }
        if ($request->hasFile('images')) {

            $images = [];
            foreach ($request->file('images') as $file) {
                
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
    
                
                $file->move('public/Image/', $filename);
    
                
                $images[] = $filename;
            }
            $input['images'] = json_encode($images);
        }





        $user->products()->create($input);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }


    public function show(string $id): Response
    {
        return response()->view('back.products.show', [
            'produit' => Product::findOrFail($id),
        ]);
    }

    public function edit(string $id): Response
    {
        return response()->view('back.products.edit', [
            'produit' => Product::findOrFail($id),
        ]);
    }



    public function update(ProductUpdateRequest $request, $id)
    {



        $user = Auth::user();
        $article = Product::findOrFail($id);


        $input =
            Product::findOrFail($id);
        $img = Product::find($id);
        File::delete(public_path('public/Image/' . $img->image));

     
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image du serveur
            if ($img->image) {
                unlink(public_path('public/Image/'. $img->image));
            }



            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/', $filename);
            $input['image'] = $filename;
        }

        if ($request->hasFile('images')) {
            
            $oldImages = json_decode($input->images);
            if ($oldImages) {
                foreach ($oldImages as $oldImage) {
                    $oldImagePath = public_path('public/Image/' . $oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
    
           
            $newImages = [];
            
           
            foreach ($request->file('images') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('public/Image'), $filename);
                $newImages[] = $filename;
            }
    
          
            $input['images'] = json_encode($newImages);
        }

        $user->products()->save($input);





        return redirect()->route('products.index')->with('success', 'Blog updated successfully!');
    }



    public function destroy($id)
    {
        $img = Product::find($id);
        File::delete(public_path('/public/Image/' . $img->image));
        if ($img->images) {
            foreach (json_decode($img->images) as $image) {
                if (file_exists(public_path('/public/Image/' . $image))) {
                    unlink(public_path('/public/Image/' . $image));
                }
            }
        }

         Product::findOrFail($id)->forceDelete();
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }



    
}