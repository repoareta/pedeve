@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Master Beban Perusahaan </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					SDM & Payroll 
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Master Beban Perusahaan</span>
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
				Tabel Master Beban Perusahaan
			</h3>

			<div class="kt-portlet__head-actions" style="font-size: 2rem">
				@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',301)->limit(1)->get() as $data_akses)
				@if($data_akses->tambah == 1)
				<a href="{{ route('beban_perusahaan.create') }}">
					<span class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
						<i class="fas fa-plus-circle"></i>
					</span>
				</a>
				@endif

				@if($data_akses->rubah == 1 or $data_akses->lihat == 1)
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
		<div class="col-12">
			<form class="kt-form" id="search-form" method="POST">
				<div class="form-group row">
					<label for="" class="col-form-label">No. Pegawai</label>
					<div class="col-3">
						<select class="form-control kt-select2" name="no_pekerja" id="no_pekerja">
							<option value="">- Pilih Pegawai -</option>
							@foreach ($pekerja_list as $pekerja)
								<option value="{{ $pekerja->nopeg }}">{{ $pekerja->nopeg.' - '.$pekerja->nama }}</option>
							@endforeach
						</select>
					</div>

					<label for="spd-input" class="col-form-label">Bulan</label>
					<div class="col-2">
						<select class="form-control kt-select2" name="bulan" id="bulan">
							<option value="">- Pilih Bulan -</option>
							<option value="1">Januari</option>
							<option value="2">Februari</option>
							<option value="3">Maret</option>
							<option value="4">April</option>
							<option value="5">Mei</option>
							<option value="6">Juni</option>
							<option value="7">Juli</option>
							<option value="8">Agustus</option>
							<option value="9">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
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
					<th>Bulan</th>
					<th>Pegawai</th>
					<th>AARD</th>
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
				url: "{{ route('beban_perusahaan.index.json') }}",
				data: function (d) {
					d.no_pekerja = $('select[name=no_pekerja]').val();
					d.bulan = $('select[name=bulan]').val();
					d.tahun = $('select[name=tahun]').val();
				}
			},
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'bulan_tahun', name: 'bulan_tahun'},
				{data: 'pekerja', name: 'pekerja'},
				{data: 'aard', name: 'aard'},
				{data: 'nilai', name: 'nilai'}
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
					var tahun = $(this).val().split("-")[0];
					var bulan = $(this).val().split("-")[1];
					var nopek = $(this).val().split("-")[2];
					var aard = $(this).val().split("-")[3];

					var url = '{{ route("beban_perusahaan.edit", [
						":tahun",
						":bulan",
						":nopek",
						":aard"
					]) }}';
					// go to page edit
					window.location.href = url
					.replace(':tahun', tahun)
					.replace(':bulan', bulan)
					.replace(':nopek', nopek)
					.replace(':aard', aard);
				});
			} else {
				swalAlertInit('ubah');
			}
		});

		$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var tahun = $(this).val().split("-")[0];
					var bulan = $(this).val().split("-")[1];
					var nopek = $(this).val().split("-")[2];
					var aard = $(this).val().split("-")[3];
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
						text: "Nopek : " + nopek + " AARD : " + aard,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('beban_perusahaan.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"tahun": tahun,
									"bulan": bulan,
									"nopek": nopek,
									"aard" : aard,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : "Hapus Nopek : " + nopek + " AARD : " + aard,
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