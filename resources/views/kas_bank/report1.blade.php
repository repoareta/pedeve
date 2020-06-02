@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Cetak Transaksi D2 Kas Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Cetak Transaksi D2 Kas Bank</span>
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
				Tabel Cetak Transaksi D2 Kas Bank
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
		<form class="kt-form kt-form--label-right" action="{{route('kas_bank.cetak1')}}" method="post">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<input class="form-control" type="hidden" name="userid" value="{{Auth::user()->userid}}">
				<div class="form-group row">
					<label for="" class="col-2 col-form-label">JK<span style="color:red;">*</span></label>
					<div class="col-10">
						<div class="kt-radio-inline">
							<label class="kt-radio kt-radio--solid">
								<input value="1" type="radio"  name="jk" >[10,11,13]
								<span></span>
							</label>
							<label class="kt-radio kt-radio--solid">
								<input value="2" type="radio"    name="jk">[15,18]
								<span></span>
							</label>
							<label class="kt-radio kt-radio--solid">
								<input value="3" type="radio"    name="jk" checked>All
								<span></span>
							</label>
						</div>
					</div>
				</div>


				<div class="form-group row">
				<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
				<div class="col-4">
						<?php 
						foreach($data_tahun as $data){ 
							$tahun = substr($data->sbulan, 0, 4);
							$bulan = substr($data->sbulan, 4, 2);
							$suplesi = substr($data->sbulan, 6);
							$lapangan = "KL";
						}
						?>
						<select class="form-control" name="bulan">
							<option value="">-- All --</option>
							<option value="01" <?php if($bulan  == '01' ) echo 'selected' ; ?>>Januari</option>
							<option value="02" <?php if($bulan  == '02' ) echo 'selected' ; ?>>Februari</option>
							<option value="03" <?php if($bulan  == '03' ) echo 'selected' ; ?>>Maret</option>
							<option value="04" <?php if($bulan  == '04' ) echo 'selected' ; ?>>April</option>
							<option value="05" <?php if($bulan  == '05' ) echo 'selected' ; ?>>Mei</option>
							<option value="06" <?php if($bulan  == '06' ) echo 'selected' ; ?>>Juni</option>
							<option value="07" <?php if($bulan  == '07' ) echo 'selected' ; ?>>Juli</option>
							<option value="08" <?php if($bulan  == '08' ) echo 'selected' ; ?>>Agustus</option>
							<option value="09" <?php if($bulan  == '09' ) echo 'selected' ; ?>>September</option>
							<option value="10" <?php if($bulan  =='10'  ) echo 'selected' ; ?>>Oktober</option>
							<option value="11" <?php if($bulan  == '11' ) echo 'selected' ; ?>>November</option>
							<option value="12" <?php if($bulan  == '12' ) echo 'selected' ; ?>>Desember</option>
						</select>
				</div>
					<div class="col-5" >
						<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off' required> 
					</div>
					<div class="col-2" >
						<input class="form-control" type="hidden" name="tanggal" value="{{ date('d-m-Y') }}" size="15" maxlength="15" autocomplete='off'>
						<input class="form-control" type="hidden" value=""   name="suplesi" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off' required>
					</div>
				</div>
				<div class="form-group row">
					<label for="dari-input" class="col-2 col-form-label">Lapangan<span style="color:red;">*</span></label>
					<div class="col-10">
						<select name="lp" id="select-debetdari" class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Lapangan Harus Diisi..')" onchange="setCustomValidity('')">
							<option value="">- Pilih -</option>
							@foreach($data_kodelok as $data_kode)
							<option value="{{$data_kode->kodelokasi}}" <?php if($lapangan  == $data_kode->kodelokasi ) echo 'selected' ; ?>>{{$data_kode->kodelokasi}} -- {{$data_kode->nama}}</option>
							@endforeach
						</select>								
					</div>
				</div>
				<div class="form-group row">
					<label for="dari-input" class="col-2 col-form-label">Sandi Perkiraan</label>
					<div class="col-10">
						<select name="sanper" id="select-debetdari" class="form-control selectpicker" data-live-search="true" oninvalid="this.setCustomValidity('Sandi Perkiraan Harus Diisi..')" onchange="setCustomValidity('')">
							<option value="">- Pilih -</option>
							@foreach($data_sanper as $data_san)
							<option value="{{$data_san->kodeacct}}">{{$data_san->kodeacct}} -- {{$data_san->descacct}}</option>
							@endforeach
							
						</select>								
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