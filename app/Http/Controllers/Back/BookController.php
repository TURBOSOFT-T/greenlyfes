<?php

namespace App\Http\Controllers\Back;

use App\DataTables\BooksDataTable;
use App\Http\{
    Controllers\Controller,
};
use App\Http\Requests\Back\{BookRequest,BookUpdateRequest} ;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Logement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{

    
    protected $dataTable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BooksDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }

    public function __invoke(Request $request, Book $book)
    {
        if ($book->active || $request->user()->admin) {
            return view('books.show', compact('book', 'book'));
        }
        return redirect(route('home'));
    }

  

    public function create()
    {
        $logements = Logement::all();
        return view('back.books.form', compact('logements'));
    }
 



    public function store(BookRequest $request)
    {
        $validated = $request->validate([
           // 'name' => 'required|string|max:255',
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
                // Obtenir l'extension et générer un nom unique pour chaque image
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
    
                // Déplacer l'image dans le répertoire public
                $file->move('public/Image/', $filename);
    
                // Ajouter le nom de fichier au tableau des images
                $images[] = $filename;
            }
    
            // Enregistrer le tableau d'images dans la base de données sous forme de JSON
            $input['images'] = json_encode($images);
        }


           // Gestion de la vidéo
    if ($request->hasFile('video')) {
        $input['video'] = $request->file('video')->store('videos', 'public'); // Stockage de la vidéo
    }




        $user->books()->create($input);

        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }


    public function show(string $id)
    {

      
        $book = Book::find($id);
 
        $book->decodedImages = json_decode($book->images, true);
        
        return view('back.books.show', compact('book'));
    }

    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $logements = Logement::all()->pluck('title', 'id');
       // dd($book);

      //  dd($produit);
        return view('back.books.edit', compact('book', 'logements'));
     
    }



    public function update(BookUpdateRequest  $request, $id)
    {

        $user = Auth::user();


        $input = $request->all();
        $input = Book::findOrFail($id);
       $img = Book::find($id);
        File::delete(public_path('/public/Image' . $input->image));
        File::delete(public_path('/public/Image' . $input->cover));


   
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
                unlink(public_path('public/Image/'. $img->image));
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
 
    $input->description = $request->description;
  
        $user->books()->save($input);

        return redirect()->route('books.index')->with('success', 'Product updated successfully!');
    }




    public function destroy($id)
    {
        $img = Book::find($id);
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
         
      

         Book::findOrFail($id)->forceDelete();
        return redirect()->route('books.index')
            ->with('success', 'Product deleted successfully');
    }



}
