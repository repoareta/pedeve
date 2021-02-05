@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Absensi Karyawan </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					SDM & Payroll  
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Absensi Karyawan</span>
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
				Absensi Karyawan
			</h3>
			
			<div class="kt-portlet__head-actions" style="font-size: 2rem;">
				<span class="kt-font-success pointer-link" data-toggle="modal" data-target="#mapping" data-placement="top" title="Mapping Data Absen.">
					<i class="fab fa-hubspot"></i>
				</span>
			</div>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<form class="kt-form" action="{{ route('absensi_karyawan.download') }}" id="search-form" method="GET">
			<div class="form-group row">
				<label for="spd-input" class="col-1 col-form-label">IP Address</label>
				<div class="col-2">
					<input class="form-control" type="text" name="ip_address" value="{{ $ip }}">
				</div>

				<label for="spd-input" class="col-form-label">Comm Key</label>
				<div class="col-2">
					<input class="form-control" type="text" name="comm_key" value="{{ $key }}">
				</div>

				<div class="col-2">
					<button type="submit" class="btn btn-brand"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
				</div>
			</div>
		</form>
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th>Pegawai</th>
					<th>Tanggal & Jam</th>
					<th>Verifikasi</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

		<!--end: Datatable -->
	</div>
</div>
</div>

<!-- Modal-->
<div class="modal fade" id="mapping" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mapping data absen dengan data pegawai.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
			</div>
			<form action="{{route('absensi_karyawan.mapping')}}" method="POST">
				@csrf
				<div class="modal-body">
					<div class="form-group row">
						<label for="kode_main" class="col-2 col-form-label">Pegawai</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="nopeg" required>
								<option value="">- Pilih -</option>
								@foreach ($data_pegawai as $item)
									<option value="{{$item->nopeg}}">{{$item->nama}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="kode_main" class="col-2 col-form-label">No Absen</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="noabsen" required>
								<option value="">- Pilih -</option>
								@foreach ($data_absensi as $item)
									@if ($item->noabsen == null)
										<option value="{{$item->userid}}">{{$item->userid}}</option>
									@endif

								@endforeach
							</select>
							<div id="kode_main-nya"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary font-weight-bold">Save</button>
				</div>
			</form>
        </div>
    </div>
</div>
<!-- Modal-->

@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		var t = $('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			ajax      : "{{ route('absensi_karyawan.index.json') }}",
			columns: [
				{data: 'pegawai', name: 'userid', class:'no-wrap'},
				{data: 'tanggal', name: 'tanggal', class:'no-wrap'},
				{data: 'verifikasi', name: 'verifikasi', class:'no-wrap'},
				{data: 'status', name: 'status', class:'no-wrap'}
			]
		});
	});
	</script>
@endsection