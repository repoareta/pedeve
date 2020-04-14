@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Potongan Insentif </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Sdm & Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Potongan Insentif </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edit</span>
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
					Edit Potongan Insentif
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
		<div class="card-body table-responsive" >
			<!--begin: Datatable -->
			<form  class="kt-form kt-form--label-right" id="form-edit">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Potongan Insentif
								</h5>	
							</div>
						</div>
						@foreach($data_list as $data)
						<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Bulan Gaji<span style="color:red;">*</span></label>
						<div class="col-4">
							<?php 
							$array_bln	 = array (
										1 =>   'Januari',
										'Februari',
										'Maret',
										'April',
										'Mei',
										'Juni',
										'Juli',
										'Agustus',
										'September',
										'Oktober',
										'November',
										'Desember'
									);
									$bulan= strtoupper($array_bln[$data->bulan]);
							?>
						<input class="form-control" type="text" value="{{$bulan}}"readonly style="background-color:#DCDCDC; cursor:not-allowed">
						<input class="form-control" type="hidden" value="{{$data->bulan}}" name="bulan">
								
						</div>
								<div class="col-2" >
									<input class="form-control" type="text" value="{{$data->tahun}}" name="tahun" readonly style="background-color:#DCDCDC; cursor:not-allowed">
									<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
								</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Pegawai<span style="color:red;">*</span></label>
							<div class="col-8">
							<input class="form-control" type="text" value="{{$data->nopek}} - {{$data->nama_nopek}}"  readonly style="background-color:#DCDCDC; cursor:not-allowed">
							<input class="form-control" type="hidden" value="{{$data->nopek}}" name="nopek" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Nilai<span style="color:red;">*</span></label>
							<div class="col-8">
								<input class="form-control" name="nilai" type="text" value="<?php echo number_format($data->nilai, 0, '', '') ?>" id="nilai" size="17" maxlength="17" required oninvalid="this.setCustomValidity('Nilai Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						@endforeach
						<div class="kt-form__actions">
							<div class="row">
								<div class="col"></div>
								<div class="col"></div>
								<div class="col-10">
									<a  href="{{route('potongan_insentif.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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


$('#nilai').keyup(function(){
		var nilai=parseInt($('#nilai').val());
	var pajak=(35/65)*nilai;
	var a =parseInt(pajak);
		$('#pajak').val(a);
});


// /edit lembur
$('#form-edit').submit(function(){
$.ajax({
	url  : "{{route('potongan_insentif.update')}}",
	type : "POST",
	data : $('#form-edit').serialize(),
	dataType : "JSON",
	headers: {
	'X-CSRF-Token': '{{ csrf_token() }}',
	},
	success : function(data){
	console.log(data);
	Swal.fire({
		type  : 'success',
		title : 'Data Potongan Insentif Berhasil Diubah',
		text  : 'Berhasil',
	}).then(function() {
			window.location.replace("{{ route('potongan_insentif.index') }}");;
		});
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
