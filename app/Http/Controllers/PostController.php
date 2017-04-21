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
    
    public function index()
    {
       
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
        $post_service->newPost($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
       
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
        $post_service->updatePost($id, $request->all());
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
        
        foreach ($posts as $post){
            $post['creator'] = $post->category->user->name;
            //dd($post->category->user->id);
            if($post->category->user->id == Auth::user()['id']){
                $post['can_edit'] = 1;
            }
            else {
                $post['can_edit'] = 0;
            }
            $post['category'] = $post->category->category;
        };
        return view('posts', [
            'posts' => $posts,
        ]);
    }
}
