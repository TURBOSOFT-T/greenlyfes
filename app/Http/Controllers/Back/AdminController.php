<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\{ User, Post, Comment, Consultation, Contact, Inscription, Order, Testimonial};
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return View
     */
    public function index(Post $post, Order $order, User $user, Comment $comment, Contact $contact , Inscription $inscription, Consultation $consultation, Testimonial $testimonial)
    {
        $users = isRole('admin') ? $this->getUnreads($user) : null;
        $contacts = isRole('admin') ? $this->getUnreads($contact) : null;
        $posts = isRole('admin') ? $this->getUnreads($post) : null;
         $inscriptions = isRole('admin')? $this->getUnreads($inscription) : null;
         $consultations = isRole('admin')? $this->getUnreads($consultation) : null;
         $testimonials = isRole('admin')? $this->getUnreads($testimonial) : null;
         $orders = isRole('admin')? $this->getUnreads($order) : null;
        $comments = $this->getUnreads($comment, isRole('redac'));

        return view('back.index', compact('posts', 'users', 'contacts', 'comments', 'inscriptions', 'consultations', 'testimonials', 'orders'));
    }

    /**
     * Get the unread notifications.
     *
     * @return boolean
     */
    protected function getUnreads($model, $redac = null)
    {
    

        $query = $redac ? 
            $model->whereHas('post.user', function ($query) {
                $query->where('users.id', auth()->id());
            }) :
            $model->newQuery();

        return $query->has('unreadNotifications')->count();
    }

    /**
     * Purge notifications.
     *
     * @param  String $model
     * @return \Illuminate\Http\Response
     */
    public function purge($model)
    {
        $model = 'App\Models\\' . ucfirst($model);

        DB::table('notifications')->where('notifiable_type', $model)->delete();

        return back();
    }
}
