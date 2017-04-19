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
	public function storeImage(UserServiceInterface $user_service, Request $request)
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
	       $user_service->storeImage($name);
	       $file->move(public_path().'/images/', $name);
    	}
    	return redirect()->action('PostController@index');
  	}
}
