<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;

class Product extends Model
{
    use HasFactory;

   /*  protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ]; */


    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'originalPrice',
        'discountPrice',
        'stock',
        'stock_alert',
        'active',
        'image',
        'price',
        'user_id',
        'shop_id',
        'category_id'


    ];
     public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function shops()
    {
        return $this->belongsTo(Shop::class);
    }



    /**
     * Get the reviews of the product.
     */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the user that added the product.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function validReviews()
    {
        return $this->reviews()->whereHas('user', function ($query) {
            $query->whereValid(true);
        });
    }

    /*  public function images()
    {
        return $this->hasMany(ProductImage::class);
    } */
}
