@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Informasi Saldo </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Informasi Saldo</span>
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
				Tabel Informasi Saldo
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{ route('penerimaan_kas.createmp') }}">
							<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
		
						<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
							<i class="fas fa-edit" id="editRow"></i>
						</span>
		
						<span style="font-size: 2em;" class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
							<i class="fas fa-times-circle"></i>
						</span>

						<!-- <span style="font-size: 2em;" class="kt-font-info pointer-link" id="exportRow" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
							<i class="fas fa-print"></i>
						</span> -->
						<span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Refresh Ketampilan Tabel Awal">
							<i class="fas fa-sync-alt" id="show-data"></i>
						</span>
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
					<th>Kas-JK</th>
					<th>Saldo</th>
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
	ajax      : "{{ route('informasi_saldo.index.json') }}",
	columns: [
		{data: 'action', name: 'action'},
		{data: 'nama', name: 'nama'},
		{data: 'norek', name: 'norek'},
	]
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