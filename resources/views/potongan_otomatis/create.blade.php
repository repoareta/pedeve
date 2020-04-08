@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Potongan Otomatis </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Sdm & Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Potongan Otomatis </a>
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
					Tambah Potongan Otomatis
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
									Header Potongan Otomatis
								</h5>	
							</div>
						</div>
						<input class="form-control" type="hidden" name="userid" value="{{Auth::user()->userid}}">
						@foreach($data_list as $row)
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Pegawai<span style="color:red;">*</span></label>
							<div class="col-10">
								<!-- <select name="nopek" id="nopek" class="form-control selectpicker" data-live-search="true" required autocomplete='off'>
									<option value="">- Pilih -</option>
									@foreach($data_pegawai as $data)
									
									<option value="{{$data->nopeg}}" <?php if($data->nopeg  == $row->nopek ) echo 'selected' ; ?>>{{$data->nopeg}} - {{$data->nama}} - 
									<?php 
										if($data->status == 'P'){
											 echo "Pensiun";
										}elseif($data->status == 'C'){
											 echo "Aktif";
										}elseif($data->status == 'K'){
											 echo "Kontrak";
										}elseif($data->status == 'B'){
											 echo "Perbantuan";
										}elseif($data->status == 'D'){
											 echo "Direksi";
										}elseif($data->status == 'N'){
											 echo "Pekerja Baru";
										}elseif($data->status == 'U'){
											 echo "Komisarias";
										}else{
											 echo "";
										}

									?>
									</option>
									@endforeach
								</select> -->
								<input type="text" class="form-control" value="{{$row->nopek}}-{{$row->nama_pegawai}}" style="background-color:#DCDCDC; cursor:not-allowed" >
								<input type="hidden" class="form-control" value="{{$row->nopek}}" name="nopeks" >
							</div>
						</div>
						<!-- <div class="form-group row">
							<label for="" class="col-2 col-form-label">Hutang<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="aard" id="aard" class="form-control selectpicker" data-live-search="true" required autocomplete='off'>
									<option value="">- Pilih -</option>
									@foreach($pay_hutang as $data)
									<option value="{{$data->kode}}" <?php if($data->kode  == $row->aardhut ) echo 'selected' ; ?>>{{$data->kode}} - {{$data->nama}} -  KENA PAJAK : 
										<?php 
										if($data->kenapajak == 'Y'){
											echo "IYA";
										}else{
											 echo "TIDAK";
										}

									?>
									</option>
									@endforeach
								</select>
							</div>
						</div> -->
						<div class="form-group row">
							<label for="nopek-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
							<div class="col-10">
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
								<input class="form-control" type="text"  value="<?php echo $bulan ?>/{{$row->tahun}}"  size="7" maxlength="7" required  autocomplete='off' readonly style="background-color:#DCDCDC; cursor:not-allowed">
								<input type="hidden" value="{{$row->bulan}}" name="bulan">
								<input type="hidden" value="{{$row->tahun}}" name="tahun">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Potongan<span style="color:red;">*</span></label>
							<div class="col-10">
								<!-- <select name="aard" id="aard" class="form-control selectpicker" data-live-search="true" required autocomplete='off'>
									<option value="">- Pilih -</option>
									@foreach($pay_aard as $data)
									<option value="{{$data->kode}}" <?php if($data->kode  == $row->aardpot ) echo 'selected' ; ?>>{{$data->kode}} - {{$data->nama}}</option>
									@endforeach
								</select> -->
								<input type="text" class="form-control" value="{{$row->aardpot}} - {{$row->nama_aard}}" style="background-color:#DCDCDC; cursor:not-allowed" >
								<input type="hidden" value="{{$row->kode}}" name="aardpots">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Total Hutang<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="total" type="text" value="<?php echo number_format($row->totalhut, 0, '', ''); ?>" id="nilai" required oninvalid="this.setCustomValidity('Nilai Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Sisa Hutang<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="total" type="text" value="<?php echo number_format($row->akhir, 0, '', ''); ?>" id="nilai" required oninvalid="this.setCustomValidity('Nilai Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Jumlah Cicilan<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="total" type="text" value="<?php echo number_format($row->jmlcc, 0, '', ''); ?>" id="nilai" required oninvalid="this.setCustomValidity('Nilai Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Cicilan Ke-<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="total" type="text" value="<?php echo number_format($row->ccl, 0, '', ''); ?>" id="nilai" required oninvalid="this.setCustomValidity('Nilai Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Nilai Cicilan<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="total" type="text" value="<?php echo number_format($row->nilai, 0, '', ''); ?>" id="nilai" required oninvalid="this.setCustomValidity('Nilai Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						@endforeach
						
						<div style="float:right;">
							<div class="kt-form__actions">
								<a  href="{{route('potongan_otomatis.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
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
				url  : "{{route('potongan_otomatis.store')}}",
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
					title : 'Data Berhasil Ditambah',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
						window.location.replace("{{ route('potongan_otomatis.index')}}");;
					});
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});

		$('#nilai').keyup(function(){
             var nilai=parseInt($('#nilai').val());
            var pajak=(35/65)*nilai;
			var a =parseInt(pajak);
             $('#pajak').val(a);
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

	// minimum setup
	$('#tgldebet').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'mm/yyyy'
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
