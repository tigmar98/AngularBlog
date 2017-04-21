<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable =
     [
        'postTopic', 'post',  'categoryId',
     ];

	public function category(){
		return $this->belongsTo('Blog\Category', 'categoryId');
	}    
}
