@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Customer Management </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Perusahaan Afiliasi</span>
			</div>
		</div>
	</div>
</div>
<!-- end:: Subheader -->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
			<h3 class="kt-portlet__head-title">
				Perusahaan Afiliasi
			</h3>
			<div class="kt-portlet__head-actions" style="font-size: 2rem;">
				@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',802)->limit(1)->get() as $data_akses)
				@if($data_akses->tambah == 1)
				<a href="{{ route('perusahaan_afiliasi.create') }}">
					<span class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
						<i class="fas fa-plus-circle"></i>
					</span>
				</a>
				@endif

				@if($data_akses->rubah == 1)
				<span class="kt-font-warning pointer-link" id="editRow" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
					<i class="fas fa-edit"></i>
				</span>
				@endif

				@if($data_akses->hapus == 1)
				<span class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
					<i class="fas fa-times-circle"></i>
				</span>
				@endif
				@endforeach
			</div>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">

		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>Perusahaan</th>
					<th>Telepon</th>
					<th>Alamat</th>
					<th>Bidang Usaha</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

		<!--end: Datatable -->
	</div>
</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		var t = $('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			ajax      : "{{ route('perusahaan_afiliasi.index.json') }}",
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button', width:'5px', class:'text-center radio-button'},
				{data: 'nama', name: 'nama', class:'no-wrap'},
				{data: 'telepon', name: 'telepon'},
				{data: 'alamat', name: 'alamat'},
				{data: 'bidang_usaha', name: 'bidang_usaha'}
			]
		});

		$('#editRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).val().split("/").join("-");
					var url = '{{ route("perusahaan_afiliasi.edit", ":no_panjar") }}';
					// go to page edit
					window.location.href = url.replace(':no_panjar',id);
				});
			} else {
				swalAlertInit('ubah');
			}
		});

		$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).val();
					var nama = $(this).attr('nama');
					// delete stuff
					const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-primary',
						cancelButton: 'btn btn-danger'
					},
						buttonsStyling: false
					})

					swalWithBootstrapButtons.fire({
						title: "Data yang akan dihapus?",
						text: "Nama Perusahaan : " + nama,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('perusahaan_afiliasi.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"id": id,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : 'Hapus Perusahaan ' + nama,
										text  : 'Berhasil',
										timer : 2000
									}).then(function() {
										t.ajax.reload();
									});
								},
								error: function () {
									alert("Terjadi kesalahan, coba lagi nanti");
								}
							});
						}
					});
				});
			} else {
				swalAlertInit('hapus');
			}
		});		
	});
	</script>
@endsection