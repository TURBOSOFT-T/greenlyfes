<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Events\ModelCreated;

class Gallery extends Model
{
    use HasFactory, Notifiable;

    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    protected $fillable = [
        'titre',
        'slug',
        
        'description',
      
        'image',
        'video',
       


    ];
}
