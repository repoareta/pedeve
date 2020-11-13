@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Pensiun </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Sdm & Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Pensiun </a>
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
					Tambah Pensiun
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
									Header Pensiun
								</h5>	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Pribadi<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text"  required name="pribadi"  size="20" maxlength="20" value="" required oninvalid="this.setCustomValidity('Pribadi Harus Diisi..')" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');setCustomValidity('')" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Perusahaan Direksi<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="perusahaan" type="text" value="" size="20" maxlength="20" required oninvalid="this.setCustomValidity('Perusahaan Direksi Harus Diisi..')" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');setCustomValidity('')" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Perusahaan Pekerja<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="perusahaan2" type="text" value="" size="20" maxlength="20" required oninvalid="this.setCustomValidity('Perusahaan Pekerja Harus Diisi..')" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');setCustomValidity('')" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Perusahaan Direksi(BNI)<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="perusahaan3" type="text" value="" size="20" maxlength="20" required oninvalid="this.setCustomValidity('Perusahaan Direksi(BNI) Harus Diisi..')" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');setCustomValidity('')" >
							</div>
						</div>						
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('pensiun.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" id="btn-save" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
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
				url  : "{{route('pensiun.store')}}",
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
							window.location.replace("{{ route('pensiun.index')}}");;
						});
				}else{
					Swal.fire({
						type  : 'info',
						title : 'Hanya boleh ada satu data, entri dibatalkan.',
						text  : 'Info',
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
