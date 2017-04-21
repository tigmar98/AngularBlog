<?php

namespace Blog\Services;

use Blog\Contracts\PostServiceInterface;
use Illuminate\Support\Facades\Auth;
use Blog\Post;

class PostService implements PostServiceInterface
{
	public function __construct(Post $post){
		$this->post = $post;
	}

	public function getAllPosts(){
		return $this->post->get();
	}

	public function getPost($id){
		return $this->post->where('id', $id)->first();
	}

	public function getPostsByCategoryId($categories_id){
		return $this->post->where('category_id', $categories_id)->get();
	}

	public function newPost($data){
		return $this->post->create([
			'post_topic' => $data['post_topic'],
			'post' => $data['post'],
			'category_id' => $data['categories_id'],
		]);	
	}

	public function updatePost($id, $data){
		return $this->post->where('id', $id)->update([
				'post_topic' => $data['post_topic'],
				'post' => $data['post'],
			]);
	}

	public function getPostCategoryId($id){
		return $this->post->where('id', $id)->pluck('category_id')->first();
	}

	public function deletePost($id){
		return $this->post->findOrFail($id)->delete();
	}
	
}