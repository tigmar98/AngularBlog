<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
	protected $fillable =
	[
		'category', 'userId'
	];
	public function user(){
		return $this->belongsTo('Blog\User', 'userId');
	}
	public function posts(){
		return $this->hasMany('Blog\Post', 'categoryId');
	}
}
