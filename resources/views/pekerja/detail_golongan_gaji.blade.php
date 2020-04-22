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
			{data: 'golgaji', name: 'golgaji'},
			{data: 'tanggal', name: 'tanggal'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowGolonganGaji').click(function(e) {
		e.preventDefault();
		$('#golonganGajiModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$("#formGolonganGaji").on('submit', function(){
		if($(this).valid()) {
			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.golongan_gaji.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Golongan Gaji";
			} else {
				url = "{{ route('pekerja.golongan_gaji.update', 
					[
						'pekerja' => $pekerja->nopeg,
						'golongan_gaji' => ':golongan_gaji',
						'tanggal' => ':tanggal'
					]) }}";
				url = url
				.replace(':golongan_gaji', $('#golongan_gaji').data('golongan_gaji'))
				.replace(':tanggal', $('#tanggal_golongan_gaji').data('tanggal'));

				swal_title = "Update Detail Golongan Gaji";
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
					$('#golonganGajiModal').modal('toggle');
					// clear form
					$('#golonganGajiModal').on('hidden.bs.modal', function () {
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

	$('#deleteRowGolonganGaji').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_golongan_gaji]').is(':checked')) { 
			$("input[name=radio_golongan_gaji]:checked").each(function() {
				var nopeg = $(this).val().split('_')[0];
				var golongan_gaji = $(this).val().split('_')[1];
				var tanggal = $(this).val().split('_')[2];
				
				const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary',
					cancelButton: 'btn btn-danger'
				},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: "Data yang akan dihapus?",
					text: "Nama Golongan Gaji: " + golongan_gaji,
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
								"golongan_gaji": golongan_gaji,
								"tanggal": tanggal,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail Golongan Gaji ' + golongan_gaji,
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

		if($('input[name=radio_golongan_gaji]').is(':checked')) { 
			$("input[name=radio_golongan_gaji]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('_')[0];
				var golongan_gaji = $(this).val().split('_')[1];
				var tanggal = $(this).val().split('_')[2];

				$.ajax({
					url: "{{ route('pekerja.golongan_gaji.show.json') }}",
					type: 'GET',
					data: {
						"nopeg" : "{{ $pekerja->nopeg }}",
						"golongan_gaji" : golongan_gaji,
						"tanggal" : tanggal,
						"_token": "{{ csrf_token() }}",
					},
					success: function (response) {
						
						$('#golongan_gaji').val(response.golgaji);
						$('#tanggal_golongan_gaji').val(response.tanggal);
						
						// title
						$('#title_modal').text('Ubah Detail Golongan Gaji');
						$('#title_modal').data('state', 'update');

						// for url update
						$('#golongan_gaji').data('golongan_gaji', response.golgaji);
						$('#tanggal_golongan_gaji').data('tanggal', response.tanggal);
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