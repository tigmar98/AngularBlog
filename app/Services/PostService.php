<?php

namespace Blog\Services;

use Blog\Contracts\PostServiceInterface;
use Illuminate\Support\Facades\Auth;
use Blog\Category;
use Blog\Post;

class PostService implements PostServiceInterface
{
	public function __construct(){
		$this->category = new Category;
		$this->post = new Post;
	}

	public function newPost($post_topic, $post, $categories_id){
		return $this->post->create([
			'post_topic' => $post_topic,
			'post' => $post,
			'creator_id' => Auth::user()['id'],
			'categories_id' =>$categories_id,
		]);	
	}
}