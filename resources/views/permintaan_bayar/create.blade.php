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
			<form  class="kt-form kt-form--label-right" id="form-create-umk">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								Header Permintaan Bayar
							</div>
						</div>
					
						<div class="form-group row">
							<label class="col-2 col-form-label">No. Permintaan</label>
							<div class="col-10">
								<input  class="form-control" name="cj" type="text" value="" id="cj" >
							</div>						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Tanggal</label>
							<div class="col-10" >
								<input class="form-control" type="text" name="tgl_panjar" value="" data-date-format="dd/MM/yyyy" id="datepicker" id="tgl_panjar" size="15" maxlength="15" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="nopek-input" class="col-2 col-form-label">Terlampir</label>
							<div class="col-10">
								<input class="form-control" type="text" name="tgl_panjar" value=""  id="" id="tgl_panjar" size="15" maxlength="15" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="id-pekerja;-input" class="col-2 col-form-label">Keterangan</label>
							<div class="col-10">
								<input class="form-control" type="text" value=""  id="" name="bulan_buku" size="6" maxlength="6" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Dibayar Kepada</label>
							<div class="col-10">
								<input class="form-control" type="text" value="" name="no_panjar" id="no_panjar">
							</div>
						</div>
						<div class="form-group row">
							<label for="dari-input" class="col-2 col-form-label">Debet Dari</label>
							<div class="col-10">
								<select name="cj" id="select-cj" class="form-control selectpicker" data-live-search="true">
									<option value=""></option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">No. Debet</label>
							<div class="col-4">
								<input class="form-control" type="text" name="tgl_panjar" value="" data-date-format="dd/MM/yyyy" id="datepicker" id="tgl_panjar" size="15" maxlength="15" required>
							</div>
							<label class=" col-form-label">Tgl Debet</label>
							<div class="col-3" >
								<input class="form-control" type="text" name="tgl_panjar" value="" data-date-format="dd/MM/yyyy" id="date-debet" id="tgl_panjar" size="15" maxlength="15" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">No. Kas</label>
							<div class="col-4">
								<input  class="form-control" name="cj" type="text" value="" id="cj" >
							</div>
							<label class=" col-form-label">Bulan Buku</label>
							<div class="col-3" >
								<input class="form-control" type="text" value="" data-date-format="yyyymm" id="bulan_buku" name="bulan_buku" size="6" maxlength="6" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">CI</label>
							<div class="col-4">
								<input  class="form-control" name="cj" type="text" value="" id="cj" >
							</div>
							<label class=" col-form-label">Kurs</label>
							<div class="col-3" >
								<input class="form-control" type="text" value="" name="no_panjar" id="no_panjar">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Periode</label>
							<div class="col-4">
								<input class="form-control" type="text" name="tgl_panjar" value="" data-date-format="dd/MM/yyyy" id="date-periode" id="tgl_panjar" size="15" maxlength="15" required>
							</div>
							<label class=" col-form-label">s/d</label>
							<div class="col-3" >
								<input class="form-control" type="text" name="tgl_panjar" value="" data-date-format="dd/MM/yyyy" id="date-sd" id="tgl_panjar" size="15" maxlength="15" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Total Nilai</label>
							<div class="col-4">
								<input  class="form-control" name="cj" type="text" value="" id="cj" >
							</div>
						</div>
						<div style="float:right;">
							<div class="kt-form__actions">
								<a  href="{{route('uang_muka_kerja.index')}}" class="btn btn-warning">Cancel</a>
								<button type="submit" class="btn btn-brand">Save</button>
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
				
								<a href="#" >
									<span style="font-size: 2em;" class="kt-font-warning">
										<i class="fas fa-edit"></i>
									</span>
								</a>
				
								<a href="#" >
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

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New message</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Recipient:</label>
						<input type="text" class="form-control" id="recipient-name">
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Message:</label>
						<textarea class="form-control" id="message-text"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Send message</button>
			</div>
		</div>
	</div>
</div>

<!--end::Modal-->
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		$('#tabel-detail-permintaan').DataTable();
	});

    $('#datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });

    $('#datepicker').datepicker("setDate", new Date());
    $('#bulan_buku').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
	$('#bulan_buku').datepicker("setDate", new Date());
	
	$('#date-debet').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });

    $('#date-debet').datepicker("setDate", new Date());
	$('#date-periode').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });

    $('#date-periode').datepicker("setDate", new Date());
	$('#date-sd').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });

    $('#date-sd').datepicker("setDate", new Date());
	
</script>

@endsection
