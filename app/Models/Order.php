<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Order extends Model


{

    use Notifiable, HasFactory;
    protected $fillable = [
        'shipping', 'tax', 'user_id','product_id', 'state_id', 'payment', 'reference', 'pick', 'total', 'order_ref_id',
        'order_at',
        'first_name',
        'last_name',
        'phone',
        'company',
        'city',
        'postal_code',
        'name',
        'note',
        'last_name',
        'phone',
        'company',
        'city',
        'postal_code',
        'country',
        'country_id',
        'state',
        'address_id',
        'order_amount',
        'order_ref_id',
        'order_at',
        'statut',
        'mode',
        'etatut',
    
        'email',
        'address',
        'order_amount',
    ];

    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    public function getPaymentTextAttribute($value)
    {
        $texts = [
            'carte' => 'Carte bancaire',
            'virement' => 'Virement',
            'cheque' => 'Chèque',
            'mandat' => 'Mandat administratif',
        ];

        return $texts[$this->payment];
    }

    public function getTotalOrderAttribute()
    {
        return $this->total + $this->shipping;
    }

    public function getTvaAttribute()
    {
        return $this->tax > 0 ? $this->total / (1 + $this->tax) * $this->tax : 0;
    }

    public function getHtAttribute()
    {
        return $this->total / (1 + $this->tax);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function payment_infos()
    {
        return $this->hasOne(Payment::class);
    }
}
