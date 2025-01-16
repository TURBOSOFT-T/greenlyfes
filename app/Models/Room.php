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
        'cover',
        'meta_description',
        'meta_keywords',
        'tags',
        'originalPrice',
        'price',
        'discountPrice',
        'stock',
        'stock_alert',
        'image',
        'images',
        'video',
        'user_id',
        'id_promotion',
       
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


    
    public function reservations_items(){
        return $this->hasMany(ReservationItem::class, 'room_id', 'id');
    }


     public function getPrice()
    {
        if ($this->id_promotion) {
            $promotion = promotions::find($this->id_promotion);
            if ($promotion) {
                $prices = $this->price - ($this->price * ($promotion->pourcentage / 100));
                return $prices;
            } else {
                return $this->price;
            }
        } else {
            return $this->price;
        }

    }

    public function inPromotion()
    {
        if ($this->id_promotion) {
            $promotion = promotions::find($this->id_promotion);
            if ($promotion) {
                return $promotion;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
