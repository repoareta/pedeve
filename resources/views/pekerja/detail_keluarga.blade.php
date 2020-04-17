<div class="kt-portlet__head-actions" style="font-size: 2rem;">
    <a href="#" id="openDetail">
        <span class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
            <i class="fas fa-plus-circle"></i>
        </span>
    </a>

    <span class="kt-font-warning pointer-link" id="editRow" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
        <i class="fas fa-edit"></i>
    </span>

    <span class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
        <i class="fas fa-times-circle"></i>
    </span>
</div>	

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Nama Keluarga</th>
            <th>Status</th>
            <th>Tempat & Tgl Lahir</th>
            <th>Agama</th>
            <th>Golongan Darah</th>
            <th>Pendidikan (Tempat)</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@section('detail_keluarga_script')
<script>
    // ini adalah script detail keluarga
</script>
@endsection