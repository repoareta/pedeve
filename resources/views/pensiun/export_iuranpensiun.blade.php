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
                <?php 
                    $tgl = date_create("$request->tahun-$request->bulan-01");
                    $bulan =  date_format($tgl, 'F');
                ?>
                <tr>
                    <td align="center" style="padding-left:200px;">
                    <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:30px;"><br>
                   <font style="font-size: 12pt;font-weight: bold "> PT. PERTAMINA PEDEVE INDONESIA</font><br>
                   <font style="font-size: 12pt;font-weight: bold ">DAFTAR SETORAN IURAN PENSIUN PEKERJA</font><br>
                   <font style="font-size: 12pt;font-weight: bold "> BULAN {{strtoupper($bulan)}} {{$request->tahun}} </font><br>
                    </td>
                </tr>
            </table>

            <table width="100%"  style="padding-top:5%; padding-left:30px;;padding-right:30px;">
                <tr>
                    <td>
                        <table width="100%" style="font-size: 10pt;border-collapse: collapse;" border="1">
                            <tr style="text-align:center; font-weight: bold"  class="text-center">
                                <td  rowspan="2">NO</td>
                                <td  rowspan="2">NO. PEK</td>
                                <td rowspan="2">NAMA</td>
                                <td rowspan="2">IURAN PEKERJA<br> <font style="font-size: 8pt">(1.95%)</font></td>
                                <td colspan="2">IURAN PERUSAHAAN</td>
                                <td rowspan="2">JUMLAH</td>
                            </tr>
                            <tr style="text-align:center; font-weight: bold">
                                <td >DANA PENSIUN<BR> <font style="font-size: 8pt">(4,784%)</font></td>
                                <td >BNI<br> <font style="font-size: 8pt">(3.8%)</font></td>
                            </tr>

                            <tr >
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">1232</td>
                                <td style="text-align:left;">Aku</td>
                                <td style="text-align:right;">UPAH TETAP</td>
                                <td style="text-align:right;">JAMINAN HARI TUA</td>
                                <td style="text-align:right;">JAMINAN HARI TUA</td>
                                <td style="text-align:right;">TOTAL</td>
                            </tr>
                            <tr >
                               <td style="text-align:right;" colspan="3">Total</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>


            <table width="100%"  style=" padding-left:30px;;padding-right:30px;">
                <tr>
                    <td>
                        <table width="100%" style="font-size: 10pt; padding-left:70%;">
                            <tr style="font-size: 10pt;">
                                <td align="left" width="200">JAKARTA, {{strtoupper($request->tanggal)}}</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200"><?php echo strtoupper('PT Pertamina Dana Ventura') ?></td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->jabatan)}}</td><br>
                            </tr>
                        </table>
                        <table width="100%" style="font-size: 10pt; padding-left:70%">
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->nama)}}</td><br>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>


            
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
        <footer>
        <font style="padding-left:20px;font-size: 10pt;font-style: italic">Cetak:</font>
        </footer>
    </body>
</html>
