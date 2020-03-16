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
					Uang Muka Kerja </a>
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
				Tabel Uang Muka Kerja
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
			<span class="kt-section__info">
                               <div style="padding-left:25px;float:left;font-weight:bold; font-size:20px" id="btn-tombol">
                                <a style="color:blue;" href="{{ route('create_uang_muka_kerja.create') }}" id="btn-tambah-umk" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon flaticon2-plus-1"></span></a>
                                <a style="color:green;" href="#" id="btn-edit-umk" data-id="1" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon flaticon2-writing"></span></a>
                                <a style="color:red;" href="#"  id="btn-delete-umk" class=""><span class="kt-menu__link-icon flaticon2-delete"></span></a>
                                <a style="color:yellow;" href="#" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon flaticon2-search-1"></span></a>
                                <a style="color:blue;" href="#"  class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon flaticon2-download-2"></span></a>
                                </div>
						</span>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="card-body table-responsive">
		<!--begin: Datatable -->
		<table id="data-umk-table" class="table table-striped table-hover table-bordered">
			<thead bgcolor="#483D8B">
				<tr>
					<th style="color:#ffffff"></th>
					<th style="color:#ffffff">Tanggal</th>
					<th style="color:#ffffff">No UMK</th>
					<th style="color:#ffffff">No Kas/Bank</th>
					<th style="color:#ffffff">Jenis</th>
					<th style="color:#ffffff">Keterangan</th>
					<th style="color:#ffffff">Nilai</th>
					<th style="color:#ffffff">Approval</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>

		<!--end: Datatable -->
		</div>
	</div>
</div>
</div>


@endsection
