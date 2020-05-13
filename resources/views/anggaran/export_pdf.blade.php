<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Rekap Panjar Dinas
    </title>
</head>
<style media="screen">

.table {
    font: normal 12px Verdana, Arial, sans-serif;
    border-collapse: collapse;
    border: 1px solid black;
}

th, td {
    border: 1px solid black;
    padding: 5px;
}

.table-no-border-all td {
    font: normal 12px Verdana, Arial, sans-serif;
    border: 0px;
    padding: 0px;
}

.table-no-border td, .table-no-border tr {
    font: normal 12px Verdana, Arial, sans-serif;
    border:0px;
    padding: 0px;
}

h4 {
    font-size: 15px;
}

.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}

.content {
    width: 100%;
    padding: 0px;
    overflow: hidden;
}

.content img {
    margin-right: 15px;
    float: left;
}

.content h4 {
    margin-left: 15px;
    display: block;
    margin: 2px 0 15px 0;
}

.content p {
    margin-left: 15px;
    display: block;
    margin: 0px 0 10px 0;
    font-size: 12px;
    padding-bottom: 10px;
}

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

th {
    white-space: nowrap;
}

footer .pagenum:before {
    content: counter(page);
}

#container {
    position: relative;
    font: normal 12px Verdana, Arial, sans-serif;
}
#bottom-right {
    position: absolute;
    bottom: 0;
}

.pagecount:before {
content: counter(pages);
}

header { 
    position: fixed; 
    left: 0px; 
    top: -110px;
    right: 0px;
    height: 0px;
}

@page { 
    margin: 130px 50px 50px 50px;
}

</style>
<body>
    <header id="header">
        <div class="row">
            <div class="">
                <p>
                    <b>
                    LAPORAN ANGGARAN
                    <br>
                    PT. PERTAMINA PEDEVE INDONESIA
                    <br>
                    Tahun: 2016
                    </b>
                    <br>
                    Tanggal Cetak: 1 Mei 2016
                </p>
            </div>
    
            <div>
                <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="120px" height="60px" style="padding-top:10px">
            </div>
        </div>
    </header>
      
    <main>
        <div class="row">
            <table style="width:100%;" class="table">
                <tbody>
                    @foreach ($anggaran_list as $anggaran)
                        <tr>
                            <td>{{ $anggaran->kode_main }}</td>
                            <td>{{ $anggaran->nama_main }}</td>
                            <td>{{ currency_idr($anggaran->nilai_real) }}</td>
                        </tr>
                        @foreach ($anggaran->anggaran_submain as $anggaran_submain)
                            <tr>
                                <td>{{ $anggaran_submain->kode_submain }}</td>
                                <td>{{ $anggaran_submain->nama_submain }}</td>
                                <td>{{ $anggaran_submain->nama_submain }}</td>
                            </tr>
                            @foreach ($anggaran_submain->anggaran_detail as $anggaran_detail)
                                <tr>
                                    <td>{{ $anggaran_detail->kode }}</td>
                                    <td>{{ $anggaran_detail->nama }}</td>
                                    <td>{{ $anggaran_detail->nilai }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </main>
    
    <script type='text/php'>
    if ( isset($pdf) ) { 
        $font = null;
        $size = 9;
        $y = $pdf->get_height() - 30;
        $x = $pdf->get_width() - 103;
        $pdf->page_text($x, $y, 'Halaman {PAGE_NUM} dari {PAGE_COUNT}', $font, $size);
    }
    </script>
  
</body>
</html>