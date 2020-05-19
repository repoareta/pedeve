@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Rekap Harian Kas Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
				Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Rekap Harian Kas Bank </a>
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
					Menu Tambah Rekap Harian Kas Bank
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
									Header Menu Rekap Harian Kas Bank
								</h5>	
							</div>
						</div>
					@foreach($data_list as $data)
						<div class="form-group row">
							<label class="col-2 col-form-label">Tanggal Rekap</label>
							<div class="col-10">
								<input class="form-control" type="hidden" name="add" value="add">
								<?php $tglrek = date_create($data->tglrekap);
								$tglrekap = date_format($tglrek, 'Y-m-d'); ?>
								<input class="form-control" type="text" name="tanggal" id="tanggal" value="{{$tglrekap}}" size="11" maxlength="11"  autocomplete='off' readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Jenis Kartu<span style="color:red;">*</span></label>
							<div class="col-10">
							<input class="form-control" type="text" name="jk" id="jk" value="{{$data->jk}}" size="11" maxlength="11"  autocomplete='off' readonly style="background-color:#DCDCDC; cursor:not-allowed">							
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">No. Kas/Bank<span style="color:red;">*</span></label>
							<div class="col-10">
							<input class="form-control" type="text" name="nokas" id="nokas" value="{{$data->store}}" size="11" maxlength="11"  autocomplete='off' readonly style="background-color:#DCDCDC; cursor:not-allowed">
								<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
							</div>
						</div>
					@endforeach
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('rekap_harian_kas.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" class="btn btn-brand" name="submit" ><i class="fa fa-check" aria-hidden="true"></i>Save</button>
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
var tanggal = $('#tanggal').val();
	$.ajax({
		url  : "{{route('rekap_harian_kas.update')}}",
		type : "POST",
		data : $('#form-edit').serialize(),
		dataType : "JSON",
		headers: {
		'X-CSRF-Token': '{{ csrf_token() }}',
		},
		success : function(data){
		console.log(data);
		if(data == 1){
			Swal.fire({
				type  : 'success',
				title : 'pembatalan rekap selesai',
				text  : 'Berhasil',
				timer : 2000
			}).then(function() {
				location.replace("{{route('rekap_harian_kas.index')}}");
				});
		}else if(data == 2){
			Swal.fire({
				type  : 'info',
				title : 'belum dilakukan rekap !',
				text  : 'Info',
			});
		}else if(data == 3){
			Swal.fire({
				type  : 'info',
				title : 'pembatalan rekap gagal!',
				text  : 'Info',
			});
		}else{
			Swal.fire({
				type  : 'info',
				title : 'sudah ada rekap harian pada tanggal '+tanggal+', cancel rekap tanggal tersebut terlebih dahulu',
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
