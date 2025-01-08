<?php

namespace App\Http\Controllers\Back;
use App\Http\{
    Controllers\Controller,
    Requests\Back\PostRequest
};
use App\Repositories\PostRepository;
use App\Models\{ Post, Category };
use App\DataTables\PostsDataTable;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ {  Tag };
use Illuminate\Support\Str;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
 
    public function index(PostsDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }

  

    public function create($id = null)
{
    $post = null;

    if ($id) {
        $post = Post::find($id);

        if ($post && $post->user_id === auth()->id()) {
            // Clone the post
            $post->title = $post->title . ' (2)';
            $post->slug = $this->generateUniqueSlug($post->slug . '-2');
            $post->active = false;
        } else {
            $post = null; // Reset post if conditions aren't met
        }
    }

    $categories = Category::all()->pluck('title', 'id');

    return view('back.posts.form', compact('post', 'categories'));
}

private function generateUniqueSlug($slug)
{
    $originalSlug = $slug;
    $counter = 1;

    while (Post::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $counter;
        $counter++;
    }

    return $slug;
}


  
    public function store(PostRequest $request, PostRepository $repository)
    {
        $user = Auth::user();


    $input = $request->all();

    if ($request->hasFile('image')) {

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('public/Image/posts/', $filename);
        $input['image'] = $filename;
    }
    $input['active'] = $request->has('active') ? 1 : 0;


  $post=  $user->posts()->create($input);


    $this->saveCategoriesAndTags($post, $request);


        return back()->with('ok', __('The post has been successfully created'));
    }


    protected function saveCategoriesAndTags($post, $request)
    {
        // Categorie
        $post->categories()->sync($request->categories);

        // Tags
        $tags_id = [];

        if($request->tags) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag) {
                $tag_ref = Tag::firstOrCreate([
                    'tag' => ucfirst($tag),
                    'slug' => Str::slug($tag),
                ]);
                $tags_id[] = $tag_ref->id;
            }
        }

        $post->tags()->sync($tags_id);
    }

   



    public function edit(Post $post)
    {
        $categories = Category::all()->pluck('title', 'id');
     

       $post = Post::find($post->id);
   
        return view('back.posts.form', compact('post', 'categories'));
    }

  
        public function update(Request $request, PostRepository $repository, $id)
    {
        $user = Auth::user();
        $post = $user->posts()->findOrFail($id);
    
        $input = $request->all();
    
        if ($request->hasFile('image')) {
            // Supprimez l'ancienne image si nécessaire
            if ($post->image) {
                $oldImagePath = storage_path('app/public/' . $post->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            // Téléchargez la nouvelle image
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(storage_path('app/public/posts'), $filename);
            $input['image'] = 'posts/' . $filename;
        } else {
            // Conserver l'ancienne image si aucune nouvelle image n'est téléchargée
            $input['image'] = $post->image;
        }
    
        // Convertir la valeur de 'active' en entier
        $input['active'] = $request->has('active') ? 1 : 0;
    
        // Mettre à jour le post
        $post->update($input);
    
        return back()->with('ok', __('The post has been successfully updated'));
    }
    

   
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json();
    }


}
