<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends \TCG\Voyager\Models\User implements JWTSubject
{

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'password',
        'nationality',
        'age',
        'about',
        'code',
        'fcm_token',
        'address',
        'lat',
        'lng'
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
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
    protected $appends = ['image_url'];

    /**
     * Get Added Image Attribute URL.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): string | null
    {
        if (is_null($this->image) || $this->image === "") {
            return null;
        }

        return url('') . "/storage/" . $this->image;
    }

    /**
     * Products
     *
     * Get All products uploaded by user
     *
     * @return object Eloquent product object
     */
    public function products()
    {
        return $this->hasMany(Product::class)->orderBy('id', 'desc');
    }
    public function events()
    {
        return $this->hasMany(Event::class)->orderBy('id', 'desc');
    }

    public function wishlists()
    {
        return $this->belongsToMany(Event::class, 'wishlists');
    }

    public function wishlists_realty()
    {
        return $this->belongsToMany(Realty::class, 'wishlists_realty');
    }

  
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
}
