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

Route::get('/home', 'HomeController@index')->name('home');

// LOGIN FORM
Route::view('/', 'login');
Route::get('/login', 'AuthController@login')->name('login');
Route::post('postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

// UMK
// Route::get('/', 'UmumUmkController@index');

// Perjalanan Dinas

Route::group(['middleware'=>['auth','checkRole:admin']], function () {
});

// Perjalanan Dinas
Route::prefix('umum')->group(function () {
    // Matches The "/umum/perjalanan_dinas" URL
    // Route assigned name "umum.perjalanan_dinas"...
    
    // UMK
    Route::get('uang_muka_kerja', 'UangMukaKerjaController@tampil')->name('uang_muka_kerja.tampil');
    Route::resource('uang_muka_kerja_json', 'UangMukaKerjaController');
    Route::get('uang_muka_kerja/create', 'UangMukaKerjaController@create')->name('uang_muka_kerja.create');
    Route::post('uang_muka_kerja/addumk', 'UangMukaKerjaController@addumk')->name('uang_muka_kerja.addumk');
    Route::post('uang_muka_kerja/addumkdetail', 'UangMukaKerjaController@addumkdetail')->name('uang_muka_kerja.addumkdetail');
    Route::get('uang_muka_kerja/deleteumk/{noumk}', 'UangMukaKerjaController@deleteumk')->name('uang_muka_kerja.deleteumk');
    Route::get('uang_muka_kerja/detailumk/{noumk}', 'UangMukaKerjaController@detailumk')->name('uang_muka_kerja.detailumk');
    
    // Perjalanan Dinas
    Route::get('perjalanan_dinas', 'PerjalananDinasController@index')->name('perjalanan_dinas.index');
    Route::get('perjalanan_dinas/create', 'PerjalananDinasController@create')->name('perjalanan_dinas.create');
    Route::get('perjalanan_dinas/edit', 'PerjalananDinasController@edit')->name('perjalanan_dinas.edit');


    // Permintaan Bayar
    Route::get('permintaan_bayar', 'PermintaanBayarController@index')->name('permintaan_bayar.index');
    
    // Anggaran
    Route::get('anggaran', 'AnggaranController@index')->name('anggaran.index');
    
    // Report UMUM
    Route::get('report', 'ReportController@index')->name('report.index');
});
