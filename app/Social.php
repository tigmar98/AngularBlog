<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    //
    protected $fillable = [
    	'name', 'email', 'token', 'user_id','image_path'
    ];

    protected $hidden = [
    	'token',
    ];
}
