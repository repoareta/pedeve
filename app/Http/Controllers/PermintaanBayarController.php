<?php

namespace App\Http\Controllers;

use App\Models\PermintaanBayar;
use App\Models\Vendor;
use App\Models\PermintaanDetail;
use App\Models\UmuDebetNota;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Carbon\Carbon;
use DB;
use Session;
use PDF;
use Alert;


class PermintaanBayarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permintaan_bayar.index');
    }

    public function indexJson()
    {
        $bayar_list = \DB::table('umu_bayar_header AS a')
                        ->select(\DB::raw('a.*, (SELECT sum(b.nilai)  FROM umu_bayar_detail as b WHERE b.no_bayar=a.no_bayar) AS nilai'))
                        ->orderBy('a.tgl_bayar', 'desc')
                        ->get();
        
        return datatables()->of($bayar_list)
            ->addColumn('no_bayar', function ($row) {
                return $row->no_bayar;
            })
            ->addColumn('no_kas', function ($row) {
                return $row->no_kas;
            })
            ->addColumn('kepada', function ($row) {
                return $row->kepada;
            })
            ->addColumn('keterangan', function ($row) {
                return $row->keterangan;
            })
            ->addColumn('lampiran', function ($row) {
                return $row->lampiran;
            })
            ->addColumn('nilai', function ($row) {
                return currency_idr($row->nilai);
            })
            ->addColumn('action', function ($row) {
                if($row->app_pbd == 'Y'){
                    $button = '<p align="center"><span style="font-size: 2em;" class="kt-font-success"><i class="fas fa-check-circle" title="Data Sudah di proses perbendaharaan"></i></span></p>';
                }else{
                    if($row->app_sdm == 'Y'){
                        $button = '<p align="center"><a href="'. route('permintaan_bayar.approv',['id' => str_replace('/', '-', $row->no_bayar)]).'"><span style="font-size: 2em;" class="kt-font-warning"><i class="fas fa-check-circle" title="Batalkan Approval"></i></span></a></p>';
                    }else{
                        $button = '<p align="center"><a href="'. route('permintaan_bayar.approv',['id' => str_replace('/', '-', $row->no_bayar)]).'"><span style="font-size: 2em;" class="kt-font-danger"><i class="fas fa-ban" title="Klik untuk Approval"></i></span></a></p>';
                    }
                }
                return $button;
            })
            ->addColumn('action_radio', function ($row) {
                if($row->app_pbd == 'Y'){
                    $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" data-id-rekap="'.str_replace('/', '-', $row->no_bayar).'" class="btn-radio-rekap" name="btn-radio-rekap"><span></span></label>';
                }else{
                    if($row->app_sdm == 'Y'){
                    $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input class="btn-radio" type="radio" disabled class="btn-radio" ><span></span></label>';
                    }else{
                        $radio = '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" databayar="'.$row->no_bayar.'" data-id="'.str_replace('/', '-', $row->no_bayar).'" name="btn-radio"><span></span></label>';
                    }
                }
                return $radio;
            })
            ->rawColumns(['action_radio','action'])
            ->make(true);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $debit_nota = UmuDebetNota::all();
        $data = DB::select("select left(max(no_bayar),-14) as no_bayar from umu_bayar_header where  date_part('year', tgl_bayar)  = date_part('year', CURRENT_DATE)");
        foreach ($data as $data_no_bayar) {
            $data_no_bayar->no_bayar;
        }
        $no_bayar_max = $data_no_bayar->no_bayar;
        if(!empty($no_bayar_max)) {
            $permintaan_header_count= sprintf("%03s", abs($no_bayar_max + 1)). '/CS/' . date('d/m/Y');
        }else {
            $permintaan_header_count= sprintf("%03s", 1). '/CS/' . date('d/m/Y');
        }
        $vendor = Vendor::all();
        return view('permintaan_bayar.create',compact('debit_nota','permintaan_header_count','vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_data =  DB::select("select * from umu_bayar_header where no_bayar = '$request->nobayar'");
        if(!empty($check_data))
        {
            PermintaanBayar::where('no_bayar', $request->nobayar)
            ->update([
            'no_bayar' => $request->nobayar,
            'tgl_bayar' => $request->tanggal,
            'lampiran' => $request->lampiran,
            'keterangan' => $request->keterangan,
            'kepada' => $request->dibayar,
            'debet_dari' => $request->debetdari,
            'debet_no' => $request->nodebet,
            'debet_tgl' => $request->tgldebet,
            'no_kas' => $request->nokas,
            'bulan_buku' => $request->bulanbuku,
            'ci' => $request->ci,
            'rate' => $request->kurs,
            'mulai' => $request->mulai,
            'sampai' => $request->sampai,
            ]);
            return response()->json();
        }else{
            DB::table('umu_bayar_header')->insert([
            'no_bayar' => $request->nobayar,
            'tgl_bayar' => $request->tanggal,
            'lampiran' => $request->lampiran,
            'keterangan' => $request->keterangan,
            'kepada' => $request->dibayar,
            'debet_dari' => $request->debetdari,
            'rekyes' => $request->rekyes,
            'debet_no' => $request->nodebet,
            'debet_tgl' => $request->tgldebet,
            'no_kas' => $request->nokas,
            'bulan_buku' => $request->bulanbuku,
            'ci' => $request->ci,
            'rate' => $request->kurs,
            'mulai' => $request->mulai,
            'sampai' => $request->sampai,
            // Save Panjar Header
            ]);
            return response()->json();
        }  
    }

    public function storeDetail(request $request)
    {      
        $check_data =  DB::select("select * from umu_bayar_detail where no = '$request->no' and  no_bayar = '$request->nobayar'");
        if(!empty($check_data)){
            PermintaanDetail::where('no_bayar', $request->nobayar)
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
            'no_bayar' => $request->nobayar
            ]);
            return response()->json();
        }else{
            PermintaanDetail::insert([
            'no' => $request->no,
            'keterangan' => $request->keterangan,
            'account' => $request->acc,
            'nilai' => $request->nilai,
            'cj' => $request->cj,
            'jb' => $request->jb,
            'bagian' => $request->bagian,
            'pk' => $request->pk,
            'no_bayar' => $request->nobayar
            ]);
            return response()->json();
        }
    }

    public function storeApp(Request $request)
    {      
        $nobayar=str_replace('-', '/', $request->nobayar);
        $data_app = PermintaanBayar::where('no_bayar',$nobayar)->select('*')->get();
        foreach($data_app as $data)
        {
            $check_data = $data->app_sdm;
        }
        if($check_data == 'Y'){
            PermintaanBayar::where('no_bayar', $nobayar)
            ->update([
                'app_sdm' => 'N',
                'app_sdm_oleh' => $request->userid,
                'app_sdm_tgl' => $request->tgl_app,
            ]);
            Alert::success('No. Bayar : '.$nobayar.' Berhasil Dibatalkan Approval', 'Berhasil')->persistent(true)->autoClose(2000);
            return redirect()->route('permintaan_bayar.index');
        }else{
            PermintaanBayar::where('no_bayar', $nobayar)
            ->update([
                'app_sdm' => 'Y',
                'app_sdm_oleh' => $request->userid,
                'app_sdm_tgl' => $request->tgl_app,
            ]);
            Alert::success('No. Bayar : '.$nobayar.' Berhasil Diapproval', 'Berhasil')->persistent(true)->autoClose(2000);
            return redirect()->route('permintaan_bayar.index');
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
    public function edit($nobayar)
    {
        $nobayars=str_replace('-', '/', $nobayar);
        $data_bayars =  PermintaanBayar::where('no_bayar', $nobayars)->get();
        $debit_nota = UmuDebetNota::all();
        $no_uruts =  DB::select("select max(no) as no from umu_bayar_detail where no_bayar = '$nobayars'");
        $data_bayar_details = PermintaanDetail::where('no_bayar',$nobayars)->get();
        $data_account = DB::select("select kodeacct, descacct FROM account where LENGTH(kodeacct)=6 AND kodeacct NOT LIKE '%X%'");
        $data_bagian = DB::select("SELECT A.kode,A.nama FROM sdm_tbl_kdbag A ORDER BY A.kode");
        $data_jenisbiaya = DB::select("select kode,keterangan from jenisbiaya order by kode");
        $data_cj = DB::select("select kode,nama from cashjudex order by kode");
        $count= PermintaanDetail::where('no_bayar',$nobayars)->select('no_bayar')->sum('nilai');
        $vendor=Vendor::all();
        if(!empty($no_urut) == null)
        { 
            foreach($no_uruts as $no_urut)
            {
                $no_bayar_details=$no_urut->no + 1;
            }
        }else{
            $no_bayar_details= 1;
        }
        return view('permintaan_bayar.edit', compact(
            'data_bayars',
            'debit_nota',
            'data_account',
            'data_bagian',
            'data_jenisbiaya',
            'data_cj',
            'no_bayar_details',
            'data_bayar_details',
            'count',
            'vendor'
        ));
    }

    public function editDetail($dataid, $datano)
    {
        $nobayar=str_replace('-', '/', $dataid);
        $data = PermintaanDetail::where('no', $datano)->where('no_bayar', $nobayar)->distinct()->get();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $nobayars=str_replace('-', '/', $request->id);
        PermintaanBayar::where('no_bayar', $nobayars)->delete();
        PermintaanDetail::where('no_bayar', $nobayars)->delete();
        return response()->json();
    }

    public function deleteDetail(Request $request)
    {

        PermintaanDetail::where('no', $request->no)
        ->where('no_bayar', $request->id)
        ->delete();
        return response()->json();
    }


    public function approv($id)
    {
        $nobayar=str_replace('-', '/', $id);
        $data_app = PermintaanBayar::where('no_bayar',$nobayar)->select('*')->get();
        return view('permintaan_bayar.approv',compact('data_app'));
    }

//surat permintaan bayar
    public function rekap($id)
    {
        $nobayar=str_replace('-', '/', $id);
        $data_report = PermintaanBayar::where('no_bayar',$nobayar)->select('*')->get();
        return view('permintaan_bayar.rekap',compact('data_report'));
    }


//rekap permintaan bayar
    public function rekapRange()
    {
        return view('permintaan_bayar.rekaprange');
    }




    public function rekapExport(Request $request)
    {
        $nobayar=$request->nobayar;
        PermintaanBayar::where('no_bayar', $nobayar)
            ->update([
            'pemohon' => $request->pemohon,
            'menyetujui' => $request->menyetujui,
            ]);
        $bayar_header_list = PermintaanBayar::where('no_bayar', $nobayar)->get();
        foreach($bayar_header_list as $data_report)
        {
            $data_report;
        }
        $bayar_detail_list = PermintaanDetail::where('no_bayar', $nobayar)->get();
        $list_acount =PermintaanDetail::where('no_bayar',$nobayar)->select('nilai')->sum('nilai');
        $pdf = PDF::loadview('permintaan_bayar.export', compact('list_acount','data_report','bayar_detail_list','request'))->setPaper('a4', 'Portrait');
        // return $pdf->download('rekap_permint_'.date('Y-m-d H:i:s').'.pdf');
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
            $bayar_header_list = \DB::table('umu_bayar_header AS a')
            ->select(\DB::raw('a.*, (SELECT sum(b.nilai)  FROM umu_bayar_detail as b WHERE b.no_bayar=a.no_bayar) AS nilai'))
            ->whereBetween('tgl_bayar', [$mulai, $sampai])
            ->where('app_pbd', 'Y')
            ->get();
            $bayar_header_list_total =PermintaanBayar::select(\DB::raw('SUM(umu_bayar_detail.nilai) as nilai'))
            ->Join('umu_bayar_detail', 'umu_bayar_detail.no_bayar', '=', 'umu_bayar_header.no_bayar')
            ->whereBetween('umu_bayar_header.tgl_bayar', [$mulai, $sampai])
            ->where('app_pbd', 'Y')
            ->get();
            $pdf = PDF::loadview('permintaan_bayar.exportrange', compact('bayar_header_list_total','bayar_header_list','bulan','tahun'))->setPaper('a4', 'landscape');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(700, 120, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
            // return $pdf->download('rekap_permint_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        }elseif($request->submit == 'xlsx') {
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
            $bayar_header_list = \DB::table('umu_bayar_header AS a')
            ->select(\DB::raw('a.*, (SELECT sum(b.nilai)  FROM umu_bayar_detail as b WHERE b.no_bayar=a.no_bayar) AS nilai'))
            ->whereBetween('tgl_bayar', [$mulai, $sampai])
            ->where('app_pbd', 'Y')
            ->get();
            $bayar_header_list_total =PermintaanBayar::select(\DB::raw('SUM(umu_bayar_detail.nilai) as nilai'))
            ->Join('umu_bayar_detail', 'umu_bayar_detail.no_bayar', '=', 'umu_bayar_header.no_bayar')
            ->whereBetween('umu_bayar_header.tgl_bayar', [$mulai, $sampai])
            ->where('app_pbd', 'Y')
            ->get();
            $excel=new Spreadsheet;
            return view('permintaan_bayar.exportexcel', compact('bayar_header_list_total','bayar_header_list','bulan','tahun','excel'));
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
            $bayar_header_list = \DB::table('umu_bayar_header AS a')
            ->select(\DB::raw('a.*, (SELECT sum(b.nilai)  FROM umu_bayar_detail as b WHERE b.no_bayar=a.no_bayar) AS nilai'))
            ->whereBetween('tgl_bayar', [$mulai, $sampai])
            ->where('app_pbd', 'Y')
            ->get();
            $bayar_header_list_total =PermintaanBayar::select(\DB::raw('SUM(umu_bayar_detail.nilai) as nilai'))
            ->Join('umu_bayar_detail', 'umu_bayar_detail.no_bayar', '=', 'umu_bayar_header.no_bayar')
            ->whereBetween('umu_bayar_header.tgl_bayar', [$mulai, $sampai])
            ->where('app_pbd', 'Y')
            ->get();
            $excel=new Spreadsheet;
            return view('permintaan_bayar.exportcsv', compact('bayar_header_list_total','bayar_header_list','bulan','tahun','excel'));
        }
    }
}
