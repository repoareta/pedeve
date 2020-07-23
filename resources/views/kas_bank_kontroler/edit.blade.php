@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Kas Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kontroler </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kas Bank </a>
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
					Edit Kas Bank
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
									Header Kas Bank
								</h5>	
							</div>
						</div>
					
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Kode<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$kode}}" name="kode" size="2" maxlength="2" title="Kode" style="background-color:#DCDCDC; cursor:not-allowed" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Nama<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$nama}}" name="nama"  size="30" maxlength="30" title="Nama" onkeyup="this.value = this.value.toUpperCase()" autocomplete='off' required oninvalid="this.setCustomValidity('Nama Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Jenis Kartu<span style="color:red;">*</span></label>
							<div class="col-10">
									<select class="form-control selectpicker" data-live-search="true" name="jk" required oninvalid="this.setCustomValidity('Jenis Kartu Harus Diisi...')" onchange="setCustomValidity('')">
										<option value="">--Pilih Jenis Kartu--</option>
										<option value="10"  <?php if($jk  == '10' ) echo 'selected' ; ?>>Kas (Rupiah)</option>
										<option value="11"  <?php if($jk  == '11' ) echo 'selected' ; ?>>Bank (Rupiah)</option>
										<option value="13"  <?php if($jk  == '13' ) echo 'selected' ; ?>>Bank (Dollar)</option>
									</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="dari-input" class="col-2 col-form-label">Sandi Perkiraan<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="sanper" class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Debet Dari Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">--Pilih--</option>
									@foreach($data_sanper as $data)
									<option value="{{$data->kodeacct}}"  <?php if($sanper  == $data->kodeacct ) echo 'selected' ; ?>>{{$data->kodeacct}} -- {{$data->descacct}}</option>
									@endforeach
								</select>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">No.Rekening<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$norek}}" name="norek"  size="20" maxlength="20" title="No. rekening"  onkeypress="return hanyaAngka(event)" autocomplete='off' required oninvalid="this.setCustomValidity('No. Rekening Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Currency Index<span style="color:red;">*</span></label>
							<div class="col-10">
									<select class="form-control selectpicker" data-live-search="true" name="ci" >
										<option value="1"  <?php if($ci  == '1' ) echo 'selected' ; ?>>Rp</option>
										<option value="2"  <?php if($ci  == '2' ) echo 'selected' ; ?>>US$</option>
									</select>
							</div>
						</div>
						
						<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Lokasi<span style="color:red;">*</span></label>
							<div class="col-10">
									<select class="form-control selectpicker" data-live-search="true" name="lokasi" >
										<option value="MD"  <?php if($lokasi  == 'MD' ) echo 'selected' ; ?>>MD</option>
										<option value="MS"  <?php if($lokasi  == 'MS' ) echo 'selected' ; ?>>MS</option>
									</select>
							</div>
						</div>


						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('kas_bank_kontroler.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',206)->limit(1)->get() as $data_akses)
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
				url  : "{{route('kas_bank_kontroler.update')}}",
				type : "POST",
				data : $('#form-edit').serialize(),
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
						window.location.replace("{{ route('kas_bank_kontroler.index') }}");
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
