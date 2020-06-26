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
					Kontroler </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Set User </a>
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
					Edit Set User
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
								<input class="form-control" type="text" value="{{$userid}}" name="userid" size="15" maxlength="10" title="User ID" style="background-color:#DCDCDC; cursor:not-allowed" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">User Name<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$usernm}}" name="usernm"  size="25" maxlength="20" title="User Name" onkeyup="this.value = this.value.toUpperCase()" autocomplete='off' required oninvalid="this.setCustomValidity('User Name Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">User Group</label>
							<div class="col-10">
								<select name="kode" class="form-control selectpicker" data-live-search="true">
									<option value="KONTROLER" <?php if($kode  == 'KONTROLER' ) echo 'selected' ; ?>>KONTROLER</option>		
									<option value="TABUNGAN" <?php if($kode  == 'TABUNGAN' ) echo 'selected' ; ?>>TABUNGAN</option>
									<option value="PERBENDAHARAAN" <?php if($kode  == 'PERBENDAHARAAN' ) echo 'selected' ; ?>>PERBENDAHARAAN</option>
									<option value="INVESTASI" <?php if($kode  == 'INVESTASI' ) echo 'selected' ; ?>>INVESTASI</option>
									<option value="SDM" <?php if($kode  == 'SDM' ) echo 'selected' ; ?>>SDM</option>
									<option value="UMUM" <?php if($kode  == 'UMUM' ) echo 'selected' ; ?>>UMUM</option>
									<option value="ADMIN" <?php if($kode  == 'ADMIN' ) echo 'selected' ; ?>>SYSTEM ADMINISTRATOR</option>									
								</select>							
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">User Level</label>
							<div class="col-8">
								<div class="kt-radio-inline">
									<label class="kt-radio kt-radio--solid">
										<input type="radio"  name="userlv" value="0" <?php if($userlv  == '0' ) echo 'checked' ; ?>> ADMINISTRATOR
										<span></span>
									</label>
									<label class="kt-radio kt-radio--solid">
										<input type="radio"    name="userlv" value="1" <?php if($userlv  == '1' ) echo 'checked' ; ?>> USER
										<span></span>
									</label>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label for="" class="col-2 col-form-label">User Application</label>
							<div class="col-8">
								<div class="kt-checkbox-inline">
								<?php
								if(substr_count($userap,"A") > 0){
									$userp1 = "A"; 
								}else{ 
									$userp1="";
								} 
								if(substr_count($userap,"B") > 0){
									$userp2 = "B"; 
								}else{ 
									$userp2="";
								} 
								if(substr_count($userap,"C") > 0){
									$userp3 = "C"; 
								}else{ 
									$userp3="";
								} 
								if(substr_count($userap,"D") > 0){ 
									$userp4 = "D"; 
								}else{ 
									$userp4="";
								} 
								if(substr_count($userap,"E") > 0){ 
									$userp5 = "E"; 
								}else{ 
									$userp5="";
								} 
								if(substr_count($userap,"F") > 0){ 
									$userp6 = "F"; 
								}else{ 
									$userp6="";
								} 
								?>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"  name="akt" value="A" <?php if($userp1  == 'A' ) echo 'checked' ; ?>> Kontroler
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="tab" value="B" <?php if($userp2  == 'B' ) echo 'checked' ; ?>> Tabungan
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="inv" value="C" <?php if($userp3  == 'C' ) echo 'checked' ; ?>> Investasi
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="pbd" value="D" <?php if($userp4  == 'D' ) echo 'checked' ; ?>> Perbendaharaan
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="umu" value="E" <?php if($userp5  == 'E' ) echo 'checked' ; ?>> UMUM
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="sdm" value="F" <?php if($userp6  == 'F' ) echo 'checked' ; ?>> SDM
										<span></span>
									</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Last Updated By</label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$usrupd}}" style="background-color:#DCDCDC; cursor:not-allowed" readonly>
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

		$('#form-create').submit(function(){
			$.ajax({
				url  : "{{route('set_user.update')}}",
				type : "POST",
				data : $('#form-create').serialize(),
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
					}).then(function(data) {
						window.location.replace("{{ route('set_user.index') }}");
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
