<?php
namespace App\Http\Controllers\Back;


use App\Http\{
    Controllers\Controller,
};
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Book;
use App\Models\Product;

class SlugController extends Controller
{
    public function checkRoom(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|max:255',
            
        ]);

        $slug = $request->query('slug');
        $exists = Room::where('slug', $slug)->exists();

        return response()->json(['exists' => $exists]);
    }


    public function checkBook(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|max:255',
            
        ]);

        $slug = $request->query('slug');
        $exists = Book::where('slug', $slug)->exists();

        return response()->json(['exists' => $exists]);
    }


    public function checkProduct(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|max:255',
            
        ]);

        $slug = $request->query('slug');
        $exists = Product::where('slug', $slug)->exists();

        return response()->json(['exists' => $exists]);
    }
}
