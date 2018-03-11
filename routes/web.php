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

Route::get('/', 'HomeController@index');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('register','Auth\RegisterController@showForm')->name('register');
Route::post('register','Auth\RegisterController@registerUser')->name('registerPost');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/generate/admin', 'Auth\RegisterController@generateAdmin');

Route::get('/dashboard', 'HomeController@index');
Route::get('/dashboard/mahasiswa', 'MahasiswaController@index');
Route::get('/dashboard/dosen', 'DosenController@index');
Route::get('/dashboard/manajer', 'ManajerController@index');