@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Set User </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Administrator </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Set User </a>
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
					Tambah Set User
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<form  class="kt-form kt-form--label-right" id="form-create">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Set User
								</h5>	
							</div>
						</div>
					
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">User ID<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="" name="userid" size="15" maxlength="10" title="User ID" onkeyup="this.value = this.value.toUpperCase()" autocomplete='off' required oninvalid="this.setCustomValidity('User ID Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">User Name<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="" name="usernm"  size="25" maxlength="20" title="User Name" onkeyup="this.value = this.value.toUpperCase()" autocomplete='off' required oninvalid="this.setCustomValidity('User Name Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">User Group</label>
							<div class="col-10">
								<select name="kode" class="form-control kt-select2">
									<option value="KONTROLER">KONTROLER</option>		
									<option value="CUSTOMER MANAGEMENT">CUSTOMER MANAGEMENT</option>
									<option value="PERBENDAHARAAN">PERBENDAHARAAN</option>
									<option value="SDM">SDM</option>
									<option value="UMUM">UMUM</option>
									<option value="ADMIN">SYSTEM ADMINISTRATOR</option>									
								</select>							
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">User Level</label>
							<div class="col-8">
								<div class="kt-radio-inline">
									<label class="kt-radio kt-radio--solid">
										<input type="radio"  name="userlv" value="0" > ADMINISTRATOR
										<span></span>
									</label>
									<label class="kt-radio kt-radio--solid">
										<input type="radio"    name="userlv" value="1" checked> USER
										<span></span>
									</label>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label for="" class="col-2 col-form-label">User Application</label>
							<div class="col-8">
								<div class="kt-checkbox-inline">
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"  name="akt" value="A" > Kontroler
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"  name="cm" value="G" > Customer Management
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="pbd" value="D"> Perbendaharaan
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="umu" value="E"> UMUM
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="sdm" value="F"> SDM
										<span></span>
									</label>
								</div>
							</div>
						</div>
						{{-- <div class="form-group row">
							<label for="" class="col-2 col-form-label">Nopeg Pekerja</label>
							<div class="col-10">
								<select class="form-control kt-select2" name="nopeg" id="nopeg">
									<option value="">- Pilih Nopek Pekerja -</option>
									@foreach ($pekerja_list as $pekerja)
									<option value="{{ $pekerja->nopeg }}">{{ $pekerja->nopeg." - ".$pekerja->nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">GCG Fungsi</label>
							<div class="col-10">
								<select class="form-control kt-select2" name="gcg_fungsi" id="gcg_fungsi">
									<option value="">- Pilih Fungsi -</option>
									@foreach ($gcg_fungsi_list as $fungsi)
									<option value="{{ $fungsi->id }}">{{ $fungsi->nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">GCG Jabatan</label>
							<div class="col-10">
								<select class="form-control kt-select2" name="gcg_jabatan" id="gcg_jabatan">
									<option value="">- Pilih Jabatan -</option>
									@foreach ($gcg_jabatan_list as $jabatan)
									<option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
									@endforeach
								</select>
							</div>
						</div> --}}
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Last Updated By</label>
							<div class="col-10">
								<input class="form-control" type="text" value="" style="background-color:#DCDCDC; cursor:not-allowed" readonly>
							</div>
						</div>
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('set_user.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
								</div>
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
		$('#tabel-detail-permintaan').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
		});

		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});

		$('#form-create').submit(function(){
			$.ajax({
				url  : "{{route('set_user.store')}}",
				type : "POST",
				data : $('#form-create').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
				if(data == 1){
					Swal.fire({
						type  : 'success',
						title : 'Data Berhasil Ditambah',
						text  : 'Berhasil',
						timer : 2000
					}).then(function(data) {
						window.location.replace("{{ route('set_user.index') }}");
						});
				}else{
					Swal.fire({
						type  : 'info',
						title : 'User ID '+data+' Sudah Ada.',
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
	});
	

  

		
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
