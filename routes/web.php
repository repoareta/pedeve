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

// UMK
// Route::get('/', 'UmumUmkController@index');

// Modul UMUM
Route::prefix('umum')->group(function () {
    // Matches The "/umum/perjalanan_dinas" URL
    // Route assigned name "umum.perjalanan_dinas"...
    // Perjalanan Dinas
    Route::get('perjalanan_dinas', 'PerjalananDinasController@index')->name('perjalanan_dinas.index');
    Route::get('perjalanan_dinas/create', 'PerjalananDinasController@create')->name('perjalanan_dinas.create');
    Route::get('perjalanan_dinas/edit', 'PerjalananDinasController@edit')->name('perjalanan_dinas.edit');

    // UMK
    Route::get('umk', 'UmkController@index')->name('umk.index');

    // Permintaan Bayar
    Route::get('permintaan_bayar', 'PermintaanBayarController@index')->name('permintaan_bayar.index');
    
    // Anggaran
    Route::get('anggaran', 'AnggaranController@index')->name('anggaran.index');
    
    // Report UMUM
    Route::get('report', 'ReportController@index')->name('report.index');
});
