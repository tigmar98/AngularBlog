<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Contracts\PostServiceInterface;
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

    public function create(Request $request)
    {
        //
        $request->session()->flash('previousPostCreateUrl', $request->session()->all()['_previous']['url']);
        return view('createPost',
            [
                'catId' => $request->catId,
            ]);
        //}


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(PostServiceInterface $postService, Request $request)
    {
        //Check the post

        $validator = Validator::make($request->all(), 
            [
                'postTopic' => 'required|max:255',
                'post'  => 'required|max:255',
            ]);

       if ($validator->fails()){
                return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($validator);

            }
        //Add a new post
        $postService->newPost($request->all());
        //dd($request->session()->all()['previousUrl']);
        return redirect($request->session()->all()['previousPostCreateUrl']);
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

    public function edit(PostServiceInterface $postService,Request $request, $id)
    {
        //
        $request->session()->flash('previousPostEditUrl', $request->session()->all()['_previous']['url']);
        return view('editPost')->with('post', $postService->getPost($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(PostServiceInterface $postService, Request $request, $id)
    {
        //Update the choosen post

       $validator = Validator::make($request->all(), 
            [
                'postTopic' => 'required|max:255',
                'post'  => 'required|max:255',
            ]);

       if ($validator->fails()){
                return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($validator);

            }
        $postService->updatePost($id, $request->all());
        return redirect($request->session()->all()['previousPostEditUrl']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(PostServiceInterface $postService, $id)
    {
        //Remove the choosen post
        $postService->deletePost($id);
        return response()->json(['msg' => 'You have just deleted a Post, Sir!!!']);
    }

    public function showAllPosts(PostServiceInterface $postService){
        $posts = $postService->getAllPosts();
        
        foreach ($posts as $post){
            $post['creator'] = $post->category->user->name;
            //dd($post->category->user->id);
            if($post->category->user->id == Auth::user()['id']){
                $post['canEdit'] = 1;
            }
            else {
                $post['canEdit'] = 0;
            }
            $post['category'] = $post->category->category;
        };
        return view('posts', [
            'posts' => $posts,
        ]);
    }


    public function showPosts(PostServiceInterface $postService, Request $request, $id){
        $posts = $postService->getPostsByCategoryId($id);
       
        return response()->json($posts);
        //return response()->json(['success' => 'success']);
    }

}
