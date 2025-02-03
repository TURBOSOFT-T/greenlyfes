<?php

namespace App\Http\Controllers\Back;

use App\Http\{
    Controllers\Controller,

};
use App\Models\Gallerie;
use App\Http\Requests\StoreGallerieRequest;
use App\Http\Requests\UpdateGallerieRequest;
use App\Http\Requests\Back\GalleryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;



class GallerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $dataTable;

    public function index()
    {
        return app()->make($this->dataTable)->render('back.shared.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.galleries.form');
    }

    
   
    public function store(GalleryRequest $request)
    {



        $input = $request->all();

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/', $filename);
            $input['image'] = $filename;
        }

   
          
  /*   if ($request->hasFile('video')) {
        $input['video'] = $request->file('video')->store('videos', 'public'); // Stockage de la vidéo
    }  */

        Gallerie::create($input);
        return redirect()->route('galleries.index');
    }


  
     public function edit($id)
     {
         $gallery = Gallerie::find($id);
 
         return view('back.galleries.edit', compact('gallery'));
      
     }
     public function show($id)

     {
        $gallerie = Gallerie::find($id);

         return view('back.galleries.show', compact('gallerie'));
     }

   
     public function update(GalleryRequest $request, $id)
     {
         // Récupère l'enregistrement existant
         $gallerie = gallerie::findOrFail($id);
     
         // Extrait les données de la requête, en excluant l'image
         $input = $request->except('image');
     
         // Vérifie si une image a été téléchargée
         if ($request->hasFile('image')) {
             // Supprime l'ancienne image si elle existe
             if ($gallerie->image) {
                 $oldImagePath = public_path('images/' . $gallerie->image);
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
/* 
         if ($request->hasFile('video')) {
          
            if (!empty($request->video_old) && Storage::disk('public')->exists($request->video_old)) {
                Storage::disk('public')->delete($request->video_old);
            }
    
            $videoPath = $request->file('video')->store('videos', 'public');
            $input['video'] = $videoPath;
        } */
     
         // Met à jour l'enregistrement avec les nouvelles données
         $home->update($input);
     
         // Redirige vers la liste des maisons avec un message de succès
         return redirect()->route('galleries.index')->with('success', 'Gallerie mise à jour avec succès!');
     }
     
  


     public function destroy($id)
{
    // Trouver la galerie à supprimer
    $gallery = Gallerie::findOrFail($id);
    File::delete(public_path('/public/Image/' . $gallery->image));
    // Supprimer la galerie
    // Supprimer le fichier image si il existe


    if ($request->hasFile('video')) {
        $videoPath = public_path('storage/videos/' . $gallery->video);
        if (file_exists($videoPath)) {
            unlink($videoPath); // Supprimer la vidéo
        }
    }
/* 
    if ($gallery->video) {
        $videoPath = storage_path('app/public/videos/' . $gallery->video); 
        if (file_exists($videoPath)) {
            unlink($videoPath); 
        }
    }
 */

    // Supprimer l'entrée dans la base de données
    $gallery->delete();

    // Rediriger après la suppression
    return redirect()->route('galleries.index')->with('success', 'Galerie supprimée avec succès.');
}

}
