@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Report Cash Judex Periode </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Report Cash Judex Periode</span>
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
				Report Cash Judex Periode
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
		<form class="kt-form kt-form--label-right" action="{{route('kas_bank.cetak10')}}" method="GET" target="_blank">
			<div class="kt-portlet__body">
				<div class="form-group row">
					<label for="dari-input" class="col-2 col-form-label">C.Judex</label>
					<div class="col-10">
						<select class="caricj form-control" style="width: 100% !important;" name="cjudex"></select>
					</div>
				</div>
                <div class="form-group row">
                    <label for="mulai-input" class="col-2 col-form-label">Mulai</label>
                    <div class="col-10">
                        <div class="input-daterange input-group" id="date_range_picker">
                            <input type="text" class="form-control" name="tanggal" autocomplete="off" />
                            <div class="input-group-append">
                                <span class="input-group-text">Sampai</span>
                            </div>
                            <input type="text" class="form-control" name="tanggal2" autocomplete="off" />
                        </div>
                        <span class="form-text text-muted">Pilih rentang waktu cash judex</span>
                    </div>
                </div>
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-10">
							<a  href="{{ route('default.index') }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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
	$('.kt-select2').select2().on('change', function() {
			$(this).valid();
	});
	$('.caricj').select2({
		placeholder: '-Pilih-',
		allowClear: true,
		ajax: {
			url: "{{ route('kas_bank.search.cj') }}",
			type : "get",
			dataType : "JSON",
			headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
			},
			delay: 250,
		processResults: function (data) {
			return {
			results:  $.map(data, function (item) {
				return {
				text: item.kode +'--'+ item.nama,
				id: item.kode
				}
			})
			};
		},
		cache: true
		}
	});
	$('#tanggal').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'dd MM yyyy'
	});

    $('#date_range_picker').datepicker({
        todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
        format   : 'yyyy-mm-dd',
		autoclose: true,

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