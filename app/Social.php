<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    //
    protected $fillable = [
    	'name', 'email', 'token', 'userId','imagePath'
    ];

    protected $hidden = [
    	'token',
    ];
    public function user(){
    	return $this->belongsTo('Blog\User', 'userId');
    }
}
