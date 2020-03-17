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
		<form class="kt-form kt-form--label-right">
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							Header Permintaan Bayar
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="spd-input" class="col-2 col-form-label">No. SPD</label>
					<div class="col-10">
						<input class="form-control" type="text" value="Artisanal kale" id="spd">
					</div>
				</div>
				<div class="form-group row">
					<label for="nopek-input" class="col-2 col-form-label">Nopek</label>
					<div class="col-10">
						<input class="form-control" type="text" value="How do I shoot web" id="example-search-input">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-email-input" class="col-2 col-form-label">Jabatan</label>
					<div class="col-10">
						<input class="form-control" type="text" value="bootstrap@example.com" id="example-email-input">
					</div>
				</div>
				<div class="form-group row">
					<label for="id-pekerja;-input" class="col-2 col-form-label">KTP/Passport</label>
					<div class="col-10">
						<input class="form-control" type="text" value="https://getbootstrap.com" id="example-url-input">
					</div>
				</div>
				<div class="form-group row">
					<label for="jenis-dinas-input" class="col-2 col-form-label">Jenis Dinas</label>
					<div class="col-10">
						<input class="form-control" type="text" value="1-(555)-555-5555" id="example-tel-input">
					</div>
				</div>
				<div class="form-group row">
					<label for="dari-input" class="col-2 col-form-label">Dari/Asal</label>
					<div class="col-10">
						<input class="form-control" type="text" value="hunter2" id="example-password-input">
					</div>
				</div>
				<div class="form-group row">
					<label for="tujuan-input" class="col-2 col-form-label">Tujuan</label>
					<div class="col-10">
						<input class="form-control" type="text" value="42" id="example-number-input">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-datetime-local-input" class="col-2 col-form-label">Mulai</label>
					<div class="col-10">
						<input class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-date-input" class="col-2 col-form-label">Sampai</label>
					<div class="col-10">
						<input class="form-control" type="date" value="2011-08-19" id="example-date-input">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-month-input" class="col-2 col-form-label">Keterangan</label>
					<div class="col-10">
						<input class="form-control" type="month" value="2011-08" id="example-month-input">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-week-input" class="col-2 col-form-label">Jumlah</label>
					<div class="col-10">
						<input class="form-control" type="week" value="2011-W33" id="example-week-input">
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
			
							<a href="#">
								<span style="font-size: 2em;" class="kt-font-warning">
									<i class="fas fa-edit"></i>
								</span>
							</a>
			
							<a href="#">
								<span style="font-size: 2em;" class="kt-font-danger">
									<i class="fas fa-times-circle"></i>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
					<thead class="thead-light">
						<tr>
							<th>No</th>
							<th>Nopek</th>
							<th>Nama</th>
							<th>Gol</th>
							<th>Jabatan</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Hehe</td>
							<td>Hehe</td>
							<td>Hehe</td>
							<td>Hehe</td>
							<td>Hehe</td>
							<td>Hehe</td>
						</tr>
					</tbody>
				</table>
			</div>
		</form>
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
		$('#kt_table').DataTable();
	});
	</script>
@endsection