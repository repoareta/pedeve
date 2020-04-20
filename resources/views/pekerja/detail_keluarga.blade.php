<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
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

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_keluarga">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Nama Keluarga</th>
            <th>Status</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Agama</th>
            <th>Golongan Darah</th>
            <th>Pendidikan (Tempat)</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="keluargaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Keluarga</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPekerjaKeluarga" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nama</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nama_keluarga" id="nama_keluarga">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Status</label>
						<div class="col-10">
							<select class="form-control kt-select2" id="status_keluarga" name="status_keluarga" style="width: 100% !important;">
								<option value="">- Pilih Status -</option>
								<option value="S">Suami<option>
								<option value="I">Istri<option>
								<option value="A">Anak<option>
							</select>
							<div id="nopek_detail-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Tempat Lahir</label>
						<div class="col-4">
							<input class="form-control" type="text" name="tempat_lahir_keluarga" id="tempat_lahir_keluarga">
						</div>

						<label for="spd-input" class="col-2 col-form-label">Tanggal Lahir</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal Lahir" name="tanggal_lahir_keluarga" id="tanggal_lahir_keluarga">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Agama</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="agama_keluarga" id="agama_keluarga" style="width: 100% !important;">
								<option value="">- Pilih Jabatan -</option>
								@foreach ($agama_list as $agama)
									<option value="{{ $agama->kode }}">{{ $agama->nama }}</option>
								@endforeach
							</select>
							<div id="agama_keluarga-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Golongan Darah</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="golongan_darah_keluarga" id="golongan_darah_keluarga" style="width: 100% !important;">
								<option value=""> - Pilih Golongan Darah- </option>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="AB">AB</option>
									<option value="O">O</option>
							</select>
							<div id="golongan_darah_keluarga-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Pendidikan</label>
						<div class="col-4">
							<select class="form-control kt-select2" name="pendidikan_keluarga" id="pendidikan_keluarga" style="width: 100% !important;">
								<option value="">- Pilih Pendidikan -</option>
								@foreach ($pendidikan_list as $pendidikan)
									<option value="{{ $pendidikan->kode }}">{{ $pendidikan->nama }}</option>
								@endforeach
							</select>
							<div id="pendidikan_keluarga-nya"></div>
						</div>

						<label for="spd-input" class="col-2 col-form-label" style="padding-right:0px;">Tempat Pendidikan</label>
						<div class="col-4">
							<input class="form-control" type="text" name="tempat_pendidikan_keluarga" id="tempat_pendidikan_keluarga">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Photo</label>
						<div class="col-10">
							<div class="kt-avatar" id="photo_keluarga">
								<div class="kt-avatar__holder" style="background-image: url(assets/media/users/default.jpg)"></div>
								<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Ubah foto">
									<i class="fa fa-pen"></i>
									<input type="file" name="photo_keluarga" accept=".png, .jpg, .jpeg">
								</label>
								<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Hapus foto">
									<i class="fa fa-times"></i>
								</span>
							</div>
							<span class="form-text text-muted" id="photo-nya">Tipe berkas: .png, .jpg, jpeg.</span>
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
{!! JsValidator::formRequest('App\Http\Requests\KeluargaStore', '#formPekerjaKeluarga') !!}
<script type="text/javascript">
	$(document).ready(function () {

		// Class definition
	var KTAvatarDemo = function () {
		// Private functions
		var initDemos = function () {
			var avatar2 = new KTAvatar('photo_keluarga');
		}

		return {
			// public functions
			init: function() {
				initDemos();
			}
		};
	}();

	KTUtil.ready(function() {
		KTAvatarDemo.init();
	});

	var t = $('#kt_table_keluarga').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.keluarga.index.json', ['pekerja' => $pekerja->nopeg]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'nama', name: 'nama'},
			{data: 'status', name: 'status'},
			{data: 'tempatlahir', name: 'tempatlahir'},
			{data: 'tgllahir', name: 'tgllahir'},
			{data: 'agama', name: 'agama'},
			{data: 'goldarah', name: 'goldarah'},
			{data: 'pendidikan', name: 'pendidikan'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowKeluarga').click(function(e) {
		e.preventDefault();
		$('#keluargaModal').modal('show');
		$('#title_modal').data('state', 'add');
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

	$("#formPekerjaKeluarga").on('submit', function(){
		if ($('#nopek_detail-error').length){
			$("#nopek_detail-error").insertAfter("#nopek_detail-nya");
		}

		if ($('#jabatan_detail-error').length){
			$("#jabatan_detail-error").insertAfter("#jabatan_detail-nya");
		}

		if($(this).valid()) {
			// do your ajax stuff here
			var keluarga = $(this).serializeArray();

			var state = $('#title_modal').data('state');

			var url, session, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.keluarga.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Keluarga";
			} else {
				url = "{{ route('pekerja.keluarga.update', [
					'pekerja' => $pekerja->nopeg,
					'status' => ':hehe',
					'nama' => ':hehe'
					]) }}";
				session = true;
				swal_title = "Update Detail Panjar";
			}

			$.ajax({
				url: url,
				type: "POST",
				dataType: "JSON",
				processData: false,
        		contentType: false,
				headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				data: new FormData(this),
				success: function(dataResult){
					Swal.fire({
						type : 'success',
						title: swal_title,
						text : 'Success',
						timer: 2000
					});
					// close modal
					$('#keluargaModal').modal('toggle');
					// clear form
					$('#keluargaModal').on('hidden.bs.modal', function () {
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
						$('#keluargaModal').modal('toggle');
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