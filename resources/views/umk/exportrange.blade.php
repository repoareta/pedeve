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
        <header>
            <table width="100%"  >
                <tr>
                    <td align="center" style="padding-left:200px;">
                    <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:70px;"><br>
                   <font style="font-size: 12pt;font-weight: bold "> PT. PERTAMINA PEDEVE INDONESIA</font><br>
                   <font style="font-size: 12pt;font-weight: bold ">REKAP PERMINTAAN BAYAR</font><br>
                   <font style="font-size: 12pt;font-weight: bold ">BULAN PEBRUARI 2020</font><br>
                    </td>
                </tr>
            </table>
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <table width="100%"  border="1" style="margin-top:30px;width:100%;border-collapse: collapse;" class="table">
            <thead>
                <tr>
                    <th>NO. BAYAR</th>
                    <th>NO. KAS</th>
                    <th>KEPADA</th>
                    <th>KETERANGAN</th>
                    <th>LAMPIRAN</th>
                    <th>JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bumk_header_list as $bayar)
                    <tr>
                        <td>{{ $bayar->no_bayar }}</td>
                        <td>{{ $bayar->no_kas }}</td>
                        <td>{{ $bayar->kepada }}</td>
                        <td>{{ $bayar->keterangan }}</td>
                        <td>{{ $bayar->lampiran }}</td>
                        <td>Rp. 90.000.000,00</td>
                    
                    </tr>
                @endforeach
            </tbody>
            </table>
        </main>
        <table  width="100%" style="font-weight: bold">
            <thead>
                <tr>
                    <td align="right">TOTAL : Rp. </td>
                    <td align="center" width="91"> 1.000.000,00</td>
                </tr>
            </thead>
        </table>
    </body>
</html>
