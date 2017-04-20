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

	public function getUserName($creator_id){
		return $this->user->where('id', $creator_id)->pluck('name')->first();
	}

	public function storeImage($image){
		return $this->user->where('id', Auth::user()['id'])->update([
				'image' => $image,
			]);
	}

	public function getUserImage(){
		return $this->user->where('id', Auth::user()['id'])->pluck('image')->first();
	}

	public function checkUserImage(){
		if(empty($this->user->where('id', Auth::user()['id'])->pluck('image')->first()))
			return false;			
		return true;
	}
}
