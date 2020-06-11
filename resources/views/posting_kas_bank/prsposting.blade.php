@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Posting Kas Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kontroler </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Posting Kas Bank </a>
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
					Posting Kas Bank
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<!--begin: Datatable -->
			<form  class="kt-form kt-form--label-right" id="form-create">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Posting Kas Bank
								</h5>	
							</div>
						</div>
					
						
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">No.Kas<span style="color:red;">*</span></label>
							<div class="col-8">
								<select name="nokas" id="nokas" class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('No. Kas Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">-- Pilih --</option>
									@foreach($data_kas as $data)
									<option value="{{$data->store}}">{{$data->store}}  --  {{$data->bank}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="mulai-input" class="col-2 col-form-label">Tanggal<span style="color:red;">*</span></label>
							<div class="col-8">
								<div class="input-daterange input-group" id="date_range_picker">
									<input type="text" class="form-control" name="tanggal" autocomplete="off" required oninvalid="this.setCustomValidity('Mulai Harus Diisi..')" onchange="setCustomValidity('')" />
									<div class="input-group-append">
										<span class="input-group-text">S/d</span>
									</div>
									<input type="text" class="form-control" name="tanggal2" autocomplete="off" required oninvalid="this.setCustomValidity('Sampai Harus Diisi..')" onchange="setCustomValidity('')"/>
								</div>
							</div>
						</div>
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('postingan_kas_bank.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Process</button>
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
			var nokas = $("#nokas").val();
			$.ajax({
				url  : "{{route('postingan_kas_bank.store.prsposting')}}",
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
							title : 'Proses posting kas bank '+nokas+' selesai',
							text  : 'Berhasil',
						}).then(function() {
								window.location.replace("{{ route('postingan_kas_bank.index') }}");;
							});
					}else if(data == 2){
						Swal.fire({
							type  : 'info',
							title : 'Proses posting gagal, hanya untuk tanggal transaksi di bulan buku aktif.',
							text  : 'Failed',
						});
					}else if(data == 3){
						Swal.fire({
							type  : 'info',
							title : 'Bulan buku pembayaran/penerimaan tidak sama dengan bulan buku akuntansi.',
							text  : 'Failed',
						});
					}else if(data == 4){
						Swal.fire({
							type  : 'info',
							title : 'Lokasi jk dan bank tidak sesuai.',
							text  : 'Failed',
						});
					}else{
						Swal.fire({
							type  : 'info',
							title : 'Tidak ada data yang akan di posting pada range tanggal diatas.',
							text  : 'Failed',
						});
					}
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});
		
		var KTBootstrapDatepicker = function () {

		var arrows;
		if (KTUtil.isRTL()) {
			arrows = {
				leftArrow: '<i class="la la-angle-right"></i>',
				rightArrow: '<i class="la la-angle-left"></i>'
			}
		} else {
			arrows = {
				leftArrow: '<i class="la la-angle-left"></i>',
				rightArrow: '<i class="la la-angle-right"></i>'
			}
		}

		// Private functions
		var demos = function () {

			// range picker
			$('#date_range_picker').datepicker({
				rtl: KTUtil.isRTL(),
				todayHighlight: true,
				templates: arrows,
				autoclose: true,
				// language : 'id',
				format   : 'yyyy-mm-dd',
				orientation: 'bottom'
			});
		};

		return {
			// public functions
			init: function() {
				demos(); 
			}
		};
		}();

		KTBootstrapDatepicker.init(); 
	});
	

  

		
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
