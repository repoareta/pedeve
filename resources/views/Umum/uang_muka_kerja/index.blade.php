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
				<div class="kt-portlet__head-actions">
					<a href="{{ route('uang_muka_kerja.create') }}">
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
	<div class="kt-portlet__body">
		<div class="card-body table-responsive">
		<!--begin: Datatable -->
		<table id="data-umk-table" class="table table-striped table-hover table-bordered">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>Tanggal</th>
					<th>No UMK</th>
					<th>No Kas/Bank</th>
					<th>Jenis</th>
					<th>Keterangan</th>
					<th>Nilai</th>
					<th>Approval</th>
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

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
	$('#data-umk-table').DataTable({
        processing: true,
		serverSide: true,
		ajax: {
            url: "{{ route('uang_muka_kerja_json.index') }}",
		},
		columns: [
			{
				data: 'radio',
				name: 'radio',
				orderable: false
			},
			{
				data: 'tgl_panjar',
				name: 'tgl_panjar'
			},
			{
				data: 'noumk',
				name: 'noumk'
			},
			{
				data: 'no_kas',
				name: 'no_kas'
			},
			{
				data: 'jenisum',
				name: 'jenisum'
			},
			{
				data: 'keterangan',
				name: 'keterangan'
			},
			{
				data: 'jumlah',
				name: 'jumlah'
			},
			{
				data: 'action',
				name: 'action',
				orderable: false
			}
		]
    });
});
</script>
@endsection