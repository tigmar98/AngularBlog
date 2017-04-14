<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Post;
use Blog\Category;
use Blog\User;
use Illuminate\Support\Facades\Auth;

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
    public function show($id)
    {
        //
        $posts = Post::get();
        foreach ($posts as $post) {
            $post['category'] = Category::where('id', $post['categories_id'])->pluck('category')[0];
            $post['creator'] = User::where('id', $post['creator_id'])->pluck('name')[0];
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
    public function destroy($id)
    {
        //
        //Remove the choosen post
        $postCatId = Post::where('id', $id)->get();
        foreach($postCatId as $post_cat_id){
            $cat_id = $post_cat_id->categories_id;
        }
        //dd($categories);
     
        Post::findOrFail($id)->delete();
        return redirect()->action('AllPostsController@show', [
                'id' => $id
            ]);
    }


    public function __construct()
    {
        $this->middleware('auth');
    }
}
