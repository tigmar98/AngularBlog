<?php

namespace Blog\Services;

use Blog\Contracts\SocialServiceInterface;
use Illuminate\Support\Facades\Auth;
use Blog\Social;

class SocialService implements SocialServiceInterface
{
	public function __construct(Social $social){
		$this->social = $social;

	}
	public function createSocial($name, $email, $token, $user_id, $image_path){
		return $this->social->create([
				'name' => $name,
				'email' => $email,
				'token' => $token,
				'user_id' => $user_id,
				'image_path' => $image_path,
			]);
	}
	public function emailExists($email){
		return $this->social->where('email', $email)->exists();
	}
	public function userExists(){
		return $this->social->where('user_id', Auth::user()['id'])->exists();
	}
	public function getImage(){
		return $this->social->where('user_id', Auth::user()['id'])->pluck('image_path')[0];
	}

}