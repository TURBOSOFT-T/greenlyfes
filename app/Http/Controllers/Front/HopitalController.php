<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\SearchRequest;
use App\Models\Hopital;
use App\Http\Requests\StoreHopitalRequest;
use App\Http\Requests\UpdateHopitalRequest;
use App\Models\Follow;
use App\Models\Page;
use App\Models\Specialite;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class HopitalController extends Controller
{ public function hopitaux()
    {
      $specialites = Specialite::has('hopitals')->get();
        $users = User::all();
        $hopitaux = Hopital::latest()->paginate(16);
        $follows = Follow::all();
        $pages = Page::all();

        return view('front.hopitaux.index', compact('specialites', 'users', 'hopitaux', 'follows', 'pages'));
    }


    public function hopital($id)
    {
        $specialites = Specialite::with('hopitals')->get();
        $current_specialite = Specialite::with('hopitals')->findOrFail($id);
        $hopitaux = $current_specialite->hopitals;
      
        return view('front.hopitaux.index', compact('current_specialite', 'specialites', 'hopitaux'));
    }

    public function details($id){
    
        $hopital = Hopital::with('specialites')->findOrFail($id);
       
      
       $specialites = Specialite::has('hopitals')->get();
      
        return view('front.hopitaux.details', compact('hopital','specialites'));
    }

    public function recherche(SearchRequest $request)
    {
        $search = $request->search;
        $specialites = Specialite::has('hopitals')->get();
        $hopitaux = Hopital::where('title', 'like', '%'.$search.'%')
          //  ->orWhere('body', 'like', '%'.$search.'%')
            ->paginate(10);
       // $title = __('Aucune non trouvée avec la recherche: ') . '<strong>' . $search . '</strong>';
     
        return view('front.ecoles.index', compact('hopitaux','specialites'));
    }

    public function store(Request $request)
    {
       $hopital = Hopital::create($request->all());

        return redirect()->route('hopitaux.index')->with('success', 'Hopital créé avec succès');
    }

}
