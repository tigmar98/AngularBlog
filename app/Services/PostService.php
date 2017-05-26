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

	public function getPostsByCategoryId($categoriesId){
		return $this->post->where('categoryId', $categoriesId)->get();
	}

	public function newPost($data){
		return $this->post->create([
			'postTopic' => $data['postTopic'],
			'post' => $data['post'],
			'categoryId' => $data['categoriesId'],
		]);	
	}

	public function updatePost($data){
		return $this->post->where('id', $data['id'])->update([
				'postTopic' => $data['postTopic'],
				'post' => $data['post'],
			]);
	}

	public function getPostCategoryId($id){
		return $this->post->where('id', $id)->pluck('categoryId')->first();
	}

	public function deletePost($id){
		return $this->post->findOrFail($id)->delete();
	}
	
}