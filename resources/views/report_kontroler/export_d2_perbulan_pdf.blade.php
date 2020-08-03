<?php ini_set('memory_limit', '2048M'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        RINCIAN TRANSAKSI (D-2)
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

.text-left {
    text-align: left;
}

/* th, tr {
    white-space: nowrap;
} */

td {
    vertical-align: top;
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
                    RINCIAN TRANSAKSI (D-2)
                    </b>
                    <br>
                    BULAN BUKU: {{ $bulan." ".$tahun }}
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
                <thead style="border-top: 1px solid black; border-bottom: 1px solid black;">
                    <tr>
                        <th width="50px" class="text-left">JK</th>
                        <th width="30px" class="text-left">ST</th>
                        <th width="50px">VC</th>
                        <th width="30px">CI</th>
                        <th width="30px">LP</th>
                        <th width="70px">SANDI</th>
                        <th width="70px">BAGIAN</th>
                        <th width="50px">PK</th>
                        <th width="50px">JB</th>
                        <th>CJ</th>
                        <th width="120px">JUMLAH RUPIAH</th>
                        <th width="120px">JUMLAH DOLLAR</th>
                        <th width="50px">KURS</th>
                        <th class="text-left">KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($d2_list as $d2)
                    <tr>
                        <td>{{ $d2->jk }}</td>
                        <td>{{ $d2->lokasi }}</td>
                        <td class="text-center">{{ $d2->voucher }}</td>
                        <td class="text-center">{{ $d2->mu }}</td>
                        <td>{{ $d2->lapangan }}</td>
                        <td>{{ $d2->sandi }}</td>
                        <td>{{ $d2->bagian }}</td>
                        <td>{{ $d2->pk }}</td>
                        <td>{{ $d2->jb }}</td>
                        <td>{{ $d2->kk }}</td>
                        <td class="text-right">
                            @if ($d2->totpricerp < 0)
                            ({{ float_two(abs($d2->totpricerp)) }})
                            @else
                            {{ float_two($d2->totpricerp) }}
                            @endif
                        </td>
                        <td class="text-right">
                            @if ($d2->totpricedl < 0)
                            ({{ float_two(abs($d2->totpricedl)) }})
                            @else
                            {{ float_two($d2->totpricedl) }}
                            @endif
                        </td>
                        <td>
                            @if ($d2->mu != 1)
                                {{ $d2->kurs }}
                            @endif
                        </td>
                        <td>{{ $d2->keterangan }}</td>
                    </tr>
                    {{-- <tr>
                        <td colspan="6" class="text-right">Total CI :</td>
                        <td colspan="4">{{ $d2->mu }}</td>
                        <td class="text-right">jml_rupiah</td>
                        <td class="text-right">jml_rupiah_dollar</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Total JB :</td>
                        <td colspan="4">{{ $d2->jb }}</td>
                        <td class="text-right">jml_rupiah</td>
                        <td class="text-right">jml_rupiah_dollar</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Total SANDI :</td>
                        <td colspan="4">{{ $d2->sandi }}</td>
                        <td class="text-right">jml_rupiah</td>
                        <td class="text-right">jml_rupiah_dollar</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Total MAIN :</td>
                        <td colspan="4">{{ substr($d2->sandi, 0, 3) }}</td>
                        <td class="text-right">jml_rupiah</td>
                        <td class="text-right">jml_rupiah_dollar</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Total CLASS :</td>
                        <td colspan="4">{{ substr($d2->sandi, 0, 1) }}</td>
                        <td class="text-right">jml_rupiah</td>
                        <td class="text-right">jml_rupiah_dollar</td>
                    </tr> --}}
                    @endforeach
                    <tr>
                        <td colspan="6" class="text-right">Total Debet :</td>
                        <td colspan="4"></td>
                        <td class="text-right">jml_rupiah</td>
                        <td class="text-right">jml_rupiah_dollar</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Total Kredit :</td>
                        <td colspan="4"></td>
                        <td class="text-right">jml_rupiah</td>
                        <td class="text-right">jml_rupiah_dollar</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Saldo :</td>
                        <td colspan="4"></td>
                        <td class="text-right">jml_rupiah</td>
                        <td class="text-right">jml_rupiah_dollar</td>
                    </tr>
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