<?php

namespace Blog\Contracts;

Interface UserServiceInterface
{
	/*public function userCreate($name, $email, $password);*/
	public function getUserId($email);
	public function getUserName($creatorId);
	public function storeImage($image);
	public function getUserImage();
	public function checkUserImage();
}