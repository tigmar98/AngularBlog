<?php

namespace Blog\Contracts;

Interface CategoryServiceInterface
{
	public function allUserCategories();
	public function getCategory($post_category_id);
	public function newCategory($category_name);
	public function updateCategory($id, $category);
	public function deleteCategory($id);

}