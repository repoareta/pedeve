@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Lembur </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Lembur</span>
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
				Tabel Payroll Lembur
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{ route('lembur.create') }}">
							<span style="font-size: 2em;" class="kt-font-success">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
	
							<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah data">
								<i class="fas fa-edit" id="editRow"></i>
							</span>
	
							<span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus data">
								<i class="fas fa-times-circle" id="deleteRow"></i>
							</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="col-12">
			<form class="kt-form" id="search-form" >
				<div class="form-group row">
					<label for="" class="col-form-label">Pegawai</label>
					<div class="col-2">
						<select name="nopek" class="form-control selectpicker" data-live-search="true">
						<option value="">- Pilih -</option>
							@foreach($data_pegawai as $data)
							<option value="{{$data->nopeg}}">{{$data->nopeg}} - {{$data->nama}}</option>
							@endforeach
						</select>
					</div>
					<label for="" class="col-form-label">Bulan</label>
					<div class="col-2">
						<select name="bulan" class="form-control selectpicker" data-live-search="true">
							<option value="" >-- Pilih --</option>
							<option value="01" <?php if($bulan  == '01' ) echo 'selected' ; ?>>Januari</option>
							<option value="02" <?php if($bulan  == '02' ) echo 'selected' ; ?>>Februari</option>
							<option value="03" <?php if($bulan  == '03' ) echo 'selected' ; ?>>Maret</option>
							<option value="04" <?php if($bulan  == '04' ) echo 'selected' ; ?>>April</option>
							<option value="05" <?php if($bulan  == '05' ) echo 'selected' ; ?>>Mei</option>
							<option value="06" <?php if($bulan  == '05' ) echo 'selected' ; ?>>Juni</option>
							<option value="07" <?php if($bulan  == '07' ) echo 'selected' ; ?>>Juli</option>
							<option value="08" <?php if($bulan  == '08' ) echo 'selected' ; ?>>Agustus</option>
							<option value="09" <?php if($bulan  == '09' ) echo 'selected' ; ?>>September</option>
							<option value="10" <?php if($bulan  == '10' ) echo 'selected' ; ?>>Oktober</option>
							<option value="11" <?php if($bulan  == '11' ) echo 'selected' ; ?>>November</option>
							<option value="12" <?php if($bulan  == '12' ) echo 'selected' ; ?>>Desember</option>
						</select>
					</div>
	
					<label for="" class="col-form-label">Tahun</label>
					<div class="col-2">
						<input class="form-control" type="text" name="tahun" value="{{$tahun}}" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off'>
					</div>
					<div class="col-2">
						<button type="submit" class="btn btn-brand"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
					</div>
				</div>
			</form>
		</div>
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>Tanggal</th>
					<th>No.Peg</th>
					<th>Makan Pagi</th>
					<th>Makan Siang</th>
					<th>Makan Malam</th>
					<th>Transport</th>
					<th>Lembur</th>
					<th>Jumlah</th>
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
				url: "{{route('lembur.search.index')}}",
				type : "POST",
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				data: function (d) {
					d.nopek = $('select[name=nopek]').val();
					d.bulan = $('select[name=bulan]').val();
					d.tahun = $('input[name=tahun]').val();
				}
			},
			columns: [
				{data: 'radio', name: 'radio'},
				{data: 'tanggal', name: 'tanggal'},
				{data: 'nopek', name: 'nopek'},
				{data: 'makanpg', name: 'makanpg'},
				{data: 'makansg', name: 'makansg'},
				{data: 'makanml', name: 'makanml'},
				{data: 'transport', name: 'transport'},
				{data: 'lembur', name: 'lembur'},
				{data: 'total', name: 'total'},
			]
			
	});
	$('#search-form').on('submit', function(e) {
		t.draw();
		e.preventDefault();
	});

//refresh data
$('#show-data').on('click', function(e) {
	e.preventDefault();
		location.replace("{{ route('lembur.index') }}");

});

//edit lembur
$('#editRow').click(function(e) {
	e.preventDefault();

	if($('input[class=btn-radio]').is(':checked')) { 
		$("input[class=btn-radio]:checked").each(function(){
			var tanggal = $(this).attr('data-tanggal');
			var nopek = $(this).attr('data-nopek');
			location.replace("{{url('sdm/lembur/edit')}}"+ '/' +tanggal+ '/'+nopek);
		});
	} else {
		swalAlertInit('ubah');
	}
});

//delete lembur
$('#deleteRow').click(function(e) {
e.preventDefault();
if($('input[class=btn-radio]').is(':checked')) { 
	$("input[class=btn-radio]:checked").each(function() {
		var tanggal = $(this).attr('data-tanggal');
		var nopek = $(this).attr('data-nopek');
		// delete stuff
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-primary',
				cancelButton: 'btn btn-danger'
			},
				buttonsStyling: false
			})
			swalWithBootstrapButtons.fire({
				title: "Data yang akan dihapus?",
				text: "Tanggal  : " +tanggal+ " nopek : " +nopek,
				type: 'warning',
				showCancelButton: true,
				reverseButtons: true,
				confirmButtonText: 'Ya, hapus',
				cancelButtonText: 'Batalkan'
			})
			.then((result) => {
			if (result.value) {
				$.ajax({
					url: "{{ route('lembur.delete') }}",
					type: 'DELETE',
					dataType: 'json',
					data: {
						"tanggal": tanggal,
						"nopek": nopek,
						"_token": "{{ csrf_token() }}",
					},
					success: function () {
						Swal.fire({
							type  : 'success',
							title : "Data Lembur Tanggal  : " +tanggal+ " Nopek : " +nopek+ " Berhasil DIhapus.",
							text  : 'Berhasil',
							
						}).then(function() {
							location.reload();
						});
					},
					error: function () {
						alert("Terjadi kesalahan, coba lagi nanti");
					}
				});
			}
		});
	});
} else {
	swalAlertInit('hapus');
}

});


	var KTBootstrapDatepicker = function () {

var arrows;
if (KTUtil.isRTL()) {
	arrows = {
		leftArrow: '<i class="la la-angle-right"></i>',
		rightArrow: '<i class="la la-angle-left"></i>'
	}
} else {
	arrows = {
		leftArrow: '<i class="la la-angle-left"></i>',
		rightArrow: '<i class="la la-angle-right"></i>'
	}
}

// Private functions
var demos = function () {

	// minimum setup
	$('#tanggal').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'mm/yyyy'
	});
};

return {
	// public functions
	init: function() {
		demos(); 
	}
};
}();

KTBootstrapDatepicker.init();
});

function hanyaAngka(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))

	return false;
	return true;
}
</script>
@endsection