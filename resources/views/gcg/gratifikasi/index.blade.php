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
			
			@include('gcg.gratifikasi.menu')
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
					<th>Tanggal</th>
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
				@foreach ($gratifikasi_list as $gratifikasi)
				<tr>
					<td>{{ $gratifikasi->nopeg }}</td>
					<td>{{ $gratifikasi->pekerja->nama }}</td>
					<td>{{ Carbon\Carbon::parse($gratifikasi->tgl_gratifikasi)->translatedFormat('d F Y') }}</td>
					<td>{{ $gratifikasi->bentuk }}</td>
					<td>{{ $gratifikasi->jumlah }}</td>
					<td>{{ $gratifikasi->pemberi }}</td>
					<td>{{ $gratifikasi->keterangan }}</td>
					<td>{{ $gratifikasi->status }}</td>
					<td>NIHIL</td>
					<td>{{ ucwords($gratifikasi->jenis_gratifikasi) }}</td>
					<td>
						<a href="{{ route('gcg.gratifikasi.edit', ['gratifikasi' => $gratifikasi->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
					</td>
				</tr>
				@endforeach
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