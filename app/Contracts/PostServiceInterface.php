<?php

namespace Blog\Contracts;

Interface PostServiceInterface
{	
	public function getAllPosts();
	public function getPostsByCategoryId($categories_id);
	public function newPost($post_topic, $post, $categories_id);
	public function updatePost($id, $post_topic, $post);
	public function getPostCategoryId($id);
	public function deletePost($id);
	//public function 
}