<!DOCTYPE html>
<html lang="en">
<head>
    <title>
       Pencapaian Kinerja
    </title>
</head>
<style media="screen">

table {
    font: normal 14px Verdana, Arial, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

.text-left {
    text-align: left;
}

td {
    vertical-align: top;
    padding: 5px;
}

th {
    padding: 7px;
}

thead { 
    display: table-header-group;
    border-top: 1px solid black; 
    border-bottom: 1px solid black;
}

tr { 
    page-break-inside: avoid 
}

.th-small {
    width: 40px;
}

.th-medium {
    width: 70px;
}

.th-large {
    width: 120px;
}

</style>
<body style="margin:0px;">
    <main>
        <div class="row">
            <table class="table tree" style="font: normal 10px Verdana, Arial, sans-serif;">
                <thead>
                    <tr class="text-left th-large">
                        <th></th>
                        <th>REALISASI</th>
                        <th>EVALUASI</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    @foreach ($data as $row)					
                    <tr class="text-left">
                        <th >Perusahaan</th>
                        <th>{{$row->nama}}</th>
                        <th>{{$row->nama}}</th>
                    </tr>
                    <tr>
                        <td>Aset</td>
                        <td>{{number_format($row->aset,2)}}</td>
                        <td>{{number_format($row->aset_r,2)}}</td>
                    </tr>
                    <tr>
                        <td>Revenue</td>
                        <td>{{number_format($row->revenue,2)}}</td>
                        <td>{{number_format($row->revenue_r,2)}}</td>
                    </tr>
                    <tr>
                        <td>Beban Pokok</td>
                        <td>{{number_format($row->beban_pokok,2)}}</td>
                        <td>{{number_format($row->beban_pokok_r,2)}}</td>
                    </tr>
                    <tr>
                        <td>Laba Kotor</td>
                        <td>{{number_format($row->beban_pokok+$row->revenue,2)}}</td>
                        <td>{{number_format($row->beban_pokok_r+$row->revenue_r,2)}}</td>
                    </tr>
                    <tr>
                        <td>Biaya Operasi</td>
                        <td>{{number_format($row->biaya_operasi,2)}}</td>
                        <td>{{number_format($row->biaya_operasi_r,2)}}</td>
                    </tr>
                    <tr>
                        <td>Laba Operasi</td>
                        <td>{{number_format($row->biaya_operasi+($row->beban_pokok+$row->revenue),2)}}</td>
                        <td>{{number_format($row->biaya_operasi_r+($row->beban_pokok_r+$row->revenue_r),2)}}</td>
                    </tr>
                    <tr>
                        <td>Laba Bersih</td>
                        <td>{{number_format($row->laba_bersih,2)}}</td>
                        <td>{{number_format($row->laba_bersih_r,2)}}</td>
                    </tr>
                    <tr>
                        <td>TKP</td>
                        <td>{{number_format($row->tkp,2)}}</td>
                        <td>{{number_format($row->tkp_r,2)}}</td>
                    </tr>
                    <tr>
                        <td>KPI</th>
                        <td>{{number_format($row->kpi,2)}}</td>
                        <td>{{number_format($row->kpi_r,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    
    {{-- <script type='text/php'>
    if ( isset($pdf) ) { 
        $font = null;
        $size = 2;
        $y = $pdf->get_height() - 30;
        $x = $pdf->get_width() - 103;
        $pdf->page_text($x, $y, 'Halaman {PAGE_NUM} dari {PAGE_COUNT}', $font, $size);
    }
    </script> --}}
  
</body>
</html>