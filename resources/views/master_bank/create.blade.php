@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Master Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Master Bank </a>
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
					Tambah Master Bank
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
									Header Master Bank
								</h5>	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Kode<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="kode" type="text" value="" size="2" maxlength="2" onkeyup="this.value = this.value.toUpperCase()" required oninvalid="this.setCustomValidity('Kode Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Nama<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="nama" type="text" value="" size="40" maxlength="50" onkeyup="this.value = this.value.toUpperCase()" required oninvalid="this.setCustomValidity('Nama Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Alamat<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="alamat" type="text" value="" size="40" maxlength="50" onkeyup="this.value = this.value.toUpperCase()" required oninvalid="this.setCustomValidity('Alamat Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Kota<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="kota" type="text" value="" size="40" maxlength="50" onkeyup="this.value = this.value.toUpperCase()" required oninvalid="this.setCustomValidity('Kota Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
							</div>
						</div>
											
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('master_bank.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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
				url  : "{{route('master_bank.store')}}",
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
							window.location.replace("{{ route('master_bank.index')}}");;
						});
				}else{
					Swal.fire({
						type  : 'info',
						title : 'Duplikasi data, entri dibatalkan.',
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
	});
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
