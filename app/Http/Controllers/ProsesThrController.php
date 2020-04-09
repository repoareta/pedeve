<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatBayarThr;
use App\Models\PayMasterThr;
use DB;
use PDF;
use Excel;
use Alert;

class ProsesThrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proses_thr.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proses_thr.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prosesupah = $request->prosesthr;
        $tanggal = $request->tanggal;
        $tahun = substr($request->tanggal,-4);
        $bulan = ltrim(substr($request->tanggal,0,-5), '0');
        $bulans = substr($request->tanggal,0,-5);
        $tanggals = "1/$tanggal";
        $tahuns = $request->tahun;
        $keterangan = $request->keterangan;
        if($bulan - 1 == 0){
            $bulangaji="12";
            $tahungaji=$tahun - 1;
        }else{
            $bulangaji=$bulan - 1;
            $tahungaji= $tahun;
        }

        if($request->radioupah == 'proses'){
            
            if($prosesupah == 'A'){
                $data_cekthr = DB::select("Select * from pay_master_thr where tahun='$tahun'");
            }else{
                $data_cekthr = DB::select("select * from pay_master_thr where tahun='$tahun' and status='$prosesupah'");
            }

            // Cek THR
            if(!empty($data_cekthr)){
                Alert::error("Data THR bulan $bulan dan tahun $tahun sudah pernah di proses", 'Error')->persistent(true);
                return redirect()->route('proses_thr.index');
            }else {
               
                if($prosesupah == 'A'){

                    // pekerjatetapthr()
                    // 1.cari pegawai yang status pekerja tetap
                    $data_pegawaitetap = DB::select("select nopeg,kodekeluarga from sdm_master_pegawai where status='C' order by nopeg asc");
                    foreach($data_pegawaitetap as $data_pegawaite)
                    {
                        $nopeg = $data_pegawaite->nopeg;
                        $kodekel = $data_pegawaite->kodekeluarga;
                        $data_upah = DB::select("select a.ut from sdm_ut a where a.nopeg='$nopeg' and a.mulai=(select max(mulai) from sdm_ut where nopeg='$nopeg')");
                        if(!empty($data_upah)){
                            foreach($data_upah as $data_up)
                            {
                                if($data_up->ut <> ""){
                                    $upahtetap = $data_up->ut;
                                }else{
                                    $upahtetap = '0';
                                }
                            }
                        }else{
                            $upahtetap= '0';
                        }

                        // '2.tunjangan jabatan aard = 03
                        if($nopeg == "181326"){
                            $tunjjabatan = '0';
                        }else{
                             $rstunjjabatan = DB::select("select a.nopeg,a.kdbag,a.kdjab,b.goljob,b.tunjangan from sdm_jabatan a,sdm_tbl_kdjab b where a.nopeg='$nopeg' and a.kdbag=b.kdbag and a.kdjab=b.kdjab and a.mulai=(select max(mulai) from sdm_jabatan where nopeg='$nopeg')");
                            if(!empty($rstunjjabatan)){
                                foreach($rstunjjabatan as $data_tun){
                                    if($data_tun->tunjangan <> ""){
                                        $tunjjabatan = $data_tun->tunjangan;
                                    }else{
                                        $tunjjabatan = '0';
                                    }
                                }
                            }else{
                                $tunjjabatan = '0';
                            }
                        }
                        
                        // '3.tunjangan biaya hidup aard aard = 04
                        $rstunjdaerah = DB::select("select a.golgaji, b.nilai from sdm_golgaji a,pay_tbl_tunjangan b where a.nopeg='$nopeg' and a.golgaji=b.golongan and a.tanggal=(select max(tanggal) from sdm_golgaji where nopeg ='$nopeg')");
                        if(!empty($rstunjdaerah)){
                            foreach($rstunjdaerah as $data_dae){
                                if($data_dae->nilai <> ""){
                                    $tunjdaerah = $data_dae->nilai;
                                }else{
                                    $tunjdaerah = '0';
                                }
                            }
                        }else{
                            $tunjdaerah = '0';
                        }

                        $thrgab = $upahtetap + $tunjdaerah + $tunjjabatan;
                        $pengali = "1";

                        // 4.'cari nilai jamsostek
                        $rsjstaccident = DB::select("select curramount from pay_master_bebanprshn where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='10'");
                        if(!empty($rsjstaccident)){
                            foreach($rsjstaccident as $data_js){
                                if($data_js->curramount <> ""){
                                    $niljstaccident = $data_js->curramount;
                                }else{
                                    $niljstaccident = '0';
                                }
                            }
                        }else{
                            $niljstaccident = '0';
                        }
                        
                        $rsjstlife = DB::select("select curramount from pay_master_bebanprshn where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='12'");
                        if(!empty($rsjstlife)){
                            foreach($rsjstlife as $data_lif){
                                if($data_lif->curramount <> ""){
                                    $niljstlife = $data_lif->curramount;
                                }else{
                                    $niljstlife = '0';
                                }
                            }
                        }else{
                            $niljstlife = '0';
                        }


                        $rsfasilitas = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='06'");
                        if(!empty($rsfasilitas)){
                            foreach($rsfasilitas as $data_fas){
                                if($data_fas->nilai <> ""){
                                    $fasilitas = $data_fas->nilai;
                                }else{
                                    $fasilitas = '0';
                                }
                            }
                        }else{
                            $fasilitas = '0';
                        }

                        // 4.'cari nilai kena pajak upah bulan sebelumnya
                        $rskenapajak1 = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                        if(!empty($rskenapajak1)){
                            foreach($rskenapajak1 as $data_kena){
                                if($data_kena->nilai1 <> ""){
                                    $nilaikenapajak1 = $data_kena->nilai1;
                                }else{
                                    $nilaikenapajak1 = '0';
                                }
                            }
                        }else{
                            $nilaikenapajak1 = '0';
                        }


                        $rskorgaji = DB::select("select sum(a.nilai) as kortam from pay_koreksigaji a where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg'");
                        if(!empty($rskorgaji)){
                            foreach($rskorgaji as $data_koreksi){
                                if($data_koreksi->kortam <> ""){
                                    $kortam = $data_koreksi->kortam;
                                }else{
                                    $kortam = '0';
                                }
                            }
                        }else{
                            $kortam = '0';
                        }

                        $totkenapajak = ((($nilaikenapajak1 + $niljstaccident + $niljstlife)*12)+$thrgab+$kortam+$fasilitas);

                        // 5.'hitung biaya jabatan
                        $biayajabatan2 = ((5/100) * $totkenapajak);
                        if($biayajabatan2 > 6000000){
                            $biayajabatan = 6000000;  
                        }else{
                            $biayajabatan = $biayajabatan2;
                        }

                        $neto1tahun =  $totkenapajak - $biayajabatan;

                        $rsptkp = DB::select("select a.kodekeluarga,b.nilai from sdm_master_pegawai a,pay_tbl_ptkp b where a.kodekeluarga=b.kdkel and a.nopeg='$nopeg'");
                        if(!empty($rsptkp)){
                            foreach($rsptkp as $data_ptkp){
                                if($data_ptkp->nilai <> ""){
                                    $nilaiptkp1 = $data_ptkp->nilai;
                                }else{
                                    $nilaiptkp1 = '0';
                                }
                            }
                        }else{
                            $nilaiptkp1 = '0';
                        }

                        $nilaikenapajaka = $neto1tahun - $nilaiptkp1;
                        
                        $nilai2 = 0;
                        $nilai1 = 0;
                        $tunjangan = 0;
                        $pajakbulan=1;
                        $nilkenapajak = $nilaikenapajaka;
                        $sisapokok = $nilkenapajak;
                        $data_sdmprogresif = DB::select("select * from sdm_tbl_progressif order by awal asc");
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
                                $sisapokok = $sisapokok1 - $range;
                                $pph21ok =  $pph21r;
                                $pajakbulan = ($pph21ok/12);
                                $nilaikenapajak=($nilkenapajak/1000)*1000;

                                $selisih=$nilai2-$nilai1;
                                $nilai1=$nilaikenapajak;
                                $nilaikenapajak=(($nilaikenapajak+$pph21ok)/1000)*1000;
                                $nilai2=($nilaikenapajak/1000)*1000;
                                $nilaikenapajak=(($nilaikenapajak-$selisih)/1000)*1000;
                            }
                            $tunjangan=$pajakbulan;
                            $rstunjgaji = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='27'");
                            if(!empty($rstunjgaji)){
                                foreach($rstunjgaji as $data_tunga){
                                    if($data_tunga->nilai <> ""){
                                        $pajakgaji = $data_tunga->nilai;
                                    }else{
                                        $pajakgaji = '0';
                                    }
                                }
                            }else{
                                $pajakgaji = '0';
                            }

                            $pajakakhir = ($pajakbulan * 12)-($pajakgaji*12);
                            $rskoreksi = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='32'");
                            if(!empty($rskoreksi)){
                                foreach($rskoreksi as $data_koreksi){
                                    if($data_koreksi->nilai <> ""){
                                        $koreksi = $data_koreksi->nilai;
                                    }else{
                                        $koreksi = '0';
                                    }
                                }
                            }else{
                                $koreksi = '0';
                            }

                            $rsbazma = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='36'");
                            if(!empty($rsbazma)){
                                foreach($rsbazma as $data_bazma){
                                    if($data_bazma->nilai <> ""){
                                        $bazma = $data_bazma->nilai;
                                    }else{
                                        $bazma = '0';
                                    }
                                }
                            }else{
                                $bazma = '0';
                            }
                            // inspotpajak
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 26,
                                'nilai' => $pajakakhir * -1,
                                'tahunthr' => $tahun,
                                'status' => 'C',
                                'userid' => $request->userid,
                                ]);
                            // instunjpajak
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 27,
                                'nilai' => $pajakakhir,
                                'tahunthr' => $tahun,
                                'status' => 'C',
                                'userid' => $request->userid,
                                ]);
                            // instunjangan
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 25,
                                'nilai' =>$thrgab,
                                'tahunthr' => $tahun,
                                'status' => 'C',
                                'pajakgaji' => $pajakgaji*12,
                                'pajakthr' => $pajakakhir,
                                'ut' => $upahtetap,
                                'pengali' => $pengali,
                                'keterangan' => $keterangan,
                                'userid' => $request->userid,
                                'tbiayahidup' => $tunjdaerah,
                                'tjabatan' => $tunjjabatan,
                                'koreksi' => $koreksi,
                                'potongan' => $bazma,
                                ]);

                            // inskoreksi
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 32,
                                'nilai' => $koreksi,
                                'tahunthr' => $tahun,
                                'status' => 'C',
                                'userid' => $request->userid,
                                ]);
                            // insbazma
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 36,
                                'nilai' => $bazma,
                                'tahunthr' => $tahun,
                                'status' => 'C',
                                'userid' => $request->userid,
                                ]);
                    }


                    // pekerjakontrakthr()
                    // cari pegawai yang status pekerja kontrak
                    $data_pegawaikontrak = DB::select("select nopeg,kodekeluarga from sdm_master_pegawai where status='K' order by nopeg asc");
                    foreach($data_pegawaikontrak as $data_pegawaikon)
                    {
                        $nopeg = $data_pegawaikon->nopeg;
                        $kodekel = $data_pegawaikon->kodekeluarga;
                        if($nopeg == "070953"){
                            $bulangaji=3;
                        }
                        $rsupahallin = DB::select("select nilai from sdm_allin where nopek='$nopeg'");
                        if(!empty($rsupahallin)){
                            foreach($rsupahallin as $data_up)
                            {
                                if($data_up->nilai <> ""){
                                    $upahallin = $data_up->nilai;
                                }else{
                                    $upahallin = '0';
                                }
                            }
                        }else{
                            $upahallin= '0';
                        }

                        $rstunjjabatan = DB::select("select a.nopeg,a.kdbag,a.kdjab,b.goljob,b.tunjangan from sdm_jabatan a,sdm_tbl_kdjab b where a.nopeg='$nopeg' and a.kdbag=b.kdbag and a.kdjab=b.kdjab and a.mulai=(select max(mulai) from sdm_jabatan where nopeg='$nopeg')");
                        if(!empty($rstunjjabatan)){
                            foreach($rstunjjabatan as $data_tun)
                            {
                                if($data_tun->tunjangan <> ""){
                                    $tunjjabatan = $data_tun->tunjangan;
                                }else{
                                    $tunjjabatan = '0';
                                }
                            }
                        }else{
                            $tunjjabatan= '0';
                        }

                        $rstunjdaerah = DB::select("select a.golgaji, b.nilai from sdm_golgaji a,pay_tbl_tunjangan b where a.nopeg='$nopeg' and a.golgaji=b.golongan and a.tanggal=(select max(tanggal) from sdm_golgaji where nopeg ='$nopeg')");
                        if(!empty($rstunjdaerah)){
                            foreach($rstunjdaerah as $data_tundae)
                            {
                                if($data_tundae->nilai <> ""){
                                    $tunjdaerah = $data_tundae->nilai;
                                }else{
                                    $tunjdaerah = '0';
                                }
                            }
                        }else{
                            $tunjdaerah= '0';
                        }

                        $thrgab =$upahallin + $tunjjabatan + $tunjdaerah;
                        if($nopeg == "070953"){
                            $pengali = 235/365;
                            $thrgab = ($thrgab * (235/365));
                        }elseif($nopeg == "120926"){
                            $pengali = 340/365;
                            $thrgab = (($thrgab) * (340/365));
                        }else{
                            $pengali = "1";
                            $thrgab=$thrgab; 
                        }

                        $rskenapajak1 = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                        if(!empty($rskenapajak1)){
                            foreach($rskenapajak1 as $data_kenapajak)
                            {
                                if($data_kenapajak->nilai1 <> ""){
                                    $nilaikenapajak1 = $data_kenapajak->nilai1;
                                }else{
                                    $nilaikenapajak1 = '0';
                                }
                            }
                        }else{
                            $nilaikenapajak1= '0';
                        }

                        $rskorgaji2 = DB::select("select sum(a.nilai) as kortam from pay_koreksigaji a where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg'"); 
                        foreach($rskorgaji2 as $data_kor)
                        {
                            $kortam2 = $data_kor->kortam;
                            
                        }

                        $totkenapajak = (($nilaikenapajak1 * 12)+$kortam2+$thrgab);
                        $biayajabatan2 = ((5/100) * $totkenapajak);
                        if($biayajabatan2 > 6000000){
                            $biayajabatan = 6000000;  
                        }else{
                            $biayajabatan = $biayajabatan2;
                        }

                        $neto1tahun =  $totkenapajak - $biayajabatan;
                        $rsptkp = DB::select("select a.kodekeluarga,b.nilai from sdm_master_pegawai a,pay_tbl_ptkp b where a.kodekeluarga=b.kdkel and a.nopeg='$nopeg'");
                        if(!empty($rsptkp)){
                            foreach($rsptkp as $data_ptkp)
                            {
                                if($data_ptkp->nilai <> ""){
                                    $nilaiptkp1 = $data_ptkp->nilai;
                                }else{
                                    $nilaiptkp1 = '0';
                                }
                            }
                        }else{
                            $nilaiptkp1= '0';
                        }

                        $nilaikenapajaka = $neto1tahun - $nilaiptkp1;
                        $nilai2 = 0;
                        $nilai1 = 0;
                        $tunjangan = 0;
                        $pajakbulan=1;
                        $nilkenapajak = $nilaikenapajaka;
                        $sisapokok = $nilkenapajak;
                        $data_sdmprogresif = DB::select("select * from sdm_tbl_progressif order by awal asc");
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
                                $sisapokok = $sisapokok1 - $range;
                                $pph21ok =  $pph21r;
                                $pajakbulan = ($pph21ok/12);
                                $nilaikenapajak=($nilkenapajak/1000)*1000;

                                $selisih=$nilai2-$nilai1;
                                $nilai1=$nilaikenapajak;
                                $nilaikenapajak=(($nilaikenapajak+$pph21ok)/1000)*1000;
                                $nilai2=($nilaikenapajak/1000)*1000;
                                $nilaikenapajak=(($nilaikenapajak-$selisih)/1000)*1000;
                            }
                            $tunjangan=$pajakbulan;

                            $rstunjgaji = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='27'");
                            foreach($rstunjgaji as $data)
                            {

                                $pajakgaji = $data->nilai;
                            }
                            $pajakakhir = ($pajakbulan * 12)-($pajakgaji*12);
                            $rskoreksi = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='32'");
                            if(!empty($rskoreksi)){
                                foreach($rskoreksi as $data_korek)
                                {
                                    if($data_korek->nilai <> ""){
                                        $koreksi = $data_korek->nilai;
                                    }else{
                                        $koreksi = '0';
                                    }
                                }
                            }else{
                                $koreksi= '0';
                            }
                            $rsbazma = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='36'");
                            if(!empty($rsbazma)){
                                foreach($rsbazma as $data_baz)
                                {
                                    if($data_baz->nilai <> ""){
                                        $bazma = $data_baz->nilai;
                                    }else{
                                        $bazma = '0';
                                    }
                                }
                            }else{
                                $bazma= '0';
                            }

                             // inspotpajak
                             PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 26,
                                'nilai' => $pajakakhir * -1,
                                'tahunthr' => $tahun,
                                'status' => 'K',
                                'userid' => $request->userid,
                                ]);
                            // instunjpajak
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 27,
                                'nilai' => $pajakakhir,
                                'tahunthr' => $tahun,
                                'status' => 'K',
                                'userid' => $request->userid,
                                ]);
                            // instunjangan
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 25,
                                'nilai' =>$thrgab,
                                'tahunthr' => $tahun,
                                'status' => 'K',
                                'pajakgaji' => $pajakgaji*12,
                                'pajakthr' => $pajakakhir,
                                'ut' => $upahallin,
                                'pengali' => $pengali,
                                'keterangan' => $keterangan,
                                'userid' => $request->userid,
                                'tbiayahidup' => $tunjdaerah,
                                'tjabatan' => $tunjjabatan,
                                'koreksi' => $koreksi,
                                'potongan' => $bazma,
                                ]);

                            // inskoreksi
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 32,
                                'nilai' => $koreksi,
                                'tahunthr' => $tahun,
                                'status' => 'K',
                                'userid' => $request->userid,
                                ]);
                            // insbazma
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 36,
                                'nilai' => $bazma,
                                'tahunthr' => $tahun,
                                'status' => 'K',
                                'userid' => $request->userid,
                                ]);
                    }


                    // pekerjabantuthr()
                    $data_pegawaibantu = DB::select("select nopeg,status,kodekeluarga from sdm_master_pegawai where status='B' order by nopeg asc");
                    foreach($data_pegawaibantu as $data_pegawaikon)
                    {
                        $nopeg = $data_pegawaikon->nopeg;
                        $status1 = $data_pegawaikon->status;
                        $kodekel = $data_pegawaikon->kodekeluarga;
                        if($nopeg == "070953"){
                            $bulangaji=3;
                        }

                        // 1.cari upah all in 01
                        $rsupahallin = DB::select("select nilai from sdm_allin where nopek='$nopeg'");
                        if(!empty($rsupahallin)){
                            foreach($rsupahallin as $data_up)
                            {
                                if($data_up->nilai <> ""){
                                    $upahallin = $data_up->nilai;
                                }else{
                                    $upahallin = '0';
                                }
                            }
                        }else{
                            $upahallin= '0';
                        }
                        $pengali = 1;
                        $thrgab =$upahallin;

                        $rsupahtetap = DB::select("select a.ut from sdm_ut a where a.nopeg='$nopeg' and a.mulai=(select max(mulai) from sdm_ut where nopeg='$nopeg')");
                        if(!empty($rsupahtetap)){
                            foreach($rsupahtetap as $data_uptetap)
                            {
                                if($data_uptetap->ut <> ""){
                                    $upahtetap = $data_uptetap->ut;
                                }else{
                                    $upahtetap = '0';
                                }
                            }
                        }else{
                            $upahtetap= '0';
                        }

                       $rsfasilitas = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='06'");
                       foreach($rsfasilitas as $data_fas) 
                       {
                           $fasilitas = $data_fas->nilai;

                       }

                       //    hitung pajak pph21
                       $rskenapajak1 = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                       if(!empty($rskenapajak1)){
                           foreach($rskenapajak1 as $data_kenapa)
                           {
                               if($data_kenapa->nilai1 <> ""){
                                   $nilaikenapajak1 = $data_kenapa->nilai1;
                               }else{
                                   $nilaikenapajak1 = '0';
                               }
                           }
                       }else{
                           $nilaikenapajak1= '0';
                       }

                       $totkenapajak = (($nilaikenapajak1*12)+$fasilitas + $upahallin);
                    //    cari nilai pengurang
                        $biayajabatan2 = ((5/100) * $totkenapajak);
                        if($biayajabatan2 > 6000000){
                            $biayajabatan = 6000000;  
                        }else{
                            $biayajabatan = $biayajabatan2;
                        }

                        $neto1tahun =  $totkenapajak - $biayajabatan;

                        // cari nilai tidak kena pajak
                        $rsptkp = DB::select("select a.kodekeluarga,b.nilai from sdm_master_pegawai a,pay_tbl_ptkp b where a.kodekeluarga=b.kdkel and a.nopeg='$nopeg'");
                        if(!empty($rsptkp)){
                            foreach($rsptkp as $data_ptkp)
                            {
                                if($data_ptkp->nilai <> ""){
                                    $nilaiptkp1 = $data_ptkp->nilai;
                                }else{
                                    $nilaiptkp1 = '0';
                                }
                            }
                        }else{
                            $nilaiptkp1= '0';
                        }     
                        
                        $nilaikenapajaka = $neto1tahun - $nilaiptkp1;
                        $nilai2 = 0;
                        $nilai1 = 0;
                        $tunjangan = 0;
                        $pajakbulan=1;
                        $nilkenapajak = $nilaikenapajaka;
                        $sisapokok = $nilkenapajak;
                        $data_sdmprogresif = DB::select("select * from sdm_tbl_progressif order by awal asc");
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
                                $sisapokok = $sisapokok1 - $range;
                                $pph21ok =  $pph21r;
                                $pajakbulan = ($pph21ok/12);
                                $nilaikenapajak=($nilkenapajak/1000)*1000;

                                $selisih=$nilai2-$nilai1;
                                $nilai1=$nilaikenapajak;
                                $nilaikenapajak=(($nilaikenapajak+$pph21ok)/1000)*1000;
                                $nilai2=($nilaikenapajak/1000)*1000;
                                $nilaikenapajak=(($nilaikenapajak-$selisih)/1000)*1000;
                            }
                            $tunjangan=$pajakbulan;
                            $rstunjgaji = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='27'");
                            foreach($rstunjgaji as $data_tunj)
                            {
                                $pajakgaji = $data_tunj->nilai;

                            }
                          
                            $pajakakhir = ($pajakbulan * 12)-($pajakgaji*12);

                            $rskoreksi = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='32'");
                            if(!empty($rskoreksi)){
                                foreach($rskoreksi as $data_koreks)
                                {
                                    if($data_koreks->nilai <> ""){
                                        $koreksi = $data_koreks->nilai;
                                    }else{
                                        $koreksi = '0';
                                    }
                                }
                            }else{
                                $koreksi= '0';
                            }   
                            $rsbazma = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='36'");
                            if(!empty($rsbazma)){
                                foreach($rsbazma as $data_baz)
                                {
                                    if($data_baz->nilai <> ""){
                                        $bazma = $data_baz->nilai;
                                    }else{
                                        $bazma = '0';
                                    }
                                }
                            }else{
                                $bazma= '0';
                            } 
                            
                             // inspotpajak
                             PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 26,
                                'nilai' => $pajakakhir * -1,
                                'tahunthr' => $tahun,
                                'status' => 'B',
                                'userid' => $request->userid,
                                ]);
                            // instunjpajak
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 27,
                                'nilai' => $pajakakhir,
                                'tahunthr' => $tahun,
                                'status' => 'B',
                                'userid' => $request->userid,
                                ]);
                            // instunjangan
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 25,
                                'nilai' =>$thrgab,
                                'tahunthr' => $tahun,
                                'status' => 'B',
                                'pajakgaji' => $pajakgaji*12,
                                'pajakthr' => $pajakakhir,
                                'ut' => $upahallin,
                                'pengali' => $pengali,
                                'keterangan' => $keterangan,
                                'userid' => $request->userid,
                                'tbiayahidup' => '0',
                                'tjabatan' => '0',
                                'koreksi' => $koreksi,
                                'potongan' => $bazma,
                                ]);

                            // inskoreksi
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 32,
                                'nilai' => $koreksi,
                                'tahunthr' => $tahun,
                                'status' => 'B',
                                'userid' => $request->userid,
                                ]);
                            // insbazma
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 36,
                                'nilai' => $bazma,
                                'tahunthr' => $tahun,
                                'status' => 'B',
                                'userid' => $request->userid,
                                ]);
                    }

                }elseif($prosesupah == 'C'){
                    // pekerjatetapthr()
                    // pekerjatetapthr()
                    // 1.cari pegawai yang status pekerja tetap
                    $data_pegawaitetap = DB::select("select nopeg,kodekeluarga from sdm_master_pegawai where status='C' order by nopeg asc");
                    foreach($data_pegawaitetap as $data_pegawaite)
                    {
                        $nopeg = $data_pegawaite->nopeg;
                        $kodekel = $data_pegawaite->kodekeluarga;
                        $data_upah = DB::select("select a.ut from sdm_ut a where a.nopeg='$nopeg' and a.mulai=(select max(mulai) from sdm_ut where nopeg='$nopeg')");
                        if(!empty($data_upah)){
                            foreach($data_upah as $data_up)
                            {
                                if($data_up->ut <> ""){
                                    $upahtetap = $data_up->ut;
                                }else{
                                    $upahtetap = '0';
                                }
                            }
                        }else{
                            $upahtetap= '0';
                        }

                        // '2.tunjangan jabatan aard = 03
                        if($nopeg == "181326"){
                            $tunjjabatan = '0';
                        }else{
                             $rstunjjabatan = DB::select("select a.nopeg,a.kdbag,a.kdjab,b.goljob,b.tunjangan from sdm_jabatan a,sdm_tbl_kdjab b where a.nopeg='$nopeg' and a.kdbag=b.kdbag and a.kdjab=b.kdjab and a.mulai=(select max(mulai) from sdm_jabatan where nopeg='$nopeg')");
                            if(!empty($rstunjjabatan)){
                                foreach($rstunjjabatan as $data_tun){
                                    if($data_tun->tunjangan <> ""){
                                        $tunjjabatan = $data_tun->tunjangan;
                                    }else{
                                        $tunjjabatan = '0';
                                    }
                                }
                            }else{
                                $tunjjabatan = '0';
                            }
                        }
                        
                        // '3.tunjangan biaya hidup aard aard = 04
                        $rstunjdaerah = DB::select("select a.golgaji, b.nilai from sdm_golgaji a,pay_tbl_tunjangan b where a.nopeg='$nopeg' and a.golgaji=b.golongan and a.tanggal=(select max(tanggal) from sdm_golgaji where nopeg ='$nopeg')");
                        if(!empty($rstunjdaerah)){
                            foreach($rstunjdaerah as $data_dae){
                                if($data_dae->nilai <> ""){
                                    $tunjdaerah = $data_dae->nilai;
                                }else{
                                    $tunjdaerah = '0';
                                }
                            }
                        }else{
                            $tunjdaerah = '0';
                        }

                        $thrgab = $upahtetap + $tunjdaerah + $tunjjabatan;
                        $pengali = "1";

                        // 4.'cari nilai jamsostek
                        $rsjstaccident = DB::select("select curramount from pay_master_bebanprshn where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='10'");
                        if(!empty($rsjstaccident)){
                            foreach($rsjstaccident as $data_js){
                                if($data_js->curramount <> ""){
                                    $niljstaccident = $data_js->curramount;
                                }else{
                                    $niljstaccident = '0';
                                }
                            }
                        }else{
                            $niljstaccident = '0';
                        }
                        
                        $rsjstlife = DB::select("select curramount from pay_master_bebanprshn where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='12'");
                        if(!empty($rsjstlife)){
                            foreach($rsjstlife as $data_lif){
                                if($data_lif->curramount <> ""){
                                    $niljstlife = $data_lif->curramount;
                                }else{
                                    $niljstlife = '0';
                                }
                            }
                        }else{
                            $niljstlife = '0';
                        }


                        $rsfasilitas = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='06'");
                        if(!empty($rsfasilitas)){
                            foreach($rsfasilitas as $data_fas){
                                if($data_fas->nilai <> ""){
                                    $fasilitas = $data_fas->nilai;
                                }else{
                                    $fasilitas = '0';
                                }
                            }
                        }else{
                            $fasilitas = '0';
                        }

                        // 4.'cari nilai kena pajak upah bulan sebelumnya
                        $rskenapajak1 = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                        if(!empty($rskenapajak1)){
                            foreach($rskenapajak1 as $data_kena){
                                if($data_kena->nilai1 <> ""){
                                    $nilaikenapajak1 = $data_kena->nilai1;
                                }else{
                                    $nilaikenapajak1 = '0';
                                }
                            }
                        }else{
                            $nilaikenapajak1 = '0';
                        }


                        $rskorgaji = DB::select("select sum(a.nilai) as kortam from pay_koreksigaji a where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg'");
                        if(!empty($rskorgaji)){
                            foreach($rskorgaji as $data_koreksi){
                                if($data_koreksi->kortam <> ""){
                                    $kortam = $data_koreksi->kortam;
                                }else{
                                    $kortam = '0';
                                }
                            }
                        }else{
                            $kortam = '0';
                        }

                        $totkenapajak = ((($nilaikenapajak1 + $niljstaccident + $niljstlife)*12)+$thrgab+$kortam+$fasilitas);

                        // 5.'hitung biaya jabatan
                        $biayajabatan2 = ((5/100) * $totkenapajak);
                        if($biayajabatan2 > 6000000){
                            $biayajabatan = 6000000;  
                        }else{
                            $biayajabatan = $biayajabatan2;
                        }

                        $neto1tahun =  $totkenapajak - $biayajabatan;

                        $rsptkp = DB::select("select a.kodekeluarga,b.nilai from sdm_master_pegawai a,pay_tbl_ptkp b where a.kodekeluarga=b.kdkel and a.nopeg='$nopeg'");
                        if(!empty($rsptkp)){
                            foreach($rsptkp as $data_ptkp){
                                if($data_ptkp->nilai <> ""){
                                    $nilaiptkp1 = $data_ptkp->nilai;
                                }else{
                                    $nilaiptkp1 = '0';
                                }
                            }
                        }else{
                            $nilaiptkp1 = '0';
                        }

                        $nilaikenapajaka = $neto1tahun - $nilaiptkp1;
                        
                        $nilai2 = 0;
                        $nilai1 = 0;
                        $tunjangan = 0;
                        $pajakbulan=1;
                        $nilkenapajak = $nilaikenapajaka;
                        $sisapokok = $nilkenapajak;
                        $data_sdmprogresif = DB::select("select * from sdm_tbl_progressif order by awal asc");
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
                                $sisapokok = $sisapokok1 - $range;
                                $pph21ok =  $pph21r;
                                $pajakbulan = ($pph21ok/12);
                                $nilaikenapajak=($nilkenapajak/1000)*1000;

                                $selisih=$nilai2-$nilai1;
                                $nilai1=$nilaikenapajak;
                                $nilaikenapajak=(($nilaikenapajak+$pph21ok)/1000)*1000;
                                $nilai2=($nilaikenapajak/1000)*1000;
                                $nilaikenapajak=(($nilaikenapajak-$selisih)/1000)*1000;
                            }
                            $tunjangan=$pajakbulan;
                            $rstunjgaji = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='27'");
                            if(!empty($rstunjgaji)){
                                foreach($rstunjgaji as $data_tunga){
                                    if($data_tunga->nilai <> ""){
                                        $pajakgaji = $data_tunga->nilai;
                                    }else{
                                        $pajakgaji = '0';
                                    }
                                }
                            }else{
                                $pajakgaji = '0';
                            }

                            $pajakakhir = ($pajakbulan * 12)-($pajakgaji*12);
                            $rskoreksi = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='32'");
                            if(!empty($rskoreksi)){
                                foreach($rskoreksi as $data_koreksi){
                                    if($data_koreksi->nilai <> ""){
                                        $koreksi = $data_koreksi->nilai;
                                    }else{
                                        $koreksi = '0';
                                    }
                                }
                            }else{
                                $koreksi = '0';
                            }

                            $rsbazma = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='36'");
                            if(!empty($rsbazma)){
                                foreach($rsbazma as $data_bazma){
                                    if($data_bazma->nilai <> ""){
                                        $bazma = $data_bazma->nilai;
                                    }else{
                                        $bazma = '0';
                                    }
                                }
                            }else{
                                $bazma = '0';
                            }
                            // inspotpajak
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 26,
                                'nilai' => $pajakakhir * -1,
                                'tahunthr' => $tahun,
                                'status' => 'C',
                                'userid' => $request->userid,
                                ]);
                            // instunjpajak
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 27,
                                'nilai' => $pajakakhir,
                                'tahunthr' => $tahun,
                                'status' => 'C',
                                'userid' => $request->userid,
                                ]);
                            // instunjangan
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 25,
                                'nilai' =>$thrgab,
                                'tahunthr' => $tahun,
                                'status' => 'C',
                                'pajakgaji' => $pajakgaji*12,
                                'pajakthr' => $pajakakhir,
                                'ut' => $upahtetap,
                                'pengali' => $pengali,
                                'keterangan' => $keterangan,
                                'userid' => $request->userid,
                                'tbiayahidup' => $tunjdaerah,
                                'tjabatan' => $tunjjabatan,
                                'koreksi' => $koreksi,
                                'potongan' => $bazma,
                                ]);

                            // inskoreksi
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 32,
                                'nilai' => $koreksi,
                                'tahunthr' => $tahun,
                                'status' => 'C',
                                'userid' => $request->userid,
                                ]);
                            // insbazma
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 36,
                                'nilai' => $bazma,
                                'tahunthr' => $tahun,
                                'status' => 'C',
                                'userid' => $request->userid,
                                ]);
                    }
                    
                }elseif($prosesupah == 'K'){
                    // pekerjakontrakthr()
                    // pekerjakontrakthr()
                    // cari pegawai yang status pekerja kontrak
                    $data_pegawaikontrak = DB::select("select nopeg,kodekeluarga from sdm_master_pegawai where status='K' order by nopeg asc");
                    foreach($data_pegawaikontrak as $data_pegawaikon)
                    {
                        $nopeg = $data_pegawaikon->nopeg;
                        $kodekel = $data_pegawaikon->kodekeluarga;
                        if($nopeg == "070953"){
                            $bulangaji=3;
                        }
                        $rsupahallin = DB::select("select nilai from sdm_allin where nopek='$nopeg'");
                        if(!empty($rsupahallin)){
                            foreach($rsupahallin as $data_up)
                            {
                                if($data_up->nilai <> ""){
                                    $upahallin = $data_up->nilai;
                                }else{
                                    $upahallin = '0';
                                }
                            }
                        }else{
                            $upahallin= '0';
                        }

                        $rstunjjabatan = DB::select("select a.nopeg,a.kdbag,a.kdjab,b.goljob,b.tunjangan from sdm_jabatan a,sdm_tbl_kdjab b where a.nopeg='$nopeg' and a.kdbag=b.kdbag and a.kdjab=b.kdjab and a.mulai=(select max(mulai) from sdm_jabatan where nopeg='$nopeg')");
                        if(!empty($rstunjjabatan)){
                            foreach($rstunjjabatan as $data_tun)
                            {
                                if($data_tun->tunjangan <> ""){
                                    $tunjjabatan = $data_tun->tunjangan;
                                }else{
                                    $tunjjabatan = '0';
                                }
                            }
                        }else{
                            $tunjjabatan= '0';
                        }

                        $rstunjdaerah = DB::select("select a.golgaji, b.nilai from sdm_golgaji a,pay_tbl_tunjangan b where a.nopeg='$nopeg' and a.golgaji=b.golongan and a.tanggal=(select max(tanggal) from sdm_golgaji where nopeg ='$nopeg')");
                        if(!empty($rstunjdaerah)){
                            foreach($rstunjdaerah as $data_tundae)
                            {
                                if($data_tundae->nilai <> ""){
                                    $tunjdaerah = $data_tundae->nilai;
                                }else{
                                    $tunjdaerah = '0';
                                }
                            }
                        }else{
                            $tunjdaerah= '0';
                        }

                        $thrgab =$upahallin + $tunjjabatan + $tunjdaerah;
                        if($nopeg == "070953"){
                            $pengali = 235/365;
                            $thrgab = ($thrgab * (235/365));
                        }elseif($nopeg == "120926"){
                            $pengali = 340/365;
                            $thrgab = (($thrgab) * (340/365));
                        }else{
                            $pengali = "1";
                            $thrgab=$thrgab; 
                        }

                        $rskenapajak1 = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                        if(!empty($rskenapajak1)){
                            foreach($rskenapajak1 as $data_kenapajak)
                            {
                                if($data_kenapajak->nilai1 <> ""){
                                    $nilaikenapajak1 = $data_kenapajak->nilai1;
                                }else{
                                    $nilaikenapajak1 = '0';
                                }
                            }
                        }else{
                            $nilaikenapajak1= '0';
                        }

                        $rskorgaji2 = DB::select("select sum(a.nilai) as kortam from pay_koreksigaji a where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg'"); 
                        foreach($rskorgaji2 as $data_kor)
                        {
                            $kortam2 = $data_kor->kortam;
                            
                        }

                        $totkenapajak = (($nilaikenapajak1 * 12)+$kortam2+$thrgab);
                        $biayajabatan2 = ((5/100) * $totkenapajak);
                        if($biayajabatan2 > 6000000){
                            $biayajabatan = 6000000;  
                        }else{
                            $biayajabatan = $biayajabatan2;
                        }

                        $neto1tahun =  $totkenapajak - $biayajabatan;
                        $rsptkp = DB::select("select a.kodekeluarga,b.nilai from sdm_master_pegawai a,pay_tbl_ptkp b where a.kodekeluarga=b.kdkel and a.nopeg='$nopeg'");
                        if(!empty($rsptkp)){
                            foreach($rsptkp as $data_ptkp)
                            {
                                if($data_ptkp->nilai <> ""){
                                    $nilaiptkp1 = $data_ptkp->nilai;
                                }else{
                                    $nilaiptkp1 = '0';
                                }
                            }
                        }else{
                            $nilaiptkp1= '0';
                        }

                        $nilaikenapajaka = $neto1tahun - $nilaiptkp1;
                        $nilai2 = 0;
                        $nilai1 = 0;
                        $tunjangan = 0;
                        $pajakbulan=1;
                        $nilkenapajak = $nilaikenapajaka;
                        $sisapokok = $nilkenapajak;
                        $data_sdmprogresif = DB::select("select * from sdm_tbl_progressif order by awal asc");
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
                                $sisapokok = $sisapokok1 - $range;
                                $pph21ok =  $pph21r;
                                $pajakbulan = ($pph21ok/12);
                                $nilaikenapajak=($nilkenapajak/1000)*1000;

                                $selisih=$nilai2-$nilai1;
                                $nilai1=$nilaikenapajak;
                                $nilaikenapajak=(($nilaikenapajak+$pph21ok)/1000)*1000;
                                $nilai2=($nilaikenapajak/1000)*1000;
                                $nilaikenapajak=(($nilaikenapajak-$selisih)/1000)*1000;
                            }
                            $tunjangan=$pajakbulan;

                            $rstunjgaji = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='27'");
                            foreach($rstunjgaji as $data)
                            {

                                $pajakgaji = $data->nilai;
                            }
                            $pajakakhir = ($pajakbulan * 12)-($pajakgaji*12);
                            $rskoreksi = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='32'");
                            if(!empty($rskoreksi)){
                                foreach($rskoreksi as $data_korek)
                                {
                                    if($data_korek->nilai <> ""){
                                        $koreksi = $data_korek->nilai;
                                    }else{
                                        $koreksi = '0';
                                    }
                                }
                            }else{
                                $koreksi= '0';
                            }
                            $rsbazma = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='36'");
                            if(!empty($rsbazma)){
                                foreach($rsbazma as $data_baz)
                                {
                                    if($data_baz->nilai <> ""){
                                        $bazma = $data_baz->nilai;
                                    }else{
                                        $bazma = '0';
                                    }
                                }
                            }else{
                                $bazma= '0';
                            }

                             // inspotpajak
                             PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 26,
                                'nilai' => $pajakakhir * -1,
                                'tahunthr' => $tahun,
                                'status' => 'K',
                                'userid' => $request->userid,
                                ]);
                            // instunjpajak
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 27,
                                'nilai' => $pajakakhir,
                                'tahunthr' => $tahun,
                                'status' => 'K',
                                'userid' => $request->userid,
                                ]);
                            // instunjangan
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 25,
                                'nilai' =>$thrgab,
                                'tahunthr' => $tahun,
                                'status' => 'K',
                                'pajakgaji' => $pajakgaji*12,
                                'pajakthr' => $pajakakhir,
                                'ut' => $upahallin,
                                'pengali' => $pengali,
                                'keterangan' => $keterangan,
                                'userid' => $request->userid,
                                'tbiayahidup' => $tunjdaerah,
                                'tjabatan' => $tunjjabatan,
                                'koreksi' => $koreksi,
                                'potongan' => $bazma,
                                ]);

                            // inskoreksi
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 32,
                                'nilai' => $koreksi,
                                'tahunthr' => $tahun,
                                'status' => 'K',
                                'userid' => $request->userid,
                                ]);
                            // insbazma
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 36,
                                'nilai' => $bazma,
                                'tahunthr' => $tahun,
                                'status' => 'K',
                                'userid' => $request->userid,
                                ]);
                    }
                    
                }else{
                    // pekerjabantuthr()
                    // pekerjabantuthr()
                    $data_pegawaibantu = DB::select("select nopeg,status,kodekeluarga from sdm_master_pegawai where status='B' order by nopeg asc");
                    foreach($data_pegawaibantu as $data_pegawaikon)
                    {
                        $nopeg = $data_pegawaikon->nopeg;
                        $status1 = $data_pegawaikon->status;
                        $kodekel = $data_pegawaikon->kodekeluarga;
                        if($nopeg == "070953"){
                            $bulangaji=3;
                        }

                        // 1.cari upah all in 01
                        $rsupahallin = DB::select("select nilai from sdm_allin where nopek='$nopeg'");
                        if(!empty($rsupahallin)){
                            foreach($rsupahallin as $data_up)
                            {
                                if($data_up->nilai <> ""){
                                    $upahallin = $data_up->nilai;
                                }else{
                                    $upahallin = '0';
                                }
                            }
                        }else{
                            $upahallin= '0';
                        }
                        $pengali = 1;
                        $thrgab =$upahallin;

                        $rsupahtetap = DB::select("select a.ut from sdm_ut a where a.nopeg='$nopeg' and a.mulai=(select max(mulai) from sdm_ut where nopeg='$nopeg')");
                        if(!empty($rsupahtetap)){
                            foreach($rsupahtetap as $data_uptetap)
                            {
                                if($data_uptetap->ut <> ""){
                                    $upahtetap = $data_uptetap->ut;
                                }else{
                                    $upahtetap = '0';
                                }
                            }
                        }else{
                            $upahtetap= '0';
                        }

                       $rsfasilitas = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='06'");
                       foreach($rsfasilitas as $data_fas) 
                       {
                           $fasilitas = $data_fas->nilai;

                       }

                       //    hitung pajak pph21
                       $rskenapajak1 = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                       if(!empty($rskenapajak1)){
                           foreach($rskenapajak1 as $data_kenapa)
                           {
                               if($data_kenapa->nilai1 <> ""){
                                   $nilaikenapajak1 = $data_kenapa->nilai1;
                               }else{
                                   $nilaikenapajak1 = '0';
                               }
                           }
                       }else{
                           $nilaikenapajak1= '0';
                       }

                       $totkenapajak = (($nilaikenapajak1*12)+$fasilitas + $upahallin);
                    //    cari nilai pengurang
                        $biayajabatan2 = ((5/100) * $totkenapajak);
                        if($biayajabatan2 > 6000000){
                            $biayajabatan = 6000000;  
                        }else{
                            $biayajabatan = $biayajabatan2;
                        }

                        $neto1tahun =  $totkenapajak - $biayajabatan;

                        // cari nilai tidak kena pajak
                        $rsptkp = DB::select("select a.kodekeluarga,b.nilai from sdm_master_pegawai a,pay_tbl_ptkp b where a.kodekeluarga=b.kdkel and a.nopeg='$nopeg'");
                        if(!empty($rsptkp)){
                            foreach($rsptkp as $data_ptkp)
                            {
                                if($data_ptkp->nilai <> ""){
                                    $nilaiptkp1 = $data_ptkp->nilai;
                                }else{
                                    $nilaiptkp1 = '0';
                                }
                            }
                        }else{
                            $nilaiptkp1= '0';
                        }     
                        
                        $nilaikenapajaka = $neto1tahun - $nilaiptkp1;
                        $nilai2 = 0;
                        $nilai1 = 0;
                        $tunjangan = 0;
                        $pajakbulan=1;
                        $nilkenapajak = $nilaikenapajaka;
                        $sisapokok = $nilkenapajak;
                        $data_sdmprogresif = DB::select("select * from sdm_tbl_progressif order by awal asc");
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
                                $sisapokok = $sisapokok1 - $range;
                                $pph21ok =  $pph21r;
                                $pajakbulan = ($pph21ok/12);
                                $nilaikenapajak=($nilkenapajak/1000)*1000;

                                $selisih=$nilai2-$nilai1;
                                $nilai1=$nilaikenapajak;
                                $nilaikenapajak=(($nilaikenapajak+$pph21ok)/1000)*1000;
                                $nilai2=($nilaikenapajak/1000)*1000;
                                $nilaikenapajak=(($nilaikenapajak-$selisih)/1000)*1000;
                            }
                            $tunjangan=$pajakbulan;
                            $rstunjgaji = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='27'");
                            foreach($rstunjgaji as $data_tunj)
                            {
                                $pajakgaji = $data_tunj->nilai;

                            }
                          
                            $pajakakhir = ($pajakbulan * 12)-($pajakgaji*12);

                            $rskoreksi = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='32'");
                            if(!empty($rskoreksi)){
                                foreach($rskoreksi as $data_koreks)
                                {
                                    if($data_koreks->nilai <> ""){
                                        $koreksi = $data_koreks->nilai;
                                    }else{
                                        $koreksi = '0';
                                    }
                                }
                            }else{
                                $koreksi= '0';
                            }   
                            $rsbazma = DB::select("select sum(nilai) as nilai from pay_potongan_thr where tahun='$tahun' and bulan='$bulan' and nopek='$nopeg' and aard='36'");
                            if(!empty($rsbazma)){
                                foreach($rsbazma as $data_baz)
                                {
                                    if($data_baz->nilai <> ""){
                                        $bazma = $data_baz->nilai;
                                    }else{
                                        $bazma = '0';
                                    }
                                }
                            }else{
                                $bazma= '0';
                            } 
                            
                             // inspotpajak
                             PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 26,
                                'nilai' => $pajakakhir * -1,
                                'tahunthr' => $tahun,
                                'status' => 'B',
                                'userid' => $request->userid,
                                ]);
                            // instunjpajak
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 27,
                                'nilai' => $pajakakhir,
                                'tahunthr' => $tahun,
                                'status' => 'B',
                                'userid' => $request->userid,
                                ]);
                            // instunjangan
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 25,
                                'nilai' =>$thrgab,
                                'tahunthr' => $tahun,
                                'status' => 'B',
                                'pajakgaji' => $pajakgaji*12,
                                'pajakthr' => $pajakakhir,
                                'ut' => $upahallin,
                                'pengali' => $pengali,
                                'keterangan' => $keterangan,
                                'userid' => $request->userid,
                                'tbiayahidup' => '0',
                                'tjabatan' => '0',
                                'koreksi' => $koreksi,
                                'potongan' => $bazma,
                                ]);

                            // inskoreksi
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 32,
                                'nilai' => $koreksi,
                                'tahunthr' => $tahun,
                                'status' => 'B',
                                'userid' => $request->userid,
                                ]);
                            // insbazma
                            PayMasterThr::insert([
                                'tahun' => $tahun,
                                'bulan' => $bulan,
                                'nopek' => $nopeg,
                                'aard' => 36,
                                'nilai' => $bazma,
                                'tahunthr' => $tahun,
                                'status' => 'B',
                                'userid' => $request->userid,
                                ]);
                    }

                }
                StatBayarThr::insert([
                    'tahun' => $tahun,
                    'bulan' => $bulan,
                    'status' => 'N',      
                    ]); 
                Alert::success("Data THR bulan $bulan dan tahun $tahun berhasil di proses ", 'Berhasil')->persistent(true);
                return redirect()->route('proses_thr.index');
                
            }

        }else{

            $data_cekstatusbayar = DB::select("select status from stat_bayar_thr where tahun='$tahun' and bulan='$bulan'");
            if(!empty($data_cekstatusbayar)){
                    foreach($data_cekstatusbayar as $data_bayar)
                    {
                        $data_cekbayar = $data_bayar->status;
                    }
                    if($data_cekbayar == 'N'){
                        if($prosesupah == 'A'){
                            $data_Cekbatal = DB::select("select * from pay_master_thr where tahun='$tahun' and bulan='$bulan'");
                        }else{
                            $data_Cekbatal = DB::select("select * from pay_master_thr where tahun='$tahun' and bulan='$bulan' and status='$prosesupah'");
                        }
                            if(!empty($data_Cekbatal)){
                                    if($prosesupah == 'A'){
                                        PayMasterThr::where('tahun', $tahun)->where('bulan',$bulan)->delete();
                                    }elseif($prosesupah == 'C'){
                                        PayMasterThr::where('tahun', $tahun)->where('bulan',$bulan)->where('status',$prosesupah)->delete();
                                    }elseif($prosesupah == 'K'){
                                        PayMasterThr::where('tahun', $tahun)->where('bulan',$bulan)->where('status',$prosesupah)->delete();
                                    }else {
                                        PayMasterThr::where('tahun', $tahun)->where('bulan',$bulan)->where('status',$prosesupah)->delete();
                                    }
                                    StatBayarThr::where('tahun', $tahun)->where('bulan',$bulan)->delete();
                                    Alert::success("Proses pembatalan proses THR selesai", 'Berhasil')->persistent(true);
                                    return redirect()->route('proses_thr.index');
                            }else {
                                    Alert::error("Tidak ditemukan data THR bulan $bulan dan tahun $tahun", 'Error')->persistent(true);
                                    return redirect()->route('proses_thr.index');
                            }

                    }else {
                        Alert::error("Tidak bisa dibatalkan Data THR bulan $bulan tahun $tahun sudah di proses perbendaharaan", 'Error')->persistent(true);
                        return redirect()->route('proses_thr.index');
                    }
            }else{
                    Alert::error("Tidak ditemukan data THR bulan $bulan dan tahun $tahun", 'Error')->persistent(true);
                    return redirect()->route('proses_thr.index');
            }

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
