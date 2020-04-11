<?php

namespace App\Http\Controllers;

use App\Models\Umk;
use App\Models\Vendor;
use App\Models\DetailUmk;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use DB;
use Session;
use PDF;
use Alert;

class UangMukaKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
        foreach($data_tahunbulan as $data_bul)
        {
            $bulan_buku = $data_bul->bulan_buku;
        }
        $data_list = Umk::where('bulan_buku',$bulan_buku)->orderBy('no_umk','desc')->get();
        return view('umk.index',compact('data_list'));
    }

    public function searchIndex(Request $request)
    {

        if($request->permintaan <>  null and $request->tahun == null and $request->bulan == null){
            $data_list = DB::select("select a.no_umk,a.jenis_um,a.app_pbd,a.app_sdm,a.tgl_panjar,a.no_kas,a.keterangan,a.jumlah from kerja_header a where a.no_umk like '$request->permintaan%' order by a.bulan_buku desc,a.no_umk desc");
         }elseif($request->permintaan <>  null and $request->tahun <>  null and $request->bulan ==  null){
            $data_list = DB::select("select  a.no_umk,a.jenis_um,a.app_pbd,a.app_sdm,a.tgl_panjar,a.no_kas,a.keterangan,a.jumlah from kerja_header a where a.no_umk like '$request->permintaan%' and left(a.bulan_buku,4)='$request->tahun' order by a.bulan_buku desc,a.no_umk desc");
         }elseif($request->permintaan ==  null and $request->tahun <>  null and $request->bulan <>  null){
            $data_list = DB::select("select a.no_umk,a.jenis_um,a.app_pbd,a.app_sdm,a.tgl_panjar,a.no_kas,a.keterangan,a.jumlah from kerja_header a where right(a.no_umk,4)='$request->tahun' and (SUBSTRING(a.no_umk,11,2) ='$request->bulan' or SUBSTRING(a.no_umk,10,2) ='$request->bulan') order by a.bulan_buku desc,a.no_umk desc");
            
         }elseif($request->permintaan <>  null and $request->tahun <>  null and $request->bulan <>  null){
            $data_list = DB::select("select a.no_umk,a.jenis_um,a.app_pbd,a.app_sdm,a.tgl_panjar,a.no_kas,a.keterangan,a.jumlah from kerja_header a where a.no_umk like '$request->permintaan%' and right(a.no_umk,4)='$request->tahun' and (SUBSTRING(a.no_umk,11,2) ='$request->bulan' or SUBSTRING(a.no_umk,10,2) ='$request->bulan') order by a.bulan_buku desc,a.no_umk desc");
         }else{
             $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
             foreach($data_tahunbulan as $data_bul)
             {
                 $bulan_buku = $data_bul->bulan_buku;
             }
             
             $data_list = DB::select("select  a.no_umk,a.jenis_um,a.app_pbd,a.app_sdm,a.tgl_panjar,a.no_kas,a.keterangan,a.jumlah from kerja_header a where a.bulan_buku ='$bulan_buku' order by a.bulan_buku desc,a.no_umk desc");
        }
        return view('umk.index',compact('data_list'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
             foreach($data_tahunbulan as $data_bul)
             {
                 $bulan_buku = $data_bul->bulan_buku;
             }
        $awal = "CS";
        $data = DB::select("select left(max(no_umk),-14) as no_umk from kerja_header where  date_part('year', tgl_panjar)  = date_part('year', CURRENT_DATE)");
        foreach ($data as $data_no_umk) {
            $data_no_umk->no_umk;
        }
        $no_umk_max = $data_no_umk->no_umk;
        if(!empty($no_umk_max)) {
            $no_umk= sprintf("%03s", abs($no_umk_max + 1)). '/' . $awal .'/' . date('d/m/Y');
        }else {
            $no_umk= sprintf("%03s", 1). '/' . $awal .'/' . date('d/m/Y');
        }
        $vendor = Vendor::all();
        return view('umk.create', compact('no_umk','vendor','bulan_buku'));
    }

    /**
     * melakukan insert ke umk
     */
    public function store(Request $request)
    {
        $check_data = DB::select("select * from kerja_header where no_umk = '$request->no_umk'");
        if(!empty($check_data))
        {
            DB::table('kerja_header')
            ->where('no_umk', $request->no_umk)
            ->update([
            'kepada' => $request->kepada,
            'tgl_panjar' => $request->tgl_panjar,
            'bulan_buku' => $request->bulan_buku,
            'keterangan' => $request->untuk,
            'ci' => $request->ci,
            'rate' => $request->kurs,
            'jenis_um' => $request->jenis_um,
            'no_umk' => $request->no_umk,
            'jumlah' => $request->jumlah
            ]);
            return response()->json();
        }else{
            DB::table('kerja_header')->insert([
                'kepada' => $request->kepada,
                'tgl_panjar' => $request->tgl_panjar,
                'app_sdm' => 'N',
                'bulan_buku' => $request->bulan_buku,
                'keterangan' => $request->untuk,
                'ci' => $request->ci,
                'app_pbd' => 'N',
                'rate' => $request->kurs,
                'jenis_um' => $request->jenis_um,
                'no_umk' => $request->no_umk,
                'jumlah' => $request->jumlah,
                ]);
                return response()->json();
        }        
    }

    public function storeDetail(Request $request)
    {      
        $check_data =  DB::select("select * from kerja_detail where no = '$request->no' and  no_umk = '$request->no_umk'");
        if(!empty($check_data)){
            DetailUmk::where('no_umk', $request->no_umk)
            ->where('no', $request->no)
            ->update([
            'no' => $request->no,
            'keterangan' => $request->keterangan,
            'account' => $request->acc,
            'nilai' => $request->nilai,
            'cj' => $request->cj,
            'jb' => $request->jb,
            'bagian' => $request->bagian,
            'pk' => $request->pk,
            'no_umk' => $request->no_umk
            ]);
            return response()->json();
        }else{
            DetailUmk::insert([
            'no' => $request->no,
            'keterangan' => $request->keterangan,
            'account' => $request->acc,
            'nilai' => $request->nilai,
            'cj' => $request->cj,
            'jb' => $request->jb,
            'bagian' => $request->bagian,
            'pk' => $request->pk,
            'no_umk' => $request->no_umk
            ]);
            return response()->json();
        }
    }

    public function storeApp(Request $request)
    {      
        $noumk=str_replace('-', '/', $request->noumk);
        $data_app = Umk::where('no_umk',$noumk)->select('*')->get();
        foreach($data_app as $data)
        {
            $check_data = $data->app_sdm;
        }
        if($check_data == 'Y'){
            Umk::where('no_umk', $noumk)
            ->update([
                'app_sdm' => 'N',
                'app_sdm_oleh' => $request->userid,
                'app_sdm_tgl' => $request->tgl_app,
            ]);
            Alert::success('No. UMK : '.$noumk.' Berhasil Dibatalkan Approval', 'Berhasil')->persistent(true)->autoClose(2000);
            return redirect()->route('uang_muka_kerja.index');
        }else{
            Umk::where('no_umk', $noumk)
            ->update([
                'app_sdm' => 'Y',
                'app_sdm_oleh' => $request->userid,
                'app_sdm_tgl' => $request->tgl_app,
            ]);
            Alert::success('No. UMK : '.$noumk.' Berhasil Diapproval', 'Berhasil')->persistent(true)->autoClose(2000);
            return redirect()->route('uang_muka_kerja.index');
        }
    }

    public function edit($no)
    {   
        $noumk=str_replace('-', '/', $no);
        $data_umks = DB::select("select * from kerja_header where no_umk = '$noumk'");
        $no_uruts = DB::select("select max(no) as no from kerja_detail where no_umk = '$noumk'");
        $data_umk_details = DetailUmk::where('no_umk',$noumk)->get();
        $data_account = DB::select("select kodeacct, descacct FROM account where LENGTH(kodeacct)=6 AND kodeacct NOT LIKE '%X%'");
        $data_bagian = DB::select("SELECT A.kode,A.nama FROM sdm_tbl_kdbag A ORDER BY A.kode");
        $data_jenisbiaya = DB::select("select kode,keterangan from jenisbiaya order by kode");
        $data_cj = DB::select("select kode,nama from cashjudex order by kode");
        $count= DetailUmk::where('no_umk',$noumk)->select('no_umk')->sum('nilai');
        $vendor=Vendor::all();
        if(!empty($no_urut) == null)
        {
            foreach($no_uruts as $no_urut)
            {
                $no_umk_details=$no_urut->no + 1;
            }
        }else{
            $no_umk_details= 1;
        }
        
            return view('umk.edit', compact(
                'data_umks',
                'data_umk_details',
                'no_umk_details',
                'data_account',
                'data_bagian',
                'data_jenisbiaya',
                'data_cj',
                'count',
                'vendor'));
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_detail($dataid, $datano)
    {
        $noumk=str_replace('-', '/', $dataid);

            $data = DetailUmk::where('no', $datano)->where('no_umk', $noumk)->distinct()->get();
            return response()->json($data[0]);

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

    public function delete(Request $request)
    {
        Umk::where('no_umk', $request->id)->delete();
        DetailUmk::where('no_umk', $request->id)->delete();
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDetail(Request $request)
    {

        DetailUmk::where('no', $request->no)
        ->where('no_umk', $request->id)
        ->delete();
        return response()->json();
    }


    public function approv($id)
    {
        $noumk=str_replace('-', '/', $id);
        $data_app = Umk::where('no_umk',$noumk)->select('*')->get();
        return view('umk.approv',compact('data_app'));
    }

    public function rekap($id)
    {
        $noumk=str_replace('-', '/', $id);
        $data_cekjb = DB::select("select a.no_umk,(select sum(nilai) from kerja_detail where upper(no_umk)=upper(a.no_umk)) as total from kerja_header a where upper(a.no_umk)='$noumk'");
        foreach($data_cekjb as $data_cek)
        {
            $data_c = $data_cek->total;
        }
        if($data_c < 10000000){
            $setuju = "ALI SYAMSUL ROHMAN";
            $setujus = "CS & BS";
            $pemohon = "ANGGRAINI GITTA L";
            $pemohons = "IA & RM";
        }else{
            $setuju = "SJAHRIL SAMAD";
            $setujus = "DIREKTUR UTAMA";
            $pemohon = "ALI SYAMSUL ROHMAN";
            $pemohons = "CS & BS";
        }
        $data_report = Umk::where('no_umk',$noumk)->select('*')->get();
        return view('umk.rekap',compact(
            'data_report',
            'setuju',
            'setujus',
            'pemohon',
            'pemohons'
        ));
    }

    public function rekapRange()
    {
        return view('umk.rekaprange');
    }

    public function rekapExport(Request $request)
    {
        $noumk=$request->noumk;
        $header_list = Umk::where('no_umk', $noumk)->get();
        foreach($header_list as $data_report)
        {
            $data_report;
        }
        $detail_list = DetailUmk::where('no_umk', $noumk)->get();
        $list_acount =DetailUmk::where('no_umk',$noumk)->select('nilai')->sum('nilai');
        $pdf = PDF::loadview('umk.export', compact(
            'list_acount',
            'data_report',
            'detail_list',
            'request'            
            ))->setPaper('a4', 'Portrait');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(690, 100, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
        // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
        return $pdf->stream();
    }

    public function rekapExportRange(Request $request)
    {
        if($request->submit == 'pdf')
        {
            $mulai = date($request->mulai);
            $sampai = date($request->sampai);
            $pecahkan = explode('-', $request->mulai);
            $array_bln	 = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
              );
              
            $bulan= strtoupper($array_bln[ (int)$pecahkan[1] ]);
            $tahun=$pecahkan[0];
            $umk_header_list = Umk::whereBetween('tgl_panjar', [$mulai, $sampai])->where('app_pbd', 'Y')
            ->get();
            // dd($umk_header_list);
            $list_acount =Umk::whereBetween('tgl_panjar', [$mulai, $sampai])
            ->where('app_pbd', 'Y')->select('jumlah')->sum('jumlah');
            $pdf = PDF::loadview('umk.exportrange',compact('umk_header_list','list_acount','bulan','tahun'))->setPaper('a4', 'landscape');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
    
            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(690, 100, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        }elseif($request->submit == 'xlsx')
        {
            $mulai = date($request->mulai);
            $sampai = date($request->sampai);
            $pecahkan = explode('-', $request->mulai);
            $array_bln	 = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
              );
              
            $bulan= strtoupper($array_bln[ (int)$pecahkan[1] ]);
            $tahun=$pecahkan[0];
            $umk_header_list = Umk::whereBetween('tgl_panjar', [$mulai, $sampai])->where('app_pbd', 'Y')
            ->get();
            $list_acount =Umk::whereBetween('tgl_panjar', [$mulai, $sampai])
            ->where('app_pbd', 'Y')->select('jumlah')->sum('jumlah');
            $excel=new Spreadsheet;
            return view('umk.exportexcel',compact('umk_header_list','list_acount','excel','bulan','tahun'));
        }else{
            $mulai = date($request->mulai);
            $sampai = date($request->sampai);
            $pecahkan = explode('-', $request->mulai);
            $array_bln	 = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
              );
              
            $bulan= strtoupper($array_bln[ (int)$pecahkan[1] ]);
            $tahun=$pecahkan[0];
            $umk_header_list = Umk::whereBetween('tgl_panjar', [$mulai, $sampai])->where('app_pbd', 'Y')
            ->get();
            $list_acount =Umk::whereBetween('tgl_panjar', [$mulai, $sampai])
            ->where('app_pbd', 'Y')->select('jumlah')->sum('jumlah');
            $excel=new Spreadsheet;
            return view('umk.exportcsv',compact('umk_header_list','list_acount','excel','bulan','tahun'));
        }
    }

}
