<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
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



    public function hopitals()
{
    return $this->belongsToMany(Hopital::class, 'specialite_hopital');
}

public function consultations()
{
    return $this->belongsToMany(Consultation::class);
}
}
