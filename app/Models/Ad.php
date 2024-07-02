<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ad extends Model
{
    use HasFactory;
    protected $table = 'ads';

    public function scopeAccepted($query)
    {
        return $query->where('is_active', true);
    }
    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
 
        $imageUrl = url('') . "/storage/" . $this->image;
        
        return str_replace('\\', '/', $imageUrl);
    }
}