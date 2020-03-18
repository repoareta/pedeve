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
Route::post('login_user', 'AuthController@postlogin')->name('login_user.postlogin');
Route::get('/logout', 'AuthController@logout');


Route::group(['middleware'=> 'checkRole'], function () {
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
    Route::delete('uang_muka_kerja/delete/{no}', 'UangMukaKerjaController@delete')->name('uang_muka_kerja.delete');
    Route::delete('uang_muka_kerja/delete_detail/{id}/{no}', 'UangMukaKerjaController@deleteDetail')->name('uang_muka_kerja.delete.detail');
    Route::get('uang_muka_kerja/edit/{no}', 'UangMukaKerjaController@edit')->name('uang_muka_kerja.edit');
    Route::get('uang_muka_kerja/edit_detail/{id}/{no}', 'UangMukaKerjaController@edit_detail')->name('uang_muka_kerja.edit.detail');
    
    // Perjalanan Dinas
    Route::get('perjalanan_dinas', 'PerjalananDinasController@index')->name('perjalanan_dinas.index');
    Route::get('perjalanan_dinas/index_json', 'PerjalananDinasController@indexJson')->name('perjalanan_dinas.index.json');
    Route::get('perjalanan_dinas/create', 'PerjalananDinasController@create')->name('perjalanan_dinas.create');
    Route::post('perjalanan_dinas/store', 'PerjalananDinasController@store')->name('perjalanan_dinas.store');
    Route::post('perjalanan_dinas/store_detail', 'PerjalananDinasController@storeDetail')->name('perjalanan_dinas.store.detail');
    Route::get('perjalanan_dinas/edit', 'PerjalananDinasController@edit')->name('perjalanan_dinas.edit');
    Route::delete('perjalanan_dinas/delete', 'PerjalananDinasController@delete')->name('perjalanan_dinas.delete');

    // Permintaan Bayar
    Route::get('permintaan_bayar', 'PermintaanBayarController@index')->name('permintaan_bayar.index');
    Route::get('permintaan_bayar/index_json', 'PermintaanBayarController@indexJson')->name('permintaan_bayar.index.json');
    Route::get('permintaan_bayar/create', 'PermintaanBayarController@create')->name('permintaan_bayar.create');
    Route::get('permintaan_bayar/edit', 'PermintaanBayarController@edit')->name('permintaan_bayar.edit');
    Route::delete('permintaan_bayar/delete', 'PermintaanBayarController@delete')->name('permintaan_bayar.delete');
    
    // Anggaran
    Route::get('anggaran', 'AnggaranController@index')->name('anggaran.index');
    
    // Report UMUM
    Route::get('report', 'ReportController@index')->name('report.index');
});

//SDM & Payroll
Route::prefix('sdm')->group(function () {
    // Tabel data Master
    Route::get('tabel_data_master', 'TabelDataMasterController@index')->name('tabel_data_master.index');
    Route::get('tabel_data_master/create', 'TabelDataMasterController@create')->name('tabel_data_master.create');
    Route::get('tabel_data_master/edit', 'TabelDataMasterController@edit')->name('tabel_data_master.edit');
    // master pekerja
    Route::get('master_pekerja', 'MasterPekerjaController@index')->name('master_pekerja.index');
    Route::get('master_pekerja/create', 'MasterPekerjaController@create')->name('master_pekerja.create');
    Route::get('master_pekerja/edit', 'MasterPekerjaController@edit')->name('master_pekerja.edit');
    //potongan koreksi gaji
    Route::get('potongan_koreksi_gaji', 'PotonganKoreksiGajiController@index')->name('potongan_koreksi_gaji.index');
    Route::get('potongan_koreksi_gaji/create', 'PotonganKoreksiGajiController@create')->name('potongan_koreksi_gaji.create');
    Route::get('potongan_koreksi_gaji/edit', 'PotonganKoreksiGajiController@edit')->name('potongan_koreksi_gaji.edit');
    // Lembur
    Route::get('lembur', 'LemburController@index')->name('lembur.index');
    Route::get('lembur/create', 'LemburController@create')->name('lembur.create');
    Route::get('lembur/edit', 'LemburController@edit')->name('lembur.edit');
    //pinjaman pekerja
    Route::get('pinjaman_pekerja', 'PinjamanPekerjaController@index')->name('pinjaman_pekerja.index');
    Route::get('pinjaman_pekerja/create', 'PinjamanPekerjaController@create')->name('pinjaman_pekerja.create');
    Route::get('pinjaman_pekerja/edit', 'PinjamanPekerjaController@edit')->name('pinjaman_pekerja.edit');
    //proses gaji
    Route::get('proses_gaji', 'ProsesGajiController@index')->name('proses_gaji.index');
    Route::get('proses_gaji/create', 'ProsesGajiController@create')->name('proses_gaji.create');
    Route::get('proses_gaji/edit', 'ProsesGajiController@edit')->name('proses_gaji.edit');
    //proses thr
    Route::get('proses_thr', 'ProsesThrController@index')->name('proses_thr.index');
    Route::get('proses_thr/create', 'ProsesThrController@create')->name('proses_thr.create');
    Route::get('proses_thr/edit', 'ProsesThrController@edit')->name('proses_thr.edit');
    //proses insentif
    Route::get('proses_insentif', 'ProsesInsentifController@index')->name('proses_insentif.index');
    Route::get('proses_insentif/create', 'ProsesInsentifController@create')->name('proses_insentif.create');
    Route::get('proses_insentif/edit', 'ProsesInsentifController@edit')->name('proses_insentif.edit');
    //proses report sdm payroll
    Route::get('report_sdm_payroll', 'ReportSdmPayrollController@index')->name('report_sdm_payroll.index');
    Route::get('report_sdm_payroll/create', 'ReportSdmPayrollController@create')->name('report_sdm_payroll.create');
    Route::get('report_sdm_payroll/edit', 'ReportSdmPayrollController@edit')->name('report_sdm_payroll.edit');
    //absensi karyawan
    Route::get('absensi_karyawan', 'AbsensiKaryawanController@index')->name('absensi_karyawan.index');
    Route::get('absensi_karyawan/create', 'AbsensiKaryawanController@create')->name('absensi_karyawan.create');
    Route::get('absensi_karyawan/edit', 'AbsensiKaryawanController@edit')->name('absensi_karyawan.edit');
    //absensi karyawan
    Route::get('implementasi_gcg', 'ImplementasiGcgController@index')->name('implementasi_gcg.index');
    Route::get('implementasi_gcg/create', 'ImplementasiGcgController@create')->name('implementasi_gcg.create');
    Route::get('implementasi_gcg/edit', 'ImplementasiGcgController@edit')->name('implementasi_gcg.edit');
});
