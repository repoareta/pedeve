<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatBayarInsentif;
use App\Models\PayMasterInsentif;
use DB;
use PDF;
use Excel;
use Alert;

class ProsesInsentifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proses_insentif.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proses_insentif.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prosesupah = $request->prosesupah;
        $tanggal = $request->tanggal;
        $data_tahun = substr($request->tanggal,-4);
        $data_bulan = ltrim(substr($request->tanggal,0,-5), '0');
        $data_bulans = substr($request->tanggal,0,-5);
        $upah = $request->upah;
        $tanggals = "1/$tanggal";
        $tahuns = $request->tahun;
        $keterangan = $request->keterangan;
        if($data_bulan - 1 == 0){
            $bulangaji="12";
            $tahungaji=$data_tahun - 1;
        }else{
            $bulangaji=$data_bulan - 1;
            $tahungaji= $data_tahun;
        }
        if($request->radioupah == 'proses'){
            
                if($prosesupah == 'A'){
                    $data_CekGaji = DB::select("select * from pay_master_insentif where tahun='$data_tahun' and bulan='$data_bulan'");
                }else{
                    $data_CekGaji = DB::select("select * from pay_master_insentif where tahun='$data_tahun' and bulan='$data_bulan' and status='$prosesupah'");
                }
                


                if(!empty($data_CekGaji)){ //di rubah !
                        Alert::error("Data Insentif bulan $data_bulan dan tahun $data_tahun sudah pernah di proses", 'Error')->persistent(true);
                        return redirect()->route('proses_insentif.index');
                }else{
                        if($request->prosesupah == 'A'){
                            
                                    // PekerjaTetapIns()
                                    // 1.CARI PEGAWAI YANG STATUS PEKERJA TETAP
                                    $data_caripegawai = DB::select("select nopeg,kodekeluarga from sdm_master_pegawai where status='C' order by nopeg asc");
                                    foreach($data_caripegawai as $data_cari)
                                    {                                
                                        $nopeg = $data_cari->nopeg;
                                        $kodekel = $data_cari->kodekeluarga;
                                    
                                    $data_upahtetap = DB::select("select a.ut from sdm_ut a where a.nopeg='$nopeg' and a.mulai=(select max(mulai) from sdm_ut where nopeg='$nopeg')");
                                    if(!empty($data_upahtetap)){
                                        foreach($data_upahtetap as $data_upah)
                                        {
                                            if($data_upah->ut <> ""){
                                                $upahtetap = $data_upah->ut;
                                            }else {
                                                $upahtetap = '0';
                                            }
                                        }
                                    }else {
                                        $upahtetap = '0';
                                    }
                                    $pengali = $upah;
                                    $insentif = $upahtetap * $upah;
                                    
                                    // 2.Cari nilai Jamsostek
                                    $data_carijamsostek = DB::select("select curramount from pay_master_bebanprshn where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='10'");
                                        if(!empty($data_carijamsostek)){
                                            foreach($data_carijamsostek as $data_carijam)
                                            {
                                                if($data_carijam->curramount <> ""){
                                                    $niljstaccident = $data_carijam->curramount;
                                                }else {
                                                    $niljstaccident = '0';
                                                }
                                            }
                                        }else {
                                            $niljstaccident = '0';
                                        }

                                    $data_jslife = DB::select("select curramount from pay_master_bebanprshn where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='12'");
                                        if(!empty($data_jslife)){
                                            foreach($data_jslife as $data_carilife)
                                            {
                                                if($data_carilife->curramount <> ""){
                                                    $niljstlife = $data_carilife->curramount;
                                                }else {
                                                    $niljstlife = '0';
                                                }
                                            }
                                        }else {
                                            $niljstlife = '0';
                                        }

                                    $data_fasilitas = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='06'");
                                        if(!empty($data_fasilitas)){
                                            foreach($data_fasilitas as $data_fasil)
                                            {
                                                if($data_fasil->nilai <> ""){
                                                    $fasilitas = $data_fasil->nilai;
                                                }else {
                                                    $fasilitas = '0';
                                                }
                                            }
                                        }else {
                                            $fasilitas = '0';
                                        }

                                    // 3.Cari nilai kena pajak upah bulan sebelumnya
                                    $data_kenapajak = DB::select("select sum(a.nilai) as nilai1 from pay_master_upah a,pay_tbl_aard b where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg' and a.aard=b.kode and b.kenapajak='Y'");
                                        if(!empty($data_kenapajak)){
                                            foreach($data_kenapajak as $data_kenap)
                                            {
                                                if($data_kenap->nilai1 <> ""){
                                                    $nilaikenapajak1 = $data_kenap->nilai1;
                                                }else {
                                                    $nilaikenapajak1 = '0';
                                                }
                                            }
                                        }else {
                                            $nilaikenapajak1 = '0';
                                        }

                                    $data_koreksigaji = DB::select("select sum(a.nilai) as kortam from pay_koreksigaji a where a.tahun='$tahungaji' and a.bulan='$bulangaji' and a.nopek='$nopeg'");
                                        if(!empty($data_koreksigaji)){
                                            foreach($data_koreksigaji as $data_koreksig)
                                            {
                                                if($data_koreksig->kortam <> ""){
                                                    $kortam = $data_koreksig->kortam;
                                                }else {
                                                    $kortam = '0';
                                                }
                                            }
                                        }else {
                                            $kortam = '0';
                                        }

                                    $totkenapajak = ((($nilaikenapajak1 + $niljstaccident + $niljstlife)*12) + $fasilitas + $kortam + $insentif);
                                    
                                    // 4.HITUNG BIAYA JABATAN
                                    $biayajabatan2 = ((5/100) * $totkenapajak);
                                    if($biayajabatan2 > 6000000){
                                        $biayajabatan = 6000000;  
                                    }else{
                                        $biayajabatan = $biayajabatan2;
                                    }

                                    $neto1tahun =  $totkenapajak - $biayajabatan;

                                    $data_ptkp = DB::select("select a.kodekeluarga,b.nilai from sdm_master_pegawai a,pay_tbl_ptkp b where a.kodekeluarga=b.kdkel and a.nopeg='$nopeg'");
                                        if(!empty($data_ptkp)){
                                            foreach($data_ptkp as $data_p)
                                            {
                                                if($data_p->nilai <> ""){
                                                    $nilaiptkp1 = $data_p->nilai;
                                                }else {
                                                    $nilaiptkp1 = '0';
                                                }
                                            }
                                        }else {
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


                                    $data_stungaji = DB::select("select nilai from pay_master_upah where tahun='$tahungaji' and bulan='$bulangaji' and nopek='$nopeg' and aard='27'");
                                        if(!empty($data_stungaji)){
                                            foreach($data_stungaji as $data_st)
                                            {
                                                if($data_st->nilai <> ""){
                                                    $pajakgaji = $data_st->nilai;
                                                }else {
                                                    $pajakgaji = '0';
                                                }
                                            }
                                        }else {
                                            $pajakgaji = '0';
                                        }
                                    $pajakakhir = ($pajakbulan - $pajakgaji)* 12;

                                    $data_potongan = DB::select("select nilai as nilai from pay_potongan_insentif where tahun='$data_tahun' and bulan='$$data_bulan' and nopek='$nopeg'");
                                        if(!empty($data_potongan)){
                                            foreach($data_potongan as $data_pot)
                                            {
                                                if($data_pot->nilai <> ""){
                                                    $potonganinsentif = $data_pot->nilai;
                                                }else {
                                                    $potonganinsentif = '0';
                                                }
                                            }
                                        }else {
                                            $potonganinsentif = '0';
                                        }
                                        // inspotpajak
                                        PayMasterInsentif::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $nopeg,
                                            'aard' => 26,
                                            'nilai' => $pajakakhir * -1,
                                            'tahunins' => $tahuns,
                                            'status' => 'C',
                                            'userid' => $request->userid,
                                            ]);
                                        // instunjpajak
                                        PayMasterInsentif::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $nopeg,
                                            'aard' => 27,
                                            'nilai' => $pajakakhir,
                                            'tahunins' => $tahuns,
                                            'status' => 'C',
                                            'userid' => $request->userid,
                                            ]);
                                        // inspotongan
                                        PayMasterInsentif::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $nopeg,
                                            'aard' => 24,
                                            'nilai' => $potonganinsentif,
                                            'tahunins' => $tahuns,
                                            'status' => 'C',
                                            'userid' => $request->userid,
                                            ]);
                                        // instunjangan
                                        PayMasterInsentif::insert([
                                            'tahun' => $data_tahun,
                                            'bulan' => $data_bulan,
                                            'nopek' => $nopeg,
                                            'aard' => 19,
                                            'nilai' => $insentif,
                                            'tahunins' => $tahuns,
                                            'status' => 'C',
                                            'pajakgaji' => $pajakgaji*12,
                                            'pajakins' => $pajakakhir,
                                            'ut' => $upahtetap,
                                            'pengali' => $pengali,
                                            'keterangan' => $keterangan,
                                            'potongan' => $potonganinsentif,
                                            'userid' => $request->userid,
                                            ]);
                                    }


                                    // PekerjaTetapIns()
                                    // 1.CARI PEGAWAI YANG STATUS PEKERJA Kontrak
                                    $data_caripegawai = DB::select("select nopeg,kodekeluarga from sdm_master_pegawai where status='C' order by nopeg asc");
                                    foreach($data_caripegawai as $data_cari)
                                    {                                
                                        $nopeg = $data_cari->nopeg;
                                        $kodekel = $data_cari->kodekeluarga;

                                    }
                            
                            
                        }elseif($request->prosesupah == 'C'){
                                
                            
                        }else {
                            
                        }
                        // StatBayarInsentif::insert([
                        //     'tahun' => $data_tahun,
                        //     'bulan' => $data_bulan,
                        //     'status' => 'N',      
                        //     ]); 
                        // Alert::success("Data Insentif bulan $data_bulan dan tahun $data_tahun berhasil di proses ", 'Berhasil')->persistent(true);
                        // return redirect()->route('proses_insentif.index');
                }
        }else {
            $data_cekstatusbayar = DB::select("select status from stat_bayar_insentif where tahun='$data_tahun' and bulan='$data_bulan'");
            if(!empty($data_cekstatusbayar)){
                    foreach($data_cekstatusbayar as $data_bayar)
                    {
                        $data_cekbayar = $data_bayar->status;
                    }
                    if($data_cekbayar == 'N'){
                        if($prosesupah == 'A'){
                            $data_Cekbatal = DB::select("select * from pay_master_insentif where tahun='$data_tahun' and bulan='$data_bulan'");
                        }else{
                            $data_Cekbatal = DB::select("select * from pay_master_insentif where tahun='$data_tahun' and bulan='$data_bulan' and status='$prosesupah'");
                        }
                            if(!empty($data_Cekbatal)){
                                    if($request->prosesupah == 'A'){
                                        PayMasterInsentif::where('tahun', $data_tahun)->where('bulan',$data_bulan)->delete();
                                    }else{
                                        PayMasterInsentif::where('tahun', $data_tahun)->where('bulan',$data_bulan)->where('status',$prosesupah)->delete();
                                    }
                                    StatBayarInsentif::where('tahun', $data_tahun)->where('bulan',$data_bulan)->delete();
                                    Alert::success("Proses pembatalan proses Insentif selesai", 'Berhasil')->persistent(true);
                                    return redirect()->route('proses_insentif.index');
                            }else {
                                    Alert::error("Tidak ditemukan data insentif bulan $data_bulan dan tahun $data_tahun", 'Error')->persistent(true);
                                    return redirect()->route('proses_insentif.index');
                            }

                    }else {
                        Alert::error("Tidak bisa dibatalkan Data Insentif bulan $data_bulan tahun $data_tahun sudah di proses perbendaharaan", 'Error')->persistent(true);
                        return redirect()->route('proses_insentif.index');
                    }
            }else{
                    Alert::error("Tidak ditemukan data insentif bulan $data_bulan dan tahun $data_tahun", 'Error')->persistent(true);
                    return redirect()->route('proses_insentif.index');
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
