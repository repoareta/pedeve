@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Master Unit </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kontroler </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Master Unit </a>
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
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Tambah Master Unit
				</h3>
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
								Header Master Unit
							</h5>	
						</div>
					</div>
				
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Kode Unit<span style="color:red;">*</span></label>
						<div class="col-10">
							<input  class="form-control" type="text" value=""  name="kode" size="6" maxlength="6" required oninvalid="this.setCustomValidity('Kode Unit Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeyup="this.value = this.value.toUpperCase()">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nama Unit<span style="color:red;">*</span></label>
						<div class="col-10">
							<input  class="form-control" type="text" value=""  name="nama" size="50" maxlength="50" required oninvalid="this.setCustomValidity('Nama Unit Harus Diisi..')" oninput="setCustomValidity('')"  autocomplete='off' onkeyup="this.value = this.value.toUpperCase()">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Perusahaan<span style="color:red;">*</span></label>
						<div class="col-10">
							<select name="perusahaan"  class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Perusahaan Harus Diisi..')" onchange="setCustomValidity('')">
								<option value="">-Pilih-</option>
									@foreach($data_perusahaan as $row)
								<option value="{{$row->kode}}" >{{$row->kode}} - {{$row->nama}}</option>
									@endforeach
							</select>						
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Alamat</label>
						<div class="col-10">
							<textarea cols="40" rows="3"  class="form-control" type="text" value=""  name="alamat"   autocomplete='off' > </textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Kota</label>
						<div class="col-10">
							<input  class="form-control" type="text" value=""  name="kota" size="46" maxlength="20"   autocomplete='off' >
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. Telepon</label>
						<div class="col-10">
							<input  class="form-control" type="text" value=""  name="telp"size="20" maxlength="15"   autocomplete='off' onkeypress="return hanyaAngka(event)">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. Fax</label>
						<div class="col-10">
							<input  class="form-control" type="text" value=""  name="facs" size="20" maxlength="15"  autocomplete='off' onkeypress="return hanyaAngka(event)">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Jabatan Kepada</label>
						<div class="col-10">
							<input  class="form-control" type="text" value=""  name="kepada" size="50" maxlength="50"   autocomplete='off' >
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">SK Dari</label>
						<div class="col-10">
							<input  class="form-control" type="text" value=""  name="skdari" size="50" maxlength="150"   autocomplete='off' >
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Tembusan</label>
						<div class="col-10">
							<input  class="form-control" type="text" value=""  name="tembusan" size="50" maxlength="100"   autocomplete='off' >
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Sandi Perkiraan</label>
						<div class="col-10">
							<input  class="form-control" type="text" value=""  name="sanper"  size="6" maxlength="6"   autocomplete='off' onkeypress="return hanyaAngka(event)">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Perbantuan</label>
						<div class="col-1">
							<input style="font-size:3px;"  class="form-control" type="checkbox" name="bantu" value="1">
						</div>
					</div>
					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<a  href="{{route('master_unit.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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

		$('#form-create').submit(function(){
			$.ajax({
			url  : "{{route('master_unit.store')}}",
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
						}).then(function() {
							window.location.replace("{{route('master_unit.index')}}");
						})
					}else{
						Swal.fire({
							type  : 'info',
							title : 'Kode Unit Sudah Di Gunakan.',
							text  : 'Info',
							timer : 2000
						})
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
