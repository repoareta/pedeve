<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SdmMasterPegawai;
use App\Models\TblPajak;
use App\Models\PayMasterUpah;
use App\Models\PayLembur;
use App\Models\PayKoreksi;
use App\Models\PayGapokBulanan;
use App\Models\PayTblJamsostek;
use App\Models\PayMasterBebanprshn;
use App\Models\PayDanaPensiun;
use App\Models\PayTabunga;
use App\Models\PayPotongan;
use App\Models\SdmTblProgressif;
use App\Models\SdmAllin;
use App\Models\UtBantu;
use App\Models\PayMasterHutang;
use DB;
use PDF;
use Excel;
use Alert;

class ProsesGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proses_gaji.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        // return view('proses_gaji.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    


    public function store(Request $request)
    {
        if($request->radioupah == 'proses'){
            $data_tahun = substr($request->tanggalupah,-4);
            $data_bulan = ltrim(substr($request->tanggalupah,0,-5), '0');
            $data_bulans = substr($request->tanggalupah,0,-5);
            $data=PayMasterUpah::where('tahun', $data_tahun)
            ->where('bulan',$data_bulan)
            ->where('nopek', 'LIKE','KOM%')->count();
            if($data >= 1 ){
                return redirect()->route('proses_gaji.index')->with(['proses' => 'proses']);
            }else{
                if($request->prosesupah == 'A'){
                        // PekerjaTetap()
                        $data_pegawai = SdmMasterPegawai::where('status','C')->orderBy('nopeg', 'asc')->get();
                        foreach($data_pegawai as $data)
                        {
                            TblPajak::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopeg' => $data->nopeg,
                                'status' => $data->kodekeluarga,        
                                ]); 

                            // 1.CARI UPAH TETAP AARD 01
                            $data_sdmut = DB::select("select a.ut from sdm_ut a where a.nopeg='$data->nopeg' and a.mulai=(select max(mulai) from sdm_ut where nopeg='$data->nopeg')");
                            if(!empty($data_sdmut)){
                                    foreach($data_sdmut as $data_sdm)
                                    {
                                        $upahtetap = $data_sdm->ut;
                                    }
                            }else{
                                $upahtetap = '0';
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '01',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $upahtetap,        
                                    'userid' => $request->userid,        
                                    ]);
                            
                            TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'upah' => $upahtetap,
                                ]);

                            // 2.TUNJANGAN JABATAN AARD 03
                            $data_sdmjabatan = DB::select("select a.nopeg,a.kdbag,a.kdjab,b.goljob,b.tunjangan from sdm_jabatan a,sdm_tbl_kdjab b where a.nopeg='$data->nopeg' and a.kdbag=b.kdbag and a.kdjab=b.kdjab and a.mulai=(select max(mulai) from sdm_jabatan where nopeg='$data->nopeg')");
                            if(!empty($data_sdmjabatan)){
                                    foreach($data_sdmjabatan as $data_sdmjab)
                                    {
                                        $tunjabatan = $data_sdmjab->tunjangan;
                                    }
                            }else{
                                $tunjabatan = '0';
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '03',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $tunjabatan,        
                                    'userid' => $request->userid,        
                                    ]); 

                            TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'tunjjabat' => $tunjabatan,
                                ]);

                            // 3.TUNJANGAN BIAYA HIDUP AARD AARD = 04
                            $data_sdmtunjangan = DB::select("select a.golgaji, b.nilai from sdm_golgaji a,pay_tbl_tunjangan b where a.nopeg='$data->nopeg' and a.golgaji=b.golongan and a.tanggal=(select max(tanggal) from sdm_golgaji where nopeg ='$data->nopeg')");
                            if(!empty($data_sdmtunjangan)){
                                    foreach($data_sdmtunjangan as $data_sdm)
                                    {
                                        $tunjabatanhidup = $data_sdm->nilai;
                                    }
                            }else{
                                $tunjabatanhidup = '0';
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '04',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $tunjabatanhidup,        
                                    'userid' => $request->userid,        
                                    ]); 

                            TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'tunjdaerah' => $tunjabatanhidup,
                                ]);

                            // 4.FASILITAS CUTI AARD 06
                            $data_sdmfcuti = SdmMasterPegawai::where('nopeg',$data->nopeg)->get();
                                foreach($data_sdmfcuti as $data_sdm)
                                {   
                                    $tahun = date('Y', strtotime($data_sdm->fasilitas));
                                    $bulan = ltrim(date('m', strtotime($data_sdm->fasilitas)),'0');
                                    $sisatahun = $data_tahun - $tahun;
                                    $sisabulan = $data_bulan - $bulan;
                                }
                                if($sisabulan == '11' and $sisatahun == '0'){
                                    $uangcuti = $upahtetap + $tunjabatan + $tunjabatanhidup;
                                    $fasilitas = 1.5 * $uangcuti;
                                }elseif($sisabulan == '11' and $sisatahun > '0'){
                                    $uangcuti = $upahtetap + $tunjabatan + $tunjabatanhidup;
                                    $fasilitas = 1.5 * $uangcuti;
                                }elseif($sisabulan == '-1' and $sisatahun > '0'){
                                    $uangcuti = $upahtetap + $tunjabatan + $tunjabatanhidup;
                                    $fasilitas = 1.5 * $uangcuti;
                                }else{
                                    $fasilitas = '0';
                                }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '06',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $fasilitas,        
                                    'userid' => $request->userid,        
                                    ]); 

                            TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'gapok' => $fasilitas,
                                ]);

                            // 5.CARI NILAI LEMBUR AARD 05
                            $data_lembur = DB::select("select Sum(makanpg+makansg+makanml+transport+lembur) as totlembur from pay_lembur where nopek='$data->nopeg' And bulan = '$data_bulan' AND tahun='$data_tahun'");                            
                            if(!empty($data_lembur)){
                                    foreach($data_lembur as $data_sdm)
                                    {
                                        if($data_sdm->totlembur <> ""){
                                            $totallembur = $data_sdm->totlembur;
                                        }else{
                                            $totallembur = '0';
                                        }
                                    }
                            }else{
                                $totallembur = '0';
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '05',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $totallembur,        
                                    'userid' => $request->userid,        
                                    ]); 

                            TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'lembur' => $totallembur,
                                ]);

                            // 6.CARI NILAI SISA BULAN LALU AARD 07
                            $data_sisanilai = DB::select("select nopek,aard,jmlcc,ccl,round(nilai) as nilai from pay_koreksi where bulan='$data_bulans' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='07'");
                            if(!empty($data_sisanilai)){
                                    foreach($data_sisanilai as $data_sdm)
                                    {
                                        if($data_sdm->nilai <> ""){
                                            $fassisa = $data_sdm->nilai;
                                        }else{
                                            $fassisa = '0';
                                        }
                                    }
                            }else{
                                $fassisa = '0';
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '07',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $fassisa,        
                                    'userid' => $request->userid,        
                                    ]); 

                            //7.CARI NILAI PERSENTASE DARI TABEL PAY_TABLE_JAMSOSTEK
                            PayGapokBulanan::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'jumlah' => $upahtetap,
                                        ]); 
                            $data_jamsostek = PayTblJamsostek::all();
                            foreach($data_jamsostek as $data_jam)
                            {
                                $niljspribadi = ($data_jam->pribadi/100) * $upahtetap;
                                $niljstaccident = ($data_jam->accident/100) * $upahtetap;
                                $niljspensiun = ($data_jam->pensiun/100) * $upahtetap;
                                $niljslife = ($data_jam->life/100) * $upahtetap;
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '09',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $niljspribadi * -1,        
                                    'userid' => $request->userid,        
                                    ]); 

                            PayMasterBebanprshn::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '10',        
                                    'lastamount' => '0',        
                                    'curramount' => $niljstaccident,       
                                    'userid' => $request->userid,        
                                    ]);
                            PayMasterBebanprshn::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '11',        
                                    'lastamount' => '0',        
                                    'curramount' => $niljspensiun,       
                                    'userid' => $request->userid,        
                                    ]);

                            PayMasterBebanprshn::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '12',        
                                'lastamount' => '0',        
                                'curramount' => $niljslife,       
                                'userid' => $request->userid,        
                                ]);
                            
                            //9.HITUNG IURAN DANA PENSIUN BNI SIMPONI 46
                            $data_danapensiun = PayDanaPensiun::all();
                            foreach($data_danapensiun as $data_dana)
                            {
                                $nildapenbni = ($data_dana->perusahaan3/100) * $upahtetap;
                            }
                            PayMasterBebanprshn::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '46',        
                                'lastamount' => '0',        
                                'curramount' => $nildapenbni,       
                                'userid' => $request->userid,        
                                ]);

                            // 10.HITUNG TABUNGAN AJTM AARD 16
                            $data_tabungan = PayTabunga::all();
                            foreach($data_tabungan as $data_tab)
                            {
                                $iuranwajib = ($data_tab->tabungan/100) * $upahtetap;
                            }
                            PayMasterBebanprshn::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '16',        
                                'lastamount' => '0',        
                                'curramount' => $iuranwajib,       
                                'userid' => $request->userid,        
                                ]);

                            // 11.CARI NILAI POTONGAN PINJAMAN AARD 19 
                            $data_potongan = DB::select("select * from pay_potongan where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='19'");
                            if(!empty($data_potongan)){
                                foreach($data_potongan as $data_potong)
                                {
                                    $jmlccpotongpinjam = $data_potong->jmlcc;
                                    $cclpotongpinjam = $data_potong->ccl;
                                    if($data_potong->nilai < 0){
                                        $nilaipotonganpinjam = ($data_potong->nilai * -1);
                                    }else{
                                    $nilaipotonganpinjam = $data_potong->nilai;
                                    }
                                }
                            }else{
                                $nilaipotonganpinjam = '0';
                                $jmlccpotongpinjam = '0';
                                $cclpotongpinjam = '0';
                            }
                            PayMasterUpah::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '19',        
                                        'jmlcc' => $jmlccpotongpinjam,        
                                        'ccl' => $cclpotongpinjam,        
                                        'nilai' => $nilaipotonganpinjam * -1,        
                                        'userid' => $request->userid,        
                                        ]); 
                            
                            // 12.HITUNG TOTAL GAJI YANG DI DAPAT 
                            $totalgaji = DB::select("select sum(nilai) as gajiasli,(sum(nilai)-round(sum(nilai),-3)) as pembulatan1,round(sum(nilai),-3) as hasil,(1000+(sum(nilai)-round(sum(nilai),-3))) as pembulatan2  from pay_master_upah where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg'");
                            if(!empty($totalgaji)){
                                foreach($totalgaji as $total)
                                {
                                    if($total->pembulatan1 < 0){
                                        $sisagaji = $total->pembulatan2;
                                    }else{
                                        $sisagaji = $total->pembulatan1;
                                    }
                                }
                            }else{
                                $sisagaji = '0';
                            }
                            PayMasterUpah::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '23',        
                                        'jmlcc' => '0',        
                                        'ccl' => '0',        
                                        'nilai' => $sisagaji * -1,        
                                        'userid' => $request->userid,        
                                        ]); 

                        
                            $bulan2 = $data_bulan + 1;
                            if($bulan2 > 12){
                                $data_bulan2 = 1;
                                $data_tahun2 = $data_tahun + 1;
                            }else{
                                $data_bulan2 =$bulan2;
                                $data_tahun2 = $data_tahun;
                            }
                            // 15.SIMPAN NILAI PEMBULATAN KE TABEL KOREKSI AARD 17 SISA BULAN LALU
                            PayKoreksi::insert([
                                            'tahun' => $data_tahun2,
                                            'bulan' => $data_bulan2,
                                            'nopek' => $data->nopeg,
                                            'aard' => '07',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $sisagaji,        
                                            'userid' => $request->userid,        
                                            ]); 

                            // 16.HITUNG PAJAK PPH21 CARI NILAI YANG KENA PAJAK (BRUTO)
                            $kenapajak = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$data_tahun' and a.bulan='$data_bulan' and a.nopek='$data->nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                            foreach($kenapajak as $kenap)
                            {
                                $nilaikenapajak = $kenap->nilai1;
                            }
                            $koreksigaji = DB::select("select sum(a.nilai) as kortam from pay_koreksigaji a where a.tahun='$data_tahun' and a.bulan='$data_bulan' and a.nopek='$data->nopeg'");
                            foreach($koreksigaji as $koreksig)
                            {
                                $kortam = $koreksig->kortam * -1;
                            }

                            $totalkenapajak = ($nilaikenapajak + $niljstaccident + $niljslife + $fasilitas+ $kortam)*12;

                            // 17.CARI NILAI PENGURANG
                                $biayajabatans = ((5/100)*$totalkenapajak);
                                if($biayajabatans > 6000000){
                                    $biayajabatan = 6000000;
                                }else{
                                    $biayajabatan = $biayajabatans;
                                }
                                
                                $neto1tahun = $totalkenapajak - $biayajabatan;
                            
                                TblPajak::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopeg',$data->nopeg)
                                        ->update([
                                            'bjabatan' => $biayajabatan,
                                        ]);

                            // 18.CARI NILAI TIDAK KENA PAJAK
                            $data_ptkp = DB::select("select a.kodekeluarga,b.nilai from sdm_master_pegawai a,pay_tbl_ptkp b where a.kodekeluarga=b.kdkel and a.nopeg='$data->nopeg'");
                            
                            if(!empty($data_ptkp)){
                                foreach($data_ptkp as $data_p)
                                {
                                    $nilaiptkp1 = $data_p->nilai;
                                }
                            }else{
                                    $nilaiptkp1 = '0';
                            }

                            //    19.PENGHASILAN KENA PAJAK SETAHUN
                            $nilaikenapajaka = $neto1tahun - $nilaiptkp1;
                            TblPajak::where('tahun', $data_tahun)
                                            ->where('bulan',$data_bulan)
                                            ->where('nopeg',$data->nopeg)
                                            ->update([
                                                'ptkp' => $nilaiptkp1,
                                                'pkp' => $nilaikenapajaka,
                                            ]);

                            // 20.HITUNG PAJAK PENGHASILAN TERUTANG PAJAK SETAHUN                      
                            $nilai2 = 0;
                            $nilai1 = 0;
                            $tunjangan = 0;
                            $pajakbulan=1;
                            $nilaikenapajak = $nilaikenapajaka;
                            $sisapokok = $nilaikenapajak;
                            $data_sdmprogresif = DB::select("select * from sdm_tbl_progressif order by awal asc");
                            // SdmTblProgressif::orderBy('awal','asc');
                            // $pph21ok = 0;
                            foreach($data_sdmprogresif as $data_prog)
                            {
                                $awal = $data_prog->awal;
                                $akhir = $data_prog->akhir;
                                $persen = $data_prog->prosen;
                                $prosen = $persen/100;
                                $range = $akhir - $awal;
                                if($sisapokok > 0){
                                    $sisapokok1 = $sisapokok;
                                    if($sisapokok1 > 0 and $sisapokok1 < $range){
                                        $pph21r = $sisapokok1 * $prosen;
                                    }elseif($sisapokok1 > 0 and $sisapokok1 >= $range ){
                                        $pph21r = $range * $prosen;
                                    }else{
                                        $pph21r = 0;
                                    }
                                }else {
                                    $pph21r = 0;
                                }
                                $pph21ok =  $pph21r;
                                $pajakbulan = ($pph21ok/12);
                            } 
                            PayMasterUpah::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '26',        
                                        'jmlcc' => '0',        
                                        'ccl' => '0',        
                                        'nilai' => $pajakbulan * -1,        
                                        'userid' => $request->userid,        
                                        ]); 
                            PayMasterUpah::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '27',        
                                        'jmlcc' => '0',        
                                        'ccl' => '0',        
                                        'nilai' => $pajakbulan,        
                                        'userid' => $request->userid,        
                                        ]); 
                            TblPajak::where('tahun', $data_tahun)
                                            ->where('bulan',$data_bulan)
                                            ->where('nopeg',$data->nopeg)
                                            ->update([
                                                'pajak_setor' => $pajakbulan,
                                            ]);
                        
                        }

                        // PekerjaKontrak()
                    $data_pegawai_kontrak = SdmMasterPegawai::where('status','K')->orderBy('nopeg', 'asc')->get();
                    foreach($data_pegawai_kontrak as $data)
                    {
                        TblPajak::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopeg' => $data->nopeg,
                                'status' => $data->kodekeluarga,        
                                ]);
                        
                        // 1.CARI NILAI UPAH ALL IN AARD 02

                       $data_sdmallin = DB::select("select nilai from sdm_allin where nopek='$data->nopeg'");
                       if(!empty($data_sdmallin)){
                           foreach($data_sdmallin as $data_sdm)
                                {
                                    if($data_sdm->nilai <> ""){
                                        $upahallin = $data_sdm->nilai;
                                    }else {
                                        $upahallin ='0';
                                    }
                                }
                        }else {
                            $upahallin ='0';
                        } 
                      
                        PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '02',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $upahallin,        
                                    'userid' => $request->userid,        
                                    ]);
                            
                        TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'upah' => $upahallin,
                                ]);

                        // 2.CARI TUNJANGAN JABATAN JIKA ADA
                        $data_sdmjabatan =DB::select("select a.nopeg,a.kdbag,a.kdjab,b.goljob,b.tunjangan from sdm_jabatan a,sdm_tbl_kdjab b where a.nopeg='$data->nopeg' and a.kdbag=b.kdbag and a.kdjab=b.kdjab and a.mulai=(select max(mulai) from sdm_jabatan where nopeg='$data->nopeg')");
                        if(!empty($data_sdmjabatan)){
                            foreach($data_sdmjabatan as $data_sdmjab)
                            {
                                if($data_sdmjab->tunjangan <> ""){
                                    $tunjabatan = $data_sdmjab->tunjangan;
                                }else{
                                    $tunjabatan = '0';
                                }
                            }
                        }else{
                            $tunjabatan = '0';
                        }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '03',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $tunjabatan,        
                                    'userid' => $request->userid,        
                                    ]); 

                            TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'tunjjabat' => $tunjabatan,
                                ]);


                        // 3.TUNJANGAN DAERAH
                        $data_tunjangandaerah = DB::select("select a.golgaji, b.nilai from sdm_golgaji a,pay_tbl_tunjangan b where a.nopeg='$data->nopeg' and a.golgaji=b.golongan and a.tanggal=(select max(tanggal) from sdm_golgaji where nopeg ='$data->nopeg')");
                        if(!empty($data_tunjangandaerah)){
                                foreach($data_tunjangandaerah as $data_sdmdaerah)
                                {
                                    if($data_sdmdaerah->nilai <> ""){
                                        $tunjangandaerah = $data_sdmdaerah->nilai;
                                    }else{
                                        $tunjangandaerah = '0';
                                    }
                                }
                        }else{
                            $tunjangandaerah = '0';
                        }
                        PayMasterUpah::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '04',        
                                'jmlcc' => '0',        
                                'ccl' => '0',        
                                'nilai' => $tunjangandaerah,        
                                'userid' => $request->userid,        
                                ]); 

                        TblPajak::where('tahun', $data_tahun)
                            ->where('bulan',$data_bulan)
                            ->where('nopeg',$data->nopeg)
                            ->update([
                                'tunjdaerah' => $tunjangandaerah,
                            ]);

                        // 4.Gapok Kontrak
                        $data_gapok = DB::select("select gapok from sdm_gapok where nopeg = '$data->nopeg' and mulai=(select max(mulai) from sdm_gapok where nopeg='$data->nopeg')");
                        if(!empty($data_gapok)){
                            foreach($data_gapok as $data_gap)
                            {
                                if($data->nopeg == 'K00011'){
                                    $gapok = '0';
                                }else{
                                    $gapok = $data_gap->gapok;
                                }
                            }
                        }else {
                            $gapok = '0';
                        }

                        PayGapokBulanan::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'jumlah' => $upahallin,
                                        ]); 

                        // 5.CARI NILAI PERSENTASE DARI TABEL PAY_TABLE_JAMSOSTEK
                        $data_jamsostek = PayTblJamsostek::all();
                            foreach($data_jamsostek as $data_jam)
                            {
                                $niljspribadi = ($data_jam->pribadi/100) * $upahallin;
                                $niljstaccident = ($data_jam->accident/100) * $upahallin;
                                $niljspensiun = ($data_jam->pensiun/100) * $upahallin;
                                $niljslife = ($data_jam->life/100) * $upahallin;
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '09',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $niljspribadi * -1,        
                                    'userid' => $request->userid,        
                                    ]); 

                            PayMasterBebanprshn::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '10',        
                                    'lastamount' => '0',        
                                    'curramount' => $niljstaccident,       
                                    'userid' => $request->userid,        
                                    ]);
                            PayMasterBebanprshn::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '11',        
                                    'lastamount' => '0',        
                                    'curramount' => $niljspensiun,       
                                    'userid' => $request->userid,        
                                    ]);

                            PayMasterBebanprshn::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '12',        
                                'lastamount' => '0',        
                                'curramount' => $niljslife,       
                                'userid' => $request->userid,        
                                ]);

                            // 6.FASILITAS CUTI AARD 06
                            $data_cuti = DB::select("select a.fasilitas,a.fasilitas  from sdm_master_pegawai a where a.nopeg='$data->nopeg'");
                            if(!empty($data_cuti)){
                              foreach($data_cuti as $data_cut)
                              {
                                $tahun = date('Y', strtotime($data_cut->fasilitas));
                                $bulan = ltrim(date('m', strtotime($data_cut->fasilitas)),'0');
                                $sisatahun = $data_tahun - $tahun;
                                $sisabulan = $data_bulan - $bulan;
                                  if($sisabulan == '11' and $sisatahun == '0'){
                                      $uangcuti = $upahallin + $tunjabatan + $tunjangandaerah;
                                      $fasilitas = 1.5 * $uangcuti;
                                  }elseif($sisabulan == '11' and $sisatahun > '0'){
                                    $uangcuti = $upahallin + $tunjabatan + $tunjangandaerah;
                                    $fasilitas = 1.5 * $uangcuti;
                                  }elseif($sisabulan == '-1' and $sisatahun > '0'){
                                    $uangcuti = $upahallin + $tunjabatan + $tunjangandaerah;
                                    $fasilitas = 1.5 * $uangcuti;
                                  }else{
                                      $fasilitas = '0';
                                  }
                              }
                          }else {
                              $fasilitas = '0';
                          }
                        PayMasterUpah::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '06',        
                                'jmlcc' => '0',        
                                'ccl' => '0',        
                                'nilai' => $fasilitas,        
                                'userid' => $request->userid,        
                                ]); 

                        TblPajak::where('tahun', $data_tahun)
                            ->where('bulan',$data_bulan)
                            ->where('nopeg',$data->nopeg)
                            ->update([
                                'gapok' => $fasilitas,
                            ]);

                        // 7.CARI NILAI LEMBUR AARD 05
                        $data_lembur = DB::select("select sum(makanpg+makansg+makanml+transport+lembur) as totlembur from pay_lembur where nopek='$data->nopeg' and bulan='$data_bulan' and tahun='$data_tahun'");                            
                        if(!empty($data_lembur)){
                                foreach($data_lembur as $data_sdm)
                                {
                                    if($data_sdm->totlembur <> ""){
                                        $totallembur = $data_sdm->totlembur;
                                    }else{
                                        $totallembur = '0';
                                    }
                                }
                        }else{
                            $totallembur = '0';
                        }
                        PayMasterUpah::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '05',        
                                'jmlcc' => '0',        
                                'ccl' => '0',        
                                'nilai' => $totallembur,        
                                'userid' => $request->userid,        
                                ]); 

                        TblPajak::where('tahun', $data_tahun)
                            ->where('bulan',$data_bulan)
                            ->where('nopeg',$data->nopeg)
                            ->update([
                                'lembur' => $totallembur,
                            ]);

                        // 8.CARI SISA BULAN LALU AARD 07
                        $data_sisanilai = DB::select("select nopek,aard,jmlcc,ccl,nilai from pay_koreksi where bulan='$data_bulans' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='07'");
                        if(!empty($data_sisanilai)){
                            foreach($data_sisanilai as $data_sdm)
                            {
                                if($data_sdm->nilai <> ""){
                                    $fassisa = $data_sdm->nilai;
                                }else {
                                    $fassisa = '0';
                                }
                            }
                        }else{
                            $fassisa = '0';
                        }
                        PayMasterUpah::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '07',        
                                'jmlcc' => '0',        
                                'ccl' => '0',        
                                'nilai' => $fassisa,        
                                'userid' => $request->userid,        
                                ]); 
                        // 9. POTONG KOPERASI
                        $data_potongan = DB::select("select * from pay_potongan where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='28'");
                        if(!empty($data_potongan)){
                            foreach($data_potongan as $data_potong)
                            {
                                $jmlccpotongpinjam = $data_potong->jmlcc;
                                $cclpotongpinjam = $data_potong->ccl;
                                if($data_potong->nilai < 0){
                                    $nilaipotonganpinjam = $data_potong->nilai;
                                }else{
                                    $nilaipotonganpinjam = ($data_potong->nilai * -1);
                                }
                            }
                        }else{
                            $nilaipotonganpinjam = '0';
                            $jmlccpotongpinjam = '0';
                            $cclpotongpinjam = '0';
                        }    

                         PayMasterUpah::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '28',        
                                        'jmlcc' => $jmlccpotongpinjam,        
                                        'ccl' => $cclpotongpinjam,        
                                        'nilai' => $nilaipotonganpinjam,        
                                        'userid' => $request->userid,        
                                        ]);
                        // 10. HITUNG TOTAL GAJI YANG DI DAPAT 
                        $totalgaji = DB::select("select sum(nilai) as gajiasli,(sum(nilai)-round(sum(nilai),-3)) as pembulatan1,round(sum(nilai),-3) as hasil,(1000+(sum(nilai)-round(sum(nilai),-3))) as pembulatan2  from pay_master_upah where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg'");
                        if(!empty($totalgaji)){
                            foreach($totalgaji as $total)
                            {
                                if($total->pembulatan1 < 0){
                                    $sisagaji = $total->pembulatan2;
                                }else{
                                    $sisagaji = $total->pembulatan1;
                                }
                            }
                        }else{
                            $sisagaji = '0';
                        }
                        PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '23',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $sisagaji * -1,        
                                    'userid' => $request->userid,        
                                    ]); 

                    
                        $bulan2 = $data_bulan + 1;
                        if($bulan2 >12){
                            $data_bulan2 = 1;
                            $data_tahun2 = $data_tahun + 1;
                        }else{
                            $data_bulan2 =$bulan2;
                            $data_tahun2 = $data_tahun;
                        }
                        PayKoreksi::insert([
                                            'tahun' => $data_tahun2,
                                            'bulan' => $data_bulan2,
                                            'nopek' => $data->nopeg,
                                            'aard' => '07',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $sisagaji,        
                                            'userid' => $request->userid,        
                                            ]); 

                        // 11.HITUNG PAJAK PPH21 CARI NILAI YANG KENA PAJAK (BRUTO)
                        $kenapajak = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$data_tahun' and a.bulan='$data_bulan' and a.nopek='$data->nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                        foreach($kenapajak as $kenap)
                        {
                            if($kenap->nilai1 <> ""){
                                $nilaikenapajak = $kenap->nilai1;
                            }else{
                                $nilaikenapajak = '0';
                            }
                        }
                        $koreksigaji = DB::select("select sum(a.nilai) as kortam from pay_koreksigaji a where a.tahun='$data_tahun' and a.bulan='$data_bulan' and a.nopek='$data->nopeg'");
                        foreach($koreksigaji as $koreksig)
                        {
                            $kortam = $koreksig->kortam * -1;
                        }
                        $
                        $totalkenapajak = (($nilaikenapajak + $kortam) * 12);
                        $biayajabatans = ((5/100)*$totalkenapajak);
                                if($biayajabatans > 6000000){
                                    $biayajabatan = 6000000;
                                }else{
                                    $biayajabatan = $biayajabatans;
                                }
                                $neto1tahun = $totalkenapajak - $biayajabatan;
                        TblPajak::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopeg',$data->nopeg)
                                        ->update([
                                            'bjabatan' => $biayajabatan,
                                        ]);
                    // 12.CARI NILAI TIDAK KENA PAJAK
                    $data_ptkp = DB::select("select a.kodekeluarga,b.nilai from sdm_master_pegawai a,pay_tbl_ptkp b where a.kodekeluarga=b.kdkel and a.nopeg='$data->nopeg'");
                            
                    if(!empty($data_ptkp)){
                        foreach($data_ptkp as $data_p)
                        {
                            if($data_p->nilai <> ""){
                                $nilaiptkp1 = $data_p->nilai;
                            }else {
                                $nilaiptkp1 = '0';
                            }
                        }
                    }else{
                            $nilaiptkp1 = '0';
                    }

                    // 13.PENGHASILAN KENA PAJAK SETAHUN
                    $nilaikenapajaka = $neto1tahun - $nilaiptkp1;
                    TblPajak::where('tahun', $data_tahun)
                                    ->where('bulan',$data_bulan)
                                    ->where('nopeg',$data->nopeg)
                                    ->update([
                                        'ptkp' => $nilaiptkp1,
                                        'pkp' => $nilaikenapajaka,
                                    ]);

                    // 14.HITUNG PAJAK PENGHASILAN TERUTANG PAJAK SETAHUN                      
                    $nilai2 = 0;
                    $nilai1 = 0;
                    $tunjangan = 0;
                    $pajakbulan=1;
                    $nilaikenapajak = $nilaikenapajaka;
                    $sisapokok = $nilaikenapajak;
                    $data_sdmprogresif = DB::select("select * from sdm_tbl_progressif order by awal asc");
                    // SdmTblProgressif::orderBy('awal','asc');
                    // $pph21ok = 0;
                    foreach($data_sdmprogresif as $data_prog)
                    {
                        $awal = $data_prog->awal;
                        $akhir = $data_prog->akhir;
                        $persen = $data_prog->prosen;
                        $prosen = $persen/100;
                        $range = $akhir - $awal;
                        if($sisapokok > 0){
                            $sisapokok1 = $sisapokok;
                            if($sisapokok1 > 0 and $sisapokok1 < $range){
                                $pph21r = $sisapokok1 * $prosen;
                            }elseif($sisapokok1 > 0 and $sisapokok1 >= $range ){
                                $pph21r = $range * $prosen;
                            }else{
                                $pph21r = 0;
                            }
                        }else {
                            $pph21r = 0;
                        }
                        $pph21ok =  $pph21r;
                        $pajakbulan = ($pph21ok/12);
                    } 
                    PayMasterUpah::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '26',        
                                'jmlcc' => '0',        
                                'ccl' => '0',        
                                'nilai' => $pajakbulan * -1,        
                                'userid' => $request->userid,        
                                ]); 
                    PayMasterUpah::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '27',        
                                'jmlcc' => '0',        
                                'ccl' => '0',        
                                'nilai' => $pajakbulan,        
                                'userid' => $request->userid,        
                                ]); 
                    TblPajak::where('tahun', $data_tahun)
                                    ->where('bulan',$data_bulan)
                                    ->where('nopeg',$data->nopeg)
                                    ->update([
                                        'pajak_setor' => $pajakbulan,
                                    ]);
                    
                    }

                    // PekerjaBantu()
                    $data_pegawai_kontrak = SdmMasterPegawai::where('status','B')->orderBy('nopeg', 'asc')->get();
                    foreach($data_pegawai_kontrak as $data)
                    {
                        TblPajak::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopeg' => $data->nopeg,
                                'status' => $data->kodekeluarga,        
                                ]);
                        
                        // 1.CARI NILAI UPAH ALL IN AARD 02

                       $data_sdmallin = DB::select("select nilai from sdm_allin where nopek='$data->nopeg'");
                       if(!empty($data_sdmallin)){
                           foreach($data_sdmallin as $data_sdm)
                                {
                                    if($data_sdm->nilai <> ""){
                                        $upahallin = $data_sdm->nilai;
                                    }else {
                                        $upahallin ='0';
                                    }
                                }
                        }else {
                            $upahallin ='0';
                        } 

                        PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '02',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $upahallin,        
                                    'userid' => $request->userid,        
                                    ]);
                            
                        TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'upah' => $upahallin,
                                ]);

                            //2.CARI UPAH TETAP AARD 01
                            $data_sdmut = DB::select("select a.ut from sdm_ut a where a.nopeg='$data->nopeg' and a.mulai=(select max(mulai) from sdm_ut where nopeg='$data->nopeg')");
                            if(!empty($data_sdmut)){
                                    foreach($data_sdmut as $data_sdm)
                                    {
                                        $upahtetap = $data_sdm->ut;
                                    }
                            }else{
                                $upahtetap = '0';
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '01',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $upahtetap,        
                                    'userid' => $request->userid,        
                                    ]);
                            
                            TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'upah' => $upahtetap,
                                ]);

                             // 2.CARI UPAH TETAP AARD 01
                            $data_sdmut = DB::select("select a.ut from sdm_ut a where a.nopeg='$data->nopeg' and a.mulai=(select max(mulai) from sdm_ut where nopeg='$data->nopeg')");
                            if(!empty($data_sdmut)){
                                    foreach($data_sdmut as $data_sdm)
                                    {
                                        $upahtetap = $data_sdm->ut;
                                    }
                            }else{
                                $upahtetap = '0';
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '01',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $upahtetap,        
                                    'userid' => $request->userid,        
                                    ]);
                            
                            TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'upah' => $upahtetap,
                                ]);

                            // 3.CARI UPAH TETAP AARD 01
                            $data_sdmut = DB::select("select a.ut from sdm_ut a where a.nopeg='$data->nopeg' and a.mulai=(select max(mulai) from sdm_ut where nopeg='$data->nopeg')");
                            if(!empty($data_sdmut)){
                                    foreach($data_sdmut as $data_sdm)
                                    {
                                        $upahtetap = $data_sdm->ut;
                                    }
                            }else{
                                $upahtetap = '0';
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '01',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $upahtetap,        
                                    'userid' => $request->userid,        
                                    ]);
                            
                            TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'upah' => $upahtetap,
                                ]);

                            $data_sdmut = DB::select("select a.ut from sdm_ut a where a.nopeg='$data->nopeg' and a.mulai=(select max(mulai) from sdm_ut where nopeg='$data->nopeg')");
                            if(!empty($data_sdmut)){
                                    foreach($data_sdmut as $data_sdm)
                                    {
                                        if($data_sdm->ut <> ""){
                                            $upahtetap = $data_sdm->ut;
                                        }else {
                                            $upahtetap = '0';
                                        }
                                    }
                            }else{
                                $upahtetap = '0';
                            }

                            UtBantu::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,    
                                    'nilai' => $upahtetap,        
                                    ]);

                            //4.UPAH TETAP PENSIUN
                            $data_pensiun = DB::select("select a.ut from sdm_ut_pensiun a where a.nopeg='$data->nopeg' and a.mulai=(select max(mulai) from sdm_ut_pensiun where nopeg='$data->nopeg')");
                            if(!empty($data_pensiun)){
                                foreach($data_pensiun as $data_pen)
                                {
                                    if($data->ut <> ""){
                                        $upahtetappensiun = $data_pen->ut;
                                    }else{
                                        $upahtetappensiun = '0';
                                    }
                                }
                            }else {
                                $upahtetappensiun = '0';
                            }

                            // 5.FASILITAS CUTI AARD 06
                            $data_cuti = DB::select("select a.fasilitas,a.fasilitas  from sdm_master_pegawai a where a.nopeg='$data->nopeg'");
                            if(!empty($data_cuti)){
                              foreach($data_cuti as $data_cut)
                              {
                                $tahun = date('Y', strtotime($data_cut->fasilitas));
                                $bulan = ltrim(date('m', strtotime($data_cut->fasilitas)),'0');
                                $sisatahun = $data_tahun - $tahun;
                                $sisabulan = $data_bulan - $bulan;
                                  if($sisabulan == '11' and $sisatahun == '0'){
                                    $fasilitas = '0';
                                    //   $uangcuti = $upahallin + $tunjabatan + $tunjangandaerah;
                                    //   $fasilitas = 1.5 * $uangcuti;
                                  }elseif($sisabulan == '11' and $sisatahun > '0'){
                                    $fasilitas = '0';
                                    // $uangcuti = $upahallin + $tunjabatan + $tunjangandaerah;
                                    // $fasilitas = 1.5 * $uangcuti;
                                  }elseif($sisabulan == '-1' and $sisatahun > '0'){
                                    $fasilitas = '0';
                                    // $uangcuti = $upahallin + $tunjabatan + $tunjangandaerah;
                                    // $fasilitas = 1.5 * $uangcuti;
                                  }else{
                                      $fasilitas = '0';
                                  }
                              }
                          }else {
                              $fasilitas = '0';
                          }

                        PayMasterUpah::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '06',        
                                'jmlcc' => '0',        
                                'ccl' => '0',        
                                'nilai' => $fasilitas,        
                                'userid' => $request->userid,        
                                ]); 

                        TblPajak::where('tahun', $data_tahun)
                            ->where('bulan',$data_bulan)
                            ->where('nopeg',$data->nopeg)
                            ->update([
                                'gapok' => $fasilitas,
                            ]);

                        // 6.CARI NILAI LEMBUR AARD 05
                        $data_lembur = DB::select("select sum(makanpg+makansg+makanml+transport+lembur) as totlembur from pay_lembur where nopek='$data->nopeg' and bulan='$data_bulan' and tahun='$data_tahun'");                            
                        if(!empty($data_lembur)){
                                foreach($data_lembur as $data_sdm)
                                {
                                    if($data_sdm->totlembur <> ""){
                                        $totallembur = $data_sdm->totlembur;
                                    }else{
                                        $totallembur = '0';
                                    }
                                }
                        }else{
                            $totallembur = '0';
                        }
                        PayMasterUpah::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '05',        
                                'jmlcc' => '0',        
                                'ccl' => '0',        
                                'nilai' => $totallembur,        
                                'userid' => $request->userid,        
                                ]); 

                        // 7.CARI SISA BULAN LALU AARD 07
                        $data_sisanilai = DB::select("select nopek,aard,jmlcc,ccl,nilai from pay_koreksi where bulan='$data_bulans' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='07'");
                        if(!empty($data_sisanilai)){
                            foreach($data_sisanilai as $data_sdm)
                            {
                                if($data_sdm->nilai <> ""){
                                    $fassisa = $data_sdm->nilai;
                                }else {
                                    $fassisa = '0';
                                }
                            }
                        }else{
                            $fassisa = '0';
                        }
                        PayMasterUpah::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '07',        
                                'jmlcc' => '0',        
                                'ccl' => '0',        
                                'nilai' => $fassisa,        
                                'userid' => $request->userid,        
                                ]); 

                        // 8.CARI NILAI KOREKSI JAMSOSTEK PEKERJA 29
                        $data_koreksijamsostek = DB::select("select sum(nilai) as nilai from pay_koreksi where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='29'");
                        if(!empty($data_koreksijamsostek)){
                            foreach($data_koreksijamsostek as $data_korek)
                            {
                                if($data_korek->nilai <> ""){
                                    $iujampek = $data_korek->nilai;
                                }else {
                                    $iujampek = '0';
                                }
                            }
                        }else {
                            $iujampek = '0';
                        }
                        PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '29',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $iujampek,        
                                    'userid' => $request->userid,        
                                    ]); 
                            
                            // 9.HITUNG IURAN JAMSOSTEK PRIBADI DAN PERUSAHAAN
                            $data_iuranjamsostek = DB::select("select gapok from sdm_gapok where nopeg = '$data->nopeg' and mulai=(select max(mulai) from sdm_gapok where nopeg='$data->nopeg')");
                            if(!empty($data_iuranjamsostek)){
                                foreach($data_iuranjamsostek as $data_iuran)
                                {
                                    if($data_iuran->gapok <> ""){
                                        $gapok = $data_iuran->gapok;
                                    }else {
                                        $gapok = '0';
                                    }
                                }
                            }else {
                                $gapok = '0';
                            }
                            PayGapokBulanan::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'jumlah' => $gapok,
                                        ]); 

                            // 10.CARI NILAI PERSENTASE DARI TABEL PAY_TABLE_JAMSOSTEK
                            $data_persentasejm = DB::select("select pribadi,accident,pensiun,life,manulife from pay_tbl_jamsostek");
                            if(!empty($data_persentasejm)){
                                foreach($data_persentasejm as $data_per)
                                {
                                    $jsmanualife = ($data_per->life/100);
                                    if($data->nopeg <> '709685'){
                                        $niljspribadi = ($data_per->pribadi/100) * $gapok;
                                        $niljstaccident = ($data_per->accident/100) * $gapok;
                                        $niljspensiun = ($data_per->pensiun/100) * $gapok;
                                        $niljslife = ($data_per->life/100) * $gapok;
                                    }else{
                                        $niljspribadi = '0';
                                        $niljstaccident = '0';
                                        $niljspensiun = '0';
                                        $niljslife = '0';
                                    }
                                }
                                $niljsmanualife = $jsmanualife * $upahtetap;
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '09',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $niljspribadi * -1,        
                                    'userid' => $request->userid,        
                                    ]); 

                            PayMasterBebanprshn::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '10',        
                                    'lastamount' => '0',        
                                    'curramount' => $niljstaccident,       
                                    'userid' => $request->userid,        
                                    ]);
                            PayMasterBebanprshn::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '11',        
                                    'lastamount' => '0',        
                                    'curramount' => $niljspensiun,       
                                    'userid' => $request->userid,        
                                    ]);

                            PayMasterBebanprshn::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '12',        
                                'lastamount' => '0',        
                                'curramount' => $niljslife,       
                                'userid' => $request->userid,        
                                ]);
                            PayMasterBebanprshn::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopek' => $data->nopeg,
                                'aard' => '13',        
                                'lastamount' => '0',        
                                'curramount' => $niljsmanualife,       
                                'userid' => $request->userid,        
                                ]);

                            // 11.HITUNG IURAN DANA PENSIUN BEBAN PEKERJA DAN PERUSAHAAN
                            $data_iurandanapensiun = DB::select("select pribadi,perusahaan,perusahaan3 from pay_tbl_danapensiun");
                            foreach($data_iurandanapensiun as $data_iuran)
                            {
                                $dapenpribadi = $data_iuran->pribadi;
                                $dapenperusahaan = $data_iuran->perusahaan;
                                $dapenperusahaan3 = $data_iuran->perusahaan3;
                            }
                            if($data->nopeg <> '709685'){
                                // HITUNG IURAN DANA PENSIUN PEKERJA/PRIBADI 
                                $nildapenpribadi = ($dapenpribadi/100) * $upahtetappensiun;
                                // HITUNG IURAN DANA PENSIUN BEBAN PERUSAHAAN
                                $nildapenperusahaan = ($dapenperusahaan/100) * $upahtetappensiun;
                                if($data->nopeg == '709669'){
                                    $nildapenbni = ($dapenperusahaan3/100) * $upahtetap;
                                    PayMasterBebanprshn::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '46',        
                                        'lastamount' => '0',        
                                        'curramount' => $nildapenbni,       
                                        'userid' => $request->userid,        
                                        ]);
                                }elseif($data->nopeg == '694287'){
                                    $bazma = (2.5/100)*($upahallin - ($nildapenpribadi+$niljspribadi));
                                    PayMasterUpah::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $data->nopeg,
                                            'aard' => '36',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $bazma * -1,        
                                            'userid' => $request->userid,        
                                            ]); 
                                }else{
                                    PayMasterUpah::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $data->nopeg,
                                            'aard' => '36',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => '0',        
                                            'userid' => $request->userid,        
                                            ]); 
                                }
                            }else{
                                $nildapenpribadi = '0';
                                $nildapenperusahaan = '0';
                            }

                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '14',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $nildapenpribadi * -1,        
                                    'userid' => $request->userid,        
                                    ]); 
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '15',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $nildapenperusahaan,        
                                    'userid' => $request->userid,        
                                    ]); 
                            TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'dapen_pek' => $nildapenpribadi,
                                ]);

                            // 11.HITUNG TABUNGAN AARD 16
                            $data_tabungan = DB::select("select perusahaan from pay_tbl_tabungan");
                            if(!empty($data_tabungan)){
                                foreach($data_tabungan as $data_tab)
                                {
                                    if($data->nopeg <> '709685'){
                                        $iuranwajib = ($data_tab->perusahaan/100) * $upahtetap;
                                    }else{
                                        $iuranwajib = '0';
                                    }
                                }
                            }else {
                                $iuranwajib = '0';
                            }
                            PayMasterBebanprshn::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '16',        
                                        'lastamount' => '0',        
                                        'curramount' => $iuranwajib,       
                                        'userid' => $request->userid,        
                                        ]);

                            // 12.CARI NILAI POTONGAN PKPP AARD 17 DAN HUTANG PKPP AARD 20
                            $data_nilaipotongan = DB::select("select id_pinjaman,jml_pinjaman as jumlah,tenor as lamanya,round(angsuran,0) as angsuran from pay_mtrpkpp where nopek='$data->nopeg' and cair ='Y' and lunas<>'Y'");
                            if(!empty($data_nilaipotongan)){
                                foreach($data_nilaipotongan as $data_nilai)
                                {
                                    $idpinjaman = $data_nilai->id_pinjaman;
                                    $totalpinjaman = $data_nilai->jumlah;
                                    $lamapinjama = $data_nilai->lamanya;
                                    $jumlahangsuran = $data_nila->angsuran * -1;
                                }
                                $data_potonganpkpp2 = DB::select("select round(sum(pokok)) as totalpokok,count(*) as cclke from pay_skdpkpp where nopek='$data->nopeg' and tahun <= '$data_tahun' and bulan <= '$data_bulans' and id_pinjaman='$idpinjaman'");
                                foreach($data_potonganpkpp2 as $data_potong)
                                {
                                    $totalpokok = $data_potong->totalpokok;
                                    $cclke = $data_potong->cclke;
                                    $sisacicilan = $totalpinjaman - $totalpokok;
                                }
                                if($cclke == '0'){
                                    $jumlahangsuran = '0';
                                }
                            PayMasterHutang::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '20',        
                                        'lastamount' => '0',        
                                        'curramount' => $sisacicilan,       
                                        'userid' => $request->userid,        
                                        ]);
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '17',        
                                    'jmlcc' => $lamapinjama,        
                                    'ccl' => $cclke,        
                                    'nilai' => $jumlahangsuran,        
                                    'userid' => $request->userid,        
                                    ]); 
                            }else {
                                $lamapinjama = '0';
                                $cclke = '0';
                                $jumlahangsuran = '0';
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '17',        
                                    'jmlcc' => $lamapinjama,        
                                    'ccl' => $cclke,        
                                    'nilai' => $jumlahangsuran,        
                                    'userid' => $request->userid,        
                                    ]);
                            }

                            // 13.CARI NILAI POTONGAN PANJAR PESANGON AARD 18 DAN HUTANG PPRP AARD 21
                            $data_nilaipotonganpanjar = DB::select("select nopek,aard,jmlcc,ccl,nilai from pay_potongan where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='18'");
                            if(!empty($data_nilaipotonganpanjar)){
                                foreach($data_nilaipotonganpanjar as $data_nilai)
                                {
                                    $jmlccpotongpprp = $data_nilai->jmlcc;
                                    $cclpotongpprp = $data_nilai->ccl;
                                    if($data_nilai->bilai < 0){
                                        $nilaipotongpprp = $data_nilai->nilai * -1;
                                    }else{
                                        $nilaipotongpprp = $data_nila->nilai;
                                    }
                                }
                                $data_carihutangpprp = DB::select("select tahun,bulan,aard,lastamount,curramount from pay_master_hutang where (tahun||bulan)=(select max(tahun||bulan) from pay_master_hutang where nopek='$data->nopeg' and aard='21') and nopek='$data->nopeg' and aard='21'");
                                foreach($data_carihutangpprp as $data_cari)
                                {
                                    $tahunhutangpprp = $data_cari->tahun;
                                    $bulanhutangpprp = $data_cari->bulan;
                                    $aardhutangpprp = $data_cari->aard;
                                    $lasthutangpprp = $data_cari->lastamount;
                                    $currhutangpprp = $data_cari->curramount;
                                    $lasthutangpprp1 = $currhutangpprp;
                                    $currhutangpprp1 = ($currhutangpprp - $nilaipotongpprp);
                                }
                            PayMasterHutang::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '21',        
                                        'lastamount' => $lasthutangpprp1,        
                                        'curramount' => $currhutangpprp1,       
                                        'userid' => $request->userid,        
                                        ]);
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '18',        
                                    'jmlcc' => $jmlccpotongpprp,        
                                    'ccl' => $cclpotongpprp,        
                                    'nilai' => $jumlahangsuran,        
                                    'userid' => $request->userid,        
                                    ]); 
                            }else {
                                $jmlccpotongpprp = '0';
                                $cclpotongpprp = '0';
                                $jumlahangsuran = '0';
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '18',        
                                    'jmlcc' => $jmlccpotongpprp,        
                                    'ccl' => $cclpotongpprp,        
                                    'nilai' => $jumlahangsuran,        
                                    'userid' => $request->userid,        
                                    ]);
                            }

                            // 14.POTONGAN KOPERASI AARD 28
                            $data_potongankoperasi = DB::select("select nopek,aard,jmlcc,ccl,nilai from pay_potongan where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='28'");
                            if(!empty($data_potongankoperasi)){
                                foreach($data_potongankoperasi as $data_potongankop)
                                {
                                    $jmlccpotongkoperasi = $data_potongankop->jmlcc;
                                    $cclpotongkoperasi = $data_potongankop->ccl;
                                    if($data_potongankop->nilai < 0){
                                        $nilaipotongkoperasi = $data_potongankop->nilai;
                                    }else{
                                        $nilaipotongkoperasi = $data_potongankop->nilai * -1;
                                    }
                                }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '28',        
                                    'jmlcc' => $jmlccpotongkoperasi,        
                                    'ccl' => $cclpotongkoperasi,        
                                    'nilai' => $nilaipotongkoperasi,        
                                    'userid' => $request->userid,        
                                    ]);
                            }else {
                                $jmlccpotongkoperasi = '0';
                                $cclpotongkoperasi = '0';
                                $nilaipotongkoperasi = '0';
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '28',        
                                    'jmlcc' => $jmlccpotongkoperasi,        
                                    'ccl' => $cclpotongkoperasi,        
                                    'nilai' => $nilaipotongkoperasi,        
                                    'userid' => $request->userid,        
                                    ]);
                            }

                            // 15.POTONGAN SUKA DUKA AARD 44
                            $data_potongansukaduka = DB::select("select nopek,aard,jmlcc,ccl,nilai from pay_potongan where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='44'");
                            if(!empty($data_potongansukaduka)){
                                foreach($data_potongansukaduka as $data_potongansuka)
                                {
                                    $jmlccpotongsukaduka = $data_potongansuka->jmlcc;
                                    $cclpotongsukaduka = $data_potongansuka->ccl;
                                    if($data_potongansuka->nilai < 0){
                                        $nilaipotongsukaduka = $data_potongansuka->nilai;
                                    }else {
                                        $nilaipotongsukaduka = $data_potongansuka->nilai * -1;
                                    }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '44',        
                                    'jmlcc' => $jmlccpotongsukaduka,        
                                    'ccl' => $cclpotongsukaduka,        
                                    'nilai' => $nilaipotongsukaduka,        
                                    'userid' => $request->userid,        
                                    ]);
                                }
                            }else {
                                $jmlccpotongsukaduka = '0';
                                $cclpotongsukaduka = '0';
                                $nilaipotongsukaduka = '0';
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '44',        
                                    'jmlcc' => $jmlccpotongsukaduka,        
                                    'ccl' => $cclpotongsukaduka,        
                                    'nilai' => $nilaipotongsukaduka,        
                                    'userid' => $request->userid,        
                                    ]);
                            }

                            // 16.HITUNG TOTAL GAJI YANG DI DAPAT
                            $data_hitungtotalgaji = DB::select("select sum(nilai) as gajiasli,(sum(nilai)-round(sum(nilai),-3)) as pembulatan1,round(sum(nilai),-3) as hasil,(1000+(sum(nilai)-round(sum(nilai),-3))) as pembulatan2  from pay_master_upah where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg'");
                            if(!empty($data_hitungtotalgaji)){
                                foreach($data_hitungtotalgaji as $data_hitungtotal)
                                {
                                    if($data_hitungtotal->pembulatan1 < 0){
                                        $sisagaji = $data_hitungtotal->pembulatan2;
                                    }else {
                                        $sisagaji = $data_hitungtotal->pembulatan1;
                                    }
                                }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '23',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $sisagaji * -1,        
                                    'userid' => $request->userid,        
                                    ]);
                            }

                            $bulan2 = $data_bulan + 1;
                            if($bulan2 > 12){
                                $data_bulan2 = 1;
                                $data_tahun2 = $data_tahun + 1;
                            }else{
                                $data_bulan2 =$bulan2;
                                $data_tahun2 = $data_tahun;
                            }
                            PayKoreksi::insert([
                                            'tahun' => $data_tahun2,
                                            'bulan' => $data_bulan2,
                                            'nopek' => $data->nopeg,
                                            'aard' => '07',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $sisagaji,        
                                            'userid' => $request->userid,        
                                            ]); 

                            // 17.CARI NILAI YANG KENA PAJAK (BRUTO)
                            $data_kenapajak = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$data_tahun' and a.bulan='$data_bulan' and a.nopek='$data->nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                            if(!empty($data_kenapajak)){
                                foreach($data_kenapajak as $data_kena)
                                {
                                    $nilaikenapajak1 = $data_kena->nilai1;
                                }
                            }else {
                                $nilaikenapajak1 = '0';
                            }
                            $totkenapajak = (($nilaikenapajak1 + $fasilitas)*12);

                            // 18. CARI NILAI PENGURANG HITUNG BIAYA JABATAN
                            $biayajabatan2 = ((5/100) * $totkenapajak);
                            if($biayajabatan2 > 6000000){
                                $biayajabatan = 6000000;  
                            }else{
                                $biayajabatan = $biayajabatan2;
                            }                              
                            
                            $neto1tahun =  $totkenapajak - $biayajabatan;
                             TblPajak::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopeg',$data->nopeg)
                                        ->update([
                                            'bjabatan' => $biayajabatan,
                                        ]);

                            // 19.CARI NILAI TIDAK KENA PAJAK
                            $data_carinilairdkkenapajak = DB::select("select a.kodekeluarga,b.nilai from sdm_master_pegawai a,pay_tbl_ptkp b where a.kodekeluarga=b.kdkel and a.nopeg='$data->nopeg'");
                            if(!empty($data_carinilairdkkenapajak)){
                                foreach($data_carinilairdkkenapajak as $data_carinilai)
                                {
                                    $nilaiptkp1 = $data_carinilai->nilai;
                                }
                            }else {
                                    $nilaiptkp1 = '0';
                            }

                            // 20.PENGHASILAN KENA PAJAK SETAHUN	
                            $nilaikenapajaka = $neto1tahun - $nilaiptkp1;
                            TblPajak::where('tahun', $data_tahun)
                                            ->where('bulan',$data_bulan)
                                            ->where('nopeg',$data->nopeg)
                                            ->update([
                                                'ptkp' => $nilaiptkp1,
                                                'pkp' => $nilaikenapajaka,
                                            ]);

                            // 20.HITUNG PAJAK PENGHASILAN TERUTANG
                            $nilai2 = 0;
                            $nilai1 = 0;
                            $tunjangan = 0;
                            $pajakbulan=1;
                            $nilaikenapajak = $nilaikenapajaka;
                            $sisapokok = $nilaikenapajak;
                            $data_sdmprogresif = DB::select("select * from sdm_tbl_progressif order by awal asc");
                            // SdmTblProgressif::orderBy('awal','asc');
                            // $pph21ok = 0;
                            foreach($data_sdmprogresif as $data_prog)
                            {
                                $awal = $data_prog->awal;
                                $akhir = $data_prog->akhir;
                                $persen = $data_prog->prosen;
                                $prosen = $persen/100;
                                $range = $akhir - $awal;
                                if($sisapokok > 0){
                                    $sisapokok1 = $sisapokok;
                                    if($sisapokok1 > 0 and $sisapokok1 < $range){
                                        $pph21r = $sisapokok1 * $prosen;
                                    }elseif($sisapokok1 > 0 and $sisapokok1 >= $range ){
                                        $pph21r = $range * $prosen;
                                    }else{
                                        $pph21r = 0;
                                    }
                                }else {
                                    $pph21r = 0;
                                }
                                $pph21ok =  $pph21r;
                                $pajakbulan = ($pph21ok/12);
                            }
                            PayMasterUpah::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '26',        
                                        'jmlcc' => '0',        
                                        'ccl' => '0',        
                                        'nilai' => $pajakbulan * -1,        
                                        'userid' => $request->userid,        
                                        ]); 
                            PayMasterUpah::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '27',        
                                        'jmlcc' => '0',        
                                        'ccl' => '0',        
                                        'nilai' => $pajakbulan,        
                                        'userid' => $request->userid,        
                                        ]); 
                            TblPajak::where('tahun', $data_tahun)
                                            ->where('bulan',$data_bulan)
                                            ->where('nopeg',$data->nopeg)
                                            ->update([
                                                'pajak_setor' => $pajakbulan,
                                            ]); 
                    }


                        // Pengurus()
                        $data_pegawai_kontrak = SdmMasterPegawai::where('status','U')->orderBy('nopeg', 'asc')->get();
                        foreach($data_pegawai_kontrak as $data)
                        {
                            TblPajak::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopeg' => $data->nopeg,
                                    'status' => $data->kodekeluarga,        
                                    ]);

                             // 1.CARI NILAI UPAH ALL IN AARD 02
                            $data_sdmallin = DB::select("select nilai from sdm_allin where nopek='$data->nopeg'");
                            if(!empty($data_sdmallin)){
                                foreach($data_sdmallin as $data_sdm)
                                        {
                                            if($data_sdm->nilai <> ""){
                                                $upahallin = $data_sdm->nilai;
                                            }else {
                                                $upahallin ='0';
                                            }
                                        }
                                }else {
                                    $upahallin ='0';
                                } 
                            
                                PayMasterUpah::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $data->nopeg,
                                            'aard' => '02',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $upahallin,        
                                            'userid' => $request->userid,        
                                            ]);
                                    
                                TblPajak::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopeg',$data->nopeg)
                                        ->update([
                                            'upah' => $upahallin,
                                        ]);

                                // 2.CARI NILAI SISA BULAN LALU AARD 07
                                $data_sisanilai = DB::select("select nopek,aard,jmlcc,ccl,round(nilai) as nilai from pay_koreksi where bulan='$data_bulans' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='07'");
                                if(!empty($data_sisanilai)){
                                        foreach($data_sisanilai as $data_sdm)
                                        {
                                            if($data_sdm->nilai <> ""){
                                                $fassisa = $data_sdm->nilai;
                                            }else{
                                                $fassisa = '0';
                                            }
                                        }
                                }else{
                                    $fassisa = '0';
                                }
                                PayMasterUpah::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '07',        
                                        'jmlcc' => '0',        
                                        'ccl' => '0',        
                                        'nilai' => $fassisa,        
                                        'userid' => $request->userid,        
                                        ]); 

                                // 3.CARI NILAI KOREKSI LAIN AARD 08
                                $data_carinilaikoreksi = DB::select("select sum(nilai) as nilai from pay_koreksi where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='08'");
                                if(!empty($data_carinilaikoreksi)){
                                    foreach($data_carinilaikoreksi as $data_carinilai)
                                    {
                                        if($data_carinilai->nilai <> ""){
                                            $faslain = $data_carinilai->nilai;
                                        }else{
                                            $faslain = '0';
                                        }
                                    }
                                }else {
                                    $faslain = '0';
                                }

                                PayMasterUpah::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '08',        
                                        'jmlcc' => '0',        
                                        'ccl' => '0',        
                                        'nilai' => $faslain,        
                                        'userid' => $request->userid,        
                                        ]); 

                                // 4.HITUNG TOTAL GAJI YANG DI DAPAT 
                                $totalgaji = DB::select("select sum(nilai) as gajiasli,(sum(nilai)-round(sum(nilai),-3)) as pembulatan1,round(sum(nilai),-3) as hasil,(1000+(sum(nilai)-round(sum(nilai),-3))) as pembulatan2  from pay_master_upah where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg'");
                                if(!empty($totalgaji)){
                                    foreach($totalgaji as $total)
                                    {
                                        if($total->pembulatan1 < 0){
                                            $sisagaji = $total->pembulatan2;
                                        }else{
                                            $sisagaji = $total->pembulatan1;
                                        }
                                    }
                                }else{
                                    $sisagaji = '0';
                                }
                                PayMasterUpah::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $data->nopeg,
                                            'aard' => '23',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $sisagaji * -1,        
                                            'userid' => $request->userid,        
                                            ]); 

                            
                                $bulan2 = $data_bulan + 1;
                                if($bulan2 >12){
                                    $data_bulan2 = 1;
                                    $data_tahun2 = $data_tahun + 1;
                                }else{
                                    $data_bulan2 =$bulan2;
                                    $data_tahun2 = $data_tahun;
                                }
                                PayKoreksi::insert([
                                                    'tahun' => $data_tahun2,
                                                    'bulan' => $data_bulan2,
                                                    'nopek' => $data->nopeg,
                                                    'aard' => '07',        
                                                    'jmlcc' => '0',        
                                                    'ccl' => '0',        
                                                    'nilai' => $sisagaji,        
                                                    'userid' => $request->userid,        
                                                    ]); 

                                // 5.HITUNG PAJAK PPH21 CARI NILAI YANG KENA PAJAK (BRUTO)
                                $kenapajak = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$data_tahun' and a.bulan='$data_bulan' and a.nopek='$data->nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                                foreach($kenapajak as $kenap)
                                {
                                    if($kenap->nilai1 <> ""){
                                        $nilaikenapajak1 = $kenap->nilai1;
                                    }else{
                                        $nilaikenapajak1 = '0';
                                    }
                                }
                                $nilaikenapajaka = $nilaikenapajak1;
                                TblPajak::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopeg',$data->nopeg)
                                        ->update([
                                            'pkp' => $nilaikenapajaka,
                                        ]);

                                if($data->nopeg == "kom9" or $data->nopeg == "kom4"){
                                    $tunjpajak = (15/100) * $nilaikenapajaka;
                                    $potpajak = ((30/100)*($nilaikenapajaka + $tunjpajak));
                                }elseif($data->nopeg == "komut1"){
                                    $tunjpajak = (15/100) * $nilaikenapajaka;
                                    $potpajak = (30/100) * ($nilaikenapajaka + $tunjpajak);
                                }elseif($data->nopeg == "kom5"){
                                    $tunjpajak = (5/100) * $nilaikenapajaka;
                                    $potpajak = (15/100) * ($nilaikenapajaka + $tunjpajak);
                                }else{
                                    $tunjpajak = (5/100) * $nilaikenapajaka;
                                    $potpajak = (30/100) * ($nilaikenapajaka + $tunjpajak);
                                }
                                PayMasterUpah::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $data->nopeg,
                                            'aard' => '27',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $tunjpajak,        
                                            'userid' => $request->userid,        
                                            ]);
                                PayMasterUpah::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $data->nopeg,
                                            'aard' => '26',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $potpajak,        
                                            'userid' => $request->userid,        
                                            ]);
                               

                                $data_caripajak1 = DB::select("select round(nilai,-2) as pajaknya from pay_master_upah where tahun='$data_tahun' and bulan='$data_bulan' and nopek='$data->nopeg' and aard='27'");
                                foreach($data_caripajak1 as $data_pajak1)
                                {
                                    $tunjpa = $data_pajak1->pajaknya;
                                }
                                
                                $data_caripajak2 = DB::select("select round(nilai,-2) as pajaknya from pay_master_upah where tahun='$data_tahun' and bulan='$data_bulan' and nopek='$data->nopeg' and aard='26'");
                                foreach($data_caripajak2 as $data_pajak2)
                                {
                                    $potpa = $data_pajak2->pajaknya;
                                }

                                PayMasterUpah::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopek',$data->nopeg)
                                        ->where('aard','27')
                                        ->update([
                                            'nilai' => $tunjpa,
                                        ]);
                                PayMasterUpah::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopek',$data->nopeg)
                                        ->where('aard','26')
                                        ->update([
                                            'nilai' => $potpa * -1,
                                        ]);
                                 TblPajak::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopeg',$data->nopeg)
                                        ->update([
                                            'pajak_setor' => $tunjpa,
                                        ]);
                        }
                        

                        // Komite()
                        $data_pegawai_kontrak = SdmMasterPegawai::where('status','O')->orderBy('nopeg', 'asc')->get();
                    foreach($data_pegawai_kontrak as $data)
                    {
                        TblPajak::insert([
                                'tahun' => $data_tahun,
                                'bulan' => $data_bulan,
                                'nopeg' => $data->nopeg,
                                'status' => $data->kodekeluarga,        
                                ]);

                        // 1.CARI NILAI UPAH ALL IN AARD 02
                        $data_sdmallin = DB::select("select nilai from sdm_allin where nopek='$data->nopeg'");
                        if(!empty($data_sdmallin)){
                           foreach($data_sdmallin as $data_sdm)
                                {
                                    if($data_sdm->nilai <> ""){
                                        $upahallin = $data_sdm->nilai;
                                    }else {
                                        $upahallin ='0';
                                    }
                                }
                        }else {
                            $upahallin ='0';
                        } 
                        PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '02',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $upahallin,        
                                    'userid' => $request->userid,        
                                    ]);
                            
                        TblPajak::where('tahun', $data_tahun)
                                ->where('bulan',$data_bulan)
                                ->where('nopeg',$data->nopeg)
                                ->update([
                                    'upah' => $upahallin,
                                ]);

                        // 2.HITUNG TOTAL GAJI YANG DI DAPAT 
                        $totalgaji = DB::select("select sum(nilai) as gajiasli,(sum(nilai)-round(sum(nilai),-3)) as pembulatan1,round(sum(nilai),-3) as hasil,(1000+(sum(nilai)-round(sum(nilai),-3))) as pembulatan2  from pay_master_upah where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg'");
                        if(!empty($totalgaji)){
                            foreach($totalgaji as $total)
                            {
                                if($total->pembulatan1 < 0){
                                    $sisagaji = $total->pembulatan2;
                                }else{
                                    $sisagaji = $total->pembulatan1;
                                }
                            }
                        }else{
                            $sisagaji = '0';
                        }
                        PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '23',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $sisagaji * -1,        
                                    'userid' => $request->userid,        
                                    ]); 

                    
                        $bulan2 = $data_bulan + 1;
                        if($bulan2 >12){
                            $data_bulan2 = 1;
                            $data_tahun2 = $data_tahun + 1;
                        }else{
                            $data_bulan2 =$bulan2;
                            $data_tahun2 = $data_tahun;
                        }
                        PayKoreksi::insert([
                                            'tahun' => $data_tahun2,
                                            'bulan' => $data_bulan2,
                                            'nopek' => $data->nopeg,
                                            'aard' => '07',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $sisagaji,        
                                            'userid' => $request->userid,        
                                            ]); 

                         // 3.HITUNG PAJAK PPH21 CARI NILAI YANG KENA PAJAK (BRUTO)
                         $kenapajak = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$data_tahun' and a.bulan='$data_bulan' and a.nopek='$data->nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                         foreach($kenapajak as $kenap)
                         {
                             if($kenap->nilai1 <> ""){
                                 $nilaikenapajak = $kenap->nilai1;
                             }else{
                                 $nilaikenapajak = '0';
                             }
                         }
                        $nilaikenapajaka = $nilaikenapajak;
                        TblPajak::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopeg',$data->nopeg)
                                        ->update([
                                            'pkp' => $nilaikenapajaka,
                                        ]);

                        $tunjpajak = ((5/100) * $nilaikenapajaka);
                        $potpajak = ((30/100) * ($nilaikenapajaka + $tunjpajak));
                        PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '27',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $tunjpajak,        
                                    'userid' => $request->userid,        
                                    ]); 
                        PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '26',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $potpajak,        
                                    'userid' => $request->userid,        
                                    ]); 
                        $data_caripajak1 = DB::select("select round(nilai,-2) as pajaknya from pay_master_upah where tahun='$data_tahun' and bulan='$data_bulan' and nopek='$data->nopeg' and aard='27'");
                                foreach($data_caripajak1 as $data_pajak1)
                                {
                                    $tunjpa = $data_pajak1->pajaknya;
                                }
                                
                        $data_caripajak2 = DB::select("select round(nilai,-2) as pajaknya from pay_master_upah where tahun='$data_tahun' and bulan='$data_bulan' and nopek='$data->nopeg' and aard='26'");
                                foreach($data_caripajak2 as $data_pajak2)
                                {
                                    $potpa = $data_pajak2->pajaknya;
                                }

                                PayMasterUpah::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopek',$data->nopeg)
                                        ->where('aard','27')
                                        ->update([
                                            'nilai' => $tunjpa,
                                        ]);
                                PayMasterUpah::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopek',$data->nopeg)
                                        ->where('aard','26')
                                        ->update([
                                            'nilai' => $potpa * -1,
                                        ]);
                                 TblPajak::where('tahun', $data_tahun)
                                        ->where('bulan',$data_bulan)
                                        ->where('nopeg',$data->nopeg)
                                        ->update([
                                            'pajak_setor' => $tunjpa,
                                        ]);

                    }

                        // PekerjaBaru()
                        $data_pegawai_kontrak = SdmMasterPegawai::where('status','N')->orderBy('nopeg', 'asc')->get();
                        foreach($data_pegawai_kontrak as $data)
                        {
                            $status1 = $data->status;
                            $kodekel = $data->kodekeluarga;
                            $tglaktif = date("j",strtotime($data->tglaktifdns));
                             // 1.CARI NILAI UPAH ALL IN AARD 02
                            $data_sdmallin = DB::select("select nilai from sdm_allin where nopek='$data->nopeg'");
                            if(!empty($data_sdmallin)){
                                foreach($data_sdmallin as $data_sdm)
                                        {
                                            if($data_sdm->nilai <> ""){
                                                $upahmentah = $data_sdm->nilai;
                                                $upahallin = ((30 - $tglaktif)/30) * $upahmentah;
                                            }else {
                                                $upahallin ='0';
                                            }
                                        }
                                }else {
                                    $upahallin ='0';
                                } 
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '02',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $upahallin,        
                                    'userid' => $request->userid,        
                                    ]);

                            // 2.CARI TUNJANGAN JABATAN JIKA ADA
                            $data_tunjanganjabatan = DB::select("select a.nopeg,a.kdbag,a.kdjab,b.goljob,b.tunjangan from sdm_jabatan a,sdm_tbl_kdjab b where a.nopeg='$data->nopeg' and a.kdbag=b.kdbag and a.kdjab=b.kdjab and a.mulai=(select max(mulai) from sdm_jabatan where nopeg='$data->nopeg')");
                            if(!empty($data_tunjanganjabatan)){
                                foreach($data_tunjanganjabatan as $data_tunjang)
                                {
                                    if($data_tunjang->tunjangan <> ""){
                                        if($data_tunjang->goljob <= '03'){
                                            $tunjang = $data_tunjang->tunjangan;
			                                $tunjjabatan = ((30 - $tglaktif)/30) * $tunjang;
                                        }else {
                                            $tunjjabatan = '0';
                                        }
                                    }else {
                                        $tunjjabatan = '0';
                                    }
                                }
                            }else{
                                $tunjjabatan = '0';
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '03',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $tunjjabatan,        
                                    'userid' => $request->userid,        
                                    ]);

                            // 3.CARI NILAI LEMBUR AARD 05
                            $data_carinilailembur = DB::select("select sum(makanpg+makansg+makanml+transport+lembur) as totlembur from pay_lembur where nopek='$data->nopeg' and bulan='$data_bulan' and tahun='$data_tahun'");
                            if(!empty($data_carinilailembur)){
                                foreach($data_carinilailembur as $data_carilembur)
                                {
                                    if($data_carilembur->totlembur <> ""){
                                        $totallembur = $data_carilembur->totlembur;
                                    }else {
                                        $totallembur = '0';
                                    }
                                }
                            }else {
                                $totallembur = '0';
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '05',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $totallembur,        
                                    'userid' => $request->userid,        
                                    ]);

                            // 4.CARI NILAI SISA BULAN LALU AARD 07
                            $data_sisanilai = DB::select("select nopek,aard,jmlcc,ccl,round(nilai) as nilai from pay_koreksi where bulan='$data_bulans' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='07'");
                            if(!empty($data_sisanilai)){
                                    foreach($data_sisanilai as $data_sdm)
                                    {
                                        if($data_sdm->nilai <> ""){
                                            $fassisa = $data_sdm->nilai;
                                        }else{
                                            $fassisa = '0';
                                        }
                                    }
                            }else{
                                $fassisa = '0';
                            }
                            PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '07',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $fassisa,        
                                    'userid' => $request->userid,        
                                    ]); 

                            // 5.CARI NILAI KOREKSI LAIN AARD 08
                            $data_carinilaikoreksi = DB::select("select sum(nilai) as nilai from pay_koreksi where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='08'");
                                if(!empty($data_carinilaikoreksi)){
                                    foreach($data_carinilaikoreksi as $data_carinilai)
                                    {
                                        if($data_carinilai->nilai <> ""){
                                            $faslain = $data_carinilai->nilai;
                                        }else{
                                            $faslain = '0';
                                        }
                                    }
                                }else {
                                    $faslain = '0';
                                }

                                PayMasterUpah::insert([
                                        'tahun' => $data_tahun,
                                        'bulan' => $data_bulan,
                                        'nopek' => $data->nopeg,
                                        'aard' => '08',        
                                        'jmlcc' => '0',        
                                        'ccl' => '0',        
                                        'nilai' => $faslain,        
                                        'userid' => $request->userid,        
                                        ]); 

                            // 6.CARI NILAI POTONGAN LAIN AARD 19 DAN HUTANG LAIN AARD 22
                            $data_nilaipotonganaard19 = DB::select("select nopek,aard,jmlcc,ccl,nilai from pay_potongan where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='19'");
                            if(!empty($data_nilaipotonganaard19)){
                                foreach($data_nilaipotonganaard19 as $data_nilaiaard)
                                {
                                    $jmlccpotonglain = $data_nilaiaard->jmlcc;
		                            $cclpotonglain = $data_nilaiaard->ccl;
                                    if($data_nilaiaard->nilai < 0){
                                        $nilaipotonglain = $data_nilaiaard->nilai;
                                    }else {
                                        $nilaipotonglain = $data_nilaiaard->nilai * -1;
                                    }
                                    $data_carihutanglain = DB::select("select tahun,bulan,aard,lastamount,curramount from pay_master_hutang where (tahun||bulan)=(select max(tahun||bulan) from pay_master_hutang where nopek='$data->nopeg' and aard='22') and nopek='$data->nopeg' and aard='22'");
                                    foreach($data_carihutanglain as $data_car)
                                    {
                                        $tahunhutanglain = $data_car->tahun;
                                        $bulanhutanglain = $data_car->bulan;
                                        $aardhutanglain =   $data_car->aard;
                                        $lasthutanglain = $data_car->lastamount;
                                        $currhutanglain = $data_car->curramount;
                                        
                                        $lasthutanglain1 = $currhutanglain; 
                                        $currhutanglain1 = ($currhutanglain + $nilaipotonglain);
                                         PayMasterHutang::insert([
                                                    'tahun' => $data_tahun,
                                                    'bulan' => $data_bulan,
                                                    'nopek' => $data->nopeg,
                                                    'aard' => '22',        
                                                    'lastamount' => $lasthutanglain1,        
                                                    'curramount' => $currhutanglain1,       
                                                    'userid' => $request->userid,        
                                                    ]);
                                        PayMasterUpah::insert([
                                                'tahun' => $data_tahun,
                                                'bulan' => $data_bulan,
                                                'nopek' => $data->nopeg,
                                                'aard' => '19',        
                                                'jmlcc' => $jmlccpotonglain,        
                                                'ccl' => $cclpotonglain,        
                                                'nilai' => $nilaipotonglain,        
                                                'userid' => $request->userid,        
                                                ]); 
                                    }
                                }
                            }else {
                                $jmlccpotonglain = '0';
                                $cclpotonglain = '0';
                                $nilaipotonglain = '0';
                                PayMasterUpah::insert([
                                                'tahun' => $data_tahun,
                                                'bulan' => $data_bulan,
                                                'nopek' => $data->nopeg,
                                                'aard' => '19',        
                                                'jmlcc' => $jmlccpotonglain,        
                                                'ccl' => $cclpotonglain,        
                                                'nilai' => $nilaipotonglain,        
                                                'userid' => $request->userid,        
                                                ]); 
                            }

                            // 7.HITUNG TOTAL GAJI YANG DI DAPAT 
                            $totalgaji = DB::select("select sum(nilai) as gajiasli,(sum(nilai)-round(sum(nilai),-3)) as pembulatan1,round(sum(nilai),-3) as hasil,(1000+(sum(nilai)-round(sum(nilai),-3))) as pembulatan2  from pay_master_upah where bulan='$data_bulan' and tahun='$data_tahun' and nopek='$data->nopeg'");
                                if(!empty($totalgaji)){
                                    foreach($totalgaji as $total)
                                    {
                                        if($total->pembulatan1 < 0){
                                            $sisagaji = $total->pembulatan2;
                                        }else{
                                            $sisagaji = $total->pembulatan1;
                                        }
                                    }
                                }else{
                                    $sisagaji = '0';
                                }
                                PayMasterUpah::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $data->nopeg,
                                            'aard' => '23',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $sisagaji * -1,        
                                            'userid' => $request->userid,        
                                            ]); 

                            
                                $bulan2 = $data_bulan + 1;
                                if($bulan2 >12){
                                    $data_bulan2 = 1;
                                    $data_tahun2 = $data_tahun + 1;
                                }else{
                                    $data_bulan2 =$bulan2;
                                    $data_tahun2 = $data_tahun;
                                }
                                PayKoreksi::insert([
                                                    'tahun' => $data_tahun2,
                                                    'bulan' => $data_bulan2,
                                                    'nopek' => $data->nopeg,
                                                    'aard' => '07',        
                                                    'jmlcc' => '0',        
                                                    'ccl' => '0',        
                                                    'nilai' => $sisagaji,        
                                                    'userid' => $request->userid,        
                                                    ]); 

                                // 8.HITUNG PAJAK PPH21 CARI NILAI YANG KENA PAJAK (BRUTO)
                                $kenapajak = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$data_tahun' and a.bulan='$data_bulan' and a.nopek='$data->nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                                foreach($kenapajak as $kenap)
                                {
                                    if($kenap->nilai1 <> ""){
                                        $nilaikenapajak1 = $kenap->nilai1;
                                    }else{
                                        $nilaikenapajak1 = '0';
                                    }
                                }
                                $totkenapajak = $nilaikenapajak1 * 12;
                                
                                // 9.CARI NILAI TIDAK KENA PAJAK
                                $datatdkkenapajak = DB::select("select a.kodekeluarga,b.nilai from sdm_master_pegawai a,pay_tbl_ptkp b where a.kodekeluarga=b.kdkel and a.nopeg='$data->nopeg'");
                                foreach($datatdkkenapajak as $tdkkenap)
                                {
                                    if($tdkkenap->nilai1 <> ""){
                                        $nilaiptkp1 = $tdkkenap->nilai1;
                                    }else{
                                        $nilaiptkp1 = '0';
                                    }
                                }
                                // 9.PENGHASILAN KENA PAJAK SETAHUN	
                                $nilaikenapajak = $totkenapajak - $nilaiptkp1;
                                $sisapokok = $nilaikenapajak;
                                if($sisapokok > 0){
                                    $sisapokok1 = $sisapokok;
                                    if($sisapokok1 > 0 and $sisapokok1 < $range){
                                        $pph21r = $sisapokok1 * $prosen;
                                    }elseif($sisapokok1 > 0 and $sisapokok1 >= $range ){
                                        $pph21r = $range * $prosen;
                                    }else{
                                        $pph21r = 0;
                                    }
                                }else {
                                    $pph21r = 0;
                                }
                                $pph21ok =  $pph21r;
                                $pajakbulan = ($pph21ok/12);
                                PayMasterUpah::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $data->nopeg,
                                            'aard' => '26',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $pajakbulan * -1,        
                                            'userid' => $request->userid,        
                                            ]); 
                                PayMasterUpah::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $data->nopeg,
                                            'aard' => '27',        
                                            'jmlcc' => '0',        
                                            'ccl' => '0',        
                                            'nilai' => $pajakbulan,        
                                            'userid' => $request->userid,        
                                            ]);                         
                        }    
                        // Alert::success('Data Berhasil Ditambah', 'Berhasil')->persistent(true)->autoClose(2000);
                        // return redirect()->route('proses_gaji.index');
                }elseif($request->prosesupah == 'C'){
                    // PekerjaTetap()
                }elseif($request->prosesupah == 'K'){
                    // PekerjaKontrak()
                }elseif($request->prosesupah == 'N'){
                    // PekerjaBaru()
                }elseif($request->prosesupah == 'B'){
                    // PekerjaBantu()
                }elseif($request->prosesupah == 'U'){
                    // Pengurus()
                }else{
                    // Komite()
                }
            }
        }else{
            return redirect()->route('proses_gaji.index')->with(['proses' => 'proses']);
        }

    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
