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
					Edit Pensiun
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
									Header Pensiun
								</h5>	
							</div>
						</div>
						@foreach($data_list as $data)
						<div class="form-group row">
							<label class="col-2 col-form-label">Pribadi<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text"  required  name="pribadi1" size="20" maxlength="20" value="<?php echo number_format($data->pribadi, 2, '.', '') ?>" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');setCustomValidity('')">
								<input class="form-control" type="hidden"  required name="pribadi"  size="20" maxlength="20" value="{{$data->pribadi}}" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Perusahaan Direksi<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="perusahaan" type="text" value="<?php echo number_format($data->perusahaan, 2, '.', '') ?>" size="20" maxlength="20" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');setCustomValidity('')"  >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Perusahaan Pekerja<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="perusahaan2" type="text" value="<?php echo number_format($data->perusahaan2, 2, '.', '') ?>" size="20" maxlength="20" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');setCustomValidity('')" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Perusahaan Direksi(BNI)<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="perusahaan3" type="text" value="<?php echo number_format($data->perusahaan3, 2, '.', '') ?>" size="20" maxlength="20" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');setCustomValidity('')"  >
							</div>
						</div>
						@endforeach
						
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('pensiun.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',301)->limit(1)->get() as $data_akses)
									@if($data_akses->rubah == 1)
									<button type="submit" id="btn-save" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
									@endif
									@endforeach
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

		$('#form-edit').submit(function(){
			$.ajax({
				url  : "{{route('pensiun.update')}}",
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
					title : 'Data Berhasil Diubah',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
						window.location.replace("{{ route('pensiun.index')}}");;
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
