{{-- PEMEGANG SAHAM START --}}
<div class="kt-portlet__head kt-portlet__head">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon2-avatar"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Direksi
        </h3>
        
        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addDireksi" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editDireksi" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteDireksi" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>
    </div>
</div>
<div class="kt-portlet__body">
    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_direksi">
        <thead class="thead-light">
            <tr>
                <th></th>
                <th>Nama</th>
                <th>TMT Dinas</th>
                <th>Akhir Masa Dinas</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- PEMEGANG SAHAM END --}}

<!--begin::Modal-->
<div class="modal fade" id="direksiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Direksi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formDireksiStore">
				<div class="modal-body">
					<div class="form-group row">
						<label for="nama_direksi" class="col-3 col-form-label">Nama</label>
						<div class="col-9">
							<input class="form-control" type="text" name="nama_direksi" id="nama_direksi">
						</div>
					</div>

					<div class="form-group row">
						<label for="tmt_dinas" class="col-3 col-form-label">TMT Dinas</label>
						<div class="col-9">
							<input class="form-control datepicker" type="text" name="tmt_dinas" id="tmt_dinas">
						</div>
                    </div>
                    
                    <div class="form-group row">
						<label for="akhir_masa_dinas" class="col-3 col-form-label">Akhir Masa Dinas</label>
						<div class="col-9">
							<input class="form-control datepicker" type="text" name="akhir_masa_dinas" id="akhir_masa_dinas">
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


@section('direksi_script')
{!! JsValidator::formRequest('App\Http\Requests\DireksiStore', '#formDireksiStore') !!}
{!! JsValidator::formRequest('App\Http\Requests\DireksiUpdate', '#formDireksiUpdate') !!}

<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_direksi').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('perusahaan_afiliasi.direksi.index.json', ['perusahaan_afiliasi' => $perusahaan_afiliasi]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'nama', name: 'nama'},
			{data: 'tmt_dinas', name: 'tmt_dinas'},
			{data: 'akhir_masa_dinas', name: 'akhir_masa_dinas'}
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


	$('#addDireksi').click(function(e) {
		e.preventDefault();
		$('#direksiModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$("#formDireksiStore").on('submit', function(){
		if($(this).valid()) {
			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('perusahaan_afiliasi.direksi.store', ['perusahaan_afiliasi' => $perusahaan_afiliasi]) }}";
				swal_title = "Tambah Pemegang Saham";
			} else {
				url = "{{ route('perusahaan_afiliasi.direksi.update', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'direksi' => ':id',
					]) }}";
				url = url
				.replace(':id', $('#title_modal').data('id'));

				swal_title = "Update Pemegang Saham";
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
					$('#direksiModal').modal('toggle');
					// clear form
					$('#direksiModal').on('hidden.bs.modal', function () {
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

	$('#deleteDireksi').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_direksi]').is(':checked')) { 
			$("input[name=radio_direksi]:checked").each(function() {
				var id = $(this).val();
				var nama = $(this).attr('nama');

                var url = "{{ route('perusahaan_afiliasi.direksi.delete', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'direksi' => ':id',
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
					text: "Pemegang Saham : " + nama,
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
									title : 'Hapus Detail Pemegang Saham ' + nama,
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

	

	$('#editDireksi').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_direksi]').is(':checked')) { 
			$("input[name=radio_direksi]:checked").each(function() {
				// get value from row					
				var id = $(this).val();
				var nama = $(this).attr('nama');

                var url = "{{ route('perusahaan_afiliasi.direksi.show.json', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'direksi' => ':id',
					]) }}";
				url = url.replace(':id', id);

				$.ajax({
					url: url,
					type: 'GET',
					success: function (response) {
						console.log(response);
						// update stuff
						// append value
						$('#nama_direksi').val(response.nama);
						$('#kepemilikan').val(response.kepemilikan);
						$('#jumlah_lembar_saham_direksi').val(response.jumlah_lembar_saham);
						
						// title
						$('#title_modal').text('Ubah Pemegang Saham');
						$('#title_modal').data('state', 'update');
						$('#title_modal').data('id', id);
						// open modal
						$('#direksiModal').modal('show');
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