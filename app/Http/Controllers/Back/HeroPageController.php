<?php



namespace App\Http\Controllers\Back;

use App\Http\{
    Controllers\Controller,
};
use App\Http\Requests\Back\HeroPageRequest;
use App\Http\Requests\Back\HeroRequest;
use App\Http\Requests\Back\HomeRequest;
use App\Models\HeroPage;
use App\Http\Requests\StoreHeroPageRequest;
use App\Http\Requests\UpdateHeroPageRequest;
use App\Models\Home;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as InterventionImage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


//use App\Models\File;

class HeroPageController extends Controller
{
    protected $dataTable;

    public function index()
    {
        return app()->make($this->dataTable)->render('back.shared.index');
    }

    public function create()
    {
        return view('back.homes.form');
    }


    public function store(HomeRequest $request)
    {



        $input = $request->all();

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/', $filename);
            $input['image'] = $filename;
        }

        Home::create($input);
        return redirect()->route('homes.index');
    }



    public function edit($id)
    {
        $home = Home::find($id);

        // dd($home);
        return view('back.homes.edit', compact('home'));
    }


    public function update(HomeRequest $request, $id)
    {
        // Récupère l'enregistrement existant
        $home = Home::findOrFail($id);
    
        // Extrait les données de la requête, en excluant l'image
        $input = $request->except('image');
    
        // Vérifie si une image a été téléchargée
        if ($request->hasFile('image')) {
            // Supprime l'ancienne image si elle existe
            if ($home->image) {
                $oldImagePath = public_path('images/' . $home->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            // Télécharge le nouveau fichier et récupère le chemin
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
           // $file->move(public_path('images'), $filename);
           $file->move('public/Image/', $filename);
            $input['image'] = $filename; // Ajoute le chemin de la nouvelle image aux données d'entrée
        }
    
        // Met à jour l'enregistrement avec les nouvelles données
        $home->update($input);
    
        // Redirige vers la liste des maisons avec un message de succès
        return redirect()->route('homes.index')->with('success', 'Maison mise à jour avec succès!');
    }
    
    public function destroy(Home $home)
    {
        $this->deleteImages($home);
        $home->delete();
        return redirect(route('heros.index'));
    }
}
