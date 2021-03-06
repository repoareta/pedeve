@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Panjar Dinas </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Perjalanan Dinas</span>
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
				Tabel Umum Rekap Panjar Dinas
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
        <form class="kt-form kt-form--label-right" action="{{ route('perjalanan_dinas.rekap.export') }}" method="post" id="formRekapSPD">
            @csrf
            <div class="form-group row">
                <label for="mulai-input" class="col-2 col-form-label">Mulai</label>
                <div class="col-8">
                    <div class="input-daterange input-group" id="date_range_picker">
                        <input type="text" class="form-control" name="mulai" autocomplete="off" />
                        <div class="input-group-append">
                            <span class="input-group-text">Sampai</span>
                        </div>
                        <input type="text" class="form-control" name="sampai" autocomplete="off" />
                    </div>
                    <span class="form-text text-muted">Pilih rentang waktu rekap panjar dinas</span>
                </div>
            </div>

            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                        <a  href="{{ url()->previous() }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
                        <button type="submit" onclick="exportPDF()" name="submit" value="pdf" class="btn btn-danger"><i class="fa fa-file-pdf" aria-hidden="true"></i> Export .PDF</button>
                        <button type="submit" onclick="exportNonPDF()" name="submit" value="csv" class="btn btn-success"><i class="fa fa-file-csv" aria-hidden="true"></i> Export .CSV</button>
                        <button type="submit" onclick="exportNonPDF()" name="submit" value="xlsx" class="btn btn-success"><i class="fa fa-file-excel" aria-hidden="true"></i> Export .XLSX</button>
                    </div>
                </div>
            </div>
        </form>
	</div>
</div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\RekapSPDStore', '#formRekapSPD') !!}
<script type="text/javascript">
$(document).ready(function () {
    // range picker
    $('#date_range_picker').datepicker({
        todayHighlight: true,
        format   : 'yyyy-mm-dd',
    });

    $("#formRekapSPD").on('submit', function(){
        if ($('#sampai-error').length){
            $("#sampai-error").addClass("float-right");
        }
    });
});

function exportPDF() {
    $("#formRekapSPD").attr("target", "_blank");
}

function exportNonPDF() {
    $("#formRekapSPD").removeAttr("target", "_blank");
}
</script>
@endsection