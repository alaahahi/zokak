<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Governorate extends Model
{
    use HasFactory;
    protected $table = 'governorate';

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
