<div class="kt-portlet__head" style="padding-left:0px;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Keluarga
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowKeluarga" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowKeluarga" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowKeluarga" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Nama Keluarga</th>
            <th>Status</th>
            <th>Tempat & Tgl Lahir</th>
            <th>Agama</th>
            <th>Golongan Darah</th>
            <th>Pendidikan (Tempat)</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Keluarga</h5>
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

@section('detail_keluarga_script')
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