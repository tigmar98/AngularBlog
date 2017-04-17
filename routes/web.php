<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::resource('home', 'PostController');
//Route::post('/category', 'CategoryController@store');
Route::resource('category', 'CategoryController');
Route::get('/postedit/{id}', 'PostController@update');
Route::get('/categoryedit/{id}', 'CategoryController@update');
Route::resource('posts', 'AllPostsController');
Route::put('/imageupload', 'ImageController@store');
Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');
