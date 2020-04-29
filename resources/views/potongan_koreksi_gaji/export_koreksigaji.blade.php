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
                    
                    $bulan= strtoupper($array_bln[$request->bulan]);
                ?>
                <tr>
                    <td align="left" style="padding-left:50px;font-family: sans-serif">
                        <table>
                            <tr>
                                <td><font style="font-size: 10pt;font-weight: bold ">PT. PERTAMINA DANA VENTURA (PDV) </font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 10pt;font-weight: bold ">RINCIAN KOREKSI GAJI PEGAWAI</font></td>
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
        <table rules="rows"  width="100%" style="border-collapse: collapse;padding-top:2%;">
                <tr>
                    <td>
                        <table rules="cols" width="100%" style="border-collapse: collapse; "  >
                            <tr  bgcolor="#A9A9A9" rules="rows" style="font-size: 10pt;text-align:center;font-weight: bold ">
                                <td width="5%">32</td>
                                <td width="30%">KOREKSI GAJI</td>
                                <td width="20%">NOPEK</td>
                                <td width="30%">NAMA</td>
                                <td>NILAI</td>
                            </tr>
                            <?php $a=0; ?>
                            @foreach($data_list as $data)
                            <?php  if($data->aard == '32'){ 
                             $a++; ?>
                            <tr style="font-size: 10pt">
                                <td colspan="2"></td>
                                <td style="text-align:center;">{{$data->nopek}}</td>
                                <td style="text-align:left;">{{$data->nama}}</td>
                                <td style="text-align:right;">{{number_format($data->nilai,2,',','.')}}</td>
                            </tr>
                            <?php
                                   $subtotala[$a] = $data->nilai;
                            } ?>
                            @endforeach
                            <?php if($data->aard == 32){ ?>
                            <tr style="font-size: 10pt">
                                <td colspan="2"></td>
                                <td style="text-align:left;"></td>
                                <td style="text-align:right;font-weight: bold">SUB TOTAL</td>
                                <td style="text-align:right;font-weight: bold">{{number_format(array_sum($subtotala),2,',','.')}}</td>
                            </tr>
                            <?php } ?>                            
                        </table>
                    </td>
                </tr>
            </table>  
            <table rules="rows"  width="100%" style="border-collapse: collapse;padding-top:2%;">
                <tr>
                    <td>
                        <table rules="cols" width="100%" style="border-collapse: collapse; "  >
                            <tr  bgcolor="#A9A9A9" rules="rows" style="font-size: 10pt;text-align:center;font-weight: bold ">
                                <td width="5%">34</td>
                                <td width="30%">KOREKSI GAJI</td>
                                <td width="20%">NOPEK</td>
                                <td width="30%">NAMA</td>
                                <td>NILAI</td>
                            </tr>
                            @foreach($data_list as $dataa)
                            <?php $a=0; ?>
                            <?php if($dataa->aard == '34'){ 
                                $a++; ?>
                            <tr style="font-size: 10pt">
                                <td colspan="2"></td>
                                <td style="text-align:center;">{{$dataa->nopek}}</td>
                                <td style="text-align:left;">{{$dataa->nama}}</td>
                                <td style="text-align:right;">{{number_format($dataa->nilai,2,',','.')}}</td>
                            </tr>
                            <?php
                                   $subtotalb[$a] = $dataa->nilai;
                            } ?>
                            @endforeach
                            <?php if($data->aard == 34){ ?>
                            <tr style="font-size: 10pt">
                                <td colspan="2"></td>
                                <td style="text-align:left;"></td>
                                <td style="text-align:right;font-weight: bold">SUB TOTAL</td>
                                <td style="text-align:right;font-weight: bold">{{number_format(array_sum($subtotalb),2,',','.')}}</td>
                            </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
            </table>  
            <table rules="rows"  width="100%" style="border-collapse: collapse;padding-top:2%;">
                <tr>
                    <td>
                        <table rules="cols" width="100%" style="border-collapse: collapse; "  >
                            <?php if($data->aard == 32 and $data->aard == 34){ ?>
                            <tr style="font-size: 10pt">
                                <td style="text-align:right;font-weight: bold">TOTAL</td>
                                <td style="text-align:right;font-weight: bold">{{number_format(array_sum($subtotala)+array_sum($subtotalb),2,',','.')}}</td>
                            </tr>
                            <?php }elseif($data->aard == 32){ ?>
                            <tr style="font-size: 10pt">
                                <td width="85%" style="text-align:right;font-weight: bold">TOTAL</td>
                                <td style="text-align:right;font-weight: bold">{{number_format(array_sum($subtotala),2,',','.')}}</td>
                            </tr>
                            <?php }else{ ?> 

                            <?php } ?>
                            
                        </table>
                    </td>
                </tr>
            </table>  
        </main>
        
    </body>
</html>
