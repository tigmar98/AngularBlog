<?php

namespace Blog\Http\Controllers;

use Blog\Http\Requests;
use Blog\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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

  public function store(Request $request)
  {
    $image = new Image();
    if($request->hasFile('image')) {
       $file = Input::file('image');
       $timestamp = time();
       $name =$timestamp.$file->getClientOriginalName();
       // dd($name);
       $image->file_path = $name;
       $image->user_id = Auth::user()['id'];
       $file->move(public_path().'/images/', $name);
    }
    //dd($request);
    // return $this->create();
    $image->save();
    return redirect()->action('PostController@index');
  }


}
