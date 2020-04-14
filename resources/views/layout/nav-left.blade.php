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
                    'potongan_koreksi_gaji.edit'
                ); // isi nama semua route potongan manual
                $potongan_koreksi_gaji = array_merge(
                    $koreksi_gaji,
                    $honor_komite,
                    $potongan_manual,
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
                $report_sdm_payroll = array(
                    'report_sdm_payroll.index',
                    'report_sdm_payroll.create',
                    'report_sdm_payroll.edit'
                ); // isi nama semua route  report sdm dan payroll
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
                    $potongan_koreksi_gaji,
                    $lembur,
                    $pinjaman_pekerja,
                    $proses_gaji_sdm,
                    $proses_gaji,
                    $proses_thr,
                    $proses_insentif,
                    $report_sdm_payroll,
                    $absensi_karyawan,
                    $implementasi_gcg
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

                        <li class="kt-menu__item  kt-menu__item{{ set_active_submenu($anggaran) }}" aria-haspopup="true">
                            <a href="{{ route('anggaran.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Anggaran
                                </span>
                            </a>
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
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($report_sdm_payroll) }}" aria-haspopup="true">
                            <a href="{{ route('report_sdm_payroll.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Report SDM & Payrol  
                                </span>
                            </a>
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
            
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Bukti Kas/Bank
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Pembayaran
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Rekap Perbendaharaan</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="custom/apps/user/list-default.html" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Harian</span>
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
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Saldo Kas/Bank
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Deposito
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Report Perbendaharaan
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
                    </ul>
                </div>
            </li>

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Jurnal Umum
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Verivikasi Kas/Bank
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Posting
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Report Kontroler
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
                                    Opening Balance
                                </span>
                            </a>
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