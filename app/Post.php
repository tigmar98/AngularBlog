<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable =
     [
        'post_title','post_body',
     ];
}
