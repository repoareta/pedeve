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
            @foreach($data_app as $data)
                @if($data->app_sdm == 'Y')
				Tabel <span style="color:blue;">Pembatalan</span> Approval Permintaan Bayar
                @elseif($data->app_sdm == 'N')
				Tabel <span style="color:blue;">Eksekusi</span> Approval Permintaan Bayar
                @endif
            @endforeach
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
        <form class="kt-form kt-form--label-right" action="{{ route('permintaan_bayar.store.app') }}" method="post">
            @csrf
            @foreach($data_app as $data)
            <div class="form-group row">
                <label for="mulai-input" class="col-2 col-form-label">No. Dokumen</label>
                <div class="col-3">
                        <input type="text" class="form-control" name="nobayar" value="{{$data->no_bayar}}" readonly />
                        <input type="text" class="form-control" hidden name="userid" value="{{Auth::user()->userid}}" readonly />
                </div>
            </div>
            <div class="form-group row">
                <label for="mulai-input" class="col-2 col-form-label">Tanggal Approval</label>
                <div class="col-2">
                    <div class="input-daterange input-group" >
                        <input type="text" class="form-control" name="tgl_app" id="date_range_picker" value="<?php echo date("Y-m-d", strtotime($data->app_sdm_tgl)) ?>"/>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                        <a  href="{{ route('permintaan_bayar.index') }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
                        <button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
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

        // range picker
        $('#date_range_picker').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            templates: arrows,
            // autoclose: true,
            // language : 'id',
            format   : 'yyyy-mm-dd',
            orientation: 'bottom'
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