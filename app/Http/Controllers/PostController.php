<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = DB::table('categories')->where('creator_id', Auth::user()['id'])->get();
        $posts = Post::orderBy('created_at', 'asc')->get();
        //dd($posts);
        //echo $posts[0]['attributes']['post_topic'];
        //$post = $posts[0]['attributes']['post_topic'];
        //die($post);
        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
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
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'postTitle' => 'required|max:255',
            'postBody'  => 'required|max:255',
        ]);

       if ($validator->fails()) {
            return redirect('/home')
                    ->withInput()
                    ->withErrors($validator);
            }

        $post = new Post;
        $post->post_topic = $request->postTitle;
        $post->post = $request->postBody;
        $post->creator_id = Auth::user()['id'];
        $post->categories_id = 1;
        $post->save();
        return redirect('/home');
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
        Post::findOrFail($id)->delete();
        return redirect('/home');
    }
}