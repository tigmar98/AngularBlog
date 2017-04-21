<?php

namespace Blog\Contracts;

Interface PostServiceInterface
{	
	public function getAllPosts();
	public function getPost($id);
	public function getPostsByCategoryId($categories_id);
	public function newPost($post);
	public function updatePost($id, $data);
	public function getPostCategoryId($id);
	public function deletePost($id);
}