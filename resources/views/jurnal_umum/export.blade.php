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
                height: 1cm;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <table width="100%"  >
                <tr>
                    <td align="center" style="padding-left:200px;">
                        <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:30px;"><br>
                        <font style="font-size: 12pt;font-weight: bold "> PT. PERTAMINA PEDEVE INDONESIA</font><br>
                        <font style="font-size: 12pt;font-weight: bold ">LEMBARAN JURNAL</font><br>
                    </td>
                </tr>
            </table>           
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <table width="100%"  style="padding-top:-10%;">
                <tr>
                    <td>
                        <table   style="font-size: 10pt;border-collapse: collapse;">
                            <tr style="text-align:left;"  class="text-center">
                                <td width="60" >Halaman</td>
                                <td width="10">:</td>
                                <td></td>
                            </tr>                                                     
                            <tr style="text-align:left;"  class="text-center">
                                <td width="60" >Print</td>
                                <td width="10">:</td>
                                <td>{{date('d/m/Y')}}</td>
                            </tr>                                                     
                            <tr style="text-align:left;"  class="text-center">
                                <td width="60" >JK</td>
                                <td width="10">:</td>
                                <td>{{$jk}}</td>
                            </tr>                                                     
                            <tr style="text-align:left;"  class="text-center">
                                <td width="60" >CI</td>
                                <td width="10">:</td>
                                <td>{{$ci}}</td>
                            </tr>                                                     
                            <tr style="text-align:left;"  class="text-center">
                                <td width="60" >NO. BUKTI</td>
                                <td width="10">:</td>
                                <td>{{$voucher}}</td>
                            </tr>                                                     
                        </table>
                    </td>
                </tr>
            </table>
            <table width="100%"  style="padding-top:5px;">
                <tr>
                    <td>
                        <table   style="font-size: 10pt;border-collapse: collapse;">
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
                            
                            $bulan_ = strtoupper($array_bln[ltrim($bulan,0)]);
                        ?>
                            <tr style="text-align:left;"  class="text-center">
                                <td width="150" >BULAN/TAHUN PEMBUKUAN</td>
                                <td width="10">:</td>
                                <td width="250">{{strtoupper($bulan_)}} {{$tahun}}</td>
                                <td width="60">NO. JURNAL</td>
                                <td width="10">:</td>
                                <td>{{$docno}}</td>
                            </tr>                                                                                                       
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width="100%"  style="padding-top:-5px;">
                <tr>
                    <td>
                        <table width="100%" style="font-size: 8pt;border-collapse: collapse;" >
                            <tr style="text-align:center; font-weight: bold;"  class="text-center">
                                <td style="border:1px solid black;">LP</td>
                                <td style="border:1px solid black;">SANPER</td>
                                <td style="border:1px solid black;">BAGIAN</td>
                                <td style="border:1px solid black;">PK</td>
                                <td style="border:1px solid black;">JB</td>
                                <td style="border:1px solid black;">DEBET</td>
                                <td style="border:1px solid black;">KREDIT</td>
                                <td style="border:1px solid black;">KURS</td>
                                <td style="border:1px solid black;">KETERANGAN</td>
                            </tr>    
                            <?php $no=1; ?>
                            @foreach($data_list as $data)
                            <?php $no++; ?>
                            <tr style="font-size: 9pt;">
                                <td width="5%" style="padding-left:25%x;border-left:1px solid black;">{{$data->lokasi}}</td>
                                <td width="10%" style="text-align:center;border-left:1px solid black;">{{$data->account}}</td>
                                <td width="10%" style="text-align:center;border-left:1px solid black;">{{$data->bagian}}</td>
                                <td width="10%" style="text-align:center;border-left:1px solid black;">{{$data->pk}}</td>
                                <td width="8%" style="text-align:center;border-left:1px solid black;">{{$data->jb}}</td>
                                <td width="15%" style="text-align:right;border-left:1px solid black;">
                                @if(is_null($data->debet))
                                    0
                                @else
                                    {{number_format($data->debet,2)}}
                                @endif
                                </td>
                                <td width="15%" style="text-align:right;border-left:1px solid black;">
                                @if(is_null($data->kredit))
                                    0
                                @else
                                    {{number_format($data->kredit,2)}}
                                @endif
                                </td>
                                <td width="10%" style="text-align:center;border-left:1px solid black;">{{$data->rate}}</td>
                                <td width="50%" style="text-align:left;border-left:1px solid black;border-right:1px solid black;">{{$data->keterangan}}</td>
                            </tr>
                            <?php 
                                $debet[$no] = $data->debet; 
                                $kredit[$no] = $data->kredit; 
                            ?>
                            @endforeach                                              
                            <tr style="font-size: 9pt;">
                                <td height="5%" style="padding-left:25%x;border-left:1px solid black;border-bottom:1px solid black;"></td>
                                <td style="text-align:center;border-left:1px solid black;border-bottom:1px solid black;"></td>
                                <td style="text-align:center;border-left:1px solid black;border-bottom:1px solid black;"></td>
                                <td style="text-align:center;border-left:1px solid black;border-bottom:1px solid black;"></td>
                                <td style="text-align:center;border-left:1px solid black;border-bottom:1px solid black;"></td>
                                <td style="text-align:center;border-left:1px solid black;border-bottom:1px solid black;"></td>
                                <td style="text-align:center;border-left:1px solid black;border-bottom:1px solid black;"></td>
                                <td style="text-align:center;border-left:1px solid black;border-bottom:1px solid black;"></td>
                                <td style="text-align:center;border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;"></td>
                            </tr>                                              
                            <tr style="font-size: 9pt;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="2" style="text-align:center;border-left:1px solid black;border-bottom:1px solid black;">TOTAL</td>
                                <td style="text-align:right;border-left:1px solid black;border-bottom:1px solid black;">{{number_format(array_sum($debet),2)}}</td>
                                <td style="text-align:right;border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;">{{number_format(array_sum($kredit),2)}}</td>
                                <td></td>
                                <td></td>
                            </tr>                                              
                        </table>
                    </td>
                </tr>
            </table>
            <table width="100%"  style="padding-top:5%;">
                <tr>
                    <td>
                        <table width="100%" style="font-size: 10pt;border-collapse: collapse;" border="1">
                            <tr style="text-align:center;"  class="text-center">
                                <td width="40%">
                                    <table style="padding-top:-20;">
                                        <tr >
                                            <td><b>Perjalanan Mengenai Pembukuan:</b></td>
                                        </tr>
                                        <tr> <td>KOREKSI PEMBUKUAN </td></tr>
                                        <tr> <td></td></tr>
                                    </table>
                                </td>
                                <td  width="20%"></td>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td width="25%">Dibuat Oleh</td>
                                            <td>: {{$request->dibuat}}</td>
                                            <td style="text-align:right;">Tgl. {{date('d/m/Y')}}</td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Diperiksa Oleh </td>
                                            <td>: {{$request->diperiksa}}</td>
                                            <td style="text-align:right;">Tgl. {{date('d/m/Y')}}</td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Disetujui Oleh </td>
                                            <td>: {{$request->disetujui}}</td>
                                            <td style="text-align:right;">Tgl. {{date('d/m/Y')}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>                            
                        </table>
                    </td>
                </tr>
            </table>

        </main>
        <footer>
        </footer>
    </body>
</html>
