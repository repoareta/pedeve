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
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perjalanan Dinas </a>
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
					Tambah Panjar Dinas
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
		<form class="kt-form kt-form--label-right" action="{{ route('perjalanan_dinas.store') }}" method="POST">
			@csrf
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							<h5 class="kt-portlet__head-title">
								Header Panjar Dinas
							</h5>	
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="spd-input" class="col-2 col-form-label">No. SPD</label>
					<div class="col-5">
						<input class="form-control" type="text" name="no_spd" value="{{ ($panjar_header_count + 1).'/PDV/CS/'.date('Y') }}" id="spd">
					</div>

					<label for="spd-input" class="col-2 col-form-label">Tanggal Panjar</label>
					<div class="col-3">
						<input class="form-control" type="text" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="nopek-input" class="col-2 col-form-label">Nopek</label>
					<div class="col-10">
						<select class="form-control kt-select2" id="kt_select2_1" name="nopek">
							<option value="">- Pilih Nopek -</option>
							@foreach ($pegawai_list as $pegawai)
							<option value="{{ $pegawai->nopeg }}">{{ $pegawai->nopeg.' - '.$pegawai->nama }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-email-input" class="col-2 col-form-label">Jabatan</label>
					<div class="col-5">
						<select class="form-control kt-select2" name="jabatan" id="jabatan">
							<option value="">- Pilih Jabatan -</option>
							@foreach ($jabatan_list as $jabatan)
								<option value="{{ $jabatan->keterangan }}">{{ $jabatan->keterangan }}</option>
							@endforeach
						</select>
					</div>

					<label for="example-email-input" class="col-2 col-form-label">Golongan</label>
					<div class="col-3">
						<input class="form-control" type="text" name="golongan" id="golongan">
					</div>
				</div>
				<div class="form-group row">
					<label for="id-pekerja;-input" class="col-2 col-form-label">KTP/Passport</label>
					<div class="col-10">
						<input class="form-control" type="text" name="ktp" id="ktp">
					</div>
				</div>
				<div class="form-group row">
					<label for="jenis-dinas-input" class="col-2 col-form-label">Jenis Dinas</label>
					<div class="col-10">
						<select class="form-control" name="jenis_dinas" id="jenis_dinas">
							<option value="">- Pilih Jenis Dinas -</option>
							<option value="DN">PDN-DN</option>
							<option value="LN">PDN-LN</option>
							<option value="SIJ">SIJ</option>
							<option value="CUTI">CUTI</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="dari-input" class="col-2 col-form-label">Dari/Asal</label>
					<div class="col-10">
						<input class="form-control" type="text" name="dari" id="dari">
					</div>
				</div>
				<div class="form-group row">
					<label for="tujuan-input" class="col-2 col-form-label">Tujuan</label>
					<div class="col-10">
						<input class="form-control" type="text" name="tujuan" id="tujuan">
					</div>
				</div>
				<div class="form-group row">
					<label for="mulai-input" class="col-2 col-form-label">Mulai</label>
					<div class="col-10">
						<div class="input-daterange input-group" id="date_range_picker">
							<input type="text" class="form-control" name="mulai" />
							<div class="input-group-append">
								<span class="input-group-text">Sampai</span>
							</div>
							<input type="text" class="form-control" name="sampai" />
						</div>
						<span class="form-text text-muted">Linked pickers for date range selection</span>
					</div>
				</div>

				<div class="form-group row">
					<label for="example-week-input" class="col-2 col-form-label">Kendaraan</label>
					<div class="col-10">
						<input class="form-control" type="text" name="kendaraan" id="kendaraan">
					</div>
				</div>

				<div class="form-group row">
					<label for="example-week-input" class="col-2 col-form-label">Biaya</label>
					<div class="col-10">
						<select class="form-control" name="biaya" id="biaya">
							<option value="">- Pilih Biaya -</option>
							<option value="P">Ditanggung Perusahaan</option>
							<option value="K">Ditanggung Pribadi</option>
							<option value="U">Ditanggung PPU</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="example-month-input" class="col-2 col-form-label">Keterangan</label>
					<div class="col-10">
						<textarea class="form-control" name="keterangan" id="keterangan"></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label for="example-week-input" class="col-2 col-form-label">Jumlah</label>
					<div class="col-10">
						<input class="form-control" type="number" name="jumlah" id="example-week-input">
					</div>
				</div>

				<div class="kt-form__actions">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-10">
							<a  href="{{ url()->previous() }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
							<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
						</div>
					</div>
				</div>

			</div>
			{{-- END BODY --}}
				
			<div class="kt-portlet__head kt-portlet__head">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="kt-font-brand flaticon2-line-chart"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						Detail Panjar Dinas
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
							<th></th>
							<th>No</th>
							<th>Nopek</th>
							<th>Nama</th>
							<th>Gol</th>
							<th>Jabatan</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($panjar_details as $panjar_detail)
							<td>radio</td>
							<td>Nopek</td>
							<td>Nama</td>
							<td>Gol</td>
							<td>Jabatan</td>
							<td>Keterangan</td>
						@endforeach
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
				<form class="" action="{{ route('perjalanan_dinas.store.detail') }}" method="POST">
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