@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Data Pajak Tahunan </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Data Pajak Tahunan</span>
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
				Tabel Data Pajak Tahunan
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',509)->limit(1)->get() as $data_akses)
						@if($data_akses->tambah == 1)
						<a href="{{ route('data_pajak.create') }}">
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
	<div class="">
			<form class="kt-form" id="search-form" >
				<div class="form-group row col-12">
					<label for="" class="col-form-label">Pencarian</label>
					<div class="col-2">
						<input class="form-control" type="text" name="pencarian" value=""  onkeypress="return hanyaAngka(event)" autocomplete='off'>
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
					<th>TAHUN</th>
					<th>BULAN</th>
					<th>PEKERJA</th>
					<th>JENIS</th>
					<th>NILAI</th>
					<th>PAJAK</th>
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
			searching: false,
			lengthChange: false,
			language: {
				processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax      : {
						url: "{{ route('data_pajak.index.json') }}",
						type : "POST",
						dataType : "JSON",
						headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
						},
						data: function (d) {
							d.pencarian = $('input[name=pencarian]').val();
						}
					},
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'tahun', name: 'tahun'},
				{data: 'bulan', name: 'bulan'},
				{data: 'pekerja', name: 'pekerja'},
				{data: 'jenis', name: 'jenis'},
				{data: 'nilai', name: 'nilai'},
				{data: 'pajak', name: 'pajak'},
			]
		});
		$('#search-form').on('submit', function(e) {
			t.draw();
			e.preventDefault();
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

		//edit 
		$('#editRow').click(function(e) {
			e.preventDefault();

			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function(){
					var tahun = $(this).attr('tahun');
					var bulan = $(this).attr('bulan');
					var nopek = $(this).attr('nopek');
					var jenis = $(this).attr('jenis');
					location.replace("{{url('perbendaharaan/data_pajak/edit')}}"+ '/' +tahun+ '/' +bulan+ '/' +nopek+ '/' +jenis);
				});
			} else {
				swalAlertInit('ubah');
			}
		});

		$('#tanggal').datepicker({
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
			// language : 'id',
			format   : 'yyyy-mm-dd'
		});

		//delete data_pajak
		$('#deleteRow').click(function(e) {
		e.preventDefault();
		if($('input[class=btn-radio]').is(':checked')) { 
			$("input[class=btn-radio]:checked").each(function() {
				var tahun = $(this).attr('tahun');
				var bulan = $(this).attr('bulan');
				var nopek = $(this).attr('nopek');
				var jenis = $(this).attr('jenis');
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
						text: "Tahun  : " +tahun+ " Bulan : " +bulan+" Nopek : "+nopek ,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
					if (result.value) {
						$.ajax({
							url: "{{ route('data_pajak.delete') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"tahun": tahun,
								"bulan": bulan,
								"jenis": jenis,
								"nopek": nopek,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : "Tahun  : " +tahun+ " Bulan : " +bulan+" Nopek : "+nopek + " Berhasil Dihapus.",
									text  : 'Berhasil',
									
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
			});
		} else {
			swalAlertInit('hapus');
		}

		});

});

function hanyaAngka(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))

	return false;
	return true;
}

</script>
@endsection