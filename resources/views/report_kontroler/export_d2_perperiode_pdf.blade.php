<?php ini_set('memory_limit', '2048M'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        RINCIAN TRANSAKSI (D-2) PER PERIODE
    </title>
</head>
<style media="screen">

table {
    font: normal 10px Verdana, Arial, sans-serif;
    border-collapse: collapse;
}

.table-no-border-all td {
    border: 0px;
    padding: 0px;
}

.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

th, tr {
    white-space: nowrap;
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
            <div class="text-center">
                <p>
                    <b>
                    PT. PERTAMINA PEDEVE INDONESIA
                    <br>
                    RINCIAN TRANSAKSI (D-2) PER PERIODE
                    </b>
                    <br>
                    BULAN JANUARI s/d MEI 2020
                </p>
            </div>
    
            <div>
                <img align="right" src="{{ public_path() . '/images/pertamina.jpg' }}" width="120px" height="60px" style="padding-top:10px">
            </div>
        </div>
    </header>
      
    <main>
        <div class="row">
            <table style="width:100%;" class="table">
                <thead>
                    <tr>
                        <th>JK</th>
                        <th>ST</th>
                        <th>VC</th>
                        <th>CI</th>
                        <th>LP</th>
                        <th>SANDI</th>
                        <th>BAGIAN</th>
                        <th>PK</th>
                        <th>JB</th>
                        <th>CJ</th>
                        <th>JUMLAH RUPIAH</th>
                        <th>JUMLAH DOLLAR</th>
                        <th>KURS</th>
                        <th>KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($d2_list as $d2)
                    <tr>
                        <td>{{ $d2->jk }}</td>
                        <td>{{ $d2->lokasi }}</td>
                        <td>{{ $d2->voucher }}</td>
                        <td>{{ $d2->mu }}</td>
                        <td>{{ $d2->lapangan }}</td>
                        <td>{{ $d2->sandi }}</td>
                        <td>{{ $d2->bagian }}</td>
                        <td>{{ $d2->pk }}</td>
                        <td>{{ $d2->jb }}</td>
                        <td>{{ $d2->kk }}</td>
                        <td>{{ $d2->totpricerp }}</td>
                        <td>{{ $d2->totpricedl }}</td>
                        <td>{{ $d2->kurs }}</td>
                        <td>{{ $d2->keterangan }}</td>
                    </tr>
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