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
        @if($request->prosesupah == 'C')
        <!-- pegawai tetap -->
            <table width="100%" >
                <?php 
                    $tgl = date_create("$request->tahun-$request->bulan-01");
                    $bulan =  date_format($tgl, 'F');
                ?>
                <tr>
                    <td align="left" style="padding-left:100px;font-family: sans-serif">
                        <table>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">DAFTAR PEMBAYARAN GAJI PEGAWAI TETAP </font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">PT.PERTAMINA PEDEVE INDONESIA</font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 11pt;font-weight: bold ">BULAN {{strtoupper($bulan)}} {{strtoupper($request->tahun)}}</font></td>
                            </tr>
                        </table>
                    </td>
                   
                    <td align="center" style="">
                        <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:40px;">
                    </td>
                </tr>
            </table>

            <table width="100%"  style="padding-top:6%; padding-left:30px;;padding-right:30px;font-family: sans-serif">
                <tr>
                    <td>
                        <font style="font-size: 10pt;font-style: italic">Tanggal Cetak: {{$request->tanggal}}</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" style="border-collapse: collapse;" border="1">
                            <tr style="text-align:center;font-size: 8pt;">
                                <td rowspan="2">NO</td>
                                <td rowspan="2">NO <br>PEGAWAI</td>
                                <td rowspan="2">NAMA</td>
                                <td colspan="9">PERINCIAN GAJI PEGAWAI TETAP</td>
                                <td rowspan="2">GAJI<br> BRUTO</td>
                                <td colspan="4">POTONGAN</td>
                                <td rowspan="2">GAJI<br> NETTO</td>
                            </tr>
                            <tr style="text-align:center;font-size: 8pt;">
                                <td >UPAH TETAP</td>
                                <td >TUNJANGAN<br> BIAYA HIDUP</td>
                                <td >TUNJ. JABATAN</td>
                                <td >FASILITAS <br>CUTI</td>
                                <td >LEMBUR</td>
                                <td >SISA<br> BULAN<br> LALU</td>
                                <td >KOREKSI<br> GAJI</td>
                                <td >KODE<br> PAJAK</td>
                                <td >TUNJANGAN<br> PAJAK</td>
                                <td>IURAN<br> JAMSOSTEK</td>
                                <td>POT.<br> PAJAK</td>
                                <td>POT.<br> PINJAMAN</td>
                                <td>PEMBULATAN</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 8pt;" colspan="18">CS & BUSINESS SUPPORT</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 8pt;" colspan="18">FINANCE</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 8pt;" colspan="18">INTERNAL AUDIT & RISK MGT</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                               <td style="text-align:right;" colspan="3">TOTAL</td>
                               <td style="text-align:right;" > 10</td>
                               <td style="text-align:right;" > 10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
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
                        <table width="100%" style="font-size: 10pt; padding-left:75%;">
                            <tr style="font-size: 10pt;">
                                <td align="left" width="200">Jakarta, {{strtoupper($request->tanggal)}}</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">PT.PERTAMINA PEDEVE INDONESIA</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->jabatan)}}</td><br>
                            </tr>
                        </table>
                        <table width="100%" style="font-size: 10pt; padding-left:75%">
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->nama)}}</td><br>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            @elseif($request->prosesupah == 'K')
            <!--  pegawai kontrak-->

            <table width="100%" >
                <?php 
                    $tgl = date_create("$request->tahun-$request->bulan-01");
                    $bulan =  date_format($tgl, 'F');
                ?>
                <tr>
                    <td align="left" style="padding-left:100px;font-family: sans-serif">
                        <table>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">DAFTAR PEMBAYARAN GAJI PEGAWAI KONTRAK </font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">PT.PERTAMINA PEDEVE INDONESIA</font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 11pt;font-weight: bold ">BULAN {{strtoupper($bulan)}} {{$request->tahun}}</font></td>
                            </tr>
                        </table>
                    </td>
                   
                    <td align="center" style="">
                        <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:40px;">
                    </td>
                </tr>
            </table>

            <table width="100%"  style="padding-top:6%; padding-left:30px;;padding-right:30px;font-family: sans-serif">
                <tr>
                    <td>
                        <font style="font-size: 10pt;font-style: italic">Tanggal Cetak: {{$request->tanggal}}</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" style="border-collapse: collapse;" border="1">
                            <tr style="text-align:center;font-size: 8pt;">
                                <td rowspan="2">NO</td>
                                <td rowspan="2">NO <br>PEGAWAI</td>
                                <td rowspan="2">NAMA</td>
                                <td colspan="9">PERINCIAN GAJI PEGAWAI TETAP</td>
                                <td rowspan="2">GAJI<br> BRUTO</td>
                                <td colspan="3">POTONGAN</td>
                                <td rowspan="2">GAJI<br> NETTO</td>
                            </tr>
                            <tr style="text-align:center;font-size: 8pt;">
                                <td >ALL IN</td>
                                <td >TUNJ. JABATAN</td>
                                <td >TUNJ<br> DAERAH</td>
                                <td >FASILITAS <br>CUTI</td>
                                <td >LEMBUR</td>
                                <td >SISA<br> BULAN<br> LALU</td>
                                <td >KODE<br> PAJAK</td>
                                <td >KOREKSI<br> GAJI</td>
                                <td >TUNJANGAN<br> PAJAK</td>
                                <td>POT.<br> PAJAK</td>
                                <td>IURAN<br> JAMSOSTEK</td>
                                <td>PEMBULATAN</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 8pt;" colspan="17">CS & BUSINESS SUPPORT</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 8pt;" colspan="17">FINANCE</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 8pt;" colspan="17">INTERNAL AUDIT & RISK MGT</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 8pt;">
                               <td style="text-align:right;" colspan="3">TOTAL</td>
                               <td style="text-align:right;" > 10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
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
                        <table width="100%" style="font-size: 10pt; padding-left:75%;">
                            <tr style="font-size: 10pt;">
                                <td align="left" width="200">JAKARTA, {{strtoupper($request->tanggal)}}</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">PT.PERTAMINA PEDEVE INDONESIA</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->jabatan)}}</td><br>
                            </tr>
                        </table>
                        <table width="100%" style="font-size: 10pt; padding-left:75%">
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->nama)}}</td><br>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            @elseif($request->prosesupah == 'B')
            <!-- pegawai perbantuan -->


            <table width="100%" >
                <?php 
                    $tgl = date_create("$request->tahun-$request->bulan-01");
                    $bulan =  date_format($tgl, 'F');
                    // strtoupper
                ?>
                <tr>
                    <td align="left" style="padding-left:100px;font-family: sans-serif">
                        <table>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">DAFTAR PEMBAYARAN GAJI PEGAWAI PERBANTUAN </font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">PT.PERTAMINA PEDEVE INDONESIA</font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 11pt;font-weight: bold ">BULAN {{strtoupper($bulan)}} {{$request->tahun}}</font></td>
                            </tr>
                        </table>
                    </td>
                   
                    <td align="center" style="">
                        <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:40px;">
                    </td>
                </tr>
            </table>

            <table width="100%"  style="padding-top:6%; padding-left:30px;;padding-right:30px;font-family: sans-serif">
                <tr>
                    <td>
                        <font style="font-size: 8pt;font-style: italic">Tanggal Cetak: {{$request->tanggal}}</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" style="border-collapse: collapse;" border="1">
                            <tr style="text-align:center;font-size: 6pt;">
                                <td rowspan="4">NO</td>
                                <td rowspan="4">NO <br>PEGAWAI</td>
                                <td rowspan="4">NAMA</td>
                                <td colspan="6">PERINCIAN GAJI PEGAWAI PERBANTUAN</td>
                                <td rowspan="4">GAJI<br> BRUTO</td>
                                <td colspan="10">POTONGAN</td>
                                <td rowspan="4">GAJI<br> NETTO</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td rowspan="3">ALL IN</td>
                                <td rowspan="3">FASILITAS <br>CUTI</td>
                                <td rowspan="3">SISA<br> BULAN<br> LALU</td>
                                <td rowspan="3">KODE<br> PAJAK</td>
                                <td rowspan="3">KOREKSI/<br> LAIN-LAIN</td>
                                <td rowspan="3">TUNJANGAN<br> PAJAK</td>
                                <td rowspan="4">IURAN<br> PENSIUN</td>
                                <td rowspan="4">IURAN<br> JAMSOSTEK</td>
                                <td colspan="4">ANGSURAN</td>
                                <td rowspan="4">POT.<br> PAJAK</td>
                                <td rowspan="3">POT.<br> BAZMA</td>
                                <td rowspan="3">POTONGAN.<br> SPSI</td>
                                <td rowspan="3">PEMBULATAN</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td colspan="2">PKPP</td>
                                <td colspan="2">PJR. PESANGON</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td>JUMLAH</td>
                                <td>KE</td>
                                <td>JUMLAH</td>
                                <td>KE</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">CS & BUSINESS SUPPORT</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">FINANCE</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">INTERNAL AUDIT & RISK MGT</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                                <td style="text-align:right;">100.000.000,00</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                               <td style="text-align:right;" colspan="3">TOTAL</td>
                               <td style="text-align:right;" > 10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
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
                        <table width="100%" style="font-size: 10pt; padding-left:75%;">
                            <tr style="font-size: 10pt;">
                                <td align="left" width="200">JAKARTA, {{strtoupper($request->tanggal)}}</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">PT.PERTAMINA PEDEVE INDONESIA</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->jabatan)}}</td><br>
                            </tr>
                        </table>
                        <table width="100%" style="font-size: 10pt; padding-left:75%">
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->nama)}}</td><br>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            @elseif($request->prosesupah == 'U')
            <!-- pegawai komisaris -->

            <table width="100%" >
                <?php 
                    $tgl = date_create("$request->tahun-$request->bulan-01");
                    $bulan =  date_format($tgl, 'F');
                    // strtoupper
                ?>
                <tr>
                    <td align="left" style="padding-left:100px;font-family: sans-serif">
                        <table>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">DAFTAR PEMBAYARAN GAJI PEGAWAI KOMISARIS </font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">PT.PERTAMINA PEDEVE INDONESIA</font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 11pt;font-weight: bold ">BULAN {{strtoupper($bulan)}} {{$request->tahun}}</font></td>
                            </tr>
                        </table>
                    </td>
                   
                    <td align="center" style="">
                        <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:40px;">
                    </td>
                </tr>
            </table>

            <table width="100%"  style="padding-top:6%; padding-left:30px;;padding-right:30px;font-family: sans-serif">
                <tr>
                    <td>
                        <font style="font-size: 8pt;font-style: italic">Tanggal Cetak: {{$request->tanggal}}</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" style="border-collapse: collapse;" border="1">
                            <tr style="text-align:center;font-size: 6pt;">
                                <td rowspan="4">NO</td>
                                <td rowspan="4">NO <br>PEGAWAI</td>
                                <td rowspan="4">NAMA</td>
                                <td colspan="6">PERINCIAN GAJI PEGAWAI PERBANTUAN</td>
                                <td rowspan="4">GAJI<br> BRUTO</td>
                                <td colspan="10">POTONGAN</td>
                                <td rowspan="4">GAJI<br> NETTO</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td rowspan="3">ALL IN</td>
                                <td rowspan="3">FASILITAS <br>CUTI</td>
                                <td rowspan="3">SISA<br> BULAN<br> LALU</td>
                                <td rowspan="3">KODE<br> PAJAK</td>
                                <td rowspan="3">KOREKSI/<br> LAIN-LAIN</td>
                                <td rowspan="3">TUNJANGAN<br> PAJAK</td>
                                <td rowspan="4">IURAN<br> PENSIUN</td>
                                <td rowspan="4">IURAN<br> JAMSOSTEK</td>
                                <td colspan="4">ANGSURAN</td>
                                <td rowspan="4">POT.<br> PAJAK</td>
                                <td rowspan="3">POT.<br> BAZMA</td>
                                <td rowspan="3">POTONGAN.<br> SPSI</td>
                                <td rowspan="3">PEMBULATAN</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td colspan="2">PKPP</td>
                                <td colspan="2">PJR. PESANGON</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td>JUMLAH</td>
                                <td>KE</td>
                                <td>JUMLAH</td>
                                <td>KE</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">CS & BUSINESS SUPPORT</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">00</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">00</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">FINANCE</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">INTERNAL AUDIT & RISK MGT</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                               <td style="text-align:right;" colspan="3">TOTAL</td>
                               <td style="text-align:right;" > 10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
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
                        <table width="100%" style="font-size: 10pt; padding-left:75%;">
                            <tr style="font-size: 10pt;">
                                <td align="left" width="200">JAKARTA, {{strtoupper($request->tanggal)}}</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">PT.PERTAMINA PEDEVE INDONESIA</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->jabatan)}}</td><br>
                            </tr>
                        </table>
                        <table width="100%" style="font-size: 10pt; padding-left:75%">
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->nama)}}</td><br>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>


            @elseif($request->prosesupah == 'O')
            <!-- pegawai komite -->

            <table width="100%" >
                <?php 
                    $tgl = date_create("$request->tahun-$request->bulan-01");
                    $bulan =  date_format($tgl, 'F');
                    // strtoupper
                ?>
                <tr>
                    <td align="left" style="padding-left:100px;font-family: sans-serif">
                        <table>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">DAFTAR PEMBAYARAN GAJI PEGAWAI KOMITE </font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">PT.PERTAMINA PEDEVE INDONESIA</font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 11pt;font-weight: bold ">BULAN {{strtoupper($bulan)}} {{$request->tahun}}</font></td>
                            </tr>
                        </table>
                    </td>
                   
                    <td align="center" style="">
                        <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:40px;">
                    </td>
                </tr>
            </table>

            <table width="100%"  style="padding-top:6%; padding-left:30px;;padding-right:30px;font-family: sans-serif">
                <tr>
                    <td>
                        <font style="font-size: 8pt;font-style: italic">Tanggal Cetak: {{$request->tanggal}}</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" style="border-collapse: collapse;" border="1">
                            <tr style="text-align:center;font-size: 6pt;">
                                <td rowspan="4">NO</td>
                                <td rowspan="4">NO <br>PEGAWAI</td>
                                <td rowspan="4">NAMA</td>
                                <td colspan="6">PERINCIAN GAJI PEGAWAI PERBANTUAN</td>
                                <td rowspan="4">GAJI<br> BRUTO</td>
                                <td colspan="10">POTONGAN</td>
                                <td rowspan="4">GAJI<br> NETTO</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td rowspan="3">ALL IN</td>
                                <td rowspan="3">FASILITAS <br>CUTI</td>
                                <td rowspan="3">SISA<br> BULAN<br> LALU</td>
                                <td rowspan="3">KODE<br> PAJAK</td>
                                <td rowspan="3">KOREKSI/<br> LAIN-LAIN</td>
                                <td rowspan="3">TUNJANGAN<br> PAJAK</td>
                                <td rowspan="4">IURAN<br> PENSIUN</td>
                                <td rowspan="4">IURAN<br> JAMSOSTEK</td>
                                <td colspan="4">ANGSURAN</td>
                                <td rowspan="4">POT.<br> PAJAK</td>
                                <td rowspan="3">POT.<br> BAZMA</td>
                                <td rowspan="3">POTONGAN.<br> SPSI</td>
                                <td rowspan="3">PEMBULATAN</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td colspan="2">PKPP</td>
                                <td colspan="2">PJR. PESANGON</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td>JUMLAH</td>
                                <td>KE</td>
                                <td>JUMLAH</td>
                                <td>KE</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">CS & BUSINESS SUPPORT</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">00</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">00</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">FINANCE</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">INTERNAL AUDIT & RISK MGT</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                               <td style="text-align:right;" colspan="3">TOTAL</td>
                               <td style="text-align:right;" > 10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
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
                        <table width="100%" style="font-size: 10pt; padding-left:75%;">
                            <tr style="font-size: 10pt;">
                                <td align="left" width="200">JAKARTA, {{strtoupper($request->tanggal)}}</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">PT.PERTAMINA PEDEVE INDONESIA</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->jabatan)}}</td><br>
                            </tr>
                        </table>
                        <table width="100%" style="font-size: 10pt; padding-left:75%">
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->nama)}}</td><br>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            @else
            <!-- pegawai baru -->

            <table width="100%" >
                <?php 
                    $tgl = date_create("$request->tahun-$request->bulan-01");
                    $bulan =  date_format($tgl, 'F');
                    // strtoupper
                ?>
                <tr>
                    <td align="left" style="padding-left:100px;font-family: sans-serif">
                        <table>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">DAFTAR PEMBAYARAN GAJI PEGAWAI BARU </font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 12pt;font-weight: bold ">PT.PERTAMINA PEDEVE INDONESIA</font></td>
                            </tr>
                            <tr>
                                <td><font style="font-size: 11pt;font-weight: bold ">BULAN {{strtoupper($bulan)}} {{$request->tahun}}</font></td>
                            </tr>
                        </table>
                    </td>
                   
                    <td align="center" style="">
                        <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:40px;">
                    </td>
                </tr>
            </table>

            <table width="100%"  style="padding-top:6%; padding-left:30px;;padding-right:30px;font-family: sans-serif">
                <tr>
                    <td>
                        <font style="font-size: 8pt;font-style: italic">Tanggal Cetak: {{$request->tanggal}}</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" style="border-collapse: collapse;" border="1">
                            <tr style="text-align:center;font-size: 6pt;">
                                <td rowspan="4">NO</td>
                                <td rowspan="4">NO <br>PEGAWAI</td>
                                <td rowspan="4">NAMA</td>
                                <td colspan="6">PERINCIAN GAJI PEGAWAI PERBANTUAN</td>
                                <td rowspan="4">GAJI<br> BRUTO</td>
                                <td colspan="10">POTONGAN</td>
                                <td rowspan="4">GAJI<br> NETTO</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td rowspan="3">ALL IN</td>
                                <td rowspan="3">FASILITAS <br>CUTI</td>
                                <td rowspan="3">SISA<br> BULAN<br> LALU</td>
                                <td rowspan="3">KODE<br> PAJAK</td>
                                <td rowspan="3">KOREKSI/<br> LAIN-LAIN</td>
                                <td rowspan="3">TUNJANGAN<br> PAJAK</td>
                                <td rowspan="4">IURAN<br> PENSIUN</td>
                                <td rowspan="4">IURAN<br> JAMSOSTEK</td>
                                <td colspan="4">ANGSURAN</td>
                                <td rowspan="4">POT.<br> PAJAK</td>
                                <td rowspan="3">POT.<br> BAZMA</td>
                                <td rowspan="3">POTONGAN.<br> SPSI</td>
                                <td rowspan="3">PEMBULATAN</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td colspan="2">PKPP</td>
                                <td colspan="2">PJR. PESANGON</td>
                            </tr>
                            <tr style="text-align:center;font-size: 6pt;">
                                <td>JUMLAH</td>
                                <td>KE</td>
                                <td>JUMLAH</td>
                                <td>KE</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">CS & BUSINESS SUPPORT</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">00</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">00</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">FINANCE</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr>
                                <td style="padding-left:12px;font-size: 6pt;" colspan="21">INTERNAL AUDIT & RISK MGT</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td style="text-align:center;">1</td>
                                <td style="text-align:left;">214365</td>
                                <td style="text-align:left;">BAMBANG BUDI HERYANTO</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                                <td colspan="3" style="text-align:right;">SUB TOTAL</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:center;">K/2</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                                <td style="text-align:right;">0</td>
                            </tr>
                            <tr style="font-size: 6pt;">
                               <td style="text-align:right;" colspan="3">TOTAL</td>
                               <td style="text-align:right;" > 10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
                               <td style="text-align:right;" >10</td>
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
                        <table width="100%" style="font-size: 10pt; padding-left:75%;">
                            <tr style="font-size: 10pt;">
                                <td align="left" width="200">JAKARTA, {{strtoupper($request->tanggal)}}</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">PT.PERTAMINA PEDEVE INDONESIA</td><br>
                            </tr>
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->jabatan)}}</td><br>
                            </tr>
                        </table>
                        <table width="100%" style="font-size: 10pt; padding-left:75%">
                            <tr style="font-size: 10pt; ">
                                <td align="left" width="200">{{strtoupper($request->nama)}}</td><br>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            @endif



            
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
        
    </body>
</html>
