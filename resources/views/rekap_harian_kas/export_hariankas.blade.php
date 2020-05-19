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
                <tr>
                    <td align="center" style="padding-left:200px;">
                        <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="160px" height="80px"  style="padding-right:30px;"><br>
                        <font style="font-size: 10pt;font-weight: bold "> PT. PERTAMINA PEDEVE INDONESIA</font><br>
                        <font style="font-size: 10pt;font-weight: bold ">(PEDEVE)</font><br>
                        <font style="font-size: 10pt; "> JL. RADEN SALEH NO.44 - CIKINI, JAKARTA PUSAT</font><br>
                    </td>
                </tr>
            </table>
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
        <table width="100%">
            <tr>
                <td>
                    <table width="100%" style="font-family: sans-serif;border-collapse: collapse;" border="1">
                        <tr>
                            <td>a</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" style="font-family: sans-serif;border-collapse: collapse;" border="1">
                        <tr>
                            <td> HALAMAN</td>
                        </tr>
                        <tr>
                           <td>JENIS KARTU</td>
                           </tr>
                        <tr>LOKASI</tr>
                        <tr>NO. REKENING</tr>
                        <tr>MATA UANG</tr>
                    </table>
                </td>
            </tr>
        </table>
            <!-- <font style="font-size: 10pt;font-style: italic">Tanggal Cetak: {{$request->tglctk}}</font> -->
            <table width="100%" style="font-family: sans-serif;border-collapse: collapse;" border="1">
                <thead>
                    <tr style="text-align:center;font-size: 8pt;">
                        <td>JK</td>
                        <td>BLN</td>
                        <td>CJ</td>
                        <td>NOBUKTI</td>
                        <td>PK</td>
                        <td>ST</td>
                        <td>SANPER</td>
                        <td>JB</td>
                        <td>LP</td>
                        <td>BAGIAN</td>
                        <td>NO.URUT</td>
                        <td>AMOUNT RUPIAH</td>
                        <td>AMOUNT DOLAR</td>
                    </tr>
                <thead>
                <tbody>

                <tbody>

            </table>
        </main>
        
    </body>
</html>
