<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
      protected $fillable = [
        'title',
        'slug',
        'body',

        'active',
        'image',
    ];

    public $timestamps = false;

    /**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class ,'category_id', 'id');
    
    }


}