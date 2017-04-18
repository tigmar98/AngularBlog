<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
	protected $fillable =
	[
		'category', 'creator_id'
	];
}
