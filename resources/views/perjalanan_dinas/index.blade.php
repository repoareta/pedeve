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
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Perjalanan Dinas</span>
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
				Tabel Umum Panjar Dinas
			</h3>
			<div class="kt-portlet__head-actions" style="font-size: 2rem;">
				@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',703)->limit(1)->get() as $data_akses)
				@if($data_akses->tambah == 1)
				<a href="{{ route('perjalanan_dinas.create') }}">
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

				{{-- <span class="kt-font-info pointer-link" id="exportRowData" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
					<i class="fas fa-print"></i>
				</span> --}}
				
				@if($data_akses->cetak == 1)
				<span class="kt-font-info pointer-link" id="exportRow" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
					<i class="fas fa-print"></i>
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
					<th>No. Panjar</th>
					<th>No. UMK</th>
					<th>Jenis</th>
					<th>Mulai</th>
					<th>Sampai</th>
					<th>Dari</th>
					<th>Tujuan</th>
					<th>Nopek</th>
					<th>Keterangan</th>
					<th>Nilai</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

		<!--end: Datatable -->
	</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Cetak Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="{{ route('perjalanan_dinas.export') }}" method="POST" id="formCetakData" target="_blank">
				<div class="modal-body">
					@csrf
					<div class="form-group row">
						<label for="" class="col-2 col-form-label">Nomor Panjar</label>
						<div class="col-10">
							<input class="form-control" type="text" readonly name="no_panjar_dinas" id="no_panjar_dinas">
						</div>
					</div>

					<div class="form-group row">
						<label for="" class="col-2 col-form-label">Atasan Ybs</label>
						<div class="col-10">
							<input class="form-control" type="text" name="atasan_ybs" id="atasan_ybs">
						</div>
					</div>
					
                    <div class="form-group row">
						<label for="" class="col-2 col-form-label">Menyetujui</label>
						<div class="col-10">
							<input class="form-control" type="text" name="menyetujui" id="menyetujui">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="" class="col-2 col-form-label">Sekr. Perseroan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="sekr_perseroan" id="sekr_perseroan">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="" class="col-2 col-form-label">Keuangan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="keuangan" id="keuangan">
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Batal</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Cetak Data</button>
				</div>
			</form>
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
			ajax      : "{{ route('perjalanan_dinas.index.json') }}",
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'no_panjar', name: 'no_panjar', class:'no-wrap'},
				{data: 'no_umk', name: 'no_umk'},
				{data: 'jenis_dinas', name: 'jenis'},
				{data: 'mulai', name: 'mulai', class:'no-wrap'},
				{data: 'sampai', name: 'sampai', class:'no-wrap'},
				{data: 'dari', name: 'dari', class:'no-wrap'},
				{data: 'tujuan', name: 'tujuan', class:'no-wrap'},
				{data: 'nopek', name: 'nopek', class:'no-wrap'},
				{data: 'keterangan', name: 'keterangan'},
				{data: 'nilai', name: 'nilai', class:'text-right no-wrap'}
			]
		});

		

		$('#editRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).val().split("/").join("-");
					var url = '{{ route("perjalanan_dinas.edit", ":no_panjar") }}';
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
						text: "No. Panjar : " + id,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('perjalanan_dinas.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"id": id,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : 'Hapus No. Panjar ' + id,
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

		$('#exportRowData').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).val();
					
					const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-primary',
						cancelButton: 'btn btn-danger'
					},
						buttonsStyling: false
					})

					swalWithBootstrapButtons.fire({
						title: "Data yang akan dicetak?",
						text: "No. Panjar : " + id,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Cetak',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
						if (result.value) {
							var id = $(this).val().split("/").join("-");
							// go to page edit
							var url = "{{ url('umum/perjalanan_dinas/export') }}" + '/' + id;
							window.open(url, '_blank');
						}
					});
				});
			} else {
				swalAlertInit('cetak');
			}
		});

		$('#exportRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).val();

					// str.replace("Microsoft", "W3Schools");

					// open modal
					$('#cetakModal').modal('show');

					// fill no_panjar to no_panjar field
					$('#no_panjar_dinas').val(id);
				});
			} else {
				swalAlertInit('cetak');
			}
		});
	});
	</script>
@endsection