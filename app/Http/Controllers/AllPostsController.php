<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Blog\Contracts\UserServiceInterface;
use Blog\Contracts\CategoryServiceInterface;
use Blog\Contracts\PostServiceInterface;

class AllPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PostServiceInterface $post_service, UserServiceInterface $user_service, CategoryServiceInterface $category_service, $id)
    {
        //
        $posts = $post_service->getAllPosts();
        foreach ($posts as $post) {
            $post['category'] = $category_service->getCategory($post['categories_id']);
            $post['creator'] = $user_service->getUserName($post['creator_id']);
            if($post['creator_id'] === Auth::user()['id']){
                $post['can_edit'] = 1;
            }
            else {
                $post['can_edit'] = 0;
            }
        };
        //dd($posts);
        return view('posts', [
            'posts' => $posts,
            //'categories' => $categories,
        ]);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostServiceInterface $post_service, $id)
    {
        //
        //Remove the choosen post
        $postCatId = $post_service->getPostCategoryId($id);
        //dd($categories);
     
        $post_service->deletePost($id);
        return redirect()->action('AllPostsController@show', [
               'id' => $id
            ]);
    }


    public function __construct()
    {
        $this->middleware('auth');
    }
}
