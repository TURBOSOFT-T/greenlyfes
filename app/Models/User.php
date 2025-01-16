<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Events\ModelCreated;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;



    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

 //   protected $keyType = 'string';

   //// public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'firstName', 'email', 'password', 'role',

        ' registration_type',
        'first_name',
        'last_name',
        'birth_day',
        'gender',
        //   'regions',
        'country',
        'region',

        'state',
        'address',
        'city',
        'phone',

        'category',
        'currency',

        'registration_number',

        'password',
        'image_path',
        'role',
        'valid',
        'avatar',
        'cover',
        'image',
        'isban',
        'status',
        'approved',
        'code',
        'currency_id',
         'is_activated',



        'valid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id'  );
    }

    

    /**
     * Determine if user is administrator
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }


    /*  public static function boot()
    {
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    } */


    public function products()
    {
        return $this->hasMany(Product::class);
    }
    

    public function books(){
        return $this->hasMany(Book::class );
    }

    public function rooms(){
        return $this->hasMany(Room::class , 'user_id', 'id' );
    }

    /**
     * Get the reviews the user has made.
     */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function temognage(){
        return $this->hasMany(Testimonial::class);
    }

  /*   public function getJWTIdentifier()
    {
        return $this->getKey();
    } */

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    /* public function getJWTCustomClaims()
    {
        return [];
    } */

 
}