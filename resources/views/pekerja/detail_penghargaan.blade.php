<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Penghargaan
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowPenghargaan" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowPenghargaan" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowPenghargaan" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_penghargaan">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Pemberi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="penghargaanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Jabatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPenghargaan" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Bagian</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="bagian_pekerja" id="bagian_pekerja" style="width: 100% !important;">
								<option value=""> - Pilih Bagian- </option>
                                @foreach ($kode_bagian_list as $kode_bagian)
                                    <option value="{{ $kode_bagian->kode }}">{{ $kode_bagian->kode.' - '.$kode_bagian->nama }}</option>
                                @endforeach
							</select>
							<div id="bagian_pekerja-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Golongan</label>
						<div class="col-10">
							<input class="form-control" type="text" readonly name="golongan_pekerja" id="golongan_pekerja">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Mulai</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="mulai" id="mulai">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
                        </div>
                        
                        <label for="spd-input" class="col-2 col-form-label">Sampai</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="sampai" id="sampai">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nomor SKEP</label>
						<div class="col-10">
							<input class="form-control" type="text" name="no_skep" id="no_skep">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Tanggal SKEP</label>
						<div class="col-10">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="tanggal_skep" id="tanggal_skep">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
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

@section('detail_penghargaan_script')
{!! JsValidator::formRequest('App\Http\Requests\JabatanStore', '#formPenghargaan') !!}
<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_penghargaan').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.penghargaan.index.json', ['pekerja' => $pekerja->nopeg]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'nama', name: 'nama'},
			{data: 'tanggal', name: 'tanggal'},
			{data: 'pemberi', name: 'pemberi'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowPenghargaan').click(function(e) {
		e.preventDefault();
		$('#penghargaanModal').modal('show');
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

	$("#formPenghargaan").on('submit', function(){
		if ($('#nopek_detail-error').length){
			$("#nopek_detail-error").insertAfter("#nopek_detail-nya");
		}

		if ($('#jabatan_detail-error').length){
			$("#jabatan_detail-error").insertAfter("#jabatan_detail-nya");
		}

		if($(this).valid()) {
			// do your ajax stuff here
			var jabatan = $(this).serializeArray();

			var state = $('#title_modal').data('state');

			var url, session, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.penghargaan.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Jabatan";
			} else {
				url = "{{ route('pekerja.penghargaan.update', 
					[
						'pekerja' => $pekerja->nopeg,
						'status' => ':status',
						'nama' => ':nama'
					]) }}";
				url = url
				.replace(':status', $('#status_penghargaan').data('status'))
				.replace(':nama', $('#nama_penghargaan').data('nama'));

				swal_title = "Update Detail Jabatan";
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
					$('#penghargaanModal').modal('toggle');
					// clear form
					$('#penghargaanModal').on('hidden.bs.modal', function () {
						$(this).find('form').trigger('reset');
						$('#status_penghargaan').val('').trigger('change');
						$('#agama_penghargaan').val('').trigger('change');
						$('#pendidikan_penghargaan').val('').trigger('change');
						$('#golongan_darah_penghargaan').val('').trigger('change');
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

	$('#deleteRowPenghargaan').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_penghargaan]').is(':checked')) { 
			$("input[name=radio_penghargaan]:checked").each(function() {
				var nopeg = $(this).val().split('-')[0];
				var status = $(this).val().split('-')[1];
				var nama = $(this).val().split('-')[2];
				
				const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary',
					cancelButton: 'btn btn-danger'
				},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: "Data yang akan dihapus?",
					text: "Nama : " + nama,
					type: 'warning',
					showCancelButton: true,
					reverseButtons: true,
					confirmButtonText: 'Ya, hapus',
					cancelButtonText: 'Batalkan'
				})
				.then((result) => {
					if (result.value) {
						$.ajax({
							url: "{{ route('pekerja.penghargaan.delete') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"nopeg": nopeg,
								"status": status,
								"nama": nama,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail Jabatan ' + nama,
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

	

	$('#editRowPenghargaan').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_penghargaan]').is(':checked')) { 
			$("input[name=radio_penghargaan]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('-')[0];
				var status = $(this).val().split('-')[1];
				var nama = $(this).val().split('-')[2];

				$.ajax({
					url: "{{ route('pekerja.penghargaan.show.json') }}",
					type: 'GET',
					data: {
						"nopeg" : "{{ $pekerja->nopeg }}",
						"status" : status,
						"nama" : nama,
						"_token": "{{ csrf_token() }}",
					},
					success: function (response) {
						console.log(response);
						// update stuff
						// append value
						if(response.photo) {
							var img = "{{ asset('storage/pekerja_img/') }}" + "/" + response.photo;

							$(".kt-avatar__holder").css(
								'background-image', 
								"url(" + img + ")"
							);
						}
						
						$('#nama_penghargaan').val(response.nama);
						$('#status_penghargaan').val(response.status).trigger('change');
						$('#tempat_lahir_penghargaan').val(response.tempatlahir);
						$('#tanggal_lahir_penghargaan').val(response.tgllahir);
						$('#agama_penghargaan').val(response.agama).trigger('change');
						$('#golongan_darah_penghargaan').val(response.goldarah).trigger('change');
						$('#pendidikan_penghargaan').val(response.kodependidikan).trigger('change');
						$('#tempat_pendidikan_penghargaan').val(response.tempatpendidikan);
						
						// title
						$('#title_modal').text('Ubah Detail Jabatan');
						$('#title_modal').data('state', 'update');
						// for url update
						$('#nama_penghargaan').data('nama', response.nama);
						$('#status_penghargaan').data('status', response.status);
						// open modal
						$('#penghargaanModal').modal('show');
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