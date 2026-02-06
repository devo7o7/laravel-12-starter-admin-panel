<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = [
        'user_id', 'email', 'name', 'mobile', 'action', 'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
