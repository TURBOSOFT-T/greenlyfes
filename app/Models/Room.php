<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use Illuminate\Notifications\Notifiable;

class Room extends Model
{
    use HasFactory, Notifiable;


    protected $fillable = [
       
        'book_id',
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


    public function book(){
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function reservation(){
        return $this->hasMany(Reservation::class);
    }
}
