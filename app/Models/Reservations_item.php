<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations_item extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'reservation_id',
    'room_id',
'total',
 
    'nb_personnes',
  
    'prix_unitaire',
    'prix',
    'benefice',
    'payment_method_id',
    ];


    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function reservation(){
        return $this->belongsTo(Reservation::class , 'reservation_id', 'id');
    }
    public function room(){
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }


    
}
