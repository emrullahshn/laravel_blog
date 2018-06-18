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

Route::get('/', [
  'uses' => 'BlogController@index',
  'as' => 'blog'
]);


Route::get('/blog/{post}', [
  'uses' => 'BlogController@show',
  'as' => 'blog.show'
]);


Route::get('/category/{category}', [
  'uses' => 'BlogController@category',
  'as' => 'category'
]);


Route::get('/author/{author}', [
  'uses' => 'BlogController@author',
  'as' => 'author'
]);

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('/home', 'Backend\HomeController@index')->name('home');
Route::get('/edit-account', 'Backend\HomeController@edit')->name('edit.account');
Route::put('/edit-account', 'Backend\HomeController@update')->name('update.account');


Route::put('/blog/restore/{blog}', [
  'uses' => 'Backend\BlogController@restore',
  'as' => 'blog.restore'
]);
Route::delete('/blog/force-destroy/{blog}', [
  'uses' => 'Backend\BlogController@forceDestroy',
  'as' => 'blog.force-destroy'
]);
Route::resource('/backend/blog', 'Backend\BlogController', [
  'names' => [
    'index' => 'blog.index',
    'create' => 'blog.create',
    'edit' => 'blog.edit',
    'destroy' => 'blog.destroy'
  ]
]);

Route::resource('/backend/categories', 'Backend\CategoriesController', [
  'names' => [
    'index' => 'categories.index',
    'create' => 'categories.create',
    'edit' => 'categories.edit',
    'destroy' => 'categories.destroy'
  ]]);

Route::get('/backend/users/confirm/{users}',[
  'uses' => 'Backend\UsersController@confirm',
  'as' => 'backend.users.confirm'
]);
Route::resource('/backend/users', 'Backend\UsersController', [
  'names' => [
    'index' => 'users.index',
    'create' => 'users.create',
    'edit' => 'users.edit',
    'destroy' => 'users.destroy'
  ]]);