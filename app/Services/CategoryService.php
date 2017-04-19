<?php

namespace Blog\Services;

use Blog\Contracts\CategoryServiceInterface;
use Illuminate\Support\Facades\Auth;
use Blog\Category;
use Blog\Post;


class CategoryService implements CategoryServiceInterface
{	
	public function __construct(Category $category, Post $post){
		$this->category = $category;
		$this->post = $post;
	}

	public function allUserCategories(){
		return $this->category->where('user_id', Auth::user()['id'])->get();
	}
	public function getCategory($post_category_id){
		return $this->category->where('id', $post_category_id)->pluck('category')[0];
	}
	public function newCategory($category_name){
		return $this->category->create([
				'category' => $category_name,
				'user_id' => Auth::user()['id'],
			]);
	}
	public function updateCategory($id, $category){
		return $this->category->where('id', $id)->update([
				'category' => $category,
			]);
	}
	public function deleteCategory($id){
	    $this->post->where('categories_id', $id)->delete();
		return $this->category->findOrFail($id)->delete();
	}


}
