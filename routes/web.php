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
Route::get('/', 'AuthController@login')->name('login');
Route::get('/login', 'AuthController@login')->name('login');
Route::post('login_user', 'AuthController@postlogin')->name('login_user.postlogin');
Route::get('/logout', 'AuthController@logout')->name('logout.index');

//MODUL UMUM
Route::group(['middleware'=> ['auth','checkRole:1']], function () {
    Route::prefix('umum')->group(function () {

        // UMK
        Route::get('uang_muka_kerja', 'UangMukaKerjaController@index')->name('uang_muka_kerja.index');
        Route::get('uang_muka_kerja/index_json', 'UangMukaKerjaController@indexJson')->name('uang_muka_kerja.index.json');
        Route::get('uang_muka_kerja/create', 'UangMukaKerjaController@create')->name('uang_muka_kerja.create');
        Route::post('uang_muka_kerja/store', 'UangMukaKerjaController@store')->name('uang_muka_kerja.store');
        Route::post('uang_muka_kerja/store_detail', 'UangMukaKerjaController@storeDetail')->name('uang_muka_kerja.store.detail');
        Route::post('uang_muka_kerja/store_app', 'UangMukaKerjaController@storeApp')->name('uang_muka_kerja.store.app');
        Route::delete('uang_muka_kerja/delete', 'UangMukaKerjaController@delete')->name('uang_muka_kerja.delete');
        Route::delete('uang_muka_kerja/delete_detail', 'UangMukaKerjaController@deleteDetail')->name('uang_muka_kerja.delete.detail');
        Route::get('uang_muka_kerja/edit/{no}', 'UangMukaKerjaController@edit')->name('uang_muka_kerja.edit');
        Route::get('uang_muka_kerja/edit_detail/{id}/{no}', 'UangMukaKerjaController@edit_detail')->name('uang_muka_kerja.edit.detail');
        Route::get('uang_muka_kerja/approv/{id}', 'UangMukaKerjaController@approv')->name('uang_muka_kerja.approv');
        Route::get('uang_muka_kerja/rekap/{id}', 'UangMukaKerjaController@rekap')->name('uang_muka_kerja.rekap');
        Route::get('uang_muka_kerja/rekaprange', 'UangMukaKerjaController@rekapRange')->name('uang_muka_kerja.rekap.range');
        Route::post('uang_muka_kerja/rekap/export', 'UangMukaKerjaController@rekapExport')->name('uang_muka_kerja.rekap.export');
        Route::post('uang_muka_kerja/rekap/export/range', 'UangMukaKerjaController@rekapExportRange')->name('uang_muka_kerja.rekap.export.range');

        

        // P UANG MUKA KERJA START
        Route::get('uang_muka_kerja/pertanggungjawaban', 'UangMukaKerjaPertanggungJawabanController@index')->name('uang_muka_kerja.pertanggungjawaban.index');
        Route::get('uang_muka_kerja/pertanggungjawaban/index_json', 'UangMukaKerjaPertanggungJawabanController@indexJson')->name('uang_muka_kerja.pertanggungjawaban.index.json');

        Route::get('uang_muka_kerja/pertanggungjawaban/create', 'UangMukaKerjaPertanggungJawabanController@create')->name('uang_muka_kerja.pertanggungjawaban.create');
        Route::post('uang_muka_kerja/pertanggungjawaban/store', 'UangMukaKerjaPertanggungJawabanController@store')->name('uang_muka_kerja.pertanggungjawaban.store');

        Route::get('uang_muka_kerja/pertanggungjawaban/approval/{no_pumk}', 'UangMukaKerjaPertanggungJawabanController@approv')->name('uang_muka_kerja.pertanggungjawaban.approval');
        Route::delete('uang_muka_kerja/pertanggungjawaban/delete', 'UangMukaKerjaPertanggungJawabanController@delete')->name('uang_muka_kerja.pertanggungjawaban.delete');
        // P UANG MUKA KERJA END
        
        // PERJALANAN DINAS START
        Route::get('perjalanan_dinas', 'PerjalananDinasController@index')->name('perjalanan_dinas.index');
        Route::get('perjalanan_dinas/index_json', 'PerjalananDinasController@indexJson')->name('perjalanan_dinas.index.json');
        Route::get('perjalanan_dinas/index_json_detail/{no_panjar}', 'PerjalananDinasController@indexJsonDetail')->name('perjalanan_dinas.index.json.detail');
        Route::get('perjalanan_dinas/create', 'PerjalananDinasController@create')->name('perjalanan_dinas.create');
        Route::post('perjalanan_dinas/store', 'PerjalananDinasController@store')->name('perjalanan_dinas.store');
        Route::post('perjalanan_dinas/store_detail', 'PerjalananDinasController@storeDetail')->name('perjalanan_dinas.store.detail');
        Route::get('perjalanan_dinas/edit/{no_panjar}', 'PerjalananDinasController@edit')->name('perjalanan_dinas.edit');
        Route::post('perjalanan_dinas/update/{no_panjar}', 'PerjalananDinasController@update')->name('perjalanan_dinas.update');
        Route::post('perjalanan_dinas/update_detail', 'PerjalananDinasController@updateDetail')->name('perjalanan_dinas.update.detail');
        Route::get('perjalanan_dinas/show_json_detail', 'PerjalananDinasController@showJsonDetail')->name('perjalanan_dinas.show.json.detail');
        Route::delete('perjalanan_dinas/delete', 'PerjalananDinasController@delete')->name('perjalanan_dinas.delete');
        Route::delete('perjalanan_dinas/delete_detail', 'PerjalananDinasController@deleteDetail')->name('perjalanan_dinas.delete.detail');
        Route::get('perjalanan_dinas/rekap', 'PerjalananDinasController@rekap')->name('perjalanan_dinas.rekap');
        Route::post('perjalanan_dinas/rekap/export', 'PerjalananDinasController@rekapExport')->name('perjalanan_dinas.rekap.export');

        Route::get('perjalanan_dinas/export/{no_panjar}', 'PerjalananDinasController@rowExport')->name('perjalanan_dinas.export');
        // PERJALANAN DINAS END

        // P PERJALANAN DINAS START
        Route::get('perjalanan_dinas/pertanggungjawaban', 'PerjalananDinasPertanggungJawabanController@index')->name('perjalanan_dinas.pertanggungjawaban.index');
        Route::get('perjalanan_dinas/pertanggungjawaban/index_json', 'PerjalananDinasPertanggungJawabanController@indexJson')->name('perjalanan_dinas.pertanggungjawaban.index.json');

        Route::get('perjalanan_dinas/pertanggungjawaban/create', 'PerjalananDinasPertanggungJawabanController@create')->name('perjalanan_dinas.pertanggungjawaban.create');
        Route::post('perjalanan_dinas/pertanggungjawaban/store', 'PerjalananDinasPertanggungJawabanController@store')->name('perjalanan_dinas.pertanggungjawaban.store');

        Route::get('perjalanan_dinas/pertanggungjawaban/edit/{no_ppanjar}', 'PerjalananDinasPertanggungJawabanController@edit')->name('perjalanan_dinas.pertanggungjawaban.edit');
        Route::post('perjalanan_dinas/pertanggungjawaban/update/{no_ppanjar}', 'PerjalananDinasPertanggungJawabanController@update')->name('perjalanan_dinas.pertanggungjawaban.update');

        Route::delete('perjalanan_dinas/pertanggungjawaban/delete', 'PerjalananDinasPertanggungJawabanController@delete')->name('perjalanan_dinas.pertanggungjawaban.delete');
        // P PERJALANAN DINAS END

        // P PERJALANAN DINAS DETAIL START
        Route::get('perjalanan_dinas/pertanggungjawaban/detail/index_json', 'PerjalananDinasPertanggungJawabanDetailController@indexJson')->name('perjalanan_dinas.pertanggungjawaban.detail.index.json');

        Route::get('perjalanan_dinas/pertanggungjawaban/detail/show', 'PerjalananDinasPertanggungJawabanDetailController@show')->name('perjalanan_dinas.pertanggungjawaban.detail.show');

        Route::post('perjalanan_dinas/pertanggungjawaban/detail/store', 'PerjalananDinasPertanggungJawabanDetailController@store')->name('perjalanan_dinas.pertanggungjawaban.detail.store');

        Route::post('perjalanan_dinas/pertanggungjawaban/detail/update', 'PerjalananDinasPertanggungJawabanDetailController@update')->name('perjalanan_dinas.pertanggungjawaban.detail.update');

        Route::delete('perjalanan_dinas/pertanggungjawaban/detail/delete', 'PerjalananDinasPertanggungJawabanDetailController@delete')->name('perjalanan_dinas.pertanggungjawaban.detail.delete');
        // P PERJALANAN DINAS DETAIL END

        // Permintaan Bayar
        Route::get('permintaan_bayar', 'PermintaanBayarController@index')->name('permintaan_bayar.index');
        Route::get('permintaan_bayar/index_json', 'PermintaanBayarController@indexJson')->name('permintaan_bayar.index.json');
        Route::get('permintaan_bayar/create', 'PermintaanBayarController@create')->name('permintaan_bayar.create');
        Route::post('permintaan_bayar/store', 'PermintaanBayarController@store')->name('permintaan_bayar.store');
        Route::post('permintaan_bayar/store_detail', 'PermintaanBayarController@storeDetail')->name('permintaan_bayar.store.detail');
        Route::post('permintaan_bayar/store_app', 'PermintaanBayarController@storeApp')->name('permintaan_bayar.store.app');
        Route::get('permintaan_bayar/edit/{no}', 'PermintaanBayarController@edit')->name('permintaan_bayar.edit');
        Route::get('permintaan_bayar/editdetail/{id}/{no}', 'PermintaanBayarController@editDetail')->name('permintaan_bayar.edit.detail');
        Route::get('permintaan_bayar/approv/{id}', 'PermintaanBayarController@approv')->name('permintaan_bayar.approv');
        Route::delete('permintaan_bayar/delete', 'PermintaanBayarController@delete')->name('permintaan_bayar.delete');
        Route::delete('permintaan_bayar/delete_detail', 'PermintaanBayarController@deleteDetail')->name('permintaan_bayar.delete.detail');
        Route::get('permintaan_bayar/rekap/{id}', 'PermintaanBayarController@rekap')->name('permintaan_bayar.rekap');
        Route::get('permintaan_bayar/rekaprange', 'PermintaanBayarController@rekapRange')->name('permintaan_bayar.rekap.range');
        Route::post('permintaan_bayar/rekap/export', 'PermintaanBayarController@rekapExport')->name('permintaan_bayar.rekap.export');
        Route::post('permintaan_bayar/rekap/export/range', 'PermintaanBayarController@rekapExportRange')->name('permintaan_bayar.rekap.export.range');
        
        // Anggaran
        Route::get('anggaran', 'AnggaranController@index')->name('anggaran.index');
        Route::get('anggaran/index_json', 'AnggaranController@indexJson')->name('anggaran.index.json');
        Route::get('anggaran/create', 'AnggaranController@create')->name('anggaran.create');
        Route::post('anggaran/store', 'AnggaranController@store')->name('anggaran.store');
        Route::delete('anggaran/delete', 'AnggaranController@delete')->name('anggaran.delete');

        // ANGGARAN SUBMAIN START
        Route::get('anggaran/submain/{kode_main}', 'AnggaranSubMainController@index')->name('anggaran.submain.index');
        Route::get('anggaran/submain/index_json/{kode_main}', 'AnggaranSubMainController@indexJson')->name('anggaran.submain.index.json');
        Route::get('anggaran/submain/create/{kode_main}', 'AnggaranSubMainController@create')->name('anggaran.submain.create');
        Route::post('anggaran/submain/store/{kode_main}', 'AnggaranSubMainController@store')->name('anggaran.submain.store');
        // ANGGARAN SUBMAIN END

        // ANGGARAN SUBMAIN DETAIL START
        Route::get('anggaran/submain/detail/{kode_main}/{kode_submain}', 'AnggaranSubMainDetailController@index')->name('anggaran.submain.detail.index');
        Route::get('anggaran/submain/detail_json/{kode_submain}', 'AnggaranSubMainDetailController@indexJson')->name('anggaran.submain.detail.index.json');
        Route::get('anggaran/submain/detail/create/{kode_main}/{kode_submain}', 'AnggaranSubMainDetailController@create')->name('anggaran.submain.detail.create');
        Route::post('anggaran/submain/detail/store/{kode_main}/{kode_submain}', 'AnggaranSubMainDetailController@store')->name('anggaran.submain.detail.store');
        Route::get('anggaran/submain/detail/edit/{kode_main}/{kode_submain}/{kode}', 'AnggaranSubMainDetailController@edit')->name('anggaran.submain.detail.edit');
        Route::post('anggaran/submain/detail/update/{kode_main}/{kode_submain}/{kode}', 'AnggaranSubMainDetailController@update')->name('anggaran.submain.detail.update');
        Route::delete('anggaran/submain/detail/delete', 'AnggaranSubMainDetailController@delete')->name('anggaran.submain.detail.delete');
        // ANGGARAN SUBMAIN DETAIL END
        
        //vendor
        Route::get('vendor', 'VendorController@index')->name('vendor.index');
        Route::get('vendor/index_json', 'VendorController@indexJson')->name('vendor.index.json');
        Route::get('vendor/create', 'VendorController@create')->name('vendor.create');
        Route::post('vendor/store', 'VendorController@store')->name('vendor.store');
        Route::get('vendor/edit/{id}', 'VendorController@edit')->name('vendor.edit');
        Route::delete('vendor/delete', 'VendorController@delete')->name('vendor.delete');
    });



    //MODUL SDM & Payroll
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
        Route::get('potongan_koreksi_gaji/index_json', 'PotonganKoreksiGajiController@indexJson')->name('potongan_koreksi_gaji.index.json');
        Route::get('potongan_koreksi_gaji/create', 'PotonganKoreksiGajiController@create')->name('potongan_koreksi_gaji.create');
        Route::post('potongan_koreksi_gaji/store', 'PotonganKoreksiGajiController@store')->name('potongan_koreksi_gaji.store');
        Route::get('potongan_koreksi_gaji/edit', 'PotonganKoreksiGajiController@edit')->name('potongan_koreksi_gaji.edit');
        Route::delete('potongan_koreksi_gaji/delete', 'PotonganKoreksiGajiController@delete')->name('potongan_koreksi_gaji.delete');

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
});
