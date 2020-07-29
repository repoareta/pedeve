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
                    Report 
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
                    Personal 
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
		<form action="{{ route('gcg.gratifikasi.report.personal.export') }}" target="_blank" class="kt-form col-12 kt-form--label-right" id="search-form" method="POST">
			@csrf
			<div class="form-group row">
				<label for="spd-input" class="col-2 col-form-label">Bentuk Gratifikasi</label>
				<div class="col-4">
					<select class="form-control kt-select2" name="bentuk_gratifikasi" id="bentuk_gratifikasi">
						<option value="">- Pilih -</option>
						<option value="penerimaan">Penerimaan</option>
						<option value="pemberian">Pemberian</option>
						<option value="permintaan">Permintaan</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="spd-input" class="col-2 col-form-label">Bulan</label>
				<div class="col-4">
					<select class="form-control kt-select2" name="bulan" id="bulan">
						<option value="">- Pilih Bulan -</option>
						<option value="01">Januari</option>
						<option value="02">Februari</option>
						<option value="03">Maret</option>
						<option value="04">April</option>
						<option value="05">Mei</option>
						<option value="06">Juni</option>
						<option value="07">Juli</option>
						<option value="08">Agustus</option>
						<option value="09">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="spd-input" class="col-2 col-form-label">Tahun</label>
				<div class="col-4">
					<select class="form-control kt-select2" name="tahun" id="tahun">
						<option value="">- Pilih Tahun -</option>
						@foreach ($gratifikasi_tahun as $tahun)
						<option value="{{ $tahun->year }}">{{ $tahun->year }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-2"></div>
				<div class="col-4">
					<button type="submit" class="btn btn-brand"><i class="fa fa-search" aria-hidden="true"></i> Tampilkan</button>
					<button type="button" onclick="this.form.submit()" class="btn btn-danger"><i class="fa fa-print" aria-hidden="true"></i> Cetak .PDF</button>
				</div>
			</div>
		</form>
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
			<thead class="thead-light">
				<tr>
					<th>Tanggal</th>
					<th>Jenis</th>
					<th>Jumlah</th>
					<th>Pemberi</th>
					<th>Keterangan</th>
					<th>Tanggal Submit</th>
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
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		var t = $('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			ajax      : {
				url: "{{ route('gcg.gratifikasi.report.personal.json') }}",
				data: function (d) {
					d.bentuk_gratifikasi = $('select[name=bentuk_gratifikasi]').val();
					d.bulan = $('select[name=bulan]').val();
					d.tahun = $('select[name=tahun]').val();
				}
			},
			columns: [
				{data: 'tanggal_gratifikasi', name: 'tgl_gratifikasi', class:'no-wrap'},
				{data: 'bentuk', name: 'bentuk', class:'no-wrap'},
				{data: 'jumlah', name: 'jumlah', class:'no-wrap'},
				{data: 'pemberi', name: 'pemberi', class:'no-wrap'},
				{data: 'keterangan', name: 'keterangan'},
				{data: 'tanggal_submit', name: 'created_at', class:'no-wrap'},
				{data: 'status', name: 'status', class:'no-wrap'}
			]
		});

		$('#search-form').on('submit', function(e) {
			t.draw();
			e.preventDefault();
		});

		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});
	});
	</script>
@endsection