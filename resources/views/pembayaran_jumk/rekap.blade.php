@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Cetak </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Cetak Pembayaran Pertanggung Jawaban UMK</span>
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
				Cetak Kas Bank Pembayaran Pertanggung Jawaban UMK
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
		<form class="kt-form kt-form--label-right" action="{{route('pembayaran_jumk.export')}}" method="post">
			{{csrf_field()}}
			<div class="kt-portlet__body">
			@if($mp == "P")
				<div class="form-group row">
					<label class="col-2 col-form-label"></label>
					<div class="col-8">
						Penandatangan Kas Putih
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label"></label>
					<div class="col-4">
						Nama
					</div>
					<div class="col-4">
						Jabatan
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Verifikasi</label>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$verifikasi1}}" name="verifikasi1"  <?php if($verifikasi1 == ""){ echo "readonly"; } ?>>
					</div>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$nverifikasi1}}" name="nverifikasi1"  <?php if($nverifikasi1 == ""){ echo "readonly"; } ?>>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Menyetujui</label>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$setuju1}}" name="setuju1"  <?php if($setuju1 == ""){ echo "readonly"; } ?>>
					</div>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$nsetuju1}}" name="nsetuju1"  <?php if($nsetuju1 == ""){ echo "readonly"; } ?>>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Membukukan</label>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$buku1}}" name="buku1"  <?php if($buku1 == ""){ echo "readonly"; } ?>>
					</div>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$nbuku1}}" name="nbuku1"  <?php if($nbuku1 == ""){ echo "readonly"; } ?>>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Permintaan</label>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$minta1}}" name="minta1"  <?php if($minta1 == ""){ echo "readonly"; } ?>>
					</div>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$nminta1}}" name="nminta1"  <?php if($nminta1 == ""){ echo "readonly"; } ?>>
					</div>
				</div>

			@else
				<div class="form-group row">
					<label class="col-2 col-form-label"></label>
					<div class="col-8">
					<font color="#FF0000">Penandatangan Kas Merah</font>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label"></label>
					<div class="col-4">
						Nama
					</div>
					<div class="col-4">
						Jabatan
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Pemeriksaan</label>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$setuju2}}" name="setuju2"  <?php if($setuju2 == ""){ echo "readonly"; } ?>>
					</div>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$nsetuju2}}" name="nsetuju2"  <?php if($nsetuju2 == ""){ echo "readonly"; } ?>>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Membukukan</label>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$buku2}}" name="buku2"  <?php if($buku2 == ""){ echo "readonly"; } ?>>
					</div>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$nbuku2}}" name="nbuku2"  <?php if($nbuku2 == ""){ echo "readonly"; } ?>>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Kas/Bank</label>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$kas2}}" name="kas2"  <?php if($kas2 == ""){ echo "readonly"; } ?>>
					</div>
					<div class="col-4">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$nkas2}}" name="nkas2"  <?php if($nkas2 == ""){ echo "readonly"; } ?>>
					</div>
				</div>
				@endif
						<input type="hidden" value="{{$docno}}" name="docno">
						<input type="hidden" value="{{$nilai_dok}}" name="nilai">
						<input type="hidden" value="{{$ci}}" name="ci">
						<input type="hidden" value="{{$kd_kepada}}" name="kd_kepada">
						<input type="hidden" value="Daftar Transfer" name="cetaktrans">
						<input type="hidden" value="Cetak RC" name="cetak">

				<div class="kt-form__actions">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-10">
							<a  href="{{route('pembayaran_jumk.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
							<button type="submit" id="btn-save" onclick="$('form').attr('target', '_blank')" class="btn btn-brand"><i class="fa fa-print" aria-hidden="true"></i>Cetak</button>
							<a  href="{{url('perbendaharaan/pembayaran_jumk/rekaprc')}}/{{$docs}}" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i>Cetak RC</a>
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
		format   : 'dd/mm/yyyy'
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