<?php

namespace Blog\Contracts;

Interface CategoryServiceInterface
{
	public function allCategories();
	public function newCategory($category_name);
	public function updateCategory($id, $category);
	public function deleteCategory($id);

}