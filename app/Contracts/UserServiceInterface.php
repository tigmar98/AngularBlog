<?php

namespace Blog\Contracts;

Interface UserServiceInterface
{
	/*public function userCreate($name, $email, $password);*/
	public function getUserId($email);
	public function getUserName($creator_id);
}