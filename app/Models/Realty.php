<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Str;

use JWTAuth;

class Realty extends Model
{
    use HasFactory;
    protected $table = 'realty';
    protected $fillable = [
        'name',
        'price',
        'city_id',
        'user_id',
        'governorate_id',
        'space',
        'room',
        'bathroom',
        'content',
        'is_active',
        'property_id',
        'compound_id',
        'property_type_id',
        'features',
        'phone_contact',
        'lng',
        'lat',
        'image',
        'video_url',
        'is_accept',
        'is_published',
        'address'
    ];
  
    
    /**
     * User
     *
     * Get User Uploaded By Brand
     *
     * @return object
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
           // $model->code = rand(10000, 99999);
        });
    }
    public function user(): object
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'email');
    }

    public function scopeAccepted($query)
    {
        return $query->where('is_active', true)->where('is_published',true);
    }

  

    protected $hidden = [
        'image',

        
    ];
    // Add New Attribute to get image address
    protected $appends = ['image_url','InWishlist'];

    /**
     * Get Added Image Attribute URL.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): array
    {

        $images = json_decode($this->image);

        if (!is_array($images)) {
            return [];
        }
    
        $imageUrls = [];
    
        foreach ($images as $image) {
            $imageUrl = url('') . "/storage/realty/" . $image;
            if (Str::contains($imageUrl, '/realty/realty/')) {
                $imageUrl = str_replace('/realty/realty/', '/realty/', $imageUrl);
            }
            
            $imageUrls[] = $imageUrl;
        }
    
        return $imageUrls;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'tag_event');
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }
    public function compound()
    {
        return $this->belongsTo(Compound::class);
    }




    public function users()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    public function usersRealty()
    {
        return $this->belongsToMany(User::class, 'wishlists_Realty');
    }



    public function wishlistsRealty()
    {
        return $this->belongsToMany(User::class, 'wishlists_Realty');
    }

    public function getInWishlistAttribute()
    {
        // Check if the realty is in the current user's wishlist
        try {
            $token = JWTAuth::getToken();
            $user=   JWTAuth::toUser($token ) ;
            if ($user) {
                return   $user->wishlists_realty()->exists();
            }
            return false;
            } catch (\Throwable $th) {
                return false;
            }

    }

}
