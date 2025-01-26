<?php

namespace App\Http\Controllers\Back;

use App\DataTables\RoomsDataTable;
use App\Http\{
    Controllers\Controller,
};
use App\Models\{Room, Book};
use App\Http\Requests\Back\RoomRequest;
use App\Http\Requests\Back\RoomUpdateRequest;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RoomController extends Controller
{

    
    protected $dataTable;

  
    public function index(RoomsDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }


    public function create()
    {
       // $books = Book::all();
       $user = auth()->user();

       // Vérifier si l'utilisateur est admin
       if ($user->isAdmin()) {
           // Si l'utilisateur est admin, récupérer tous les livres
           $books = Book::all();
       } else {
           // Sinon, récupérer uniquement les livres de l'utilisateur
           $books = Book::where('user_id', $user->id)->get();
       }
     
        return view('back.rooms.form', compact('books'));
    }

   
    public function store(RoomRequest $request)
    {     $validated = $request->validate([
        
         'slug' => 'nullable|string|max:255',
     ]);

     $user = Auth::user();

// Générer le slug si vide
$validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);


        $input = $request->all();

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/', $filename);
            $input['image'] = $filename;

        } 

             
        if ($request->hasFile('cover')) {

            $file = $request->file('cover');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/', $filename);
            $input['cover'] = $filename;

        }
        
        if ($request->hasFile('images')) {

            $images = [];
            foreach ($request->file('images') as $file) {
                
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
    
                
                $file->move('public/Image/', $filename);
    
                
                $images[] = $filename;
            }
            $input['images'] = json_encode($images);
        }


         
    if ($request->hasFile('video')) {
        $input['video'] = $request->file('video')->store('videos', 'public'); // Stockage de la vidéo
    }
        $user->rooms()->create($input);

        return redirect()->route('rooms.index')->with('success', 'La chambre a bien été ajoutée');
    }

     public function show(string $id)
    {
         
        $room = Room::find($id);
    
        $room->decodedImages = json_decode($room->images, true);
        return view('back.rooms.show', compact('room'));
    }

    public function edit(string $id)
    {
        $room = Room::findOrFail($id);
      //  dd($room);
        $logements = Book::all()->pluck('title', 'id');
     
        return view('back.rooms.edit', compact('room', 'logements'));
     
    }



    public function update(RoomUpdateRequest $request, $id)
    {

        $user = Auth::user();
      
        $input = Room::findOrFail($id);
        $img = Room::find($id);
        File::delete(public_path('/public/Image' . $img->image));
        File::delete(public_path('/public/Image' . $img->cover));


        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image du serveur
            if ($img->image) {
                unlink(public_path('public/Image/'. $img->image));
            }



            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/', $filename);
            $input['image'] = $filename;
        }


        if ($request->hasFile('cover')) {
            // Supprimer l'ancienne image du serveur
            if ($img->cover) {
                unlink(public_path('public/Image/'. $img->cover));
            }



            $file = $request->file('cover');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/', $filename);
            $input['cover'] = $filename;
        }

        if ($request->hasFile('images')) {
            
            $oldImages = json_decode($input->images);
            if ($oldImages) {
                foreach ($oldImages as $oldImage) {
                    $oldImagePath = public_path('public/Image/' . $oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
    
           
            $newImages = [];
            
           
            foreach ($request->file('images') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('public/Image'), $filename);
                $newImages[] = $filename;
            }
    
          
            $input['images'] = json_encode($newImages);
        }


        // Gestion de la vidéo
        if ($request->hasFile('video')) {
            if ($input->video) {
                unlink(public_path('storage/'. $input->video));
            }
            $input['video'] = $request->file('video')->store('videos', 'public'); // Stockage de la vidéo
        }
        

   
      

    $input->name = $request->name;
    $input->price = $request->price;
    $input->slug = $request->slug;
    $input->price = $request->price;
 
    $input->description = $request->description;
  
        $user->rooms()->save($input);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully!');
    }




    public function destroy($id)
    {
        $img = Room::find($id);
        File::delete(public_path('/public/Image/' . $img->image));
        File::delete(public_path('/public/Image' . $img->cover));

        if ($img->images) {
            foreach (json_decode($img->images) as $image) {
                if (file_exists(public_path('/public/Image/' . $image))) {
                    unlink(public_path('/public/Image/' . $image));
                }
            }
        }

       // if ($request->hasFile('video')) {
            if ($img->video) {
                unlink(public_path('storage/'. $img->video));
            }
         
      

         Room::findOrFail($id)->forceDelete();
        return redirect()->route('rooms.index')
            ->with('success', 'Room deleted successfully');
    }


}
