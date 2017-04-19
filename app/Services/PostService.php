<?php

namespace Blog\Services;

use Blog\Contracts\PostServiceInterface;
use Illuminate\Support\Facades\Auth;
use Blog\Category;
use Blog\Post;

class PostService implements PostServiceInterface
{
	public function __construct(Category $category, Post $post){
		$this->category = $category;
		$this->post = $post;
	}
	public function getAllPosts(){
		return $this->post->get();
	}
	public function getPostsByCategoryId($categories_id){
		return $this->post->where('category_id', $categories_id)->get();
	}
	public function newPost($post_topic, $post, $categories_id){
		return $this->post->create([
			'post_topic' => $post_topic,
			'post' => $post,
			//'creator_id' => Auth::user()['id'],
			'category_id' =>$categories_id,
		]);	
	}
	public function updatePost($id, $post_topic, $post){
		return $this->post->where('id', $id)->update([
				'post_topic' => $post_topic,
				'post' => $post,
			]);
	}
	public function getPostCategoryId($id){
		return $this->post->where('id', $id)->pluck('category_id')[0];
	}
	public function deletePost($id){
		return $this->post->findOrFail($id)->delete();
	}
}