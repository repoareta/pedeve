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
                            // TblPajak::insert([
                            //     'tahun' => $data_tahun,
                            //     'bulan' => $data_bulan,
                            //     'nopeg' => $data->nopeg,
                            //     'status' => $data->kodekeluarga,        
                            //     ]); 

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
                            // PayMasterUpah::where()::insert([
                            //         'tahun' => $data_tahun,
                            //         'bulan' => $data_bulan,
                            //         'nopek' => $data->nopeg,
                            //         'aard' => '01',        
                            //         'jmlcc' => '0',        
                            //         'ccl' => '0',        
                            //         'nilai' => $upahtetap,        
                            //         'userid' => $request->userid,        
                            //         ]);
                            
                            // TblPajak::where('tahun', $data_tahun)
                            //     ->where('bulan',$data_bulan)
                            //     ->where('nopeg',$data->nopeg)
                            //     ->update([
                            //         'upah' => $upahtetap,
                            //     ]);

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
                            //PayMasterUpah::where()::insert([
                            //         'tahun' => $data_tahun,
                            //         'bulan' => $data_bulan,
                            //         'nopek' => $data->nopeg,
                            //         'aard' => '03',        
                            //         'jmlcc' => '0',        
                            //         'ccl' => '0',        
                            //         'nilai' => $tunjabatan,        
                            //         'userid' => $request->userid,        
                            //         ]); 

                            // TblPajak::where('tahun', $data_tahun)
                            //     ->where('bulan',$data_bulan)
                            //     ->where('nopeg',$data->nopeg)
                            //     ->update([
                            //         'tunjjabat' => $tunjabatan,
                            //     ]);

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
                            // PayMasterUpah::where()::insert([
                            //         'tahun' => $data_tahun,
                            //         'bulan' => $data_bulan,
                            //         'nopek' => $data->nopeg,
                            //         'aard' => '04',        
                            //         'jmlcc' => '0',        
                            //         'ccl' => '0',        
                            //         'nilai' => $tunjabatanhidup,        
                            //         'userid' => $request->userid,        
                            //         ]); 

                            // TblPajak::where('tahun', $data_tahun)
                            //     ->where('bulan',$data_bulan)
                            //     ->where('nopeg',$data->nopeg)
                            //     ->update([
                            //         'tunjdaerah' => $tunjabatanhidup,
                            //     ]);

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
                            // PayMasterUpah::where()::insert([
                            //         'tahun' => $data_tahun,
                            //         'bulan' => $data_bulan,
                            //         'nopek' => $data->nopeg,
                            //         'aard' => '06',        
                            //         'jmlcc' => '0',        
                            //         'ccl' => '0',        
                            //         'nilai' => $fasilitas,        
                            //         'userid' => $request->userid,        
                            //         ]); 

                            // TblPajak::where('tahun', $data_tahun)
                            //     ->where('bulan',$data_bulan)
                            //     ->where('nopeg',$data->nopeg)
                            //     ->update([
                            //         'gapok' => $fasilitas,
                            //     ]);

                            // 5.CARI NILAI LEMBUR AARD 05
                            $data_lembur = DB::select("select Sum(makanpg+makansg+makanml+transport+lembur) as totlembur from pay_lembur where nopek='$data->nopeg' And bulan = '$data_bulan' AND tahun='$data_tahun'");                            
                            if(!empty($data_lembur)){
                                    foreach($data_lembur as $data_sdm)
                                    {
                                        $totallembur = $data_sdm->totlembur;
                                    }
                            }else{
                                $totallembur = '0';
                            }
                            // PayMasterUpah::where()::insert([
                            //         'tahun' => $data_tahun,
                            //         'bulan' => $data_bulan,
                            //         'nopek' => $data->nopeg,
                            //         'aard' => '05',        
                            //         'jmlcc' => '0',        
                            //         'ccl' => '0',        
                            //         'nilai' => $totallembur,        
                            //         'userid' => $request->userid,        
                            //         ]); 

                            // TblPajak::where('tahun', $data_tahun)
                            //     ->where('bulan',$data_bulan)
                            //     ->where('nopeg',$data->nopeg)
                            //     ->update([
                            //         'lembur' => $totallembur,
                            //     ]);

                            // 6.CARI NILAI SISA BULAN LALU AARD 07
                            $data_sisanilai = DB::select("select nopek,aard,jmlcc,ccl,round(nilai) as nilai from pay_koreksi where bulan='$data_bulans' and tahun='$data_tahun' and nopek='$data->nopeg' and aard='07'");
                            if(!empty($data_sisanilai)){
                                    foreach($data_sisanilai as $data_sdm)
                                    {
                                        $fassisa = $data_sdm->nilai;
                                    }
                            }else{
                                $fassisa = '0';
                            }
                            // PayMasterUpah::where()::insert([
                            //         'tahun' => $data_tahun,
                            //         'bulan' => $data_bulan,
                            //         'nopek' => $data->nopeg,
                            //         'aard' => '07',        
                            //         'jmlcc' => '0',        
                            //         'ccl' => '0',        
                            //         'nilai' => $fassisa,        
                            //         'userid' => $request->userid,        
                            //         ]); 

                            //7.CARI NILAI PERSENTASE DARI TABEL PAY_TABLE_JAMSOSTEK
                            // PayGapokBulanan::insert([
                            //             'tahun' => $data_tahun,
                            //             'bulan' => $data_bulan,
                            //             'nopek' => $data->nopeg,
                            //             'jumlah' => $upahtetap,
                            //             ]); 
                            $data_jamsostek = PayTblJamsostek::all();
                            foreach($data_jamsostek as $data_jam)
                            {
                                $niljspribadi = ($data_jam->pribadi/100) * $upahtetap;
                                $niljstaccident = ($data_jam->accident/100) * $upahtetap;
                                $niljspensiun = ($data_jam->pensiun/100) * $upahtetap;
                                $niljslife = ($data_jam->life/100) * $upahtetap;
                            }
                            // PayMasterUpah::where()::insert([
                            //         'tahun' => $data_tahun,
                            //         'bulan' => $data_bulan,
                            //         'nopek' => $data->nopeg,
                            //         'aard' => '09',        
                            //         'jmlcc' => '0',        
                            //         'ccl' => '0',        
                            //         'nilai' => $niljspribadi * -1,        
                            //         'userid' => $request->userid,        
                            //         ]); 

                            // PayMasterBebanprshn::insert([
                            //         'tahun' => $data_tahun,
                            //         'bulan' => $data_bulan,
                            //         'nopek' => $data->nopeg,
                            //         'aard' => '10',        
                            //         'lastamount' => '0',        
                            //         'curramount' => $niljstaccident,       
                            //         'userid' => $request->userid,        
                            //         ]);
                            // PayMasterBebanprshn::insert([
                            //         'tahun' => $data_tahun,
                            //         'bulan' => $data_bulan,
                            //         'nopek' => $data->nopeg,
                            //         'aard' => '11',        
                            //         'lastamount' => '0',        
                            //         'curramount' => $niljspensiun,       
                            //         'userid' => $request->userid,        
                            //         ]);

                            // PayMasterBebanprshn::insert([
                            //     'tahun' => $data_tahun,
                            //     'bulan' => $data_bulan,
                            //     'nopek' => $data->nopeg,
                            //     'aard' => '12',        
                            //     'lastamount' => '0',        
                            //     'curramount' => $niljslife,       
                            //     'userid' => $request->userid,        
                            //     ]);
                            
                            //9.HITUNG IURAN DANA PENSIUN BNI SIMPONI 46
                            $data_danapensiun = PayDanaPensiun::all();
                            foreach($data_danapensiun as $data_dana)
                            {
                                $nildapenbni = ($data_dana->perusahaan3/100) * $upahtetap;
                            }
                            // PayMasterBebanprshn::insert([
                            //     'tahun' => $data_tahun,
                            //     'bulan' => $data_bulan,
                            //     'nopek' => $data->nopeg,
                            //     'aard' => '46',        
                            //     'lastamount' => '0',        
                            //     'curramount' => $nildapenbni,       
                            //     'userid' => $request->userid,        
                            //     ]);

                            // 10.HITUNG TABUNGAN AJTM AARD 16
                            $data_tabungan = PayTabunga::all();
                            foreach($data_tabungan as $data_tab)
                            {
                                $iuranwajib = ($data_tab->tabungan/100) * $upahtetap;
                            }
                            // PayMasterBebanprshn::insert([
                            //     'tahun' => $data_tahun,
                            //     'bulan' => $data_bulan,
                            //     'nopek' => $data->nopeg,
                            //     'aard' => '16',        
                            //     'lastamount' => '0',        
                            //     'curramount' => $iuranwajib,       
                            //     'userid' => $request->userid,        
                            //     ]);

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
                            // PayMasterUpah::where()::insert([
                            //             'tahun' => $data_tahun,
                            //             'bulan' => $data_bulan,
                            //             'nopek' => $data->nopeg,
                            //             'aard' => '19',        
                            //             'jmlcc' => $jmlccpotongpinjam,        
                            //             'ccl' => $cclpotongpinjam,        
                            //             'nilai' => $nilaipotonganpinjam * -1,        
                            //             'userid' => $request->userid,        
                            //             ]); 
                            
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
                            // PayMasterUpah::where()::insert([
                            //             'tahun' => $data_tahun,
                            //             'bulan' => $data_bulan,
                            //             'nopek' => $data->nopeg,
                            //             'aard' => '23',        
                            //             'jmlcc' => '0',        
                            //             'ccl' => '0',        
                            //             'nilai' => $sisagaji * -1,        
                            //             'userid' => $request->userid,        
                            //             ]); 

                        
                            $bulan2 = $data_bulan + 1;
                            if($bulan2 >12){
                                $data_bulan2 = 1;
                                $data_tahun2 = $data_tahun + 1;
                            }else{
                                $data_bulan2 =$bulan2;
                                $data_tahun2 = $data_tahun;
                            }
                            // 15.SIMPAN NILAI PEMBULATAN KE TABEL KOREKSI AARD 17 SISA BULAN LALU
                            // PayKoreksi::insert([
                            //                 'tahun' => $data_tahun2,
                            //                 'bulan' => $data_bulan2,
                            //                 'nopek' => $data->nopeg,
                            //                 'aard' => '07',        
                            //                 'jmlcc' => '0',        
                            //                 'ccl' => '0',        
                            //                 'nilai' => $sisagaji,        
                            //                 'userid' => $request->userid,        
                            //                 ]); 

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
                            
                                // TblPajak::where('tahun', $data_tahun)
                                //         ->where('bulan',$data_bulan)
                                //         ->where('nopeg',$data->nopeg)
                                //         ->update([
                                //             'bjabatan' => $biayajabatan,
                                //         ]);

                            // 18.CARI NILAI TIDAK KENA PAJAK



                        }
                        // PekerjaKontrak()
                        // PekerjaBantu()
                        // Pengurus()
                        // Komite()
                        // PekerjaBaru()
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
