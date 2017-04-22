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
    public function create(Request $request)
    {
        //
        $request->session()->flash('previousCategoryCreateUrl', $request->session()-> all()['_previous']['url']);
        return view('createCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryServiceInterface $categoryService, Request $request)
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
        
        $categoryService->newCategory($request->categoryName);
        return redirect($request->session()->all()['previousCategoryCreateUrl']);
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
    public function edit(CategoryServiceInterface $categoryService,Request $request, $id)
    {
        //
        $request->session()->flash('previousCategoryEditUrl', $request->session()-> all()['_previous']['url']);
        return view('editCategory')->with('category', $categoryService->getCategory($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryServiceInterface $categoryService, Request $request, $id)
    {
        //Update choosen category
        $categoryService->updateCategory($id, $request->category);
        return redirect($request->session()->all()['previousCategoryEditUrl']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryServiceInterface $categoryService, $id)
    {
        //Remove choosen category
        $categoryService->deleteCategory($id);
        return redirect()->back();
    }

}
