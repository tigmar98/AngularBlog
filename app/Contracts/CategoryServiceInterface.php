<?php

namespace Blog\Contracts;

Interface CategoryServiceInterface
{
	public function allUserCategories();
	public function getCategory($id);
	public function newCategory($categoryName);
	public function updateCategory($id, $category);
	public function deleteCategory($id);

}