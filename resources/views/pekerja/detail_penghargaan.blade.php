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
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Penghargaan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPenghargaan" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label" style="padding-right: 0px;">Nama Penghargaan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nama_penghargaan" id="nama_penghargaan">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Pemberi</label>
						<div class="col-10">
							<input class="form-control" type="text" name="pemberi_penghargaan" id="pemberi_penghargaan">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Tanggal</label>
						<div class="col-10">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="tanggal_penghargaan" id="tanggal_penghargaan">
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
{!! JsValidator::formRequest('App\Http\Requests\PenghargaanStore', '#formPenghargaan') !!}
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

	$("#formPenghargaan").on('submit', function(){
		if($(this).valid()) {
			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.penghargaan.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Penghargaan";
			} else {
				url = "{{ route('pekerja.penghargaan.update', 
					[
						'pekerja' => $pekerja->nopeg,
						'tanggal' => ':tanggal',
						'nama' => ':nama',
					]) }}";
				url = url
				.replace(':tanggal', $('#tanggal_penghargaan').data('tanggal'))
				.replace(':nama', $('#nama_penghargaan').data('nama'));

				swal_title = "Update Detail Penghargaan";
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
					$('#penghargaanModal').modal('toggle');
					// clear form
					$('#penghargaanModal').on('hidden.bs.modal', function () {
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

	$('#deleteRowPenghargaan').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_penghargaan]').is(':checked')) { 
			$("input[name=radio_penghargaan]:checked").each(function() {
				var nopeg = $(this).val().split('_')[0];
				var tanggal = $(this).val().split('_')[1];
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
					text: "Nama Penghargaan: " + nama,
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
								"nopeg": "{{ $pekerja->nopeg }}",
								"tanggal": tanggal,
								"nama": nama,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail Penghargaan ' + nama,
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
				var nopeg = $(this).val().split('_')[0];
				var tanggal = $(this).val().split('_')[1];
				var nama = $(this).val().split('_')[2];

				$.ajax({
					url: "{{ route('pekerja.penghargaan.show.json') }}",
					type: 'GET',
					data: {
						"nopeg"  : "{{ $pekerja->nopeg }}",
						"tanggal": tanggal,
						"nama"   : nama,
						"_token" : "{{ csrf_token() }}",
					},
					success: function (response) {
						$('#tanggal_penghargaan').val(response.tanggal);
						$('#nama_penghargaan').val(response.nama);
						$('#pemberi_penghargaan').val(response.pemberi);
						// title
						$('#title_modal').text('Ubah Detail Penghargaan');
						$('#title_modal').data('state', 'update');
						// for url update
						$('#nama_penghargaan').data('nama', response.nama);
						$('#tanggal_penghargaan').data('tanggal', response.tanggal);
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