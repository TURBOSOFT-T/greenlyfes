<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use Illuminate\Notifications\Notifiable;

class Inscription extends Model
{
    use HasFactory, Notifiable;


    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];
    protected $fillable = [

        'ecole_id',
        'filiere_id',
        'filieres',
        'annee',
        'date_inscription',
        'date_naissance',
        'genre',

        'adresse',
        'ville',
        'pays',
        'telephone',
        'nom',

        'prenom',
        'email',

        'is_read',


        'message',
    ];



    public function ecole()
    {
        return $this->belongsTo(Ecole::class);
    }

    // Define the relationship with Specialite
    public function filieres()
    {
        return $this->belongsToMany(Filiere::class, 'inscription_filiere');
    }
}
