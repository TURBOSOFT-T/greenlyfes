<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
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


    public function getPath()
    {
        $url = 'uploads/' . $this->image;
        return $url;
    }
}