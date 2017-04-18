<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Contracts\PostServiceInterface;
use Blog\Contracts\CategoryServiceInterface;
use Blog\Contracts\SocialServiceInterface;
use Blog\Post;
use Blog\Category;
use Blog\Image;
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
    
    public function index(CategoryServiceInterface $category_service, SocialServiceInterface $social_service)
    {
        //
        //$categories = DB::table('categories')->where('creator_id', Auth::user()['id'])->get();
        $viaFacebook = 0;
        $categories = $category_service->allCategories();

        if(Image::where('user_id', Auth::user()['id'])->exists()){
            $image_path = "/images/".Image::where('user_id', Auth::user()['id'])->orderBy('id', 'desc')->pluck('file_path')[0];
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
    public function store(PostServiceInterface $post_service, Request $request)
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
        $post_service->newPost($request->post_topic, $request->post, $request->categories_id);
        //$post_service->newPost('123', '123', '3');
        
        return redirect()->action('PostController@show',
            [
                'id' => $request->categories_id, 
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SocialServiceInterface $social_service, $id)
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
        return redirect()->action('PostController@show', 
            [
                'id' => $cat_id
            ]);
    }
}
