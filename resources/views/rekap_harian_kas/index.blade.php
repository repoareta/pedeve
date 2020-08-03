@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Rekap Harian Kas/Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Rekap Harian Kas/Bank</span>
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
				Tabel Rekap Harian Kas/Bank
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{ route('rekap_harian_kas.create') }}">
							<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
						<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
							<i class="fas fa-edit" id="editRow"></i>
						</span>

						<span style="font-size: 2em;"  class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
							<i class="fas fa-times-circle" id="deleteRow"></i>
						</span>

						<span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
							<i class="fas fa-print" id="exportRow"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
	<div class="">
			<form class="kt-form" id="search-form" >
				<div class="form-group row col-12">
					<label for="" class="col-form-label">No. Kas</label>
					<div class="col-2">
						<input class="form-control" type="text" name="nokas" value="" size="6" maxlength="6" onkeypress="return hanyaAngka(event)" autocomplete='off'>
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
				<th>JK</th>
				<th>NO.KAS</th>
				<th>NO</th>
				<th>TGL.REKAP</th>
				<th>SALDO AWAL</th>
				<th>DEBET</th>
				<th>KREDIT</th>
				<th>SALDO AKHIR</th>
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
						url: "{{ route('rekap_harian_kas.search.index') }}",
						type : "POST",
						dataType : "JSON",
						headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
						},
						data: function (d) {
							d.nama = $('input[name=nokas]').val();
						}
					},
			columns: [
				{data: 'radio', name: 'radio'},
				{data: 'jk', name: 'jk'},
				{data: 'store', name: 'store'},
				{data: 'no', name: 'no'},
				{data: 'tglrekap', name: 'tglrekap'},
				{data: 'saldoawal', name: 'saldoawal'},
				{data: 'debet', name: 'debet'},
				{data: 'kredit', name: 'kredit'},
				{data: 'saldoakhir', name: 'saldoakhir'},
			]
		});
		$('#search-form').on('submit', function(e) {
			t.draw();
			e.preventDefault();
		});

		$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function() {
					var tanggal = $(this).attr('tanggal');
					var jk = $(this).attr('jk');
					var nokas = $(this).attr('nokas');
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
							text: "Tanggal  : " +tanggal+ " Nokas : " +nokas,
							type: 'warning',
							showCancelButton: true,
							reverseButtons: true,
							confirmButtonText: 'Ya, hapus',
							cancelButtonText: 'Batalkan'
						})
						.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('rekap_harian_kas.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"tanggal": tanggal,
									"jk": jk,
									"nokas": nokas,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : "Data Kas Bank Tanggal  : " +tanggal+ " Nokas : " +nokas+ " Berhasil Dihapus.",
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
					var tgl = $(this).attr('tanggal');
					var id = $(this).attr('jk');
					var no = $(this).attr('nokas');
					location.replace("{{url('perbendaharaan/rekap_harian_kas/edit')}}"+ '/' +no+'/'+id+'/'+tgl);
				});
			} else {
				swalAlertInit('ubah');
			}
		});
		//edit 
		$('#exportRow').click(function(e) {
			e.preventDefault();

			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function(){
					var id = $(this).attr('jk');
					var no = $(this).attr('nokas');
					var tanggal = $(this).attr('tanggal');
					location.replace("{{url('perbendaharaan/rekap_harian_kas/rekap')}}"+ '/' +no+'/'+id+'/'+tanggal);
				});
			} else {
				swalAlertInit('cetak');
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