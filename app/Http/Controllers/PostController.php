<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Post;
use Blog\Category;
use Blog\Image;
use Blog\Social;
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
        //
        //$categories = DB::table('categories')->where('creator_id', Auth::user()['id'])->get();
        $viaFacebook = 0;
        $categories = Category::where('creator_id', Auth::user()['id'])->get();

        if(Image::where('user_id', Auth::user()['id'])->exists()){
            $image_path = "/images/".Image::where('user_id', Auth::user()['id'])->orderBy('id', 'desc')->pluck('file_path')[0];
            if(!file_exists(public_path().$image_path)){
                $image_path = "/images/default-user-image.png";
            }
        } elseif(Social::where('user_id', Auth::user()['id'])->exists()){
            $image_path = Social::where('user_id', Auth::user()['id'])->pluck('image_path')[0];
            $viaFacebook = 1;
        }
        else{
            $image_path = "/images/default-user-image.png";
        }
        //dd($categories);
        //dd($image_path);

        return view('home',
            [
                'categories' => $categories,
                'image_path' => $image_path,
                'viaFacebook' => $viaFacebook,
                
            ]);   
        //dd($image_path);
        
        //dd($posts);
        //echo $posts[0]['attributes']['post_topic'];
        //$post = $posts[0]['attributes']['post_topic'];
        //die($post);
        
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
        //Check the post
        $validator = Validator::make($request->all(), 
            [
                'post_topic' => 'required|max:255',
                'post'  => 'required|max:255',
            ]);

       if ($validator->fails())
            {//   dd($validator);
                return redirect('/home')
                       ->withInput()
                       ->withErrors($validator);

            }
        //Add a new post
        $post = new Post;
        $post->post_topic = $request->post_topic;
        $post->post = $request->post;
        $post->creator_id = Auth::user()['id'];
        $post->categories_id = $request->categories_id;
        $post->save();
        $id = $request->categories_id;
        return redirect()->action('PostController@show',
            [
                'id' => $id 
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show all posts from choosen category
        $categories = Category::where('creator_id', Auth::user()['id'])->get();
        $posts = Post::where('categories_id', $id)->get();
        $viaFacebook = 0;
        if(Image::where('user_id', Auth::user()['id'])->exists()){
            $image_path = "/images/".Image::where('user_id', Auth::user()['id'])->orderBy('id', 'desc')->pluck('file_path')[0];
            if(!file_exists(public_path().$image_path)){
                $image_path = "/images/default-user-image.png";
            }
        } elseif(Social::where('user_id', Auth::user()['id'])->exists()){
            $image_path = Social::where('user_id', Auth::user()['id'])->pluck('image_path')[0];
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
        /*return redirect()->action('PostController@index', [
          //  'posts' => $posts,
            'cat_id' => $id,
        ]);*/
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
        //Update the choosen post
        Post::where('id', $id)->update([
            'post_topic' => $request->post_topic,
            'post' => $request->post
            ]);
        return redirect()->action('PostController@index');
        //return $request->postTopic;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Remove the choosen post
        $postCatId = Post::where('id', $id)->get();
        foreach($postCatId as $post_cat_id){
            $cat_id = $post_cat_id->categories_id;
        }
        //dd($categories);
     
        Post::findOrFail($id)->delete();

/*      $categories = DB::table('categories')->where('creator_id', Auth::user()['id'])->get();
        $posts = DB::table('posts')->where('categories_id', $cat_id)->get();

        return view('/home', [
            'posts' => $posts,
            'categories' => $categories,
            'cat_id' => $id,
            ]);*/

        return redirect()->action('PostController@show', 
            [
                'id' => $cat_id
            ]);
    }
}
