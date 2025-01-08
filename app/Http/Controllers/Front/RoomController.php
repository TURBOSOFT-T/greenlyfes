<?php

namespace App\Http\Controllers\Front;



use App\DataTables\RoomsDataTable;
use App\Http\{
    Controllers\Controller,
};
use App\Models\{Room, Book};
use App\Http\Requests\Back\RoomRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RoomController extends Controller
{

    public function rooms()
    {
      $rooms = Room::all();
        $users = User::all();
      
        $follows = Follow::all();
        $pages = Page::all();

        return view('front.rooms.index', compact('rooms', 'users', 'follows', 'pages'));
    }

   

    public function room($id)
    {
        $logements = Logement::with('books')->get();
        $current_logement = Logement::with('books')->findOrFail($id);
        $books = $current_logement->books;
      
        return view('front.logements.index', compact('current_logement', 'logements', 'books'));
    }

    public function details($id){
     
        $room = Room::findOrFail($id);
     //   $otherRooms = $room->books;

     $otherRooms = $room->book->rooms()->where('id', '!=', $id)->get();

   
   
        return view('front.rooms.details', compact('room','otherRooms'));
    }

    public function recherche(SearchRequest $request)
    {
        $search = $request->search;
        $logements = Logement::has('books')->get();
        $books = Book::where('title', 'like', '%'.$search.'%')
       
            ->paginate(10);
      
        return view('front.logements.index', compact('books','logements'));
    }


}
