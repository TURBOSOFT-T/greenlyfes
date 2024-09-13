<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'texte',
        'email',
        'post_id',
    ];
    /**
     * Get the ad that owns the message.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
