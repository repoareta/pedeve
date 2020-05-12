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
                                <td><font style="font-size: 10pt;font-weight: bold ">RINCIAN KAS/BANK PER CASH JUDEX </font></td>
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
            <table width="100%"  style="border-collapse: collapse;padding-bottom:3%;font-family: sans-serif" border="1">
                <thead>
                    <tr style="text-align:center;font-size: 8pt;">
                        <th>JK</th>
                        <th>BLTH</th>
                        <th>ST</th>
                        <th>BAGIAN</th>
                        <th>SANPER</th>
                        <th>LP</th>
                        <th>WONO</th>
                        <th>CJ</th>
                        <th>NILAI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a=0; ?>
                    @foreach($data_list as $data)
                    <?php $a++ ?>
                    <tr style="text-align:center;font-size: 8pt;">
                        <td>{{$data->jk}}</td>
                        <td>{{$data->bulan.''.$data->tahun}}</td>
                        <td>{{$data->store}}</td>
                        <td>{{$data->bagian}}</td>
                        <td>{{$data->account}}</td>
                        <td>{{$data->lokasi}}</td>
                        <td>{{$data->pk}}</td>
                        <td>{{$data->cj}}</td>
                        <td style="text-align:right;">{{$data->totprice <= 0 ? '('.number_format($data->totprice*-1,0).')' : number_format($data->totprice,0)}}</td>
                    </tr>
                    <?php 
                        $lokasi[$a] = $data->lokasi;
                        $store[$a] = $data->store;
                        $cj[$a] = $data->cj;
                        $jk[$a] = $data->jk;
                        $bagian[$a] = $data->bagian;
                        $account[$a] = $data->account;
                        $pk[$a] = $data->pk;
                        $cr[$a] = $data->totprice;
                      ?>
                    @endforeach
                    <tr>
                    <?php
                        $cr_jk = array_sum($cr)+array_sum($jk)+array_sum($bagian)+array_sum($account)+array_sum($pk); 
                        $cr_lokasi = array_sum($cr)+array_sum($lokasi); 
                        $cr_store = array_sum($cr)+array_sum($store); 
                        $cr_cj = array_sum($cr)+array_sum($cj); 
                        $cr_total = array_sum($cr); 
                     ?>
                        <td colspan="8"></td>
                        <td style="font-size: 10pt;text-align:right;">{{$cr_jk < 0 ? '('.number_format($cr_jk*-1,0).')'  : number_format($cr_jk,0)}}-{{$cr_jk < 0 ? 'CR'  : ''}}</td>
                    </tr>
                    <tr>
                        <td colspan="8"></td>
                        <td style="font-size: 10pt;text-align:right;">{{$cr_lokasi < 0 ? '('.number_format($cr_lokasi*-1,0).')'  : number_format($cr_lokasi,0)}}-{{$cr_lokasi < 0 ? 'CR'  : ''}}<span style="color:red;">**</span></td>
                    </tr>
                    <tr>
                        <td colspan="8"></td>
                        <td style="font-size: 10pt;text-align:right;">{{$cr_store < 0 ? '('.number_format($cr_store*-1,0).')'  : number_format($cr_store,0)}}-{{$cr_store < 0 ? 'CR'  : ''}}<span style="color:red;">**</span></td>
                    </tr>
                    <tr>
                        <td colspan="8" style="font-size: 10pt;text-align:right;">Total Per Cash Judex</td>
                        <td style="font-size: 10pt;text-align:right;">{{$cr_cj < 0 ? '('.number_format($cr_cj*-1,0).')'  : number_format($cr_cj,0)}}-{{$cr_cj < 0 ? 'CR'  : ''}}<span style="color:red;">***</span></td>
                    </tr>
                    <tr>
                        <td colspan="8" style="font-size: 10pt;text-align:right;">Total</td>
                        <td style="font-size: 10pt;text-align:right;">{{$cr_total < 0 ? '('.number_format($cr_total*-1,0).')'  : number_format($cr_total,0)}}-{{$cr_total < 0 ? 'CR'  : ''}}<span style="color:red;">**** </span> <span style="color:red;"> **</span></td>
                    </tr>
                <tbody>
            </table>
        </main>        
    </body>
</html>
