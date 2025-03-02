<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribut extends Model
{
    use HasFactory;


    protected $fillable = ['room_id', 'surface', 'single_price', 'double_price'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
