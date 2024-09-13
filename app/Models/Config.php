<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
            'logo',
            'logoHeader',
            'image',
            'imagelogin',
            'imagergister',
            'imageabout',
            'imageservice',
            'imagefooter',
            'imageteam',
            'imageblog',
            'imagefaq',
            'imageecole',
            'imagesante',
            'imageindustrielle',
            'description',
            'imageeducation',
            'imageservices',
            'imageclient',
            'imagecontact',
            'telephone',
            'addresse',
            'email',
            'frais',
            'annee',
            'utilisateur',
            'dossier',
            'projet',
            'icon',


            'mission',
            'vision',
            'valeurs',
            'equipe',
            'domaine',
            'des_contact',
    ];


}
