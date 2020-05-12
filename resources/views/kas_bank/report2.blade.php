@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Balancing Kas Bank Per Nobukti </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Balancing Kas Bank Per Nobukti</span>
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
				Tabel Balancing Kas Bank Per Nobukti
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
		<form class="kt-form kt-form--label-right" action="{{route('kas_bank.cetak2')}}" method="post">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<input class="form-control" type="hidden" name="userid" value="{{Auth::user()->userid}}">
				<div class="form-group row">
				<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
				<div class="col-5">
					<?php 
					foreach($data_tahun as $data){ 
						$tahun = substr($data->thnbln, 0, 4);
						$bulan = substr($data->thnbln, 4, 2);
					}
					?>
					<select class="form-control" name="bulan" required>
						<option value="1" <?php if($bulan  == '01' ) echo 'selected' ; ?>>Januari</option>
						<option value="2" <?php if($bulan  == '02' ) echo 'selected' ; ?>>Februari</option>
						<option value="3" <?php if($bulan  == '03' ) echo 'selected' ; ?>>Maret</option>
						<option value="4" <?php if($bulan  == '04' ) echo 'selected' ; ?>>April</option>
						<option value="5" <?php if($bulan  == '05' ) echo 'selected' ; ?>>Mei</option>
						<option value="6" <?php if($bulan  == '06' ) echo 'selected' ; ?>>Juni</option>
						<option value="7" <?php if($bulan  == '07' ) echo 'selected' ; ?>>Juli</option>
						<option value="8" <?php if($bulan  == '08' ) echo 'selected' ; ?>>Agustus</option>
						<option value="9" <?php if($bulan  == '09' ) echo 'selected' ; ?>>September</option>
						<option value="10" <?php if($bulan  =='10'  ) echo 'selected' ; ?>>Oktober</option>
						<option value="11" <?php if($bulan  == '11' ) echo 'selected' ; ?>>November</option>
						<option value="12" <?php if($bulan  == '12' ) echo 'selected' ; ?>>Desember</option>
					</select>
				</div>
						<div class="col-5" >
							<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off' required>
							<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
							<input class="form-control" type="hidden" name="tanggal" value="{{ date('d F Y') }}"  id="tanggal" size="15" maxlength="15" autocomplete='off' required oninvalid="this.setCustomValidity('Tanggal Cetak Harus Diisi..')" onchange="setCustomValidity('')" autocomplete='off'>
						</div>
				</div>
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-10">
							<a  href="#" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
							<button type="submit" id="btn-save" onclick="$('form').attr('target', '_blank')" class="btn btn-brand"><i class="fa fa-print" aria-hidden="true"></i>Cetak</button>
						</div>
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