@extends('layout.global')
<style type="text/css">
 #loader {

position: absolute;

left: 50%;

top: 50%;

z-index: 1;

width: 150px;

height: 150px;

margin: -75px 0 0 -75px;

border: 16px solid #f3f3f3;

border-radius: 50%;

border-top: 16px solid #3498db;

width: 120px;

height: 120px;

-webkit-animation: spin 2s linear infinite;

animation: spin 2s linear infinite;

}



@-webkit-keyframes spin {

0% { -webkit-transform: rotate(0deg); }

100% { -webkit-transform: rotate(360deg); }

}



@keyframes spin {

0% { transform: rotate(0deg); }

100% { transform: rotate(360deg); }

}



/* Add animation to "page content" */

.animate-bottom {

position: relative;

-webkit-animation-name: animatebottom;

-webkit-animation-duration: 1s;

animation-name: animatebottom;

animation-duration: 1s

}



@-webkit-keyframes animatebottom {

from { bottom:-100px; opacity:0 }

to { bottom:0px; opacity:1 }

}



@keyframes animatebottom {

from{ bottom:-100px; opacity:0 }

to{ bottom:0; opacity:1 }

}



#myDiv {

display: none;

}
</style>
@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Opening Balance </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Opening Balance </a>
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
					Tambah Opening Balance
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
									Header Opening Balance
								</h5>	
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Bulan<span style="color:red;">*</span></label>
							<div class="col-10">
							<?php 
								$tgl = date_create(now());
								$tahun = date_format($tgl, 'Y'); 
								$bulan = date_format($tgl, 'n'); 
							?>
								<select class="form-control kt-select2"  name="bulan">
									<option value="01" <?php if($bulan  == 1 ) echo 'selected' ; ?>>Januari</option>
									<option value="02" <?php if($bulan  == 2 ) echo 'selected' ; ?>>Februari</option>
									<option value="03" <?php if($bulan  == 3 ) echo 'selected' ; ?>>Maret</option>
									<option value="04" <?php if($bulan  == 4 ) echo 'selected' ; ?>>April</option>
									<option value="05" <?php if($bulan  == 5 ) echo 'selected' ; ?>>Mei</option>
									<option value="06" <?php if($bulan  == 6 ) echo 'selected' ; ?>>Juni</option>
									<option value="07" <?php if($bulan  == 7 ) echo 'selected' ; ?>>Juli</option>
									<option value="08" <?php if($bulan  == 8 ) echo 'selected' ; ?>>Agustus</option>
									<option value="09" <?php if($bulan  == 9 ) echo 'selected' ; ?>>September</option>
									<option value="10" <?php if($bulan  ==10  ) echo 'selected' ; ?>>Oktober</option>
									<option value="11" <?php if($bulan  == 11 ) echo 'selected' ; ?>>November</option>
									<option value="12" <?php if($bulan  == 12 ) echo 'selected' ; ?>>Desember</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Tahun<span style="color:red;">*</span></label>
								<div class="col-10" >
									<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off' required oninvalid="this.setCustomValidity('Tahun Harus Diisi...')" oninput="setCustomValidity('')">
								</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Suplesi<span style="color:red;">*</span></label>
								<div class="col-10" >
									<input class="form-control" type="text" value="0"   name="suplesi" size="2" maxlength="2" onkeypress="return hanyaAngka(event)" autocomplete='off' required oninvalid="this.setCustomValidity('Suplesi Harus Diisi...')" oninput="setCustomValidity('')">
								</div>
						</div>
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('opening_balance.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Process</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
	</div>
</div>
<div style="display:none;" id="loader"></div>
<div style="display:true;" id="myDiv" class="animate-bottom"></div>

@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});
		$('#form-create').submit(function(){
			$('#loader').show();
			$.ajax({
				url  : "{{route('opening_balance.store')}}",
				type : "POST",
				data : $('#form-create').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
				if(data == 1){
					$('#loader').hide();
					Swal.fire({
						type  : 'success',
						title : 'Data Berhasil Ditambah',
						text  : 'Berhasil',
						timer : 2000
					}).then(function(data) {
						window.location.replace("{{ route('opening_balance.index') }}");
						});
				}else if(data == 2){
					$('#loader').hide();
					Swal.fire({
						type  : 'info',
						title : 'Data sudah ada, entri dibatalkan',
						text  : 'Info',
					});
				}else{
					$('#loader').hide();
					Swal.fire({
						type  : 'info',
						title : 'Opening balance terakhir adalah! ' +data,
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
