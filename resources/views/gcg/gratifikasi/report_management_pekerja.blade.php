<!--begin: Datatable -->
<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
    <thead class="thead-light">
        <tr>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Tgl Penerimaan</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Pemberi</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gratifikasi_list as $gratifikasi)
            <tr>
                <td>{{ $gratifikasi->pekerja->nama }}</td>
                <td>{{ $gratifikasi->pekerja->jabatan_latest_one->kode_jabatan_new->keterangan }}</td>
                <td>{{ Carbon\Carbon::parse($gratifikasi->tgl_gratifikasi)->translatedFormat('d F Y') }}</td>
                <td>{{ $gratifikasi->bentuk }}</td>
                <td>{{ $gratifikasi->jumlah }}</td>
                <td>{{ $gratifikasi->pemberi }}</td>
                <td>{{ $gratifikasi->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable -->