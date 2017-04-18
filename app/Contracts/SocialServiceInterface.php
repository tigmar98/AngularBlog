<?php

namespace Blog\Contracts;

Interface SocialServiceInterface
{
	public function createSocial($name, $email, $token, $user_id, $image_path);
	public function emailExists($email);
	public function userExists();
	public function getImage();

}