@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Setting Bulan Buku </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Setting Bulan Buku </a>
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
					Edit Setting Bulan Buku
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<form  class="kt-form kt-form--label-right" id="form-edit">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Setting Bulan Buku
								</h5>	
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
							<div class="col-4">
							<?php 
								$tgl = date_create(now());
								$tahun = substr($thnbln,0,-2); 
								$bulan = substr($thnbln,4); 
							?>
									<input class="form-control" type="text" value="{{$bulan}}"   name="bulan" size="2" maxlength="2" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
									<div class="col-4" >
										<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
									</div>
									<div class="col-2" >
										<input class="form-control" type="text" value="{{$suplesi}}"   name="suplesi" size="2" maxlength="2" onkeypress="return hanyaAngka(event)" autocomplete='off' required oninvalid="this.setCustomValidity('Suplesi Harus Diisi...')" oninput="setCustomValidity('')">
									</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Keterangan<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$keterangan}}" name="keterangan"  size="35" maxlength="35" title="Keterangan" autocomplete='off' required oninvalid="this.setCustomValidity('Keterangan Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>

						<div class="form-group row">
							<label for="" class="col-2 col-form-label"></label>
							<div class="col-3">
								<div class="kt-radio-inline">
									<label class="kt-radio kt-radio--solid">
										<input value="1" <?php if ($status == '1' )  echo 'checked' ; ?> type="radio"  name="status"> Opening 
										<span></span>
									</label>
								</div>
							</div>
							<label for="" class="col-2 col-form-label">Tanggal Opening</label>
							<div class="col-5">
								<input class="form-control" type="text" value="{{$tanggal}}" name="tanggal" id="tanggal"  size="11" maxlength="11" title="Tanggal Opening" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label"></label>
							<div class="col-3">
								<div class="kt-radio-inline">
									<label class="kt-radio kt-radio--solid">
										<input value="2" <?php if ($status == '2' )  echo 'checked' ; ?> type="radio"    name="status"> Stoping
										<span></span>
									</label>
								</div>
							</div>
							<label for="" class="col-2 col-form-label">Tanggal Stoping</label>
							<div class="col-5">
								<input class="form-control" type="text" value="{{$tanggal2}}" name="tanggal2" id="tanggal2" size="11" maxlength="11" title="Tanggal Stoping" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label"></label>
							<div class="col-3">
								<div class="kt-radio-inline">
									<label class="kt-radio kt-radio--solid">
										<input value="3" <?php if ($status == '3' )  echo 'checked' ; ?> type="radio"    name="status"> Closing
										<span></span>
									</label>
								</div>
							</div>
							<label for="" class="col-2 col-form-label">Tanggal Closing</label>
							<div class="col-5">
								<input class="form-control" type="text" value="{{$tanggal3}}" name="tanggal3" id="tanggal3"  size="11" maxlength="11" title="Tanggal Closing" autocomplete='off'>
							</div>
						</div>
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('bulan_perbendaharaan.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',507)->limit(1)->get() as $data_akses)
									@if($data_akses->rubah == 1)
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
									@endif
									@endforeach
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

		$('#form-edit').submit(function(){
			$.ajax({
				url  : "{{route('bulan_perbendaharaan.update')}}",
				type : "POST",
				data : $('#form-edit').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
					Swal.fire({
						type  : 'success',
						title : 'Data Berhasil Diedit',
						text  : 'Berhasil',
						timer : 2000
					}).then(function(data) {
						window.location.replace("{{ route('bulan_perbendaharaan.index') }}");
						});
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});

		$('#tanggal').datepicker({
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
			// language : 'id',
			format   : 'dd-mm-yyyy'
		});
		$('#tanggal2').datepicker({
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
			// language : 'id',
			format   : 'dd-mm-yyyy'
		});
		$('#tanggal3').datepicker({
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
			// language : 'id',
			format   : 'dd-mm-yyyy'
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
