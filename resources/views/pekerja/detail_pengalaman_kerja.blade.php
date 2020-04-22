<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Pengalaman Kerja
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowPengalamanKerja" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowPengalamanKerja" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowPengalamanKerja" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_pengalaman_kerja">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Mulai</th>
            <th>Sampai</th>
            <th>Instansi</th>
            <th>Pangkat</th>
            <th>Kota</th>
            <th>Negara</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="pengalamanKerjaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Pengalaman Kerja</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPengalamanKerja">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Instansi</label>
						<div class="col-10">
							<input class="form-control" type="text" name="instansi_pengalaman_kerja" id="instansi_pengalaman_kerja">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Status</label>
						<div class="col-10">
							<input class="form-control" type="text" name="status_pengalaman_kerja" id="status_pengalaman_kerja">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Pangkat</label>
						<div class="col-10">
							<input class="form-control" type="text" name="pangkat_pengalaman_kerja" id="pangkat_pengalaman_kerja">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Mulai</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="mulai_pengalaman_kerja" id="mulai_pengalaman_kerja">
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
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="sampai_pengalaman_kerja" id="sampai_pengalaman_kerja">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Negara</label>
						<div class="col-10">
							<input class="form-control" type="text" name="negara_pengalaman_kerja" id="negara_pengalaman_kerja" value="INDONESIA">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Kota</label>
						<div class="col-10">
							<input class="form-control" type="text" name="kota_pengalaman_kerja" id="kota_pengalaman_kerja">
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

@section('detail_pengalaman_kerja_script')
{!! JsValidator::formRequest('App\Http\Requests\PengalamanKerjaStore', '#formPengalamanKerja') !!}
<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_pengalaman_kerja').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.pengalaman_kerja.index.json', ['pekerja' => $pekerja->nopeg]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'mulai', name: 'mulai'},
			{data: 'sampai', name: 'sampai'},
			{data: 'instansi', name: 'instansi'},
			{data: 'pangkat', name: 'pangkat'},
			{data: 'kota', name: 'kota'},
			{data: 'negara', name: 'negara'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowPengalamanKerja').click(function(e) {
		e.preventDefault();
		$('#pengalamanKerjaModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$("#formPengalamanKerja").on('submit', function(){
		if($(this).valid()) {
			// do your ajax stuff here
			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.pengalaman_kerja.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Pengalaman Kerja";
			} else {
				url = "{{ route('pekerja.pengalaman_kerja.update', 
					[
						'pekerja' => $pekerja->nopeg,
						'mulai'   => ':mulai',
						'pangkat' => ':pangkat'
					]) }}";
				url = url
				.replace(':mulai', $('#mulai_pengalaman_kerja').data('mulai'))
				.replace(':pangkat', $('#pangkat_pengalaman_kerja').data('pangkat'));

				swal_title = "Update Detail Pengalaman Kerja";
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
					$('#pengalamanKerjaModal').modal('toggle');
					// clear form
					$('#pengalamanKerjaModal').on('hidden.bs.modal', function () {
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

	$('#deleteRowPengalamanKerja').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_pengalaman_kerja]').is(':checked')) { 
			$("input[name=radio_pengalaman_kerja]:checked").each(function() {
				var nopeg = $(this).val().split('_')[0];
				var mulai = $(this).val().split('_')[1];
				var pangkat = $(this).val().split('_')[2];
				
				const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary',
					cancelButton: 'btn btn-danger'
				},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: "Data yang akan dihapus?",
					text: "Nama Pangkat : " + pangkat,
					type: 'warning',
					showCancelButton: true,
					reverseButtons: true,
					confirmButtonText: 'Ya, hapus',
					cancelButtonText: 'Batalkan'
				})
				.then((result) => {
					if (result.value) {
						$.ajax({
							url: "{{ route('pekerja.pengalaman_kerja.delete') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"nopeg": "{{ $pekerja->nopeg }}",
								"mulai": mulai,
								"pangkat": pangkat,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail Pengalaman Kerja ' + pangkat,
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

	

	$('#editRowPengalamanKerja').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_pengalaman_kerja]').is(':checked')) { 
			$("input[name=radio_pengalaman_kerja]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('_')[0];
				var mulai = $(this).val().split('_')[1];
				var pangkat = $(this).val().split('_')[2];

				$.ajax({
					url: "{{ route('pekerja.pengalaman_kerja.show.json') }}",
					type: 'GET',
					data: {
						"nopeg" : "{{ $pekerja->nopeg }}",
						"mulai" : mulai,
						"pangkat" : pangkat,
						"_token": "{{ csrf_token() }}",
					},
					success: function (response) {
						$('#mulai_pengalaman_kerja').val(response.mulai);
						$('#sampai_pengalaman_kerja').val(response.sampai);
						$('#status_pengalaman_kerja').val(response.status);
						$('#instansi_pengalaman_kerja').val(response.instansi);
						$('#pangkat_pengalaman_kerja').val(response.pangkat);
						$('#kota_pengalaman_kerja').val(response.kota);
						$('#negara_pengalaman_kerja').val(response.negara);
						
						// title
						$('#title_modal').text('Ubah Detail Pengalaman Kerja');
						$('#title_modal').data('state', 'update');
						// for url update
						$('#mulai_pengalaman_kerja').data('mulai', response.mulai);
						$('#pangkat_pengalaman_kerja').data('pangkat', response.pangkat);
						// open modal
						$('#pengalamanKerjaModal').modal('show');
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