<?php

namespace App\Http\Controllers\Back;

use App\DataTables\ProductsDataTable;
use App\Http\{
    Controllers\Controller,
};

use App\Http\Requests\Back\ProductRequest;

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

        $user = Auth::user();


        $input = $request->all();

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/', $filename);
            $input['image'] = $filename;
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



    public function update(ProductRequest $request, $id)
    {



        $user = Auth::user();
        $article = Product::findOrFail($id);


        $input =
            Product::findOrFail($id);
        $img = Product::find($id);
        File::delete(public_path('/public/Image/Products/' . $img->image));

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/Products/', $filename);
            $input['image'] = $filename;
        }

        $user->products()->save($input);





        return redirect()->route('products.index')->with('success', 'Blog updated successfully!');
    }



    public function destroy($id)
    {
        $img = Product::find($id);
        File::delete(public_path('/public/Image/Products/' . $img->image));
         Product::findOrFail($id)->forceDelete();
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }



    
}