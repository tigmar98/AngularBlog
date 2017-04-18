<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable =
     [
        'post_topic', 'post', 'creator_id', 'categories_id',
     ];
}
