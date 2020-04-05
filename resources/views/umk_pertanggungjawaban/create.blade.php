@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Uang Muka Kerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Uang Muka Kerja 
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Pertanggungjawaban 
				</a>
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
					Tambah Pertanggungjawaban Uang Muka Kerja
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
								Header Pertanggungjawaban Uang Muka Kerja
							</h5>	
						</div>
					</div>
				</div>
				<form class="kt-form kt-form--label-right" id="formPPUmk" action="{{ route('uang_muka_kerja.pertanggungjawaban.store') }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. PUMK</label>
						<div class="col-5">
							<input class="form-control" type="text" name="no_pumk" value="{{ sprintf("%03s", $pumk_header_count + 1).'/CS/'.date('d').'/'.date('m').'/'.date('Y') }}" id="no_pumk">
						</div>

						<label for="spd-input" class="col-2 col-form-label">Tanggal PUMK</label>
						<div class="col-3">
							<input class="form-control" type="text" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="no_umk" class="col-2 col-form-label">No. UMK</label>
						<div class="col-10">
							<select class="form-control kt-select2" id="no_umk" name="no_umk">
								<option value="">- Pilih No. UMK -</option>
								@foreach ($umk_header_list as $umk)
								<option value="{{ $umk->no_umk }}">{{ $umk->no_umk }}</option>
								@endforeach
							</select>
							<div id="no_umk-nya"></div>
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
					Detail Pertanggungjawaban Uang Muka Kerja
				</h3>

				<div class="kt-portlet__head-actions" style="font-size: 2rem;">
					<span id="openDetail" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
						<i class="fas fa-plus-circle"></i>
					</span>
	
					<span id="editRow" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
						<i class="fas fa-edit"></i>
					</span>
	
					<span id="deleteRow" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
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
						<th>Keterangan</th>
						<th>Account</th>
						<th>CJ</th>
						<th>JB</th>
						<th>Bagian</th>
						<th>Nilai</th>
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
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPUmkDetail">
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
						<label for="spd-input" class="col-2 col-form-label">Account</label>
						<div class="col-5">
							<select class="form-control kt-select2" id="account_detail" name="account_detail" style="width: 100% !important;">
								<option value="">- Pilih Nopek -</option>
								@foreach ($pegawai_list as $pegawai)
									<option value="{{ $pegawai->nopeg.'-'.$pegawai->nama }}">{{ $pegawai->nopeg.' - '.$pegawai->nama }}</option>
								@endforeach
							</select>
							<div id="account_detail-nya"></div>
						</div>

						<div class="col-5">
							<input class="form-control" type="text" name="account_detail_name" id="account_detail_name">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Kode Bagian</label>
						<div class="col-5">
							<select class="form-control kt-select2" id="kode_bagian_detail" name="kode_bagian_detail" style="width: 100% !important;">
								<option value="">- Pilih Nopek -</option>
								@foreach ($pegawai_list as $pegawai)
									<option value="{{ $pegawai->nopeg.'-'.$pegawai->nama }}">{{ $pegawai->nopeg.' - '.$pegawai->nama }}</option>
								@endforeach
							</select>
							<div id="kode_bagian_detail-nya"></div>
						</div>

						<div class="col-5">
							<input class="form-control" type="text" name="kode_bagian_nilai_detail" id="kode_bagian_nilai_detail">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Perintah Kerja</label>
						<div class="col-10">
							<input class="form-control" type="text" name="perintah_kerja_detail" id="perintah_kerja_detail">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Jenis Biaya</label>
						<div class="col-5">
							<select class="form-control kt-select2" id="jenis_biaya_detail" name="jenis_biaya_detail" style="width: 100% !important;">
								<option value="">- Pilih Jenis Biaya -</option>
								@foreach ($pegawai_list as $pegawai)
									<option value="{{ $pegawai->nopeg.'-'.$pegawai->nama }}">{{ $pegawai->nopeg.' - '.$pegawai->nama }}</option>
								@endforeach
							</select>
							<div id="jenis_biaya_detail-nya"></div>
						</div>

						<div class="col-5">
							<input class="form-control" type="text" name="jenis_biaya_nilai_detail" id="jenis_biaya_nilai_detail">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">C.Judex</label>
						<div class="col-5">
							<select class="form-control kt-select2" id="c_judex_detail" name="c_judex_detail" style="width: 100% !important;">
								<option value="">- Pilih Nopek -</option>
								@foreach ($pegawai_list as $pegawai)
									<option value="{{ $pegawai->nopeg.'-'.$pegawai->nama }}">{{ $pegawai->nopeg.' - '.$pegawai->nama }}</option>
								@endforeach
							</select>
							<div id="c_judex_detail-nya"></div>
						</div>

						<div class="col-5">
							<input class="form-control" type="text" name="c_judex_nilai_detail" id="c_judex_nilai_detail">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Jumlah</label>
						<div class="col-10">
							<input class="form-control" type="number" name="jumlah_detail" id="jumlah_detail">
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
{!! JsValidator::formRequest('App\Http\Requests\PUmkStore', '#formPPUmk') !!}
{!! JsValidator::formRequest('App\Http\Requests\PUmkDetailStore', '#formPUmkDetail') !!}

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
				{data: 'action', name: 'aksi', orderable: false, searchable: false},
				{data: 'no', name: 'no'},
				{data: 'nopek', name: 'nopek'},
				{data: 'keterangan', name: 'keterangan'},
				{data: 'nilai', name: 'nilai'},
				{data: 'qty', name: 'qty'},
				{data: 'total', name: 'total'},
				{data: 'total', name: 'total'}
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

		$("#formPPUmk").on('submit', function(){
			if ($('#no_umk-error').length){
				$("#no_umk-error").insertAfter("#no_umk-nya");
			}

			if ($('#nopek-error').length){
				$("#nopek-error").insertAfter("#nopek-nya");
			}

			if ($('#jabatan-error').length){
				$("#jabatan-error").insertAfter("#jabatan-nya");
			}
		});

		$("#formPUmkDetail").on('submit', function(){
			if ($('#account_detail-error').length){
				$("#account_detail-error").insertAfter("#account_detail-nya");
			}

			if ($('#kode_bagian_detail-error').length){
				$("#kode_bagian_detail-error").insertAfter("#kode_bagian_detail-nya");
			}

			if ($('#jenis_biaya_detail-error').length){
				$("#jenis_biaya_detail-error").insertAfter("#jenis_biaya_detail-nya");
			}

			if ($('#c_judex_detail-error').length){
				$("#c_judex_detail-error").insertAfter("#c_judex_detail-nya");
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
				Swal.fire({
					type: 'warning',
					timer: 2000,
					title: 'Oops...',
					text: 'Tandai baris yang ingin dihapus'
				});
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
				Swal.fire({
					type: 'warning',
					timer: 2000,
					title: 'Oops...',
					text: 'Tandai baris yang ingin diubah'
				});
			}
		});

	});
</script>
@endsection