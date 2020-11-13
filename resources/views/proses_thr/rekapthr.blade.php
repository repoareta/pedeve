@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Cetak Rekap THR </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					SDM & Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Cetak Rekap THR</span>
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
				Tabel Cetak Rekap THR
			</h3>			
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
        <form class="kt-form kt-form--label-right" action="{{ route('proses_thr.rekap.export') }}" method="post">
            @csrf
            <div class="form-group row">
				<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
				<div class="col-4">
					<?php 
						$tgl = date_create(now());
						$tahun = date_format($tgl, 'Y'); 
						$bulan = date_format($tgl, 'n'); 
						$jabatan = "Sekretaris Perseroan,";
						$nama = "Harus Diisi";
					?>
					<select class="form-control kt-select2" style="width: 100% !important;"  name="bulan" required>
						<option value="1" <?php if($bulan  == 1 ) echo 'selected' ; ?>>Januari</option>
						<option value="2" <?php if($bulan  == 2 ) echo 'selected' ; ?>>Februari</option>
						<option value="3" <?php if($bulan  == 3 ) echo 'selected' ; ?>>Maret</option>
						<option value="4" <?php if($bulan  == 4 ) echo 'selected' ; ?>>April</option>
						<option value="5" <?php if($bulan  == 5 ) echo 'selected' ; ?>>Mei</option>
						<option value="6" <?php if($bulan  == 6 ) echo 'selected' ; ?>>Juni</option>
						<option value="7" <?php if($bulan  == 7 ) echo 'selected' ; ?>>Juli</option>
						<option value="8" <?php if($bulan  == 8 ) echo 'selected' ; ?>>Agustus</option>
						<option value="9" <?php if($bulan  == 9 ) echo 'selected' ; ?>>September</option>
						<option value="10" <?php if($bulan  ==10  ) echo 'selected' ; ?>>Oktober</option>
						<option value="11" <?php if($bulan  == 11 ) echo 'selected' ; ?>>November</option>
						<option value="12" <?php if($bulan  == 12 ) echo 'selected' ; ?>>Desember</option>
					</select>
				</div>
				<div class="col-4" >
					<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off' required oninvalid="this.setCustomValidity('Tahun Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
					<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-2 col-form-label">Penandatangan<span style="color:red;">*</span></label>
				<div class="col-4">
					<input class="form-control" type="text" value="{{$nama}}" name="nama" id="nama" size="50" maxlength="200" required oninvalid="this.setCustomValidity('Penandatanganan Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
				</div>
				<label class="col-1 col-form-label">Jabatan<span style="color:red;">*</span></label>
				<div class="col-3" >
					<input class="form-control" type="text" value="{{$jabatan}}" name="jabatan" id="jabatan" size="50" maxlength="200" required oninvalid="this.setCustomValidity('Jabatan Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
				</div>
			</div>
			<div class="form-group row">
				<label for="jenis-dinas-input" class="col-2 col-form-label">Tanggal Cetak<span style="color:red;">*</span></label>
				<div class="col-8">
                    <input class="form-control" type="text" name="tanggal" value="{{ date('d F Y') }}"  id="tanggal" size="15" maxlength="15" autocomplete='off' required oninvalid="this.setCustomValidity('Tanggal Cetak Harus Diisi..')" onchange="setCustomValidity('')" autocomplete='off'>
				</div>
			</div>
			<div class="kt-form__actions">
				<div class="row">
					<div class="col-2"></div>
					<div class="col-10">
						<a  href="{{ route('default.index') }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
						<button type="submit" class="btn btn-brand" onclick="$('form').attr('target', '_blank')"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
					</div>
				</div>
			</div>
        </form>
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
	$('#tanggal').datepicker({
		todayHighlight: true,
		// orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'dd MM yyyy'
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