<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable=[
        'user_id',
        'owner',
        'phone',
        'subject',
        'description',
        'attachment',
        'reply',
        'forward'
    ];
}
