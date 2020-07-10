@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Implementasi GCG </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
                    Gratifikasi 
                </a>
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
				Gratifikasi
			</h3>
			
			<div class="kt-portlet__head-actions">
				<div class="btn-group" role="group" aria-label="Basic example">
					<a name="" id="" class="btn btn-primary" href="#" role="button">Outstanding</a>
					<a name="" id="" class="btn btn-primary" href="#" role="button">Penerimaan</a>
					<a name="" id="" class="btn btn-primary" href="#" role="button">Pemberian</a>
					<a name="" id="" class="btn btn-primary" href="#" role="button">Permintaan</a>
					<a name="" id="" class="btn btn-primary" href="#" role="button">Report</a>
				</div>
			</div>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
			<thead class="thead-light">
				<tr>
					<th>Nopek</th>
					<th>Nama</th>
					<th>Tgl</th>
					<th>Jenis</th>
					<th>Jumlah</th>
					<th>Pemberi</th>
					<th>Keterangan</th>
					<th>Status</th>
					<th>NIHIL</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Nopek 1</td>
					<td>Nama 1</td>
					<td>Tgl 1</td>
					<td>Jenis 1</td>
					<td>Jumlah 1</td>
					<td>Pemberi 1</td>
					<td>Keterangan 1</td>
					<td>Status 1</td>
					<td>NIHIL 1</td>
					<td>Type 1</td>
					<td>Action 1</td>
				</tr>
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
		$('#kt_table').DataTable();
	});
	</script>
@endsection