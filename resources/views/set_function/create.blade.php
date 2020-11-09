@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				User Function </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Administrator </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					User Function </a>
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
					Tambah User Function
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
									Header User Function
								</h5>	
							</div>
						</div>
					
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">User ID<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$userid}}" name="userid" id="userid" size="15" maxlength="10" title="User ID" style="background-color:#DCDCDC; cursor:not-allowed" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">User Name<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$usernm}}" name="usernm"  size="25" maxlength="20" title="User Name" style="background-color:#DCDCDC; cursor:not-allowed" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Menu ID<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="menuid" id="menuid" class="form-control kt-select2" required oninvalid="this.setCustomValidity('Menu ID Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>		
									@foreach($data_menuid as $data)
									<option value="{{$data->menuid}}">{{$data->menuid}} - {{$data->menunm}} - Tambah[{{$data->tambah}}] Ubah[{{$data->rubah}}] Hapus[{{$data->hapus}}] Cetak[{{$data->cetak}}] Lihat[{{$data->lihat}}]</option>	
									@endforeach	
																		
								</select>							
							</div>
						</div>

						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Privileges</label>
							<div class="col-8">
								<div class="kt-checkbox-inline">
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"  name="tambah" id="tambah" value="1" > Tambah
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="ubah" id="ubah" value="1"> Ubah
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="hapus" id="hapus" value="1"> Hapus
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="cetak" id="cetak" value="1"> Cetak
										<span></span>
									</label>
									<label class="kt-checkbox kt-checkbox--solid">
										<input type="checkbox"    name="lihat" id="lihat" value="1"> Lihat
										<span></span>
									</label>
								</div>
							</div>
						</div>
						
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('set_function.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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

		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});

		$("#menuid").on("change", function(){
			var userid = $('#userid').val();
			var menuid = $(this).val();

			$.ajax({
				url : "{{route('set_function.menuid.json')}}",
				type : "POST",
				dataType: 'json',
				data : {
					menuid:menuid,
					userid:userid
					},
				headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
					},
				success : function(data){
					if (data.tambah == 1) {
						$("#tambah").each(function() {
							this.checked=true;
						});
					}else{
						$("#tambah").each(function() {
							this.checked=false;
						});
					}
					if (data.rubah == 1) {
						$("#ubah").each(function() {
							this.checked=true;
						});
					}else{
						$("#ubah").each(function() {
							this.checked=false;
						});
					}
					if (data.hapus == 1) {
						$("#hapus").each(function() {
							this.checked=true;
						});
					}else{
						$("#hapus").each(function() {
							this.checked=false;
						});
					}
					if (data.cetak == 1) {
						$("#cetak").each(function() {
							this.checked=true;
						});
					}else{
						$("#cetak").each(function() {
							this.checked=false;
						});
					}
					if (data.lihat == 1) {
						$("#lihat").each(function() {
							this.checked=true;
						});
					}else{
						$("#lihat").each(function() {
							this.checked=false;
						});
					}
				},
				error : function(){
					alert("Ada kesalahan controller!");
				}
			})
		});

		$('#form-create').submit(function(){
			var userid = $('#userid').val();
			$.ajax({
				url  : "{{route('set_function.store')}}",
				type : "POST",
				data : $('#form-create').serialize(),
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
					}).then(function(data) {
						location.reload();
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
