<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
         'total_price_gross', 'quantity','product_id', 'user_id', 'order_id',
         'created_at', 'updated_at',
    ];



    
    public function products(){
        return $this->belongsTo(Product::class ,'product_id')->withDefault();
    }
 

    public function commandes(){
        return $this->belongsTo(Order::class ,'order_id')->withDefault();;
    }
}
