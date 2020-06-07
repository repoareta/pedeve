<!-- begin:: Aside Menu -->
<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item " aria-haspopup="true">
                <img class="img-responsive avatar-view" style="margin: auto;width: 50%;height: 50%;border-radius: 100%;" src="{{ asset('assets/media/users/default.jpg') }}" alt="Avatar" title="Change the avatar">
                <h6 style="text-align:center; padding-top:20px;" class="kt-menu__section-text">
                    Welcome
                </h6>
                <h4 style="text-align:center; color:#ffffff;" >{{Auth::user()->usernm}}</h4>
            </li>

            @php
                $perjalanan_dinas = array(
                    'perjalanan_dinas.index',
                    'perjalanan_dinas.create',
                    'perjalanan_dinas.edit'
                ); // isi nama semua route perjalanan dinas

                $perjalanan_dinas_pertanggungjawaban = array(
                    'perjalanan_dinas.pertanggungjawaban.index',
                    'perjalanan_dinas.pertanggungjawaban.create',
                    'perjalanan_dinas.pertanggungjawaban.edit',
                ); // isi nama semua route perjalanan dinas

                $perjalanan_dinas_menu = array_merge($perjalanan_dinas, $perjalanan_dinas_pertanggungjawaban);

                $umk = array(
                    'uang_muka_kerja.index',
                    'uang_muka_kerja.search.index',
                    'uang_muka_kerja.rekap',
                    'uang_muka_kerja.create',
                    'uang_muka_kerja.detail',
                    'uang_muka_kerja.edit',
                    'uang_muka_kerja.approv',
                ); // isi nama semua route UMK

                $umk_pertanggungjawaban = array(
                    'uang_muka_kerja.pertanggungjawaban.index',
                    'uang_muka_kerja.pertanggungjawaban.create',
                    'uang_muka_kerja.pertanggungjawaban.edit',
                ); // isi nama semua route UMK

                $umk_menu = array_merge($umk, $umk_pertanggungjawaban);
                
                $permintaan_bayar = array(
                    'permintaan_bayar.index',
                    'permintaan_bayar.search.index',
                    'permintaan_bayar.rekap',
                    'permintaan_bayar.create',
                    'permintaan_bayar.detail',
                    'permintaan_bayar.edit',
                    'permintaan_bayar.approv'
                ); // isi nama semua route permintaan_bayar

                $anggaran = array(
                    'anggaran.index',
                    'anggaran.create',
                    'anggaran.edit',
                    'anggaran.submain.index',
                    'anggaran.submain.create',
                    'anggaran.submain.edit',
                    'anggaran.submain.detail.index',
                    'anggaran.submain.detail.create',
                    'anggaran.submain.detail.edit',
                ); // isi nama semua route anggaran

                $anggaran_master = array(
                    'anggaran.index',
                    'anggaran.create',
                    'anggaran.edit',
                ); // isi nama semua route anggaran

                $anggaran_submain = array(
                    'anggaran.submain.index',
                    'anggaran.submain.create',
                    'anggaran.submain.edit',
                ); // isi nama semua route anggaran

                $anggaran_submain_detail = array(
                    'anggaran.submain.detail.index',
                    'anggaran.submain.detail.create',
                    'anggaran.submain.detail.edit',
                ); // isi nama semua route anggaran

                $anggaran_umum = array_merge($anggaran_master, $anggaran_submain, $anggaran_submain_detail);

                $vendor = array(
                    'vendor.index',
                    'vendor.create',
                    'vendor.edit'
                ); // isi nama semua route anggaran

                $rekap_spd = array(
                    'perjalanan_dinas.rekap'
                );

                $rekap_umk = array(
                    'uang_muka_kerja.rekap.range'
                );
                $rekap_permintaan_bayar = array(
                    'permintaan_bayar.rekap.range'
                );

                $report_umum_menu = array_merge($rekap_spd, $rekap_umk, $rekap_permintaan_bayar); // isi nama semua route report umum

                // menu umum
                $umum = array_merge(
                    $perjalanan_dinas_menu,
                    $umk_menu,
                    $umk_pertanggungjawaban,
                    $permintaan_bayar,
                    $anggaran,
                    $vendor,
                    $report_umum_menu
                ); // array merge semua submenu

                $provinsi = array(
                    'provinsi.index',
                    'provinsi.create',
                    'provinsi.edit'
                ); // isi nama semua route provinsi

                $perguruan_tinggi = array(
                    'perguruan_tinggi.index',
                    'perguruan_tinggi.create',
                    'perguruan_tinggi.edit',
                ); // isi nama semua route perguruan_tinggi

                $kode_bagian = array(
                    'kode_bagian.index',
                    'kode_bagian.create',
                    'kode_bagian.edit',
                ); // isi nama semua route kode_bagian

                $kode_jabatan = array(
                    'kode_jabatan.index',
                    'kode_jabatan.create',
                    'kode_jabatan.edit',
                ); // isi nama semua route kode_jabatan

                $agama = array(
                    'agama.index',
                    'agama.create',
                    'agama.edit',
                ); // isi nama semua route perguruan_tinggi

                $master_data_menu = array_merge(
                    $provinsi, 
                    $perguruan_tinggi, 
                    $kode_bagian, 
                    $kode_jabatan, 
                    $agama
                );

                $pekerja = array(
                    'pekerja.index',
                    'pekerja.create',
                    'pekerja.edit'
                ); // isi nama semua route master pekerja

                $master_upah = array(
                    'upah.index',
                    'upah.create',
                    'upah.edit'
                ); // isi nama semua route master updah

                $master_insentif = array(
                    'insentif.index',
                    'insentif.create',
                    'insentif.edit'
                ); // isi nama semua route master insentif

                $master_hutang = array(
                    'hutang.index',
                    'hutang.create',
                    'hutang.edit'
                ); // isi nama semua route master hutang

                $master_beban_perusahaan = array(
                    'beban_perusahaan.index',
                    'beban_perusahaan.create',
                    'beban_perusahaan.edit'
                ); // isi nama semua route master beban_perusahaan

                $master_thr = array(
                    'thr.index',
                    'thr.create',
                    'thr.edit'
                ); // isi nama semua route master thr

                $master_payroll_menu = array_merge(
                    $master_upah, 
                    $master_insentif, 
                    $master_hutang, 
                    $master_beban_perusahaan, 
                    $master_thr
                );

                $potongan_manual = array(
                    'potongan_manual.index',
                    'potongan_manual.search.index',
                    'potongan_manual.create',
                    'potongan_manual.edit'
                ); // isi nama semua route potongan manual gajian
                $potongan_otomatis = array(
                    'potongan_otomatis.index',
                    'potongan_otomatis.search.index',
                    'potongan_otomatis.create',
                    'potongan_otomatis.edit'
                ); // isi nama semua route potongan otomatis gajian
                $potongan_insentif = array(
                    'potongan_insentif.index',
                    'potongan_insentif.search.index',
                    'potongan_insentif.create',
                    'potongan_insentif.edit'
                ); // isi nama semua route potongan insentif
                $honor_komite = array(
                    'honor_komite.index',
                    'honor_komite.search.index',
                    'honor_komite.create',
                    'honor_komite.edit'
                ); // isi nama semua route honor komite
                $koreksi_gaji = array(
                    'potongan_koreksi_gaji.index',
                    'potongan_koreksi_gaji.search.index',
                    'potongan_koreksi_gaji.create',
                    'potongan_koreksi_gaji.edit',
                    'potongan_koreksi_gaji.ctkkoreksi'
                ); // isi nama semua route potongan manual
                $potongan_koreksi_gaji = array_merge(
                    $koreksi_gaji,
                    $honor_komite,
                    $potongan_manual,
                    $potongan_insentif,
                    $potongan_otomatis
                ); //isi nama submenu
                $lembur = array(
                    'lembur.index',
                    'lembur.search.index',
                    'lembur.create',
                    'lembur.edit'
                ); // isi nama semua route Lembur
                $pinjaman_pekerja = array(
                    'pinjaman_pekerja.index',
                    'pinjaman_pekerja.create',
                    'pinjaman_pekerja.edit'
                ); // isi nama semua route pinjaman pekerjaan
                $proses_gaji = array(
                    'proses_gaji.index',
                    'proses_gaji.store',
                    'proses_gaji.create',
                    'proses_gaji.edit'
                ); // isi nama semua route proses gajian sdm
                $proses_thr = array(
                    'proses_thr.index',
                    'proses_thr.store',
                    'proses_thr.create',
                    'proses_thr.edit'
                ); // isi nama semua route proses thr sdm
                $proses_insentif = array(
                    'proses_insentif.index',
                    'proses_insentif.store',
                    'proses_insentif.create',
                    'proses_insentif.edit'
                ); // isi nama semua route proses insentif sdm
                $tunjangan_golongan = array(
                    'tunjangan_golongan.index',
                    'tunjangan_golongan.create',
                    'tunjangan_golongan.edit'
                ); // isi nama semua route tunjangan_golongan sdm
                $proses_gaji_sdm = array_merge(
                    $proses_gaji,
                    $proses_thr,
                    $proses_insentif,
                    $tunjangan_golongan
                ); //isi nama Subdomain proses gaji sdm
                $jamsostek = array(
                    'jamsostek.index',
                    'jamsostek.create',
                    'jamsostek.edit',
                );
                $pensiun = array(
                    'pensiun.index',
                    'pensiun.create',
                    'pensiun.edit',
                );
                $sdm_jamsostek_pensiun = array_merge(
                    $jamsostek,
                    $pensiun
                ); //isi nama Subdomain jamsostek pensiun


                $slip_gaji = array(
                    'proses_gaji.slipGaji'
                );//isi nama semua route slip gaji
                $daftar_upah = array(
                    'proses_gaji.ctkdaftarupah'
                );//isi nama semua route Daftar Upah
                $iuran_jamsostek = array(
                    'jamsostek.ctkiuranjs'
                );//isi nama semua route iuran jamsostek
                $iuran_pensiun = array(
                    'pensiun.ctkiuranpensiun'
                );//isi nama semua route iuran pensiun
                $rekap_iuran_pensiun = array(
                    'pensiun.ctkrekapiuranpensiun'
                );//isi nama semua route rekap iuran pensiun
                $rekap_iuran_jamsostek = array(
                    'jamsostek.ctkrekapiuranjamsostek'
                );//isi nama semua route rekap iuran jamsostek
                $rekap_lembur = array(
                    'lembur.ctkrekaplembur'
                );//isi nama semua route rekap lembur
                $rekap_gaji = array(
                    'proses_gaji.ctkrekapgaji'
                );//isi nama semua route rekap gaji
                $rekap_thr = array(
                    'proses_thr.ctkrekapthr'
                );//isi nama semua route rekap thr
                $rekap_insentif = array(
                    'proses_insentif.ctkrekapinsentif'
                );//isi nama semua route rekap insentif
                $slip_thr = array(
                    'proses_thr.ctkslipthr'
                );//isi nama semua route slip thr
                $slip_insentif = array(
                    'proses_insentif.ctkslipinsentif'
                );//isi nama semua route slip insentif
                $report_sdm_payroll = array_merge(
                    $slip_gaji,
                    $daftar_upah,
                    $iuran_jamsostek,
                    $iuran_pensiun,
                    $rekap_iuran_pensiun,
                    $rekap_iuran_jamsostek,
                    $rekap_lembur,
                    $rekap_gaji,
                    $rekap_thr,
                    $rekap_insentif,
                    $slip_thr,
                    $slip_insentif
                ); // isi nama Subdomain  report sdm dan payroll
                $absensi_karyawan = array(
                    'absensi_karyawan.index',
                    'absensi_karyawan.create',
                    'absensi_karyawan.edit'
                ); // isi nama semua route absensi karyawan
                $implementasi_gcg = array(
                    'implementasi_gcg.index',
                    'implementasi_gcg.create',
                    'implementasi_gcg.edit'
                ); // isi nama semua route absensi implementasi GCG

                //menu sdm & Payroll
                $sdm_payroll = array_merge(
                    $master_data_menu,
                    $pekerja,
                    $master_payroll_menu,
                    $potongan_koreksi_gaji,
                    $lembur,
                    $pinjaman_pekerja,
                    $proses_gaji_sdm,
                    $proses_gaji,
                    $proses_thr,
                    $proses_insentif,
                    $report_sdm_payroll,
                    $absensi_karyawan,
                    $implementasi_gcg,
                    $sdm_jamsostek_pensiun
                ); // array merge semua submenu
                //menu Perbendaharaan


                $penerimaan_kas = array(
                    'penerimaan_kas.index',
                    'penerimaan_kas.search.index',
                    'penerimaan_kas.createmp',
                    'penerimaan_kas.create',
                    'penerimaan_kas.edit',
                    'penerimaan_kas.edit.detail',
                    'penerimaan_kas.approv'
                ); // isi nama semua route penerimaan kas
               
               
                $informasi_saldo = array(
                    'informasi_saldo.index',
                    'informasi_saldo.create',
                    'informasi_saldo.edit',
                ); // isi nama semua route Informasi saldo

                $inisialisasi_saldo = array(
                    'inisialisasi_saldo.index',
                    'inisialisasi_saldo.search.index',
                    'inisialisasi_saldo.create',
                    'inisialisasi_saldo.edit',
                ); // isi nama semua route inisialisasi saldo

                $saldo = array_merge(
                    $informasi_saldo,
                    $inisialisasi_saldo
                ); //isi nama Subdomain saldo
                
                $deposito = array(
                    'penempatan_deposito.index',
                    'penempatan_deposito.search.index',
                    'penempatan_deposito.create',
                    'penempatan_deposito.edit',
                    'penempatan_deposito.rekaprc',
                ); // isi nama semua route penempatan deposito


                $rekaphariankas = array(
                    'rekap_harian_kas.index',
                    'rekap_harian_kas.search.index',
                    'rekap_harian_kas.create',
                    'rekap_harian_kas.edit',
                    'rekap_harian_kas.rekap',
                ); // isi nama semua route rekap harian
                $rekapdeposito = array(
                    'penempatan_deposito.rekap',
                ); // isi nama semua route rekap deposito

                $rekap_perbendaharaan = array_merge(
                    $rekaphariankas,
                    $rekapdeposito
                ); //isi nama Subdomain rekap perbendaharaan

                $kas_bank = array(
                    'kas_bank.create1',
                ); // isi nama semua route kas_bank
                $kas_balancing = array(
                    'kas_bank.create2',
                ); // isi nama semua route kas_balancing
                $kas_judex = array(
                    'kas_bank.create3',
                ); // isi nama semua route kas_judex
                $kas_bagian = array(
                    'kas_bank.create4',
                ); // isi nama semua route kas_bagian
                $kas_biaya = array(
                    'kas_bank.create5',
                ); // isi nama semua route kas_biaya
                $kas_sandi = array(
                    'kas_bank.create6',
                ); // isi nama semua route kas_sandi
                $report_perbendaharaan = array_merge(
                    $kas_bank,
                    $kas_balancing,
                    $kas_judex,
                    $kas_bagian,
                    $kas_biaya,
                    $kas_sandi
                ); //isi nama Subdomain report perbendaharaan
                $perbendaharaan = array_merge(
                    $penerimaan_kas,
                    $saldo,
                    $deposito,
                    $rekap_perbendaharaan,
                    $report_perbendaharaan
                ); // array merge semua submenu
                
                $jurnal_umum = array(
                    'jurnal_umum.index',
                    'jurnal_umum.create',
                    'jurnal_umum.edit',
                    'jurnal_umum.posting',
                    'jurnal_umum.cpyjurnalumum',
                    'jurnal_umum.copy',
                ); // isi nama semua route jurnal_umum
                $postingan_kas_bank = array(
                    'postingan_kas_bank.index',
                    'postingan_kas_bank.prsposting',
                    'postingan_kas_bank.btlposting',
                ); // isi nama semua route postingan_kas_bank
                $verifikasi_kas_bank = array(
                    'postingan_kas_bank.verkas',
                    'postingan_kas_bank.verkass',
                ); // isi nama semua route postingan_kas_bank
                $cetak_kas_bank = array(
                
                ); // isi nama semua route cetak_kas_bank
                $tabel_deposito = array(
                    'tabel_deposito.index',
                    'tabel_deposito.create',
                    'tabel_deposito.edit'
                ); // isi nama semua route tabel_deposito
                
                $treassury = array_merge(
                    $cetak_kas_bank,
                    $tabel_deposito
                ); // array merge semua submenu treassury

                $cash_judex = array(
                    'cash_judex.index',
                    'cash_judex.create',
                    'cash_judex.edit'
                ); // isi nama semua route cash_judex
                $jenis_biaya = array(
                    
                ); // isi nama semua route jenis_biaya
                $kas_bank_kontroler = array(
                    
                ); // isi nama semua route kas_bank_kontroler
                $lokasi_kontroler = array(
                    
                ); // isi nama semua route lokasi_kontroler
                $sandi_perkiraan = array(
                    
                ); // isi nama semua route sandi_perkiraan
                $sandi_perkiraan = array(
                    
                ); // isi nama semua route sandi_perkiraan
                $setting_bulan_buku_kontroler = array(
                    
                ); // isi nama semua route setting_bulan_buku_kontroler
                $main_account = array(
                    
                ); // isi nama semua route main_account
                $tabel = array_merge(
                    $cash_judex,
                    $jenis_biaya,
                    $kas_bank_kontroler,
                    $lokasi_kontroler,
                    $sandi_perkiraan,
                    $setting_bulan_buku_kontroler,
                    $main_account
                ); // array merge semua submenu tabel

                $kontroler = array_merge(
                    $jurnal_umum,
                    $postingan_kas_bank,
                    $verifikasi_kas_bank,
                    $treassury,
                    $tabel
                ); // array merge semua submenu
            @endphp

            <li class="kt-menu__item  kt-menu__item--submenu {{ set_active($umum) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="fa fa-boxes"></i>
                    </span>
                    <span class="kt-menu__link-text">
                        Umum
                    </span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                            <span class="kt-menu__link">
                                    <span class="kt-menu__link-text">
                                    Umum
                                </span>
                            </span>
                        </li>

                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($perjalanan_dinas_menu) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Perjalanan Dinas</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($perjalanan_dinas) }}" aria-haspopup="true">
                                        <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Permintaan SPD</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($perjalanan_dinas_pertanggungjawaban) }}" aria-haspopup="true">
                                        <a href="{{route('perjalanan_dinas.pertanggungjawaban.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Pertanggungjawaban SPD</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($umk_menu) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Uang Muka Kerja</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($umk) }}" aria-haspopup="true">
                                        <a href="{{ route('uang_muka_kerja.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Permintaan UMK</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($umk_pertanggungjawaban) }}" aria-haspopup="true">
                                        <a href="{{route('uang_muka_kerja.pertanggungjawaban.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Pertanggungjawaban UMK</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="kt-menu__item  kt-menu__item{{ set_active_submenu($permintaan_bayar) }}" aria-haspopup="true">
                            <a href="{{ route('permintaan_bayar.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Permintaan Bayar
                                </span>
                            </a>
                        </li>

                        {{-- <li class="kt-menu__item  kt-menu__item{{ set_active_submenu($anggaran) }}" aria-haspopup="true">
                            <a href="{{ route('anggaran.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Anggaran
                                </span>
                            </a>
                        </li> --}}

                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($anggaran_umum) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Anggaran Umum</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($anggaran_master) }}" aria-haspopup="true">
                                        <a href="{{ route('anggaran.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Master Anggaran</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($anggaran_submain) }}" aria-haspopup="true">
                                        <a href="{{route('anggaran.submain.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Sub Anggaran</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($anggaran_submain_detail) }}" aria-haspopup="true">
                                        <a href="{{route('anggaran.submain.detail.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Detail Anggaran</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($report_umum_menu) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Report Umum</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekap_spd) }}" aria-haspopup="true">
                                        <a href="{{ route('perjalanan_dinas.rekap') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap SPD</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekap_umk) }}" aria-haspopup="true">
                                        <a href="{{route('uang_muka_kerja.rekap.range')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap UMK</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekap_permintaan_bayar) }}" aria-haspopup="true">
                                        <a href="{{route('permintaan_bayar.rekap.range')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Permintaan Bayar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item  kt-menu__item{{ set_active_submenu($vendor) }}" aria-haspopup="true">
                            <a href="{{ route('vendor.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Vendor
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="kt-menu__item  kt-menu__item--submenu {{ set_active($sdm_payroll) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="fa fa-book-reader"></i>
                    </span>
                    <span class="kt-menu__link-text">
                        SDM & Payroll
                    </span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                            <span class="kt-menu__link">
                                <span class="kt-menu__link-text">
                                    SDM & Payroll
                                </span>
                            </span>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($master_data_menu) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Master Data</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($provinsi) }}" aria-haspopup="true">
                                        <a href="{{ route('provinsi.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Provinsi</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($perguruan_tinggi) }}" aria-haspopup="true">
                                        <a href="{{route('perguruan_tinggi.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Perguruan Tinggi</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kode_bagian) }}" aria-haspopup="true">
                                        <a href="{{route('kode_bagian.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Kode Bagian</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kode_jabatan) }}" aria-haspopup="true">
                                        <a href="{{route('kode_jabatan.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Kode Jabatan</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($agama) }}" aria-haspopup="true">
                                        <a href="{{route('agama.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Agama</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($pekerja) }}" aria-haspopup="true">
                            <a href="{{ route('pekerja.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Master Pegawai
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($master_payroll_menu) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Master Payroll</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($master_upah) }}" aria-haspopup="true">
                                        <a href="{{ route('upah.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Master Upah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($master_insentif) }}" aria-haspopup="true">
                                        <a href="{{route('insentif.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Master Insentif</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($master_hutang) }}" aria-haspopup="true">
                                        <a href="{{route('hutang.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Master Hutang</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($master_beban_perusahaan) }}" aria-haspopup="true">
                                        <a href="{{route('beban_perusahaan.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Beban Perusahaan</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($master_thr) }}" aria-haspopup="true">
                                        <a href="{{route('thr.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Master THR</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($potongan_koreksi_gaji) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Potongan & Koreksi Gaji</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($koreksi_gaji) }}" aria-haspopup="true">
                                        <a href="{{ route('potongan_koreksi_gaji.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Koreksi Gaji</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($potongan_manual) }}" aria-haspopup="true">
                                        <a href="{{route('potongan_manual.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Potongan Manual</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($potongan_otomatis) }}" aria-haspopup="true">
                                        <a href="{{route('potongan_otomatis.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Potongan Otomatis</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($potongan_insentif) }}" aria-haspopup="true">
                                        <a href="{{route('potongan_insentif.index')}}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Potongan Insentif</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($honor_komite) }}" aria-haspopup="true">
                                        <a href="{{route('honor_komite.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Honor Komite</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($lembur) }}" aria-haspopup="true">
                            <a href="{{ route('lembur.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Lembur 
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($pinjaman_pekerja) }}" aria-haspopup="true">
                            <a href="{{ route('pinjaman_pekerja.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Pinjaman Pekerja 
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{  set_active($proses_gaji_sdm) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Proses Upah</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($proses_gaji) }}" aria-haspopup="true">
                                        <a href="{{ route('proses_gaji.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Proses Upah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($proses_thr) }}" aria-haspopup="true">
                                        <a href="{{route('proses_thr.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Proses THR</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($proses_insentif) }}" aria-haspopup="true">
                                        <a href="{{route('proses_insentif.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Proses Insentif </span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($tunjangan_golongan) }}" aria-haspopup="true">
                                        <a href="{{route('tunjangan_golongan.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Tunjangan Pergolongan</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{  set_active($sdm_jamsostek_pensiun) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Jamsostek & Pensiun</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($jamsostek) }}" aria-haspopup="true">
                                        <a href="{{ route('jamsostek.index') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Jamsostek</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($pensiun) }}" aria-haspopup="true">
                                        <a href="{{route('pensiun.index')}}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Pensiun</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($report_sdm_payroll) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Report SDM & Payroll</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($daftar_upah) }}" aria-haspopup="true">
                                        <a href="{{ route('proses_gaji.ctkdaftarupah') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Daftar Upah Kerja</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($iuran_jamsostek) }}" aria-haspopup="true">
                                        <a href="{{ route('jamsostek.ctkiuranjs') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Daftar Iuran Jamsostek</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($iuran_pensiun) }}" aria-haspopup="true">
                                        <a href="{{ route('pensiun.ctkiuranpensiun') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Daftar Iuran Pensiun</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekap_lembur) }}" aria-haspopup="true">
                                        <a href="{{ route('lembur.ctkrekaplembur') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Lembur</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekap_gaji) }}" aria-haspopup="true">
                                        <a href="{{ route('proses_gaji.ctkrekapgaji') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Gaji</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekap_thr) }}" aria-haspopup="true">
                                        <a href="{{ route('proses_thr.ctkrekapthr') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap THR</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekap_insentif) }}" aria-haspopup="true">
                                        <a href="{{ route('proses_insentif.ctkrekapinsentif') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Insentif</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekap_iuran_pensiun) }}" aria-haspopup="true">
                                        <a href="{{ route('pensiun.ctkrekapiuranpensiun') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Iuran Pensiun</span>
                                        </a>
                                    </li>
                                    <!-- <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekap_iuran_jamsostek) }}" aria-haspopup="true">
                                        <a href="{{ route('jamsostek.ctkrekapiuranjamsostek') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Iuran Jamsostek</span>
                                        </a>
                                    </li> -->
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($slip_gaji) }}" aria-haspopup="true">
                                        <a href="{{route('proses_gaji.slipGaji')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Slip Gaji</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($slip_thr) }}" aria-haspopup="true">
                                        <a href="{{ route('proses_thr.ctkslipthr') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Slip THR</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($slip_insentif) }}" aria-haspopup="true">
                                        <a href="{{ route('proses_insentif.ctkslipinsentif') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Slip Insentif</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($absensi_karyawan) }}" aria-haspopup="true">
                            <a href="{{ route('absensi_karyawan.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Absensi Karyawan   
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($implementasi_gcg) }}" aria-haspopup="true">
                            <a href="{{ route('implementasi_gcg.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Implementasi GCG   
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="kt-menu__item  kt-menu__item--submenu {{ set_active($perbendaharaan) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="fa fa-chalkboard"></i>
                    </span>
                    <span class="kt-menu__link-text">
                        Perbendaharaan
                    </span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                            <span class="kt-menu__link">
                                <span class="kt-menu__link-text">
                                    Perbendaharaan
                                </span>
                            </span>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($penerimaan_kas) }} " aria-haspopup="true">
                            <a href="{{ route('penerimaan_kas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Bukti Kas/Bank
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($saldo) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Saldo</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($informasi_saldo) }}" aria-haspopup="true">
                                        <a href="{{ route('informasi_saldo.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Informasi Saldo</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($inisialisasi_saldo) }}" aria-haspopup="true">
                                        <a href="{{route('inisialisasi_saldo.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Inisialisasi Saldo</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($deposito) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('penempatan_deposito.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Penempatan Deposito
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Tabel Master
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Setting Bulan Buku
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($rekap_perbendaharaan) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Rekap Perbendaharaan</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekaphariankas) }}" aria-haspopup="true">
                                        <a href="{{ route('rekap_harian_kas.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Harian Kas</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="custom/apps/user/list-default.html" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Periode</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekapdeposito) }}" aria-haspopup="true">
                                        <a href="{{ route('penempatan_deposito.rekap') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Penempatan Deposito</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($report_perbendaharaan) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Report Perbendaharaan</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_bank) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create1') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">D2 Kas Bank</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_balancing) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create2') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Balancing Kas/Bank</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_judex) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create3') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Kas/Bank Per Cash Judex</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_bagian) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create4') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Cash Judex Per Bagian</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_biaya) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create5') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Cash Judex Per Jenis Biaya</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_sandi) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create6') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Per Cash Judex Per Sandi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="kt-menu__item  kt-menu__item--submenu {{ set_active($kontroler) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="fa fa-crosshairs"></i>
                    </span>
                    <span class="kt-menu__link-text">
                        Kontroler
                    </span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                            <span class="kt-menu__link">
                                <span class="kt-menu__link-text">
                                    Kontroler
                                </span>
                            </span>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($jurnal_umum) }}" aria-haspopup="true">
                            <a href="{{ route('jurnal_umum.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Jurnal Umum
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($verifikasi_kas_bank) }}" aria-haspopup="true">
                            <a href="{{route('postingan_kas_bank.verkass')}}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Verifikasi Kas Bank
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($postingan_kas_bank) }}" aria-haspopup="true">
                            <a href="{{ route('postingan_kas_bank.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Posting Kas Bank
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($treassury) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Treassury</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($cetak_kas_bank) }}" aria-haspopup="true">
                                        <a href="{{ route('uang_muka_kerja.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Cetak Kas Bank</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($tabel_deposito) }}" aria-haspopup="true">
                                        <a href="{{route('tabel_deposito.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Tabel Deposito</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($treassury) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Report</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($cetak_kas_bank) }}" aria-haspopup="true">
                                        <a href="{{ route('uang_muka_kerja.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Cetak Kas Bank</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($tabel_deposito) }}" aria-haspopup="true">
                                        <a href="{{route('tabel_deposito.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Tabel Deposito</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($tabel) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Tabel</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($cash_judex) }}" aria-haspopup="true">
                                        <a href="{{ route('cash_judex.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Cash Judex</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($jenis_biaya) }}" aria-haspopup="true">
                                        <a href="{{route('tabel_deposito.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Jenis Biaya</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_bank_kontroler) }}" aria-haspopup="true">
                                        <a href="{{route('tabel_deposito.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Kas Bank</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($lokasi_kontroler) }}" aria-haspopup="true">
                                        <a href="{{route('tabel_deposito.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Lokasi</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($sandi_perkiraan) }}" aria-haspopup="true">
                                        <a href="{{route('tabel_deposito.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Sandi Perkiraan</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($setting_bulan_buku_kontroler) }}" aria-haspopup="true">
                                        <a href="{{route('tabel_deposito.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Setting Bulan Buku</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($main_account) }}" aria-haspopup="true">
                                        <a href="{{route('tabel_deposito.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Main Account</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="fa fa-handshake"></i>
                    </span>
                    <span class="kt-menu__link-text">
                        Customer Management
                    </span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                            <span class="kt-menu__link">
                                <span class="kt-menu__link-text">
                                    Customer Management
                                </span>
                            </span>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Legalitas Customer
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Perjanjian-Perjanjian
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Litigasi
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Tabel Master
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Report Customer
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="fa fa-users"></i>
                    </span>
                    <span class="kt-menu__link-text">
                        Administrator
                    </span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                            <span class="kt-menu__link">
                                <span class="kt-menu__link-text">
                                    Administrator
                                </span>
                            </span>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Setting User & Password
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Setting Akses Menu
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- end:: Aside Menu -->