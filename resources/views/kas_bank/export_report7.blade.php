<!DOCTYPE html>
<html>
    <title>LAPORAN - ARUS KAS INTERNAL</title>
    <head>
        <style>
            .row {
              display: -ms-flexbox;
              display: flex;
              -ms-flex-wrap: wrap;
              flex-wrap: wrap;
              margin-right: -5px;
              margin-left: -5px;
            }
            
            .table {
                font: normal 12px Verdana, Arial, sans-serif;
                border-collapse: collapse;
                border: 1px solid black;
            }

            th, td {
                border: 1px solid black;
                padding: 5px;
            }

            td.container {
                height: 110px;
            }

            .table-no-border-all td {
                font: normal 12px Verdana, Arial, sans-serif;
                border: 0px;
                padding: 0px;
            }

            .table-no-border td, .table-no-border tr {
                font: normal 12px Verdana, Arial, sans-serif;
                border:0px;
                padding: 0px;
            }

            .text-center {
              text-align: center;
            }

            .text-right {
              text-align: right;
            }

            td.border-less {
              border-top: 2px solid #FFFFFF;
            }

            td.border-less-top-bottom {
              border-top: 2px solid #FFFFFF;
              border-bottom: 2px solid #FFFFFF;
            }

            td.border-less-dashed {
                border-bottom: dashed; 
                border-width: 2px;
                border-left: 1px solid black;
                border-right: 1px solid black;
            }

            

            .tab-1 {
                padding-left:10%;
            }

            .tab-2 {
                padding-left:15%;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="text-center">
              <p>
                <b>
                    PT. PERTAMINA PEDEVE INDONESIA
                </b>
                <br>
                <b>
                    LAPORAN - ARUS KAS
                </b>
                <br>
                <b>
                    PERIODE: AGUSTUS 2020 
                </b>
              </p>
            </div>
  
            <div>
              <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="120px" height="60px">
            </div>
          </div>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <table width="100%" class="table">
                <thead>
                    <tr>
                        <th rowspan="2">KETERANGAN</th>
                        <th colspan="4">TOTAL</th>
                    </tr>
                    <tr>
                        <th>RUPIAH</th>
                        <th>US$</th>
                        <th>EKIV US$</th>
                        <th nowrap>JML RP + EKIV US$</th>
                    </tr>
                <thead>
                <tbody>
                    {{-- A. ARUS KAS DARI AKTIVITAS OPERASI START --}}
                    <tr>
                        <td nowrap>
                            <b>
                                A. ARUS KAS DARI AKTIVITAS OPERASI
                            </b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="tab-1 border-less-top-bottom">
                            <b><i>PENERIMAAN</i></b>
                        </td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                    </tr>
                    <tr>
                        <td class="tab-2 border-less-dashed" valign="top">
                            PIUTANG PEGAWAI
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                    </tr>
                    <tr>
                        <td class="tab-1">
                            <b><i>JUMLAH PENERIMAAN</i></b>
                        </td>
                        <td class="text-right">220,690,969,986.60</td>
                        <td class="text-right">1,080,258.70</td>
                        <td class="text-right">15,959,743,504.08</td>
                        <td class="text-right">236,650,713,490.68</td>
                    </tr>
                    <tr>
                        <td class="tab-1 border-less-top-bottom">
                            <b><i>PENGELUARAN</i></b>
                        </td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                    </tr>
                    <tr>
                        <td class="tab-2 border-less-dashed" valign="top">
                            PENGEMBALIAN INVESTASI BERMASALAH
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                    </tr>
                    <tr>
                        <td class="tab-1">
                            <b><i>JUMLAH PENGELUARAN</i></b>
                        </td>
                        <td class="text-right">220,690,969,986.60</td>
                        <td class="text-right">1,080,258.70</td>
                        <td class="text-right">15,959,743,504.08</td>
                        <td class="text-right">236,650,713,490.68</td>
                    </tr>
                    <tr>
                        <td class="border-less-top-bottom">
                            <b>
                                A. ARUS KAS DARI AKTIVITAS OPERASI
                            </b>
                        </td>
                        <td class="text-right border-less-top-bottom">
                            (560,903,009.47)
                        </td>
                        <td class="text-right border-less-top-bottom">
                            646.28
                        </td>
                        <td class="text-right border-less-top-bottom">
                            9,547,890.60
                        </td>
                        <td class="text-right border-less-top-bottom">
                            (551,355,118.85)
                        </td>
                    </tr>
                    {{-- A. ARUS KAS DARI AKTIVITAS OPERASI END --}}

                    {{-- B. ARUS KAS DARI AKTIVITAS INVESTASI START --}}
                    <tr>
                        <td nowrap>
                            <b>
                                B. ARUS KAS DARI AKTIVITAS INVESTASI
                            </b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="tab-1 border-less-top-bottom">
                            <b><i>PENERIMAAN</i></b>
                        </td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                    </tr>
                    <tr>
                        <td class="tab-2 border-less-dashed" valign="top">
                            PIUTANG PEGAWAI
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                    </tr>
                    <tr>
                        <td class="tab-1">
                            <b><i>JUMLAH PENERIMAAN</i></b>
                        </td>
                        <td class="text-right">220,690,969,986.60</td>
                        <td class="text-right">1,080,258.70</td>
                        <td class="text-right">15,959,743,504.08</td>
                        <td class="text-right">236,650,713,490.68</td>
                    </tr>
                    <tr>
                        <td class="tab-1 border-less-top-bottom">
                            <b><i>PENGELUARAN</i></b>
                        </td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                    </tr>
                    <tr>
                        <td class="tab-2 border-less-dashed" valign="top">
                            PEMBELIAN AKTIVA TETAP
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                    </tr>
                    <tr>
                        <td class="tab-1">
                            <b><i>JUMLAH PENGELUARAN</i></b>
                        </td>
                        <td class="text-right">220,690,969,986.60</td>
                        <td class="text-right">1,080,258.70</td>
                        <td class="text-right">15,959,743,504.08</td>
                        <td class="text-right">236,650,713,490.68</td>
                    </tr>
                    <tr>
                        <td class="border-less-top-bottom">
                            <b>
                                B. ARUS KAS DARI AKTIVITAS INVESTASI
                            </b>
                        </td>
                        <td class="text-right border-less-top-bottom">
                            (560,903,009.47)
                        </td>
                        <td class="text-right border-less-top-bottom">
                            646.28
                        </td>
                        <td class="text-right border-less-top-bottom">
                            9,547,890.60
                        </td>
                        <td class="text-right border-less-top-bottom">
                            (551,355,118.85)
                        </td>
                    </tr>
                    {{-- B. ARUS KAS DARI AKTIVITAS INVESTASI END --}}

                    {{-- C. ARUS KAS DARI AKTIVITAS PENDANAAN START --}}
                    <tr>
                        <td nowrap>
                            <b>
                                C. ARUS KAS DARI AKTIVITAS PENDANAAN
                            </b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="tab-1 border-less-top-bottom">
                            <b><i>PENERIMAAN</i></b>
                        </td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                    </tr>
                    <tr>
                        <td class="tab-2 border-less-dashed" valign="top">
                            IURAN MMD
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                    </tr>
                    <tr>
                        <td class="tab-1">
                            <b><i>JUMLAH PENERIMAAN</i></b>
                        </td>
                        <td class="text-right">220,690,969,986.60</td>
                        <td class="text-right">1,080,258.70</td>
                        <td class="text-right">15,959,743,504.08</td>
                        <td class="text-right">236,650,713,490.68</td>
                    </tr>
                    <tr>
                        <td class="tab-1 border-less-top-bottom">
                            <b><i>PENGELUARAN</i></b>
                        </td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                        <td class="border-less-top-bottom"></td>
                    </tr>
                    <tr>
                        <td class="tab-2 border-less-dashed" valign="top">
                            PENGEMBALIAN POKOK MMD
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                        <td class="text-right border-less-dashed" valign="top">
                            0.00
                        </td>
                    </tr>
                    <tr>
                        <td class="tab-1">
                            <b><i>JUMLAH PENGELUARAN</i></b>
                        </td>
                        <td class="text-right">220,690,969,986.60</td>
                        <td class="text-right">1,080,258.70</td>
                        <td class="text-right">15,959,743,504.08</td>
                        <td class="text-right">236,650,713,490.68</td>
                    </tr>
                    <tr>
                        <td class="border-less">
                            <b>
                                C. ARUS KAS DARI AKTIVITAS PENDANAAN
                            </b>
                        </td>
                        <td class="text-right border-less">
                            (560,903,009.47)
                        </td>
                        <td class="text-right border-less">
                            646.28
                        </td>
                        <td class="text-right border-less">
                            9,547,890.60
                        </td>
                        <td class="text-right border-less">
                            (551,355,118.85)
                        </td>
                    </tr>
                    {{-- C. ARUS KAS DARI AKTIVITAS PENDANAAN END --}}

                    <tr>
                        <td>
                            KENAIKAN (PENURUNAN) KAS BERSIH
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                    </tr>
                    <tr>
                        <td class="border-less">
                            SALDO KAS & BANK - AWAL PERIODE
                        </td>
                        <td class="border-less text-right">
                            560,903,009.47
                        </td>
                        <td class="border-less text-right">
                            560,903,009.47
                        </td>
                        <td class="border-less text-right">
                            560,903,009.47
                        </td>
                        <td class="border-less text-right">
                            560,903,009.47
                        </td>
                    </tr>
                    <tr>
                        <td class="border-less">
                            SALDO KAS & BANK - AKHIR PERIODE
                        </td>
                        <td class="border-less text-right">
                            560,903,009.47
                        </td>
                        <td class="border-less text-right">
                            560,903,009.47
                        </td>
                        <td class="border-less text-right">
                            560,903,009.47
                        </td>
                        <td class="border-less text-right">
                            560,903,009.47
                        </td>
                    </tr>
                    <tr>
                        <td>
                            SELISIH KURS : Rp.14,684.00
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                    </tr>
                    <tr>
                        <td>
                            SALDO AKHIR SETELAH SELISIH KURS
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                        <td class="text-right">
                            560,903,009.47
                        </td>
                    </tr>
                <tbody>
            </table>
        </main>

        <script type='text/php'>
            if ( isset($pdf) ) { 
                $font = null;
                $size = 9;
                $y = $pdf->get_height() - 30;
                $x = $pdf->get_width() - 103;
                $pdf->page_text($x, $y, 'Halaman {PAGE_NUM} dari {PAGE_COUNT}', $font, $size);
            }
        </script>
    </body>
</html>
