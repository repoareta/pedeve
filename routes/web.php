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
// LOGIN FORM
Route::view('/', 'login');
Route::get('/login','AuthController@login')->name('login');
Route::post('postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');
// UMK
// Route::get('/', 'UmumUmkController@index');

// Perjalanan Dinas
Route::group(['middleware'=>['auth','checkRole:admin']],function(){

Route::prefix('umum')->group(function () {
    // Matches The "/umum/perjalanan_dinas" URL
    // Route assigned name "admin.users"...
    Route::get('perjalanan_dinas', 'PerjalananDinasController@index')->name('perjalanan_dinas.index');
    Route::get('perjalanan_dinas/create', 'PerjalananDinasController@create')->name('perjalanan_dinas.create');
    Route::get('perjalanan_dinas/edit', 'PerjalananDinasController@edit')->name('perjalanan_dinas.edit');
});

Route::get('/admindetail','AuthController@detail');
Route::get('/dashboard','AuthController@index');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
