@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Proses Upah Bulanan </h3>
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
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Proses Upah Bulanan</span>
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
					Proses Upah Bulanan
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
		<form class="kt-form kt-form--label-right" action="{{route('proses_gaji.store')}}" method="post">
		{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							Header Proses Upah Bulanan
						</div>
					</div>
				</div>
				<input class="form-control" type="hidden" name="userid" value="{{Auth::user()->userid}}">
				<div class="form-group row">
					<label for="dari-input" class="col-2 col-form-label">Status Pekerja<span style="color:red;">*</span></label>
					<div class="col-10">
						<select name="prosesupah" id="select-debetdari" class="form-control selectpicker" data-live-search="true">
							<option value="A">Semua</option>
							<option value="C">Pekerja Tetap</option>
							<option value="K">Kontrak</option>
							<option value="B">Perbantuan</option>
							<option value="U">Komisaris</option>
							<option value="O">Komite</option>
							<option value="N">Pekerja Baru</option>
						</select>								
					</div>
				</div>
				<div class="form-group row">
					<label for="nopek-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
					<div class="col-10">
						<input class="form-control" type="text" name="tanggalupah" value="" id="tanggal" size="7" maxlength="7" required  autocomplete='off' oninvalid="this.setCustomValidity('Bulan/Tahun Harus Diisi..')" onchange="setCustomValidity('')">
						@if (session('proses'))
						<small style="color: red;" id="att-kode-proses-upah">Bulan dan tahun yang dimasukan sudah pernah di proses.</small>
                        @endif
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
</script>
@endsection