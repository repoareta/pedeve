@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Potongan Manual </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Sdm & Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Potongan Manual </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Tambah</span>
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
					<i class="kt-font-brand flaticon2-plus-1"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Tambah Potongan Manual
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
		<div class="card-body table-responsive" >
			<!--begin: Datatable -->
			<form  class="kt-form kt-form--label-right" id="form-create">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Potongan Manual
								</h5>	
							</div>
						</div>
						<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Bulan Gaji<span style="color:red;">*</span></label>
						<div class="col-4">
								<?php 
									$tgl = date_create(now());
									$tahun = date_format($tgl, 'Y'); 
									$bulan = date_format($tgl, 'n'); 
								?>
								<select class="form-control" name="bulan" required>
									<option value="1" <?php if($bulan  == 1 ) echo 'selected' ; ?>>Januari</option>
									<option value="2" <?php if($bulan  == 2 ) echo 'selected' ; ?>>Februari</option>
									<option value="3" <?php if($bulan  == 3 ) echo 'selected' ; ?>>Maret</option>
									<option value="4" <?php if($bulan  == 4 ) echo 'selected' ; ?>>April</option>
									<option value="5" <?php if($bulan  == 5 ) echo 'selected' ; ?>>Mei</option>
									<option value="6" <?php if($bulan  == 6 ) echo 'selected' ; ?>>Juni</option>
									<option value="7" <?php if($bulan  == 7 ) echo 'selected' ; ?>>Juli</option>
									<option value="8" <?php if($bulan  == 8 ) echo 'selected' ; ?>>Agustus</option>
									<option value="9" <?php if($bulan  == 9 ) echo 'selected' ; ?>>September</option>
									<option value="10" <?php if($bulan  ==10  ) echo 'selected' ; ?>>Oktober</option>
									<option value="11" <?php if($bulan  == 11 ) echo 'selected' ; ?>>November</option>
									<option value="12" <?php if($bulan  == 12 ) echo 'selected' ; ?>>Desember</option>
								</select>
						</div>
								<div class="col-4" >
									<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off' required>
									<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
								</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Pegawai<span style="color:red;">*</span></label>
							<div class="col-8">
								<select name="nopek"  class="form-control selectpicker" data-live-search="true" required autocomplete='off'>
									<option value="">- Pilih -</option>
									@foreach($data_pegawai as $data)
									<option value="{{$data->nopeg}}">{{$data->nopeg}} - {{$data->nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Aard<span style="color:red;">*</span></label>
							<div class="col-8">
								<select name="aard"  class="form-control selectpicker" data-live-search="true" required autocomplete='off'>
									<option value="">- Pilih -</option>
									@foreach($pay_aard as $data)
									<option value="{{$data->kode}}">{{$data->kode}} - {{$data->nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Cicilan Ke-<span style="color:red;">*</span></label>
							<div class="col-8">
								<input class="form-control" name="ccl" type="text" value="" id="ccl" size="3" maxlength="3" required oninvalid="this.setCustomValidity('Cicilan Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Jml Cicilan<span style="color:red;">*</span></label>
							<div class="col-8">
								<input class="form-control" name="jmlcc" type="text" value="" id="jmlcc" size="5" maxlength="5" required oninvalid="this.setCustomValidity('Jml Cicilan Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Nilai<span style="color:red;">*</span></label>
							<div class="col-8">
								<input class="form-control" name="nilai" type="text" value="" id="nilai" size="17" maxlength="17" required oninvalid="this.setCustomValidity('Nilai Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col"></div>
								<div class="col"></div>
								<div class="col-10">
									<a  href="{{route('potongan_manual.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!--end: Datatable -->
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {

$('#form-create').submit(function(){
	$.ajax({
		url  : "{{route('potongan_manual.store')}}",
		type : "POST",
		data : $('#form-create').serialize(),
		dataType : "JSON",
		headers: {
		'X-CSRF-Token': '{{ csrf_token() }}',
		},
		success : function(data){
		console.log(data);
		if(data == 1){
			Swal.fire({
				type  : 'success',
				title : 'Data Berhasil Ditambah',
				text  : 'Berhasil',
				timer : 2000
			}).then(function() {
					window.location.replace("{{ route('potongan_manual.index')}}");;
				});
		}else{
			Swal.fire({
				type  : 'info',
				title : 'Data Potongan Manual Yang Diinput Sudah Ada.',
				text  : 'Failed',
			});
		}
		}, 
		error : function(){
			alert("Terjadi kesalahan, coba lagi nanti");
		}
	});	
	return false;
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
	$('#tgldebet').datepicker({
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
