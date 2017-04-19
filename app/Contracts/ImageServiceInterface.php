<?php

namespace Blog\Contracts;

Interface ImageServiceInterface
{
	public function createImage($file_path);
	public function checkUserImage();
	public function getUserImage();
}