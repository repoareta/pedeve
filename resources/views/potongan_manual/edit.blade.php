@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Potongan Manual </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Sdm & Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Potongan Manual </a>
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
					Edit Potongan Manual
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
									Header Potongan Manual
								</h5>	
							</div>
						</div>
						@foreach($data_list as $data)
						<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Bulan Gaji<span style="color:red;">*</span></label>
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
									$bulan= strtoupper($array_bln[$data->bulan]);
							?>
						<input class="form-control" type="text" value="{{$bulan}}"readonly style="background-color:#DCDCDC; cursor:not-allowed">
						<input class="form-control" type="hidden" value="{{$data->bulan}}" name="bulan">
								
						</div>
								<div class="col-5" >
									<input class="form-control" type="text" value="{{$data->tahun}}" name="tahun" readonly style="background-color:#DCDCDC; cursor:not-allowed">
									<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
								</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Pegawai<span style="color:red;">*</span></label>
							<div class="col-10">
							<input class="form-control" type="text" value="{{$data->nopek}} - {{$data->nama_nopek}}"  readonly style="background-color:#DCDCDC; cursor:not-allowed">
							<input class="form-control" type="hidden" value="{{$data->nopek}}" name="nopek" >
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Aard<span style="color:red;">*</span></label>
							<div class="col-10">
							<input class="form-control" type="text" value="{{$data->aard}}- {{$data->nama_aard}}" readonly style="background-color:#DCDCDC; cursor:not-allowed" >
							<input class="form-control" type="hidden" value="{{$data->aard}}" name="aard">
								
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Cicilan Ke-<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="ccl" type="text" value="<?php echo number_format($data->ccl, 0, '', '') ?>" id="ccl" size="3" maxlength="3" required oninvalid="this.setCustomValidity('Cicilan Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Jml Cicilan<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="jmlcc" type="text" value="<?php echo number_format($data->jmlcc, 0, '', '') ?>" id="jmlcc" size="5" maxlength="5" required oninvalid="this.setCustomValidity('Jml Cicilan Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Nilai<span style="color:red;">*</span></label>
							<div class="col-10">
								<input class="form-control" name="nilai" type="text" value="<?php echo number_format($data->nilai, 0, ',', '.') ?>" id="nilai" size="17" maxlength="17" required oninvalid="this.setCustomValidity('Nilai Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeypress="return hanyaAngka(event)">
							</div>
						</div>
						@endforeach
						<div class="kt-form__actions">
							<div class="row">
								<div class="col"></div>
								<div class="col"></div>
								<div class="col-10">
									<a  href="{{route('potongan_manual.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',301)->limit(1)->get() as $data_akses)
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


// /edit lembur
$('#form-edit').submit(function(){
$.ajax({
	url  : "{{route('potongan_manual.update')}}",
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
		title : 'Data Potongan Manual Berhasil Diubah',
		text  : 'Berhasil',
	}).then(function() {
			window.location.replace("{{ route('potongan_manual.index') }}");;
		});
	}, 
	error : function(){
		alert("Terjadi kesalahan, coba lagi nanti");
	}
});	
return false;
});



	// minimum setup
	$('#tgldebet').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'mm/yyyy'
	});
});


function hanyaAngka(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))

	return false;
	return true;
}

var nilai = document.getElementById('nilai');
nilai.addEventListener('keyup', function(e){
	// tambahkan 'Rp.' pada saat form di ketik
	// gunakan fungsi formatnilai() untuk mengubah angka yang di ketik menjadi format angka
	nilai.value = formatRupiah(this.value, '');
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix){
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
	split   		= number_string.split(','),
	sisa     		= split[0].length % 3,
	nilai     		= split[0].substr(0, sisa),
	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if(ribuan){
		separator = sisa ? '.' : '';
		nilai += separator + ribuan.join('.');
	}

	nilai = split[1] != undefined ? nilai + ',' + split[1] : nilai;
	$a= prefix == undefined ? nilai : (nilai ? nilai: '');
	return $a;
}
</script>

@endsection
