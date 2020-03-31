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
                    'uang_muka_kerja.create',
                    'uang_muka_kerja.detail',
                    'uang_muka_kerja.edit',
                ); // isi nama semua route UMK

                $umk_pertanggungjawaban = array(
                    'uang_muka_kerja.pertanggungjawaban.index',
                    'uang_muka_kerja.pertanggungjawaban.create',
                    'uang_muka_kerja.pertanggungjawaban.edit',
                ); // isi nama semua route UMK

                $umk_menu = array_merge($umk, $umk_pertanggungjawaban);
                
                $permintaan_bayar = array(
                    'permintaan_bayar.index',
                    'permintaan_bayar.create',
                    'permintaan_bayar.detail',
                    'permintaan_bayar.edit',
                ); // isi nama semua route permintaan_bayar

                $anggaran = array(
                    'anggaran.index',
                    'anggaran.submain',
                    'anggaran.submain.detail',
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

                $tabel_data_master = array(
                    'tabel_data_master.index',
                    'tabel_data_master.create',
                    'tabel_data_master.edit'
                ); // isi nama semua route tabel data master
                $master_pekerja = array(
                    'master_pekerja.index',
                    'master_pekerja.create',
                    'master_pekerja.edit'
                ); // isi nama semua route master pekerja
                $potongan_koreksi_gaji = array(
                    'potongan_koreksi_gaji.index',
                    'potongan_koreksi_gaji.create',
                    'potongan_koreksi_gaji.edit'
                ); // isi nama semua route potongan koreksi gajian
                $lembur = array(
                    'lembur.index',
                    'lembur.create',
                    'lembur.edit'
                ); // isi nama semua route Lembur
                $pinjaman_pekerja = array(
                    'pinjaman_pekerja.index',
                    'pinjaman_pekerja.create',
                    'pinjaman_pekerja.edit'
                ); // isi nama semua route pinjaman pekerjaan
                $proses_gaji_sdm = array(
                    'proses_gaji.index',
                    'proses_gaji.create',
                    'proses_gaji.edit'
                ); // isi nama semua route proses gajian sdm
                $proses_gaji = array(
                    'proses_gaji.index',
                    'proses_gaji.create',
                    'proses_gaji.edit',
                    'proses_thr.index',
                    'proses_thr.create',
                    'proses_thr.edit',
                    'proses_insentif.index',
                    'proses_insentif.create',
                    'proses_insentif.edit'
                ); // isi nama semua route proses gajian
                $proses_thr = array(
                    'proses_thr.index',
                    'proses_thr.create',
                    'proses_thr.edit'
                ); // isi nama semua route proses thr
                $proses_insentif = array(
                    'proses_insentif.index',
                    'proses_insentif.create',
                    'proses_insentif.edit'
                ); // isi nama semua route proses insentif
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
                $sdmpayroll = array_merge(
                    $tabel_data_master,
                    $master_pekerja,
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
                                        <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Permintaan SPD</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($perjalanan_dinas_pertanggungjawaban) }}" aria-haspopup="true">
                                        <a href="{{route('perjalanan_dinas.pertanggungjawaban.index')}}" class="kt-menu__link ">
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
                                        <a href="{{ route('uang_muka_kerja.index') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Permintaan UMK</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($umk_pertanggungjawaban) }}" aria-haspopup="true">
                                        <a href="{{route('uang_muka_kerja.pertanggungjawaban.index')}}" class="kt-menu__link ">
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
                            <a href="{{ route('permintaan_bayar.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Permintaan Bayar
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item{{ set_active_submenu($anggaran) }}" aria-haspopup="true">
                            <a href="{{ route('anggaran.index') }}" class="kt-menu__link ">
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
                                        <a href="{{ route('perjalanan_dinas.rekap') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap SPD</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekap_umk) }}" aria-haspopup="true">
                                        <a href="{{route('uang_muka_kerja.rekap.range')}}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap UMK</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekap_permintaan_bayar) }}" aria-haspopup="true">
                                        <a href="{{route('permintaan_bayar.rekap.range')}}" class="kt-menu__link ">
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
                            <a href="{{ route('vendor.index') }}" class="kt-menu__link ">
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

            <li class="kt-menu__item  kt-menu__item--submenu {{ set_active($sdmpayroll) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($tabel_data_master) }}" aria-haspopup="true">
                            <a href="{{ route('tabel_data_master.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Tabel Data Master
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($master_pekerja) }}" aria-haspopup="true">
                            <a href="{{ route('master_pekerja.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Master Pekerjaan
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($potongan_koreksi_gaji) }}" aria-haspopup="true">
                            <a href="{{ route('potongan_koreksi_gaji.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Potongan dan Koreksi Gaji
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($lembur) }}" aria-haspopup="true">
                            <a href="{{ route('lembur.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Lembur 
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($pinjaman_pekerja) }}" aria-haspopup="true">
                            <a href="{{ route('pinjaman_pekerja.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Pinjaman Pekerja 
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item{{ set_active_submenu($proses_gaji_sdm) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Proses Gaji</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="custom/apps/user/list-default.html" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Proses Gaji</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="custom/apps/user/list-default.html" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Proses THR</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="custom/apps/user/list-default.html" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Proses Insentif </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($report_sdm_payroll) }}" aria-haspopup="true">
                            <a href="{{ route('report_sdm_payroll.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Report SDM & Payrol  
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($absensi_karyawan) }}" aria-haspopup="true">
                            <a href="{{ route('absensi_karyawan.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Absensi Karyawan   
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($implementasi_gcg) }}" aria-haspopup="true">
                            <a href="{{ route('implementasi_gcg.index') }}" class="kt-menu__link ">
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
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Bukti Kas/Bank
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
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
                                        <a href="custom/apps/user/list-default.html" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Harian</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="custom/apps/user/list-default.html" class="kt-menu__link ">
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
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Saldo Kas/Bank
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Deposito
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Report Perbendaharaan
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Tabel Master
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
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
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Jurnal Umum
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Verivikasi Kas/Bank
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Posting
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Report Kontroler
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Tabel Master
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
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
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Legalitas Customer
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Perjanjian-Perjanjian
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Litigasi
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Tabel Master
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
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
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Setting User & Password
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('perjalanan_dinas.index') }}" class="kt-menu__link ">
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