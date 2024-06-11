<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifications extends Model
{
    use HasFactory;
    protected $table = 'notification';  
    protected $fillable = [
        'user_id',
        'event_id',
        'text',
        'body',
        'admin_id'
    ];
}
