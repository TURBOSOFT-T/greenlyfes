<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'body',

        'active',
        'image',
    ];

    public $timestamps = false;

    public function ecoles()
{
    return $this->belongsToMany(Ecole::class, 'filiere_ecole');
}





public function inscriptions()
{
    return $this->belongsToMany(Inscription::class, 'inscription_filiere');
}

}
