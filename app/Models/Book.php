<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use Illuminate\Notifications\Notifiable;

class Book extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
       
        'logement_id',
        'name',
        'slug',
        'short_description',
        'description',
        'active',
        'title',
        'seo_title',
        'excerpt',
        'body',
        'meta_description',
        'meta_keywords',
        'tags',
        'originalPrice',
        'discountPrice',
        'stock',
        'stock_alert',
        'image',
        'cover',
        'images',
        'video',
        'user_id',
       
        'created_at',
        'updated_at',
        'deleted_at',
      



    
      
      

       
    ];

    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    public function logements()
    {
      //  return $this->belon(Logement::class, 'logement_id', 'id');
       return $this->belongsTo(Logement::class , 'logement_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
