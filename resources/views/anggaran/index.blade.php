@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Anggaran </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum 
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Anggaran</span>
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
				Tabel Umum Anggaran
			</h3>

			<div class="kt-portlet__head-actions" style="font-size: 2rem">
				@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',742)->limit(1)->get() as $data_akses)
				@if($data_akses->tambah == 1)
				<a href="{{ route('anggaran.create') }}">
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

				{{-- <span class="kt-font-info pointer-link" id="exportRow" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
					<i class="fas fa-print"></i>
				</span> --}}
			</div>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
				@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',742)->limit(1)->get() as $data_akses)
				@if($data_akses->cetak == 1)
					<form action="{{ route('anggaran.rekap.export') }}" class="form-inline kt-form" method="POST" target="_blank">
						@csrf
						<div class="form-group">
							<div class="input-group">
								<select class="form-control kt-select2" name="tahun_cetak" id="tahun_cetak">
									<option value="">- Pilih Tahun -</option>
									@foreach ($tahun as $key => $row)
										<option value="{{ $row->tahun }}"
											@if($key == 0)
												selected
											@endif
										>{{ $row->tahun }}</option>
									@endforeach
								</select>
								<div class="input-group-append">
									<button class="btn btn-danger" type="submit">
										<i class="fa fa-file-pdf" style="color: #ffffff;"></i> Cetak Anggaran .PDF
									</button>
								</div>
							</div>
						</div>
					</form>
				@endif
				@endforeach
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="col-12">
			<form class="kt-form" id="search-form" method="POST">
				<div class="form-group row">
					<label for="" class="col-form-label">Kode Anggaran</label>
					<div class="col-2">
						<input class="form-control" type="text" name="kode_anggaran" id="kode_anggaran">
					</div>
	
					<label for="" class="col-form-label">Tahun</label>
					<div class="col-2">
						<select class="form-control kt-select2" name="tahun" id="tahun">
							<option value="">- Pilih Tahun -</option>
							@foreach ($tahun as $key => $row)
								<option value="{{ $row->tahun }}"
									@if($key == 0)
										selected
									@endif
								>{{ $row->tahun }}</option>
							@endforeach
						</select>
					</div>
	
					<div class="col-2">
						<button type="submit" class="btn btn-brand"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
					</div>
				</div>
			</form>
		</div>
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>Kode</th>
					<th>Nama Master</th>
					<th>Tahun</th>
					<th>Nilai</th>
					<th>Realisasi</th>
					<th>Sisa</th>
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
		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});

		var t = $('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			ajax      : {
				url: "{{ route('anggaran.index.json') }}",
				data: function (d) {
					d.kode_anggaran = $('input[name=kode_anggaran]').val();
					d.tahun = $('select[name=tahun]').val();
				}
			},
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'kode_main', name: 'kode_main', class:'no-wrap'},
				{data: 'nama_main', name: 'nama_main'},
				{data: 'tahun', name: 'tahun'},
				{data: 'nilai_real', name: 'nilai_real'},
				{data: 'realisasi', name: 'realisasi', class:'no-wrap'},
				{data: 'sisa', name: 'sisa', class:'no-wrap'}
			]
		});

		$('#search-form').on('submit', function(e) {
			t.draw();
			e.preventDefault();
		});

		$('#editRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).val().split("/").join("-");
					var url = '{{ route("anggaran.edit", ":kode_main") }}';
					// go to page edit
					window.location.href = url.replace(':kode_main',id);
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
						text: "Kode : " + id,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('anggaran.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"id": id,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : 'Hapus Anggaran ' + id,
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

		$('#exportRow').click(function(e) {
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

	});
	</script>
@endsection