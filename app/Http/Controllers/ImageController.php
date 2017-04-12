<?php

namespace Blog\Http\Controllers;

use Blog\Http\Requests;
use Guzzle\Tests\Plugin\Redirect;
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
	public function store(Request $request){
		// Store records process
		//$image = new Image();
        $file = $request->file('img');
   		if($file) {
            //$request->hasFile('img')
              echo "There is an image";
//            $file = Input::file('image');
            //getting timestamp
            //$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
//            $name = $file->getClientOriginalName();
            //$name = $file->getClientOriginalName();
//            $file->move(public_path().'/images/', $name);
  //          $image->filePath = $name;
 //           $image->user_id = Auth::user()['id'];
        }
        else {
            echo "There is no such file";
        }
 //       $image->save();
   //     return $this->create();
         return 0;

   	}


}
