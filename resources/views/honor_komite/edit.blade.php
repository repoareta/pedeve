@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Honorarium Komite/Rapat </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Sdm & Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Honorarium Komite/Rapat </a>
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
					Edit Honorarium Komite/Rapat
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
									Header Honorarium Komite/Rapat
								</h5>	
							</div>
						</div>
						@foreach($data_list as $row)
						<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
						<div class="col-5">
							<?php 
							$array_bln	 = array (
										1 =>   'Januari',
										'Februari',
										'Maret',
										'April',
										'Mei',
										'Juni',
										'Juli',
										'Agustus',
										'September',
										'Oktober',
										'November',
										'Desember'
									);
									$bulan= strtoupper($array_bln[$row->bulan]);
							?>
						<input class="form-control" type="text" value="{{$bulan}}"readonly style="background-color:#DCDCDC; cursor:not-allowed">
						<input class="form-control" type="hidden" value="{{$row->bulan}}" name="bulan">
								
						</div>
								<div class="col-5" >
									<input class="form-control" type="text" value="{{$row->tahun}}" name="tahun" readonly style="background-color:#DCDCDC; cursor:not-allowed">
									<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
								</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Pegawai<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$row->nopek}} - {{$row->nama_nopek}}"  readonly style="background-color:#DCDCDC; cursor:not-allowed">
								<input class="form-control" type="hidden" value="{{$row->nopek}}" name="nopek" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Nilai<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="nilai" type="text" value="<?php echo number_format($row->nilai, 2, '.', ''); ?>" required oninvalid="this.setCustomValidity('Nilai Harus Diisi..')" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');setCustomValidity('')" autocomplete='off'>
								<input type="hidden" value="<?php echo number_format($row->pajak, 2, '.', ''); ?>" name="pajak" id="pajak">
							</div>
						</div>
						@endforeach
						<div class="kt-form__actions">
							<div class="row">
								<div class="col"></div>
								<div class="col"></div>
								<div class="col-10">
									<a  href="{{route('honor_komite.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',627)->limit(1)->get() as $data_akses)
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
			<!--end: Datatable -->
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {

		$('#nilai').keyup(function(){
             var nilai=parseInt($('#nilai').val());
            var pajak=(35/65)*nilai;
			var a =parseInt(pajak);
             $('#pajak').val(a);
        });

		$('#form-edit').submit(function(){
			$.ajax({
				url  : "{{route('honor_komite.update')}}",
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
						window.location.replace("{{ route('honor_komite.index')}}");;
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
