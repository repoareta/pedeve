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
				<a href="" class="kt-subheader__breadcrumbs-link">
					Lembur </a>
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
					Edit Lembur
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
		<form class="kt-form kt-form--label-right" id="form-edit">
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							Header Lembur
						</div>
					</div>
				</div>
				@foreach($data_list as $data_li)
				<div class="form-group row">
					<label for="example-email-input" class="col-2 col-form-label">Tgl. Lembur</label>
					<div class="col-10">
					<?php 
						$tgl = date_create($data_li->tanggal);
						$tanggal = date_format($tgl, 'd/m/Y'); 
					?>
						<input class="form-control" type="text" value="{{$tanggal}}"  name="tanggal"  style="background-color:#DCDCDC; cursor:not-allowed" readonly autocomplete='off'>
						<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label for="spd-input" class="col-2 col-form-label">Bulan Gaji</label>
					<div class="col-2">
						<select class="form-control" name="bulan">
							<option value="1" <?php if($data_li->bulan  == 1 ) echo 'selected' ; ?>>Januari</option>
							<option value="2" <?php if($data_li->bulan  == 2 ) echo 'selected' ; ?>>Februari</option>
							<option value="3" <?php if($data_li->bulan  == 3 ) echo 'selected' ; ?>>Maret</option>
							<option value="4" <?php if($data_li->bulan  == 4 ) echo 'selected' ; ?>>April</option>
							<option value="5" <?php if($data_li->bulan  == 5 ) echo 'selected' ; ?>>Mei</option>
							<option value="6" <?php if($data_li->bulan  == 6 ) echo 'selected' ; ?>>Juni</option>
							<option value="7" <?php if($data_li->bulan  == 7 ) echo 'selected' ; ?>>Juli</option>
							<option value="8" <?php if($data_li->bulan  == 8 ) echo 'selected' ; ?>>Agustus</option>
							<option value="9" <?php if($data_li->bulan  == 9 ) echo 'selected' ; ?>>September</option>
							<option value="10" <?php if($data_li->bulan  ==10  ) echo 'selected' ; ?>>Oktober</option>
							<option value="11" <?php if($data_li->bulan  == 11 ) echo 'selected' ; ?>>November</option>
							<option value="12" <?php if($data_li->bulan  == 12 ) echo 'selected' ; ?>>Desember</option>
						</select>
					</div>
							<div class="col-2" >
								<input class="form-control" type="text" value="{{$data_li->tahun}}"   name="tahun" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off' >
							</div>
				</div>
				<div class="form-group row">
					<label for="spd-input" class="col-2 col-form-label">Pegawai</label>
					<div class="col-10">
						<input class="form-control" type="text" value="{{$data_li->nopek}}" name="nopek" style="background-color:#DCDCDC; cursor:not-allowed" readonly autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label for="id-pekerja;-input" class="col-2 col-form-label">Makan Pagi</label>
					<div class="col-10">
						<input class="form-control" type="text" value="<?php echo number_format($data_li->makanpg, 0, '', '') ?>" id="makanpg" name="makanpg" onkeypress="return hanyaAngka(event)" autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label for="id-pekerja;-input" class="col-2 col-form-label">Makan Siang</label>
					<div class="col-10">
						<input class="form-control" type="text" value="<?php echo number_format($data_li->makansg, 0, '', '') ?>" id="makansg" name="makansg" onkeypress="return hanyaAngka(event)" autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label for="id-pekerja;-input" class="col-2 col-form-label">Makan Siang</label>
					<div class="col-10">
						<input class="form-control" type="text" value="<?php echo number_format($data_li->makanml, 0, '', '') ?>" id="makanml" name="makanml" onkeypress="return hanyaAngka(event)" autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label for="id-pekerja;-input" class="col-2 col-form-label">Transport</label>
					<div class="col-10">
						<input class="form-control" type="text" value="<?php echo number_format($data_li->transport, 0, '', '') ?>" id="transport" name="transport" onkeypress="return hanyaAngka(event)" autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label for="id-pekerja;-input" class="col-2 col-form-label">Lembur</label>
					<div class="col-10">
						<input class="form-control" type="text" value="<?php echo number_format($data_li->lembur, 0, '', '') ?>" id="lembur" name="lembur" onkeypress="return hanyaAngka(event)" autocomplete='off'>
					</div>
				</div>
				@endforeach
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-10">
							<a  href="{{route('lembur.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
							@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',301)->limit(1)->get() as $data_akses)
							@if($data_akses->rubah == 1)
							<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
							@endif
							@endforeach
						</div>
					</div>
				</div>
		</form>
	</div>
</div>
<!--end::Modal-->
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function () {

//edit lembur
$('#form-edit').submit(function(){
$.ajax({
	url  : "{{route('lembur.update')}}",
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
		title : 'Data Lembur Berhasil Diubah',
		text  : 'Berhasil',
	}).then(function() {
			window.location.replace("{{ route('lembur.index') }}");;
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
	$('#tanggal').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'dd/mm/yyyy'
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