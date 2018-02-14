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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/dashboard', 'DashboardController@home')->name('dashboard.home');

Route::get('/profile', 'UserController@profile')->name('user.profile');

Route::post('/profile/image', 'UserController@uploadProfilePicture')->name('profile.picture.upload');
