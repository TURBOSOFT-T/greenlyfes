<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;

class Review extends Model
{
    use HasFactory;
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];


    public function products()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * Get the user that made the review.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
