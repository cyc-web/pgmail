<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class View extends Model
{
    //
    use SoftDeletes;
    
    public function getImagePathAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
