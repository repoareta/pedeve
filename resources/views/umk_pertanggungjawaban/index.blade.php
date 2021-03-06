@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Uang Muka Kerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Uang Muka Kerja</span>
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
				Tabel Umum Pertanggungjawaban UMK
			</h3>

			<div class="kt-portlet__head-actions" style="font-size: 2rem;">
				@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',741)->limit(1)->get() as $data_akses)
				@if($data_akses->tambah == 1)
				<a href="{{ route('uang_muka_kerja.pertanggungjawaban.create') }}">
					<span class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
						<i class="fas fa-plus-circle"></i>
					</span>
				</a>
				@endif

				@if($data_akses->rubah == 1)
				<span id="editRow" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
					<i class="fas fa-edit"></i>
				</span>
				@endif

				@if($data_akses->hapus == 1)
				<span id="deleteRow" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
					<i class="fas fa-times-circle"></i>
				</span>
				@endif

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
		<form class="kt-form" id="search-form" method="POST">
			<div class="form-group row">
				<label for="spd-input" class="col-1 col-form-label">No. PUMK</label>
				<div class="col-2">
					<input class="form-control" type="text" name="no_pumk" id="no_pumk">
				</div>

				<label for="spd-input" class="col-form-label">Bulan</label>
				<div class="col-2">
					<select class="form-control kt-select2" name="bulan" id="bulan">
						<option value="">- Pilih Bulan -</option>
						<option value="01">Januari</option>
						<option value="02">Februari</option>
						<option value="03">Maret</option>
						<option value="04">April</option>
						<option value="05">Mei</option>
						<option value="06">Juni</option>
						<option value="07">Juli</option>
						<option value="08">Agustus</option>
						<option value="09">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
				</div>

				<label for="spd-input" class="col-form-label">Tahun</label>
				<div class="col-2">
					<select class="form-control kt-select2" name="tahun" id="tahun">
						<option value="">- Pilih Tahun -</option>
						@foreach ($tahun as $row)
							<option value="{{ $row->year }}">{{ $row->year }}</option>
						@endforeach
					</select>
				</div>

				<div class="col-2">
					<button type="submit" class="btn btn-brand"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
				</div>
			</div>
		</form>
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>No. PUMK</th>
					<th>No. UMK</th>
					<th>No. Kas/Bank</th>
					<th>Pegawai</th>
					<th>Keterangan</th>
					<th>Nilai</th>
					<th>Approval</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

		<!--end: Datatable -->
	</>
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
			// mengganti search dengan pagination
			// dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'p>>" +
			// 	 "<'row'<'col-sm-12't>>" +
			// 	 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			searching : false,
			scrollX   : true,
			processing: true,
			serverSide: true,
			ajax      : {
				url: "{{ route('uang_muka_kerja.pertanggungjawaban.index.json') }}",
				data: function (d) {
					d.no_pumk = $('input[name=no_pumk]').val();
					d.bulan = $('select[name=bulan]').val();
					d.tahun = $('select[name=tahun]').val();
				}
			},
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'no_pumk', name: 'no_pumk'},
				{data: 'no_umk', name: 'no_umk'},
				{data: 'no_kas', name: 'no_kas'},
				{data: 'nama', name: 'nama'},
				{data: 'keterangan', name: 'keterangan'},
				{data: 'nilai', name: 'nilai', class:'text-right'},
				{data: 'approval', name: 'approval', class:'text-center'}
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
					// go to page edit
					url = "{{ route('uang_muka_kerja.pertanggungjawaban.edit', [
						'no_pumk' => ':no_pumk'
					]) }}";

					window.location.href = url.replace(':no_pumk', id);
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
						text: "No. P UMK : " + id,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('uang_muka_kerja.pertanggungjawaban.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"id": id,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : 'Hapus P UMK ' + id,
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
						text: "No. PUMK : " + id,
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
							var url = "{{ url('umum/uang_muka_kerja/pertanggungjawaban/export') }}" + '/' + id;
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