<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
	protected $fillable =
	[
		'category', 'user_id'
	];
	public function user(){
		return $this->belongsTo('Blog\User');
	}
	public function posts(){
		return $this->hasMany('Blog\Post');
	}
}
