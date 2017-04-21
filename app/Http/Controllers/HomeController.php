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
    public function index(CategoryServiceInterface $categoryService, SocialServiceInterface $socialService, UserServiceInterface $userService)
    {
        //
        $categories = $categoryService->allUserCategories();

        if($userService->checkUserImage()){
            $imagePath = "/images/".$userService->getUserImage();
            if(!file_exists(public_path().$imagePath)){
                $imagePath = "/images/default-user-image.png";
            }
        } elseif($socialService->userExists()){
            $imagePath = $socialService->getImage();
        }
        else{
            $imagePath = "/images/default-user-image.png";
        }
        return view('home',
            [
                'categories' => $categories,
                'imagePath' => $imagePath,                
            ]);    
    }

     public function show(PostServiceInterface $postService, SocialServiceInterface $socialService, CategoryServiceInterface $categoryService, UserServiceInterface $userService, $id)
    {
        //Show all posts from choosen category
        $categories = $categoryService->allUserCategories();
        $posts = $postService->getPostsByCategoryId($id);
        if($userService->checkUserImage()){
            $imagePath = "/images/".$userService->getUserImage();
            if(!file_exists(public_path().$imagePath)){
                $imagePath = "/images/default-user-image.png";
            }
        } elseif($socialService->userExists()){
            $imagePath = $socialService->getImage();
        }
        else{
            $imagePath = "/images/default-user-image.png";
        }
        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
            'catId' => $id,
            'imagePath' => $imagePath,
        ]);
    }
}
