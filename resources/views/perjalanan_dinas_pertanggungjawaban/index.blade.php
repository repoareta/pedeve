@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Panjar Dinas </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Pertanggungjawaban Perjalanan Dinas</span>
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
				Tabel Umum Pertanggungjawaban Panjar Dinas
			</h3>			
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<a href="{{ route('perjalanan_dinas.pertanggungjawaban.create') }}">
						<span style="font-size: 2em;" class="kt-font-success">
							<i class="fas fa-plus-circle"></i>
						</span>
					</a>
	
					<a href="#" id="editRow">
						<span style="font-size: 2em;" class="kt-font-warning">
							<i class="fas fa-edit"></i>
						</span>
					</a>
	
					<a href="#" id="deleteRow">
						<span style="font-size: 2em;" class="kt-font-danger">
							<i class="fas fa-times-circle"></i>
						</span>
					</a>

					<a href="#">
						<span style="font-size: 2em;" class="kt-font-info">
							<i class="fas fa-file-export"></i>
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">

		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>No. PJ Panjar</th>
					<th>No. Panjar</th>
					<th>Tanggal</th>
					<th>Nopek</th>
					<th>Keterangan</th>
					<th>Jumlah</th>
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
			language: {
            	processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax      : "{{ route('perjalanan_dinas.pertanggungjawaban.index.json') }}",
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false},
				{data: 'no_ppanjar', name: 'no_ppanjar'},
				{data: 'no_panjar', name: 'no_panjar'},
				{data: 'tgl_ppanjar', name: 'tgl_ppanjar'},
				{data: 'nopek', name: 'nopek'},
				{data: 'keterangan', name: 'keterangan'},
				{data: 'jmlpanjar', name: 'jmlpanjar'},
			]
		});

		$('#editRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).val().split("/").join("-");
					// go to page edit
					window.location.href = "{{ url('umum/perjalanan_dinas/edit') }}" + '/' + id;
				});
			} else {
				swal({
					title: "Tandai baris yang akan dihapus!",
					type: "success"
				}) ; 
			}
		});

		$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).val();
					// delete stuff
					swal({
						title: "Data yang akan di hapus?",
						text: "No. Panjar : " + id,
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								url: "{{ route('perjalanan_dinas.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"id": id,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									swal({
											title: "Delete",
											text: "Success",
											type: "success"
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
				swal({
					title: "Tandai baris yang akan dihapus!",
					type: "success"
				}) ; 
			}
		});

	});
	</script>
@endsection