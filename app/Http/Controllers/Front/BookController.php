<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\SearchRequest;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Follow;
use App\Models\Logement;
use App\Models\Page;
use App\Models\User;

class BookController extends Controller
{
   
    public function logements()
    {
      $logements = Logement::has('books')->get();
        $users = User::all();
      
        $follows = Follow::all();
        $pages = Page::all();

        return view('front.logements.index', compact('logements', 'users', 'follows', 'pages'));
    }

   

    public function logement($id)
    {
        $logements = Logement::with('books')->get();
        $current_logement = Logement::with('books')->findOrFail($id);
        $books = $current_logement->books;
      
        return view('front.logements.index', compact('current_logement', 'logements', 'books'));
    }

    public function details($id){
     
        $logement = Book::findOrFail($id);
        //dd($logement);
        if (!$logement) {
            abort(404, 'Logement not found');
        }
        return view('front.logements.details', compact('logement'));
    }

    public function recherche(SearchRequest $request)
    {
        $search = $request->search;
        $logements = Logement::has('books')->get();
        $books = Book::where('title', 'like', '%'.$search.'%')
       
            ->paginate(10);
      
        return view('front.logements.index', compact('books','logements'));
    }

    
}
