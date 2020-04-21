<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Golongan Gaji
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowGolonganGaji" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowGolonganGaji" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowGolonganGaji" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_golongan_gaji">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Golongan Gaji</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="golonganGajiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Golongan Gaji</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formGolonganGaji" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Golongan Gaji</label>
						<div class="col-10">
							<input class="form-control" type="text" name="golongan_gaji" id="golongan_gaji">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Tanggal</label>
						<div class="col-10">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="tanggal_golongan_gaji" id="tanggal_golongan_gaji">
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

@section('detail_golongan_gaji_script')
{!! JsValidator::formRequest('App\Http\Requests\GolonganGajiStore', '#formGolonganGaji') !!}
<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_golongan_gaji').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.golongan_gaji.index.json', ['pekerja' => $pekerja->nopeg]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'tanggal', name: 'tanggal'},
			{data: 'golgaji', name: 'golgaji'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowGolonganGaji').click(function(e) {
		e.preventDefault();
		$('#golonganGajiModal').modal('show');
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

	$("#formGolonganGaji").on('submit', function(){
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
				url = "{{ route('pekerja.golongan_gaji.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Jabatan";
			} else {
				url = "{{ route('pekerja.golongan_gaji.update', 
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
					$('#golonganGajiModal').modal('toggle');
					// clear form
					$('#golonganGajiModal').on('hidden.bs.modal', function () {
						$(this).find('form').trigger('reset');
						$('#status_jabatan').val('').trigger('change');
						$('#agama_jabatan').val('').trigger('change');
						$('#pendidikan_jabatan').val('').trigger('change');
						$('#golongan_darah_jabatan').val('').trigger('change');
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

	$('#deleteRowGolonganGaji').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_jabatan]').is(':checked')) { 
			$("input[name=radio_jabatan]:checked").each(function() {
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
							url: "{{ route('pekerja.golongan_gaji.delete') }}",
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

	

	$('#editRowGolonganGaji').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_jabatan]').is(':checked')) { 
			$("input[name=radio_jabatan]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('-')[0];
				var status = $(this).val().split('-')[1];
				var nama = $(this).val().split('-')[2];

				$.ajax({
					url: "{{ route('pekerja.golongan_gaji.show.json') }}",
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
						$('#golonganGajiModal').modal('show');
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