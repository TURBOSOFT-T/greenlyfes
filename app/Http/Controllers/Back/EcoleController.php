<?php
namespace App\Http\Controllers\Back;

use App\DataTables\EcolesDataTable;
use App\Http\{
    Controllers\Controller,

};
use App\Http\Requests\Back\EcoleRequest;
use App\Http\Requests\Back\EcoleUpdateRequest;
use App\Models\Ecole;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EcoleController extends Controller
{
   

    public function index(EcolesDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }

    public function create($id = null)
    {
        $ecole = null;

        if($id) {
            $ecole = Ecole::findOrFail($id);
            if($ecole->user_id === auth()->id()) {
                $ecole->title .= ' (2)';
                $ecole->slug .='-2';
                $ecole->active = false;
            } else {
                $ecole = null;
            }
        }

        $filieres = Filiere::all()->pluck('title', 'id');

        return view('back.ecoles.form', compact('ecole', 'filieres'));
    }



    public function store(EcoleRequest $request)
    {
      

    $input = $request->all();

    if ($request->hasFile('image')) {

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('public/Image/', $filename);
        $input['image'] = $filename;
    }
    $input['active'] = $request->has('active') ? 1 : 0;


 $ecoles= Ecole::create($input);
 $ecoles->filieres()->sync($request->input('filieres', []));
//  dd($ecoles);

 

        return back()->with('ok', __('The School has been successfully created'));
    }

    public function edit($id){
        $ecole = Ecole::find($id);
       // dd($ecole);
        $filieres = Filiere::all()->pluck('title', 'id');
        return view('back.ecoles.edit', compact('ecole', 'filieres'));
    }


    public function update(EcoleUpdateRequest $request, $id)
{
    // Trouver l'école à mettre à jour
    $ecole = Ecole::findOrFail($id);

    // Obtenez toutes les données du formulaire sauf l'image
    $input = $request->except('image');

    // Gestion du fichier image
    if ($request->hasFile('image')) {
        // Supprimer l'image précédente si elle existe
        if ($ecole->image && file_exists(storage_path('app/public/images/' . $ecole->image))) {
            unlink(storage_path('app/public/images/' . $ecole->image));
        }

        // Télécharger la nouvelle image
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        // Stocker le fichier dans le répertoire public/images
        $file->storeAs('public/images', $filename);
        // Ajouter le nom du fichier à l'input
        $input['image'] = $filename;
    }

    // Déterminer si l'école est active
    $input['active'] = $request->has('active') ? 1 : 0;

    // Mettre à jour l'école avec les données validées
    $ecole->update($input);

    // Synchroniser les filières avec l'école
    $ecole->filieres()->sync($request->input('filieres', []));

    // Redirection avec message de succès
    return redirect()->route('ecoles.index')->with('success', __('The School has been successfully updated'));
}
public function destroy($id)
{
    // Trouver l'école à supprimer
    $ecole = Ecole::findOrFail($id);

    // Supprimer l'image associée, si elle existe
    if ($ecole->image && file_exists(storage_path('app/public/images/' . $ecole->image))) {
        unlink(storage_path('app/public/images/' . $ecole->image));
    }

    // Supprimer les relations Many-to-Many (filières)
    $ecole->filieres()->detach();

    // Supprimer l'école
    $ecole->delete();

    // Redirection avec message de succès
    return redirect()->route('ecoles.index')->with('success', __('The School has been successfully deleted'));
}


}
