<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Office extends Model
{
    use HasFactory;
    protected $table = 'office';

    protected $fillable = [
        'name',
        'phone',
        'other_phone',
        'address',
        'is_active',
        'discretion',
        'governorate_id'
    ];


    public function scopeAccepted($query)
    {
        return $query->where('is_active', true);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }
    
}
