<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailUmk;
use DataTables;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use DB;
use Session;
use DomPDF;
use Alert;

class LemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
            if(!empty($data_tahunbulan)) {
                foreach ($data_tahunbulan as $data_bul) {
                    $tahun = substr($data_bul->bulan_buku,0,-2); 
                    $bulan = substr($data_bul->bulan_buku,4); 
                }
            }else{
                $bulan ='00';
                $tahun ='0000';
            }
        $tahuns = $tahun;
        $data_list = DB::select("select a.bulan,a.tahun, a.tanggal, a.nopek, a.libur, a.mulai, a.sampai, a.makanpg, a.makansg, a.makanml, a.transport,a.lembur,(a.makanpg+a.makansg+a.makanml+a.transport+a.lembur) as total, b.nama as nama_nopek from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg where a.tahun='$tahuns' order by a.tanggal desc");
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        return view('lembur.index',compact('data_list','data_pegawai','tahun','bulan'));
    }


    public function searchIndex(Request $request)
    {
            $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
            foreach($data_tahunbulan as $data_bul)
            {
                $bulan_buku = $data_bul->bulan_buku;
            }
            $tahuns = substr($bulan_buku,0,-2);
            $bulan = ltrim($request->bulan, '0');
            $tahun = $request->tahun;
            $nopek = $request->nopek;
          

            if($nopek == null){
                if($bulan == null and $tahun == null){
                    $data = DB::select("select a.bulan,a.tahun, a.tanggal, a.nopek, a.libur, a.mulai, a.sampai, a.makanpg, a.makansg, a.makanml, a.transport,a.lembur,(a.makanpg+a.makansg+a.makanml+a.transport+a.lembur) as total, b.nama as nama_nopek from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg where a.tahun='$tahuns' order by a.tanggal desc");
                }elseif($bulan == null and $tahun <> null){
                    $data = DB::select("select a.bulan,a.tahun, a.tanggal, a.nopek, a.libur, a.mulai, a.sampai, a.makanpg, a.makansg, a.makanml, a.transport,a.lembur,(a.makanpg+a.makansg+a.makanml+a.transport+a.lembur) as total, b.nama as nama_nopek from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg where a.tahun='$tahun' order by a.tanggal desc");
                }else{
                    $data = DB::select("select a.bulan,a.tahun, a.tanggal, a.nopek, a.libur, a.mulai, a.sampai, a.makanpg, a.makansg, a.makanml, a.transport,a.lembur,(a.makanpg+a.makansg+a.makanml+a.transport+a.lembur) as total, b.nama as nama_nopek from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg where a.bulan='$bulan' and a.tahun='$tahun' order by a.nopek asc");
                }
            }else{
                if($bulan == null and $tahun == null){
                    $data = DB::select("select a.bulan,a.tahun, a.tanggal, a.nopek, a.libur, a.mulai, a.sampai, a.makanpg, a.makansg, a.makanml, a.transport,a.lembur,(a.makanpg+a.makansg+a.makanml+a.transport+a.lembur) as total, b.nama as nama_nopek from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg where a.nopek='$nopek' order by a.tanggal desc");
                }else{
                    $data = DB::select("select a.bulan,a.tahun, a.tanggal, a.nopek, a.libur, a.mulai, a.sampai, a.makanpg, a.makansg, a.makanml, a.transport,a.lembur,(a.makanpg+a.makansg+a.makanml+a.transport+a.lembur) as total, b.nama as nama_nopek  from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg where a.bulan='$bulan' and a.tahun='$tahun' and a.nopek='$nopek' order by a.tanggal asc");
                }
            }
            return datatables()->of($data)
            ->addColumn('bulan', function ($data) {
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
                $bulan= strtoupper($array_bln[$data->bulan]);
                return $bulan;
           })
            ->addColumn('nopek', function ($data) {
                return $data->nopek.' -- '.$data->nama_nopek;
           })
            ->addColumn('tanggal', function ($data) {
                $tgl = date_create($data->tanggal);
				$tangg= date_format($tgl, 'd F Y');
                return $tangg;
           })
            ->addColumn('makanpg', function ($data) {
                 return number_format($data->makanpg,2,'.',',');
           })
            ->addColumn('makansg', function ($data) {
                 return number_format($data->makansg,2,'.',',');
           })
            ->addColumn('makanml', function ($data) {
                 return number_format($data->makanml,2,'.',',');
           })
            ->addColumn('transport', function ($data) {
                 return number_format($data->transport,2,'.',',');
           })
            ->addColumn('lembur', function ($data) {
                 return number_format($data->lembur,2,'.',',');
           })
            ->addColumn('total', function ($data) {
                 return number_format($data->total,2,'.',',');
           })
    
            ->addColumn('radio', function ($data) {
                $tgl = date_create($data->tanggal);
                $tanggal = date_format($tgl, 'd-m-Y');
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" data-tanggal="'.$tanggal.'"  data-nopek="'.$data->nopek.'" class="btn-radio" name="btn-radio-rekap"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action','radio'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        $data_potongan = DB::select("select kode, nama, jenis, kenapajak, lappajak from pay_tbl_aard where kode in ('18','28','19','44') order by kode");	
        return view('lembur.create',compact('data_pegawai','data_potongan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_cek = DB::select("select * from pay_lembur where to_char(tanggal, 'dd/mm/YYYY') = '$request->tanggal' and nopek='$request->nopek'");
        if(!empty($data_cek)){
            $data=0;
            return response()->json($data);

        }else {
                DB::table('pay_lembur')->insert([
                    'tanggal' => $request->tanggal,
                    'nopek' => $request->nopek, 
                    'makanpg' => str_replace(',', '.', $request->makanpg), 
                    'makansg' => str_replace(',', '.', $request->makansg), 
                    'makanml' => str_replace(',', '.', $request->makanml), 
                    'transport' => str_replace(',', '.', $request->transport),
                    'lembur' => str_replace(',', '.', $request->lembur), 
                    'userid' => $request->userid,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    ]);
                    $data = 1;
                    return response()->json($data);
            # code...
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tanggal, $nopek)
    {
        $data_list = DB::select("select bulan,tahun,tanggal,nopek,makanpg, makansg, makanml, transport,lembur, userid from pay_lembur where  to_char(tanggal, 'dd-mm-YYYY')= '$tanggal' and nopek = '$nopek'");
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        $data_potongan = DB::select("select kode, nama, jenis, kenapajak, lappajak from pay_tbl_aard where kode in ('18','28','19','44') order by kode");	
        return view('lembur.edit',compact('data_list','data_pegawai','data_potongan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $mapg = str_replace(',', '.', $request->makanpg);
        $masi = str_replace(',', '.', $request->makansg);
        $maml = str_replace(',', '.', $request->makanml);
        $trans = str_replace(',', '.', $request->transport);
        $lem = str_replace(',', '.', $request->lembur);
        DB::update("update pay_lembur set makanpg='$mapg', makansg='$masi', makanml='$maml', transport='$trans',lembur='$lem', userid='$request->userid',bulan='$request->bulan',tahun='$request->tahun' where to_char(tanggal, 'dd/mm/YYYY') = '$request->tanggal' and nopek='$request->nopek'");
       
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        DB::delete("delete from pay_lembur where to_char(tanggal, 'dd-mm-YYYY') = '$request->tanggal' and nopek='$request->nopek'");
        return response()->json();

    }

    public function ctkrekaplembur()
    {
        return view('lembur.rekap');
    }
    public function rekapExport(Request $request)
    {
        $data_list = DB::select("select a.*, b.* from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg where a.tahun='$request->tahun' and a.bulan='$request->bulan'");
        if (!empty($data_list)) {
            $pdf = DomPDF::loadview('lembur.export_lembur', compact('request', 'data_list'))->setPaper('a4', 'landscape');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(740, 115, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        } else {
            Alert::error('Tidak Ada Data Yang Dicari', 'Failed')->persistent(true);
            return redirect()->route('lembur.ctkrekaplembur');
        }
    }
}
