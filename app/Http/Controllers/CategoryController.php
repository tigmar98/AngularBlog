<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Category;
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

        $category = new Category;
        $category->category = $request->categoryName;
        $category->creator_id = Auth::user()['id'];
        $category->save();
        return redirect('/home');
    }
}
