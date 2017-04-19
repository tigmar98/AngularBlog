<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable =
     [
        'post_topic', 'post',  'category_id',
     ];

	public function category(){
		return $this->belongsTo('Blog\Category');
	}    
}
