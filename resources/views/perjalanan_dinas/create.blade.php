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
				<form class="kt-form kt-form--label-right" id="formPanjarDinas" action="{{ route('perjalanan_dinas.store') }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. SPD</label>
						<div class="col-5">
							<input class="form-control" type="text" name="no_spd" value="{{ ($panjar_header_count + 1).'/PDV/CS/'.date('Y') }}" id="no_spd">
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
							<div id="nopek-nya"></div>
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
							<div id="jabatan-nya"></div>
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
							<select class="form-control kt-select2" name="jenis_dinas" id="jenis_dinas">
								<option value="">- Pilih Jenis Dinas -</option>
								<option value="DN">PDN-DN</option>
								<option value="LN">PDN-LN</option>
								<option value="SIJ">SIJ</option>
								<option value="CUTI">CUTI</option>
							</select>
							<div id="jenis_dinas-nya"></div>
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
							<span class="form-text text-muted">Pilih rentang waktu mulai dan sampai</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="kendaraan" class="col-2 col-form-label">Kendaraan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="kendaraan" id="kendaraan">
						</div>
					</div>

					<div class="form-group row">
						<label for="biaya" class="col-2 col-form-label">Biaya</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="biaya" id="biaya">
								<option value="">- Pilih Biaya -</option>
								<option value="P">Ditanggung Perusahaan</option>
								<option value="K">Ditanggung Pribadi</option>
								<option value="U">Ditanggung PPU</option>
							</select>
							<div id="biaya-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="keterangan" class="col-2 col-form-label">Keterangan</label>
						<div class="col-10">
							<textarea class="form-control" name="keterangan" id="keterangan"></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label for="jumlah" class="col-2 col-form-label">Jumlah</label>
						<div class="col-10">
							<input class="form-control" type="number" name="jumlah" id="jumlah" value="0.00">
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
				</form>
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
				
				<div class="kt-portlet__head-actions" style="font-size: 2rem;">
					<a href="#" id="openDetail">
						<span class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
							<i class="fas fa-plus-circle"></i>
						</span>
					</a>
	
					<span class="kt-font-warning pointer-link" id="editRow" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
						<i class="fas fa-edit"></i>
					</span>
	
					<span class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
						<i class="fas fa-times-circle"></i>
					</span>
				</div>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
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
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPanjarDinasDetail">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. Urut</label>
						<div class="col-10">
							<input class="form-control" type="number" name="no_urut" id="no_urut">
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
							<select class="form-control kt-select2" id="nopek_detail" name="nopek_detail" style="width: 100% !important;">
								<option value="">- Pilih Nopek -</option>
								@foreach ($pegawai_list as $pegawai)
									<option value="{{ $pegawai->nopeg.'-'.$pegawai->nama }}">{{ $pegawai->nopeg.' - '.$pegawai->nama }}</option>
								@endforeach
							</select>
							<div id="nopek_detail-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Jabatan</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="jabatan_detail" id="jabatan_detail" style="width: 100% !important;">
								<option value="">- Pilih Jabatan -</option>
								@foreach ($jabatan_list as $jabatan)
									<option value="{{ $jabatan->keterangan }}">{{ $jabatan->keterangan }}</option>
								@endforeach
							</select>
							<div id="jabatan_detail-nya"></div>
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
					<button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--end::Modal-->
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\PerjalananDinasStore', '#formPanjarDinas') !!}
{!! JsValidator::formRequest('App\Http\Requests\PerjalananDinasDetailStore', '#formPanjarDinasDetail') !!}

<script type="text/javascript">

	function refreshTable() {
		var table = $('#kt_table').DataTable();
		table.clear();
		table.ajax.url("{{ route('perjalanan_dinas.index.json.detail', ['no_panjar' => 'null']) }}").load(function() {
			// Callback loads updated row count into a DOM element
			// (a Bootstrap badge on a menu item in this case):
			var rowCount = table.rows().count();
			$('#no_urut').val(rowCount + 1);
		});
	}

	$(document).ready(function () {

		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});

		$('#nopek').select2().on('change', function() {
			var id = $(this).val();
			var url = '{{ route("pekerja.show.json", ":pekerja") }}';
			// go to page edit
			url = url.replace(':pekerja',id);
			$.ajax({
				url: url,
				type: "GET",
				data: {
					_token:"{{ csrf_token() }}"		
				},
				success: function(response){
					console.log(response);
					// isi jabatan
					$('#jabatan').val(response.jabatan).trigger('change');
					// isi golongan
					$('#golongan').val(response.golongan);
				},
				error: function () {
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});
		});

		$('#nopek_detail').select2().on('change', function() {
			var id = $('#nopek_detail').val().split('-')[0];
			var url = '{{ route("pekerja.show.json", ":pekerja") }}';
			// go to page edit
			url = url.replace(':pekerja',id);
			$.ajax({
				url: url,
				type: "GET",
				data: {
					_token:"{{ csrf_token() }}"		
				},
				success: function(response){
					console.log(response);
					// isi jabatan
					$('#jabatan_detail').val(response.jabatan).trigger('change');
					// isi golongan
					$('#golongan_detail').val(response.golongan);
				},
				error: function () {
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});
		});

		var t = $('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('perjalanan_dinas.index.json.detail', ['no_panjar' => 'null']) }}",
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'no', name: 'no'},
				{data: 'nopek', name: 'nopek'},
				{data: 'nama', name: 'nama'},
				{data: 'golongan', name: 'golongan'},
				{data: 'jabatan', name: 'jabatan'},
				{data: 'keterangan', name: 'keterangan'}
			],
			order: [[ 0, "asc" ], [ 1, "asc" ]]
		});

	
		$('#openDetail').click(function(e) {
			e.preventDefault();
			refreshTable();
			$('#kt_modal_4').modal('show');
			$('#title_modal').data('state', 'add');
		});

		// range picker
		$('#date_range_picker').datepicker({
			todayHighlight: true,
			// autoclose: true,
			// language : 'id',
			format   : 'yyyy-mm-dd'
		});

		// minimum setup
		$('#tanggal').datepicker({
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
			// language : 'id',
			format   : 'yyyy-mm-dd'
		});

		$("#formPanjarDinas").on('submit', function(){
			if ($('#nopek-error').length){
				$("#nopek-error").insertAfter("#nopek-nya");
			}

			if ($('#jabatan-error').length){
				$("#jabatan-error").insertAfter("#jabatan-nya");
			}

			if ($('#jenis_dinas-error').length){
				$("#jenis_dinas-error").insertAfter("#jenis_dinas-nya");
			}

			if ($('#biaya-error').length){
				$("#biaya-error").insertAfter("#biaya-nya");
			}

			if ($('#sampai-error').length){
				$("#sampai-error").addClass("float-right");
			}
		});

		$("#formPanjarDinasDetail").on('submit', function(){
			if ($('#nopek_detail-error').length){
				$("#nopek_detail-error").insertAfter("#nopek_detail-nya");
			}

			if ($('#jabatan_detail-error').length){
				$("#jabatan_detail-error").insertAfter("#jabatan_detail-nya");
			}

			if($(this).valid()) {
				// do your ajax stuff here
				var no = $('#no_urut').val();
				var keterangan = $('#keterangan_detail').val();
				var nopek = $('#nopek_detail').val().split('-')[0];
				var nama = $('#nopek_detail').val().split('-')[1];
				var jabatan = $('#jabatan_detail').val();
				var golongan = $('#golongan_detail').val();

				var state = $('#title_modal').data('state');

				var url, session, swal_title;

				if(state == 'add'){
					url = "{{ route('perjalanan_dinas.store.detail') }}";
					session = true;
					swal_title = "Tambah Detail Panjar";
				} else {
					url = "{{ route('perjalanan_dinas.update.detail') }}";
					session = true;
					swal_title = "Update Detail Panjar";
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
						Swal.fire({
							type : 'success',
							title: swal_title,
							text : 'Success',
							timer: 2000
						});
						// close modal
						$('#kt_modal_4').modal('toggle');
						// clear form
						$('#kt_modal_4').on('hidden.bs.modal', function () {
							$(this).find('form').trigger('reset');
							$('#nopek_detail').val('').trigger('change');
							$('#jabatan_detail').val('').trigger('change');
						});
						// append to datatable
						t.ajax.reload();
					},
					error: function () {
						alert("Terjadi kesalahan, coba lagi nanti");
					}
				});
			}
			return false;
		});

		$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var no_nopek = $(this).val();
					
					const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-primary',
						cancelButton: 'btn btn-danger'
					},
						buttonsStyling: false
					})

					swalWithBootstrapButtons.fire({
						title: "Data yang akan dihapus?",
						text: "Nopek : " + no_nopek,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
						if (result.value) {
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
									Swal.fire({
										type  : 'success',
										title : 'Hapus Detail Panjar ' + no_nopek,
										text  : 'Success',
										timer : 2000
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
				swalAlertInit('hapus');
			}
		});

		$('#editRow').click(function(e) {
			e.preventDefault();

			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					// get value from row					
					var no_urut = $(this).val().split('-')[0];
					var no_nopek = $(this).val().split('-')[1];
					$.ajax({
						url: "{{ route('perjalanan_dinas.show.json.detail') }}",
						type: 'GET',
						data: {
							"no_urut": no_urut,
							"no_nopek": no_nopek,
							"session": true,
							"_token": "{{ csrf_token() }}",
						},
						success: function (response) {
							// update stuff
							// append value
							$('#no_urut').val(response.no);
							$('#keterangan_detail').val(response.keterangan);
							$('#nopek_detail').val(response.nopek + '-' + response.nama).trigger('change');
							$('#jabatan_detail').val(response.jabatan).trigger('change');
							$('#golongan_detail').val(response.status);
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
				swalAlertInit('ubah');
			}
		});

	});
</script>
@endsection