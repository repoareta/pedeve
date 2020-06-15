<!DOCTYPE html>
<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 4cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 1cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }



            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
        <table width="100%" >
            <?php 
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
                    
                    $bulan= strtoupper($array_bln[ltrim($request->bulan,0)]);
                ?>
                <tr>
                    <td align="left" style="padding-left:100px;font-family: sans-serif">
                        <table>
                            <tr>
                                <td><font style="font-size: 10pt;font-weight: bold ">PT. PERTAMINA DANA VENTURA</font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 10pt;font-weight: bold ">DAFTAR DEPOSITO </font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 10pt;font-weight: bold ">BULAN {{strtoupper($bulan)}} {{$request->tahun}}</font></td>
                            </tr>
                        </table>
                    </td>
                   
                    <td align="center" style="">
                        <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:45px;">
                    </td>
                </tr>
            </table>
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <font style="font-size: 10pt;font-style: italic">Tanggal Cetak: {{$request->tanggal}}</font>
            <table width="100%" style="font-family: sans-serif;border-collapse: collapse;" border="1">
                <thead>
                    <tr style="text-align:center;font-size: 8pt;font-weight: bold">
                        <td>NO</td>
                        <td>NAMA BANK</td>
                        <td>ASAL<br> DANA</td>
                        <td>NOMINAL<br>EKIVALEN</td>
                        <td>TANGGAL<br>DEPOSITO</td>
                        <td>TGL<br>JTH TEMPO</td>
                        <td>HARI<br>BUNGA</td>
                        <td>BUNGA<br>% TAHUN</td>
                        <td>BUNGA<br>PER BULAN</td>
                        <td>PPH 20%<br>PER BULAN</td>
                        <td>BUNGA NET<br>PER BULAN</td>
                        <td>ACCRD<br>HARI</td>
                        <td>ACCRUED<br>NOMINAL</td>
                    </tr>
                <thead>
                <tbody>
                <?php $no=1; ?>
                   @foreach($data_list as $data)
                   <tr style="text-align:center;font-size: 8pt;">
                        <?php 
                            $tglde = date_create($data->tgldep);
                            $tgldep = date_format($tglde, 'd/m/Y');
                            $tgl = date_create($data->tgltempo);
                            $tgltempo =  date_format($tgl, 'd/m/Y');
                        ?>
                        <td>{{$no++}}</td>
                        <td style="text-align:left;">{{$data->namabank}}</td>
                        <td>{{$data->asal}}</td>
                        <td style="text-align:right;">{{number_format($data->nominal,2,',','.')}}</td>
                        <td>{{$tgldep}}</td>
                        <td>{{$tgltempo}}</td>
                        <td>{{$data->haribunga}}</td>
                        <td>{{number_format($data->bungatahun,2,',','.')}}</td>
                        <td style="text-align:right;">{{number_format($data->bungabulan,2,',','.')}}</td>
                        <td style="text-align:right;">{{number_format($data->pph20,2,',','.')}}</td>
                        <td style="text-align:right;">{{number_format($data->netbulan,2,',','.')}}</td>
                        <td>{{$data->accharibunga}}</td>
                        <td style="text-align:right;">{{number_format($data->accnetbulan,2,',','.')}}</td>
                   </tr>
                    <?php 
                        $sat1[$no] = $data->nominal;
                        $sat2[$no] = $data->bungabulan;
                        $sat3[$no] = $data->pph20;
                        $sat4[$no] = $data->netbulan;
                        $sat5[$no] = $data->accnetbulan;
                    ?>
                   @endforeach
                   <tr style="text-align:center;font-size: 8pt;font-weight: bold">
                        <td style="text-align:right;" colspan="3">TOTAL MDMS</td>
                        <td style="text-align:right;">{{number_format(array_sum($sat1),2,',','.')}}</td>
                        <td colspan="4"></td>
                        <td style="text-align:right;">{{number_format(array_sum($sat2),2,',','.')}}</td>
                        <td style="text-align:right;">{{number_format(array_sum($sat3),2,',','.')}}</td>
                        <td style="text-align:right;">{{number_format(array_sum($sat4),2,',','.')}}</td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:right;">{{number_format(array_sum($sat5),2,',','.')}}</td>
                   </tr>
                   <tr style="text-align:center;font-size: 8pt;font-weight: bold">
                        <td style="text-align:right;" colspan="3">GRAND TOTAL MD + MS</td>
                        <td style="text-align:right;">{{number_format(array_sum($sat1),2,',','.')}}</td>
                        <td colspan="4"></td>
                        <td style="text-align:right;">{{number_format(array_sum($sat2),2,',','.')}}</td>
                        <td style="text-align:right;">{{number_format(array_sum($sat3),2,',','.')}}</td>
                        <td style="text-align:right;">{{number_format(array_sum($sat4),2,',','.')}}</td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:right;">{{number_format(array_sum($sat5),2,',','.')}}</td>
                   </tr>
                <tbody>
            </table>
        </main>
        
    </body>
</html>
