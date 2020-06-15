<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fiosd201;
use Auth;
use DB;
use Session;
use PDF;
use Alert;

class MasterPhkController extends Controller
{
    public function index()
    {
        return view('master_phk.index');
    }
    public function indexJson(Request $request)
     {
        $rsbulan = DB::select("select max(thnbln) as thnbln from bulankontroller where status='1' and length(thnbln)=6");
        if(!empty($rsbulan)){
            foreach($rsbulan as $dat)
            {
                if(is_null($dat->thnbln)){
                    $thnblopen2 = "";
                }else{
                    $thnblopen2 = $dat->thnbln;
                }
            }
        }else{
            $thnblopen2 = "";
        }
        $tahun = substr($thnblopen2,0,-2); 
        if($request->bulan<>"" and $request->tahun<>""){
            $data = DB::select("select a.no_surat,a.tahun,a.bulan,a.tgl_serah,a.ttd_oleh,a.proses,a.approve,
                            (select sum(tab) from serah_detail where no_serah=a.no_surat) as pokok,
                            (select sum(hasil) from serah_detail where no_serah=a.no_surat) as hp,
                            (select sum(bunga) from serah_detail where no_serah=a.no_surat) as bunga,
                            (select sum(pajak) from serah_detail where no_serah=a.no_surat) as pph23val,
                            (select sum(pph21) from serah_detail where no_serah=a.no_surat) as pph21val,
                            (select count(no_serah) from serah_detail where no_serah=a.no_surat) as jumlah
                            from phk_header a where  a.tahun='$request->tahun' and a.bulan='$request->bulan'
                            group by a.no_surat,a.tahun,a.bulan,a.tgl_serah,a.ttd_oleh,a.proses,a.approve order by a.tahun desc,a.bulan desc");
        }elseif($request->bulan =="" and $request->tahun<>""){
            $data = DB::select("select a.no_surat,a.tahun,a.bulan,a.tgl_serah,a.ttd_oleh,a.proses,a.approve,
                            (select sum(tab) from serah_detail where no_serah=a.no_surat) as pokok,
                            (select sum(hasil) from serah_detail where no_serah=a.no_surat) as hp,
                            (select sum(bunga) from serah_detail where no_serah=a.no_surat) as bunga,
                            (select sum(pajak) from serah_detail where no_serah=a.no_surat) as pph23val,
                            (select sum(pph21) from serah_detail where no_serah=a.no_surat) as pph21val,
                            (select count(no_serah) from serah_detail where no_serah=a.no_surat) as jumlah
                            from phk_header a where  a.tahun>='$request->tahun'
                            group by a.no_surat,a.tahun,a.bulan,a.tgl_serah,a.ttd_oleh,a.proses,a.approve order by a.tahun desc,a.bulan desc");
        }else{
            $data = DB::select("select a.no_surat,a.tahun,a.bulan,a.tgl_serah,a.ttd_oleh,a.proses,a.approve,
                            (select sum(tab) from serah_detail where no_serah=a.no_surat) as pokok,
                            (select sum(hasil) from serah_detail where no_serah=a.no_surat) as hp,
                            (select sum(bunga) from serah_detail where no_serah=a.no_surat) as bunga,
                            (select sum(pajak) from serah_detail where no_serah=a.no_surat) as pph23val,
                            (select sum(pph21) from serah_detail where no_serah=a.no_surat) as pph21val,
                            (select count(no_serah) from serah_detail where no_serah=a.no_surat) as jumlah
                            from phk_header a where  a.tahun>='$tahun'
                            group by a.no_surat,a.tahun,a.bulan,a.tgl_serah,a.ttd_oleh,a.proses,a.approve order by a.tahun desc,a.bulan desc");
        }
         
         return datatables()->of($data)
         ->addColumn('no_surat', function ($data) {
             return $data->no_surat;
        })
         ->addColumn('tgl_serah', function ($data) {
            $tgl = date_create($data->tgl_serah);
            return date_format($tgl, 'd/m/Y');
        })
         ->addColumn('tahun', function ($data) {
             return $data->tahun.''.$data->bulan;
        })
         ->addColumn('ttd_oleh', function ($data) {
             return $data->ttd_oleh;
        })
         ->addColumn('pokok', function ($data) {
            return number_format($data->pokok,2,'.',',');
        })
         ->addColumn('hp', function ($data) {
            return number_format($data->hp,2,'.',',');
        })
         ->addColumn('bunga', function ($data) {
            return number_format($data->bunga,2,'.',',');
        })
         ->addColumn('pph23val', function ($data) {
            return number_format($data->pph23val*-1,2,'.',',');
        })
         ->addColumn('saldo', function ($data) {
            return number_format(($data->pokok+$data->hp+$data->bunga)-$data->pph23val,2,'.',',');
        })
         ->addColumn('pph21val', function ($data) {
            return number_format($data->pph21val*-1,2,'.',',');
        })
         ->addColumn('jumlah', function ($data) {
             return $data->jumlah.''.'  ORG';
        })
         ->addColumn('radio', function ($data) {
             $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" nosurat="'. str_replace(' ', '-', $data->no_surat).'" class="btn-radio" name="btn-radio"><span></span></label>'; 
             return $radio;
         })
         ->addColumn('action1', function ($data) {
            if($data->proses <> '1'){
                $action = '<p align="center"><a href="'. route('master_phk.proses',['no' =>str_replace(' ', '-', $data->no_surat), 'tahun' => $data->tahun, 'bulan' => $data->bulan]).'"><span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="" style="cursor:hand"><i class="fas fa-ban" ></i></span></a></p>';
            }else{
                $action = '<p align="center"><span style="font-size: 2em;" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top" title="" style="cursor:hand"><i class="fas fa-check-circle" ></i></span></p>';
            }               
            return $action;
        })
         ->addColumn('action2', function ($data) {
            if( $data->approve<>"1" or is_null($data->approve)){
                $action = '<p align="center"><a href="'. route('master_phk.serah',['no' => str_replace(' ', '-', $data->no_surat), 'tahun' => $data->tahun, 'bulan' => $data->bulan]).'"><span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="" style="cursor:hand"><i class="fas fa-ban" ></i></span></a></p>';
            }else{
                $action = '<p align="center"><span style="font-size: 2em;" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top" title="" style="cursor:hand"><i class="fas fa-check-circle" ></i></span></p>';
            }               
            return $action;
        })
         ->rawColumns(['radio','action1','action2'])
         ->make(true); 
     }
 
     public function create()
     {
         $data_perusahaan = DB::select("select * from tab_tbl_prshn");
         return view('master_phk.create',compact('data_perusahaan'));
     }
     public function store(Request $request)
     {
         $data = DB::select("select * from phk_header where no_surat='$request->no_serah'");
         if(!empty($data)){
             $data2 = 2;
             return response()->json($data2);
         }else{
         DB::table('phk_header')->insert([
            'no_surat' => $request->no_serah ,
            'bulan' => $request->bulan ,
            'tahun' => $request->tahun , 
            'ttd_jabatan' => $request->ttd_jabatan ,
            'ttd_oleh' => $request->ttd_oleh ,
            'keterangan' => $request->keterangan ,
            'tgl_serah' => $request->tgl_serah ,
            'no_urut' => $request->no_urut_awal ,
            'jenis' => $request->jenis  
             ]);
             $data = 1;
             return response()->json($data);
         }
    }
     public function edit($kode)
     {
        $no_serah = str_replace('-', ' ', $kode);
        $data_detail = DB::select("select kd_prs,bank,no_rek,a.*,nopeg, a.tab tab, a.hasil hasil, bunga bunga, pajak pajak,
                                a.pkppselesai as pkppselesai,  a.tab as nilaitab, a.hasil as nilaihasil, a.bunga as nilaibunga,
                                (select nama from tab_tbl_pekerja b where a.nopeg=b.nopek and a.kd_prs=b.perusahaan union all 
                                select nama from tab_tbl_pekerja_phk b where a.nopeg=b.nopek and a.kd_prs=b.perusahaan) as nama 
                                ,c.nama as nama_prs from serah_detail a,tab_tbl_prshn c where 
                                a.no_serah='$no_serah' and a.kd_prs=c.kode order by a.nopeg");
        $data_perusahaan = DB::select("select * from tab_tbl_prshn");
        $data_no = DB::select("select max(no) as nu from serah_detail where no_serah='$no_serah'");
            if(!empty($data_no)){
                foreach($data_no as $no)
                {
                    $nu = $no->nu+1;
                }
            }else{
                $nu=1;
            }
        $data_unit = DB::select("select * from tab_tbl_unit order by nama");
        $data = DB::select("select a.* from phk_header a where no_surat='$no_serah'");
        foreach($data as $headerrs)
        {
            $bulan=$headerrs->bulan;
            $tahun=$headerrs->tahun;
            $no_serah=$headerrs->no_surat;
            $ttd_jabatan=$headerrs->ttd_jabatan;
            $ttd_oleh=$headerrs->ttd_oleh;
            $keterangan=$headerrs->keterangan;
            $tgl = date_create($headerrs->tgl_serah);
            $tgl_serah = date_format($tgl, 'Y-m-d');
            $approve_oleh=$headerrs->approve_oleh;
            $approve_tgl=$headerrs->approve_tgl;
            $approve=$headerrs->approve;
            $proses=$headerrs->proses;
            $no_urut_awal=$headerrs->no_urut;
            $jenis=$headerrs->jenis;
            
         }
         return view('master_phk.edit',compact(
            'data_detail',
            'data_perusahaan',
            'data_unit',
            'bulan',
            'tahun',
            'no_serah',
            'ttd_jabatan',
            'ttd_oleh',
            'keterangan',
            'tgl_serah',
            'approve_oleh',
            'approve_tgl',
            'approve',
            'proses',
            'no_urut_awal',
            'jenis',
            'nu'
            ));
     }
     public function update(Request $request)
     {
         DB::table('tab_tbl_unit')->where('kode', $request->kode)
         ->update([
            'tembusan' => $request->tembusan ,
            'skdari' => $request->skdari ,
            'nama' => $request->nama ,
            'perusahaan' => $request->perusahaan ,
            'alamat' => $request->alamat ,
            'kota' => $request->kota ,
            'telp' => $request->telp ,
            'facs' => $request->facs ,
            'sanper' => $request->sanper ,
            'kepada' => $request->kepada ,
            'bantu' => $request->bantu 
             ]);
             return response()->json();
     }
     public function delete(Request $request)
     {
         DB::table('tab_tbl_unit')->where('kode', $request->kode)->delete();
             return response()->json();
     }
     public function nopekJson(Request $request)
     {
         $data= DB::select("select * from tab_tbl_pekerja a where a.perusahaan = '$request->perusahaan' and a.unit = '$request->unit' and a.status ='A' and nopek not in (select nopeg from serah_detail where kd_prs=a.perusahaan)");
         return response()->json($data);
     }

     public function deteilStore(Request $request)
     {
        $docno = $request->kode;
        $no = $request->nourut;
        $nopeg= $request->nopek;
        if($nopeg = "690828"){
        // response.write("<script>alert('yang bersangkutan memiliki utang non pkpp. harap hubungi sdr. ismail')</script>")
        }
        $kd_prs= $request->perusahaan;
        $bank= $request->bank;
        $no_rek= $request->norek;
        $atas_nama= $request->atasnama;
        $ahli_waris= $request->ahliwaris;
        $sk_dari= $request->sk_dari;
        $no_sk= $request->no_sk;
        $tgl_sk= $request->tgl_sk;
        $tgl = date_create($request->tmt_phk);
        $tmt_phk= date_format($tgl, 'mY');
        $alamat= $request->alamat;
        $tembusan= $request->tembusan;
        $pkppselesai= $request->pkppselesai;
        $unit= $request->unitkrm;
        $pajak= 0;
        $bunga= 0;


    //    $data_serahrs = DB::select(" select count(*) as jumdet from serah_detail where nopeg='$nopeg' and kd_prs='$kd_prs'");
    //     if($jumdet<>0){
    //         tab=0
    //         hsl=0
    //         elseif jumdet=0 then
    //         set objrs = cn.execute(" select * from serah_detail where no_serah='" &docno& "' and no='" & no & "'")
    //       if not objrs.eof then
    //       no=cdbl(no)+1
    //       end if 	
              
            
              $data_indaccount = DB::select("select max(tablename) as tableind from pg_tables where tablename like 'new_ind_account_%' and length(tablename)=20");
              foreach($data_indaccount as $data_ind)
              {
                      $strtab = DB::select("select (setor_lalu + setor_01 + setor_02 + setor_03 + setor_04 + setor_05 + setor_06 + setor_07 + setor_08 + setor_09 + setor_10 + setor_11 + setor_12 )  as pokok, 
                                        (hasil_lalu + hasil_01 + hasil_02 + hasil_03 + hasil_04 + hasil_05 + hasil_06 + hasil_07 + hasil_08 + hasil_09 + hasil_10 + hasil_11 + hasil_12 )  as hslbang  
                                        from $data_ind->tableind i, tab_tbl_pekerja a where i.nopeg='$nopeg' and i.kd_prs='$kd_prs' and a.nopek=i.nopeg and a.perusahaan=i.kd_prs and a.status ='A'");
              }
            
            if(!empty($strtab)){
                foreach($strtab as $rstab)
                {
                    $tab=$rstab->pokok;
                    $hsl=$rstab->hslbang;
                }
            }else{ 
                $data_indaccount2 = DB::select("select max(right(tablename,4)) as tableind from pg_tables where tablename like 'new_ind_account_%' and length(tablename)=20");
                foreach($data_indaccount2 as $data_ind2)
                {
                    $tahun = $data_ind2->tableind - 1;
                    $tableind="new_ind_account_$tahun";
                        $strtab2 = DB::select("select (setor_lalu + setor_01 + setor_02 + setor_03 + setor_04 + setor_05 + setor_06 + setor_07 + setor_08 + setor_09 + setor_10 + setor_11 + setor_12 )  as pokok, 
                                        (hasil_lalu + hasil_01 + hasil_02 + hasil_03 + hasil_04 + hasil_05 + hasil_06 + hasil_07 + hasil_08 + hasil_09 + hasil_10 + hasil_11 + hasil_12 )  as hslbang  
                                        from $tableind i, tab_tbl_pekerja a where i.nopeg='$nopeg' and i.kd_prs='$kd_prs' and a.nopek=i.nopeg and a.perusahaan=i.kd_prs and a.status ='A'");
                }
                if(!empty($strtab2)){
                    foreach($strtab2 as $rstab2)
                    {
                        $tab=$rstab2->pokok;
                        $hsl=$rstab2->hslbang;
                    }
                }else{ 
                    $tab=0;
                    $hsl=0;
                }
                
            }
            
            DB::table('serah_detail')->insert([
                'no_serah' => $docno ,
                'nopeg' => $nopeg ,
                'kd_prs' => $kd_prs ,
                'tab' => $tab ,
                'hasil' => $hsl ,
                'pajak' => $pajak ,
                'bank' => $bank ,
                'no_rek' => $no_rek ,
                'atas_nama' => $atas_nama ,
                'ahli_waris' => $ahli_waris ,
                'sk_dari' => $sk_dari ,
                'no_sk' => $no_sk ,
                'tgl_sk' => $tgl_sk ,
                'alamat' => $alamat ,
                'no' => $no ,
                'tembusan' => $tembusan ,
                'bunga' => $bunga ,
                'tmt_phk' => $tmt_phk ,
                'unit' => $unit   
                 ]);
                 
                $data_nourut = DB::select("select min(no) as no from serah_detail where no_serah='$docno'");
                foreach($data_nourut as $nourut)
                {
                 DB::table('phk_header')->where('no_serah', $docno)
                ->update([
                    'no_urut' => $nourut->no; 
                    ]);
                }
                    $data = 1;
                    return response()->json($data);
                 
                 
        // set upheader = cn.execute("update phk_header set no_urut =(select min(no) from serah_detail where upper(no_serah)=upper('"&docno&"')) where no_surat='"& docno &"' ")
        //          end if
        //     %><script type="text/javascript">
        //       window.alert("data detail phk sudah disimpan...")
        //       window.location("default.asp?body=tab_frmserah&mode=update&kode=<%=docno%>").reload()
        //     </script>
     }
}
