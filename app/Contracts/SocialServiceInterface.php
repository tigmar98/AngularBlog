<?php

namespace Blog\Contracts;

Interface SocialServiceInterface
{
	public function createSocial($name, $email, $token, $userId, $imagePath);
	public function emailExists($email);
	/*public function userExists();
	public function getImage();*/

}