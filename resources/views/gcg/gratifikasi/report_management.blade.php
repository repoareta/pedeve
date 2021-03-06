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
		<form action="{{ route('gcg.gratifikasi.report.management.export') }}" class="kt-form col-12 kt-form--label-right" method="GET" id="search-form" target="_blank">
			<div class="form-group row">
				<label for="spd-input" class="col-2 col-form-label">Bentuk Gratifikasi</label>
				<div class="col-4">
					<select class="form-control kt-select2" name="bentuk_gratifikasi" id="bentuk_gratifikasi">
						<option value="">- Pilih -</option>
						<option value="penerimaan" @if (request('bentuk_gratifikasi') == 'penerimaan') {{ 'selected' }} @endif>Penerimaan</option>
						<option value="pemberian" @if (request('bentuk_gratifikasi') == 'pemberian') {{ 'selected' }} @endif>Pemberian</option>
						<option value="permintaan" @if (request('bentuk_gratifikasi') == 'permintaan') {{ 'selected' }} @endif>Permintaan</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="spd-input" class="col-2 col-form-label">Pilih Fungsi</label>
				<div class="col-4">
					<select class="form-control kt-select2" name="fungsi" id="fungsi">
						<option value="">- Pilih -</option>
						@foreach ($fungsi_list as $fungsi)
						<option value="{{ $fungsi->id }}" @if (request('fungsi') == $fungsi->id) {{ 'selected' }} @endif>{{ $fungsi->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="spd-input" class="col-2 col-form-label">Bulan</label>
				<div class="col-4">
					<select class="form-control kt-select2" name="bulan" id="bulan">
						<option value="">- Pilih Bulan -</option>
						<option value="01" @if (request('bulan') == '01') {{ 'selected' }} @endif>Januari</option>
						<option value="02" @if (request('bulan') == '02') {{ 'selected' }} @endif>Februari</option>
						<option value="03" @if (request('bulan') == '03') {{ 'selected' }} @endif>Maret</option>
						<option value="04" @if (request('bulan') == '04') {{ 'selected' }} @endif>April</option>
						<option value="05" @if (request('bulan') == '05') {{ 'selected' }} @endif>Mei</option>
						<option value="06" @if (request('bulan') == '06') {{ 'selected' }} @endif>Juni</option>
						<option value="07" @if (request('bulan') == '07') {{ 'selected' }} @endif>Juli</option>
						<option value="08" @if (request('bulan') == '08') {{ 'selected' }} @endif>Agustus</option>
						<option value="09" @if (request('bulan') == '09') {{ 'selected' }} @endif>September</option>
						<option value="10" @if (request('bulan') == '10') {{ 'selected' }} @endif>Oktober</option>
						<option value="11" @if (request('bulan') == '11') {{ 'selected' }} @endif>November</option>
						<option value="12" @if (request('bulan') == '12') {{ 'selected' }} @endif>Desember</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="spd-input" class="col-2 col-form-label">Tahun</label>
				<div class="col-4">
					<select class="form-control kt-select2" name="tahun" id="tahun">
						<option value="">- Pilih Tahun -</option>
						@foreach ($gratifikasi_tahun as $tahun)
						<option value="{{ $tahun->year }}" @if (request('tahun') == $tahun->year) {{ 'selected' }} @endif>{{ $tahun->year }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-2">
				</div>
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
					<th>Nama</th>
					<th>Jabatan</th>
					<th>Tgl Penerimaan</th>
					<th>Jenis</th>
					<th>Jumlah</th>
					<th>Pemberi</th>
					<th>Keterangan</th>
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
				url: "{{ route('gcg.gratifikasi.report.management.json') }}",
				data: function (d) {
					d.bentuk_gratifikasi = $('select[name=bentuk_gratifikasi]').val();
					d.fungsi = $('select[name=fungsi]').val();
					d.bulan = $('select[name=bulan]').val();
					d.tahun = $('select[name=tahun]').val();
				}
			},
			columns: [
				{data: 'nama', name: 'nama', class:'no-wrap'},
				{data: 'fungsi_jabatan', name: 'fungsi_jabatan', class:'no-wrap'},
				{data: 'tanggal_gratifikasi', name: 'tgl_gratifikasi', class:'no-wrap'},
				{data: 'bentuk', name: 'bentuk', class:'no-wrap'},
				{data: 'jumlah', name: 'jumlah', class:'no-wrap'},
				{data: 'pemberi', name: 'pemberi', class:'no-wrap'},
				{data: 'keterangan', name: 'keterangan'}
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