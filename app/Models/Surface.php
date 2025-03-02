<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surface extends Model
{
    use HasFactory;

    protected $fillable = ['surface', 'price', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
