<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Contracts\PostServiceInterface;
use Blog\Contracts\CategoryServiceInterface;
use Blog\Contracts\SocialServiceInterface;
use Blog\Contracts\UserServiceInterface;
use Validator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(CategoryServiceInterface $category_service, SocialServiceInterface $social_service, UserServiceInterface $user_service)
    {
        //
        $viaFacebook = 0;
        $categories = $category_service->allUserCategories();

        if($user_service->checkUserImage()){
            $image_path = "/images/".$user_service->getUserImage();
            if(!file_exists(public_path().$image_path)){
                $image_path = "/images/default-user-image.png";
            }
        } elseif($social_service->userExists()){
            $image_path = $social_service->getImage();
            $viaFacebook = 1;
        }
        else{
            $image_path = "/images/default-user-image.png";
        }
        return view('home',
            [
                'categories' => $categories,
                'image_path' => $image_path,
                'viaFacebook' => $viaFacebook,                
            ]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
        //return redirect('/home');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(PostServiceInterface $post_service, Request $request)
    {
        //Check the post
        $validator = Validator::make($request->all(), 
            [
                'post_topic' => 'required|max:255',
                'post'  => 'required|max:255',
            ]);

       if ($validator->fails()){
                return redirect('/home')
                       ->withInput()
                       ->withErrors($validator);

            }
        //Add a new post
        $post_service->newPost($request->post_topic, $request->post, $request->categories_id);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(PostServiceInterface $post_service, SocialServiceInterface $social_service, CategoryServiceInterface $category_service, UserServiceInterface $user_service, $id)
    {
        //Show all posts from choosen category
        $categories = $category_service->allUserCategories();
        $posts = $post_service->getPostsByCategoryId($id);
        $viaFacebook = 0;
        if($user_service->checkUserImage()){
            $image_path = "/images/".$user_service->getUserImage();
            if(!file_exists(public_path().$image_path)){
                $image_path = "/images/default-user-image.png";
            }
        } elseif($social_service->userExists()){
            $image_path = $social_service->getImage();
            $viaFacebook = 1;
        }
        else{
            $image_path = "/images/default-user-image.png";
        }
        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
            'cat_id' => $id,
            'image_path' => $image_path,
            'viaFacebook' => $viaFacebook,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(PostServiceInterface $post_service, $id)
    {
        //
        return view('editpost')->with('post', $post_service->getPost($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(PostServiceInterface $post_service, Request $request, $id)
    {
        //Update the choosen post

       $validator = Validator::make($request->all(), 
            [
                'post_topic' => 'required|max:255',
                'post'  => 'required|max:255',
            ]);

       if ($validator->fails()){
                return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($validator);

            }
        $post_service->updatePost($id, $request->post_topic, $request->post);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(PostServiceInterface $post_service, $id)
    {
        //Remove the choosen post
        $post_service->deletePost($id);
        return redirect()->back();
    }

    public function showAllPosts(PostServiceInterface $post_service){
        $posts = $post_service->getAllPosts();

        foreach ($posts as $post) {
            $post['creator'] = $post->category->user->name;
            $post['category'] = $post->category->first()->category;
            if($post['creator_id'] === Auth::user()['id']){
                $post['can_edit'] = 1;
            }
            else {
                $post['can_edit'] = 0;
            }
        };
        return view('posts', [
            'posts' => $posts,
        ]);
    }

    public function deletePostFromPosts(PostServiceInterface $post_service, $id){        
        $post_service->deletePost($id);
        return redirect()->back();
    }
}
