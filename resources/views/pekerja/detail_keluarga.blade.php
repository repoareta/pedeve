<div class="kt-portlet__head" style="padding-left:0px;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Keluarga
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRow" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRow" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
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