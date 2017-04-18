<?php

namespace Blog\Services;

use Blog\Contracts\CategoryServiceInterface;
use Illuminate\Support\Facades\Auth;
use Blog\Category;
use Blog\Post;


class CategoryService implements CategoryServiceInterface
{	
	public function __construct(){
		$this->category = new Category;
		$this->post = new Post;
	}

	public function allCategories(){
		return $this->category->where('creator_id', Auth::user()['id'])->get();
	}
	public function newCategory($category_name){
		return $this->category->create([
				'category' => $category_name,
				'creator_id' => Auth::user()['id'],
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
