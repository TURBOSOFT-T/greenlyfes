<?php

namespace App\Repositories;

use App\Models\ { Post, Product, Tag };
use Illuminate\Support\Str;

class ProductRepository
{
    /**
     * Create a query for Post.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryActive()
    {
        return Product::select(
                      'id',
                      'slug',
                      'image',
                      'description',

                      'user_id')
                    ->with('user:id,name')
                    ->whereActive(true);
    }

    /**
     * Create a query for Post.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryActiveOrderByDate()
    {
        return $this->queryActive()->latest();
    }

    /**
     * Get active posts collection paginated.
     *
     * @param  int  $nbrPages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDate($nbrPages)
    {
        return $this->queryActiveOrderByDate()->paginate($nbrPages);
    }

    /**
     * Get heros.
     *
     * @param  int  $nbrPages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */


     // pour le nombre  de post à derouler avec la pagination
    public function getHeros()
    {
        return $this->queryActive()->with('categories')->latest('updated_at')->take(10)->get();
    }

    /**
     * Get post by slug.
     *
     * @param  string  $slug
     * @return array
     */
    
    /**
     * Get previous post
     *
     * @param  integer  $id
     * @return \Illuminate\Database\Eloquent\Collection
     */


    /**
     * Get active posts for specified category.
     *
     * @param  int  $nbrPages
     * @param  string  $category_slug
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDateForCategory($nbrPages, $category_slug)
    {
        return $this->queryActiveOrderByDate()
                    ->whereHas('categories', function ($q) use ($category_slug) {
                        $q->where('categories.slug', $category_slug);
                    })->paginate($nbrPages);
    }

    /**
     * Get active posts for specified user.
     *
     * @param  int  $nbrPages
     * @param  integer  $user_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDateForUser($nbrPages, $user_id)
    {
        return $this->queryActiveOrderByDate()
                    ->whereHas('user', function ($q) use ($user_id) {
                        $q->where('users.id', $user_id);
                    })->paginate($nbrPages);
    }

    /**
     * Get active posts for specified tag.
     *
     * @param  int  $nbrPages
     * @param  int  $tag_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDateForTag($nbrPages, $tag_slug)
    {
        return $this->queryActiveOrderByDate()
                    ->whereHas('tags', function ($q) use ($tag_slug) {
                        $q->where('tags.slug', $tag_slug);
                    })->paginate($nbrPages);
    }

    /**
     * Get posts with search.
     *
     * @param  int  $n
     * @param  string  $search
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($n, $search)
    {
        return $this->queryActiveOrderByDate()
                    ->where(function ($q) use ($search) {
                        $q->where('excerpt', 'like', "%$search%")
                          ->orWhere('name', 'like', "%$search%")
                          ->orWhere('description', 'like', "%$search%");
                    })->paginate($n);
    }

    /**
     * Store post.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function store($request)
    {
        $request->merge([
            'active' => $request->has('active'),
            'image' => basename($request->image),
        ]);

        $post = $request->user()->posts()->create($request->all());

        $this->saveCategoriesAndTags($post, $request);
    }

    /**
     * Save categories and tags.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
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

    /**
     * Update post.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function update($post, $request)
    {
        $request->merge([
            'active' => $request->has('active'),
            'image' => basename($request->image),
        ]);

        $post->update($request->all());

        $this->saveCategoriesAndTags($post, $request);
    }

    public function getById($id)
{
    return Post::findOrFail($id);
}
}
