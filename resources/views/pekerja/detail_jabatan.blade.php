<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Jabatan
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowJabatan" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowJabatan" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowJabatan" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_jabatan">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Bagian</th>
            <th>Jabatan</th>
            <th>Mulai</th>
            <th>Sampai</th>
            <th>No SKEP</th>
            <th>Tgl SKEP</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="jabatanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Jabatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPekerjaJabatan" enctype="multipart/form-data">
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
						<label for="spd-input" class="col-2 col-form-label">Jabatan</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="jabatan_pekerja" id="jabatan_pekerja" style="width: 100% !important;">
								<option value=""> - Pilih Jabatan- </option>
                                @foreach ($kode_jabatan_list as $kode_jabatan)
                                    <option value="{{ $kode_jabatan->kdjab }}">{{ $kode_jabatan->kdjab.' - '.$kode_jabatan->keterangan }}</option>
                                @endforeach
							</select>
							<div id="jabatan_pekerja-nya"></div>
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

@section('detail_jabatan_script')
{!! JsValidator::formRequest('App\Http\Requests\JabatanStore', '#formPekerjaJabatan') !!}
<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_jabatan').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.jabatan.index.json', ['pekerja' => $pekerja->nopeg]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'bagian', name: 'bagian'},
			{data: 'jabatan', name: 'jabatan'},
			{data: 'mulai', name: 'mulai'},
			{data: 'sampai', name: 'sampai'},
			{data: 'noskep', name: 'noskep'},
			{data: 'tglskep', name: 'tglskep'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowJabatan').click(function(e) {
		e.preventDefault();
		$('#jabatanModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$('#bagian_pekerja').on('change', function(){
		var bagian = $('#bagian_pekerja').val();

		// getJabatanByBagian
		$.ajax({
			url: "{{ route('kode_jabatan.index.json.bagian') }}",
			type: "GET",
			dataType: "JSON",
			headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},
			data: {
				"kodebagian" : bagian
			},
			success: function(response){
				$("#jabatan_pekerja").select2('destroy').empty().select2({
					data: response
				});

				// for(var i = 0; i < response.length; i++)
				// {
				// 	$('#jabatan_pekerja').append('<option data-golongan="'+response[i].golongan+'" value="'+response[i].id+'">'+response[i].text+'</option>');
				// }

				// $('#jabatan_pekerja').select2();
			},
			error: function () {
				alert("Terjadi kesalahan, coba lagi nanti");
			}
		});
	});

	$('#jabatan_pekerja').on('change', function(){
		data = $("#jabatan_pekerja").select2('data')[0];
		$("#golongan_pekerja").val(data.golongan);
	});

	$("#formPekerjaJabatan").on('submit', function(){
		if ($('#bagian_pekerja-error').length){
			$("#bagian_pekerja-error").insertAfter("#bagian_pekerja-nya");
		}

		if ($('#jabatan_pekerja-error').length){
			$("#jabatan_pekerja-error").insertAfter("#jabatan_pekerja-nya");
		}

		if($(this).valid()) {

			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.jabatan.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Jabatan";
			} else {
				url = "{{ route('pekerja.jabatan.update', 
					[
						'pekerja' => $pekerja->nopeg,
						'status' => ':status',
						'nama' => ':nama'
					]) }}";
				url = url
				.replace(':status', $('#status_jabatan').data('status'))
				.replace(':nama', $('#nama_jabatan').data('nama'));

				swal_title = "Update Detail Jabatan";
			}

			$.ajax({
				url: url,
				type: "POST",
				dataType: "JSON",
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				data: $(this).serializeArray(),
				success: function(dataResult){
					Swal.fire({
						type : 'success',
						title: swal_title,
						text : 'Success',
						timer: 2000
					});
					// close modal
					$('#jabatanModal').modal('toggle');
					// clear form
					$('#jabatanModal').on('hidden.bs.modal', function () {
						$(this).find('form').trigger('reset');
						$('#bagian_pekerja').val('').trigger('change');
						$('#jabatan_pekerja').val('').trigger('change');
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

	$('#deleteRowJabatan').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_jabatan]').is(':checked')) { 
			$("input[name=radio_jabatan]:checked").each(function() {
				var nopeg = $(this).val().split('_')[0];
				var mulai = $(this).val().split('_')[1];
				var kdbag = $(this).val().split('_')[2];
				var kdjab = $(this).val().split('_')[3];
				
				const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary',
					cancelButton: 'btn btn-danger'
				},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: "Data yang akan dihapus?",
					text: "Nama Jabatan : " + kdjab,
					type: 'warning',
					showCancelButton: true,
					reverseButtons: true,
					confirmButtonText: 'Ya, hapus',
					cancelButtonText: 'Batalkan'
				})
				.then((result) => {
					if (result.value) {
						$.ajax({
							url: "{{ route('pekerja.jabatan.delete') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"nopeg": "{{ $pekerja->nopeg }}",
								"mulai": mulai,
								"kdbag": kdbag,
								"kdjab": kdjab,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail Jabatan ' + kdjab,
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

	$('#editRowJabatan').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_jabatan]').is(':checked')) { 
			$("input[name=radio_jabatan]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('-')[0];
				var status = $(this).val().split('-')[1];
				var nama = $(this).val().split('-')[2];

				$.ajax({
					url: "{{ route('pekerja.jabatan.show.json') }}",
					type: 'GET',
					data: {
						"nopeg" : "{{ $pekerja->nopeg }}",
						"status" : status,
						"nama" : nama,
						"_token": "{{ csrf_token() }}",
					},
					success: function (response) {
						$('#nama_jabatan').val(response.nama);
						$('#status_jabatan').val(response.status).trigger('change');
						$('#tempat_lahir_jabatan').val(response.tempatlahir);
						$('#tanggal_lahir_jabatan').val(response.tgllahir);
						$('#agama_jabatan').val(response.agama).trigger('change');
						$('#golongan_darah_jabatan').val(response.goldarah).trigger('change');
						$('#pendidikan_jabatan').val(response.kodependidikan).trigger('change');
						$('#tempat_pendidikan_jabatan').val(response.tempatpendidikan);
						
						// title
						$('#title_modal').text('Ubah Detail Jabatan');
						$('#title_modal').data('state', 'update');
						// for url update
						$('#nama_jabatan').data('nama', response.nama);
						$('#status_jabatan').data('status', response.status);
						// open modal
						$('#jabatanModal').modal('show');
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