<!DOCTYPE html>
<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 2, so the footer and the header
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
        @foreach($bayar_header_list as $data_report)
        <header>
            <table width="100%"  >
                <tr>
                    <td align="center" style="padding-left:150px;">
                    <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:30px;"><br>
                   <font style="font-size: 12pt;font-weight: bold "> PT. PERTAMINA PEDEVE INDONESIA</font><br><br>
                   <font style="font-size: 12pt;font-weight: bold "><u>SURAT PERMINTAAN PROSES PEMBAYARAN</u></font><br>
                   <font style="font-size: 10pt;">NOMOR :{{$data_report->no_bayar}}</font>
                    </td>
                </tr>
            </table>
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
        <table width="100%" style="padding-top:10px;">
                <tr style="font-size: 10pt;">
                    <td width="100px">KEPADA</td><td width="20px">:</td><td>MAN. FINANC</td><br>
                </tr>
                <tr style="font-size: 10pt;">
                    <td width="100px">DARI</td><td width="20px">:</td><td>IA & RM</td>
                    <hr>
                </tr>
        </table>
        <table width="100%" style="padding-top:-20px;" >
                <tr style="font-size: 10pt;">
                    <td width="600px">TERLAMPIR DIKIRIMKAN DOKUMEN PENUNJANG :</td><br>
                </tr>
                <tr style="font-size: 10pt;">
                    <td width="200px">{{$data_report->lampiran}}</td>
                </tr>
        </table>
        <table width="100%" style="padding-top:20px;" >
                <tr style="font-size: 10pt;">
                    <td width="200px">UNTUK PEMBAYARAN</td><td width="20px">:</td><td>{{$data_report->keterangan}}</td><br>
                </tr>
        </table>
        <table width="100%" style="padding-top:20px;" >
                <tr style="font-size: 10pt;">
                    <td width="200px">SEBESAR</td><td width="20px">:</td><td><?php echo currency_idr($data_report->nilai); ?></td><br>
                </tr>
                <tr style="font-size: 9pt;">
                    <td width="200px"></td><td width="20px"></td><td>{{ strtoupper(Terbilang::angka($data_report->nilai)) }} {{strtoupper('rupiah')}}</td><br>
                </tr>
        </table>
        <table width="100%" style="padding-top:20px;" >
                <tr style="font-size: 10pt;">
                    <td width="200px">DIBAYARKAN KEPADA</td><td width="20px">:</td><td>{{$data_report->kepada}}</td><br>
                </tr>
        </table>
        <table width="100%" style="padding-top:40px;" >
                <tr style="font-size: 10pt;">
                    <td width="600px">PERINCIAN :</td>
                </tr>
        </table>
        <table width="100%" border="none" >
                <tr style="font-size: 10pt;border-style: groove" bgcolor="#DCDCDC">
                    <td width="10PX">NO</td>
                    <td width="100">KETERANGAN</td>
                    <!-- <td width="10PX"  align="center">SANDI</td> -->
                    <td width="10PX" align="center">JUMLAH</td>
                </tr>
        </table>
        <table width="100%"  >
                <tr style="font-size: 10pt;">
                    <td style="border-bottom:2px dotted black;" width="70px">1</td>
                    <td style="border-bottom:2px dotted black;" width="275">{{$data_report->keterangan}}</td>
                    <!-- <td  width="60"  align="center">111111</td> -->
                    <td  width="80">Rp.</td>
                    <td  width="580px"><?php echo number_format($data_report->nilai, 2, ',', '.'); ?></td>
                </tr>
        </table>
        <table width="100%">
                <tr style="font-size: 10pt;">
                    <td align="right" width="335">TOTAL </td> <td width="80">Rp.</td><td> <?php echo number_format($data_report->nilai, 2, ',', '.'); ?></td><br>
                </tr>
        </table>
        <table width="100%" style="font-size: 10pt; padding-top:50px;">
                <tr style="font-size: 10pt;">
                    <td align="right" width="400">JAKARTA</td><td width="10">, </td><td><?php echo date('d/m/Y'); ?></td><br>
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
