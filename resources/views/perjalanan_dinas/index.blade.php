@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Panjar Dinas </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perjalanan Dinas </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
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
				Tabel Umum Panjar Dinas
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">

		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable">
			<thead>
				<tr>
					<th></th>
					<th>No. Panjar</th>
					<th>No. UMK</th>
					<th>Jenis</th>
					<th>Mutasi</th>
					<th>Mulai</th>
					<th>Sampai</th>
					<th>Dari</th>
					<th>Tujuan</th>
					<th>Nopek</th>
					<th>Keterangan</th>
					<th>Nilai</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Hehe</td>
					<td>Hehe</td>
					<td>Hehe</td>
					<td>Hehe</td>
					<td>Hehe</td>
					<td>Hehe</td>
					<td>Hehe</td>
					<td>Hehe</td>
					<td>Hehe</td>
					<td>Hehe</td>
					<td>Hehe</td>
					<td>Hehe</td>
				</tr>
			</tbody>
		</table>

		<!--end: Datatable -->
	</div>
</div>
</div>
@endsection