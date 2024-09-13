<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hopital extends Model
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

    public function specialites()
{
    //return $this->belongsToMany(Specialite::class, array();
    return $this->belongsToMany(Specialite::class , 'specialite_hopital');
}

public function consultations()
{
    return $this->hasMany(Consultation::class);
}
}
