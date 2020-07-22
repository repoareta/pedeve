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
                <td align="center" style="padding-left:200px;">
                    <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:30px;"><br>
                   <font style="font-size: 10pt;font-weight: bold "> PT. PERTAMINA PEDEVE INDONESIA</font><br>
                   <font style="font-size: 10pt;font-weight: bold ">LAPORAN NERACA</font><br>
                   <font style="font-size: 10pt;"> BULAN BUKU : {{strtoupper($bulan)}} {{$request->tahun}} </font><br>
                    </td>
                </tr>
            </table>
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <!-- <font style="font-size: 8pt;font-weight: bold"> -->
            <table style="font-size: 8pt;font-weight: bold">
                <tr>
                    <td>NO. REPORT</td>
                    <td>:</td>
                    <td>CTR002-01</td>
                </tr>
                <tr>
                    <td>TANGGAL REPORT</td>
                    <td>:</td>
                    <td>{{$request->tanggal}}</td>
                </tr>
            </table>
            <table width="100%" style="font-family: sans-serif;border-collapse: collapse;" border="1">
                <thead>
                    <tr style="text-align:center;font-size: 8pt;">
                        <th width="30%">KETERANGAN</th>
                        <th width="10%">SUB<br>AKUN</th>
                        <th width="30%">MMD</th>
                        <th width="30%">MS</th>
                        <th width="30%">KONSOLIDASI</th>
                    </tr>
                <thead>
                <tbody>
                    @foreach($data_list as $data)
                    <tr style="text-align:center;font-size: 8pt;">
                        <td width="30%">a</td><br>
                        <td width="10%">SUB<br>AKUN</td><br>
                        <td width="30%">MMD</td><br>
                        <td width="30%">MS</td><br>
                        <td width="30%">c</td><br>
                    </tr>
                        @endforeach
                </tbody>
            </table>
        </main>
        
    </body>
</html>
