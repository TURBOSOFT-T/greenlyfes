<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\{Book, User, Post, Comment,Room, Consultation, Contact, Inscription, Order, Reservation, Testimonial};
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return View
     */
    public function index(Reservation $reservation,Room $room, Book $book, Post $post, Order $order, User $user, Comment $comment, Contact $contact, Inscription $inscription, Consultation $consultation, Testimonial $testimonial)
    {
        $users = isRole('admin') ? $this->getUnreads($user) : null;
        $contacts = isRole('admin') ? $this->getUnreads($contact) : null;
        $posts = isRole('admin') ? $this->getUnreads($post) : null;
        $inscriptions = isRole('admin') ? $this->getUnreads($inscription) : null;
        $consultations = isRole('admin') ? $this->getUnreads($consultation) : null;
        $testimonials = isRole('admin') ? $this->getUnreads($testimonial) : null;
        $orders = isRole('admin') ? $this->getUnreads($order) : null;
        $books = isRole('admin') ? $this->getUnreads($book) : null;
        $comments = $this->getUnreads($comment, isRole('redac'));
        $reservations = isRole('admin') ? $this->getUnreads($reservation) : null;
        $rooms = isRole('admin') ? $this->getUnreads($room) :null;
    // $reservations = $this->getUnreads($reservation , isRole('redac'));




        $userData = array_fill(0, 12, 0);
        $currentYear = Carbon::now()->year;
        $usersByMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('count', 'month');
        foreach ($usersByMonth as $month => $count) {
            $userData[$month - 1] = $count;
        }

        $bookData = array_fill(0, 12, 0);
        $currentYear = Carbon::now()->year;
        $booksByMonth = Book::selectRaw('MONTH(created_at) as   month, COUNT(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('count', 'month');
        foreach ($booksByMonth as $month => $count) {
            $bookData[$month - 1] = $count;
        }

      /*   $reservationData = array_fill(0, 12, 0);
        $currentYear = Carbon::now()->year;
        $reservationsByMonth = Reservation::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->pluck('count', 'month');
        foreach ($reservationsByMonth as $month => $count) {
            $reservationData[$month - 1] = $count;
        }
 */


        $orderData = array_fill(0, 12, 0);
        $currentYear = Carbon::now()->year;
        $ordersByMonth = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('count', 'month');
        foreach ($ordersByMonth as $month => $count) {
            $orderData[$month - 1] = $count;
        }

        return view('back.index', compact('rooms','reservations','bookData','userData', 'orderData', 'books', 'posts', 'users', 'contacts', 'comments', 'inscriptions', 'consultations', 'testimonials', 'orders'));
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
       /*  $query = $redac ?
            $model->whereHas('book.user', function ($query) {
                $query->where('users.id', auth()->id());
            }) :
            $model->newQuery(); */
           /*  $query = $redac?
            $model->whereHas('reservation.user', function ($query) {
                $query->where('users.id', auth()->id());
            }) :    
            $model->newQuery(); */

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



    public function storageLink()
    {
        // check if the storage folder already linked;
        if (File::exists(public_path('storage'))) {
            // removed the existing symbolic link
            File::delete(public_path('storage'));

            //Regenerate the storage link folder
            try {
                Artisan::call('storage:link');
                request()->session()->flash('success', 'Successfully storage linked.');
                return redirect()->back();
            } catch (\Exception $exception) {
                request()->session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        } else {
            try {
                Artisan::call('storage:link');
                request()->session()->flash('success', 'Successfully storage linked.');
                return redirect()->back();
            } catch (\Exception $exception) {
                request()->session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        }
    }
}
