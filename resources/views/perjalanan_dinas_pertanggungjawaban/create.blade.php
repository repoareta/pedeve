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
					Pertanggungjawaban Perjalanan Dinas </a>
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
					Tambah Pertanggungjawaban Panjar Dinas
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
								Header Pertanggungjawaban Panjar Dinas
							</h5>	
						</div>
					</div>
				</div>
				<form class="kt-form kt-form--label-right" id="formPPanjarDinas" action="{{ route('perjalanan_dinas.pertanggungjawaban.store') }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. PJ Panjar</label>
						<div class="col-5">
							<input class="form-control" type="text" name="no_pj_panjar" value="{{ ($ppanjar_header_count + 1).'/CS/'.date('d').'/'.date('m').'/'.date('Y') }}" id="no_pj_panjar">
						</div>

						<label for="spd-input" class="col-2 col-form-label">Tanggal PJ Panjar</label>
						<div class="col-3">
							<input class="form-control" type="text" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}">
						</div>
					</div>

					
					<div class="form-group row">
						<label for="example-email-input" class="col-2 col-form-label">No. Panjar</label>
						<div class="col-5">
							<select class="form-control kt-select2" name="no_panjar" id="no_panjar">
								<option value="">- Pilih No. Panjar -</option>
								@foreach ($panjar_header_list as $panjar_header)
									<option value="{{ $panjar_header->no_panjar }}">{{ $panjar_header->no_panjar }}</option>
								@endforeach
							</select>
							<div id="no_panjar-nya"></div>
						</div>

						<label for="example-email-input" class="col-2 col-form-label">Keterangan</label>
						<div class="col-3">
							<input class="form-control" type="text" name="keterangan" id="keterangan">
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
						<label for="jumlah" class="col-2 col-form-label">Jumlah</label>
						<div class="col-10">
							<input class="form-control" type="number" name="jumlah" id="jumlah">
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
					Detail Pertanggungjawaban Panjar Dinas
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<span style="font-size: 2em;" class="kt-font-success" id="openDetail" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
							<i class="fas fa-plus-circle"></i>
						</span>
		
						<span style="font-size: 2em;" class="kt-font-warning pointer-link" id="editRow" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
							<i class="fas fa-edit"></i>
						</span>
		
						<span style="font-size: 2em;" class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
							<i class="fas fa-times-circle"></i>
						</span>
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
						<th>Keterangan</th>
						<th>Nilai</th>
						<th>Qty</th>
						<th>Total</th>
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
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Pertanggungjawaban Panjar Dinas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPPanjarDinasDetail">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. Urut</label>
						<div class="col-10">
							<input class="form-control" type="number" name="no_urut" id="no_urut">
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
						<label for="spd-input" class="col-2 col-form-label">Keterangan</label>
						<div class="col-10">
							<textarea class="form-control" name="keterangan_detail" id="keterangan_detail"></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nilai</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nilai_detail" id="nilai_detail">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Qty</label>
						<div class="col-10">
							<input class="form-control" type="text" name="qty_detail" id="qty_detail">
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
{!! JsValidator::formRequest('App\Http\Requests\PPerjalananDinasStore', '#formPPanjarDinas') !!}
{!! JsValidator::formRequest('App\Http\Requests\PPerjalananDinasDetailStore', '#formPPanjarDinasDetail') !!}

<script type="text/javascript">

	function refreshTable() {
		var table = $('#kt_table').DataTable();
		table.clear();
		table.ajax.url("{{ route('perjalanan_dinas.pertanggungjawaban.detail.index.json', ['no_ppanjar' => 'null']) }}").load(function() {
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

		var t = $('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			language: {
				processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax: "{{ route('perjalanan_dinas.pertanggungjawaban.detail.index.json', ['no_ppanjar' => 'null']) }}",
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'no', name: 'no'},
				{data: 'nopek', name: 'nopek', class:'no-wrap'},
				{data: 'keterangan', name: 'keterangan'},
				{data: 'nilai', name: 'nilai', class:'no-wrap text-right'},
				{data: 'qty', name: 'qty', class:'no-wrap text-right'},
				{data: 'total', name: 'total', class:'no-wrap text-right'}
			],
			order: [[ 0, "asc" ], [ 1, "asc" ]]
		});
	
		$('#openDetail').click(function(e) {
			e.preventDefault();
			refreshTable();
			$('#kt_modal_4').modal('show');
			$('#title_modal').data('state', 'add');
		});

		// minimum setup
		$('#tanggal').datepicker({
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
			// language : 'id',
			format   : 'yyyy-mm-dd'
		});

		$("#formPPanjarDinas").on('submit', function(){
			if ($('#no_panjar-error').length){
				$("#no_panjar-error").insertAfter("#no_panjar-nya");
			}

			if ($('#nopek-error').length){
				$("#nopek-error").insertAfter("#nopek-nya");
			}

			if ($('#jabatan-error').length){
				$("#jabatan-error").insertAfter("#jabatan-nya");
			}
		});

		$("#formPPanjarDinasDetail").on('submit', function(){
			if ($('#nopek_detail-error').length){
				$("#nopek_detail-error").insertAfter("#nopek_detail-nya");
			}

			if($(this).valid()) {
				// do your ajax stuff here
				var no = $('#no_urut').val();
				var keterangan = $('#keterangan_detail').val();
				var nopek = $('#nopek_detail').val().split('-')[0];
				var nilai = $('#nilai_detail').val();
				var qty = $('#qty_detail').val();
				var total = nilai*qty;

				var state = $('#title_modal').data('state');

				var url, session, swal_title;

				if(state == 'add'){
					url = "{{ route('perjalanan_dinas.pertanggungjawaban.detail.store') }}";
					session = true;
					swal_title = "Tambah Detail Pertanggungjawaban Panjar";
				} else {
					url = "{{ route('perjalanan_dinas.pertanggungjawaban.detail.update') }}";
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
						nilai: nilai,
						qty: qty,
						total: total,
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
								url: "{{ route('perjalanan_dinas.pertanggungjawaban.detail.delete') }}",
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
										title : 'Hapus Detail Pertanggungjawaban Panjar ' + no_nopek,
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