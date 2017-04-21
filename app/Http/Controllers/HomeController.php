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
    public function index(CategoryServiceInterface $category_service, SocialServiceInterface $social_service, UserServiceInterface $user_service)
    {
        //
        $categories = $category_service->allUserCategories();

        if($user_service->checkUserImage()){
            $image_path = "/images/".$user_service->getUserImage();
            if(!file_exists(public_path().$image_path)){
                $image_path = "/images/default-user-image.png";
            }
        } elseif($social_service->userExists()){
            $image_path = $social_service->getImage();
        }
        else{
            $image_path = "/images/default-user-image.png";
        }
        return view('home',
            [
                'categories' => $categories,
                'image_path' => $image_path,                
            ]);    
    }

     public function show(PostServiceInterface $post_service, SocialServiceInterface $social_service, CategoryServiceInterface $category_service, UserServiceInterface $user_service, $id)
    {
        //Show all posts from choosen category
        $categories = $category_service->allUserCategories();
        $posts = $post_service->getPostsByCategoryId($id);
        if($user_service->checkUserImage()){
            $image_path = "/images/".$user_service->getUserImage();
            if(!file_exists(public_path().$image_path)){
                $image_path = "/images/default-user-image.png";
            }
        } elseif($social_service->userExists()){
            $image_path = $social_service->getImage();
        }
        else{
            $image_path = "/images/default-user-image.png";
        }
        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
            'cat_id' => $id,
            'image_path' => $image_path,
        ]);
    }
}
