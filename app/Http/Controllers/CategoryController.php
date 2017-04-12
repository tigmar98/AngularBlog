<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Blog\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // 
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'categoryName' => 'required|max:255',
        ]);

       if ($validator->fails()) {
            return redirect('/home')
                    ->withInput()
                    ->withErrors($validator);
            }

        $category = new Categorie;
        $category->category = $request->categoryName;
        $category->creator_id = Auth::user()['id'];
        $category->save();
        return redirect('/home');
    }

    public function destroy($id)
    {
        //     
        Categorie::findOrFail($id)->delete();

        $categories = DB::table('categories')->where('creator_id', Auth::user()['id'])->get();
        //$posts = DB::table('posts')->where('categories_id', $cat_id)->get();

        return view('/home', [
         //   'posts' => $posts,
            'categories' => $categories,
         //   'cat_id' => $id,
            ]);
    }

}
