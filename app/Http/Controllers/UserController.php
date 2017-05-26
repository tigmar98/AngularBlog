<?php

namespace Blog\Http\Controllers;

use Blog\Http\Requests;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Blog\Contracts\UserServiceInterface;


class UserController extends Controller
{
    //
	/*public function showImageUploadForm(Request $request){
		$request->session()->flash('previousImageUploadUrl', $request->session()-> all()['_previous']['url']);
		return view('imageUpload');
	}

	public function storeImage(UserServiceInterface $userService, Request $request)
  	{
    	if($request->hasFile('image')){
       		$file = Input::file('image');

		       $validator = Validator::make($request->all(), 
		            [
		                'image' =>'mimes:jpeg,jpg,png'
		            ]);

	       if ($validator->fails()){
              return redirect('/home')->withInput()->withErrors($validator);
            }

	       $timestamp = time();
	       $name =$timestamp.$file->getClientOriginalName();
	       $file->move(public_path().'/images/', $name);
	       $userService->storeImage($name);
    	}
    	
    	return redirect($request->session()->all()['previousImageUploadUrl']);
  	}*/

  	public function getImage(UserServiceInterface $userService){
  		$imagePath = $userService->getUserImage();
  		return response()->json(['src' => $imagePath]);
  	}

  	public function store(UserServiceInterface $userService ,Request $request){
  		if($request->hasFile('image')){
       		$file = $request->image;

		    $validator = Validator::make($request->all(), 
		    [
		        'image' =>'mimes:jpeg,jpg,png'
		    ]);
		$timestamp = time();
	    $name =$timestamp.$file->getClientOriginalName();
	    $file->move(public_path().'/images/', $name);
	    $userService->storeImage($name);
	    return response()->json(['msg' => 'Your image has been successfully updated']);
  		}
	}
}
