<?php

namespace Blog\Services;

use Blog\Contracts\UserServiceInterface;
use Blog\User;

class UserService implements UserServiceInterface
{
	public function __construct(){
		$this->user = new User;
	}

	/*public function userCreate($name, $email, $password){
		return $this->user->create([
				'name' => $name,
				'email' => $email,
				'password' => bcrypt($password),
			]);
	}*/
	public function getUserId($email){
		return $this->user->where('email', $email)->pluck('id')[0];
	}
	public function getUserName($creator_id){
		return $this->user->where('id', $creator_id)->pluck('name')[0];
	}
}
