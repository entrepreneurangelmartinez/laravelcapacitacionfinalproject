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

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/admin', function() {
    //
    return view('admin.index');
});


Route::group(['middleware'=> 'admin'], function()
{
    Route::resource('admin/users', 'AdminUsersController');
});
// Route::resource('admin/users', 'UserController');
// Route::resource('admin/users', 'AdminUsersController');
