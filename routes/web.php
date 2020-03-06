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

Route::get('/', 'UmumUmkController@index');
Route::get('/umum/perjalanan_dinas', 'UmumUmkController@indexPerjalananDinas')->name('umum.perjalanan_dinas.index');
