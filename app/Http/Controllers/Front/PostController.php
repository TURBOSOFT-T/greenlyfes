<?php

namespace App\Http\Controllers\Front;
use App\Repositories\PostRepository;
use App\Http\Controllers\Controller;
use App\Models\{ Category, Post, User, Tag };
use App\Http\Requests\Front\SearchRequest;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * The PostRepository instance.
     *
     * @var \App\Repositories\PostRepository
     */
    protected $postRepository;

    /**
     * The pagination number.
     *
     * @var int
     */
    protected $nbrPages;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $postRepository
     * @return void
    */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->nbrPages = config('app.nbrPages.posts');
    }

    
    public function blog(Request $request){
        $key = $request->input("key", null);
        $id_categorie = $request->get("category_id", null);
        $price_range = $request->input("price_range", null);
        $ordre_affichage = $request->input("ordre_affichage", null);
        
        $posts = Post::query();

        if(!is_null($key)){
            $posts->where('title', 'like', '%'.$key.'%')
            ->Orwhere('description', 'like', '%'.$key.'%');
        }
        if(!is_null($id_categorie)){
            $posts->where('category_id', $id_categorie);
        }
      
        

        $posts = $posts->orderBy('created_at', 'desc')
        ->paginate(6);
        
        $total_post = Post::count();
       
      
      $categories =Category::has('posts')->get();
    
   
    
        return view('front.blogs.index',compact('posts', 'categories','key','total_post'));
    }



    public function index()
    {
        $posts = $this->postRepository->getActiveOrderByDate($this->nbrPages);
        $heros = $this->postRepository->getHeros();

        return view('front.index', compact('posts', 'heros'));
    }



    public function posts($id)
    {
        $categories = Category::with('posts')->get();
        $current_category = Category::with('posts')->findOrFail($id);
       // $posts = $current_category->posts;
        $posts = $current_category->posts()->paginate(10);
       // $products = $category->products()->paginate(10);
        return view('front.blogs.index', compact('current_category', 'categories', 'posts'));
    }

    public function details($id){
     //   $post =Post::with('comments')-> findOrFail($id);

       // dd($post);
       $post = Post::with('comments')->findOrFail($id);
      // dd($post);
  
       $recentPosts = Post::latest()->take(5)->get();
       $comments = $post->comments()->with('user')->paginate(10);
      
        return view('front.blogs.details', compact('post', 'recentPosts', 'comments'));
    }

    public function searchs(SearchRequest $request)
    {
        $search = $request->search;
        $categories = Category::has('posts')->get();
        $posts = Post::where('title', 'like', '%'.$search.'%')
          //  ->orWhere('body', 'like', '%'.$search.'%')
            ->paginate(10);
        $title = __('Produits nont trouvé avec la recherche: ') . '<strong>' . $search . '</strong>';
     
        return view('front.blogs.index', compact('posts', 'title','categories'));
    }
    
    public function show(Request $request, $slug)
    {
        $post = $this->postRepository->getPostBySlug($slug);
        
       $recentPosts = Post::latest()->take(5)->get();
      // $comments = $post->comments()->with('user')->paginate(10);
      
 
        return view('front.blogs.details', compact('post', 'recentPosts'));
    }

    /**
     * Display a listing of the posts for the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function category(Category $category)
    {
        $posts = $this->postRepository->getActiveOrderByDateForCategory($this->nbrPages, $category->slug);
        $title = __('Posts for category ') . '<strong>' . $category->title . '</strong>';

        return view('front.index', compact('posts', 'title'));
    }

    /**
     * Get posts for specified user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function user(User $user)
    {
        $posts = $this->postRepository->getActiveOrderByDateForUser($this->nbrPages, $user->id);
        $title = __('Posts for author ') . '<strong>' . $user->name . '</strong>';

        return view('front.index', compact('posts', 'title'));
    }

    /**
     * Get posts for specified tag
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function tag(Tag $tag)
    {
        $posts = $this->postRepository->getActiveOrderByDateForTag($this->nbrPages, $tag->slug);
        $title = __('Posts for tag ') . '<strong>' . $tag->tag . '</strong>';

        return view('front.index', compact('posts', 'title'));
    }


}
