<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\SearchRequest;
use App\Models\Ecole;
use App\Http\Requests\StoreEcoleRequest;
use App\Http\Requests\UpdateEcoleRequest;
use App\Models\Filiere;
use App\Models\Follow;
use App\Models\Page;
use App\Models\User;

class EcoleController extends Controller
{ public function schools()
    {
      $filieres = Filiere::has('ecoles')->get();
        $users = User::all();
        $ecoles = Ecole::latest()->paginate(16);
        $follows = Follow::all();
        $pages = Page::all();

      //  dd($filieres);

        return view('front.ecoles.index', compact('filieres', 'users', 'ecoles', 'follows', 'pages'));
    }

    

    public function school($id)
    {
        $filieres = Filiere::with('ecoles')->get();
        $current_filiere = Filiere::with('ecoles')->findOrFail($id);
        $ecoles = $current_filiere->ecoles;
      
        return view('front.ecoles.index', compact('current_filiere', 'filieres', 'ecoles'));
    }

    public function details($id){
      //  $ecole =Ecole:: findOrFail($id);
        $ecole = Ecole::with('filieres')->findOrFail($id);

       // dd($post);
       $recentEcoles = Ecole::latest()->take(5)->get();
       $filieres = Filiere::has('ecoles')->get();
      
        return view('front.ecoles.details', compact('ecole', 'recentEcoles','filieres'));
    }

    public function rechercher(SearchRequest $request)
    {
        $search = $request->search;
        $filieres = Filiere::has('ecoles')->get();
        $ecoles = Ecole::where('title', 'like', '%'.$search.'%')
          //  ->orWhere('body', 'like', '%'.$search.'%')
            ->paginate(10);
       // $title = __('Aucune non trouvée avec la recherche: ') . '<strong>' . $search . '</strong>';
     
        return view('front.ecoles.index', compact('ecoles','filieres'));
    }
}
