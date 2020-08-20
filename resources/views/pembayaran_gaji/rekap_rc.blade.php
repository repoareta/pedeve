@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Cetak RC </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Cetak RC Pembayaran Gaji Pekerja</span>
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
				Cetak RC Pembayaran Gaji Pekerja
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
		<form class="kt-form kt-form--label-right" action="{{route('pembayaran_gaji.export_rc')}}" method="post">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group row">
					<label class="col-2 col-form-label">No.Dokumen</label>
					<div class="col-8">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$docno}}" name="docno" readonly>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Lampiran</label>
					<div class="col-3">
						<input size="3" maxlength="3"  class="form-control" type="text" value="{{$lampiran}}" name="lampiran" autocomplete='off'>
						<input size="30" maxlength="30" type="hidden" value="{{$total}}" name="total" >
						<input size="30" maxlength="30" type="hidden" value="{{$bulan}}" name="bulan" >
						<input size="30" maxlength="30" type="hidden" value="{{$tahun}}" name="tahun" >
						<input size="30" maxlength="30" type="hidden" value="{{$ci}}" name="ci" >
					</div>
					<label class="col-2 col-form-label">No.Bilyet Giro</label>
					<div class="col-3">
						<input size="10" maxlength="10"  class="form-control" type="text" value="{{$reg}}" name="reg" autocomplete='off'>
						<input size="30" maxlength="30" type="hidden" value="{{$transfer}}" name="transfer" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Perihal</label>
					<div class="col-8">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$perihal}}" name="perihal" autocomplete='off'>
						<input size="30" maxlength="30" type="hidden" value="{{$pkpp}}" name="pkpp" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Nama Bank</label>
					<div class="col-8">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$bank}}" name="bank" autocomplete='off'>
						<input size="30" maxlength="30" type="hidden" value="{{$bazma}}" name="bazma" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Cabang</label>
					<div class="col-8">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$cabang}}" name="cabang" autocomplete='off'>
						<input size="30" maxlength="30" type="hidden" value="{{$koperasi}}" name="koperasi" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">No. Rekening</label>
					<div class="col-8">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$norek}}" name="norek" autocomplete='off'>
						<input size="30" maxlength="30" type="hidden" value="{{$sukaduka}}" name="sukaduka" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Alamat</label>
					<div class="col-8">
						<input size="50" maxlength="50"  class="form-control" type="text" value="{{$alamat}}" name="alamat" autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Kota</label>
					<div class="col-8">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$kota}}" name="kota" autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Up</label>
					<div class="col-8">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$up}}" name="up" autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Jabatan Kiri</label>
					<div class="col-3">
						<input size="20" maxlength="20"  class="form-control" type="text" value="{{$jabkir}}" name="jabkir" autocomplete='off'>
					</div>
					<label class="col-2 col-form-label">Nama</label>
					<div class="col-3">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$namkir}}" name="namkir" autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Jabatan Kanan</label>
					<div class="col-3">
						<input size="20" maxlength="20"  class="form-control" type="text" value="{{$jabkan}}" name="jabkan" autocomplete='off'>
					</div>
					<label class="col-2 col-form-label">Nama</label>
					<div class="col-3">
						<input size="30" maxlength="30"  class="form-control" type="text" value="{{$namkan}}" name="namkan" autocomplete='off'>
					</div>
				</div>

						<input type="hidden" value="{{$kdkepada}}" name="kdkepada">

				<div class="kt-form__actions">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-10">
							<a  href="{{route('pembayaran_gaji.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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