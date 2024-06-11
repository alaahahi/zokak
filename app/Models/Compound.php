<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compound extends Model
{
    use HasFactory;
    protected $table = 'compound';

    /**
     * Override fillable property data.
     *
     * @var array
     */
    protected $fillable = [
        'name_ar',
        'name_en',
        'name_kr',
        'lan',
        'lat',
        'is_active',
        'order',
        'number_of_buliiding'
    ];
    protected $hidden = [
        'name_ar',
        'name_en',
        'name_kr',
        
    ];
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    protected $appends = ['image_url','name'];

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



    public function getNameAttribute()
    {
        $language =  app()->getLocale();
        switch ($language) {
            case 'ar':
                return $this->name_ar;
                break;
            case 'kr':
                return $this->name_kr;
                break;
            default:
                return $this->name_en;
                break;
        }
    }
}
