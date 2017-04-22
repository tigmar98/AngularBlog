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

	public function createSocial($name, $email, $token, $userId, $imagePath){
		return $this->social->create([
				'name' => $name,
				'email' => $email,
				'token' => $token,
				'userId' => $userId,
				'imagePath' => $imagePath,
			]);
	}

	public function emailExists($email){
		return $this->social->where('email', $email)->exists();
	}

	/*public function userExists(){
		return $this->social->where('userId', Auth::user()['id'])->exists();
	}*/
	
	/*public function getImage(){
		return $this->social->where('userId', Auth::user()['id'])->pluck('imagePath')->first();
	}*/

}