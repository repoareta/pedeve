@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Vendor </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Vendor </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Vendor </a>
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
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
			<h3 class="kt-portlet__head-title">
				Tambah Vendor
			</h3>
		</div>
	</div>
	<div class="">
		<div class="card-body table-responsive" >
		<!--begin: Datatable -->
		<form  class="kt-form kt-form--label-right" id="form-edit-vendor">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							<h5 class="kt-portlet__head-title">
								Header Vendor
							</h5>	
						</div>
					</div>
                    @foreach($data_vendor as $data)
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nama Vendor<span style="color:red;">*</span></label>
						<div class="col-10">
                            <input type="hidden" value="{{$data->vendorid}}" name="vendorid">
							<input  class="form-control" type="text" value="{{$data->nama}}" id="nama" name="nama"  required oninvalid="this.setCustomValidity('Nama Vendor Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="nopek-input" class="col-2 col-form-label">No. Rekening<span style="color:red;">*</span></label>
						<div class="col-10">
							<input class="form-control" type="text" name="norek" value="{{$data->norek}}"  id="norek" size="20" maxlength="20"  required oninvalid="this.setCustomValidity('Alamat Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>

						</div>
					</div>
					<div class="form-group row">
						<label for="nopek-input" class="col-2 col-form-label">Alamat Vendor<span style="color:red;">*</span></label>
						<div class="col-10">
							<textarea class="form-control" type="text" name="alamat" value=""  id="alamat"  required oninvalid="this.setCustomValidity('Alamat Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>{{$data->alamat}}</textarea>

						</div>
					</div>
					<div class="form-group row">
						<label for="nopek-input" class="col-2 col-form-label">Telp Vendor<span style="color:red;">*</span></label>
						<div class="col-10">
							<input class="form-control" type="text" name="telp" value="{{$data->telpon}}"  id="telp" size="15" maxlength="15" required oninvalid="this.setCustomValidity('Telp Vendor Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">

						</div>
                    </div>
                    @endforeach
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<a  href="{{route('vendor.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
$('#form-edit-vendor').submit(function(){
			$.ajax({
				url  : "{{route('vendor.store')}}",
				type : "POST",
				data : $('#form-edit-vendor').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
				console.log(data);
				Swal.fire({
					type  : 'success',
					title : 'Data Vendor Berhasil Diubah',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
						window.location.replace("{{ route('vendor.index') }}");;
					});
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});

	function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
