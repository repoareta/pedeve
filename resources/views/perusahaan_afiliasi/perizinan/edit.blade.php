{{-- PEMEGANG SAHAM START --}}
<div class="kt-portlet__head kt-portlet__head">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon2-files-and-folders"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Perizinan
        </h3>
        
        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addPerizinan" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editPerizinan" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deletePerizinan" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>
    </div>
</div>
<div class="kt-portlet__body">
    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_perizinan">
        <thead class="thead-light">
            <tr>
                <th></th>
                <th>Keterangan</th>
                <th>Nomor</th>
                <th>Masa Berlaku Akhir</th>
                <th>Dokumen</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- PEMEGANG SAHAM END --}}

<!--begin::Modal-->
<div class="modal fade" id="perizinanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Perizinan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPerizinanStore" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="keterangan_perizinan" class="col-3 col-form-label">Keterangan</label>
						<div class="col-9">
							<input class="form-control" type="text" name="keterangan_perizinan" id="keterangan_perizinan">
						</div>
                    </div>
                    
                    <div class="form-group row">
						<label for="nomor_perizinan" class="col-3 col-form-label">Nomor</label>
						<div class="col-9">
							<input class="form-control" type="text" name="nomor_perizinan" id="nomor_perizinan">
						</div>
					</div>

                    <div class="form-group row">
						<label for="" class="col-3 col-form-label">Masa Berlaku Akhir</label>
						<div class="col-9">
							<input class="form-control datepicker" type="text" name="masa_berlaku_akhir_perizinan" id="masa_berlaku_akhir_perizinan" autocomplete="off">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="" class="col-3 col-form-label">Dokumen Upload</label>
						<div class="col-9">
                            <input type="file" name="dokumen_perizinan" id="dokumen_perizinan">
                            <span class="form-text text-muted" id="photo-nya">Tipe dokumen: .pdf</span>
                            <div id="dokumen_perizinan-nya"></div>
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


@section('perizinan_script')
{!! JsValidator::formRequest('App\Http\Requests\PerizinanStore', '#formPerizinanStore') !!}
{!! JsValidator::formRequest('App\Http\Requests\PerizinanUpdate', '#formPerizinanUpdate') !!}

<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_perizinan').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('perusahaan_afiliasi.perizinan.index.json', ['perusahaan_afiliasi' => $perusahaan_afiliasi]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'keterangan', name: 'keterangan'},
			{data: 'nomor', name: 'tmt_dinas'},
			{data: 'masa_berlaku_akhir', name: 'masa_berlaku_akhir'},
			{data: 'dokumen', name: 'dokumen'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});

    // minimum setup
    $('.datepicker').datepicker({
        todayHighlight: true,
        orientation: "bottom left",
        autoclose: true,
        // language : 'id',
        format   : 'yyyy-mm-dd'
    });

	$('#addPerizinan').click(function(e) {
		e.preventDefault();
		$('#perizinanModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$("#formPerizinanStore").on('submit', function(){

        if ($('#dokumen_perizinan-error').length){
			$("#dokumen_perizinan-error").insertAfter("#dokumen_perizinan-nya");
		}

		if($(this).valid()) {
			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('perusahaan_afiliasi.perizinan.store', ['perusahaan_afiliasi' => $perusahaan_afiliasi]) }}";
				swal_title = "Tambah Perizinan";
			} else {
				url = "{{ route('perusahaan_afiliasi.perizinan.update', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'perizinan' => ':id',
					]) }}";
				url = url
				.replace(':id', $('#title_modal').data('id'));

				swal_title = "Update Perizinan";
			}

			$.ajax({
				url: url,
				type: "POST",
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
				success: function(dataResult){
					Swal.fire({
						type : 'success',
						title: swal_title,
						text : 'Success',
						timer: 2000
					});
					// close modal
					$('#perizinanModal').modal('toggle');
					// clear form
					$('#perizinanModal').on('hidden.bs.modal', function () {
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

	$('#deletePerizinan').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_perizinan]').is(':checked')) { 
			$("input[name=radio_perizinan]:checked").each(function() {
				var id = $(this).val();
				var nama = $(this).attr('nama');

                var url = "{{ route('perusahaan_afiliasi.perizinan.delete', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'perizinan' => ':id',
					]) }}";
				url = url
				.replace(':id', id);

				const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary',
					cancelButton: 'btn btn-danger'
				},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: "Data yang akan dihapus?",
					text: "Perizinan : " + nama,
					type: 'warning',
					showCancelButton: true,
					reverseButtons: true,
					confirmButtonText: 'Ya, hapus',
					cancelButtonText: 'Batalkan'
				})
				.then((result) => {
					if (result.value) {
						$.ajax({
							url: url,
							type: 'DELETE',
							dataType: 'json',
							data: {
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail Perizinan ' + nama,
									text  : 'Berhasil',
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

	

	$('#editPerizinan').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_perizinan]').is(':checked')) { 
			$("input[name=radio_perizinan]:checked").each(function() {
				// get value from row					
				var id = $(this).val();
				var nama = $(this).attr('nama');

                var url = "{{ route('perusahaan_afiliasi.perizinan.show.json', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'perizinan' => ':id',
					]) }}";
				url = url.replace(':id', id);

				$.ajax({
					url: url,
					type: 'GET',
					success: function (response) {
						console.log(response);
						// update stuff
						// append value
						$('#nama_perizinan').val(response.nama);
						$('#tmt_dinas').val(response.tmt_dinas);
						$('#akhir_masa_dinas').val(response.akhir_masa_dinas);
						
						// title
						$('#title_modal').text('Ubah Perizinan');
						$('#title_modal').data('state', 'update');
						$('#title_modal').data('id', id);
						// open modal
						$('#perizinanModal').modal('show');
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