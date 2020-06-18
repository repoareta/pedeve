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
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
	<div class="col-12">
			<form class="kt-form" id="search-form" >
				<div class="form-group row">
					<label for="" class="col-form-label">Tanggal</label>
					<div class="col-2">
						<input class="form-control" type="text" name="tanggal" value="" id="tanggal" onkeypress="return hanyaAngka(event)" autocomplete='off'>
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
	searching: false,
	lengthChange: false,
	language: {
		processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
	},
	ajax      : {
				url: "{{ route('informasi_saldo.index.json') }}",
				type : "POST",
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				data: function (d) {
					d.tanggal = $('input[name=tanggal]').val();
				}
			},
	columns: [
		{data: 'action', name: 'action'},
		{data: 'kodestore', name: 'kodestore'},
		{data: 'ak', name: 'ak'},
	]
});
$('#search-form').on('submit', function(e) {
	t.draw();
	e.preventDefault();
});

$('#tanggal').datepicker({
	todayHighlight: true,
	orientation: "bottom left",
	autoclose: true,
	// language : 'id',
	format   : 'yyyy-mm-dd'
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