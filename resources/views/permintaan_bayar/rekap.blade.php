@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Permintaan Bayar </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Permintaan Bayar</span>
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
				Tabel Umum Report Permintaan Bayar
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
        <form class="kt-form kt-form--label-right" action="{{ route('permintaan_bayar.rekap.export') }}" method="post">
            @csrf
            <div class="form-group row">
				<label for="jenis-dinas-input" class="col-2 col-form-label">Kepada</label>
				<div class="col-10">
                @foreach($data_report as $data)
					<input class="form-control" type="hidden" value="{{$data->no_bayar}}" name="nobayar" id="nobayar" size="50" maxlength="200" readonly>
				@endforeach
                    <input class="form-control" type="text" value="MAN. FINANCE" name="kepada" id="kepada" size="50" maxlength="200" required oninvalid="this.setCustomValidity('Kepada Harus Diisi...')" oninput="setCustomValidity('')" autocomplete='off'>
				</div>
			</div>
            <div class="form-group row">
				<label for="jenis-dinas-input" class="col-2 col-form-label">Dari</label>
				<div class="col-10">
					<input class="form-control" type="text" value="IA & RM" name="dari" id="dari" size="50" maxlength="200" required oninvalid="this.setCustomValidity('Dari Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-2 col-form-label">Menyetujui<span style="color:red;">*</span></label>
				<div class="col-5">
					<input class="form-control" type="text" value="{{$setuju}}" name="menyetujui" id="menyetujui" size="50" maxlength="200" required oninvalid="this.setCustomValidity('Menyetujui Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
				</div>
				<label class="col-2 col-form-label">Jabatan<span style="color:red;">*</span></label>
				<div class="col-3" >
					<input class="form-control" type="text" value="{{$setujus}}" name="menyetujuijb" id="menyetujuijb" size="50" maxlength="200" required oninvalid="this.setCustomValidity('Jabatan Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-2 col-form-label">Pemohon<span style="color:red;">*</span></label>
				<div class="col-5">
					<input class="form-control" type="text" value="{{$pemohon}}" name="pemohon" id="pemohon" size="50" maxlength="200" required oninvalid="this.setCustomValidity('Pemohon Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
				</div>
				<label class="col-2 col-form-label">Jabatan<span style="color:red;">*</span></label>
				<div class="col-3" >
					<input class="form-control" type="text" value="{{$pemohons}}" name="pemohonjb" id="pemohonjb" size="50" maxlength="200" required oninvalid="this.setCustomValidity('Jabatan Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
				</div>
			</div>
            <div class="form-group row">
				<label for="jenis-dinas-input" class="col-2 col-form-label">Tanggal Cetak</label>
				<div class="col-5">
                    <input class="form-control" type="text" name="tglsurat" value="{{date('d/m/Y')}}"  id="tglsurat" size="15" maxlength="15" required autocomplete='off'>
				</div>
			</div>

            @foreach($data_report as $data)
			<?php
			if($data->app_pbd == 'Y'){ ?>
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                        <a  href="{{ route('permintaan_bayar.index') }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
                        <button type="submit" class="btn btn-brand" disabled style="cursor:not-allowed"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
                    </div>
                </div>
			</div>
			<?php }else{ ?>
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-10">
							<a  href="{{ route('permintaan_bayar.index') }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
							<button type="submit" class="btn btn-brand" onclick="$('form').attr('target', '_blank')"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
						</div>
					</div>
				</div>
			<?php } ?>
			@endforeach
        </form>
	</div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function () {
    // Class definition
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

        $('#tglsurat').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'dd/mm/yyyy'
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
</script>
@endsection