<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipent extends Model
{
    use SoftDeletes;
    //
    protected $fillable =[
        'user_id',
        'message_id',
        'reply_id',
        'forward_id'
    ];
}
