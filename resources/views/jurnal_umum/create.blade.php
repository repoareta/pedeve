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
			<form  class="kt-form kt-form--label-right" id="form-create">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Menu Tambah Rekap Harian Kas Bank
								</h5>	
							</div>
						</div>
					
						<div class="form-group row">
							<label class="col-2 col-form-label">Tanggal Rekap</label>
							<div class="col-10">
								<input class="form-control" type="hidden" name="add" value="add">
								<input class="form-control" type="text" name="tanggal" id="tanggal" value="{{(date('Y-m-d'))}}" size="11" maxlength="11"  autocomplete='off' required oninvalid="this.setCustomValidity('Tanggal Rekap Harus Diisi..')" onchange="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Jenis Kartu<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="jk" id="jk" class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Jenis Kartu Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									<option value="10">Kas(Rupiah)</option>
									<option value="11">Bank(Rupiah)</option>
									<option value="13">Bank(Dollar)</option>
									
								</select>							
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">No. Kas/Bank<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="nokas" id="nokas" class="form-control" data-live-search="true" required oninvalid="this.setCustomValidity('No. Kas/Bank Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									
									
								</select>
								<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
							</div>
						</div>
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



$('#form-create').submit(function(){
	$.ajax({
		url  : "{{route('rekap_harian_kas.store')}}",
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
				location.replace("{{route('rekap_harian_kas.index')}}");
				});
		}else if(data == 2){
			Swal.fire({
				type  : 'info',
				title : 'rekap gagal !',
				text  : 'Info',
			});
		}else if(data == 3){
			Swal.fire({
				type  : 'info',
				title : 'rekap harian sudah dilakukan sebelumnya, rekap gagal!',
				text  : 'Info',
			});
		}else if(data == 4){
			Swal.fire({
				type  : 'info',
				title : 'rekap harian ini sudah ada!',
				text  : 'Info',
			});
		}else{
			Swal.fire({
				type  : 'info',
				title : 'rekap kas sudah dilakukan!',
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

$("#tanggal").on("change", function(){
var tanggal = $('#tanggal').val();
	$.ajax({
		url : "{{route('rekap_harian_kas.jenis.kartu.json')}}",
		type : "POST",
		dataType: 'json',
		data : {
			tanggal:tanggal
			},
		headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
			},
		success : function(data){
			if(data == 1){
				Swal.fire({
				type  : 'info',
				title : 'Tidak Di temuka Data kas Bank Pada Tanggal '+tanggal,
				text  : 'Failed',
			});
			}else{
				$('#jk').val(data.jk).trigger('change');
			}
		},
		error : function(){
			alert("Terjadi kesalahan, coba lagi nanti");
		}
	})
});
$("#jk").on("change", function(){
var tanggal = $('#tanggal').val();
var jk = $('#jk').val();
	$.ajax({
		url : "{{route('rekap_harian_kas.nokas.json')}}",
		type : "POST",
		dataType: 'json',
		data : {
			jk:jk,
			tanggal:tanggal
			},
		headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
			},
		success : function(data){
			if(data == 1){
				Swal.fire({
				type  : 'info',
				title : 'Tidak Di temuka Data kas Bank Pada Tanggal '+tanggal,
				text  : 'Failed',
			});
			}else{
				$('#nokas').html(data.html);
			}
		},
		error : function(){
			alert("Terjadi kesalahan, coba lagi nanti");
		}
	})
});


$('#tanggal').datepicker({
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
