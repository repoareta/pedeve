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
    Route::get('uang_muka_kerja', 'UangMukaKerjaController@index')->name('uang_muka_kerja.index');
    Route::get('uang_muka_kerja/index_json', 'UangMukaKerjaController@indexJson')->name('uang_muka_kerja.index.json');
    Route::get('uang_muka_kerja/create', 'UangMukaKerjaController@create')->name('uang_muka_kerja.create');
    Route::post('uang_muka_kerja/store', 'UangMukaKerjaController@store')->name('uang_muka_kerja.store');
    Route::post('uang_muka_kerja/store_detail', 'UangMukaKerjaController@storeDetail')->name('uang_muka_kerja.store.detail');
    Route::get('uang_muka_kerja/delete/{no}', 'UangMukaKerjaController@delete')->name('uang_muka_kerja.delete');
    Route::get('uang_muka_kerja/delete_detail/{no}/{id}', 'UangMukaKerjaController@deleteDetail')->name('uang_muka_kerja.delete.detail');
    Route::get('uang_muka_kerja/detail/{no}', 'UangMukaKerjaController@detail')->name('uang_muka_kerja.detail');
    Route::get('uang_muka_kerja/edit/{no}/{id}', 'UangMukaKerjaController@edit')->name('uang_muka_kerja.edit');
    
    // Perjalanan Dinas
    Route::get('perjalanan_dinas', 'PerjalananDinasController@index')->name('perjalanan_dinas.index');
    Route::get('perjalanan_dinas/create', 'PerjalananDinasController@create')->name('perjalanan_dinas.create');
    Route::get('perjalanan_dinas/edit', 'PerjalananDinasController@edit')->name('perjalanan_dinas.edit');


    // Permintaan Bayar
    Route::get('permintaan_bayar', 'PermintaanBayarController@index')->name('permintaan_bayar.index');
    Route::get('permintaan_bayar/create', 'PermintaanBayarController@create')->name('permintaan_bayar.create');
    
    // Anggaran
    Route::get('anggaran', 'AnggaranController@index')->name('anggaran.index');
    
    // Report UMUM
    Route::get('report', 'ReportController@index')->name('report.index');
});
