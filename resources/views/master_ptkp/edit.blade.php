@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Master PTKP </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Master PTKP </a>
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
					Tambah Master PTKP
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
									Header Master PTKP
								</h5>	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Kode<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="kdkel" type="text" value="{{$kdkel}}" size="3" maxlength="3" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Nilai<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="nilai" type="text" value="{{number_format($nilai,2,'.','')}}" size="25" maxlength="25" required oninvalid="this.setCustomValidity('Nilai Harus Diisi..')" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');setCustomValidity('')" autocomplete='off'>
							</div>
						</div>
											
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('master_ptkp.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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

		$('#form-edit').submit(function(){
			$.ajax({
				url  : "{{route('master_ptkp.update')}}",
				type : "POST",
				data : $('#form-edit').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
					Swal.fire({
						type  : 'success',
						title : 'Data Berhasil Diubah',
						text  : 'Berhasil',
						timer : 2000
					}).then(function() {
							window.location.replace("{{ route('master_ptkp.index')}}");;
						});
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
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
