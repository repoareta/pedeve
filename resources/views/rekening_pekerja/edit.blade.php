@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Rekening Per Pegawai </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Rekening Per Pegawai </a>
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
					Edit Rekening Per Pegawai
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
									Header Rekening Per Pegawai
								</h5>	
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Nopek<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="nopek" type="text" value="{{$nopek}}" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Bank<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="kdbank"  class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Bank Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									@foreach ($data_bank as $data)
									<option value="{{ $data->kode }}" <?php if($kdbank  == $data->kode ) echo 'selected' ; ?>>{{ $data->kode }} -- {{$data->nama}} -- {{$data->alamat}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Rekening<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="rekening" type="text" value="{{$rekening}}" size="20" maxlength="20" onkeypress="return hanyaAngka(event)" required oninvalid="this.setCustomValidity('Rekening Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Atas Nama<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="atasnama" type="text" value="{{$atasnama}}" size="30" maxlength="40" onkeyup="this.value = this.value.toUpperCase()" required oninvalid="this.setCustomValidity('Atas Nama Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
							</div>
						</div>
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('rekening_pekerja.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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

		$('#form-edit').submit(function(){
			$.ajax({
				url  : "{{route('rekening_pekerja.update')}}",
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
							window.location.replace("{{ route('rekening_pekerja.index')}}");;
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