<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Blog\Category;
use Blog\Post;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        $validator = Validator::make($request->all(), 
            [
                'categoryName' => 'required|max:255',
            ]);

       if ($validator->fails()) {
            return redirect('/home')
                    ->withInput()
                    ->withErrors($validator);
        }
        $category = new Category;
        $category->category = $request->categoryName;
        $category->creator_id = Auth::user()['id'];
        $category->save();
        return redirect()->action('PostController@index');
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
        Category::where('id', $id)->update([
                'category' => $request->category,
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
        //
        Post::where('categories_id', $id)->delete();
        Category::findOrFail($id)->delete();
        $categories = Category::where('creator_id', Auth::user()['id'])->get();
        //$posts = DB::table('posts')->where('categories_id', $cat_id)->get();

        /*return view('/home', [
         //   'posts' => $posts,
            'categories' => $categories,
         //   'cat_id' => $id,
            ]);*/
        return redirect()->action('PostController@index');
    }
}
