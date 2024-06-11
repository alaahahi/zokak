<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'city';

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
    ];
    protected $hidden = [
        'name_ar',
        'name_en',
        'name_kr',
        
    ];
    protected $appends = ['name'];
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
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
