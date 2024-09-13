<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CommentRequest;
use App\Models\{ Comment, Post };
use Illuminate\Http\Request;

class CommentController extends Controller
{
   /*  public function __construct()
    {
        if(!request()->ajax()) {
            abort(403);
        }
    }
 */
    /**
     * Store a newly created comment in storage.
     *
     * @param  \App\Http\Requests\Front\CommentRequest $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, Post $post)
    {        
        $data = [
            'body' => $request->message,
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
            'rating' => $request->rating,

        ];
//dd($data);
        $request->has('commentId') ?
            Comment::findOrFail($request->commentId)->children()->create($data):
            Comment::create($data);

        $commenter = $request->user();

        return response()->json($commenter->valid ? 'ok' : 'invalid');
     // return redirect()->back()->with('success', 'Comment added successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json();
    }

    /**
     * Get the comments for the specified post.
     *
     * @param  \App\Models\Post  $post
     * @param  integer $page
     * @return array
     */
    public function comments(Post $post)
    {
        $comments = $post->validComments()
                         ->withDepth()
                         ->latest()
                         ->get()
                         ->toTree();

        return [
            'html' => view('front/comments', compact('comments'))->render(),
        ];
    }

    public function storeComment(Request $request, $postId)
{
    $request->validate([
        'body' => 'required|string|max:255',
    ]);

    Comment::create([
        'post_id' => $postId,
        'user_id' => auth()->id(),
        'body' => $request->body
    ]);

    return redirect()->back()->with('success', 'Commentaire ajouté avec succès !');
}

}
