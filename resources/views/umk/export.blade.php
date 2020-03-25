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
                margin-left: 2cm;
                margin-right: 2cm;
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
        @foreach($umk_header_list as $data_report)
        <header>
            <table width="100%"  >
                <tr>
                    <td align="center" style="padding-left:100px;">
                    <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:70px;"><br>
                   <font style="font-size: 12pt;font-weight: bold "> PT. PERTAMINA PEDEVE INDONESIA</font><br><br>
                   <font style="font-size: 12pt;font-weight: bold "><u>PERMINTAAN UANG MUKA KERJA/PANJAR KERJA</u></font><br>
                   <font style="font-size: 10pt;">NOMOR :{{$data_report->no_umk}}</font>
                    </td>
                </tr>
            </table>
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
        <table width="100%" style="padding-top:10px;">
                <tr style="font-size: 10pt;">
                    <td width="100px">KEPADA</td><td width="20px">:</td><td>KEPADA</td><br>
                </tr>
                <tr style="font-size: 10pt;">
                    <td width="100px">DARI</td><td width="20px">:</td><td>DARI</td>
                    <hr>
                </tr>
        </table>
        <table width="100%" style="padding-top:-20px;" >
                <tr style="font-size: 10pt;">
                    <td width="600px">PERMINTAAN UANG MUKA KERJA/PANJAR KERJA YANG AKAN DIPERGUNAKAN UNTUK :</td><br>
                </tr>
                <tr style="font-size: 10pt;">
                    <td width="200px">PERMINTAAN UMK KENDARAAN DINAS FEBRUARI 2020 (1)</td>
                </tr>
        </table>
        <table width="100%" style="padding-top:20px;" >
                <tr style="font-size: 10pt;">
                    <td width="200px">SEBESAR</td><td width="20px">:</td><td>Rp. <?php echo number_format($data_report->jumlah, 0, ',', '.'); ?></td><br>
                </tr>
                <tr style="font-size: 10pt;">
                    <td width="200px"></td><td width="20px"></td><td>ENAM JUTA LIMA RATUS RIBU  RUPIAH</td><br>
                </tr>
        </table>
        <table width="100%" style="padding-top:40px;" >
                <tr style="font-size: 10pt;">
                    <td width="600px"><u>PERINCIAN  RENCANA PENGGUNAAN ADALAH SEBAGAI BERIKUT:</u></td>
                </tr>
        </table>
        <table width="100%"  >
                <tr style="font-size: 10pt;">
                    <td style="border-bottom:2px dotted black;" width="480px">{{$data_report->keterangan}}</td><td width="50px">Rp.</td><td><?php echo number_format($data_report->jumlah, 0, ',', '.'); ?></td><br>
                </tr>
        </table>
        <table width="100%">
                <tr style="font-size: 10pt;">
                    <td align="right" width="360">JUMLAH</td><td width="40">Rp.</td><td> <?php echo number_format($data_report->jumlah, 0, ',', '.'); ?></td><br>
                </tr>
        </table>
        <table width="100%" style="font-size: 10pt; padding-top:50px;">
                <tr style="font-size: 10pt;">
                    <td align="right" width="350">JAKARTA</td><td width="10">, </td><td><?php echo date('d/m/Y'); ?></td><br>
                </tr>
        </table>
        <table width="100%" style="font-size: 10pt; padding-top:-10px;">
                <tr style="font-size: 10pt;">
                    <td align="center" width="200">MENYETUJUI,</td><td align="center" width="200">PEMOHON,</td><br>
                </tr>
                <tr style="font-size: 10pt;">
                    <td align="center" width="200">CS & BS</td><td align="center" width="200">IA & RM</td><br>
                </tr>
        </table>
        <table width="100%" style="font-size: 10pt; padding-top:10px;">
                <tr style="font-size: 10pt;">
                    <td align="center" width="200"><u>ALI SYAMSUL ROHMAN</u></td><td align="center" width="200"><u>ANGGRAINI GITTA L</u></td><br>
                </tr>
        </table>
        @endforeach
    </body>
</html>
