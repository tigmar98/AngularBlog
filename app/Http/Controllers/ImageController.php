<?php

namespace Blog\Http\Controllers;

use Blog\Http\Requests;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Blog\Contracts\ImageServiceInterface;

class ImageController extends Controller
{
    //

    	/**
	 * Show the form for uploading a new resource.
	 *
	 * @return Response
	 */
	public function upload(){
		// Redirect to image upload form
   	}

	/**
	 * Store a newly uploaded resource in storage.
	 *
	 * @return Response
	 */

  public function store(ImageServiceInterface $image_service, Request $request)
  {
    //$image = new Image();
    if($request->hasFile('image')) {
       $file = Input::file('image');

       $validator = Validator::make($request->all(), 
            [
                'image' =>'mimes:jpeg,jpg,png'
            ]);

       if ($validator->fails())
            {//   dd($validator);
                return redirect('/home')
                       ->withInput()
                       ->withErrors($validator);

            }

       $timestamp = time();
       $name =$timestamp.$file->getClientOriginalName();
       // dd($name);
       $image_service->createImage($name);
       $file->move(public_path().'/images/', $name);
    }
    //dd($request);;
    return redirect()->action('PostController@index');
  }


}
