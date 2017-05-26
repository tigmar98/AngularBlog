<?php

namespace Blog\Contracts;

Interface PostServiceInterface
{	
	public function getAllPosts();
	public function getPost($id);
	public function getPostsByCategoryId($categoriesId);
	public function newPost($post);
	public function updatePost($data);
	public function getPostCategoryId($id);
	public function deletePost($id);
}