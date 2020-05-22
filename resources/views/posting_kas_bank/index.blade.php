@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Postingan Kas Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kontroler </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Postingan Kas Bank</span>
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
				Tabel Postingan Kas Bank
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
							<i class="fas fa-edit" id="editRow"></i>
						</span>

						<span style="font-size: 2em;"  class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
							<i class="fas fa-times-circle" id="deleteRow"></i>
						</span>

						<span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
							<i class="fas fa-print" id="exportRow"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<form id="search-form">
			Bulan: 	<select style="width:15%;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="bulan" id="bulan">
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
			Tahun: 	<input style="width:10%;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="tahun"  type="text" size="4" maxlength="4" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'>  
				<button type="submit" style="font-size: 20px;margin-left:5px;border-radius:10px;border-radius:10px;background-color:white;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cari Data"> <i class="fa fa-search"></i></button>  
				
		</form>
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th>TANGGAL</th>
					<th>NO.DOKUMEN</th>
					<th>THN-BLN</th>
					<th>KETERANGAN</th>
					<th>JK</th>
					<th>STORE</th>
					<th>NOBUKTI</th>
					<th>JUMLAH</th>
					<th>VERIFIKASI</th>
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
						url: "{{ route('postingan_kas_bank.search.index') }}",
						type : "POST",
						dataType : "JSON",
						headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
						},
						data: function (d) {
							d.tahun = $('input[name=tahun]').val();
							d.bulan = $('select[name=bulan]').val();
						}
					},
			columns: [
				{data: 'paiddate', name: 'paiddate'},
				{data: 'docno', name: 'docno'},
				{data: 'thnbln', name: 'thnbln'},
				{data: 'keterangan', name: 'keterangan'},
				{data: 'jk', name: 'jk'},
				{data: 'store', name: 'store'},
				{data: 'voucher', name: 'voucher'},
				{data: 'nilai', name: 'nilai'},
				{data: 'action', name: 'action'},
			]
		});
		$('#search-form').on('submit', function(e) {
			t.draw();
			e.preventDefault();
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