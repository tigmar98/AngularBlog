<?php

namespace Blog\Services;

use Blog\Contracts\ImageServiceInterface;
use Blog\Image;
use Illuminate\Support\Facades\Auth;

class ImageService implements ImageServiceInterface
{
	public function __construct(){
		$this->image = new Image;
	}
	public function createImage($file_path){
		return $this->image->create([
				'file_path' => $file_path,
				'user_id' => Auth::user()['id'],
			]);
	}
	public function checkUserImage(){
		return $this->image->where('user_id', Auth::user()['id'])->exists();
	}
	public function getUserImage(){
		return $this->image->where('user_id', Auth::user()['id'])->orderBy('id', 'desc')->pluck('file_path')[0];
	}
}