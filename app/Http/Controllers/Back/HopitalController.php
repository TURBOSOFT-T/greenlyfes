<?php

namespace App\Http\Controllers\Back;

use App\DataTables\HopitalsDataTable;
use App\Http\{
    Controllers\Controller,

};
use App\Http\Requests\Back\HopitalRequest;
use App\Http\Requests\Back\HopitalUpdateRequest;
use App\Http\Requests\Back\HopitaUpdateRequest;
use App\Models\Hopital;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HopitalController extends Controller
{
   

    public function index(HopitalsDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }

    public function create($id = null)
    {
        $hopital = null;

        if($id) {
            $hopital = Hopital::findOrFail($id);
            if($hopital->user_id === auth()->id()) {
                $hopital->title .= ' (2)';
                $hopital->slug .='-2';
                $hopital->active = false;
            } else {
                $hopital = null;
            }
        }

        $specialites = Specialite::all()->pluck('title', 'id');

        return view('back.hopitaux.form', compact('hopital', 'specialites'));
    }


    public function store(HopitalRequest $request)
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

    $hopital = Hopital::create($input);
    $hopital->specialites()->sync($request->input('specialites', []));

        return back()->with('ok', __('The Hospital has been successfully created'));
    }

    public function edit($id){
        $hopital = Hopital::find($id);
        
         $specialites = Specialite::all()->pluck('title', 'id');
         return view('back.hopitaux.edit', compact('hopital', 'specialites'));
    }

    public function update(HopitalUpdateRequest $request, $id)
{
  
    $hopital = Hopital::findOrFail($id);

   
    $input = $request->except('image');

    // Gestion du fichier image
    if ($request->hasFile('image')) {
        // Supprimer l'image précédente si elle existe
        if ($hopital->image && file_exists(storage_path('app/public/images/' . $hopital->image))) {
            unlink(storage_path('app/public/images/' . $hopital->image));
        }

        // Télécharger la nouvelle image
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        // Stocker le fichier dans le répertoire public/images
        $file->storeAs('public/images', $filename);
        // Ajouter le nom du fichier à l'input
        $input['image'] = $filename;
    }

    // Déterminer si l'hôpital est actif
    $input['active'] = $request->has('active') ? 1 : 0;

    // Mettre à jour l'hôpital avec les données validées
    $hopital->update($input);

    // Synchroniser les spécialités avec l'hôpital
    $hopital->specialites()->sync($request->input('specialites', []));

    // Redirection avec message de succès
    return redirect()->route('hopitals.index')->with('success', __('The Hospital has been successfully updated'));
}
public function destroy($id)
{
    // Trouver l'hôpital à supprimer
    $hopital = Hopital::findOrFail($id);

    // Supprimer l'image associée, si elle existe
    if ($hopital->image && file_exists(storage_path('app/public/images/' . $hopital->image))) {
        unlink(storage_path('app/public/images/' . $hopital->image));
    }

    // Supprimer les relations Many-to-Many (spécialités)
    $hopital->specialites()->detach();

    // Supprimer l'hôpital
    $hopital->delete();

    // Redirection avec message de succès
    return redirect()->route('hospitals.index')->with('success', __('The Hospital has been successfully deleted'));
}


   
}
