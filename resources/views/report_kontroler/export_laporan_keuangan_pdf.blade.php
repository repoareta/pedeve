<?php ini_set('memory_limit', '2048M'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        CATATAN ATAS LAPORAN KEUANGAN
    </title>
</head>
<style media="screen">

table {
    font: normal 10px Verdana, Arial, sans-serif;
    border-collapse: collapse;
    border: 1px solid black;
}

th, td {
    border: 1px solid black;
    padding: 5px;
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

.tab-1 {
    padding-left:5%;
}

.tab-2 {
    padding-left:10%;
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
                    CATATAN ATAS LAPORAN KEUANGAN
                    </b>
                    <br>
                    BULAN BUKU: {{ strtoupper(bulan($bulan))." ".$tahun }}
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
                        <th>KETERANGAN</th>
                        <th>SUB AKUN</th>
                        <th>MMD</th>
                        <th>MS</th>
                        <th>KONSOLIDASI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calk_list as $row)
                    <tr>
                        <td class="tab-2" style="white-space: nowrap;">{{ $row->descacct }}</td>
                        <td class="text-center">{{ $row->sandi }}</td>
                        <td class="text-right">
                            @if ($row->lapangan == 'MS')
                                @if ($row->pengali_tampil*$row->cum_rp < 0)
                                ({{ nominal_abs($row->pengali_tampil*$row->cum_rp) }})
                                @else
                                {{ nominal_abs($row->pengali_tampil*$row->cum_rp) }}
                                @endif
                            @else
                            0.00
                            @endif
                        </td>
                        <td class="text-right">
                            @if ($row->lapangan == 'MD')
                                @if ($row->pengali_tampil*$row->cum_rp < 0)
                                    ({{ nominal_abs($row->pengali_tampil*$row->cum_rp) }})
                                @else
                                    {{ nominal_abs($row->pengali_tampil*$row->cum_rp) }}
                                @endif
                            @else
                            0.00
                            @endif
                        </td>
                        <td class="text-right">
                            @if ($row->pengali_tampil*$row->cum_rp < 0)
                                ({{ nominal_abs($row->pengali_tampil*$row->cum_rp) }})
                            @else
                                {{ nominal_abs($row->pengali_tampil*$row->cum_rp) }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="tab-2"><b>JUMLAH</b></td>
                        <td></td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">0.00</td>
                    </tr>
                    <tr>
                        <td class="tab-1"><b>JUMLAH</b></td>
                        <td></td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">0.00</td>
                    </tr>
                    <tr>
                        <td><b>JUMLAH</b></td>
                        <td></td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">0.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br>
        <br>
        <br>
        <div class="text-right">
            <span style="padding-right:18px;">Jakarta, {{ date('d M Y') }}</span>
            <br>
            <br>
            <br>
            <br>
            <u>( Wasono Hastoatmodjo )</u>
            <br>
            <span style="padding-right:25px">Manajer Kontroler</span>
        </div>
    </main>  
</body>
</html>