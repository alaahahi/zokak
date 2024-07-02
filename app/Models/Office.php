<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Office extends Model
{
    use HasFactory;
    protected $table = 'office';

    public function scopeAccepted($query)
    {
        return $query->where('is_active', true);
    }
    
}
