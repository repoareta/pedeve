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
                $potongan = array_merge(
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
                $koreksi_gaji = array(
                    'potongan_koreksi_gaji.index',
                    'potongan_koreksi_gaji.search.index',
                    'potongan_koreksi_gaji.create',
                    'potongan_koreksi_gaji.edit',
                    'potongan_koreksi_gaji.ctkkoreksi'
                ); // isi nama semua route koreksi gaji
                $honor_komite = array(
                    'honor_komite.index',
                    'honor_komite.search.index',
                    'honor_komite.create',
                    'honor_komite.edit'
                ); // isi nama semua route honor komite
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
                $proses_gaji_sdm = array_merge(
                    $proses_gaji,
                    $proses_thr,
                    $proses_insentif
                ); //isi nama Subdomain proses gaji

                $tunjangan_golongan = array(
                    'tunjangan_golongan.index',
                    'tunjangan_golongan.create',
                    'tunjangan_golongan.edit'
                ); // isi nama semua route tunjangan_golongan
                $jenis_upah = array(
                    'jenis_upah.index',
                    'jenis_upah.create',
                    'jenis_upah.edit'
                ); // isi nama semua route jenis_upah
                $rekening_pekerja = array(
                    'rekening_pekerja.index',
                    'rekening_pekerja.create',
                    'rekening_pekerja.edit'
                ); // isi nama semua route rekening_pekerja
                $tabel_aard = array(
                    'tabel_aard.index',
                    'tabel_aard.create',
                    'tabel_aard.edit'
                ); // isi nama semua route tabel_aard
                $master_bank = array(
                    'master_bank.index',
                    'master_bank.create',
                    'master_bank.edit'
                ); // isi nama semua route master_bank
                $master_ptkp = array(
                    'master_ptkp.index',
                    'master_ptkp.create',
                    'master_ptkp.edit'
                ); // isi nama semua route master_ptkp
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
                $master_tabungan = array(
                    'master_tabungan.index',
                    'master_tabungan.create',
                    'master_tabungan.edit'
                ); // isi nama semua route master_tabungan
                $tabel_payroll = array_merge(
                    $tunjangan_golongan,
                    $jenis_upah,
                    $rekening_pekerja,
                    $tabel_aard,
                    $master_bank,
                    $master_ptkp,
                    $jamsostek,
                    $pensiun,
                    $master_tabungan
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
                    'absensi_karyawan.download'
                ); // isi nama semua route absensi karyawan
                
                $gcg_home = array(
                    'gcg.index'
                ); // isi nama semua route absensi implementasi GCG

                $gcg_coc = array(
                    'gcg.coc.lampiran_satu',
                    'gcg.coc.lampiran_dua',
                ); // isi nama semua route absensi implementasi GCG

                $gcg_coi = array(
                    'gcg.coi.lampiran_satu',
                    'gcg.coi.lampiran_dua',
                ); // isi nama semua route absensi implementasi GCG

                $gcg_gratifikasi = array(
                    'gcg.gratifikasi.index',
                    'gcg.gratifikasi.penerimaan',
                    'gcg.gratifikasi.pemberian',
                    'gcg.gratifikasi.permintaan',
                    'gcg.gratifikasi.report.personal',
                    'gcg.gratifikasi.report.management',
                    'gcg.gratifikasi.edit',
                ); // isi nama semua route absensi implementasi GCG

                $gcg_sosialisasi = array(
                    'gcg.sosialisasi.index',
                    'gcg.sosialisasi.create',
                ); // isi nama semua route absensi implementasi GCG

                $gcg_lhkpn = array(
                    'gcg.lhkpn.index',
                    'gcg.lhkpn.create',
                ); // isi nama semua route absensi implementasi GCG

                $gcg_report_boundary = array(
                    'gcg.report_boundary.index'
                ); // isi nama semua route absensi implementasi GCG

                $implementasi_gcg = array_merge(
                    $gcg_home,
                    $gcg_coc,
                    $gcg_coi,
                    $gcg_gratifikasi,
                    $gcg_sosialisasi,
                    $gcg_lhkpn,
                    $gcg_report_boundary
                ); //isi nama Subdomain proses gaji

                //menu sdm & Payroll
                $sdm_payroll = array_merge(
                    $master_data_menu,
                    $pekerja,
                    $master_payroll_menu,
                    $potongan,
                    $lembur,
                    $pinjaman_pekerja,
                    $koreksi_gaji,
                    $honor_komite,
                    $proses_gaji_sdm,
                    $proses_gaji,
                    $proses_thr,
                    $proses_insentif,
                    $report_sdm_payroll,
                    $absensi_karyawan,
                    $implementasi_gcg,
                    $tabel_payroll
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
                $bulan_perbendaharaan = array(
                    'bulan_perbendaharaan.index',
                    'bulan_perbendaharaan.search.index',
                    'bulan_perbendaharaan.create',
                    'bulan_perbendaharaan.edit',
                ); // isi nama semua route setting bulan buku bulan_perbendaharaan
                $opening_balance = array(
                    'opening_balance.index',
                    'opening_balance.search.index',
                    'opening_balance.create',
                    'opening_balance.edit',
                ); // isi nama semua route setting bulan buku opening_balance

                $tool = array_merge(
                    $bulan_perbendaharaan,
                    $opening_balance
                ); //isi nama Subdomain Tool

                $data_pajak = array(
                    'data_pajak.index',
                    'data_pajak.create',
                    'data_pajak.edit',
                ); // isi nama semua route data pajak
                $proses_pajak = array(
                    'proses_pajak.rekap',
                ); // isi nama semua route proses pajak
                $laporan_pajak = array(
                    'laporan_pajak.rekap',
                ); // isi nama semua route laporan pajak
                $pajak_tahunan = array_merge(
                    $data_pajak,
                    $proses_pajak,
                    $laporan_pajak
                ); //isi nama Subdomain Tool

                $saldo = array_merge(
                    $informasi_saldo
                ); //isi nama Subdomain saldo

                $pembayaran_gaji = array(
                    'pembayaran_gaji.index',
                    'pembayaran_gaji.search.index',
                    'pembayaran_gaji.createmp',
                    'pembayaran_gaji.create',
                    'pembayaran_gaji.edit',
                    'pembayaran_gaji.edit.detail',
                    'pembayaran_gaji.approv',
                    'pembayaran_gaji.rekap',
                    'pembayaran_gaji.rekap_rc'
                ); // isi nama semua route pembayaran gaji
                $pembayaran_umk = array(
                    'pembayaran_umk.index',
                    'pembayaran_umk.search.index',
                    'pembayaran_umk.createmp',
                    'pembayaran_umk.create',
                    'pembayaran_umk.edit',
                    'pembayaran_umk.edit.detail',
                    'pembayaran_umk.approv',
                    'pembayaran_umk.rekap',
                    'pembayaran_umk.rekap_rc'
                ); // isi nama semua route pembayaran umk
                $pembayaran_jumk = array(
                    'pembayaran_jumk.index',
                    'pembayaran_jumk.search.index',
                    'pembayaran_jumk.createmp',
                    'pembayaran_jumk.create',
                    'pembayaran_jumk.edit',
                    'pembayaran_jumk.edit.detail',
                    'pembayaran_jumk.approv',
                    'pembayaran_jumk.rekap',
                    'pembayaran_jumk.rekap_rc'
                ); // isi nama semua route pembayaran jumk
                $pembayaran_pbayar = array(
                    'pembayaran_pbayar.index',
                    'pembayaran_pbayar.search.index',
                    'pembayaran_pbayar.createmp',
                    'pembayaran_pbayar.create',
                    'pembayaran_pbayar.edit',
                    'pembayaran_pbayar.edit.detail',
                    'pembayaran_pbayar.approv',
                    'pembayaran_pbayar.rekap',
                    'pembayaran_pbayar.rekap_rc'
                ); // isi nama semua route pembayaran pbayar
                $pembayaran = array_merge(
                    $pembayaran_gaji,
                    $pembayaran_umk,
                    $pembayaran_jumk,
                    $pembayaran_pbayar
                ); //isi nama Subdomain pembayaran
                
                $penempatan = array(
                    'penempatan_deposito.index',
                    'penempatan_deposito.search.index',
                    'penempatan_deposito.create',
                    'penempatan_deposito.edit',
                    'penempatan_deposito.depopjg',
                    'penempatan_deposito.rekaprc',
                    'penempatan_deposito.rekap_rc'
                ); // isi nama semua route penempatan deposito
                $perhitungan = array(
                    'perhitungan_bagihasil.index',
                    'perhitungan_bagihasil.index.search',
                    'perhitungan_bagihasil.rekap',
                ); // isi nama semua route perhitungan bagi hasil
                $deposito = array_merge(
                    $penempatan,
                    $perhitungan
                ); //isi nama Subdomain deposito


                $rekaphariankas = array(
                    'rekap_harian_kas.index',
                    'rekap_harian_kas.search.index',
                    'rekap_harian_kas.create',
                    'rekap_harian_kas.edit',
                    'rekap_harian_kas.rekap',
                ); // isi nama semua route rekap harian
                $rekapperiodekas = array(
                    'rekap_periode_kas.create',
                ); // isi nama semua route rekap periode
                $rekapdeposito = array(
                    'penempatan_deposito.rekap',
                ); // isi nama semua route rekap deposito

                $rekap_perbendaharaan = array_merge(
                    $rekaphariankas,
                    $rekapperiodekas,
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

                $kas_flow_internal = array(
                    'kas_bank.create7',
                ); // isi nama semua route kas_flow_internal

                $kas_flow_periode = array(
                    'kas_bank.create8',
                ); // isi nama semua route kas_flow_internal

                $kas_flow_mutasi = array(
                    'cash_flow.mutasi',
                ); // isi nama semua route kas_flow_internal

                $kas_flow_permatauang = array(
                    'cash_flow.permatauang',
                ); // isi nama semua route kas_flow_internal

                $kas_flow_lengkap = array(
                    'cash_flow.lengkap',
                ); // isi nama semua route kas_flow_internal

                $proyeksi_cashflow = array(
                    'kas_bank.create9',
                ); // isi nama semua route proyeksi_cashflow
                $per_cash_judex = array(
                    'kas_bank.create10',
                ); // isi nama semua route per_cash_judex

                $report_perbendaharaan = array_merge(
                    $kas_bank,
                    $kas_balancing,
                    $kas_judex,
                    $kas_bagian,
                    $kas_biaya,
                    $kas_sandi,
                    $kas_flow_internal,
                    $kas_flow_periode,
                    $kas_flow_mutasi,
                    $kas_flow_permatauang,
                    $kas_flow_lengkap,
                    $proyeksi_cashflow,
                    $per_cash_judex
                ); //isi nama Subdomain report perbendaharaan

                $perbendaharaan = array_merge(
                    $penerimaan_kas,
                    $saldo,
                    $deposito,
                    $pembayaran,
                    $rekap_perbendaharaan,
                    $report_perbendaharaan,
                    $pajak_tahunan,
                    $tool
                ); // array merge semua submenu
                
                $jurnal_umum = array(
                    'jurnal_umum.index',
                    'jurnal_umum.create',
                    'jurnal_umum.edit',
                    'jurnal_umum.posting',
                    'jurnal_umum.cpyjurnalumum',
                    'jurnal_umum.copy',
                    'jurnal_umum.rekap',
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
                    'cetak_kas_bank.index',                
                    'cetak_kas_bank.create',                
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

                $d2_perbulan = array(
                    'd2_perbulan.create_d2_perbulan'
                ); // isi nama semua route d2_perbulan
                $d2_periode = array(
                    'd2_periode.create_d2_periode'
                ); // isi nama semua route d2_periode
                $d5_report = array(
                    'd5_report.create_d5_report'
                ); // isi nama semua route d5_report
                $neraca_konsolidasi = array(
                    'neraca_konsolidasi.create_neraca_konsolidasi'
                ); // isi nama semua route neraca_konsolidasi
                $neraca_detail = array(
                    'neraca_detail.create_neraca_detail'
                ); // isi nama semua route neraca_detail
                $laba_rugi_konsolidasi = array(
                    'laba_rugi_konsolidasi.create_laba_rugi_konsolidasi'
                ); // isi nama semua route laba_rugi_konsolidasi
                $laba_rugi_detail = array(
                    'laba_rugi_detail.create_laba_rugi_detail'
                ); // isi nama semua route laba_rugi_detail
                $laporan_keuangan = array(
                    'laporan_keuangan.create_laporan_keuangan'
                ); // isi nama semua route laporan_keuangan
                $biaya_pegawai = array(
                    'biaya_pegawai.create_biaya_pegawai'
                ); // isi nama semua route biaya_pegawai

                $report_kontroler = array_merge(
                    $d2_perbulan,
                    $d2_periode,
                    $d5_report,
                    $neraca_konsolidasi,
                    $neraca_detail,
                    $laba_rugi_konsolidasi,
                    $laba_rugi_detail,
                    $laporan_keuangan,
                    $biaya_pegawai
                ); // array merge semua submenu report_kontroler

                $cash_judex = array(
                    'cash_judex.index',
                    'cash_judex.create',
                    'cash_judex.edit'
                ); // isi nama semua route cash_judex
                $jenis_biaya = array(
                    'jenis_biaya.index',
                    'jenis_biaya.create',
                    'jenis_biaya.edit'
                ); // isi nama semua route jenis_biaya
                $kas_bank_kontroler = array(
                    'kas_bank_kontroler.index',
                    'kas_bank_kontroler.create',
                    'kas_bank_kontroler.edit'
                ); // isi nama semua route kas_bank_kontroler
                $lokasi_kontroler = array(
                    'lokasi_kontroler.index',
                    'lokasi_kontroler.create',
                    'lokasi_kontroler.edit'
                ); // isi nama semua route lokasi_kontroler
                $sandi_perkiraan = array(
                    'sandi_perkiraan.index',
                    'sandi_perkiraan.create',
                    'sandi_perkiraan.edit'
                ); // isi nama semua route sandi_perkiraan
                $bulan_kontroler = array(
                    'bulan_kontroler.index',
                    'bulan_kontroler.create',
                    'bulan_kontroler.edit'                    
                ); // isi nama semua route bulan_kontroler
                $main_account = array(
                    'main_account.index',
                    'main_account.create',
                    'main_account.edit'                    
                ); // isi nama semua route main_account
                $tabel = array_merge(
                    $cash_judex,
                    $jenis_biaya,
                    $kas_bank_kontroler,
                    $lokasi_kontroler,
                    $sandi_perkiraan,
                    $bulan_kontroler,
                    $main_account
                ); // array merge semua submenu tabel

                $kontroler = array_merge(
                    $jurnal_umum,
                    $postingan_kas_bank,
                    $verifikasi_kas_bank,
                    $treassury,
                    $report_kontroler,
                    $tabel
                ); // array merge semua submenu

                $data_perkara = array(
                    'data_perkara.index',
                    'data_perkara.create',
                    'data_perkara.edit',                    
                    'data_perkara.detail'                    
                ); // isi nama semua route data_perkara
                $monitoring_kinerja = array(
                    'monitoring_kinerja.index',
                    'monitoring_kinerja.create',
                    'monitoring_kinerja.edit'                   
                ); // isi nama semua route monitoring_kinerja
                $perusahaan_afiliasi = array(
                    'perusahaan_afiliasi.index',
                    'perusahaan_afiliasi.create',
                    'perusahaan_afiliasi.edit',                    
                    'perusahaan_afiliasi.detail'                    
                ); // isi nama semua route perusahaan_afiliasi
                
                $customer_management = array_merge(
                    $data_perkara,
                    $perusahaan_afiliasi,
                    $monitoring_kinerja
                ); // array merge semua submenu


                $set_user = array(
                    'set_user.index',
                    'set_user.create',
                    'set_user.edit'                    
                ); // isi nama semua route set_user
                $set_menu = array(
                    'set_menu.index',
                    'set_menu.create',
                    'set_menu.edit'                    
                ); // isi nama semua route set_menu
                $tabel_menu = array(
                    'tabel_menu.index',
                    'tabel_menu.create',
                    'tabel_menu.edit'                    
                ); // isi nama semua route tabel_menu
                $password_administrator = array(
                    'password_administrator.index'                   
                ); // isi nama semua route password_administrator
                $administrator = array_merge(
                    $set_user,
                    $set_menu,
                    $tabel_menu,
                    $password_administrator
                ); // array merge semua submenu
            @endphp
            @if(substr_count(Auth::user()->userap,"E") > 0)
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
                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',701)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',722)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',741)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                        @endif
                        @endforeach

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

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',740)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                        @endif
                        @endforeach

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
            @endif
            @if(substr_count(Auth::user()->userap,"F") > 0)
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
                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',600)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',620)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($potongan) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Potongan</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($potongan_manual) }}" aria-haspopup="true">
                                        <a href="{{route('potongan_manual.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Manual Gaji</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($potongan_otomatis) }}" aria-haspopup="true">
                                        <a href="{{route('potongan_otomatis.create')}}" class="kt-menu__link">
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
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($koreksi_gaji) }}" aria-haspopup="true">
                            <a href="{{ route('potongan_koreksi_gaji.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                    Koreksi Gaji 
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($honor_komite) }}" aria-haspopup="true">
                            <a href="{{ route('honor_komite.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">
                                Honor Komite/Rapat 
                                </span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{  set_active($proses_gaji_sdm) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Proses Payroll</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($proses_gaji) }}" aria-haspopup="true">
                                        <a href="{{ route('proses_gaji.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Upah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($proses_thr) }}" aria-haspopup="true">
                                        <a href="{{route('proses_thr.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">THR</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($proses_insentif) }}" aria-haspopup="true">
                                        <a href="{{route('proses_insentif.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Insentif </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{  set_active($tabel_payroll) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Tabel Payroll</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($tunjangan_golongan) }}" aria-haspopup="true">
                                        <a href="{{route('tunjangan_golongan.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Tunjangan Pergolongan</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($jenis_upah) }}" aria-haspopup="true">
                                        <a href="{{route('jenis_upah.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Jenis Upah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekening_pekerja) }}" aria-haspopup="true">
                                        <a href="{{route('rekening_pekerja.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekening Pekerja</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($tabel_aard) }}" aria-haspopup="true">
                                        <a href="{{route('tabel_aard.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">AARD</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($master_bank) }}" aria-haspopup="true">
                                        <a href="{{route('master_bank.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">BANK</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($master_ptkp) }}" aria-haspopup="true">
                                        <a href="{{route('master_ptkp.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">PTKP</span>
                                        </a>
                                    </li>
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
                                            <span class="kt-menu__link-text">Dana Pensiun</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($master_tabungan) }}" aria-haspopup="true">
                                        <a href="{{route('master_tabungan.index')}}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Tabungan</span>
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
                        @endif
                        @endforeach


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

                        <li class="kt-menu__item kt-menu__item--submenu {{  set_active($implementasi_gcg) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Implementasi GCG</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($gcg_home) }}" aria-haspopup="true">
                                        <a href="{{ route('gcg.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Home</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($gcg_coc) }}" aria-haspopup="true">
                                        <a href="{{route('gcg.coc.lampiran_satu')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">CoC</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($gcg_coi) }}" aria-haspopup="true">
                                        <a href="{{route('gcg.coi.lampiran_satu')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">CoI</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($gcg_gratifikasi) }}" aria-haspopup="true">
                                        <a href="{{route('gcg.gratifikasi.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Gratifikasi</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($gcg_sosialisasi) }}" aria-haspopup="true">
                                        <a href="{{route('gcg.sosialisasi.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Sosialisasi</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($gcg_lhkpn) }}" aria-haspopup="true">
                                        <a href="{{route('gcg.lhkpn.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">LHKPN</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($gcg_report_boundary) }}" aria-haspopup="true">
                                        <a href="{{route('gcg.report_boundary.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Report Boundary</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>
            @endif
            @if(substr_count(Auth::user()->userap,"D") > 0)            
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
                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',501)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',502)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($pembayaran) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Pembayaran</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($pembayaran_gaji) }}" aria-haspopup="true">
                                        <a href="{{route('pembayaran_gaji.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Pembayaran Gaji</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($pembayaran_umk) }}" aria-haspopup="true">
                                        <a href="{{route('pembayaran_umk.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Uang Muka Kerja</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($pembayaran_jumk) }}" aria-haspopup="true">
                                        <a href="{{route('pembayaran_jumk.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">PertanggungJawaban UMK</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($pembayaran_pbayar) }}" aria-haspopup="true">
                                        <a href="{{route('pembayaran_pbayar.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Permintaan Bayar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',504)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                                </ul>
                            </div>
                        </li>
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',508)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($tool) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Tool</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($bulan_perbendaharaan) }}" aria-haspopup="true">
                                        <a href="{{route('bulan_perbendaharaan.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Setting Bulan Buku</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($opening_balance) }}" aria-haspopup="true">
                                        <a href="{{route('opening_balance.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Opening Balance</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',509)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($deposito) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Deposito</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item--submenu {{ set_active($penempatan) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('penempatan_deposito.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">
                                                Penempatan
                                            </span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--submenu {{ set_active($perhitungan) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('perhitungan_bagihasil.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">
                                                Rata Tertimbang
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',505)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($pajak_tahunan) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Pajak Tahunan</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item--submenu {{ set_active($data_pajak) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('data_pajak.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">
                                                Data Pajak
                                            </span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--submenu {{ set_active($proses_pajak) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('proses_pajak.rekap') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">
                                                Form 1721-A1
                                            </span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--submenu {{ set_active($laporan_pajak) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('laporan_pajak.rekap') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">
                                                SPT Tahunan 21
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',503)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekapperiodekas) }} " aria-haspopup="true">
                                        <a href="{{ route('rekap_periode_kas.create') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Periode</span>
                                        </a>
                                    </li>
                                    <!-- <li class="kt-menu__item kt-menu__item{{ set_active_submenu($rekapdeposito) }}" aria-haspopup="true">
                                        <a href="{{ route('penempatan_deposito.rekap') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Rekap Penempatan Deposito</span>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',510)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                                   <!--  <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_balancing) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create2') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Balancing Kas/Bank</span>
                                        </a>
                                    </li>-->
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_judex) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create3') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Kas/Bank Per Cash Judex</span>
                                        </a>
                                    </li>
                                   <!-- <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_bagian) }}" aria-haspopup="true">
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
                                    </li>-->
                                    {{-- <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_flow_internal) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create7') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Cash Flow Internal</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_flow_periode) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create8') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Cash Flow Per Periode</span>
                                        </a>
                                    </li> --}}
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_flow_mutasi) }}" aria-haspopup="true">
                                        <a href="{{ route('cash_flow.mutasi') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Cash Flow Mutasi</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_flow_permatauang) }}" aria-haspopup="true">
                                        <a href="{{ route('cash_flow.permatauang') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Cash Flow Per Mata Uang</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_flow_lengkap) }}" aria-haspopup="true">
                                        <a href="{{ route('cash_flow.lengkap') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Cash Flow Lengkap</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($proyeksi_cashflow) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create9') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Report Proyeksi Cashflow</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($per_cash_judex) }}" aria-haspopup="true">
                                        <a href="{{ route('kas_bank.create10') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Report Per Cash Judex</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </li>
            @endif
            @if(substr_count(Auth::user()->userap,"A") > 0)
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
                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',201)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',202)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',203)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',204)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                                        <a href="{{ route('cetak_kas_bank.index') }}" class="kt-menu__link">
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
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',205)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
                        <li class="kt-menu__item kt-menu__item--submenu {{ set_active($report_kontroler) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Report</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($d2_perbulan) }}" aria-haspopup="true">
                                        <a href="{{ route('d2_perbulan.create_d2_perbulan') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">D2 Per Bulan</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($d2_periode) }}" aria-haspopup="true">
                                        <a href="{{ route('d2_periode.create_d2_periode') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">D2 Per Periode</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($d5_report) }}" aria-haspopup="true">
                                        <a href="{{ route('d5_report.create_d5_report') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">D5</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($neraca_konsolidasi) }}" aria-haspopup="true">
                                        <a href="{{ route('neraca_konsolidasi.create_neraca_konsolidasi') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Neraca Konsolidasi</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($neraca_detail) }}" aria-haspopup="true">
                                        <a href="{{ route('neraca_detail.create_neraca_detail') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Neraca Detail</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($laba_rugi_konsolidasi) }}" aria-haspopup="true">
                                        <a href="{{ route('laba_rugi_konsolidasi.create_laba_rugi_konsolidasi') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Laba Rugi Konsolidasi</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($laba_rugi_detail) }}" aria-haspopup="true">
                                        <a href="{{ route('laba_rugi_detail.create_laba_rugi_detail') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Laba Rugi Detail</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($laporan_keuangan) }}" aria-haspopup="true">
                                        <a href="{{ route('laporan_keuangan.create_laporan_keuangan') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Catatan Atas Lap.Keuangan</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($biaya_pegawai) }}" aria-haspopup="true">
                                        <a href="{{ route('biaya_pegawai.create_biaya_pegawai') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Biaya Pegawai dan Kantor</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @endforeach

                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',206)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
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
                                        <a href="{{route('jenis_biaya.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Jenis Biaya</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($kas_bank_kontroler) }}" aria-haspopup="true">
                                        <a href="{{route('kas_bank_kontroler.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Kas Bank</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($lokasi_kontroler) }}" aria-haspopup="true">
                                        <a href="{{route('lokasi_kontroler.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Lokasi</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($sandi_perkiraan) }}" aria-haspopup="true">
                                        <a href="{{route('sandi_perkiraan.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Sandi Perkiraan</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($bulan_kontroler) }}" aria-haspopup="true">
                                        <a href="{{route('bulan_kontroler.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Setting Bulan Buku</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item{{ set_active_submenu($main_account) }}" aria-haspopup="true">
                                        <a href="{{route('main_account.index')}}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Main Account</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </li>
            @endif

            @if(substr_count(Auth::user()->userap,"G") > 0)            
            <li class="kt-menu__item  kt-menu__item--submenu {{ set_active($customer_management) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',801)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($data_perkara) }}" aria-haspopup="true">
                            <a href="{{route('data_perkara.index')}}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Data Perkara</span>
                            </a>
                        </li>
                        @endif
                        @endforeach
                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',802)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($perusahaan_afiliasi) }}" aria-haspopup="true">
                            <a href="{{route('perusahaan_afiliasi.index')}}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Perusahaan Afiliasi</span>
                            </a>
                        </li>
                        @endif
                        @endforeach
                        @foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',803)->limit(1)->get() as $data_umu)
                        @if($data_umu->ability == 1)
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($monitoring_kinerja) }}" aria-haspopup="true">
                            <a href="{{route('monitoring_kinerja.index')}}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Monitoring Kinerja</span>
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </li>
            @endif

            @if(Auth::user()->userlv == 0 or Auth::user()->userlv == 1) 
            <li class="kt-menu__item  kt-menu__item--submenu {{ set_active($administrator) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                        @if(Auth::user()->userlv == 0) 
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($set_user) }}" aria-haspopup="true">
                            <a href="{{route('set_user.index')}}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">User Administration</span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($set_menu) }}" aria-haspopup="true">
                            <a href="{{route('set_menu.index')}}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Menu & Function</span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($tabel_menu) }}" aria-haspopup="true">
                            <a href="{{route('tabel_menu.index')}}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Tabel Menu</span>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->userlv == 0 or Auth::user()->userlv == 1)
                        <li class="kt-menu__item kt-menu__item{{ set_active_submenu($password_administrator) }}" aria-haspopup="true">
                            <a href="{{route('password_administrator.index')}}" class="kt-menu__link">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Password Administration</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif
        </ul>
    </div>
</div>

<!-- end:: Aside Menu -->