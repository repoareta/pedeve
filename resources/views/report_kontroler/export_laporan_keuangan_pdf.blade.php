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
                    @foreach ($class_account as $row_account)
                    <tr>
                        <td class="tab-2" style="white-space: nowrap;">
                            <b>{{ $row_account->jenis }}</b>
                        </td>
                        <td class="text-center"><b>{{ $row_account->batas_awal }}</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    @foreach ($row_account->neraca as $row_neraca)
                        <tr>
                            <td class="tab-2" style="white-space: nowrap;">
                                {{ $row_neraca->andet->descacct }}
                            </td>
                            <td class="text-center">{{ $row_neraca->andet->sandi }}</td>
                            <td class="text-right">
                                @if ($row_neraca->lapangan == 'MD')
                                    @php
                                        $md_row = $row_account->pengali_tampil * $row_neraca->cum_rp;
                                    @endphp
                                    @if ($md_row < 0)
                                        ({{ nominal_abs($md_row) }}) 
                                    @else
                                        {{ nominal_abs($md_row) }}
                                    @endif
                                @else
                                    0,00
                                @endif
                            </td>
                            <td class="text-right">
                                @if ($row_neraca->lapangan == 'MS')
                                    @php
                                        $ms_row = $row_account->pengali_tampil * $row_neraca->cum_rp;
                                    @endphp
                                    @if ($ms_row < 0)
                                        ({{ nominal_abs($ms_row) }}) 
                                    @else
                                        {{ nominal_abs($ms_row) }}
                                    @endif
                                @else
                                    0,00
                                @endif
                            </td>
                            <td class="text-right">
                                @if ($row_account->pengali_tampil * $row_neraca->cum_rp < 0)
                                    ({{ nominal_abs($row_account->pengali_tampil * $row_neraca->cum_rp) }}) 
                                @else
                                    {{ nominal_abs($row_account->pengali_tampil * $row_neraca->cum_rp) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td></td>
                        <td class="text-center"><b>{{ $row_account->batas_awal }}</b></td>
                        <td class="text-right">
                            <b>
                                @php
                                    $md_cum = $row_account->neraca->filter(function($value, $key) {
                                        return $value->lapangan == 'MD';
                                    })->sum(function($row_md_cum) {
                                        return $row_md_cum->cum_rp * 2;
                                    });
                                @endphp
                                @if ($md_cum < 0)
                                ({{ nominal_abs($md_cum) }})
                                @else
                                {{ nominal_abs($md_cum) }}
                                @endif
                                
                            </b>
                        </td>
                        <td class="text-right">
                            <b>
                                @php
                                    $ms_cum = $row_account->neraca->filter(function($value, $key) {
                                        return $value->lapangan == 'MS';
                                    })->sum('cum_rp');
                                @endphp
                                @if ($ms_cum < 0)
                                ({{ nominal_abs($ms_cum) }})
                                @else
                                {{ nominal_abs($ms_cum) }}
                                @endif
                            </b>
                        </td>
                        <td class="text-right">
                            <b>
                                @if (($md_cum + $ms_cum) < 0)
                                ({{ nominal_abs($md_cum + $ms_cum) }})
                                @else
                                {{ nominal_abs($md_cum + $ms_cum) }}
                                @endif
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td class="tab-2"><b>JUMLAH NERACA</b></td>
                        <td></td>
                        <td class="text-right">
                            <b>
                                @php
                                    $md_cum = $row_account->neraca->filter(function($value, $key) {
                                        return $value->lapangan == 'MD';
                                    })->sum('cum_rp');
                                @endphp
                                @if ($md_cum < 0)
                                ({{ nominal_abs($md_cum) }})
                                @else
                                {{ nominal_abs($md_cum) }}
                                @endif
                                
                            </b>
                        </td>
                        <td class="text-right">
                            <b>
                                @php
                                    $ms_cum = $row_account->neraca->filter(function($value, $key) {
                                        return $value->lapangan == 'MS';
                                    })->sum('cum_rp');
                                @endphp
                                @if ($ms_cum < 0)
                                ({{ nominal_abs($ms_cum) }})
                                @else
                                {{ nominal_abs($ms_cum) }}
                                @endif
                            </b>
                        </td>
                        <td class="text-right">
                            <b>
                                @if (($md_cum + $ms_cum) < 0)
                                ({{ nominal_abs($md_cum + $ms_cum) }})
                                @else
                                {{ nominal_abs($md_cum + $ms_cum) }}
                                @endif
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td class="tab-1"><b>JUMLAH</b></td>
                        <td></td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">0.00</td>
                    </tr>
                    @endforeach
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