@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Proses Insentif </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
				Sdm & Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					 </a>
				<!-- <span class="kt-subheader__breadcrumbs-separator"></span> -->
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Proses Insentif</span>
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
					Proses Insentif
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
		<form class="kt-form kt-form--label-right" action="{{route('proses_insentif.store')}}" method="post">
		{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							Header Proses Insentif
						</div>
					</div>
				</div>
				<input class="form-control" type="hidden" name="userid" value="{{Auth::user()->userid}}">
				<div class="form-group row">
					<label for="dari-input" class="col-2 col-form-label">Status Pekerja<span style="color:red;">*</span></label>
					<div class="col-6">
						<select name="prosesupah" id="select-debetdari" class="form-control selectpicker" data-live-search="true">
							<option value="A">Semua</option>
							<option value="C">Pekerja Tetap</option>
							<option value="K">Kontrak</option>
						</select>								
					</div>
				</div>
				<div class="form-group row">
					<label for="nopek-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
					<div class="col-6">
						<input class="form-control" type="text" name="tanggal" value="" id="tanggal" size="7" maxlength="7" required  autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label for="nopek-input" class="col-2 col-form-label">Tahun Insentif<span style="color:red;">*</span></label>
					<div class="col-6">
						<input class="form-control" type="text" name="tahun" value=""  size="4" maxlength="4" required oninvalid="this.setCustomValidity('Tahun Insentif Harus Diisi..')" oninput="setCustomValidity('')"  autocomplete='off' onkeypress="return hanyaAngka(event)">
					</div>
				</div>
				<div class="form-group row">
					<label for="nopek-input" class="col-2 col-form-label">Upah Tetap/All In<span style="color:red;">*</span></label>
					<div class="col-6">
						<input class="form-control" type="text" name="upah" value=""  size="4" maxlength="4" required oninvalid="this.setCustomValidity('Upah Tetap/All In Harus Diisi..')" oninput="setCustomValidity('')"  autocomplete='off' onkeypress="return hanyaAngka(event)">
					</div>
				</div>
				<div class="form-group row">
					<label for="nopek-input" class="col-2 col-form-label">Keterangan<span style="color:red;">*</span></label>
					<div class="col-6">
						<input class="form-control" type="text" name="keterangan" value=""  size="30" maxlength="30" required oninvalid="this.setCustomValidity('Keterangan Harus Diisi..')" oninput="setCustomValidity('')"  autocomplete='off' >
					</div>
				</div>


				<div class="form-group row">
					<label for="spd-input" class="col-2 col-form-label"></label>
					<div class="col-5">
						<input id="ci"   style=" width: 26px;height: 26px;margin-left:50px;" value="proses" type="radio"  name="radioupah"  checked />  <label style="font-size:14px; margin-left:10px;">Proses</label>
						<input  id="ci" style=" width: 26px;height: 26px;margin-left:50px;" value="batal" type="radio"    name="radioupah"  /><label style="font-size:14px; margin-left:10px;"> Batalkan</label>
					</div>
				</div>
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-10">
							<a  href="#" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
							<button type="submit" id="btn-save" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Process</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		$('#kt_table').DataTable();


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