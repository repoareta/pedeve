@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Setting Bulan Kontroller </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kontroler </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Setting Bulan Kontroller</span>
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
				Tabel Setting Bulan Kontroller
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',206)->limit(1)->get() as $data_akses)
						@if($data_akses->tambah == 1)
						<a href="{{ route('bulan_kontroler.create') }}">
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
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>TAHUN-BULAN</th>
					<th>STATUS</th>
					<th>OPENDATE</th>
					<th>STOPDATE</th>
					<th>CLOSEDATE</th>
					<th>KETERANGAN</th>
					<th>SUPLESI</th>
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
						url: "{{ route('bulan_kontroler.search.index') }}",
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
				{data: 'radio', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'thnbln', name: 'thnbln'},
				{data: 'nama_status', name: 'nama_status'},
				{data: 'data_buka', name: 'data_buka'},
				{data: 'data_stop', name: 'data_stop'},
				{data: 'data_tutup', name: 'data_tutup'},
				{data: 'description', name: 'description'},
				{data: 'suplesi', name: 'suplesi'},
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

		$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function() {
					var kode = $(this).attr('kode');
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
							text: "Tahun-Bulan  : " +kode,
							type: 'warning',
							showCancelButton: true,
							reverseButtons: true,
							confirmButtonText: 'Ya, hapus',
							cancelButtonText: 'Batalkan'
						})
						.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('bulan_kontroler.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"kode": kode,
									"_token": "{{ csrf_token() }}",
								},
								success: function (data) {
									Swal.fire({
										type  : 'success',
										title : "Data Setting Bulan Kontroller dengan kode  : " +kode+" Berhasil Dihapus.",
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

		//edit 
		$('#editRow').click(function(e) {
			e.preventDefault();

			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function(){
					var no = $(this).attr('kode');
					location.replace("{{url('kontroler/bulan_kontroler/edit')}}"+ '/' +no);
				});
			} else {
				swalAlertInit('ubah');
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