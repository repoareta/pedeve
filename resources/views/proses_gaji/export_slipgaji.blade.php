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
            <table width="100%" style="font-family: sans-serif;">
                <tr>
                    <td align="left" style="padding-left:30px;">
                        <font style="font-size: 12pt;font-weight: bold "> Slip Upah</font><br>
                        <font style="font-size: 12pt;font-weight: bold ">PT.PERTAMINA PEDEVE INDONESIA</font><br>
                        <table border="1" style="border-collapse: collapse; font-size: 10pt;text-align:center;" width="95%">
                            <tr bgcolor="#A9A9A9">
                                <td >Slip Upah Bulan/Tahun</td>
                                <td>Payroll Area</td>
                            </tr>
                            <tr>
                                <td>Maret 2019</td>
                                <td>PDV</td>
                            </tr>
                        </table>
                        <table style=" font-size: 10pt;text-align:left;font-weight: bold" width="95%">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>BAMBANG BUDI HERYANTO</td>
                            </tr>
                            <tr>
                                <td>Nopek</td>
                                <td>:</td>
                                <td>12342</td>
                            </tr>
                        </table>
                            <td align="center" style="padding-left:150px;">
                            <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:30px;">
                    </td>

                </tr>
                    
            </table>


            <table width="100%" style="font-family: sans-serif;padding-left:30px;padding-right:30px;">
                <tr style=" font-size: 10pt;text-align:center;font-weight: bold">
                    <td  colspan="2">LEMBAR RINCIAN</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="100%" style="border-collapse: collapse;" border="1" >
                            <tr style=" font-size: 10pt;text-align:center;font-weight: bold">
                                <td>Jenis</td>
                                <td>AARD</td>
                                <td>Keterangan</td>
                                <td>Jumlah/Cicilan</td>
                                <td>Cicilan Ke-</td>
                                <td>Jumlah</td>
                            </tr>
                            <tr style=" font-size: 10pt;">
                                <td  style=" text-align:left;">Jenis</td>
                                <td style=" text-align:center;">AARD</td>
                                <td style=" text-align:left;">Keterangan</td>
                                <td style=" text-align:center;">-</td>
                                <td style=" text-align:center;">-</td>
                                <td style=" text-align:right;">10.000.000,00</td>
                            </tr>
                            <tr>
                                <td style=" font-size: 10pt;text-align:right;" colspan="5" ><font style=" text-align:right; padding-right:2%;">Sub Total : </td>
                                <td style=" font-size: 10pt;text-align:right;"   >232 </td>
                            </tr>

                            <tr style=" font-size: 10pt;">
                                <td  style=" text-align:left;">Jenis</td>
                                <td style=" text-align:center;">AARD</td>
                                <td style=" text-align:left;">Keterangan</td>
                                <td style=" text-align:center;">-</td>
                                <td style=" text-align:center;">-</td>
                                <td style=" text-align:right;">10.000.000,00</td>
                            </tr>
                            <tr >
                                <td style=" font-size: 10pt;text-align:right;" colspan="5" ><font style=" text-align:right; padding-right:2%;">Penghasilan Bersih : </td>
                                <td style=" font-size: 10pt;text-align:right;"   >232 </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>


            <table width="100%" style="font-family: sans-serif;padding-left:30px;padding-top:10px;padding-right:30px;">
                <tr style=" font-size: 10pt;text-align:center;font-weight: bold">
                    <td  colspan="2">INFORMASI LAIN-LAIN </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="100%" style="border-collapse: collapse;" border="1" >
                            <tr style=" font-size: 10pt;text-align:center; font-weight: bold">
                                <td>Jenis</td>
                                <td>AARD</td>
                                <td>Nama</td>
                                <td>Bulan Ini</td>
                                <td>Akumulasi</td>
                            </tr>
                            <tr style=" font-size: 10pt;">
                                <td  style=" text-align:left;">Jenis</td>
                                <td style=" text-align:center;">AARD</td>
                                <td style=" text-align:center;">-</td>
                                <td style=" text-align:right;" width="15%">200.000,00</td>
                                <td style=" text-align:right;" width="15%">0</td>
                            </tr>
                            <tr >
                                <td style=" font-size: 10pt;text-align:right; padding-right:2%;" colspan="3" >Sub Total Iuran Wajib Beban Perusahaan : </td>
                                <td style=" font-size: 10pt;text-align:right;"  width="15%" >100 </td>
                                <td style=" font-size: 10pt;text-align:right;"  width="15%" >232 </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
        
    </body>
</html>
