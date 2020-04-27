@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Iuran Pensiun </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					SDM & Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Iuran Pensiun</span>
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
				Tabel Rekap Iuran Pensiun
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
        <form class="kt-form kt-form--label-right" action="{{ route('pensiun.rekapiuran.export') }}" method="post">
            @csrf
            <div class="form-group row">
					<?php 
						$tgl = date_create(now());
						$tahun = date_format($tgl, 'Y'); 
					?>
				<label for="spd-input" class="col-2 col-form-label">Tahun<span style="color:red;">*</span></label>
				<div class="col-4" >
					<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" min="4" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off' required>
					<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
				</div>
			</div>
			<div class="form-group row">
				<label for="" class="col-2 col-form-label"></label>
				<div class="col-8">
					<div class="kt-radio-inline">
						<label class="kt-radio kt-radio--solid">
							<input type="radio" name="dp" value="BK" checked> IURAN DANA PENSIUN (BEBAN PEKERJA)
							<span></span>
						</label>
					</div>
					<div class="kt-radio-inline">
						<label class="kt-radio kt-radio--solid">
							<input type="radio" name="dp" value="BR"> IURAN DANA PENSIUN (BEBAN PERUSAHAAN)
							<span></span>
						</label>
					</div>
				</div>
			</div>
            <div class="form-group row">
				<label for="jenis-dinas-input" class="col-2 col-form-label"></label>
				<div class="col-8">
                    <input class="form-control" type="hidden" name="tanggal" value="{{ date('d F Y') }}"  id="tanggal" size="15" maxlength="15" autocomplete='off' required oninvalid="this.setCustomValidity('Tanggal Cetak Harus Diisi..')" onchange="setCustomValidity('')" autocomplete='off'>
				</div>
			</div>
			<div class="kt-form__actions">
				<div class="row">
					<div class="col-2"></div>
					<div class="col-10">
						<a  href="{{ route('pensiun.index') }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
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
   
	$('#tanggal').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
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