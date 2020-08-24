<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Data Umum
        </h3>
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_keluarga">
    <thead >
    @foreach($data_list as $key=>$data)
    <?php
        $tgl = date_create($data->tgl_perkara);
        $tanggal = date_format($tgl, 'd M Y');
    ?>
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Tanggal</th><td>{{$tanggal}}</td>
        </tr>
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Klasifikasi Perkara</th><td>{{$data->klasifikasi_perkara}}</td>
        </tr>
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Nomer Perkara</th><td>{{$data->no_perkara}}</td>
        </tr>
        @endforeach
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Penggugat</th>
            <td>
                <table width="100%">
                    <thead class="thead-light">
                        <tr style="text-align:center">
                            <th width="10%">No</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($data_p as $key=>$data_peng)
                        @if($data_peng->status == '1')
                            <tr>
                                <td style="text-align:center">{{$no++}}</td>
                                <td>{{$data_peng->nama}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Kuasa Hukum Penggugat</th>
            <td>
                <table width="100%">
                    <thead class="thead-light">
                        <tr style="text-align:center">
                            <th width="10%">No</th>
                            <th>Nama</th>
                            <th>Nama Pihak</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php $no=1; ?>
                            @foreach($data_ as $key=>$data_peng)
                            <tr>
                            @if($data_peng->status == '1')
                                <td style="text-align:center">{{$no++}}</td>
                                <td>{{$data_peng->nama_hakim == null ? '-': $data_peng->nama_hakim }}</td>
                                <td>{{$data_peng->nama}}</td>
                            
                            @endif
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Tergugat</th>
            <td>
                <table width="100%">
                    <thead class="thead-light">
                        <tr style="text-align:center">
                            <th width="10%">No</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php $no=1; ?>
                            @foreach($data_p as $key=>$data_ter)
                            <tr>
                            @if($data_ter->status == '2')
                                <td style="text-align:center">{{$no++}}</td>
                                <td>{{$data_ter->nama}}</td>
                            @endif
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Kuasa Hukum Tergugat</th>
            <td>
                <table width="100%">
                    <thead class="thead-light">
                        <tr style="text-align:center">
                            <th width="10%">No</th>
                            <th>Nama</th>
                            <th>Nama Pihak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($data_ as $key=>$data_ter)
                        <tr>
                            @if($data_ter->status == '2')
                                <td style="text-align:center">{{$no++}}</td>
                                <td>{{$data_ter->nama_hakim == null ? '-': $data_ter->nama_hakim }}</td>
                                <td>{{$data_ter->nama}}</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Turut Tergugat</th>
            <td>
                <table width="100%">
                    <thead class="thead-light">
                        <tr style="text-align:center">
                            <th width="10%">No</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($data_p as $key=>$data_turut)
                        <tr>
                        @if($data_turut->status == '3')
                            <td style="text-align:center">{{$no++}}</td>
                            <td>{{$data_turut->nama}}</td>
                        @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Kuasa Hukum Turut Tergugat</th>
            <td>
                <table width="100%">
                    <thead class="thead-light">
                        <tr style="text-align:center">
                            <th width="10%">No</th>
                            <th>Nama</th>
                            <th>Nama Pihak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($data_ as $key=>$data_turut)
                        <tr>
                            @if($data_turut->status == '3')
                                <td style="text-align:center">{{$no}}</td>
                                <td>{{$data_turut->nama_hakim == null ? '-': $data_turut->nama_hakim }}</td>
                                <td>{{$data_turut->nama}}</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        @foreach($data_list as $data)
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Ringkasan Perkara</th><td style="text-align:justify;">
            <?php 
                $pecah = explode("\r\n\r\n", $data->r_perkara);
    
                // string kosong inisialisasi
                $text = "";
                
                for ($i=0; $i<=count($pecah)-1; $i++)
                {
                $part = str_replace($pecah[$i], "<p>".$pecah[$i]."</p>", $pecah[$i]);
                $text .= $part;
                }
                
                echo $text;
            ?>
            </td>
        </tr>
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Ringkasan Petitum</th><td style="text-align:justify;">
            <?php 
                $pecah = explode("\r\n\r\n", $data->r_patitum);
    
                // string kosong inisialisasi
                $text = "";
                
                for ($i=0; $i<=count($pecah)-1; $i++)
                {
                $part = str_replace($pecah[$i], "<p>".$pecah[$i]."</p>", $pecah[$i]);
                $text .= $part;
                }
                
                echo $text;
            ?>
            </td>
        </tr>
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Ringkasan Putusan</th><td style="text-align:justify;">
            <?php 
                $pecah = explode("\r\n\r\n", $data->r_putusan);
    
                // string kosong inisialisasi
                $text = "";
                
                for ($i=0; $i<=count($pecah)-1; $i++)
                {
                $part = str_replace($pecah[$i], "<p>".$pecah[$i]."</p>", $pecah[$i]);
                $text .= $part;
                }
                
                echo $text;
            ?>
            </td>
        </tr>
        <tr>
            <th style="background-color:#F4F6F6;" width="20%">Nilai Perkara</th><td>
            <?php
                if($data->ci == 2){
                    echo "US$. ".number_format($data->nilai_perkara*$data->rate,2);
                }else{
                    echo "Rp.".number_format($data->nilai_perkara,2);
                }
            ?>
            </td>
        </tr>
    @endforeach
    </thead>
    <tbody>
    </tbody>
</table>
@section('detail_umum_script')
<script type="text/javascript">
$(document).ready(function () {
        $('#reload-umum').click(function(e) {
			e.preventDefault();
			location.reload();
		});
    });
</script>
@endsection