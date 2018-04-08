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

Route::get('/mahasiswa/control','ManajerController@controlMahasiswa');
Route::get('/mahasiswa/control/{id}','ManajerController@detailControlMahasiswa');

Route::get('/dashboard', 'HomeController@index');
Route::get('/dashboard/mahasiswa', 'MahasiswaController@index');
Route::get('/dashboard/dosen', 'DosenController@index');
Route::get('/dashboard/manajer', 'ManajerController@index');

Route::post('/topik/pengajuan', 'TopicController@pengajuan');
Route::get('/topik/pengajuan', 'TopicController@showFormPengajuan');
Route::get('/topik/control','TopicController@showControlMahasiswa');
Route::get('/topik/get','TopicController@getTopik');
Route::post('/topik/approval', 'TopicController@approval')->name('topicapproval');

Route::post('/seminartopik/penetapan','SeminarTopikController@penetapanJadwal')->name('seminartopik-penetapan');
Route::post('/seminartopik/penilaian','SeminarTopikController@penilaian')->name('seminartopik-penilaian');

Route::get('/proposal/upload', 'ProposalController@showUploadForm');
Route::post('/proposal/upload','ProposalController@upload');
Route::get('/proposal/download/{id}/{filename}','ProposalController@download');
Route::post('/proposal/penerimaan','ProposalController@approval')->name('proposal-penerimaan');

Route::get('/dosen/listmahasiswa','DosenController@showMahasiswa');
Route::get('/hasilbimbingan','HasilBimbinganController@showListHasilBimbingan');
Route::get('/hasilbimbingan/tambah','HasilBimbinganController@showFormHasilBimbingan');
Route::post('/hasilbimbingan/tambah','HasilBimbinganController@uploadHasilBimbingan');
Route::get('/hasilbimbingan','HasilBimbinganController@showListPersetujuanBimbingan');
Route::post('/hasilbimbingan/persetujuan','HasilBimbinganController@persetujuan')->name('bimbingan-persetujuan');
