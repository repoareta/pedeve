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
        Route::post('uang_muka_kerja/search_json', 'UangMukaKerjaController@searchIndex')->name('uang_muka_kerja.search.index');
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

        Route::get('uang_muka_kerja/pertanggungjawaban/edit/{no_pumk}', 'UangMukaKerjaPertanggungJawabanController@edit')->name('uang_muka_kerja.pertanggungjawaban.edit');
        Route::post('uang_muka_kerja/pertanggungjawaban/update/{no_pumk}', 'UangMukaKerjaPertanggungJawabanController@update')->name('uang_muka_kerja.pertanggungjawaban.update');

        Route::get('uang_muka_kerja/pertanggungjawaban/approval/{no_pumk}', 'UangMukaKerjaPertanggungJawabanController@approv')->name('uang_muka_kerja.pertanggungjawaban.approval');

        Route::delete('uang_muka_kerja/pertanggungjawaban/delete', 'UangMukaKerjaPertanggungJawabanController@delete')->name('uang_muka_kerja.pertanggungjawaban.delete');
        // P UANG MUKA KERJA END

        // P UANG MUKA KERJA DETAIL START
        Route::get('uang_muka_kerja/pertanggungjawaban/detail/index_json', 'UangMukaKerjaPertanggungJawabanDetailController@indexJson')->name('uang_muka_kerja.pertanggungjawaban.detail.index.json');

        Route::post('uang_muka_kerja/pertanggungjawaban/detail/store', 'UangMukaKerjaPertanggungJawabanDetailController@store')->name('uang_muka_kerja.pertanggungjawaban.detail.store');

        Route::get('uang_muka_kerja/pertanggungjawaban/detail/show/{no}/{no_pumk?}', 'UangMukaKerjaPertanggungJawabanDetailController@show')->name('uang_muka_kerja.pertanggungjawaban.detail.show.json');

        Route::post('uang_muka_kerja/pertanggungjawaban/detail/update/{no}/{no_pumk?}', 'UangMukaKerjaPertanggungJawabanDetailController@update')->name('uang_muka_kerja.pertanggungjawaban.detail.update');

        Route::delete('uang_muka_kerja/pertanggungjawaban/detail/delete', 'UangMukaKerjaPertanggungJawabanDetailController@delete')->name('uang_muka_kerja.pertanggungjawaban.detail.delete');
        // P UANG MUKA KERJA DETAIL END
        
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
        Route::post('permintaan_bayar/search_index', 'PermintaanBayarController@searchIndex')->name('permintaan_bayar.search.index');
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
        Route::get('anggaran/edit/{kode_main}', 'AnggaranController@edit')->name('anggaran.edit');
        Route::post('anggaran/update/{kode_main}', 'AnggaranController@update')->name('anggaran.update');
        Route::delete('anggaran/delete', 'AnggaranController@delete')->name('anggaran.delete');

        // ANGGARAN SUBMAIN START
        Route::get('anggaran/submain/{kode_main}', 'AnggaranSubMainController@index')->name('anggaran.submain.index');
        Route::get('anggaran/submain/index_json/{kode_main}', 'AnggaranSubMainController@indexJson')->name('anggaran.submain.index.json');
        Route::get('anggaran/submain/create/{kode_main}', 'AnggaranSubMainController@create')->name('anggaran.submain.create');
        Route::post('anggaran/submain/store/{kode_main}', 'AnggaranSubMainController@store')->name('anggaran.submain.store');
        Route::get('anggaran/submain/edit/{kode_main}/{kode_submain}', 'AnggaranSubMainController@edit')->name('anggaran.submain.edit');
        Route::post('anggaran/submain/update/{kode_main}/{kode_submain}', 'AnggaranSubMainController@update')->name('anggaran.submain.update');
        Route::delete('anggaran/submain/delete', 'AnggaranSubMainController@delete')->name('anggaran.submain.delete');
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
        // Provinsi START
        Route::get('provinsi', 'ProvinsiController@index')->name('provinsi.index');
        Route::get('provinsi/index_json', 'ProvinsiController@indexJson')->name('provinsi.index.json');
        Route::get('provinsi/create', 'ProvinsiController@create')->name('provinsi.create');
        Route::post('provinsi/store', 'ProvinsiController@store')->name('provinsi.store');
        Route::get('provinsi/edit/{provinsi}', 'ProvinsiController@edit')->name('provinsi.edit');
        Route::post('provinsi/update/{provinsi}', 'ProvinsiController@update')->name('provinsi.update');
        Route::delete('provinsi/delete', 'ProvinsiController@delete')->name('provinsi.delete');
        // Provinsi END

        // Perguruan Tinggi START
        Route::get('perguruan_tinggi', 'PerguruanTinggiController@index')->name('perguruan_tinggi.index');
        Route::get('perguruan_tinggi/index_json', 'PerguruanTinggiController@indexJson')->name('perguruan_tinggi.index.json');
        Route::get('perguruan_tinggi/create', 'PerguruanTinggiController@create')->name('perguruan_tinggi.create');
        Route::post('perguruan_tinggi/store', 'PerguruanTinggiController@store')->name('perguruan_tinggi.store');
        Route::get('perguruan_tinggi/edit/{perguruan_tinggi}', 'PerguruanTinggiController@edit')->name('perguruan_tinggi.edit');
        Route::post('perguruan_tinggi/update/{perguruan_tinggi}', 'PerguruanTinggiController@update')->name('perguruan_tinggi.update');
        Route::delete('perguruan_tinggi/delete', 'PerguruanTinggiController@delete')->name('perguruan_tinggi.delete');
        // Perguruan Tinggi END
        // Kode Jabatan
        // Kode Bagian
        // Agama

        // master pekerja
        Route::get('master_pekerja', 'MasterPekerjaController@index')->name('master_pekerja.index');
        Route::get('master_pekerja/create', 'MasterPekerjaController@create')->name('master_pekerja.create');
        Route::get('master_pekerja/edit', 'MasterPekerjaController@edit')->name('master_pekerja.edit');
        
        //potongan koreksi gaji
        Route::get('potongan_koreksi_gaji', 'PotonganKoreksiGajiController@index')->name('potongan_koreksi_gaji.index');
        Route::post('potongan_koreksi_gaji/search', 'PotonganKoreksiGajiController@searchIndex')->name('potongan_koreksi_gaji.search.index');
        Route::get('potongan_koreksi_gaji/create', 'PotonganKoreksiGajiController@create')->name('potongan_koreksi_gaji.create');
        Route::post('potongan_koreksi_gaji/store', 'PotonganKoreksiGajiController@store')->name('potongan_koreksi_gaji.store');
        Route::get('potongan_koreksi_gaji/edit/{bulan}/{tahun}/{arrd}/{nopek}', 'PotonganKoreksiGajiController@edit')->name('potongan_koreksi_gaji.edit');
        Route::post('potongan_koreksi_gaji/update', 'PotonganKoreksiGajiController@update')->name('potongan_koreksi_gaji.update');
        Route::delete('potongan_koreksi_gaji/delete', 'PotonganKoreksiGajiController@delete')->name('potongan_koreksi_gaji.delete');
        
        //potongan manual
        Route::get('potongan_manual', 'PotonganManualController@index')->name('potongan_manual.index');
        Route::post('potongan_manual/search', 'PotonganManualController@searchIndex')->name('potongan_manual.search.index');
        Route::get('potongan_manual/create', 'PotonganManualController@create')->name('potongan_manual.create');
        Route::post('potongan_manual/store', 'PotonganManualController@store')->name('potongan_manual.store');
        Route::get('potongan_manual/edit/{bulan}/{tahun}/{arrd}/{nopek}', 'PotonganManualController@edit')->name('potongan_manual.edit');
        Route::post('potongan_manual/update', 'PotonganManualController@update')->name('potongan_manual.update');
        Route::delete('potongan_manual/delete', 'PotonganManualController@delete')->name('potongan_manual.delete');
        
        //potongan otomatis
        Route::get('potongan_otomatis', 'PotonganOtomatisController@index')->name('potongan_otomatis.index');
        Route::post('potongan_otomatis/search', 'PotonganOtomatisController@searchIndex')->name('potongan_otomatis.search.index');
        Route::get('potongan_otomatis/create', 'PotonganOtomatisController@create')->name('potongan_otomatis.create');
        Route::post('potongan_otomatis/store', 'PotonganOtomatisController@store')->name('potongan_otomatis.store');
        Route::get('potongan_otomatis/edit/{bulan}/{tahun}/{arrd}/{nopek}', 'PotonganOtomatisController@edit')->name('potongan_otomatis.edit');
        Route::post('potongan_otomatis/update', 'PotonganOtomatisController@update')->name('potongan_otomatis.update');
        Route::delete('potongan_otomatis/delete', 'PotonganOtomatisController@delete')->name('potongan_otomatis.delete');
       
        //honor komite
        Route::get('honor_komite', 'HonorKomiteController@index')->name('honor_komite.index');
        Route::post('honor_komite/search', 'HonorKomiteController@searchIndex')->name('honor_komite.search.index');
        Route::get('honor_komite/create', 'HonorKomiteController@create')->name('honor_komite.create');
        Route::post('honor_komite/store', 'HonorKomiteController@store')->name('honor_komite.store');
        Route::get('honor_komite/edit/{bulan}/{tahun}/{nopek}', 'HonorKomiteController@edit')->name('honor_komite.edit');
        Route::post('honor_komite/update', 'HonorKomiteController@update')->name('honor_komite.update');
        Route::delete('honor_komite/delete', 'HonorKomiteController@delete')->name('honor_komite.delete');
        
        // Lembur
        Route::get('lembur', 'LemburController@index')->name('lembur.index');
        Route::post('lembur/search', 'LemburController@searchIndex')->name('lembur.search.index');
        Route::get('lembur/create', 'LemburController@create')->name('lembur.create');
        Route::post('lembur/store', 'LemburController@store')->name('lembur.store');
        Route::get('lembur/edit/{id}/{nopek}', 'LemburController@edit')->name('lembur.edit');
        Route::post('lembur/update', 'LemburController@update')->name('lembur.update');
        Route::delete('lembur/delete', 'LemburController@delete')->name('lembur.delete');

        //pinjaman pekerja
        Route::get('pinjaman_pekerja', 'PinjamanPekerjaController@index')->name('pinjaman_pekerja.index');
        Route::get('pinjaman_pekerja/create', 'PinjamanPekerjaController@create')->name('pinjaman_pekerja.create');
        Route::get('pinjaman_pekerja/edit', 'PinjamanPekerjaController@edit')->name('pinjaman_pekerja.edit');
        //proses gaji
        Route::get('proses_gaji', 'ProsesGajiController@index')->name('proses_gaji.index');
        Route::post('proses_gaji/store', 'ProsesGajiController@store')->name('proses_gaji.store');
        Route::get('proses_gaji/edit', 'ProsesGajiController@edit')->name('proses_gaji.edit');
        //proses thr
        Route::get('proses_thr', 'ProsesThrController@index')->name('proses_thr.index');
        Route::post('proses_thr/store', 'ProsesThrController@store')->name('proses_thr.store');
        Route::get('proses_thr/edit', 'ProsesThrController@edit')->name('proses_thr.edit');
        //proses insentif
        Route::get('proses_insentif', 'ProsesInsentifController@index')->name('proses_insentif.index');
        Route::post('proses_insentif/store', 'ProsesInsentifController@store')->name('proses_insentif.store');
        Route::get('proses_insentif/edit', 'ProsesInsentifController@edit')->name('proses_insentif.edit');
        //tunjangan golongan
        Route::get('tunjangan_golongan', 'TunjanganGolonganController@index')->name('tunjangan_golongan.index');
        Route::get('tunjangan_golongan/index_json', 'TunjanganGolonganController@indexJson')->name('tunjangan_golongan.index.json');
        Route::get('tunjangan_golongan/create', 'TunjanganGolonganController@create')->name('tunjangan_golongan.create');
        Route::post('tunjangan_golongan/cek_golongan/json', 'TunjanganGolonganController@cekGolonganJson')->name('tunjangan_golongan.golongan.json');
        Route::post('tunjangan_golongan/store', 'TunjanganGolonganController@store')->name('tunjangan_golongan.store');
        Route::get('tunjangan_golongan/edit/{id}', 'TunjanganGolonganController@edit')->name('tunjangan_golongan.edit');
        Route::post('tunjangan_golongan/update', 'TunjanganGolonganController@update')->name('tunjangan_golongan.update');
        Route::delete('tunjangan_golongan/delete', 'TunjanganGolonganController@delete')->name('tunjangan_golongan.delete');
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
