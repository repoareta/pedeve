@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Inisialisasi Saldo </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
				Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Inisialisasi Saldo </a>
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
					Menu Edit Inisialisasi Saldo
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
									Header Menu Edit Inisialisasi Saldo
								</h5>	
							</div>
						</div>
						@foreach($data_list as $data)
						<div class="form-group row">
							<label class="col-2 col-form-label">Jenis Kartu<span style="color:red;">*</span></label>
							<div class="col-10">
								<select class="form-control" data-live-search="true" disabled style="background-color:#DCDCDC; cursor:not-allowed">
									<option value="">- Pilih -</option>
									<option value="10" <?php if($data->jk == '10' ) echo 'selected' ; ?>>Kas(Rupiah)</option>
									<option value="11" <?php if($data->jk == '11' ) echo 'selected' ; ?>>Bank(Rupiah)</option>
									<option value="13" <?php if($data->jk == '13' ) echo 'selected' ; ?>>Bank(Dollar)</option>
									
								</select>							
								<input class="form-control" type="hidden" value="{{$data->jk}}"   name="jk" id="jk" size="6" maxlength="6">
							</div>
						</div>

						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Nokas<span style="color:red;">*</span></label>
							<div class="col-10">
									<input class="form-control" type="text" value="{{$data->kodestore}} -- {{$data->namabank}}"   size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
									<input class="form-control" type="hidden" value="{{$data->kodestore}}"   name="nokas" id="nokas" size="6" maxlength="6">
							</div>
						</div>
						<div class="form-group row">
							<label for="mulai-input" class="col-2 col-form-label">Saldo Akhir<span style="color:red;">*</span></label>
							<div class="col-10">
								<div class="input-daterange input-group" >
									<input type="number" class="form-control" name="saldoakhir"  value="{{number_format($data->saldoakhir,0,'','')}}" required  autocomplete='off' oninvalid="this.setCustomValidity('Saldo AKhir Harus Diisi..')" oninput="setCustomValidity('')" />
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="mulai-input" class="col-2 col-form-label">Tanggal Input<span style="color:red;">*</span></label>
							<div class="col-10">
								<div class="input-daterange input-group" >
								<?php
									$tgl = date_create($data->inputdate);
									$tanggal = date_format($tgl, 'Y-m-d');
								?>
									<input type="text" class="form-control" name="tanggal" id="tanggal" value="{{$tanggal}}" size="30" maxlength="30" required  autocomplete='off' oninvalid="this.setCustomValidity('Tanggal Input Harus Diisi..')" onchange="setCustomValidity('')"/>
								</div>
							</div>
						</div>
						@endforeach
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('inisialisasi_saldo.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {

$('#form-edit').submit(function(){
	$.ajax({
		url  : "{{route('inisialisasi_saldo.update')}}",
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
				window.location.replace("{{ route('inisialisasi_saldo.index') }}");;
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
			// autoclose: true,
			// language : 'id',
			format   : 'yyyy-mm-dd'
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
