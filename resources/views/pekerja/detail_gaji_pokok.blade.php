<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Gaji Pokok
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowGajiPokok" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowGajiPokok" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowGajiPokok" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_gaji_pokok">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Gaji Pokok</th>
            <th>Mulai</th>
            <th>Sampai</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="gajiPokokModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Gaji Pokok</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPekerjaGajiPokok">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nomor Pekerja</label>
						<div class="col-10">
							<input class="form-control" type="text" readonly name="nopeg_gaji_pokok" id="nopeg_gaji_pokok" value="{{ $pekerja->nopeg }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Gaji Pokok</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nilai_gaji_pokok" id="nilai_gaji_pokok">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Mulai</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="mulai_gaji_pokok" id="mulai_gaji_pokok">
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
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="sampai_gaji_pokok" id="sampai_gaji_pokok">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Keterangan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="keterangan_gaji_pokok" id="keterangan_gaji_pokok">
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

@section('detail_gaji_pokok_script')
{!! JsValidator::formRequest('App\Http\Requests\GajiPokokStore', '#formPekerjaGajiPokok') !!}
<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_gaji_pokok').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.gaji_pokok.index.json', ['pekerja' => $pekerja->nopeg]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'gapok', name: 'gapok'},
			{data: 'mulai', name: 'mulai'},
			{data: 'sampai', name: 'sampai'},
			{data: 'keterangan', name: 'keterangan'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowGajiPokok').click(function(e) {
		e.preventDefault();
		$('#gajiPokokModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$("#formPekerjaGajiPokok").on('submit', function(){
		if($(this).valid()) {

			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.gaji_pokok.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail GajiPokok";
			} else {
				url = "{{ route('pekerja.gaji_pokok.update', 
					[
						'pekerja' => $pekerja->nopeg,
						'status' => ':status',
						'nama' => ':nama'
					]) }}";
				url = url
				.replace(':status', $('#status_jabatan').data('status'))
				.replace(':nama', $('#nama_jabatan').data('nama'));

				swal_title = "Update Detail GajiPokok";
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
					$('#gajiPokokModal').modal('toggle');
					// clear form
					$('#gajiPokokModal').on('hidden.bs.modal', function () {
						$(this).find('form').trigger('reset');
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

	$('#deleteRowGajiPokok').click(function(e) {
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
					text: "Nama GajiPokok : " + kdjab,
					type: 'warning',
					showCancelButton: true,
					reverseButtons: true,
					confirmButtonText: 'Ya, hapus',
					cancelButtonText: 'Batalkan'
				})
				.then((result) => {
					if (result.value) {
						$.ajax({
							url: "{{ route('pekerja.gaji_pokok.delete') }}",
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
									title : 'Hapus Detail GajiPokok ' + kdjab,
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

	$('#editRowGajiPokok').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_jabatan]').is(':checked')) { 
			$("input[name=radio_jabatan]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('-')[0];
				var status = $(this).val().split('-')[1];
				var nama = $(this).val().split('-')[2];

				$.ajax({
					url: "{{ route('pekerja.gaji_pokok.show.json') }}",
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
						$('#title_modal').text('Ubah Detail GajiPokok');
						$('#title_modal').data('state', 'update');
						// for url update
						$('#nama_jabatan').data('nama', response.nama);
						$('#status_jabatan').data('status', response.status);
						// open modal
						$('#gajiPokokModal').modal('show');
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