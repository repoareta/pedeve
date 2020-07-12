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
// use DB;

// LOGIN FORM
Route::get('/', 'AuthController@login')->name('login');
Route::get('/login', 'AuthController@login')->name('login');
Route::post('login_user', 'AuthController@postlogin')->name('login_user.postlogin');
Route::get('/logout', 'AuthController@logout')->name('logout.index');
Route::get('/error', 'AuthController@error')->name('error');

Route::get('/migration_show', function () {
    $migrasi = DB::select(DB::raw("SELECT * FROM migrations"));
    dd($migrasi);
});

Route::get('/migration_clear', function () {
    DB::select(DB::raw("DELETE FROM migrations"));
});

//MODUL UMUM
Route::group(['middleware'=> ['auth','checkRole:1,0']], function () {
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

            Route::get('uang_muka_kerja/show_json', 'UangMukaKerjaController@showJson')->name('show.json');

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
                Route::get('uang_muka_kerja/pertanggungjawaban/export/{no_pumk}', 'UangMukaKerjaPertanggungJawabanController@exportRow')->name('export');
                // P UANG MUKA KERJA END

                // P UANG MUKA KERJA DETAIL START
                Route::name('detail.')->group(function () {
                    Route::get('uang_muka_kerja/pertanggungjawaban/detail/index_json', 'UangMukaKerjaPertanggungJawabanDetailController@indexJson')->name('index.json');
                    Route::post('uang_muka_kerja/pertanggungjawaban/detail/store', 'UangMukaKerjaPertanggungJawabanDetailController@store')->name('store');
                    Route::get('uang_muka_kerja/pertanggungjawaban/detail/show', 'UangMukaKerjaPertanggungJawabanDetailController@show')->name('show.json');
                    Route::post('uang_muka_kerja/pertanggungjawaban/detail/update', 'UangMukaKerjaPertanggungJawabanDetailController@update')->name('update');
                    Route::delete('uang_muka_kerja/pertanggungjawaban/detail/delete', 'UangMukaKerjaPertanggungJawabanDetailController@delete')->name('delete');
                });
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
            Route::get('perjalanan_dinas/create', 'PerjalananDinasController@create')->name('create');
            Route::post('perjalanan_dinas/store', 'PerjalananDinasController@store')->name('store');
            
            Route::get('perjalanan_dinas/edit/{no_panjar}', 'PerjalananDinasController@edit')->name('edit');
            Route::post('perjalanan_dinas/update/{no_panjar}', 'PerjalananDinasController@update')->name('update');
            Route::delete('perjalanan_dinas/delete', 'PerjalananDinasController@delete')->name('delete');
            Route::post('perjalanan_dinas/export', 'PerjalananDinasController@rowExport')->name('export');
            Route::get('perjalanan_dinas/rekap', 'PerjalananDinasController@rekap')->name('rekap');
            Route::post('perjalanan_dinas/rekap/export', 'PerjalananDinasController@rekapExport')->name('rekap.export');
            // PERJALANAN DINAS END

            // PERJALANAN DINAS DETAIL START
            Route::name('detail.')->group(function () {
                Route::get('perjalanan_dinas/detail/index_json/{no_panjar?}', 'PerjalananDinasDetailController@indexJson')->name('index.json');
                Route::post('perjalanan_dinas/detail/store/{no_panjar?}', 'PerjalananDinasDetailController@store')->name('store');
                Route::get('perjalanan_dinas/detail/show', 'PerjalananDinasDetailController@show')->name('show.json');
                Route::post('perjalanan_dinas/detail/update/{no_panjar}/{no_urut}/{nopek}', 'PerjalananDinasDetailController@update')->name('update');
                Route::delete('perjalanan_dinas/detail/delete', 'PerjalananDinasDetailController@delete')->name('delete');
            });
            
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

                Route::get('perjalanan_dinas/pertanggungjawaban/export/{no_ppanjar}', 'PerjalananDinasPertanggungJawabanController@exportRow')->name('export');
                // P PERJALANAN DINAS END

                // P PERJALANAN DINAS DETAIL START
                Route::get('perjalanan_dinas/pertanggungjawaban/detail/index_json', 'PerjalananDinasPertanggungJawabanDetailController@indexJson')->name('detail.index.json');
                Route::get('perjalanan_dinas/pertanggungjawaban/detail/show', 'PerjalananDinasPertanggungJawabanDetailController@show')->name('detail.show');
                Route::post('perjalanan_dinas/pertanggungjawaban/detail/store', 'PerjalananDinasPertanggungJawabanDetailController@store')->name('detail.store');
                Route::post('perjalanan_dinas/pertanggungjawaban/detail/update/{no_ppanjar}/{no_urut}/{nopek}', 'PerjalananDinasPertanggungJawabanDetailController@update')->name('detail.update');
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

        Route::name('anggaran.')->group(function () {
            // Anggaran
            Route::get('anggaran', 'AnggaranController@index')->name('index');
            Route::get('anggaran/index_json', 'AnggaranController@indexJson')->name('index.json');
            Route::get('anggaran/create', 'AnggaranController@create')->name('create');
            Route::post('anggaran/store', 'AnggaranController@store')->name('store');
            Route::get('anggaran/edit/{kode_main}', 'AnggaranController@edit')->name('edit');
            Route::post('anggaran/update/{kode_main}', 'AnggaranController@update')->name('update');
            Route::delete('anggaran/delete', 'AnggaranController@delete')->name('delete');
            Route::post('anggaran/rekap/export', 'AnggaranController@rekapExport')->name('rekap.export');
        
            // ANGGARAN SUBMAIN START
            Route::name('submain.')->group(function () {
                Route::get('anggaran/submain', 'AnggaranSubMainController@index')->name('index');
                Route::get('anggaran/submain/index_json', 'AnggaranSubMainController@indexJson')->name('index.json');
                Route::get('anggaran/submain/create', 'AnggaranSubMainController@create')->name('create');
                Route::post('anggaran/submain/store', 'AnggaranSubMainController@store')->name('store');
                Route::get('anggaran/submain/edit/{kode_main}/{kode_submain}', 'AnggaranSubMainController@edit')->name('edit');
                Route::post('anggaran/submain/update/{kode_main}/{kode_submain}', 'AnggaranSubMainController@update')->name('update');
                Route::delete('anggaran/submain/delete', 'AnggaranSubMainController@delete')->name('delete');
                // ANGGARAN SUBMAIN END

                // ANGGARAN SUBMAIN DETAIL START
                Route::name('detail.')->group(function () {
                    Route::get('anggaran/submain/detail', 'AnggaranSubMainDetailController@index')->name('index');
                    Route::get('anggaran/submain/detail/index_json', 'AnggaranSubMainDetailController@indexJson')->name('index.json');
                    Route::get('anggaran/submain/detail/create', 'AnggaranSubMainDetailController@create')->name('create');
                    Route::post('anggaran/submain/detail/store', 'AnggaranSubMainDetailController@store')->name('store');
                    Route::get('anggaran/submain/detail/edit/{kode}', 'AnggaranSubMainDetailController@edit')->name('edit');
                    Route::post('anggaran/submain/detail/update/{kode}', 'AnggaranSubMainDetailController@update')->name('update');
                    Route::delete('anggaran/submain/detail/delete', 'AnggaranSubMainDetailController@delete')->name('delete');
                });
                // ANGGARAN SUBMAIN DETAIL END
            });
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
            Route::get('kode_jabatan/index_json_bagian', 'KodeJabatanController@indexJsonByBagian')->name('index.json.bagian');
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

        // master pekerja START
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
                Route::get('pekerja/keluarga/index_json/{pekerja}', 'KeluargaController@indexJson')->name('index.json');
                Route::post('pekerja/keluarga/store/{pekerja}', 'KeluargaController@store')->name('store');
                Route::get('pekerja/keluarga/show_json', 'KeluargaController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/keluarga/update/{pekerja}/{status}/{nama}', 'KeluargaController@update')->name('update');
                Route::delete('pekerja/keluarga/delete', 'KeluargaController@delete')->name('delete');
            });

            // Route assigned name "pekerja.keluarga.index"...
            Route::name('jabatan.')->group(function () {
                Route::get('pekerja/jabatan/index_json/{pekerja}', 'JabatanController@indexJson')->name('index.json');
                Route::post('pekerja/jabatan/store/{pekerja}', 'JabatanController@store')->name('store');
                Route::get('pekerja/jabatan/show_json', 'JabatanController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/jabatan/update/{pekerja}/{status}/{nama}', 'JabatanController@update')->name('update');
                Route::delete('pekerja/jabatan/delete', 'JabatanController@delete')->name('delete');
            });

            // Route assigned name "pekerja.gaji_pokok.index"...
            Route::name('gaji_pokok.')->group(function () {
                Route::get('pekerja/gaji_pokok/index_json/{pekerja}', 'GajiPokokController@indexJson')->name('index.json');
                Route::post('pekerja/gaji_pokok/store/{pekerja}', 'GajiPokokController@store')->name('store');
                Route::get('pekerja/gaji_pokok/show_json', 'GajiPokokController@showJson')->name('show.json');
                Route::post('pekerja/gaji_pokok/update/{pekerja}/{nilai}', 'GajiPokokController@update')->name('update');
                Route::delete('pekerja/gaji_pokok/delete', 'GajiPokokController@delete')->name('delete');
            });

            // Route assigned name "pekerja.golongan_gaji.index"...
            Route::name('golongan_gaji.')->group(function () {
                Route::get('pekerja/golongan_gaji/index_json/{pekerja}', 'GolonganGajiController@indexJson')->name('index.json');
                Route::post('pekerja/golongan_gaji/store/{pekerja}', 'GolonganGajiController@store')->name('store');
                Route::get('golongan_gaji/show_json', 'GolonganGajiController@showJson')->name('show.json'); // get issue when combine with prefix pekerja
                Route::post('pekerja/golongan_gaji/update/{pekerja}/{golongan_gaji}/{tanggal}', 'GolonganGajiController@update')->name('update');
                Route::delete('pekerja/golongan_gaji/delete', 'GolonganGajiController@delete')->name('delete');
            });

            // Route assigned name "pekerja.kursus.index"...
            Route::name('kursus.')->group(function () {
                Route::get('pekerja/kursus/index_json/{pekerja}', 'KursusController@indexJson')->name('index.json');
                Route::post('pekerja/kursus/store/{pekerja}', 'KursusController@store')->name('store');
                Route::get('pekerja/kursus/show_json', 'KursusController@showJson')->name('show.json');
                Route::post('pekerja/kursus/update/{pekerja}/{mulai}/{nama}', 'KursusController@update')->name('update');
                Route::delete('pekerja/kursus/delete', 'KursusController@delete')->name('delete');
            });

            // Route assigned name "pekerja.pendidikan.index"...
            Route::name('pendidikan.')->group(function () {
                Route::get('pekerja/pendidikan/index_json/{pekerja}', 'PekerjaPendidikanController@indexJson')->name('index.json');
                Route::post('pekerja/pendidikan/store/{pekerja}', 'PekerjaPendidikanController@store')->name('store');
                Route::get('pekerja/pendidikan/show_json', 'PekerjaPendidikanController@showJson')->name('show.json');
                Route::post('pekerja/pendidikan/update/{pekerja}/{mulai}/{tempatdidik}/{kodedidik}', 'PekerjaPendidikanController@update')->name('update');
                Route::delete('pekerja/pendidikan/delete', 'PekerjaPendidikanController@delete')->name('delete');
            });

            // Route assigned name "pekerja.penghargaan.index"...
            Route::name('penghargaan.')->group(function () {
                Route::get('pekerja/penghargaan/index_json/{pekerja}', 'PenghargaanController@indexJson')->name('index.json');
                Route::post('pekerja/penghargaan/store/{pekerja}', 'PenghargaanController@store')->name('store');
                Route::get('pekerja/penghargaan/show_json', 'PenghargaanController@showJson')->name('show.json');
                Route::post('pekerja/penghargaan/update/{pekerja}/{tanggal}/{nama}', 'PenghargaanController@update')->name('update');
                Route::delete('pekerja/penghargaan/delete', 'PenghargaanController@delete')->name('delete');
            });

            // Route assigned name "pekerja.pengalaman_kerja.index"...
            Route::name('pengalaman_kerja.')->group(function () {
                Route::get('pekerja/pengalaman_kerja/index_json/{pekerja}', 'PengalamanKerjaController@indexJson')->name('index.json');
                Route::post('pekerja/pengalaman_kerja/store/{pekerja}', 'PengalamanKerjaController@store')->name('store');
                Route::get('pekerja/pengalaman_kerja/show_json', 'PengalamanKerjaController@showJson')->name('show.json');
                Route::post('pekerja/pengalaman_kerja/update/{pekerja}/{mulai}/{pangkat}', 'PengalamanKerjaController@update')->name('update');
                Route::delete('pekerja/pengalaman_kerja/delete', 'PengalamanKerjaController@delete')->name('delete');
            });

            // Route assigned name "pekerja.seminar.index"...
            Route::name('seminar.')->group(function () {
                Route::get('pekerja/seminar/index_json/{pekerja}', 'SeminarController@indexJson')->name('index.json');
                Route::post('pekerja/seminar/store/{pekerja}', 'SeminarController@store')->name('store');
                Route::get('pekerja/seminar/show_json', 'SeminarController@showJson')->name('show.json');
                Route::post('pekerja/seminar/update/{pekerja}/{mulai}', 'SeminarController@update')->name('update');
                Route::delete('pekerja/seminar/delete', 'SeminarController@delete')->name('delete');
            });

            // Route assigned name "pekerja.smk.index"...
            Route::name('smk.')->group(function () {
                Route::get('pekerja/smk/index_json/{pekerja}', 'SMKController@indexJson')->name('index.json');
                Route::post('pekerja/smk/store/{pekerja}', 'SMKController@store')->name('store');
                Route::get('pekerja/smk/show_json', 'SMKController@showJson')->name('show.json');
                Route::post('pekerja/smk/update/{pekerja}/{tahun}', 'SMKController@update')->name('update');
                Route::delete('pekerja/smk/delete', 'SMKController@delete')->name('delete');
            });

            // Route assigned name "pekerja.upah_tetap.index"...
            Route::name('upah_tetap.')->group(function () {
                Route::get('pekerja/upah_tetap/index_json/{pekerja}', 'UpahTetapController@indexJson')->name('index.json');
                Route::post('pekerja/upah_tetap/store/{pekerja}', 'UpahTetapController@store')->name('store');
                Route::get('pekerja/upah_tetap/show_json', 'UpahTetapController@showJson')->name('show.json');
                Route::post('pekerja/upah_tetap/update/{pekerja}/{nilai}', 'UpahTetapController@update')->name('update');
                Route::delete('pekerja/upah_tetap/delete', 'UpahTetapController@delete')->name('delete');
            });

            // Route assigned name "pekerja.upah_tetap.index"...
            Route::name('upah_tetap_pensiun.')->group(function () {
                Route::get('pekerja/upah_tetap_pensiun/index_json/{pekerja}', 'UpahTetapPensiunController@indexJson')->name('index.json');
                Route::post('pekerja/upah_tetap_pensiun/store/{pekerja}', 'UpahTetapPensiunController@store')->name('store');
                Route::get('pekerja/upah_tetap_pensiun/show_json', 'UpahTetapPensiunController@showJson')->name('show.json');
                Route::post('pekerja/upah_tetap_pensiun/update/{pekerja}/{nilai}', 'UpahTetapPensiunController@update')->name('update');
                Route::delete('pekerja/upah_tetap_pensiun/delete', 'UpahTetapPensiunController@delete')->name('delete');
            });

            // Route assigned name "pekerja.upah_all_in.index"...
            Route::name('upah_all_in.')->group(function () {
                Route::get('pekerja/upah_all_in/index_json/{pekerja}', 'UpahAllInController@indexJson')->name('index.json');
                Route::post('pekerja/upah_all_in/store/{pekerja}', 'UpahAllInController@store')->name('store');
                Route::get('pekerja/upah_all_in/show_json', 'UpahAllInController@showJson')->name('show.json');
                Route::post('pekerja/upah_all_in/update/{pekerja}/{nilai}', 'UpahAllInController@update')->name('update');
                Route::delete('pekerja/upah_all_in/delete', 'UpahAllInController@delete')->name('delete');
            });
        });
        // Master Pekerja END

        // Master Payroll START
        // Master Upah START
        // Route assigned name "upah.index"...
        Route::name('upah.')->group(function () {
            Route::get('upah', 'UpahMasterController@index')->name('index');
            Route::get('upah/index_json', 'UpahMasterController@indexJson')->name('index.json');
            Route::get('upah/create', 'UpahMasterController@create')->name('create');
            Route::post('upah/store', 'UpahMasterController@store')->name('store');
            Route::get('upah/edit/{tahun}/{bulan}/{nopek}/{aard}', 'UpahMasterController@edit')->name('edit');
            Route::post('upah/update/{tahun}/{bulan}/{nopek}/{aard}', 'UpahMasterController@update')->name('update');
            Route::delete('upah/delete', 'UpahMasterController@delete')->name('delete');
        });
        // Master Upah END
        
        // Master Insentif START
        Route::name('insentif.')->group(function () {
            Route::get('insentif', 'InsentifMasterController@index')->name('index');
            Route::get('insentif/index_json', 'InsentifMasterController@indexJson')->name('index.json');
            Route::get('insentif/create', 'InsentifMasterController@create')->name('create');
            Route::post('insentif/store', 'InsentifMasterController@store')->name('store');
            Route::get('insentif/edit/{tahun}/{bulan}/{nopek}/{aard}', 'InsentifMasterController@edit')->name('edit');
            Route::post('insentif/update/{tahun}/{bulan}/{nopek}/{aard}', 'InsentifMasterController@update')->name('update');
            Route::delete('insentif/delete', 'InsentifMasterController@delete')->name('delete');
        });
        // Master Insentif END

        // Master Hutang START
        Route::name('hutang.')->group(function () {
            Route::get('hutang', 'HutangMasterController@index')->name('index');
            Route::get('hutang/index_json', 'HutangMasterController@indexJson')->name('index.json');
            Route::get('hutang/create', 'HutangMasterController@create')->name('create');
            Route::post('hutang/store', 'HutangMasterController@store')->name('store');
            Route::get('hutang/edit/{tahun}/{bulan}/{nopek}/{aard}', 'HutangMasterController@edit')->name('edit');
            Route::post('hutang/update/{tahun}/{bulan}/{nopek}/{aard}', 'HutangMasterController@update')->name('update');
            Route::delete('hutang/delete', 'HutangMasterController@delete')->name('delete');
        });
        // Master Hutang END

        // Master Beban Perusahaan START
        Route::name('beban_perusahaan.')->group(function () {
            Route::get('beban_perusahaan', 'BebanPerusahaanMasterController@index')->name('index');
            Route::get('beban_perusahaan/index_json', 'BebanPerusahaanMasterController@indexJson')->name('index.json');
            Route::get('beban_perusahaan/create', 'BebanPerusahaanMasterController@create')->name('create');
            Route::post('beban_perusahaan/store', 'BebanPerusahaanMasterController@store')->name('store');
            Route::get('beban_perusahaan/edit/{tahun}/{bulan}/{nopek}/{aard}', 'BebanPerusahaanMasterController@edit')->name('edit');
            Route::post('beban_perusahaan/update/{tahun}/{bulan}/{nopek}/{aard}', 'BebanPerusahaanMasterController@update')->name('update');
            Route::delete('beban_perusahaan/delete', 'BebanPerusahaanMasterController@delete')->name('delete');
        });
        // Master Beban Perusahaan END

        // Master THR START
        Route::name('thr.')->group(function () {
            Route::get('thr', 'ThrMasterController@index')->name('index');
            Route::get('thr/index_json', 'ThrMasterController@indexJson')->name('index.json');
            Route::get('thr/create', 'ThrMasterController@create')->name('create');
            Route::post('thr/store', 'ThrMasterController@store')->name('store');
            Route::get('thr/edit/{tahun}/{bulan}/{nopek}/{aard}', 'ThrMasterController@edit')->name('edit');
            Route::post('thr/update/{tahun}/{bulan}/{nopek}/{aard}', 'ThrMasterController@update')->name('update');
            Route::delete('thr/delete', 'ThrMasterController@delete')->name('delete');
        });
        // Master THR END
        // Master Payroll END
        
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
            Route::get('potongan_koreksi_gaji/koreksi', 'PotonganKoreksiGajiController@ctkkoreksi')->name('ctkkoreksi');
            Route::post('potongan_koreksi_gaji/koreksi/export', 'PotonganKoreksiGajiController@koreksiExport')->name('koreksi.export');
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
            Route::get('lembur/ctkrekaplembur', 'LemburController@ctkrekaplembur')->name('ctkrekaplembur');
            Route::post('lembur/rekap/export', 'LemburController@rekapExport')->name('rekap.export');
        });
        //end lembur

        //pinjaman pekerja
        Route::name('pinjaman_pekerja.')->group(function () {
            Route::get('pinjaman_pekerja', 'PinjamanPekerjaController@index')->name('index');
            Route::post('pinjaman_pekerja/search', 'PinjamanPekerjaController@searchIndex')->name('search.index');
            Route::post('pinjaman_pekerja/idpinjaman/json', 'PinjamanPekerjaController@IdpinjamanJson')->name('idpinjaman.json');
            Route::get('pinjaman_pekerja/detail/json', 'PinjamanPekerjaController@detailJson')->name('detail.json');
            Route::get('pinjaman_pekerja/create', 'PinjamanPekerjaController@create')->name('create');
            Route::post('pinjaman_pekerja/store', 'PinjamanPekerjaController@store')->name('store');
            Route::get('pinjaman_pekerja/edit/{no}', 'PinjamanPekerjaController@edit')->name('edit');
            Route::post('pinjaman_pekerja/update', 'PinjamanPekerjaController@update')->name('update');
            Route::delete('pinjaman_pekerja/delete', 'PinjamanPekerjaController@delete')->name('delete');
        });
            
        //proses gaji
        // Route assigned name "proses_gaji.index"...
        Route::name('proses_gaji.')->group(function () {
            Route::get('proses_gaji', 'ProsesGajiController@index')->name('index');
            Route::post('proses_gaji/store', 'ProsesGajiController@store')->name('store');
            Route::get('proses_gaji/edit', 'ProsesGajiController@edit')->name('edit');
            Route::get('proses_gaji/slip/gaji', 'ProsesGajiController@slipGaji')->name('slipGaji');
            Route::post('proses_gaji/cetak/slipgaji', 'ProsesGajiController@cetak_slipgaji')->name('cetak_slipgaji');
            Route::get('proses_gaji/ctkrekapgaji', 'ProsesGajiController@ctkrekapgaji')->name('ctkrekapgaji');
            Route::post('proses_gaji/rekap/export', 'ProsesGajiController@rekapExport')->name('rekap.export');
            Route::get('proses_gaji/daftar/upah', 'ProsesGajiController@ctkdaftarupah')->name('ctkdaftarupah');
            Route::post('proses_gaji/daftar/upah/export', 'ProsesGajiController@daftarExport')->name('daftar.export');
        });
        //end proses_gaji

        //proses thr
        // Route assigned name "proses_thr.index"...
        Route::name('proses_thr.')->group(function () {
            Route::get('proses_thr', 'ProsesThrController@index')->name('index');
            Route::post('proses_thr/store', 'ProsesThrController@store')->name('store');
            Route::get('proses_thr/edit', 'ProsesThrController@edit')->name('edit');
            Route::get('proses_thr/ctkslipthr', 'ProsesThrController@ctkslipthr')->name('ctkslipthr');
            Route::post('proses_thr/cetak/slipgaji', 'ProsesThrController@cetak_slipthr')->name('cetak_slipthr');
            Route::get('proses_thr/ctkrekapthr', 'ProsesThrController@ctkrekapthr')->name('ctkrekapthr');
            Route::post('proses_thr/rekap/export', 'ProsesThrController@rekapExport')->name('rekap.export');
        });
        //end proses_thr

        //proses insentif
        // Route assigned name "proses_insentif.index"...
        Route::name('proses_insentif.')->group(function () {
            Route::get('proses_insentif', 'ProsesInsentifController@index')->name('index');
            Route::post('proses_insentif/store', 'ProsesInsentifController@store')->name('store');
            Route::get('proses_insentif/edit', 'ProsesInsentifController@edit')->name('edit');
            Route::get('proses_insentif/ctkslipinsentif', 'ProsesInsentifController@ctkslipinsentif')->name('ctkslipinsentif');
            Route::post('proses_insentif/cetak/slipinsentif', 'ProsesInsentifController@cetak_slipinsentif')->name('cetak_slipinsentif');
            Route::get('proses_insentif/ctkrekapinsentif', 'ProsesInsentifController@ctkrekapinsentif')->name('ctkrekapinsentif');
            Route::post('proses_insentif/rekap/export', 'ProsesInsentifController@rekapExport')->name('rekap.export');
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

        //Jenis Upah
        // Route assigned name "jenis_upah.index"...
        Route::name('jenis_upah.')->group(function () {
            Route::get('jenis_upah', 'JenisUpahController@index')->name('index');
            Route::get('jenis_upah/index_json', 'JenisUpahController@indexJson')->name('index.json');
            Route::get('jenis_upah/create', 'JenisUpahController@create')->name('create');
            Route::post('jenis_upah/cek_golongan/json', 'JenisUpahController@cekGolonganJson')->name('golongan.json');
            Route::post('jenis_upah/store', 'JenisUpahController@store')->name('store');
            Route::get('jenis_upah/edit/{id}', 'JenisUpahController@edit')->name('edit');
            Route::post('jenis_upah/update', 'JenisUpahController@update')->name('update');
            Route::delete('jenis_upah/delete', 'JenisUpahController@delete')->name('delete');
        });
        //end jenis_upah


        //Rekening Pekerja
        // Route assigned name "rekening_pekerja.index"...
        Route::name('rekening_pekerja.')->group(function () {
            Route::get('rekening_pekerja', 'RekeningPekerjaController@index')->name('index');
            Route::get('rekening_pekerja/index_json', 'RekeningPekerjaController@indexJson')->name('index.json');
            Route::get('rekening_pekerja/create', 'RekeningPekerjaController@create')->name('create');
            Route::post('rekening_pekerja/cek_golongan/json', 'RekeningPekerjaController@cekGolonganJson')->name('golongan.json');
            Route::post('rekening_pekerja/store', 'RekeningPekerjaController@store')->name('store');
            Route::get('rekening_pekerja/edit/{id}', 'RekeningPekerjaController@edit')->name('edit');
            Route::post('rekening_pekerja/update', 'RekeningPekerjaController@update')->name('update');
            Route::delete('rekening_pekerja/delete', 'RekeningPekerjaController@delete')->name('delete');
        });
        //end rekening_pekerja

        //Tabel AARD
        // Route assigned name "tabel_aard.index"...
        Route::name('tabel_aard.')->group(function () {
            Route::get('tabel_aard', 'TabelAardController@index')->name('index');
            Route::get('tabel_aard/index_json', 'TabelAardController@indexJson')->name('index.json');
            Route::get('tabel_aard/create', 'TabelAardController@create')->name('create');
            Route::post('tabel_aard/cek_golongan/json', 'TabelAardController@cekGolonganJson')->name('golongan.json');
            Route::post('tabel_aard/store', 'TabelAardController@store')->name('store');
            Route::get('tabel_aard/edit/{id}', 'TabelAardController@edit')->name('edit');
            Route::post('tabel_aard/update', 'TabelAardController@update')->name('update');
            Route::delete('tabel_aard/delete', 'TabelAardController@delete')->name('delete');
        });
        //end tabel_aard

        //Master Bank
        // Route assigned name "master_bank.index"...
        Route::name('master_bank.')->group(function () {
            Route::get('master_bank', 'MasterBankController@index')->name('index');
            Route::get('master_bank/index_json', 'MasterBankController@indexJson')->name('index.json');
            Route::get('master_bank/create', 'MasterBankController@create')->name('create');
            Route::post('master_bank/cek_golongan/json', 'MasterBankController@cekGolonganJson')->name('golongan.json');
            Route::post('master_bank/store', 'MasterBankController@store')->name('store');
            Route::get('master_bank/edit/{id}', 'MasterBankController@edit')->name('edit');
            Route::post('master_bank/update', 'MasterBankController@update')->name('update');
            Route::delete('master_bank/delete', 'MasterBankController@delete')->name('delete');
        });
        //end master_bank

        //Master ptkp
        // Route assigned name "master_ptkp.index"...
        Route::name('master_ptkp.')->group(function () {
            Route::get('master_ptkp', 'MasterPtkpController@index')->name('index');
            Route::get('master_ptkp/index_json', 'MasterPtkpController@indexJson')->name('index.json');
            Route::get('master_ptkp/create', 'MasterPtkpController@create')->name('create');
            Route::post('master_ptkp/cek_golongan/json', 'MasterPtkpController@cekGolonganJson')->name('golongan.json');
            Route::post('master_ptkp/store', 'MasterPtkpController@store')->name('store');
            Route::get('master_ptkp/edit/{id}', 'MasterPtkpController@edit')->name('edit');
            Route::post('master_ptkp/update', 'MasterPtkpController@update')->name('update');
            Route::delete('master_ptkp/delete', 'MasterPtkpController@delete')->name('delete');
        });
        //end master_ptkp

        //Master Tabungan
        // Route assigned name "master_tabungan.index"...
        Route::name('master_tabungan.')->group(function () {
            Route::get('master_tabungan', 'MasterTabunganController@index')->name('index');
            Route::get('master_tabungan/index_json', 'MasterTabunganController@indexJson')->name('index.json');
            Route::get('master_tabungan/create', 'MasterTabunganController@create')->name('create');
            Route::post('master_tabungan/cek_golongan/json', 'MasterTabunganController@cekGolonganJson')->name('golongan.json');
            Route::post('master_tabungan/store', 'MasterTabunganController@store')->name('store');
            Route::get('master_tabungan/edit/{id}', 'MasterTabunganController@edit')->name('edit');
            Route::post('master_tabungan/update', 'MasterTabunganController@update')->name('update');
            Route::delete('master_tabungan/delete', 'MasterTabunganController@delete')->name('delete');
        });
        //end master_ptkp

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
            Route::get('jamsostek/ctkiuranjs', 'JamsostekController@ctkiuranjs')->name('ctkiuranjs');
            Route::post('jamsostek/rekap/export', 'JamsostekController@rekapExport')->name('rekap.export');
            Route::get('jamsostek/ctkrekapiuranjamsostek', 'JamsostekController@ctkrekapiuranjamsostek')->name('ctkrekapiuranjamsostek');
            Route::post('jamsostek/rekapiuran/export', 'JamsostekController@rekapIuranExport')->name('rekapiuran.export');
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
            Route::get('pensiun/ctkiuranpensiun', 'PensiunController@ctkiuranpensiun')->name('ctkiuranpensiun');
            Route::post('pensiun/rekap/export', 'PensiunController@rekapExport')->name('rekap.export');
            Route::get('pensiun/ctkrekapiuranpensiun', 'PensiunController@ctkrekapiuranpensiun')->name('ctkrekapiuranpensiun');
            Route::post('pensiun/rekapiuran/export', 'PensiunController@rekapIuranExport')->name('rekapiuran.export');
        });
        //end pensiun
        

        //proses report sdm payroll
        Route::get('report_sdm_payroll', 'ReportSdmPayrollController@index')->name('report_sdm_payroll.index');
        Route::get('report_sdm_payroll/create', 'ReportSdmPayrollController@create')->name('report_sdm_payroll.create');
        Route::get('report_sdm_payroll/edit', 'ReportSdmPayrollController@edit')->name('report_sdm_payroll.edit');
        
        //absensi karyawan
        Route::get('absensi_karyawan', 'AbsensiKaryawanController@index')->name('absensi_karyawan.index');
        Route::get('absensi_karyawan/download', 'AbsensiKaryawanController@download')->name('absensi_karyawan.download');
        //absensi karyawan


        // GCG
        // Route assigned name "gcg.index"...
        Route::name('gcg.')->group(function () {
            Route::get('gcg', 'GcgController@index')->name('index');

            Route::get('gcg/coc', 'GcgCocController@index')->name('coc.lampiran_satu');
            Route::get('gcg/coc/lampiran_satu_print', 'GcgCocController@lampiranSatuPrint')->name('coc.lampiran_satu.print');
            Route::get('gcg/coc/lampiran_dua', 'GcgCocController@lampiranDua')->name('coc.lampiran_dua');
            Route::get('gcg/coc/lampiran_dua_print', 'GcgCocController@lampiranDuaPrint')->name('coc.lampiran_dua.print');
            
            Route::get('gcg/coi', 'GcgCoiController@index')->name('coi.lampiran_satu');
            Route::get('gcg/coi/lampiran_dua', 'GcgCoiController@lampiranDua')->name('coi.lampiran_dua');

            Route::get('gcg/gratifikasi', 'GcgGratifikasiController@index')->name('gratifikasi.index');

            Route::get('gcg/sosialisasi', 'GcgSosialisasiController@index')->name('sosialisasi.index');

            Route::get('gcg/lhkpn', 'GcgLhkpnController@index')->name('lhkpn.index');
            
            Route::get('gcg/report_boundary', 'GcgReportBoundaryController@index')->name('report_boundary.index');
        });
        //end GCG
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
            Route::post('informasi_saldo/index/json', 'InformasiSaldoController@indexJson')->name('index.json');
            Route::get('informasi_saldo/create', 'InformasiSaldoController@create')->name('create');
            Route::post('informasi_saldo/store', 'InformasiSaldoController@store')->name('store');
            Route::get('informasi_saldo/edit/{bulan}/{tahun}/{nopek}', 'InformasiSaldoController@edit')->name('edit');
            Route::post('informasi_saldo/update', 'InformasiSaldoController@update')->name('update');
            Route::delete('informasi_saldo/delete', 'InformasiSaldoController@delete')->name('delete');
        });
        //end informasi_saldo

        //bulan_perbendaharaan
        // Route assigned name "bulan_perbendaharaan.index"...
        Route::name('bulan_perbendaharaan.')->group(function () {
            Route::get('bulan_perbendaharaan', 'BulanPerbendaharaanController@index')->name('index');
            Route::post('bulan_perbendaharaan/index/search', 'BulanPerbendaharaanController@searchIndex')->name('search.index');
            Route::get('bulan_perbendaharaan/create', 'BulanPerbendaharaanController@create')->name('create');
            Route::get('bulan_perbendaharaan/store', 'BulanPerbendaharaanController@store')->name('store');
            Route::get('bulan_perbendaharaan/edit/{no}', 'BulanPerbendaharaanController@edit')->name('edit');
            Route::post('bulan_perbendaharaan/update', 'BulanPerbendaharaanController@update')->name('update');
            Route::delete('bulan_perbendaharaan/delete', 'BulanPerbendaharaanController@delete')->name('delete');
        });
        //end bulan_perbendaharaan

        //opening_balance
        // Route assigned name "opening_balance.index"...
        Route::name('opening_balance.')->group(function () {
            Route::get('opening_balance', 'OpeningBalanceController@index')->name('index');
            Route::post('opening_balance/index/search', 'OpeningBalanceController@searchIndex')->name('search.index');
            Route::get('opening_balance/create', 'OpeningBalanceController@create')->name('create');
            Route::post('opening_balance/store', 'OpeningBalanceController@store')->name('store');
            Route::get('opening_balance/edit/{no}', 'OpeningBalanceController@edit')->name('edit');
            Route::post('opening_balance/update', 'OpeningBalanceController@update')->name('update');
        });
        //end opening_balance

        //Penempatan deposito
        // Route assigned name "penempatan_deposito.index"...
        Route::name('penempatan_deposito.')->group(function () {
            Route::get('penempatan_deposito', 'PenempatanDepositoController@index')->name('index');
            Route::post('penempatan_deposito/search', 'PenempatanDepositoController@searchIndex')->name('search.index');
            Route::post('penempatan_deposito/lineno/json', 'PenempatanDepositoController@linenoJson')->name('linenoJson');
            Route::post('penempatan_deposito/kurs/json', 'PenempatanDepositoController@kursJson')->name('kursJson');
            Route::post('penempatan_deposito/kdbank/json', 'PenempatanDepositoController@kdbankJson')->name('kdbankJson');
            Route::post('penempatan_deposito/nokas/json', 'PenempatanDepositoController@nokasJson')->name('nokas.json');
            Route::get('penempatan_deposito/create', 'PenempatanDepositoController@create')->name('create');
            Route::post('penempatan_deposito/store', 'PenempatanDepositoController@store')->name('store');
            Route::get('penempatan_deposito/edit/{nodok}/{lineno}/{pjg}', 'PenempatanDepositoController@edit')->name('edit');
            Route::post('penempatan_deposito/update', 'PenempatanDepositoController@update')->name('update');
            Route::delete('penempatan_deposito/delete', 'PenempatanDepositoController@delete')->name('delete');
            Route::get('penempatan_deposito/depopjg/{nodok}/{lineno}/{pjg}', 'PenempatanDepositoController@depopjg')->name('depopjg');
            Route::post('penempatan_deposito/updatedepopjg', 'PenempatanDepositoController@updatedepopjg')->name('updatedepopjg');
            Route::get('penempatan_deposito/rekap', 'PenempatanDepositoController@rekap')->name('rekap');
            Route::post('penempatan_deposito/ctkdepo', 'PenempatanDepositoController@ctkdepo')->name('ctkdepo');
            Route::get('penempatan_deposito/rekaprc/{no}/{id}', 'PenempatanDepositoController@rekaprc')->name('rekaprc');
        });
        //end penempatan_deposito

        //pembayaran_gaji
        // Route assigned name "pembayaran_gaji.index"...
        Route::name('pembayaran_gaji.')->group(function () {
            Route::get('pembayaran_gaji', 'PembayaranGajiController@index')->name('index');
            Route::post('pembayaran_gaji/search', 'PembayaranGajiController@searchIndex')->name('search.index');
            Route::get('pembayaran_gaji/create', 'PembayaranGajiController@create')->name('create');
            Route::post('pembayaran_gaji/create/json', 'PembayaranGajiController@createJson')->name('createJson');
            Route::post('pembayaran_gaji/lokasi/json', 'PembayaranGajiController@lokasiJson')->name('lokasiJson');
            Route::post('pembayaran_gaji/nobukti/json', 'PembayaranGajiController@nobuktiJson')->name('nobuktiJson');
            Route::post('pembayaran_gaji/store', 'PembayaranGajiController@store')->name('store');
            Route::post('pembayaran_gaji/store_detail', 'PembayaranGajiController@storeDetail')->name('store.detail');
            Route::post('pembayaran_gaji/store_app', 'PembayaranGajiController@storeApp')->name('store.app');
            Route::get('pembayaran_gaji/edit/{no}', 'PembayaranGajiController@edit')->name('edit');
            Route::get('pembayaran_gaji/editdetail/{id}/{no}', 'PembayaranGajiController@editDetail')->name('edit.detail');
            Route::post('pembayaran_gaji/update', 'PembayaranGajiController@update')->name('update');
            Route::post('pembayaran_gaji/update/detail', 'PembayaranGajiController@updateDetail')->name('update.detail');
            Route::delete('pembayaran_gaji/delete', 'PembayaranGajiController@delete')->name('delete');
            Route::delete('pembayaran_gaji/deletedetail', 'PembayaranGajiController@deleteDetail')->name('delete.detail');
            Route::delete('pembayaran_gaji/deletedetail/all', 'PembayaranGajiController@deleteDetailall')->name('delete.detail.all');
            Route::get('pembayaran_gaji/approv/{id}/{status}', 'PembayaranGajiController@approv')->name('approv');
        });
        //end pembayaran_gaji

        //pembayaran_umk
        // Route assigned name "pembayaran_umk.index"...
        Route::name('pembayaran_umk.')->group(function () {
            Route::get('pembayaran_umk', 'PembayaranUmkController@index')->name('index');
            Route::post('pembayaran_umk/search', 'PembayaranUmkController@searchIndex')->name('search.index');
            Route::get('pembayaran_umk/create', 'PembayaranUmkController@create')->name('create');
            Route::post('pembayaran_umk/create/json', 'PembayaranUmkController@createJson')->name('createJson');
            Route::post('pembayaran_umk/lokasi/json', 'PembayaranUmkController@lokasiJson')->name('lokasiJson');
            Route::post('pembayaran_umk/nobukti/json', 'PembayaranUmkController@nobuktiJson')->name('nobuktiJson');
            Route::post('pembayaran_umk/store', 'PembayaranUmkController@store')->name('store');
            Route::post('pembayaran_umk/store_detail', 'PembayaranUmkController@storeDetail')->name('store.detail');
            Route::post('pembayaran_umk/store_app', 'PembayaranUmkController@storeApp')->name('store.app');
            Route::get('pembayaran_umk/edit/{no}', 'PembayaranUmkController@edit')->name('edit');
            Route::get('pembayaran_umk/editdetail/{id}/{no}', 'PembayaranUmkController@editDetail')->name('edit.detail');
            Route::post('pembayaran_umk/update', 'PembayaranUmkController@update')->name('update');
            Route::post('pembayaran_umk/update/detail', 'PembayaranUmkController@updateDetail')->name('update.detail');
            Route::delete('pembayaran_umk/delete', 'PembayaranUmkController@delete')->name('delete');
            Route::delete('pembayaran_umk/deletedetail', 'PembayaranUmkController@deleteDetail')->name('delete.detail');
            Route::delete('pembayaran_umk/deletedetail/all', 'PembayaranUmkController@deleteDetailall')->name('delete.detail.all');
            Route::get('pembayaran_umk/approv/{id}/{status}', 'PembayaranUmkController@approv')->name('approv');
        });
        //end pembayaran_umk


        //pembayaran_jumk
        // Route assigned name "pembayaran_jumk.index"...
        Route::name('pembayaran_jumk.')->group(function () {
            Route::get('pembayaran_jumk', 'PembayaranJumkController@index')->name('index');
            Route::post('pembayaran_jumk/search', 'PembayaranJumkController@searchIndex')->name('search.index');
            Route::get('pembayaran_jumk/create', 'PembayaranJumkController@create')->name('create');
            Route::post('pembayaran_jumk/create/json', 'PembayaranJumkController@createJson')->name('createJson');
            Route::post('pembayaran_jumk/lokasi/json', 'PembayaranJumkController@lokasiJson')->name('lokasiJson');
            Route::post('pembayaran_jumk/nobukti/json', 'PembayaranJumkController@nobuktiJson')->name('nobuktiJson');
            Route::post('pembayaran_jumk/store', 'PembayaranJumkController@store')->name('store');
            Route::post('pembayaran_jumk/store_detail', 'PembayaranJumkController@storeDetail')->name('store.detail');
            Route::post('pembayaran_jumk/store_app', 'PembayaranJumkController@storeApp')->name('store.app');
            Route::get('pembayaran_jumk/edit/{no}', 'PembayaranJumkController@edit')->name('edit');
            Route::get('pembayaran_jumk/editdetail/{id}/{no}', 'PembayaranJumkController@editDetail')->name('edit.detail');
            Route::post('pembayaran_jumk/update', 'PembayaranJumkController@update')->name('update');
            Route::post('pembayaran_jumk/update/detail', 'PembayaranJumkController@updateDetail')->name('update.detail');
            Route::delete('pembayaran_jumk/delete', 'PembayaranJumkController@delete')->name('delete');
            Route::delete('pembayaran_jumk/deletedetail', 'PembayaranJumkController@deleteDetail')->name('delete.detail');
            Route::delete('pembayaran_jumk/deletedetail/all', 'PembayaranJumkController@deleteDetailall')->name('delete.detail.all');
            Route::get('pembayaran_jumk/approv/{id}/{status}', 'PembayaranJumkController@approv')->name('approv');
        });
        //end pembayaran_jumk

        //pembayaran_pbayar
        // Route assigned name "pembayaran_pbayar.index"...
        Route::name('pembayaran_pbayar.')->group(function () {
            Route::get('pembayaran_pbayar', 'PembayaranPbayarController@index')->name('index');
            Route::post('pembayaran_pbayar/search', 'PembayaranPbayarController@searchIndex')->name('search.index');
            Route::get('pembayaran_pbayar/create', 'PembayaranPbayarController@create')->name('create');
            Route::post('pembayaran_pbayar/create/json', 'PembayaranPbayarController@createJson')->name('createJson');
            Route::post('pembayaran_pbayar/lokasi/json', 'PembayaranPbayarController@lokasiJson')->name('lokasiJson');
            Route::post('pembayaran_pbayar/nobukti/json', 'PembayaranPbayarController@nobuktiJson')->name('nobuktiJson');
            Route::post('pembayaran_pbayar/store', 'PembayaranPbayarController@store')->name('store');
            Route::post('pembayaran_pbayar/store_detail', 'PembayaranPbayarController@storeDetail')->name('store.detail');
            Route::post('pembayaran_pbayar/store_app', 'PembayaranPbayarController@storeApp')->name('store.app');
            Route::get('pembayaran_pbayar/edit/{no}', 'PembayaranPbayarController@edit')->name('edit');
            Route::get('pembayaran_pbayar/editdetail/{id}/{no}', 'PembayaranPbayarController@editDetail')->name('edit.detail');
            Route::post('pembayaran_pbayar/update', 'PembayaranPbayarController@update')->name('update');
            Route::post('pembayaran_pbayar/update/detail', 'PembayaranPbayarController@updateDetail')->name('update.detail');
            Route::delete('pembayaran_pbayar/delete', 'PembayaranPbayarController@delete')->name('delete');
            Route::delete('pembayaran_pbayar/deletedetail', 'PembayaranPbayarController@deleteDetail')->name('delete.detail');
            Route::delete('pembayaran_pbayar/deletedetail/all', 'PembayaranPbayarController@deleteDetailall')->name('delete.detail.all');
            Route::get('pembayaran_pbayar/approv/{id}/{status}', 'PembayaranPbayarController@approv')->name('approv');
        });
        //end pembayaran_pbayar

        //Rekap Harian Kas
        // Route assigned name "rekap_harian_kas.index"...
        Route::name('rekap_harian_kas.')->group(function () {
            Route::get('rekap_harian_kas', 'RekapHarianKasController@index')->name('index');
            Route::post('rekap_harian_kas/search', 'RekapHarianKasController@searchIndex')->name('search.index');
            Route::post('rekap_harian_kas/jeniskartu/json', 'RekapHarianKasController@JeniskaruJson')->name('jenis.kartu.json');
            Route::post('rekap_harian_kas/nokas/json', 'RekapHarianKasController@NokasJson')->name('nokas.json');
            Route::get('rekap_harian_kas/create', 'RekapHarianKasController@create')->name('create');
            Route::post('rekap_harian_kas/store', 'RekapHarianKasController@store')->name('store');
            Route::get('rekap_harian_kas/edit/{no}/{id}/{tgl}', 'RekapHarianKasController@edit')->name('edit');
            Route::post('rekap_harian_kas/update', 'RekapHarianKasController@update')->name('update');
            Route::delete('rekap_harian_kas/delete', 'RekapHarianKasController@delete')->name('delete');
            Route::get('rekap_harian_kas/rekap/{no}/{id}/{tanggal}', 'RekapHarianKasController@RekapHarian')->name('rekap');
            Route::post('rekap_harian_kas/ctkharian', 'RekapHarianKasController@CtkHarian')->name('ctkharian');
        });
        //end rekap_harian_kas


        //Report Kas Kas Bank
        // Route assigned name "report_kas_bank.index"...
        Route::name('kas_bank.')->group(function () {
            Route::get('kas_bank/report/create1', 'KasCashJudexController@Create1')->name('create1');
            Route::post('kas_bank/report/cetak1', 'KasCashJudexController@cetak1')->name('cetak1');
            Route::get('kas_bank/report/create2', 'KasCashJudexController@Create2')->name('create2');
            Route::post('kas_bank/report/cetak2', 'KasCashJudexController@Cetak2')->name('cetak2');
            Route::get('kas_bank/report/create3', 'KasCashJudexController@Create3')->name('create3');
            Route::post('kas_bank/report/cetak3', 'KasCashJudexController@Cetak3')->name('cetak3');
            Route::get('kas_bank/report/create4', 'KasCashJudexController@Create4')->name('create4');
            Route::post('kas_bank/report/cetak4', 'KasCashJudexController@Cetak4')->name('cetak4');
            Route::get('kas_bank/report/create5', 'KasCashJudexController@Create5')->name('create5');
            Route::post('kas_bank/report/cetak5', 'KasCashJudexController@Cetak5')->name('cetak5');
            Route::get('kas_bank/report/create6', 'KasCashJudexController@Create6')->name('create6');
            Route::post('kas_bank/report/cetak6', 'KasCashJudexController@Cetak6')->name('cetak6');
        });
        //end report_kas_bank
    });

    //Kontroler
    Route::prefix('kontroler')->group(function () {

        //jurnam_umum
        // Route assigned name "jurnal_umum.index"...
        Route::name('jurnal_umum.')->group(function () {
            Route::get('jurnal_umum', 'JurnalUmumController@index')->name('index');
            Route::post('jurnal_umum/search', 'JurnalUmumController@searchIndex')->name('search.index');
            Route::get('jurnal_umum/create', 'JurnalUmumController@create')->name('create');
            Route::post('jurnal_umum/store', 'JurnalUmumController@store')->name('store');
            Route::get('jurnal_umum/edit/{no}', 'JurnalUmumController@edit')->name('edit');
            Route::post('jurnal_umum/update', 'JurnalUmumController@update')->name('update');
            Route::delete('jurnal_umum/delete', 'JurnalUmumController@delete')->name('delete');
            Route::get('jurnal_umum/editdetail/{no}/{id}', 'JurnalUmumController@editDetail')->name('editdetail');
            Route::post('jurnal_umum/update/detail', 'JurnalUmumController@updateDetail')->name('update.detail');
            Route::delete('jurnal_umum/delete/detail', 'JurnalUmumController@deleteDetail')->name('delete.detail');
            Route::get('jurnal_umum/copy', 'JurnalUmumController@cpyjurnalumum')->name('cpyjurnalumum');
            Route::post('jurnal_umum/store/detail', 'JurnalUmumController@storeDetail')->name('store.detail');
            Route::get('jurnal_umum/posting/{no}/{status}', 'JurnalUmumController@posting')->name('posting');
            Route::post('jurnal_umum/store/posting', 'JurnalUmumController@storePosting')->name('store.posting');
            Route::get('jurnal_umum/copy/{no}', 'JurnalUmumController@copy')->name('copy');
            Route::post('jurnal_umum/store/copy', 'JurnalUmumController@storeCopy')->name('store.copy');
        });
        //end jurnam_umum


        //postingan Kas Bank
        // Route assigned name "postingan_kas_bank.index"...
        Route::name('postingan_kas_bank.')->group(function () {
            Route::get('postingan_kas_bank', 'PostingKasBankController@index')->name('index');
            Route::get('postingan_kas_bank/verkas/{no}/{id}', 'PostingKasBankController@verkas')->name('verkas');
            Route::get('postingan_kas_bank/verkass', 'PostingKasBankController@verkass')->name('verkass');
            Route::get('postingan_kas_bank/verkas/json', 'PostingKasBankController@verkasJson')->name('verkasjson');
            Route::get('postingan_kas_bank/editdetail/{no}/{id}', 'PostingKasBankController@editdetail')->name('editdetail');
            Route::get('postingan_kas_bank/prsposting', 'PostingKasBankController@prsposting')->name('prsposting');
            Route::get('postingan_kas_bank/btlposting', 'PostingKasBankController@btlposting')->name('btlposting');
            Route::post('postingan_kas_bank/search', 'PostingKasBankController@searchIndex')->name('search.index');
            Route::post('postingan_kas_bank/store/verkas', 'PostingKasBankController@store')->name('store.verkas');
            Route::post('postingan_kas_bank/verifikasi', 'PostingKasBankController@verifikasi')->name('verifikasi');
            Route::post('postingan_kas_bank/store/detail', 'PostingKasBankController@storeDetail')->name('store.detail');
            Route::post('postingan_kas_bank/update/detail', 'PostingKasBankController@updateDetail')->name('update.detail');
            Route::post('postingan_kas_bank/store/prsposting', 'PostingKasBankController@storePrsposting')->name('store.prsposting');
            Route::post('postingan_kas_bank/store/btlposting', 'PostingKasBankController@storeBtlposting')->name('store.btlposting');
            Route::delete('postingan_kas_bank/delete/detail', 'PostingKasBankController@deleteDetail')->name('delete.detail');
        });
        //end postingan Kas Bank


        //Master Perusahaan
        // Route assigned name "master_perusahaan.index"...
        Route::name('master_perusahaan.')->group(function () {
            Route::get('master_perusahaan', 'MasterPerusahaanController@index')->name('index');
            Route::get('master_perusahaan/index/json', 'MasterPerusahaanController@indexJson')->name('index.json');
            Route::get('master_perusahaan/create', 'MasterPerusahaanController@create')->name('create');
            Route::post('master_perusahaan/store', 'MasterPerusahaanController@store')->name('store');
            Route::get('master_perusahaan/edit/{kode}', 'MasterPerusahaanController@edit')->name('edit');
            Route::post('master_perusahaan/update', 'MasterPerusahaanController@update')->name('update');
            Route::delete('master_perusahaan/delete', 'MasterPerusahaanController@delete')->name('delete');
        });
        //end Master Perusahaan


        //Master unit
        // Route assigned name "master_unit.index"...
        Route::name('master_unit.')->group(function () {
            Route::get('master_unit', 'MasterUnitController@index')->name('index');
            Route::get('master_unit/index/json', 'MasterUnitController@indexJson')->name('index.json');
            Route::get('master_unit/create', 'MasterUnitController@create')->name('create');
            Route::post('master_unit/store', 'MasterUnitController@store')->name('store');
            Route::get('master_unit/edit/{kode}', 'MasterUnitController@edit')->name('edit');
            Route::post('master_unit/update', 'MasterUnitController@update')->name('update');
            Route::delete('master_unit/delete', 'MasterUnitController@delete')->name('delete');
        });
        //end Master unit


        //Master Pekerja
        // Route assigned name "master_pekerja.index"...
        Route::name('master_pekerja.')->group(function () {
            Route::get('master_pekerja', 'MasterPekerjaController@index')->name('index');
            Route::get('master_pekerja/index/json', 'MasterPekerjaController@indexJson')->name('index.json');
            Route::get('master_pekerja/create', 'MasterPekerjaController@create')->name('create');
            Route::post('master_pekerja/store', 'MasterPekerjaController@store')->name('store');
            Route::get('master_pekerja/edit/{kode}', 'MasterPekerjaController@edit')->name('edit');
            Route::post('master_pekerja/update', 'MasterPekerjaController@update')->name('update');
            Route::delete('master_pekerja/delete', 'MasterPekerjaController@delete')->name('delete');
        });
        //end Master Pekerja



        //cetak_kas_bank
        // Route assigned name "cetak_kas_bank.index"...
        Route::name('cetak_kas_bank.')->group(function () {
            Route::get('cetak_kas_bank', 'KasBankKontrolerController@indexCetak')->name('index');
            Route::post('cetak_kas_bank/index/search', 'KasBankKontrolerController@searchIndexCetak')->name('search.cetak.index');
        });
        //end cetak_kas_bank

        //tabel_deposito
        // Route assigned name "tabel_deposito.index"...
        Route::name('tabel_deposito.')->group(function () {
            Route::get('tabel_deposito', 'TabelDepositoController@index')->name('index');
            Route::post('tabel_deposito/index/search', 'TabelDepositoController@searchIndex')->name('search.index');
        });
        //end tabel_deposito


        //cash_judex
        // Route assigned name "cash_judex.index"...
        Route::name('cash_judex.')->group(function () {
            Route::get('cash_judex', 'CashJudexController@index')->name('index');
            Route::post('cash_judex/index/search', 'CashJudexController@searchIndex')->name('search.index');
            Route::get('cash_judex/create', 'CashJudexController@create')->name('create');
            Route::post('cash_judex/store', 'CashJudexController@store')->name('store');
            Route::get('cash_judex/edit/{no}', 'CashJudexController@edit')->name('edit');
            Route::post('cash_judex/update', 'CashJudexController@update')->name('update');
            Route::delete('cash_judex/delete', 'CashJudexController@delete')->name('delete');
        });
        //end cash_judex


        //jenis_biaya
        // Route assigned name "jenis_biaya.index"...
        Route::name('jenis_biaya.')->group(function () {
            Route::get('jenis_biaya', 'JenisBiayaController@index')->name('index');
            Route::post('jenis_biaya/index/search', 'JenisBiayaController@searchIndex')->name('search.index');
            Route::get('jenis_biaya/create', 'JenisBiayaController@create')->name('create');
            Route::post('jenis_biaya/store', 'JenisBiayaController@store')->name('store');
            Route::get('jenis_biaya/edit/{no}', 'JenisBiayaController@edit')->name('edit');
            Route::post('jenis_biaya/update', 'JenisBiayaController@update')->name('update');
            Route::delete('jenis_biaya/delete', 'JenisBiayaController@delete')->name('delete');
        });
        //end jenis_biaya
        
        //kas_bank_kontroler
        // Route assigned name "kas_bank_kontroler.index"...
        Route::name('kas_bank_kontroler.')->group(function () {
            Route::get('kas_bank_kontroler', 'KasBankKontrolerController@index')->name('index');
            Route::post('kas_bank_kontroler/index/search', 'KasBankKontrolerController@searchIndex')->name('search.index');
            Route::get('kas_bank_kontroler/create', 'KasBankKontrolerController@create')->name('create');
            Route::post('kas_bank_kontroler/store', 'KasBankKontrolerController@store')->name('store');
            Route::get('kas_bank_kontroler/edit/{no}', 'KasBankKontrolerController@edit')->name('edit');
            Route::post('kas_bank_kontroler/update', 'KasBankKontrolerController@update')->name('update');
            Route::delete('kas_bank_kontroler/delete', 'KasBankKontrolerController@delete')->name('delete');
        });
        //end kas_bank_kontroler
        
        //lokasi_kontroler
        // Route assigned name "lokasi_kontroler.index"...
        Route::name('lokasi_kontroler.')->group(function () {
            Route::get('lokasi_kontroler', 'LokasiKontrolerController@index')->name('index');
            Route::post('lokasi_kontroler/index/search', 'LokasiKontrolerController@searchIndex')->name('search.index');
            Route::get('lokasi_kontroler/create', 'LokasiKontrolerController@create')->name('create');
            Route::post('lokasi_kontroler/store', 'LokasiKontrolerController@store')->name('store');
            Route::get('lokasi_kontroler/edit/{no}', 'LokasiKontrolerController@edit')->name('edit');
            Route::post('lokasi_kontroler/update', 'LokasiKontrolerController@update')->name('update');
            Route::delete('lokasi_kontroler/delete', 'LokasiKontrolerController@delete')->name('delete');
        });
        //end lokasi_kontroler


        //sandi_perkiraan
        // Route assigned name "sandi_perkiraan.index"...
        Route::name('sandi_perkiraan.')->group(function () {
            Route::get('sandi_perkiraan', 'SandiPerkiraanController@index')->name('index');
            Route::post('sandi_perkiraan/index/search', 'SandiPerkiraanController@searchIndex')->name('search.index');
            Route::get('sandi_perkiraan/create', 'SandiPerkiraanController@create')->name('create');
            Route::post('sandi_perkiraan/store', 'SandiPerkiraanController@store')->name('store');
            Route::get('sandi_perkiraan/edit/{no}', 'SandiPerkiraanController@edit')->name('edit');
            Route::post('sandi_perkiraan/update', 'SandiPerkiraanController@update')->name('update');
            Route::delete('sandi_perkiraan/delete', 'SandiPerkiraanController@delete')->name('delete');
        });
        //end sandi_perkiraan

        //bulan_kontroler
        // Route assigned name "bulan_kontroler.index"...
        Route::name('bulan_kontroler.')->group(function () {
            Route::get('bulan_kontroler', 'BulanKontrolerController@index')->name('index');
            Route::post('bulan_kontroler/index/search', 'BulanKontrolerController@searchIndex')->name('search.index');
            Route::get('bulan_kontroler/create', 'BulanKontrolerController@create')->name('create');
            Route::post('bulan_kontroler/store', 'BulanKontrolerController@store')->name('store');
            Route::get('bulan_kontroler/edit/{no}', 'BulanKontrolerController@edit')->name('edit');
            Route::post('bulan_kontroler/update', 'BulanKontrolerController@update')->name('update');
            Route::delete('bulan_kontroler/delete', 'BulanKontrolerController@delete')->name('delete');
        });
        //end bulan_kontroler


        //main_account
        // Route assigned name "main_account.index"...
        Route::name('main_account.')->group(function () {
            Route::get('main_account', 'MainAccountController@index')->name('index');
            Route::post('main_account/index/search', 'MainAccountController@searchIndex')->name('search.index');
            Route::get('main_account/create', 'MainAccountController@create')->name('create');
            Route::post('main_account/store', 'MainAccountController@store')->name('store');
            Route::get('main_account/edit/{no}', 'MainAccountController@edit')->name('edit');
            Route::post('main_account/update', 'MainAccountController@update')->name('update');
            Route::delete('main_account/delete', 'MainAccountController@delete')->name('delete');
        });
        //end main_account

        
        //d2_perbulan
        // Route assigned name "d2_perbulan.index"...
        Route::name('d2_perbulan.')->group(function () {
            Route::get('d2_perbulan', 'ReportKontrolerController@create_d2_perbulan')->name('create_d2_perbulan');
            // Route::post('d2_perbulan/index/search', 'ReportKontrolerController@searchIndex')->name('search.index');
        });
        //end d2_perbulan

        //d2_periode
        // Route assigned name "d2_periode.index"...
        Route::name('d2_periode.')->group(function () {
            Route::get('d2_periode', 'ReportKontrolerController@create_d2_periode')->name('create_d2_periode');
            // Route::post('d2_periode/index/search', 'ReportKontrolerController@searchIndex')->name('search.index');
        });
        //end d2_periode

        //d5_report
        // Route assigned name "d5_report.index"...
        Route::name('d5_report.')->group(function () {
            Route::get('d5_report', 'ReportKontrolerController@create_d5_report')->name('create_d5_report');
            // Route::post('d5_report/index/search', 'ReportKontrolerController@searchIndex')->name('search.index');
        });
        //end d5_report

        //neraca_konsolidasi
        // Route assigned name "neraca_konsolidasi.index"...
        Route::name('neraca_konsolidasi.')->group(function () {
            Route::get('neraca_konsolidasi', 'ReportKontrolerController@create_neraca_konsolidasi')->name('create_neraca_konsolidasi');
            Route::post('neraca_konsolidasi/export', 'ReportKontrolerController@exportNeracaKonsolidasi')->name('export');
        });
        //end neraca_konsolidasi

        //neraca_detail
        // Route assigned name "neraca_detail.index"...
        Route::name('neraca_detail.')->group(function () {
            Route::get('neraca_detail', 'ReportKontrolerController@create_neraca_detail')->name('create_neraca_detail');
            // Route::post('neraca_detail/index/search', 'ReportKontrolerController@searchIndex')->name('search.index');
        });
        //end neraca_detail

        //laba_rugi_konsolidasi
        // Route assigned name "laba_rugi_konsolidasi.index"...
        Route::name('laba_rugi_konsolidasi.')->group(function () {
            Route::get('laba_rugi_konsolidasi', 'ReportKontrolerController@create_laba_rugi_konsolidasi')->name('create_laba_rugi_konsolidasi');
            Route::post('laba_rugi_konsolidasi/export', 'ReportKontrolerController@exportLabaRugiKonsolidasi')->name('export.laba.rugi.konsolidasi');
        });
        //end laba_rugi_konsolidasi
        
        //laba_rugi_detail
        // Route assigned name "laba_rugi_detail.index"...
        Route::name('laba_rugi_detail.')->group(function () {
            Route::get('laba_rugi_detail', 'ReportKontrolerController@create_laba_rugi_detail')->name('create_laba_rugi_detail');
            Route::post('laba_rugi_detail/export', 'ReportKontrolerController@exportLabaRugiDetail')->name('export.laba.rugi.detail');
        });

        //end laporan_keuangan
        //laporan_keuangan
        // Route assigned name "laporan_keuangan.index"...
        Route::name('laporan_keuangan.')->group(function () {
            Route::get('laporan_keuangan', 'ReportKontrolerController@create_laporan_keuangan')->name('create_laporan_keuangan');
            // Route::post('laporan_keuangan/index/search', 'ReportKontrolerController@searchIndex')->name('search.index');
        });
        //end laporan_keuangan

        //end biaya_pegawai
        //biaya_pegawai
        // Route assigned name "biaya_pegawai.index"...
        Route::name('biaya_pegawai.')->group(function () {
            Route::get('biaya_pegawai', 'ReportKontrolerController@create_biaya_pegawai')->name('create_biaya_pegawai');
            Route::post('biaya_pegawai/export', 'ReportKontrolerController@exportBiayaPegawai')->name('export_biaya_pegawai');
        });
        //end biaya_pegawai
    });
    
    
    //Administrator
    Route::prefix('administrator')->group(function () {

        //set_user
        // Route assigned name "set_user.index"...
        Route::name('set_user.')->group(function () {
            Route::get('set_user', 'SetUserController@index')->name('index');
            Route::post('set_user/index/search', 'SetUserController@searchIndex')->name('search.index');
            Route::get('set_user/create', 'SetUserController@create')->name('create');
            Route::post('set_user/store', 'SetUserController@store')->name('store');
            Route::get('set_user/edit/{no}', 'SetUserController@edit')->name('edit');
            Route::get('set_user/reset', 'SetUserController@Reset')->name('reset');
            Route::post('set_user/update', 'SetUserController@update')->name('update');
            Route::delete('set_user/delete', 'SetUserController@delete')->name('delete');
        });
        //end set_user

        //set_menu
        // Route assigned name "set_menu.index"...
        Route::name('set_menu.')->group(function () {
            Route::get('set_menu', 'SetMenuController@index')->name('index');
            Route::post('set_menu/index/search', 'SetMenuController@searchIndex')->name('search.index');
            Route::post('set_menu/menuid/json', 'SetMenuController@menuidJson')->name('menuid.json');
            Route::get('set_menu/create/{no}', 'SetMenuController@create')->name('create');
            Route::post('set_menu/store', 'SetMenuController@store')->name('store');
            Route::get('set_menu/edit/{no}', 'SetMenuController@edit')->name('edit');
            Route::post('set_menu/update', 'SetMenuController@update')->name('update');
            Route::delete('set_menu/delete', 'SetMenuController@delete')->name('delete');
        });
        //end set_menu

        //tabel_menu
        // Route assigned name "tabel_menu.index"...
        Route::name('tabel_menu.')->group(function () {
            Route::get('tabel_menu', 'TabelMenuController@index')->name('index');
            Route::post('tabel_menu/index/search', 'TabelMenuController@searchIndex')->name('search.index');
            Route::get('tabel_menu/create', 'TabelMenuController@create')->name('create');
            Route::post('tabel_menu/store', 'TabelMenuController@store')->name('store');
            Route::get('tabel_menu/edit/{no}', 'TabelMenuController@edit')->name('edit');
            Route::post('tabel_menu/update', 'TabelMenuController@update')->name('update');
            Route::delete('tabel_menu/delete', 'TabelMenuController@delete')->name('delete');
        });
        //end tabel_menu

        //password_administrator
        // Route assigned name "password_administrator.index"...
        Route::name('password_administrator.')->group(function () {
            Route::get('password_administrator', 'PasswordController@index')->name('index');
            Route::post('password_administrator/pass/json', 'PasswordController@passJson')->name('passJson');
            Route::post('password_administrator/store', 'PasswordController@store')->name('store');
        });
        //end password_administrator
    });
});
