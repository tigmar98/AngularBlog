<?php

namespace Blog\Services;

use Blog\Contracts\UserServiceInterface;
use Blog\User;
use Auth;

class UserService implements UserServiceInterface
{
	public function __construct(User $user){
		$this->user = $user;
	}

	public function getUserId($email){
		return $this->user->where('email', $email)->pluck('id')->first();
	}

	public function getUserName($creatorId){
		return $this->user->where('id', $creatorId)->pluck('name')->first();
	}

	public function storeImage($image){
		return $this->user->where('id', Auth::user()['id'])->update([
				'image' => $image,
			]);
	}

	public function getUserImage(){
		if(!empty($this->user->where('id', Auth::user()['id'])->pluck('image')->first())){
			$imagePath = "/images/".$this->user->where('id', Auth::user()['id'])->pluck('image')->first();
			if(!file_exists(public_path().$imagePath)){
            	$imagePath = "/images/default-user-image.png";
            	}
            } elseif($this->user->where('id', Auth::user()['id'])->first()->social->exists()){
            	$imagePath = $this->user->where('id', Auth::user()['id'])->first()->social->pluck('imagePath')->first();
            } else {
            	$imagePath = "/images/default-user-image.png";
            }
        return $imagePath;
		//return $this->user->where('id', Auth::user()['id'])->pluck('image')->first();
	}

	public function checkUserImage(){
		if(empty($this->user->where('id', Auth::user()['id'])->pluck('image')->first()))
			return false;			
		return true;
	}
}
