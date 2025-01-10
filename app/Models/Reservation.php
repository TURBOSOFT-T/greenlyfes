<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Events\ModelCreated;

class Reservation extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'room_id',
   
        'date_debut',
        'date_fin',
        'limit',
        'rented',
        'nb_personnes',
        'prix_total',

        'nom',
            'prenom',
            'email',

            'adresse',
            'ville',
            'pays',
            'telephone',
            'note',

            'mode',
            'etat',
     
    ];

    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }


    public function reservations_items(){
        return $this->hasMany(ReservationItem::class, 'reservation_id', 'id');
    }

    
}
