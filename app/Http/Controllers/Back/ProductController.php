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
 

/*  public function create($id = null)
    {
        $product = null;

        if($id) {
            $product = Product::findOrFail($id);
            if($product->user_id === auth()->id()) {
                $product->title .= ' (2)';
                $product->slug .='-2';
                $product->active = false;
            } else {
                $product = null;
            }
        }

        $categories = Category::all()->pluck('title', 'id');

        return view('back.products.form', compact('product', 'categories'));
    } */

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



    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "originalPrice" => $product->originalPrice,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function clearAllCart()
    {

        session()->forget('cart');


     
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}