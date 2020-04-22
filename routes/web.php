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
        // Route assigned name "uang_muka_kerja.index"...
        Route::name('uang_muka_kerja.')->group(function () {
            Route::get('uang_muka_kerja', 'UangMukaKerjaController@index')->name('index');
            Route::post('uang_muka_kerja/search_json', 'UangMukaKerjaController@searchIndex')->name('search.index');
            Route::get('uang_muka_kerja/create', 'UangMukaKerjaController@create')->name('create');
            Route::post('uang_muka_kerja/store', 'UangMukaKerjaController@store')->name('store');
            Route::post('uang_muka_kerja/store_detail', 'UangMukaKerjaController@storeDetail')->name('store.detail');
            Route::post('uang_muka_kerja/store_app', 'UangMukaKerjaController@storeApp')->name('store.app');
            Route::delete('uang_muka_kerja/delete', 'UangMukaKerjaController@delete')->name('delete');
            Route::delete('uang_muka_kerja/delete_detail', 'UangMukaKerjaController@deleteDetail')->name('delete.detail');
            Route::get('uang_muka_kerja/edit/{no}', 'UangMukaKerjaController@edit')->name('edit');
            Route::get('uang_muka_kerja/edit_detail/{id}/{no}', 'UangMukaKerjaController@edit_detail')->name('edit.detail');
            Route::get('uang_muka_kerja/approv/{id}', 'UangMukaKerjaController@approv')->name('approv');
            Route::get('uang_muka_kerja/rekap/{id}', 'UangMukaKerjaController@rekap')->name('rekap');
            Route::get('uang_muka_kerja/rekaprange', 'UangMukaKerjaController@rekapRange')->name('rekap.range');
            Route::post('uang_muka_kerja/rekap/export', 'UangMukaKerjaController@rekapExport')->name('rekap.export');
            Route::post('uang_muka_kerja/rekap/export/range', 'UangMukaKerjaController@rekapExportRange')->name('rekap.export.range');

            // Route assigned name "uang_muka_kerja.pertanggungjawaban.index"...
            Route::name('pertanggungjawaban.')->group(function () {
                // P UANG MUKA KERJA START
                Route::get('uang_muka_kerja/pertanggungjawaban', 'UangMukaKerjaPertanggungJawabanController@index')->name('index');
                Route::get('uang_muka_kerja/pertanggungjawaban/index_json', 'UangMukaKerjaPertanggungJawabanController@indexJson')->name('index.json');
                Route::get('uang_muka_kerja/pertanggungjawaban/create', 'UangMukaKerjaPertanggungJawabanController@create')->name('create');
                Route::post('uang_muka_kerja/pertanggungjawaban/store', 'UangMukaKerjaPertanggungJawabanController@store')->name('store');
                Route::get('uang_muka_kerja/pertanggungjawaban/edit/{no_pumk}', 'UangMukaKerjaPertanggungJawabanController@edit')->name('edit');
                Route::post('uang_muka_kerja/pertanggungjawaban/update/{no_pumk}', 'UangMukaKerjaPertanggungJawabanController@update')->name('update');
                Route::get('uang_muka_kerja/pertanggungjawaban/approval/{no_pumk}', 'UangMukaKerjaPertanggungJawabanController@approv')->name('approval');
                Route::delete('uang_muka_kerja/pertanggungjawaban/delete', 'UangMukaKerjaPertanggungJawabanController@delete')->name('delete');
                // P UANG MUKA KERJA END

                // P UANG MUKA KERJA DETAIL START
                Route::get('uang_muka_kerja/pertanggungjawaban/detail/index_json', 'UangMukaKerjaPertanggungJawabanDetailController@indexJson')->name('detail.index.json');
                Route::post('uang_muka_kerja/pertanggungjawaban/detail/store', 'UangMukaKerjaPertanggungJawabanDetailController@store')->name('detail.store');
                Route::get('uang_muka_kerja/pertanggungjawaban/detail/show/{no}/{no_pumk?}', 'UangMukaKerjaPertanggungJawabanDetailController@show')->name('detail.show.json');
                Route::post('uang_muka_kerja/pertanggungjawaban/detail/update/{no}/{no_pumk?}', 'UangMukaKerjaPertanggungJawabanDetailController@update')->name('detail.update');
                Route::delete('uang_muka_kerja/pertanggungjawaban/detail/delete', 'UangMukaKerjaPertanggungJawabanDetailController@delete')->name('detail.delete');
                // P UANG MUKA KERJA DETAIL END
            });
        });
        //END UANG MUKA KERJA
        
        // PERJALANAN DINAS START
        // Route assigned name "perjalanan_dinas.index"...
        Route::name('perjalanan_dinas.')->group(function () {
            Route::get('perjalanan_dinas', 'PerjalananDinasController@index')->name('index');
            Route::get('perjalanan_dinas/index_json', 'PerjalananDinasController@indexJson')->name('index.json');
            Route::get('perjalanan_dinas/show_json', 'PerjalananDinasController@showJson')->name('show.json');
            Route::get('perjalanan_dinas/index_json_detail/{no_panjar}', 'PerjalananDinasController@indexJsonDetail')->name('index.json.detail');
            Route::get('perjalanan_dinas/create', 'PerjalananDinasController@create')->name('create');
            Route::post('perjalanan_dinas/store', 'PerjalananDinasController@store')->name('store');
            Route::post('perjalanan_dinas/store_detail', 'PerjalananDinasController@storeDetail')->name('store.detail');
            Route::get('perjalanan_dinas/edit/{no_panjar}', 'PerjalananDinasController@edit')->name('edit');
            Route::post('perjalanan_dinas/update/{no_panjar}', 'PerjalananDinasController@update')->name('update');
            Route::post('perjalanan_dinas/update_detail', 'PerjalananDinasController@updateDetail')->name('update.detail');
            Route::get('perjalanan_dinas/show_json_detail', 'PerjalananDinasController@showJsonDetail')->name('show.json.detail');
            Route::delete('perjalanan_dinas/delete', 'PerjalananDinasController@delete')->name('delete');
            Route::delete('perjalanan_dinas/delete_detail', 'PerjalananDinasController@deleteDetail')->name('delete.detail');
            Route::get('perjalanan_dinas/export/{no_panjar}', 'PerjalananDinasController@rowExport')->name('export');
            Route::get('perjalanan_dinas/rekap', 'PerjalananDinasController@rekap')->name('rekap');
            Route::post('perjalanan_dinas/rekap/export', 'PerjalananDinasController@rekapExport')->name('rekap.export');
            // PERJALANAN DINAS END

            // PERJALANAN DINAS DETAIL START
            Route::get('perjalanan_dinas/detail/index_json', 'PerjalananDinasDetailController@indexJson')->name('detail.index.json');
            Route::get('perjalanan_dinas/pertanggungjawaban/detail/show', 'PerjalananDinasDetailController@show')->name('detail.show');
            Route::post('perjalanan_dinas/pertanggungjawaban/detail/store', 'PerjalananDinasDetailController@store')->name('detail.store');
            Route::post('perjalanan_dinas/pertanggungjawaban/detail/update', 'PerjalananDinasDetailController@update')->name('detail.update');
            Route::delete('perjalanan_dinas/pertanggungjawaban/detail/delete', 'PerjalananDinasDetailController@delete')->name('detail.delete');
            // PERJALANAN DINAS DETAIL END

            // Route assigned name "perjalanan_dinas.pertanggungjawaban.index"...
            // P PERJALANAN DINAS START
            Route::name('pertanggungjawaban.')->group(function () {
                Route::get('perjalanan_dinas/pertanggungjawaban', 'PerjalananDinasPertanggungJawabanController@index')->name('index');
                Route::get('perjalanan_dinas/pertanggungjawaban/index_json', 'PerjalananDinasPertanggungJawabanController@indexJson')->name('index.json');
                Route::get('perjalanan_dinas/pertanggungjawaban/create', 'PerjalananDinasPertanggungJawabanController@create')->name('create');
                Route::post('perjalanan_dinas/pertanggungjawaban/store', 'PerjalananDinasPertanggungJawabanController@store')->name('store');
                Route::get('perjalanan_dinas/pertanggungjawaban/edit/{no_ppanjar}', 'PerjalananDinasPertanggungJawabanController@edit')->name('edit');
                Route::post('perjalanan_dinas/pertanggungjawaban/update/{no_ppanjar}', 'PerjalananDinasPertanggungJawabanController@update')->name('update');

                Route::delete('perjalanan_dinas/pertanggungjawaban/delete', 'PerjalananDinasPertanggungJawabanController@delete')->name('delete');
                // P PERJALANAN DINAS END

                // P PERJALANAN DINAS DETAIL START
                Route::get('perjalanan_dinas/pertanggungjawaban/detail/index_json', 'PerjalananDinasPertanggungJawabanDetailController@indexJson')->name('detail.index.json');
                Route::get('perjalanan_dinas/pertanggungjawaban/detail/show', 'PerjalananDinasPertanggungJawabanDetailController@show')->name('detail.show');
                Route::post('perjalanan_dinas/pertanggungjawaban/detail/store', 'PerjalananDinasPertanggungJawabanDetailController@store')->name('detail.store');
                Route::post('perjalanan_dinas/pertanggungjawaban/detail/update', 'PerjalananDinasPertanggungJawabanDetailController@update')->name('detail.update');
                Route::delete('perjalanan_dinas/pertanggungjawaban/detail/delete', 'PerjalananDinasPertanggungJawabanDetailController@delete')->name('detail.delete');
                // P PERJALANAN DINAS DETAIL END
            });
        });

        // Permintaan Bayar
        // Route assigned name "permintaan_bayar.index"...
        Route::name('permintaan_bayar.')->group(function () {
            Route::get('permintaan_bayar', 'PermintaanBayarController@index')->name('index');
            Route::post('permintaan_bayar/search_index', 'PermintaanBayarController@searchIndex')->name('search.index');
            Route::get('permintaan_bayar/create', 'PermintaanBayarController@create')->name('create');
            Route::post('permintaan_bayar/store', 'PermintaanBayarController@store')->name('store');
            Route::post('permintaan_bayar/store_detail', 'PermintaanBayarController@storeDetail')->name('store.detail');
            Route::post('permintaan_bayar/store_app', 'PermintaanBayarController@storeApp')->name('store.app');
            Route::get('permintaan_bayar/edit/{no}', 'PermintaanBayarController@edit')->name('edit');
            Route::get('permintaan_bayar/editdetail/{id}/{no}', 'PermintaanBayarController@editDetail')->name('edit.detail');
            Route::get('permintaan_bayar/approv/{id}', 'PermintaanBayarController@approv')->name('approv');
            Route::delete('permintaan_bayar/delete', 'PermintaanBayarController@delete')->name('delete');
            Route::delete('permintaan_bayar/delete_detail', 'PermintaanBayarController@deleteDetail')->name('delete.detail');
            Route::get('permintaan_bayar/rekap/{id}', 'PermintaanBayarController@rekap')->name('rekap');
            Route::get('permintaan_bayar/rekaprange', 'PermintaanBayarController@rekapRange')->name('rekap.range');
            Route::post('permintaan_bayar/rekap/export', 'PermintaanBayarController@rekapExport')->name('rekap.export');
            Route::post('permintaan_bayar/rekap/export/range', 'PermintaanBayarController@rekapExportRange')->name('rekap.export.range');
        });
        //END PERMINTAAN BAYAR

        // ANGGARAN SUBMAIN START
        Route::name('anggaran.')->group(function () {
            // Anggaran
            Route::get('anggaran', 'AnggaranController@index')->name('index');
            Route::get('anggaran/index_json', 'AnggaranController@indexJson')->name('index.json');
            Route::get('anggaran/create', 'AnggaranController@create')->name('create');
            Route::post('anggaran/store', 'AnggaranController@store')->name('store');
            Route::get('anggaran/edit/{kode_main}', 'AnggaranController@edit')->name('edit');
            Route::post('anggaran/update/{kode_main}', 'AnggaranController@update')->name('update');
            Route::delete('anggaran/delete', 'AnggaranController@delete')->name('delete');
        
            Route::get('anggaran/submain/{kode_main}', 'AnggaranSubMainController@index')->name('submain.index');
            Route::get('anggaran/submain/index_json/{kode_main}', 'AnggaranSubMainController@indexJson')->name('submain.index.json');
            Route::get('anggaran/submain/create/{kode_main}', 'AnggaranSubMainController@create')->name('submain.create');
            Route::post('anggaran/submain/store/{kode_main}', 'AnggaranSubMainController@store')->name('submain.store');
            Route::get('anggaran/submain/edit/{kode_main}/{kode_submain}', 'AnggaranSubMainController@edit')->name('submain.edit');
            Route::post('anggaran/submain/update/{kode_main}/{kode_submain}', 'AnggaranSubMainController@update')->name('submain.update');
            Route::delete('anggaran/submain/delete', 'AnggaranSubMainController@delete')->name('submain.delete');

            // ANGGARAN SUBMAIN END

            // ANGGARAN SUBMAIN DETAIL START
            Route::get('anggaran/submain/detail/{kode_main}/{kode_submain}', 'AnggaranSubMainDetailController@index')->name('submain.detail.index');
            Route::get('anggaran/submain/detail_json/{kode_submain}', 'AnggaranSubMainDetailController@indexJson')->name('submain.detail.index.json');
            Route::get('anggaran/submain/detail/create/{kode_main}/{kode_submain}', 'AnggaranSubMainDetailController@create')->name('submain.detail.create');
            Route::post('anggaran/submain/detail/store/{kode_main}/{kode_submain}', 'AnggaranSubMainDetailController@store')->name('submain.detail.store');
            Route::get('anggaran/submain/detail/edit/{kode_main}/{kode_submain}/{kode}', 'AnggaranSubMainDetailController@edit')->name('submain.detail.edit');
            Route::post('anggaran/submain/detail/update/{kode_main}/{kode_submain}/{kode}', 'AnggaranSubMainDetailController@update')->name('submain.detail.update');
            Route::delete('anggaran/submain/detail/delete', 'AnggaranSubMainDetailController@delete')->name('submain.detail.delete');
            // ANGGARAN SUBMAIN DETAIL END
        });
        
        
        
        //vendor
        // Route assigned name "vendor.index"...
        Route::name('vendor.')->group(function () {
            Route::get('vendor', 'VendorController@index')->name('index');
            Route::get('vendor/index_json', 'VendorController@indexJson')->name('index.json');
            Route::get('vendor/create', 'VendorController@create')->name('create');
            Route::post('vendor/store', 'VendorController@store')->name('store');
            Route::get('vendor/edit/{id}', 'VendorController@edit')->name('edit');
            Route::delete('vendor/delete', 'VendorController@delete')->name('delete');
        });
        //END VENDOR
    });



    //MODUL SDM & Payroll
    Route::prefix('sdm')->group(function () {
        // Tabel data Master
        // Provinsi START
        // Route assigned name "provinsi.index"...
        Route::name('provinsi.')->group(function () {
            Route::get('provinsi', 'ProvinsiController@index')->name('index');
            Route::get('provinsi/index_json', 'ProvinsiController@indexJson')->name('index.json');
            Route::get('provinsi/create', 'ProvinsiController@create')->name('create');
            Route::post('provinsi/store', 'ProvinsiController@store')->name('store');
            Route::get('provinsi/edit/{provinsi}', 'ProvinsiController@edit')->name('edit');
            Route::post('provinsi/update/{provinsi}', 'ProvinsiController@update')->name('update');
            Route::delete('provinsi/delete', 'ProvinsiController@delete')->name('delete');
        });
        
        // Provinsi END

        // Perguruan Tinggi START
        // Route assigned name "perguruan_tinggi.index"...
        Route::name('perguruan_tinggi.')->group(function () {
            Route::get('perguruan_tinggi', 'PerguruanTinggiController@index')->name('index');
            Route::get('perguruan_tinggi/index_json', 'PerguruanTinggiController@indexJson')->name('index.json');
            Route::get('perguruan_tinggi/create', 'PerguruanTinggiController@create')->name('create');
            Route::post('perguruan_tinggi/store', 'PerguruanTinggiController@store')->name('store');
            Route::get('perguruan_tinggi/edit/{perguruan_tinggi}', 'PerguruanTinggiController@edit')->name('edit');
            Route::post('perguruan_tinggi/update/{perguruan_tinggi}', 'PerguruanTinggiController@update')->name('update');
            Route::delete('perguruan_tinggi/delete', 'PerguruanTinggiController@delete')->name('delete');
        });
        
        // Perguruan Tinggi END

        // Kode Bagian START
        // Route assigned name "kode_bagian.index"...
        Route::name('kode_bagian.')->group(function () {
            Route::get('kode_bagian', 'KodeBagianController@index')->name('index');
            Route::get('kode_bagian/index_json', 'KodeBagianController@indexJson')->name('index.json');
            Route::get('kode_bagian/create', 'KodeBagianController@create')->name('create');
            Route::post('kode_bagian/store', 'KodeBagianController@store')->name('store');
            Route::get('kode_bagian/edit/{kode_bagian}', 'KodeBagianController@edit')->name('edit');
            Route::post('kode_bagian/update/{kode_bagian}', 'KodeBagianController@update')->name('update');
            Route::delete('kode_bagian/delete', 'KodeBagianController@delete')->name('delete');
        });
        // Kode Bagian END

        // Kode Jabatan START
        // Route assigned name "kode_jabatan.index"...
        Route::name('kode_jabatan.')->group(function () {
            Route::get('kode_jabatan', 'KodeJabatanController@index')->name('index');
            Route::get('kode_jabatan/index_json', 'KodeJabatanController@indexJson')->name('index.json');
            Route::get('kode_jabatan/create', 'KodeJabatanController@create')->name('create');
            Route::post('kode_jabatan/store', 'KodeJabatanController@store')->name('store');
            Route::get('kode_jabatan/edit/{kode_bagian}/{kdjab}', 'KodeJabatanController@edit')->name('edit');
            Route::post('kode_jabatan/update/{kode_bagian}/{kdjab}', 'KodeJabatanController@update')->name('update');
            Route::delete('kode_jabatan/delete', 'KodeJabatanController@delete')->name('delete');
        });
        // Kode Jabatan END

        
        // Agama START
        // Route assigned name "agama.index"...
        Route::name('agama.')->group(function () {
            Route::get('agama', 'AgamaController@index')->name('index');
            Route::get('agama/index_json', 'AgamaController@indexJson')->name('index.json');
            Route::get('agama/create', 'AgamaController@create')->name('create');
            Route::post('agama/store', 'AgamaController@store')->name('store');
            Route::get('agama/edit/{agama}', 'AgamaController@edit')->name('edit');
            Route::post('agama/update/{agama}', 'AgamaController@update')->name('update');
            Route::delete('agama/delete', 'AgamaController@delete')->name('delete');
        });
        
        // Agama END

        // master pekerja
        // Kode Jabatan START
        // Route assigned name "pekerja.index"...
        Route::name('pekerja.')->group(function () {
            Route::get('pekerja', 'PekerjaController@index')->name('index');
            Route::get('pekerja/index_json', 'PekerjaController@indexJson')->name('index.json');
            Route::get('pekerja/show_json/{pekerja}', 'PekerjaController@showJson')->name('show.json');
            Route::get('pekerja/create', 'PekerjaController@create')->name('create');
            Route::post('pekerja/store', 'PekerjaController@store')->name('store');
            Route::get('pekerja/edit/{pekerja}', 'PekerjaController@edit')->name('edit');
            Route::post('pekerja/update/{pekerja}', 'PekerjaController@update')->name('update');
            Route::delete('pekerja/delete', 'PekerjaController@delete')->name('delete');
            
            // Route assigned name "pekerja.keluarga.index"...
            Route::name('keluarga.')->group(function () {
                Route::get('pekerja/keluarga/{pekerja}', 'KeluargaController@indexJson')->name('index.json');
                Route::post('pekerja/keluarga/store/{pekerja}', 'KeluargaController@store')->name('store');
                Route::get('keluarga/show_json', 'KeluargaController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/keluarga/update/{pekerja}/{status}/{nama}', 'KeluargaController@update')->name('update');
                Route::delete('pekerja/keluarga/delete', 'KeluargaController@delete')->name('delete');
            });

            // Route assigned name "pekerja.keluarga.index"...
            Route::name('jabatan.')->group(function () {
                Route::get('pekerja/jabatan/{pekerja}', 'JabatanController@indexJson')->name('index.json');
                Route::post('pekerja/jabatan/store/{pekerja}', 'JabatanController@store')->name('store');
                Route::get('jabatan/show_json', 'JabatanController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/jabatan/update/{pekerja}/{status}/{nama}', 'JabatanController@update')->name('update');
                Route::delete('pekerja/jabatan/delete', 'JabatanController@delete')->name('delete');
            });

            // Route assigned name "pekerja.golongan_gaji.index"...
            Route::name('golongan_gaji.')->group(function () {
                Route::get('pekerja/golongan_gaji/{pekerja}', 'GolonganGajiController@indexJson')->name('index.json');
                Route::post('pekerja/golongan_gaji/store/{pekerja}', 'GolonganGajiController@store')->name('store');
                Route::get('golongan_gaji/show_json', 'GolonganGajiController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/golongan_gaji/update/{pekerja}/{status}/{nama}', 'GolonganGajiController@update')->name('update');
                Route::delete('pekerja/golongan_gaji/delete', 'GolonganGajiController@delete')->name('delete');
            });

            // Route assigned name "pekerja.kursus.index"...
            Route::name('kursus.')->group(function () {
                Route::get('pekerja/kursus/{pekerja}', 'KursusController@indexJson')->name('index.json');
                Route::post('pekerja/kursus/store/{pekerja}', 'KursusController@store')->name('store');
                Route::get('kursus/show_json', 'KursusController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/kursus/update/{pekerja}/{status}/{nama}', 'KursusController@update')->name('update');
                Route::delete('pekerja/kursus/delete', 'KursusController@delete')->name('delete');
            });

            // Route assigned name "pekerja.pendidikan.index"...
            Route::name('pendidikan.')->group(function () {
                Route::get('pekerja/pendidikan/{pekerja}', 'PekerjaPendidikanController@indexJson')->name('index.json');
                Route::post('pekerja/pendidikan/store/{pekerja}', 'PekerjaPendidikanController@store')->name('store');
                Route::get('pekerja/pendidikan/show_json', 'PekerjaPendidikanController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/pendidikan/update/{pekerja}/{status}/{nama}', 'PekerjaPendidikanController@update')->name('update');
                Route::delete('pekerja/pendidikan/delete', 'PekerjaPendidikanController@delete')->name('delete');
            });

            // Route assigned name "pekerja.penghargaan.index"...
            Route::name('penghargaan.')->group(function () {
                Route::get('pekerja/penghargaan/index_json/{pekerja}', 'PenghargaanController@indexJson')->name('index.json');
                Route::post('pekerja/penghargaan/store/{pekerja}', 'PenghargaanController@store')->name('store');
                Route::get('pekerja/penghargaan/show_json', 'PenghargaanController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/penghargaan/update/{pekerja}/{tanggal}/{nama}', 'PenghargaanController@update')->name('update');
                Route::delete('pekerja/penghargaan/delete', 'PenghargaanController@delete')->name('delete');
            });

            // Route assigned name "pekerja.pengalaman_kerja.index"...
            Route::name('pengalaman_kerja.')->group(function () {
                Route::get('pekerja/pengalaman_kerja/index_json/{pekerja}', 'PengalamanKerjaController@indexJson')->name('index.json');
                Route::post('pekerja/pengalaman_kerja/store/{pekerja}', 'PengalamanKerjaController@store')->name('store');
                Route::get('pekerja/pengalaman_kerja/show_json', 'PengalamanKerjaController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/pengalaman_kerja/update/{pekerja}/{mulai}/{pangkat}', 'PengalamanKerjaController@update')->name('update');
                Route::delete('pekerja/pengalaman_kerja/delete', 'PengalamanKerjaController@delete')->name('delete');
            });

            // Route assigned name "pekerja.seminar.index"...
            Route::name('seminar.')->group(function () {
                Route::get('pekerja/seminar/index_json/{pekerja}', 'SeminarController@indexJson')->name('index.json');
                Route::post('pekerja/seminar/store/{pekerja}', 'SeminarController@store')->name('store');
                Route::get('pekerja/seminar/show_json', 'SeminarController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/seminar/update/{pekerja}/{mulai}', 'SeminarController@update')->name('update');
                Route::delete('pekerja/seminar/delete', 'SeminarController@delete')->name('delete');
            });

            // Route assigned name "pekerja.smk.index"...
            Route::name('smk.')->group(function () {
                Route::get('pekerja/smk/index_json/{pekerja}', 'SMKController@indexJson')->name('index.json');
                Route::post('pekerja/smk/store/{pekerja}', 'SMKController@store')->name('store');
                Route::get('pekerja/smk/show_json', 'SMKController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/smk/update/{pekerja}/{tahun}', 'SMKController@update')->name('update');
                Route::delete('pekerja/smk/delete', 'SMKController@delete')->name('delete');
            });

            // Route assigned name "pekerja.upah_tetap.index"...
            Route::name('upah_tetap.')->group(function () {
                Route::get('pekerja/upah_tetap/index_json/{pekerja}', 'UpahTetapController@indexJson')->name('index.json');
                Route::post('pekerja/upah_tetap/store/{pekerja}', 'UpahTetapController@store')->name('store');
                Route::get('pekerja/upah_tetap/show_json', 'UpahTetapController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/upah_tetap/update/{pekerja}/{nilai}', 'UpahTetapController@update')->name('update');
                Route::delete('pekerja/upah_tetap/delete', 'UpahTetapController@delete')->name('delete');
            });

            // Route assigned name "pekerja.upah_all_in.index"...
            Route::name('upah_all_in.')->group(function () {
                Route::get('pekerja/upah_all_in/index_json/{pekerja}', 'UpahAllInController@indexJson')->name('index.json');
                Route::post('pekerja/upah_all_in/store/{pekerja}', 'UpahAllInController@store')->name('store');
                Route::get('pekerja/upah_all_in/show_json', 'UpahAllInController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/upah_all_in/update/{pekerja}/{nilai}', 'UpahAllInController@update')->name('update');
                Route::delete('pekerja/upah_all_in/delete', 'UpahAllInController@delete')->name('delete');
            });
        });
        // Kode Jabatan END
        
        //potongan koreksi gaji
        // Route assigned name "potongan_koreksi_gaji.index"...
        Route::name('potongan_koreksi_gaji.')->group(function () {
            Route::get('potongan_koreksi_gaji', 'PotonganKoreksiGajiController@index')->name('index');
            Route::post('potongan_koreksi_gaji/search', 'PotonganKoreksiGajiController@searchIndex')->name('search.index');
            Route::get('potongan_koreksi_gaji/create', 'PotonganKoreksiGajiController@create')->name('create');
            Route::post('potongan_koreksi_gaji/store', 'PotonganKoreksiGajiController@store')->name('store');
            Route::get('potongan_koreksi_gaji/edit/{bulan}/{tahun}/{arrd}/{nopek}', 'PotonganKoreksiGajiController@edit')->name('edit');
            Route::post('potongan_koreksi_gaji/update', 'PotonganKoreksiGajiController@update')->name('update');
            Route::delete('potongan_koreksi_gaji/delete', 'PotonganKoreksiGajiController@delete')->name('delete');
        });
        //end potongan_koreksi_gaji

        //potongan manual
        // Route assigned name "potongan_manual.index"...
        Route::name('potongan_manual.')->group(function () {
            Route::get('potongan_manual', 'PotonganManualController@index')->name('index');
            Route::post('potongan_manual/search', 'PotonganManualController@searchIndex')->name('search.index');
            Route::get('potongan_manual/create', 'PotonganManualController@create')->name('create');
            Route::post('potongan_manual/store', 'PotonganManualController@store')->name('store');
            Route::get('potongan_manual/edit/{bulan}/{tahun}/{arrd}/{nopek}', 'PotonganManualController@edit')->name('edit');
            Route::post('potongan_manual/update', 'PotonganManualController@update')->name('update');
            Route::delete('potongan_manual/delete', 'PotonganManualController@delete')->name('delete');
        });
        //end potongan_manual

        //potongan otomatis
        // Route assigned name "potongan_otomatis.index"...
        Route::name('potongan_otomatis.')->group(function () {
            Route::get('potongan_otomatis', 'PotonganOtomatisController@index')->name('index');
            Route::post('potongan_otomatis/search', 'PotonganOtomatisController@searchIndex')->name('search.index');
            Route::get('potongan_otomatis/create', 'PotonganOtomatisController@create')->name('create');
            Route::post('potongan_otomatis/store', 'PotonganOtomatisController@store')->name('store');
            Route::get('potongan_otomatis/edit/{bulan}/{tahun}/{arrd}/{nopek}', 'PotonganOtomatisController@edit')->name('edit');
            Route::post('potongan_otomatis/update', 'PotonganOtomatisController@update')->name('update');
            Route::delete('potongan_otomatis/delete', 'PotonganOtomatisController@delete')->name('delete');
        });
        //end potongan_otomatis

        //potongan insentif
        // Route assigned name "potongan_insentif.index"...
        Route::name('potongan_insentif.')->group(function () {
            Route::get('potongan_insentif', 'PotonganInsentifController@index')->name('index');
            Route::post('potongan_insentif/search', 'PotonganInsentifController@searchIndex')->name('search.index');
            Route::get('potongan_insentif/create', 'PotonganInsentifController@create')->name('create');
            Route::post('potongan_insentif/store', 'PotonganInsentifController@store')->name('store');
            Route::get('potongan_insentif/edit/{bulan}/{tahun}/{nopek}', 'PotonganInsentifController@edit')->name('edit');
            Route::post('potongan_insentif/update', 'PotonganInsentifController@update')->name('update');
            Route::delete('potongan_insentif/delete', 'PotonganInsentifController@delete')->name('delete');
        });
        //end potongan_insentif

        //honor komite
        // Route assigned name "honor_komite.index"...
        Route::name('honor_komite.')->group(function () {
            Route::get('honor_komite', 'HonorKomiteController@index')->name('index');
            Route::post('honor_komite/search', 'HonorKomiteController@searchIndex')->name('search.index');
            Route::get('honor_komite/create', 'HonorKomiteController@create')->name('create');
            Route::post('honor_komite/store', 'HonorKomiteController@store')->name('store');
            Route::get('honor_komite/edit/{bulan}/{tahun}/{nopek}', 'HonorKomiteController@edit')->name('edit');
            Route::post('honor_komite/update', 'HonorKomiteController@update')->name('update');
            Route::delete('honor_komite/delete', 'HonorKomiteController@delete')->name('delete');
        });
        //end honor_komite

        // Lembur
        // Route assigned name "lembur.index"...
        Route::name('lembur.')->group(function () {
            Route::get('lembur', 'LemburController@index')->name('index');
            Route::post('lembur/search', 'LemburController@searchIndex')->name('search.index');
            Route::get('lembur/create', 'LemburController@create')->name('create');
            Route::post('lembur/store', 'LemburController@store')->name('store');
            Route::get('lembur/edit/{id}/{nopek}', 'LemburController@edit')->name('edit');
            Route::post('lembur/update', 'LemburController@update')->name('update');
            Route::delete('lembur/delete', 'LemburController@delete')->name('delete');
        });
        //end lembur

        //pinjaman pekerja
        Route::get('pinjaman_pekerja', 'PinjamanPekerjaController@index')->name('pinjaman_pekerja.index');
        Route::get('pinjaman_pekerja/create', 'PinjamanPekerjaController@create')->name('pinjaman_pekerja.create');
        Route::get('pinjaman_pekerja/edit', 'PinjamanPekerjaController@edit')->name('pinjaman_pekerja.edit');
        
        //proses gaji
        // Route assigned name "proses_gaji.index"...
        Route::name('proses_gaji.')->group(function () {
            Route::get('proses_gaji', 'ProsesGajiController@index')->name('index');
            Route::post('proses_gaji/store', 'ProsesGajiController@store')->name('store');
            Route::get('proses_gaji/edit', 'ProsesGajiController@edit')->name('edit');
        });
        //end proses_gaji

        //proses thr
        // Route assigned name "proses_thr.index"...
        Route::name('proses_thr.')->group(function () {
            Route::get('proses_thr', 'ProsesThrController@index')->name('index');
            Route::post('proses_thr/store', 'ProsesThrController@store')->name('store');
            Route::get('proses_thr/edit', 'ProsesThrController@edit')->name('edit');
        });
        //end proses_gaji

        //proses insentif
        // Route assigned name "proses_insentif.index"...
        Route::name('proses_insentif.')->group(function () {
            Route::get('proses_insentif', 'ProsesInsentifController@index')->name('index');
            Route::post('proses_insentif/store', 'ProsesInsentifController@store')->name('store');
            Route::get('proses_insentif/edit', 'ProsesInsentifController@edit')->name('edit');
        });
        //end proses_insentif

        //tunjangan golongan
        // Route assigned name "tunjangan_golongan.index"...
        Route::name('tunjangan_golongan.')->group(function () {
            Route::get('tunjangan_golongan', 'TunjanganGolonganController@index')->name('index');
            Route::get('tunjangan_golongan/index_json', 'TunjanganGolonganController@indexJson')->name('index.json');
            Route::get('tunjangan_golongan/create', 'TunjanganGolonganController@create')->name('create');
            Route::post('tunjangan_golongan/cek_golongan/json', 'TunjanganGolonganController@cekGolonganJson')->name('golongan.json');
            Route::post('tunjangan_golongan/store', 'TunjanganGolonganController@store')->name('store');
            Route::get('tunjangan_golongan/edit/{id}', 'TunjanganGolonganController@edit')->name('edit');
            Route::post('tunjangan_golongan/update', 'TunjanganGolonganController@update')->name('update');
            Route::delete('tunjangan_golongan/delete', 'TunjanganGolonganController@delete')->name('delete');
        });
        //end tunjangan_golongan

        //jamsostek
        // Route assigned name "jamsostek.index"...
        Route::name('jamsostek.')->group(function () {
            Route::get('jamsostek', 'JamsostekController@index')->name('index');
            Route::get('jamsostek/index_json', 'JamsostekController@indexJson')->name('index.json');
            Route::get('jamsostek/create', 'JamsostekController@create')->name('create');
            Route::post('jamsostek/cek_golongan/json', 'JamsostekController@cekGolonganJson')->name('golongan.json');
            Route::post('jamsostek/store', 'JamsostekController@store')->name('store');
            Route::get('jamsostek/edit/{id}', 'JamsostekController@edit')->name('edit');
            Route::post('jamsostek/update', 'JamsostekController@update')->name('update');
            Route::delete('jamsostek/delete', 'JamsostekController@delete')->name('delete');
        });
        //end jamsostek

        //pensiun
        // Route assigned name "pensiun.index"...
        Route::name('pensiun.')->group(function () {
            Route::get('pensiun', 'PensiunController@index')->name('index');
            Route::get('pensiun/index_json', 'PensiunController@indexJson')->name('index.json');
            Route::get('pensiun/create', 'PensiunController@create')->name('create');
            Route::post('pensiun/cek_golongan/json', 'PensiunController@cekGolonganJson')->name('golongan.json');
            Route::post('pensiun/store', 'PensiunController@store')->name('store');
            Route::get('pensiun/edit/{id}', 'PensiunController@edit')->name('edit');
            Route::post('pensiun/update', 'PensiunController@update')->name('update');
            Route::delete('pensiun/delete', 'PensiunController@delete')->name('delete');
        });
        //end pensiun
        

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


    //PERBENDAHARAAN
    Route::prefix('perbendaharaan')->group(function () {

           //Penerimaan kas
        // Route assigned name "penerimaan_kas.index"...
        Route::name('penerimaan_kas.')->group(function () {
            Route::get('penerimaan_kas', 'PenerimaanKasController@index')->name('index');
            Route::post('penerimaan_kas/search', 'PenerimaanKasController@searchIndex')->name('search.index');
            Route::get('penerimaan_kas/createmp', 'PenerimaanKasController@createmp')->name('createmp');
            Route::post('penerimaan_kas/create', 'PenerimaanKasController@create')->name('create');
            Route::post('penerimaan_kas/create/json', 'PenerimaanKasController@createJson')->name('createJson');
            Route::post('penerimaan_kas/lokasi/json', 'PenerimaanKasController@lokasiJson')->name('lokasiJson');
            Route::post('penerimaan_kas/nobukti/json', 'PenerimaanKasController@nobuktiJson')->name('nobuktiJson');
            Route::post('penerimaan_kas/store', 'PenerimaanKasController@store')->name('store');
            Route::post('penerimaan_kas/store_detail', 'PenerimaanKasController@storeDetail')->name('store.detail');
            Route::post('penerimaan_kas/store_app', 'PenerimaanKasController@storeApp')->name('store.app');
            Route::get('penerimaan_kas/edit/{no}', 'PenerimaanKasController@edit')->name('edit');
            Route::get('penerimaan_kas/editdetail/{id}/{no}', 'PenerimaanKasController@editDetail')->name('edit.detail');
            Route::post('penerimaan_kas/update', 'PenerimaanKasController@update')->name('update');
            Route::delete('penerimaan_kas/delete', 'PenerimaanKasController@delete')->name('delete');
            Route::delete('penerimaan_kas/deletedetail', 'PenerimaanKasController@deleteDetail')->name('delete.detail');
            Route::get('penerimaan_kas/approv/{id}/{status}', 'PenerimaanKasController@approv')->name('approv');
        });
        //end penerimaan kas

        //informasi saldo
        // Route assigned name "informasi_saldo.index"...
        Route::name('informasi_saldo.')->group(function () {
            Route::get('informasi_saldo', 'InformasiSaldoController@index')->name('index');
            Route::post('informasi_saldo/search', 'InformasiSaldoController@searchIndex')->name('search.index');
            Route::get('informasi_saldo/create', 'InformasiSaldoController@create')->name('create');
            Route::post('informasi_saldo/store', 'InformasiSaldoController@store')->name('store');
            Route::get('informasi_saldo/edit/{bulan}/{tahun}/{nopek}', 'InformasiSaldoController@edit')->name('edit');
            Route::post('informasi_saldo/update', 'InformasiSaldoController@update')->name('update');
            Route::delete('informasi_saldo/delete', 'InformasiSaldoController@delete')->name('delete');
        });
        //end informasi_saldo

        //inisialisasi saldo
        // Route assigned name "inisialisasi_saldo.index"...
        Route::name('inisialisasi_saldo.')->group(function () {
            Route::get('inisialisasi_saldo', 'InisialisasiSaldoController@index')->name('index');
            Route::get('inisialisasi_saldo/index/json', 'InisialisasiSaldoController@indexJson')->name('index.json');
            Route::post('inisialisasi_saldo/nokas/json', 'InisialisasiSaldoController@nokasJson')->name('nokas.json');
            Route::get('inisialisasi_saldo/create', 'InisialisasiSaldoController@create')->name('create');
            Route::post('inisialisasi_saldo/store', 'InisialisasiSaldoController@store')->name('store');
            Route::get('inisialisasi_saldo/edit/{jk}/{nokas}', 'InisialisasiSaldoController@edit')->name('edit');
            Route::post('inisialisasi_saldo/update', 'InisialisasiSaldoController@update')->name('update');
            Route::delete('inisialisasi_saldo/delete', 'InisialisasiSaldoController@delete')->name('delete');
        });
        //end inisialisasi_saldo
    });
});
