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
      
        return view('front.hopitaux.index', compact('current_logement', 'logements', 'books'));
    }

    public function details($id){
       // $hopital =Hopital:: findOrFail($id);
        $book = Book::findOrFail($id);
       // dd($post);
      
       $logements = Logement::has('books')->get();
      
        return view('front.books.details', compact('book','logements'));
    }

    public function recherche(SearchRequest $request)
    {
        $search = $request->search;
        $logements = Logement::has('books')->get();
        $books = Book::where('title', 'like', '%'.$search.'%')
          //  ->orWhere('body', 'like', '%'.$search.'%')
            ->paginate(10);
       // $title = __('Aucune non trouvée avec la recherche: ') . '<strong>' . $search . '</strong>';
     
        return view('front.books.index', compact('books','logements'));
    }

    
}
