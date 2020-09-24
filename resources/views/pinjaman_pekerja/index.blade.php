@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Pinjamana Pekerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
				Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Pinjaman Pekerja</span>
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
				Tabel Pinjamana Pekerja
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',301)->limit(1)->get() as $data_akses)
						@if($data_akses->tambah == 1)
						<a href="{{ route('pinjaman_pekerja.create') }}">
							<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
						@endif

						@if($data_akses->rubah == 1 or $data_akses->lihat == 1)
						<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data Atau Lihat Data">
							<i class="fas fa-edit" id="editRow"></i>
						</span>
						@endif

						@if($data_akses->hapus == 1)
						<span style="font-size: 2em;"  class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
							<i class="fas fa-times-circle" id="deleteRow"></i>
						</span>
						@endif
						@endforeach

						<!-- <span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
							<i class="fas fa-print" id="reportRow"></i>
						</span> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
			<thead class="thead-light">
				<tr>
				<th></th>
				<th>ID PINJAMAN</th>
				<th>NOPEK</th>
				<th>NAMA</th>	
				<th>MULAI</th>
				<th>SAMPAI</th>
				<th>TENOR</th>
				<th>ANGSURAN</th>
				<th>TOTAL PINJAMAN</th>
				<th>SISA PINJAMAN</th>
				<th>NO KONTRAK</th>
				<th>CAIR</th>
				<th>LUNAS</th>
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
			searching: true,
			lengthChange: true,
			language: {
			processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax      : {
				url: "{{route('pinjaman_pekerja.search.index')}}",
				type : "POST",
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				data: function (d) {
					d.nopek = $('input[name=nopek]').val();
				}
			},
			columns: [
				{data: 'radio', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'id_pinjaman', name: 'id_pinjaman'},
				{data: 'nopek', name: 'nopek'},
				{data: 'namapegawai', name: 'namapegawai'},
				{data: 'mulai', name: 'mulai'},
				{data: 'sampai', name: 'sampai'},
				{data: 'tenor', name: 'tenor'},
				{data: 'angsuran', name: 'angsuran'},
				{data: 'jml_pinjaman', name: 'jml_pinjaman'},
				{data: 'curramount', name: 'curramount'},
				{data: 'no_kontrak', name: 'no_kontrak'},
				{data: 'cair', name: 'cair'},
				{data: 'lunas', name: 'lunas'},
			]
			
	});
	$('#search-form').on('submit', function(e) {
		t.draw();
		e.preventDefault();
	});

	//edit 
	$('#editRow').click(function(e) {
		e.preventDefault();

		if($('input[class=btn-radio]').is(':checked')) { 
			$("input[class=btn-radio]:checked").each(function(){
				var id = $(this).attr('id_pinjaman');
				location.replace("{{url('sdm/pinjaman_pekerja/edit')}}"+ '/' +id);
			});
		} else {
			swalAlertInit('ubah');
		}
	});

	//delete
	$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function() {
					var id_pinjaman = $(this).attr('id_pinjaman');
					var cair = $(this).attr('cair');
					// delete stuff
					if(cair == 'Y'){
						Swal.fire({
									type  : 'info',
									title : 'Status cair tidak bisa dihapus.',
									text  : 'Info',
								});
					}else{
						const swalWithBootstrapButtons = Swal.mixin({
							customClass: {
								confirmButton: 'btn btn-primary',
								cancelButton: 'btn btn-danger'
							},
								buttonsStyling: false
							})
							swalWithBootstrapButtons.fire({
								title: "Data yang akan dihapus?",
								text: "ID Pinjaman : " + id_pinjaman,
								type: 'warning',
								showCancelButton: true,
								reverseButtons: true,
								confirmButtonText: 'Ya, hapus',
								cancelButtonText: 'Batalkan'
							})
							.then((result) => {
							if (result.value) {
								$.ajax({
									url: "{{ route('pinjaman_pekerja.delete') }}",
									type: 'DELETE',
									dataType: 'json',
									data: {
										"id_pinjaman": id_pinjaman,
										"_token": "{{ csrf_token() }}",
									},
									success: function () {
										Swal.fire({
											type  : 'success',
											title : 'Hapus ID Pinjaman ' + id_pinjaman,
											text  : 'Berhasil',
											timer : 2000
										}).then(function() {
											location.reload();
										});
									},
									error: function () {
										alert("Terjadi kesalahan, coba lagi nanti");
									}
								});
							}
						});
					}
				});
			} else {
				swalAlertInit('hapus');
			}
			
		});


});
</script>
@endsection