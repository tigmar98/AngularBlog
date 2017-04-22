<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Contracts\PostServiceInterface;
use Blog\Contracts\CategoryServiceInterface;
use Blog\Contracts\SocialServiceInterface;
use Blog\Contracts\UserServiceInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryServiceInterface $categoryService,  UserServiceInterface $userService)
    {
        //
        $categories = $categoryService->allUserCategories();
        $imagePath = $userService->getUserImage();
        return view('home',
            [
                'categories' => $categories,
                'imagePath' => $imagePath,                
            ]);    
    }

     public function show(PostServiceInterface $postService, CategoryServiceInterface $categoryService, UserServiceInterface $userService, $id)
    {
        //Show all posts from choosen category
        $categories = $categoryService->allUserCategories();
        $posts = $postService->getPostsByCategoryId($id);
        $imagePath = $userService->getUserImage();
        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
            'catId' => $id,
            'imagePath' => $imagePath,
        ]);
    }
}
