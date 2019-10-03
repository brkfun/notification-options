<?php

namespace BRKFun\NotificationOptions\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationOption extends Model
{
    protected $fillable
        = [
            'key',
            'value',
            'token',
        ];

    protected $casts = ['value' => 'boolean'];
}
