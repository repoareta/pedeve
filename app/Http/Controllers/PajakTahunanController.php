<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VParampajak;
use DB;
use DomPDF;
use PDF;
use Excel;
use Alert;

class PajakTahunanController extends Controller
{
   public function RekapPostPajak()
   {
       return view('pajak_tahunan.rekap_proses_pajak');
   }
   public function ExportProses(Request $request)
   {    
       DB::statement("DROP VIEW IF EXISTS v_reportpajak CASCADE");
       DB::statement("CREATE OR REPLACE VIEW v_reportpajak AS
                            select CAST(bulan as integer),tahun,nopek,
                            sum(CASE WHEN aard = '01' or aard = '02'  THEN nilai ELSE '0' END) as data_1,
                            sum(CASE WHEN aard = '27'  THEN nilai ELSE '0' END) as data_2,
                            sum(CASE WHEN aard = '04' or aard = '03' or aard = '06' or aard = '05' or aard = '32' THEN nilai ELSE '0' END) as data_3,
                            sum(CASE WHEN aard = '42' or aard = '43' or aard = '41' or aard = '45'  THEN nilai ELSE '0' END) as data_4,
                            sum(CASE WHEN aard = '10' or aard = '12'  THEN nilai ELSE '0' END) as data_5,
                            sum(CASE WHEN aard = '24' or aard = '25' or aard = '39' or aard = '40'  THEN nilai ELSE '0' END) as data_6,
                            sum(CASE WHEN aard = '24P' or aard = '40P' or aard = '25P' or aard = '39P' or aard = '43P' or aard = '41P' or aard = '42P' THEN nilai ELSE '0' END) as data_7,
                            sum(CASE WHEN aard = '09' or aard = '14'  THEN nilai ELSE '0' END) as data_8
                            from v_parampajakreport where tahun='$request->tahun' group by bulan,tahun,nopek ORDER BY nopek,bulan asc
                            ");
       DB::statement("DROP VIEW IF EXISTS v_reportpajak_total CASCADE");
       DB::statement("CREATE OR REPLACE VIEW v_reportpajak_total AS
                            select tahun,nopek,
                            sum(CASE WHEN aard = '01' or aard = '02'  THEN nilai ELSE '0' END) as data_1,
                            sum(CASE WHEN aard = '27'  THEN nilai ELSE '0' END) as data_2,
                            sum(CASE WHEN aard = '04' or aard = '03' or aard = '06' or aard = '05' or aard = '32' THEN nilai ELSE '0' END) as data_3,
                            sum(CASE WHEN aard = '42' or aard = '43' or aard = '41' or aard = '45'  THEN nilai ELSE '0' END) as data_4,
                            sum(CASE WHEN aard = '10' or aard = '12'  THEN nilai ELSE '0' END) as data_5,
                            sum(CASE WHEN aard = '24' or aard = '25' or aard = '39' or aard = '40'  THEN nilai ELSE '0' END) as data_6,
                            sum(CASE WHEN aard = '24P' or aard = '40P' or aard = '25P' or aard = '39P' or aard = '43P' or aard = '41P' or aard = '42P' THEN nilai ELSE '0' END) as data_7,
                            sum(CASE WHEN aard = '09' or aard = '14'  THEN nilai ELSE '0' END) as data_8
                            from v_parampajakreport where tahun='$request->tahun' group by tahun,nopek ORDER BY nopek asc
                            ");
        $data_list = VParampajak::all();
       $pdf = PDF::loadview('pajak_tahunan.export_proses_pajak_pdf',compact('data_list'))
        ->setPaper('A4', 'landscape')
        ->setOption('footer-right', 'Halaman [page] dari [toPage]')
        ->setOption('footer-font-size', 7)
        ->setOption('margin-top',10)
        ->setOption('margin-bottom', 10);

        return $pdf->stream('Form Cetak 1721-A1_'.date('Y-m-d H:i:s').'.pdf');
   }
   
   public function RekapLaporanPajak()
   {
        return view('pajak_tahunan.rekap_laporan_pajak');
   }
   public function ExportLaporan(Request $request)
   {    
    DB::statement("DROP VIEW IF EXISTS v_reportpajak CASCADE");
    DB::statement("CREATE OR REPLACE VIEW v_reportpajak AS
                         select nopek,tahun,
                         sum(CASE WHEN aard = '01' or aard = '02'  THEN nilai ELSE '0' END) as data_1,
                         sum(CASE WHEN aard = '24' or aard = '25' or aard = '39' or aard = '40'  THEN nilai ELSE '0' END) as data_2,
                         sum(CASE WHEN aard = '27'  THEN nilai ELSE '0' END) as data_3,
                         sum(CASE WHEN aard = '42' or aard = '43' or aard = '41' or aard = '45'  THEN nilai ELSE '0' END) as data_4,
                         sum(CASE WHEN aard = '09' or aard = '14'  THEN nilai ELSE '0' END) as data_5,
                         sum(CASE WHEN aard = '04' or aard = '03' or aard = '06' or aard = '05' or aard = '32' THEN nilai ELSE '0' END) as data_6,
                         sum(CASE WHEN aard = '24P' or aard = '40P' or aard = '25P' or aard = '39P' or aard = '43P' or aard = '41P' or aard = '42P' THEN nilai ELSE '0' END) as data_7,
                         sum(CASE WHEN aard = '10' or aard = '12'  THEN nilai ELSE '0' END) as data_8,
                         sum(CASE WHEN aard = '01' or aard = '02' or aard = '04' or aard = '03' or aard = '06' or aard = '05' or aard = '32' or aard = '42' or aard = '43' or aard = '41' or aard = '45' or aard = '10' or aard = '12' THEN nilai ELSE '0' END) as data_9
                         from v_parampajakreport where tahun='$request->tahun' group by nopek,tahun ORDER BY nopek asc
                         ");
        $data_list = VParampajak::all();
       $pdf = PDF::loadview('pajak_tahunan.export_laporan_pajak_pdf',compact('data_list'))
        ->setPaper('legal', 'portrait')
        ->setOption('footer-font-size', 7)
        ->setOption('margin-left',1)
        ->setOption('margin-right',1)
        ->setOption('margin-top',1)
        ->setOption('margin-bottom', 1);

    return $pdf->stream('Form Cetak 1721-A1 Tahunan_'.date('Y-m-d H:i:s').'.pdf');
   }
}
