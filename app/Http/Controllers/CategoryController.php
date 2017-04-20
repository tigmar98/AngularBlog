<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Blog\Contracts\CategoryServiceInterface;

class CategoryController extends Controller
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
    public function store(CategoryServiceInterface $category_service, Request $request)
    {
        //Add new category
        $validator = Validator::make($request->all(), 
            [
                'categoryName' => 'required|max:255',
            ]);

       if ($validator->fails()){
            return redirect('/home')
                    ->withInput()
                    ->withErrors($validator);
        }
        
        $category_service->newCategory($request->categoryName);
        return redirect('/');
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
    public function edit(CategoryServiceInterface $category_service, $id)
    {
        //
        return view('editcategory')->with('category', $category_service->getCategory($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryServiceInterface $category_service, Request $request, $id)
    {
        //Update choosen category
        $category_service->updateCategory($id, $request->category);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryServiceInterface $category_service, $id)
    {
        //Remove choosen category
        $category_service->deleteCategory($id);
        return redirect()->back();
    }
}
