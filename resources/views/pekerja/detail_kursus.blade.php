<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Kursus
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowKursus" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowKursus" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowKursus" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_kursus">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Nama</th>
            <th>Mulai</th>
            <th>Sampai</th>
            <th>Penyelenggara</th>
            <th>Kota</th>
            <th>Negara</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="kursusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Kursus</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formKursus" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nama Kursus</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nama_kursus" id="nama_kursus">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Penyelenggara</label>
						<div class="col-10">
							<input class="form-control" type="text" name="penyelenggara_kursus" id="penyelenggara_kursus">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Mulai</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="mulai_kursus" id="mulai_kursus">
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
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="sampai_kursus" id="sampai_kursus">
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
							<input class="form-control" type="text" name="negara_kursus" id="negara_kursus" value="INDONESIA">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Kota</label>
						<div class="col-10">
							<input class="form-control" type="text" name="kota_kursus" id="kota_kursus">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Keterangan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="keterangan_kursus" id="keterangan_kursus">
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

@section('detail_kursus_script')
{!! JsValidator::formRequest('App\Http\Requests\KursusStore', '#formKursus') !!}
<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_kursus').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.kursus.index.json', ['pekerja' => $pekerja->nopeg]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'nama', name: 'nama'},
			{data: 'mulai', name: 'mulai'},
			{data: 'sampai', name: 'sampai'},
			{data: 'penyelenggara', name: 'penyelenggara'},
			{data: 'kota', name: 'kota'},
			{data: 'negara', name: 'negara'},
			{data: 'keterangan', name: 'keterangan'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowKursus').click(function(e) {
		e.preventDefault();
		$('#kursusModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$("#formKursus").on('submit', function(){
		if($(this).valid()) {

			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.kursus.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Kursus";
			} else {
				url = "{{ route('pekerja.kursus.update', 
					[
						'pekerja' => $pekerja->nopeg,
						'mulai' => ':mulai',
						'nama' => ':nama'
					]) }}";
				url = url
				.replace(':mulai', $('#mulai_kursus').data('mulai'))
				.replace(':nama', $('#nama_kursus').data('nama'));

				swal_title = "Update Detail Kursus";
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
					$('#kursusModal').modal('toggle');
					// clear form
					$('#kursusModal').on('hidden.bs.modal', function () {
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

	$('#deleteRowKursus').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_kursus]').is(':checked')) { 
			$("input[name=radio_kursus]:checked").each(function() {
				var nopeg = $(this).val().split('_')[0];
				var mulai = $(this).val().split('_')[1];
				var nama = $(this).val().split('_')[2];
				
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
							url: "{{ route('pekerja.kursus.delete') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"nopeg": "{{ $pekerja->nopeg }}",
								"mulai": mulai,
								"nama": nama,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail Kursus ' + nama,
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

	

	$('#editRowKursus').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_kursus]').is(':checked')) { 
			$("input[name=radio_kursus]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('_')[0];
				var mulai = $(this).val().split('_')[1];
				var nama = $(this).val().split('_')[2];

				$.ajax({
					url: "{{ route('pekerja.kursus.show.json') }}",
					type: 'GET',
					data: {
						"nopeg" : "{{ $pekerja->nopeg }}",
						"mulai" : mulai,
						"nama" : nama,
						"_token": "{{ csrf_token() }}",
					},
					success: function (response) {						
						$('#mulai_kursus').val(response.mulai);
						$('#sampai_kursus').val(response.sampai);
						$('#nama_kursus').val(response.nama);
						$('#penyelenggara_kursus').val(response.penyelenggara);
						$('#kota_kursus').val(response.kota);
						$('#negara_kursus').val(response.negara);
						$('#keterangan_kursus').val(response.keterangan);
						
						// title
						$('#title_modal').text('Ubah Detail Kursus');
						$('#title_modal').data('state', 'update');
						// for url update
						$('#mulai_kursus').data('mulai', response.mulai);
						$('#nama_kursus').data('nama', response.nama);
						// open modal
						$('#kursusModal').modal('show');
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