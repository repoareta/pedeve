@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Main Account </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kontroler </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Main Account </a>
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
					Tambah Main Account
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
									Header Main Account
								</h5>	
							</div>
						</div>
					
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Jenis<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="" name="jenis" size="50" maxlength="50" title="Jenis" onkeyup="this.value = this.value.toUpperCase()" autocomplete='off' required oninvalid="this.setCustomValidity('Jenis Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Batas Awal<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="" name="batasawal"  size="6" maxlength="6" title="Batas Awal" onkeyup="this.value = this.value.toUpperCase()" autocomplete='off' required oninvalid="this.setCustomValidity('Batas Awal Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Batas Akhir<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="" name="batasakhir"  size="6" maxlength="6" title="Batas Akhir" onkeyup="this.value = this.value.toUpperCase()" autocomplete='off' required oninvalid="this.setCustomValidity('Batas Akhir Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Urutan<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="" name="urutan"  size="6" maxlength="6" title="Urutan" onkeyup="this.value = this.value.toUpperCase()" autocomplete='off' required oninvalid="this.setCustomValidity('Urutan Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Pengali<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="number" value="" name="pengali"  size="6" maxlength="6" title="Pengali"  autocomplete='off' required oninvalid="this.setCustomValidity('Pengali Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Pengali Tampil<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="number" value="" name="pengalitampil"  size="6" maxlength="6" title="Pengali Tampil"  autocomplete='off' required oninvalid="this.setCustomValidity('Pengali Tampil Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Sub Akun<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="" name="subakun"  size="6" maxlength="6" title="Sub Akun" onkeyup="this.value = this.value.toUpperCase()" autocomplete='off' required oninvalid="this.setCustomValidity('Sub Akun Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Lokasi<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="" name="lokasi"  size="6" maxlength="6" title="Lokasi" onkeyup="this.value = this.value.toUpperCase()" autocomplete='off' required oninvalid="this.setCustomValidity('Lokasi Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('main_account.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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
				url  : "{{route('main_account.store')}}",
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
						window.location.replace("{{ route('main_account.index') }}");
						});
				}else{
					Swal.fire({
						type  : 'info',
						title : 'Duplikasi data dokumen, entri dibatalkan.',
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
