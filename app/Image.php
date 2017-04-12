<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'images';
    protected $fillable =
     [
    	'image'
     ];
}
