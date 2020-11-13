@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Perbendaharaan - Data Pajak Tahunan </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
				Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan - Data Pajak Tahunan </a>
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
					Menu Tambah Perbendaharaan - Data Pajak Tahunan
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
									Header Menu Tambah - Data Pajak Tahunan
								</h5>	
							</div>
						</div>
					
						<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
						<div class="col-4">
							<input class="form-control" type="text" value="{{date('m')}}"   name="bulan" size="2" maxlength="2" readonly style="background-color:#DCDCDC; cursor:not-allowed">						
						</div>
							<div class="col-6" >
								<input class="form-control" type="text" value="{{date('Y')}}"   name="tahun" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
								<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
							</div>
						</div>

						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Pegawai<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="nopek" class="form-control kt-select2" style="width: 100% !important;" required oninvalid="this.setCustomValidity('Pegawai Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									@foreach($data_pegawai as $data)
									<option value="{{$data->nopeg}}">{{$data->nopeg}} -- {{$data->nama}}</option>
									@endforeach
									
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Jenis<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="jenis"  class="form-control kt-select2" style="width: 100% !important;" required oninvalid="this.setCustomValidity('Jenis Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="" >-Pilih Jenis-</option>
									<option value="24">Bonus</option>
									<option value="25">THR</option>
									<option value="39">UTD</option>
									<option value="40">Tantiem</option>
									<option value="41">Tab.Akhir Kontrak</option>
									<option value="42">ONH</option>
									<option value="43">Dinas</option>
									
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Nilai</label>
							<div class="col-10">
								<input class="form-control" name="nilai" type="text" value="" size="25" maxlength="25" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ','); setCustomValidity('')" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Pajak</label>
							<div class="col-10">
								<input class="form-control" name="pajak" type="text" value="" size="25" maxlength="25" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ','); setCustomValidity('')" autocomplete='off'>
							</div>
						</div>

						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('data_pajak.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			<!--end: Datatable -->
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		$('.kt-select2').select2().on('change', function() {
			// $(this).valid();
		});
		$('#form-create').submit(function(){
			$.ajax({
				url  : "{{route('data_pajak.store')}}",
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
						window.location.replace("{{ route('data_pajak.index') }}");
					});
				}else{
					Swal.fire({
						type  : 'info',
						title : 'Data Yang Diinput Sudah Ada.',
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
});

		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
