<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecole extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'seo_title',
        'excerpt',
        'body',
        'meta_description',
        'meta_keywords',
        'active',
        'image',
        'telephone',
        'email',
        'adresse',
        'ville',
        'site_web',
        
    ];

    public function filieres()
    {
        return $this->belongsToMany(Filiere::class,'filiere_ecole');
    }
}
