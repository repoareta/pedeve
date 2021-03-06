{{-- PEMEGANG SAHAM START --}}
<div class="kt-portlet__head kt-portlet__head">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon2-chart2"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Pemegang Saham
        </h3>
        
        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addPemegangSaham" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editPemegangSaham" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deletePemegangSaham" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>
    </div>
</div>
<div class="kt-portlet__body">
    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_pemegang_saham">
        <thead class="thead-light">
            <tr>
                <th></th>
                <th>Nama PT</th>
                <th>% Kepemilikan</th>
                <th>Jumlah Lembar Saham</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- PEMEGANG SAHAM END --}}

<!--begin::Modal-->
<div class="modal fade" id="pemegangSahamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Pemegang Saham</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPemegangSahamStore">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-3 col-form-label">Nama</label>
						<div class="col-9">
							<input class="form-control" type="text" name="nama_pemegang_saham" id="nama_pemegang_saham">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-3 col-form-label">% Kepemilikan</label>
						<div class="col-9">
							<input class="form-control" type="number" name="kepemilikan" id="kepemilikan" min="0" max="100">
						</div>
                    </div>
                    
                    <div class="form-group row">
						<label for="spd-input" class="col-3 col-form-label">Jumlah Lembar Saham</label>
						<div class="col-9">
							<input class="form-control" type="number" name="jumlah_lembar_saham_pemegang_saham" id="jumlah_lembar_saham_pemegang_saham" min="0">
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


@section('pemegang_saham_script')
{!! JsValidator::formRequest('App\Http\Requests\PemegangSahamStore', '#formPemegangSahamStore') !!}
{!! JsValidator::formRequest('App\Http\Requests\PemegangSahamUpdate', '#formPemegangSahamUpdate') !!}

<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_pemegang_saham').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('perusahaan_afiliasi.pemegang_saham.index.json', ['perusahaan_afiliasi' => $perusahaan_afiliasi]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'nama', name: 'nama'},
			{data: 'kepemilikan', name: 'kepemilikan'},
			{data: 'jumlah_lembar_saham', name: 'jumlah_lembar_saham'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addPemegangSaham').click(function(e) {
		e.preventDefault();
		$('#pemegangSahamModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$("#formPemegangSahamStore").on('submit', function(){
		if($(this).valid()) {
			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('perusahaan_afiliasi.pemegang_saham.store', ['perusahaan_afiliasi' => $perusahaan_afiliasi]) }}";
				swal_title = "Tambah Pemegang Saham";
			} else {
				url = "{{ route('perusahaan_afiliasi.pemegang_saham.update', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'pemegang_saham' => ':id',
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
					$('#pemegangSahamModal').modal('toggle');
					// clear form
					$('#pemegangSahamModal').on('hidden.bs.modal', function () {
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

	$('#deletePemegangSaham').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_pemegang_saham]').is(':checked')) { 
			$("input[name=radio_pemegang_saham]:checked").each(function() {
				var id = $(this).val();
				var nama = $(this).attr('nama');

                var url = "{{ route('perusahaan_afiliasi.pemegang_saham.delete', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'pemegang_saham' => ':id',
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

	

	$('#editPemegangSaham').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_pemegang_saham]').is(':checked')) { 
			$("input[name=radio_pemegang_saham]:checked").each(function() {
				// get value from row					
				var id = $(this).val();
				var nama = $(this).attr('nama');

                var url = "{{ route('perusahaan_afiliasi.pemegang_saham.show.json', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'pemegang_saham' => ':id',
					]) }}";
				url = url.replace(':id', id);

				$.ajax({
					url: url,
					type: 'GET',
					success: function (response) {
						console.log(response);
						// update stuff
						// append value
						$('#nama_pemegang_saham').val(response.nama);
						$('#kepemilikan').val(response.kepemilikan);
						$('#jumlah_lembar_saham_pemegang_saham').val(response.jumlah_lembar_saham);
						
						// title
						$('#title_modal').text('Ubah Pemegang Saham');
						$('#title_modal').data('state', 'update');
						$('#title_modal').data('id', id);
						// open modal
						$('#pemegangSahamModal').modal('show');
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