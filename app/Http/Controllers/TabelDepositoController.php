<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dtldepositotest;
use DB;
use PDF;
use Excel;
use Alert;

class TabelDepositoController extends Controller
{
    public function index()
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from bulankontroller where status='1' and length(thnbln)='6'");
            if(!empty($data_tahunbulan)) {
                foreach ($data_tahunbulan as $data_bul) {
                    $tahun = substr($data_bul->bulan_buku,0,-2); 
                    $bulan = substr($data_bul->bulan_buku,4); 
                }
            }else{
                $bulan ='00';
                $tahun ='0000';
            }
        return view('tabel_deposito.index',compact('tahun','bulan'));
    }

    public function searchIndex(Request $request)
    {
        $bulan = ltrim($request->bulan, '0');
            $tahun = $request->tahun;
            if($bulan <> "" and $tahun <> ""){
                $data = DB::select("select a.docno,a.lineno,a.noseri,a.nominal,a.tgldep,a.tgltempo,a.perpanjangan,EXTRACT(day from tgltempo)-EXTRACT(day from date(now())) selhari,EXTRACT(month from tgltempo)-EXTRACT(month from date(now())) selbulan,EXTRACT(year from tgltempo)-EXTRACT(year from date(now())) seltahun,b.haribunga,a.bungatahun,b.bungabulan,b.pph20,b.netbulan,a.asal,a.kdbank,a.keterangan,b.accharibunga,b.accbungabulan,b.accpph20,b.accnetbulan,b.bulan,b.tahun,c.descacct as namabank from mtrdeposito a join account c on a.kdbank=c.kodeacct,dtldepositotest b where a.proses = 'Y' and b.docno=a.docno and a.lineno=b.lineno and a.perpanjangan=b.perpanjangan and b.bulan='$bulan' and b.tahun='$tahun' order by a.tgltempo asc");
            }elseif($bulan == "" and $tahun <> ""){ 
                $data = DB::select("select a.docno,a.lineno,a.noseri,a.nominal,a.tgldep,a.tgltempo,a.perpanjangan,EXTRACT(day from tgltempo)-EXTRACT(day from date(now())) selhari,EXTRACT(month from tgltempo)-EXTRACT(month from date(now())) selbulan,EXTRACT(year from tgltempo)-EXTRACT(year from date(now())) seltahun,b.haribunga,a.bungatahun,b.bungabulan,b.pph20,b.netbulan,a.asal,a.kdbank,a.keterangan,b.accharibunga,b.accbungabulan,b.accpph20,b.accnetbulan,b.bulan,b.tahun,c.descacct as namabank from mtrdeposito a join account c on a.kdbank=c.kodeacct,dtldepositotest b where a.proses = 'Y' and b.docno=a.docno and a.lineno=b.lineno and a.perpanjangan=b.perpanjangan and b.tahun='$tahun' order by a.tgltempo asc" );				    
            }else{
                $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from bulankontroller where status='1' and length(thnbln)=6");
                if(!empty($data_tahunbulan)){
                    foreach($data_tahunbulan as $data_bul)
                    {
                        $bulan_buku = $data_bul->bulan_buku;
                    }
                }else{
                    $tgl = now();
                    $tanggal = date_format($tgl, 'Ym');
                    $bulan_buku = $tanggal;
                }
                $tahuns = substr($bulan_buku,0,-2);
                $bulans = ltrim(substr($bulan_buku,4), '0');

                $data = DB::select("select a.docno,a.lineno,a.noseri,a.nominal,a.tgldep,a.tgltempo,a.perpanjangan,EXTRACT(day from tgltempo)-EXTRACT(day from date(now())) selhari,EXTRACT(month from tgltempo)-EXTRACT(month from date(now())) selbulan,EXTRACT(year from tgltempo)-EXTRACT(year from date(now())) seltahun,b.haribunga,a.bungatahun,b.bungabulan,b.pph20,b.netbulan,a.asal,a.kdbank,a.keterangan,b.accharibunga,b.accbungabulan,b.accpph20,b.accnetbulan,b.bulan,b.tahun,c.descacct as namabank from mtrdeposito a join account c on a.kdbank=c.kodeacct,dtldepositotest b where a.proses = 'Y' and b.docno=a.docno and a.lineno=b.lineno and a.perpanjangan=b.perpanjangan and b.bulan='$bulans' and b.tahun='$tahuns' order by a.tgltempo asc");
            }
            return datatables()->of($data)
                ->addColumn('noseri', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    return '<font color="'.$warni.'">'.$data->noseri.'</font>';
                })
                ->addColumn('namabank', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    return '<font color="'.$warni.'">'.$data->namabank.'</font>';
                })
                ->addColumn('asal', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    return '<font color="'.$warni.'">'.$data->asal.'</font>';
                })
                ->addColumn('nominal', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    return '<font color="'.$warni.'">'.'Rp. '.number_format($data->nominal,2,'.',',').'</font>';
                })
                ->addColumn('tgldep', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    $tgl = date_create($data->tgldep);
                    return '<font color="'.$warni.'">'.date_format($tgl, 'd/m/Y').'</font>';
                })
                ->addColumn('tgltempo', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    $tgl = date_create($data->tgltempo);
                    return '<font color="'.$warni.'">'.date_format($tgl, 'd/m/Y').'</font>';
                })
                ->addColumn('haribunga', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    return '<font color="'.$warni.'">'.$data->haribunga.'</font>';
                })
                ->addColumn('bungatahun', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    return '<font color="'.$warni.'">'.number_format($data->bungatahun,2,'.',',').'</font>';
                })
                ->addColumn('bungabulan', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    return '<font color="'.$warni.'">'.'Rp. '.number_format($data->bungabulan,2,'.',',').'</font>';
                })
                ->addColumn('pph20', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    return '<font color="'.$warni.'">'.'Rp. '.number_format($data->pph20,2,'.',',').'</font>';
                })
                ->addColumn('netbulan', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    return '<font color="'.$warni.'">'.'Rp. '.number_format($data->netbulan,2,'.',',').'</font>';
                })
                ->addColumn('accharibunga', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    return '<font color="'.$warni.'">'.$data->accharibunga.'</font>';
                })
                ->addColumn('accnetbulan', function ($data) {
                    $tgl = date_create(date('Y-m-d H:i:s'));
                    $datenow = date_format($tgl, 'Y-m-d');
                    $tgl_tem = date_create($data->tgltempo);
                    $tgltempo = date_format($tgl_tem, 'Y-m-d');
                    if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
                        $warni = "#ff0000";
                    }elseif($tgltempo <= $datenow){
                        $warni = "#666666";
                    }else{ 
                        $warni = "#000000";
                    }
                    return '<font color="'.$warni.'">'.'Rp. '.number_format($data->accnetbulan,2,'.',',').'</font>';
                })
                ->addColumn('radio', function ($data) {
                    $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" name="btn-radio" nodok="'.$data->docno.'" lineno="'.$data->lineno.'" pjg="'.$data->perpanjangan.'"><span></span></label>'; 
                    return $radio;
                })
                ->rawColumns([
                    'action',
                    'radio',
                    'noseri',
                    'namabank',
                    'asal',
                    'nominal',
                    'tgldep',
                    'tgltempo',
                    'haribunga',
                    'bungatahun',
                    'bungabulan',
                    'pph20',
                    'netbulan',
                    'accharibunga',
                    'accnetbulan'
                    ])
                ->make(true);
    }
}
