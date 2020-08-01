@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Cetak Jurnal Umum </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kontroler </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Cetak Jurnal Umum</span>
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
				Cetak Jurnal Umum
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
		<form class="kt-form kt-form--label-right" action="{{route('jurnal_umum.export')}}" method="post">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group row">
					<label class="col-2 col-form-label">Dibuat<span style="color:red;">*</span></label>
					<div class="col-8">
						<input class="form-control" type="hidden" value="{{$docno}}" name="docno">
						<input class="form-control" type="text" value="{{$dibuat}}" name="dibuat" size="50" maxlength="50" required oninvalid="this.setCustomValidity('Dibuat Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Diperiksa<span style="color:red;">*</span></label>
					<div class="col-8">
						<input class="form-control" type="text" value="{{$diperiksa}}" name="diperiksa"  size="50" maxlength="50" required oninvalid="this.setCustomValidity('Diperiksa Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2 col-form-label">Disetuju<span style="color:red;">*</span></label>
					<div class="col-8">
						<input class="form-control" type="text" value="{{$disetujui}}" name="disetujui"  size="50" maxlength="50" required oninvalid="this.setCustomValidity('Disetujui Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
					</div>
				</div>
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-10">
							<a  href="{{route('jurnal_umum.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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