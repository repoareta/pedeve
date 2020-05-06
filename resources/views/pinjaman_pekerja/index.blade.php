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
				Tabel Umum Pinjamana Pekerja
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{ route('perjalanan_dinas.create') }}">
							<span style="font-size: 2em;" class="kt-font-success">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
		
						<a href="#">
							<span style="font-size: 2em;" class="kt-font-warning">
								<i class="fas fa-edit"></i>
							</span>
						</a>
		
						<a href="#">
							<span style="font-size: 2em;" class="kt-font-danger">
								<i class="fas fa-times-circle"></i>
							</span>
						</a>

						<a href="#">
							<span style="font-size: 2em;" class="kt-font-info">
								<i class="fas fa-file-export"></i>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">

	<form id="search-form">
			No. Pekerja: 	<input style="width:10%;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="nopek" type="text"  value=""  autocomplete='off'>  
				<button type="submit" style="font-size: 20px;margin-left:5px;border-radius:10px;border-radius:10px;background-color:white;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cari Data"> <i class="fa fa-search"></i></button>  
				
		</form>
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
			searching: false,
			lengthChange: false,
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
				{data: 'radio', name: 'radio'},
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
	});
	</script>
@endsection