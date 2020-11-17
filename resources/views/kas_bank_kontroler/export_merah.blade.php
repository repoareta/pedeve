<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        BUKTI KAS MERAH
    </title>
</head>
<style media="screen">

.table {
    font: normal 12px Verdana, Arial, sans-serif;
    border-collapse: collapse;
    border: 1px solid black;
}

th, td {
    border: 1px solid black;
    padding: 5px;
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

h4 {
    font-size: 15px;
}

.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}

.content {
    width: 100%;
    padding: 0px;
    overflow: hidden;
}

.content img {
    margin-right: 15px;
    float: left;
}

.content h4 {
    margin-left: 15px;
    display: block;
    margin: 2px 0 15px 0;
}

.content p {
    margin-left: 15px;
    display: block;
    margin: 0px 0 10px 0;
    font-size: 12px;
    padding-bottom: 10px;
}

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

#container {
    position: relative;
    font: normal 12px Verdana, Arial, sans-serif;
}
#bottom-right {
    position: absolute;
    bottom: 0;
}

.pagecount:before {
content: counter(pages);
}

header { 
    position: fixed; 
    left: 0px; 
    top: -110px;
    right: 0px;
    height: 0px;
}

@page { 
    margin: 130px 50px 50px 50px;
}

.border-top-less {
    border-top: 2px solid white;
}
</style>
<body>
    <header id="header">
        <div class="row">
            <div class="text-center">
                <p>
                    <br><u>
                    BUKTI PENERIMAAN KAS/BANK
                    </u>
                    </b>
                </p>
            </div>
    
            <div>
                <img align="right" src="{{public_path() . '/images/pertamina.jpg'}}" width="120px" height="60px" style="padding-top:10px">
            </div>
        </div>
    </header>
      
    <main>
        <div class="text-right" id="container" style="margin-right:5%;">{{$docno}}</div>
        <div class="row">
            <table style="width:100%;" class="table">
                <thead>
                    <tr>
                        <td colspan="5">
                            <p>
                                SUDAH TERIMA DARI : {{$kepada}}
                            <br>
                            UANG SEJUMLAH &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  
                            @if($ci == 1)
                                Rp. {{number_format($nilai_dok) < 0 ? number_format($nilai_dok*-1,2) : number_format($nilai_dok,2)}}
                            @else
                                US$. {{number_format($nilai_dok) < 0 ? "(".number_format($nilai_dok*-1,2).")" : number_format($nilai_dok,2)}}
                            @endif
                            <br>
                            <div style="border: 1px solid black; padding: 10px;">
                            @if($ci == 1)
                                {{number_format($nilai_dok) < 0 ? strtoupper(terbilang($nilai_dok*-1)) : strtoupper(terbilang($nilai_dok)) }} {{strtoupper('rupiah')}}
                            @else
                                {{number_format($nilai_dok) < 0 ? strtoupper(terbilang($nilai_dok*-1)) : strtoupper(terbilang($nilai_dok)) }} {{strtoupper('DOLLAR')}}
                            @endif
                            </div>
                            </p>
                        </td>
                        <td colspan="2" nowrap>
                            JENIS KARTU  &nbsp;&nbsp;&nbsp;&nbsp;: {{$jk}}
                            <br>
                            BLN/THN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$bulan}}/{{$tahun}}
                            <br>
                            NO. KAS/BANK &nbsp;&nbsp;: {{$store}}
                            <br>
                            NO. BUKTI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
                            {{$voucher}}
                            <br>
                            CURRENCY IDX :
                            @if($ci == 1)
                                Rp.
                            @else
                                US$
                            @endif
                            <br>
                            KURS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                            {{number_format($rate,0)}}
                        </td>
                    </tr>
                    <tr>
                        <th nowrap>MENURUT RINCIAN BERIKUT</th>
                        <th>SANDI PERKIRAAN</th>
                        <th>KODE BAGIAN</th>
                        <th>PERINTAH KERJA</th>
                        <th>J/B</th>
                        <th>JUMLAH</th>
                        <th>C/J</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @php
                        $no=0;
                        $total_row = 0;
                    @endphp
                    @foreach($data_list as $data)  
                    @php
                        $pe[$no] = $data->totprice; 
                    @endphp
                    <tr>
                        <td valign="top">{{$data->keterangan}}</td>
                        <td valign="top" class="text-center">{{$data->account}}</td>
                        <td valign="top" class="text-center">{{$data->bagian}}</td>
                        <td valign="top" class="text-center">{{$data->pk}}</td>
                        <td valign="top" class="text-center">{{$data->jb}}</td>
                        <td valign="top" class="text-right" nowrap>
                        {{number_format($data->totprice,2) < 0 ? number_format($data->totprice*-1,2)." CR" : number_format($data->totprice,2)}}
                        </td>
                        <td valign="top" class="text-center">{{$data->cj}}</td>
                        @php
                            $total_row++;
                        @endphp    
                    </tr>
                    @endforeach                   
                    <tr>
                        <td class="border-top-less" valign="top" style="height:{{ 565 - ($total_row*50) }}px">
                            <b><u>KETERANGAN :</u></b>
                            <br>
                            {{$ket1}}
                            <br>
                            {{$ket2}}
                            <br>
                            {{$ket3}}
                        </td>
                        <td class="border-top-less" ></td>
                        <td class="border-top-less"></td>
                        <td class="border-top-less"></td>
                        <td class="border-top-less"></td>
                        <td class="border-top-less"></td>
                        <td class="border-top-less"></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">Jumlah</td>
                        <td colspan="2" class="text-center">
                        <b>{{number_format($nilai_dok,2) < 0 ? number_format($nilai_dok*-1,2)." CR" : number_format($nilai_dok,2)}}</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <b>TANDA TANGAN</b>
                        </td>
                        <td colspan="5" class="text-center">
                            JAKARTA, {{ date('d/m/Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td  class="text-center" valign="top" style="border-bottom: 2px solid #FFFFFF;">
                            Pemeriksaan Kas,
                            <br>
                            {{$request->setuju2}}
                        </td>
                        <td class="text-center" valign="top" style="border-bottom: 2px solid #FFFFFF;">
                            Pembukuan,
                            <br>
                            {{$request->buku2}}
                        </td>
                        <td colspan="5" class="text-center" valign="top" style="border-top: 2px solid #FFFFFF; border-bottom: 2px solid #FFFFFF;">
                            <br>
                            {{$request->kas2}}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center border-less">
                            <br>
                            <br>
                            <br>
                            <br>
                            {{$request->nsetuju2}}
                        </td>
                        <td class="text-center border-less">
                            <br>
                            <br>
                            <br>
                            <br>
                            {{$request->nbuku2}}
                        </td>
                        <td colspan="5" class="text-center border-less">
                            <br>
                            <br>
                            <br>
                            <br>
                            {{$request->nkas2}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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