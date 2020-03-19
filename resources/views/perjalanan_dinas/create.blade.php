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
						<select class="form-control kt-select2" id="nopek" name="nopek">
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
							<input type="text" class="form-control" name="mulai" autocomplete="off" />
							<div class="input-group-append">
								<span class="input-group-text">Sampai</span>
							</div>
							<input type="text" class="form-control" name="sampai" autocomplete="off" />
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
			
							<a href="#" id="editRow">
								<span style="font-size: 2em;" class="kt-font-warning">
									<i class="fas fa-edit"></i>
								</span>
							</a>
			
							<a href="#" id="deleteRow">
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
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Panjar Dinas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. Urut</label>
						<div class="col-10">
							<input class="form-control" type="text" name="no_urut" id="no_urut">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Keterangan</label>
						<div class="col-10">
							<textarea class="form-control" name="keterangan_detail" id="keterangan_detail"></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nopek</label>
						<div class="col-10">
							<select class="form-control kt-select2" id="nopek_detail" name="nopek_detail">
								<option value="">- Pilih Nopek -</option>
								@foreach ($pegawai_list as $pegawai)
									<option value="{{ $pegawai->nopeg.'-'.$pegawai->nama }}">{{ $pegawai->nopeg.' - '.$pegawai->nama }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Jabatan</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="jabatan_detail" id="jabatan_detail">
								<option value="">- Pilih Jabatan -</option>
								@foreach ($jabatan_list as $jabatan)
									<option value="{{ $jabatan->keterangan }}">{{ $jabatan->keterangan }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Golongan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="golongan_detail" id="golongan_detail">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Batal</button>
					<button type="button" id="saveDetail" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--end::Modal-->
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function () {
		var t = $('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			language: {
				processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax      : "{{ route('perjalanan_dinas.index.json.detail', ['no_panjar' => 'null']) }}",
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false},
				{data: 'no', name: 'no'},
				{data: 'nopek', name: 'nopek'},
				{data: 'nama', name: 'nama'},
				{data: 'golongan', name: 'golongan'},
				{data: 'jabatan', name: 'jabatan'},
				{data: 'keterangan', name: 'keterangan'}
			],
			order: [[ 1, "asc" ]],
			initComplete: function() {
				$('#no_urut').val(this.api().data().length + 1);
			}
		});

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


		$('#saveDetail').click(function(e) {
			var no = $('#no_urut').val();
			var keterangan = $('#keterangan_detail').val();
			var nopek = $('#nopek_detail').val().split('-')[0];
			var nama = $('#nopek_detail').val().split('-')[1];
			var jabatan = $('#jabatan_detail').val();
			var golongan = $('#golongan_detail').val();

			var state = $('#title_modal').data('state');

			var url, session;

			if(state == 'add'){
				url = "{{ route('perjalanan_dinas.store.detail') }}";
				session = true;
			} else {
				url = "{{ route('perjalanan_dinas.update.detail') }}";
				session = true;
			}

			$.ajax({
				url: url,
				type: "POST",
				data: {
					no: no,
					keterangan: keterangan,
					nopek: nopek,
					nama: nama,
					jabatan: jabatan,				
					golongan: golongan,
					session: session,
					_token:"{{ csrf_token() }}"		
				},
				success: function(dataResult){
					swal({
						title: "Tambah Detail Panjar",
						text: "Success",
						type: "success"
					})
					// close modal
					$('#kt_modal_4').modal('toggle');
					// clear form
					$('#kt_modal_4').on('hidden.bs.modal', function () {
						$(this).find('form').trigger('reset');
					})
					// append to datatable
					t.ajax.reload();
				},
				error: function () {
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});
		});

		$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var no_nopek = $(this).val();
					// delete stuff
					swal({
						title: "Data yang akan di hapus?",
						text: "Nopek : " + no_nopek,
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								url: "{{ route('perjalanan_dinas.delete.detail') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"no_nopek": no_nopek,
									"session": true,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									swal({
											title: "Delete",
											text: "Success",
											type: "success"
									}).then(function() {
										t.ajax.reload();
									});
								},
								error: function () {
									alert("Terjadi kesalahan, coba lagi nanti");
								}
							});
						}
					});
				});
			} else {
				swal({
					title: "Tandai baris yang akan dihapus!",
					type: "success"
				}) ; 
			}
		});

		$('#editRow').click(function(e) {
			e.preventDefault();

			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					// get value from row
					var no_nopek = $(this).val();
					$.ajax({
						url: "{{ route('perjalanan_dinas.show.json.detail') }}",
						type: 'GET',
						data: {
							"no_nopek": no_nopek,
							"session": true,
							"_token": "{{ csrf_token() }}",
						},
						success: function (response) {
							// update stuff
							// append value
							$('#no_urut').val(response.no);
							$('#keterangan_detail').val(response.keterangan);
							$('#nopek_detail').val(response.nopek + '-' + response.nama);
							$('#jabatan_detail').val(response.jabatan);
							$('#golongan_detail').val(response.golongan);
							// title
							$('#title_modal').text('Ubah Detail Panjar Dinas');
							$('#title_modal').data('state', 'update');
							// open modal
							$('#kt_modal_4').modal('toggle');
						},
						error: function () {
							alert("Terjadi kesalahan, coba lagi nanti");
						}
					});
					
				});
			} else {
				swal({
					title: "Tandai baris yang akan diubah",
					type: "success"
				}) ; 
			}
		});

	});
</script>
@endsection