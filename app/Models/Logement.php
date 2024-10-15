<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'slug',
      
    ];

    public $timestamps = false;




    public function books()
{
    return $this->hasMany(Book::class ,'book_id', 'id');
}


}
