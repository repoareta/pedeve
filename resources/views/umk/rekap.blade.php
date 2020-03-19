@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Form Report Uang Muka Kerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
				Form Report Uang Muka Kerja </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Cetak Report</span>
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
				Cetak Rekap Uang Muka Kerja
			</h3>
		</div>
	</div>
	<div class="">
		<div class="card-body table-responsive" >
		<!--begin: Datatable -->
		<form  class="kt-form kt-form--label-right" id="form-create-umk">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">

					<div class="form-group row">
						<label for="tujuan-input" class="col-4 col-form-label">Bulan</label>
						<div class="col-4">
							<input class="form-control" type="text" value="" name="bulan" id="tanggal" value="{{ date('m') }}">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-4 col-form-label">Tujuan</label>
						<div class="col-4">
							<input  class="form-control" type="text" value="" name="untuk" id="untuk" size="70" maxlength="200" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-7 col-form-label"></label>
						<div class="col-4">
							<a  href="{{route('uang_muka_kerja.index')}}" class="btn btn-warning">Cancel</a>
							<button type="submit" class="btn btn-brand">Cetak</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


@endsection

@section('scripts')
	<script type="text/javascript">
$(document).ready(function () {
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
		format   : 'mm'
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
