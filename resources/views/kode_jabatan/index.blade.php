@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Master Data </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					SDM & Payroll
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Kode Jabatan</span>
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
				Tabel Master Data Kode Jabatan
			</h3>
			
			<div class="kt-portlet__head-actions" style="font-size: 2rem;">
				@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',600)->limit(1)->get() as $data_akses)
				@if($data_akses->tambah == 1)
				<a href="{{ route('kode_jabatan.create') }}">
					<span class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
						<i class="fas fa-plus-circle"></i>
					</span>
				</a>
				@endif

				@if($data_akses->rubah == 1 or $data_akses->lihat == 1)
				<span class="kt-font-warning pointer-link" id="editRow" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data Atau Lihat Data">
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
					<th>Kode & Nama Bagian</th>
					<th>Kode Jabatan</th>
					<th>Nama Jabatan</th>
					<th>Golongan</th>
					<th>Tunjangan</th>
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
			ajax      : "{{ route('kode_jabatan.index.json') }}",
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button', width: '10'},
				{data: 'kdbag', name: 'kdbag', class:'no-wrap'},
				{data: 'kdjab', name: 'kdjab', class:'no-wrap'},
				{data: 'keterangan', name: 'keterangan', class:'no-wrap'},
				{data: 'goljob', name: 'goljob', class:'no-wrap'},
				{data: 'tunjangan', name: 'tunjangan', class:'no-wrap text-right'}
			]
		});
		$('#kt_table tbody').on( 'click', 'tr', function (event) {
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
			} else {
				t.$('tr.selected').removeClass('selected');
				// $(':radio', this).trigger('click');
				if (event.target.type !== 'radio') {
					$(':radio', this).trigger('click');
				}
				$(this).addClass('selected');
			}
		} );

		

		$('#editRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var kode_bagian = $(this).val().split("-")[0];
					var kode_jabatan = $(this).val().split("-")[1];
					
					var url = '{{ route("kode_jabatan.edit", [":kode_bagian", ":kode_jabatan"]) }}';
					// go to page edit
					window.location.href = url
					.replace(':kode_bagian', kode_bagian)
					.replace(':kode_jabatan', kode_jabatan);
				});
			} else {
				swalAlertInit('ubah');
			}
		});

		$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var kode_bagian = $(this).val().split("-")[0];
					var kode_jabatan = $(this).val().split("-")[1];
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
						text: "Kode Jabatan : " + kode_jabatan,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('kode_jabatan.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"kode_bagian": kode_bagian,
									"kode_jabatan": kode_jabatan,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : 'Hapus Kode Jabatan: ' + kode_jabatan,
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