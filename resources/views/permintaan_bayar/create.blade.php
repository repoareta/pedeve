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
				<a href="" class="kt-subheader__breadcrumbs-link">
					Permintaan Bayar </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Tambah</span>
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
					<i class="kt-font-brand flaticon2-plus-1"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Tambah Permintaan Bayar
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
		<div class="card-body table-responsive" >
			<!--begin: Datatable -->
			<form  class="kt-form kt-form--label-right" id="form-create-permintaan-bayar">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Permintaan Bayar
								</h5>	
							</div>
						</div>
					
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">No. Permintaan</label>
							<div class="col-5">
							<?php $data_no_bayar = str_replace('/', '-', $permintaan_header_count); ?>
								<input  class="form-control" type="hidden" value="{{$data_no_bayar}}" id="noumk"  size="25" maxlength="25" readonly>
								<input class="form-control" type="text" name="nobayar" value="{{ $permintaan_header_count }}" id="nobayar">
							</div>

							<label for="spd-input" class="col-2 col-form-label">Tanggal</label>
							<div class="col-3">
								<input class="form-control" type="text" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}">
							</div>
						</div>
						<div class="form-group row">
							<label for="nopek-input" class="col-2 col-form-label">Terlampir</label>
							<div class="col-10">
								<input class="form-control" type="text" name="lampiran" value=""  id="lampiran"  required>
							</div>
						</div>
						<div class="form-group row">
							<label for="id-pekerja;-input" class="col-2 col-form-label">Keterangan</label>
							<div class="col-10">
								<input class="form-control" type="text" value=""  id="keterangan" name="keterangan" size="50" maxlength="200" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Dibayar Kepada</label>
							<div class="col-10">
								<input class="form-control" type="text" value="" name="dibayar" id="dibayar" size="50" maxlength="200">
								<input name="rekyes" type="checkbox" id="rekyes" value="1" <% if rekyes="1" then response.Write("checked") %>></td>
							</div>
						</div>
						<div class="form-group row">
							<label for="dari-input" class="col-2 col-form-label">Debet Dari</label>
							<div class="col-10">
								<select name="debetdari" id="select-debetdari" class="form-control selectpicker" data-live-search="true">
									<option value="">- Pilih -</option>
									@foreach ($debit_nota as $row)
									<option value="{{ $row->kode }}">{{ $row->kode.' - '.$row->keterangan }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">No. Debet</label>
							<div class="col-5">
								<input class="form-control" type="text" name="nodebet" id="nodebet" value="" size="15" maxlength="15" required>
							</div>
							<label class="col-2 col-form-label">Tgl Debet</label>
							<div class="col-3" >
								<input class="form-control" type="text" name="tgldebet" value="" data-date-format="dd/MM/yyyy" id="tgldebet" size="15" maxlength="15" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input"  class="col-2 col-form-label">No. Kas</label>
							<div class="col-5">
								<input  class="form-control" name="nokas" type="text" value="" id="nokas" size="10" maxlength="25">
							</div>
							<label for="spd-input"  class="col-2 col-form-label">Bulan Buku</label>
							<div class="col-3" >
								<input class="form-control" type="text" value="{{ date('Ym') }}"  id="bulanbuku" name="bulanbuku" size="6" maxlength="6" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">CI</label>
							<div class="col-5">
								<input class="form-control" type="text" name="ci" value="" id="ci" size="1" maxlength="1">
							</div>

							<label for="spd-input" class="col-2 col-form-label">Kurs</label>
							<div class="col-3">
								<input class="form-control" type="text" name="kurs" id="kurs" value="" size="10" maxlength="10">
							</div>
						</div>
						<div class="form-group row">
							<label for="mulai-input" class="col-2 col-form-label">Periode</label>
							<div class="col-10">
								<div class="input-daterange input-group" id="date_range_picker">
									<input type="text" class="form-control" name="mulai" />
									<div class="input-group-append">
										<span class="input-group-text">s/d</span>
									</div>
									<input type="text" class="form-control" name="sampai" />
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Total Nilai</label>
							<div class="col-4">
								<input  class="form-control" name="totalnilai" type="text" value="" id="totalnilai"  readonly>
							</div>
						</div>
						<div style="float:right;">
							<div class="kt-form__actions">
								<a  href="{{route('permintaan_bayar.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
							</div>
						</div>
					</div>
				</div>

				

					
				<div class="kt-portlet__head kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon2-line-chart"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Detail Permintaan Bayar
						</h3>			
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions">
								<a href="#" data-toggle="modal" data-target="#kt_modal_4">
									<span style="font-size: 2em;" class="kt-font-success">
										<i class="fas fa-plus-circle"></i>
									</span>
								</a>
				
								<a href="#" href="#" data-toggle="modal" data-target="#kt_modal_4" >
									<span style="font-size: 2em;" class="kt-font-warning">
										<i class="fas fa-edit"></i>
									</span>
								</a>
				
								<a href="#" href="#" data-toggle="modal" data-target="#kt_modal_4">
									<span style="font-size: 2em;" class="kt-font-danger">
										<i class="fas fa-times-circle"></i>
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<table class="table table-striped table-bordered table-hover table-checkable" id="tabel-detail-permintaan">
						<thead class="thead-light">
							<tr>
								<th ><input type="radio" hidden name="btn-radio"  data-id="1" class="btn-radio" checked ></th>
								<th >No.</th>
								<th >Keterangan</th>
								<th >Bagian</th>
								<th >Account</th>
								<th >JB</th>
								<th >PK</th>
								<th >CJ</th>
								<th >Jumlah</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</form>
			<!--end: Datatable -->
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		$('#tabel-detail-permintaan').DataTable();



		$('#form-create-permintaan-bayar').submit(function(){
        	var no_umk = $("#noumk").val();
			$.ajax({
				url  : "{{route('permintaan_bayar.store')}}",
				type : "POST",
				data : $('#form-create-permintaan-bayar').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
				console.log(data);
					swal({
						title: "Data Berhasil Ditambahkan!",
						text: "Success!",
						type: "success"
					}).then(function() {
						window.location.replace("{{ route('permintaan_bayar.edit', ['no' => $data_no_bayar] ) }}");;
					});
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});
	

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
		format   : 'yyyy-mm-dd'
	});

	// minimum setup
	$('#tanggal').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'yyyy-mm-dd'
	});
	// minimum setup
	$('#tgldebet').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'yyyy-mm-dd'
	});
	$('#bulanbuku').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'yyyymm'
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
