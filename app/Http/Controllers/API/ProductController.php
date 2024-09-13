<?php

namespace App\Http\Controllers\API;

use App\Models\Product;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\API\ProductRequest as APIProductRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends BaseController
{
    /*   public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
 */


    public function index()
    {

        $data = Product::all();

        return $this->getResponse($data, "All Prodructs ");
    }



    public function me()
    {
        $data = Product::with('user:id,name')
            ->withCount('reviews')
            ->latest()
            ->paginate(20);

        return $this->getResponse($data, "All  Products");
    }






    public function store(APIProductRequest $request)
    {
        $user = Auth::user();


        $input = $request->all();

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/Products/', $filename);
            $input['image'] = $filename;
        }


        $user->products()->create($input);
       /// Product::create($input);


        return response()->json(['message' => 'Product Added']);
    }

    public function show(Product $product)
    {
        $product->load(['reviews' => function ($query) {
            $query->latest();
        }, 'user']);
        return response()->json(['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(APIProductRequest $request, $id)
    {
        $user = Auth::user();
        $article = Product::findOrFail($id);


        $input =
            Product::findOrFail($id);
        $img = Product::find($id);
        File::delete(public_path('/public/Image/' . $img->image));

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/', $filename);
            $input['image'] = $filename;
        }

        $user->products()->save($input);



        return response()->json(['message' => 'Product Updated', 'product' => $input]);
    }



    public function delete(Product $product, $id)
    {

        try {

            $img = Product::find($id);
            File::delete(public_path('/public/Image/' . $img->image));
            $res = Product::findOrFail($id)->forceDelete();
            return $this->sendResponse($res, ' Product deleted succssufly');
        } catch (ModelNotFoundException $exception) {
            return $this->getError('Id not found');
        }
    }



    protected function deleteImages(Product $product)
    {
        // $products = Product::findOrFail($id);
        File::delete([

            public_path('/public/Image/') . $product->image,
            // public_path( "{{ url('public/image/' . $product->image) }}")
        ]);
    }

    public function delete2($id)
    {

        try {
            $res = Product::findOrFail($id)->delete();
            return $this->sendResponse($res, 'Product deleted succssufly');
        } catch (ModelNotFoundException) {
            return $this->getError('Id not found');
        }
    }
}
