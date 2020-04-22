<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Seminar
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowSeminar" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowSeminar" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowSeminar" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_seminar">
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
<div class="modal fade" id="seminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Seminar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formSeminar" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nama</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nama_seminar" id="nama_seminar">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Mulai</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="mulai_seminar" id="mulai_seminar">
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
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="sampai_seminar" id="sampai_seminar">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Penyelenggara</label>
						<div class="col-10">
							<input class="form-control" type="text" name="penyelenggara_seminar" id="penyelenggara_seminar">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Kota</label>
						<div class="col-10">
							<input class="form-control" type="text" name="kota_seminar" id="kota_seminar">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Negara</label>
						<div class="col-10">
							<input class="form-control" type="text" name="negara_seminar" id="negara_seminar">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Keterangan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="keterangan_seminar" id="keterangan_seminar">
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

@section('detail_seminar_script')
{!! JsValidator::formRequest('App\Http\Requests\SeminarStore', '#formSeminar') !!}
<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_seminar').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.seminar.index.json', ['pekerja' => $pekerja->nopeg]) }}",
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


	$('#addRowSeminar').click(function(e) {
		e.preventDefault();
		$('#seminarModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$("#formSeminar").on('submit', function(){
		if($(this).valid()) {
			var state = $('#title_modal').data('state');
			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.seminar.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Seminar";
			} else {
				url = "{{ route('pekerja.seminar.update', 
					[
						'pekerja' => $pekerja->nopeg,
						'mulai' => ':mulai',
					]) }}";
				url = url
				.replace(':mulai', $('#mulai_seminar').data('mulai'));

				swal_title = "Update Detail Seminar";
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
					$('#seminarModal').modal('toggle');
					// clear form
					$('#seminarModal').on('hidden.bs.modal', function () {
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

	$('#deleteRowSeminar').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_seminar]').is(':checked')) { 
			$("input[name=radio_seminar]:checked").each(function() {
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
							url: "{{ route('pekerja.seminar.delete') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"nopeg": "{{ $pekerja->nopeg }}",
								"mulai": mulai,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail Seminar ' + nama,
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

	

	$('#editRowSeminar').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_seminar]').is(':checked')) { 
			$("input[name=radio_seminar]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('_')[0];
				var mulai = $(this).val().split('_')[1];
				var nama = $(this).val().split('_')[2];

				$.ajax({
					url: "{{ route('pekerja.seminar.show.json') }}",
					type: 'GET',
					data: {
						"nopeg" : "{{ $pekerja->nopeg }}",
						"mulai" : mulai,
						"_token": "{{ csrf_token() }}",
					},
					success: function (response) {
						console.log(response);
						// update stuff
						$('#nama_seminar').val(response.nama);
						$('#mulai_seminar').val(response.mulai);
						$('#sampai_seminar').val(response.sampai);
						$('#penyelenggara_seminar').val(response.penyelenggara);
						$('#kota_seminar').val(response.kota);
						$('#negara_seminar').val(response.negara);
						$('#keterangan_seminar').val(response.keterangan);
						
						// title
						$('#title_modal').text('Ubah Detail Seminar');
						$('#title_modal').data('state', 'update');
						// for url update
						$('#mulai_seminar').data('mulai', response.mulai);
						// open modal
						$('#seminarModal').modal('show');
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