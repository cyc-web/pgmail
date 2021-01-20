<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable=[
        'sender',
        'sender_id',
        'subject',
        'description',
        'code',
    ];
}
