@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Penempatan Deposito </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Penempatan Deposito </a>
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
					Edit Penempatan Deposito
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
									Header Penempatan Deposito
								</h5>	
							</div>
						</div>
						@foreach($data_list as $data)
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">No. Dokumen<span style="color:red;">*</span></label>
							<div class="col-10">
									<input class="form-control" type="text" value="{{$data->docno}}"   name="nodok" id="nodok" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
									<input class="form-control" type="hidden" value="{{$data->kurs}}"   name="kurs" id="kurs" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
									<input class="form-control" type="hidden" value="{{$data->lineno}}"   name="lineno" id="lineno" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
									<input class="form-control" type="hidden" value="{{$data->keterangan}}"   name="keterangan" id="keterangan" size="50" maxlength="50" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Asal<span style="color:red;">*</span></label>
							<div class="col-10">
								<input  class="form-control" type="text" value="{{$data->asal}}" id="asal" name="asal" size="2" maxlength="2" onkeyup="this.value = this.value.toUpperCase()" required oninvalid="this.setCustomValidity('Asal Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' >
								<input  class="form-control" type="hidden" value="{{$data->perpanjangan}}" id="perpanjangan" name="perpanjangan" size="2" maxlength="2" onkeyup="this.value = this.value.toUpperCase()" required oninvalid="this.setCustomValidity('Asal Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' >
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Bank<span style="color:red;">*</span></label>
							<div class="col-10">
								<input  class="form-control" type="text" value="{{$data->namabank}}" id="namabank" name="namabank" size="30" maxlength="30" onkeyup="this.value = this.value.toUpperCase()" required oninvalid="this.setCustomValidity('Nama Bank Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' >
								<input  class="form-control" type="hidden" value="{{$data->kdbank}}" id="kdbank" name="kdbank" size="30" maxlength="30" required oninvalid="this.setCustomValidity('Nama Bank Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' >
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Nominal<span style="color:red;">*</span></label>
							<div class="col-10">
								<input  class="form-control" type="number" value="{{number_format($data->nominal,0,'','')}}" id="nominal" name="nominal" size="15" maxlength="15" required oninvalid="this.setCustomValidity('Nominal Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' >
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Tgl Deposito<span style="color:red;">*</span></label>
							<div class="col-10">
								<input  class="form-control" type="text" value="<?php $tgl= date_create($data->tgldep); echo date_format($tgl, 'Y-m-d') ?>" id="tanggal" name="tanggal" size="15" maxlength="15" required oninvalid="this.setCustomValidity('Tgl Deposito Harus Diisi..')" onchange="setCustomValidity('')" autocomplete='off' >
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Jatuh Tempo<span style="color:red;">*</span></label>
							<div class="col-10">
								<input  class="form-control" type="text" value="<?php $tgl= date_create($data->tgltempo); echo date_format($tgl, 'Y-m-d') ?>" id="tanggal2" name="tanggal2" size="15" maxlength="15" required oninvalid="this.setCustomValidity('Jatuh Tempo Harus Diisi..')" onchange="setCustomValidity('')" autocomplete='off' >
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Bunga % Tahun<span style="color:red;">*</span></label>
							<div class="col-10">
								<input  class="form-control" type="number" value="{{number_format($data->bungatahun,0,'','')}}" id="tahunbunga" name="tahunbunga" size="15" maxlength="15" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':''" required oninvalid="this.setCustomValidity('Bungan % Tahun Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' >
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">No. Seri<span style="color:red;">*</span></label>
							<div class="col-10">
								<input  class="form-control" type="text" value="{{$data->noseri}}" id="noseri" name="noseri" size="15" maxlength="15" onkeyup="this.value = this.value.toUpperCase()" required oninvalid="this.setCustomValidity('No. Seri Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' >
							</div>
						</div>
						@endforeach
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col"></div>
								<div class="col"></div>
								<div class="col-10">
									<a  href="{{route('perhitungan_bagihasil.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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
				url  : "{{route('perhitungan_bagihasil.update')}}",
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
							window.location.replace("{{ route('perhitungan_bagihasil.index')}}");;
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
			format   : 'yyyy-mm-dd'
		});
		$('#tanggal2').datepicker({
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
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
