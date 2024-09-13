<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Events\ModelCreated;

class Consultation extends Model
{
    use HasFactory, Notifiable;

    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    protected $fillable = [

        'hopital_id',
        'specialites',
        'telephone',
          
      'adresse',
       'ville',


        'nom',
        'prenom',
        'email',
        'age',
        'taille',
        'poids',
        'message',
        'is_read'
    ];



    public function hopital()
    {
        return $this->belongsTo(Hopital::class);
    }

    // Define the relationship with Specialite
    public function specialites()
    {
        return $this->belongsToMany(Specialite::class);
    }
}
