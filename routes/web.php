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
Route::get('admin/panel', 'UserController@index');
Route::get('user/control/{uname}', 'UserController@show');
Route::post('user/control/{uname}', 'UserController@save');
Route::post('addrole/dosen/{uname}', 'UserController@addDosenRole');
Route::post('addrole/mahasiswa/{uname}', 'UserController@addMahasiswaRole');
Route::post('addrole/manajer/{uname}', 'UserController@addManajerRole');
Route::post('dosen/edit/{id}', 'DosenController@edit');
Route::post('mahasiswa/edit/{id}', 'MahasiswaController@edit');


Route::get('register','Auth\RegisterController@showForm')->name('register');
Route::post('register','Auth\RegisterController@registerHandler')->name('registerPost');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/generate/admin', 'Auth\RegisterController@generateAdmin');

Route::get('/mahasiswa/control','ManajerController@controlMahasiswa');
Route::get('/mahasiswa/control/{id}','ManajerController@detailControlMahasiswa');
Route::get('/mahasiswa/rekap','RekapDataController@showRekapMahasiswa');
Route::get('/mahasiswa/nilaiakhir','RekapDataController@showRekapNilaiAkhir');
Route::get('/mahasiswa/history','RekapDataController@showHistoryMahasiswa');

Route::get('/kelastesis','KelasTesisController@showKelasTesis');
Route::post('/kelastesis/tambah','KelasTesisController@tambahKelasTesis');

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

// Route::get('/dashboard/dosen','DosenController@showMahasiswa');
Route::get('/hasilbimbingan/mahasiswa','HasilBimbinganController@showListHasilBimbingan');
Route::post('/hasilbimbingan/mahasiswa','HasilBimbinganController@getBimbinganID');
Route::get('/hasilbimbingan/tambah','HasilBimbinganController@showFormTambahHasilBimbingan');
Route::post('/hasilbimbingan/tambah','HasilBimbinganController@uploadHasilBimbinganBaru');
Route::get('/hasilbimbingan/edit','HasilBimbinganController@showFormEditHasilBimbingan');
Route::post('/hasilbimbingan/edit','HasilBimbinganController@editHasilBimbingan');
Route::get('/hasilbimbingan','HasilBimbinganController@showListPersetujuanBimbingan');
Route::post('/hasilbimbingan/persetujuan','HasilBimbinganController@persetujuan')->name('bimbingan-persetujuan');

Route::post('/mahasiswa/dosbing/penetapan', 'ThesisController@handlePenetapanDosbing')->name('dosbing-penetapan');
Route::post('/seminarproposal/penetapan', 'SeminarProposalController@scheduleEstablishment')->name('seminarproposal-penetapan');
Route::post('/seminarproposal/penilaian', 'SeminarProposalController@score')->name('seminarproposal-penilaian');
Route::get('/dosen/mahasiswa-control/{id}','DosenController@detailMahasiswa')->name('dosen-detailmahasiswa');

Route::get('/seminartesis/create/{id}', 'SeminarTesisController@requestPenjadwalan')->name('seminartesis-create');
Route::post('/seminartesis/create/{id}', 'SeminarTesisController@createRequestPenjadwalan');
Route::post('/seminartesis/edit/{id}', 'SeminarTesisController@editPenjadwalan');
Route::post('/seminartesis/nilai/{id}', 'SeminarTesisController@nilaiSeminarTesis');

Route::get('/sidangtesis/daftar','SidangTesisController@showFormDaftarSidang');
Route::get('/sidangtesis/create/{id}','SidangTesisController@create');
Route::get('/sidangtesis/createUlang/{id}','SidangTesisController@createUlang');
Route::post('/sidangtesis/dosen/edit/{id}','SidangTesisController@dosenEdit');
Route::post('/sidangtesis/nilai/{id}','SidangTesisController@nilaiSidangTesis');

Route::get('/penjadwalan','PenjadwalanController@showPenjadwalanPage');
Route::post('/penjadwalan/seminartopik','PenjadwalanController@penentuanJadwalSeminarTopikBatch');
Route::post('/penjadwalan/seminarproposal','PenjadwalanController@penentuanJadwalSeminarProposalBatch');
Route::post('/penjadwalan/seminartesis','PenjadwalanController@penentuanJadwalSeminarTesisBatch');
Route::post('/penjadwalan/sidangtesis','PenjadwalanController@penentuanJadwalSidangTesisBatch');

Route::post('/sidangtesis/mahasiswa/edit/{id}', 'SidangTesisController@mahasiswaEdit');
Route::post('/sidangtesis/manajer/edit/{id}', 'SidangTesisController@manajerEdit');
Route::get('/sidangtesis/download/{id}/{filename}', 'SidangTesisController@downloadFile');

Route::post('/sidangtesis/nilai/penguji1/reset/{id}', 'SidangTesisController@resetNilaiPenguji1');
Route::post('/sidangtesis/nilai/penguji2/reset/{id}', 'SidangTesisController@resetNilaiPenguji2');
Route::post('/sidangtesis/nilai/pembimbing/reset/{id}', 'SidangTesisController@resetNilaiPembimbing');
Route::post('/sidangtesis/nilai/kelas/reset/{id}', 'SidangTesisController@resetNilaiKelas');
Route::post('/sidangtesis/dosenuji/approve/{id}', 'SidangTesisController@dosenPengujiApprove');


Route::get('/test', 'TestController@test');