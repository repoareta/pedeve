<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Upah Tetap Pensiun
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowUpahTetapPensiun" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowUpahTetapPensiun" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowUpahTetapPensiun" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_upah_tetap_pensiun">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Upah Pensiun</th>
            <th>Mulai</th>
            <th>Sampai</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="upahTetapPensiunModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Upah Tetap Pensiun</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formUpahTetapPensiun">
				<div class="modal-body">
					<div class="form-group row">
						<label for="" class="col-2 col-form-label">Upah Tetap Pensiun</label>
						<div class="col-10">
							<input class="form-control" type="number" name="nilai_upah_tetap_pensiun" id="nilai_upah_tetap_pensiun">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="" class="col-2 col-form-label">Mulai</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="mulai_upah_tetap_pensiun" id="mulai_upah_tetap_pensiun">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
                        </div>
                        
                        <label for="" class="col-2 col-form-label">Sampai</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="sampai_upah_tetap_pensiun" id="sampai_upah_tetap_pensiun">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
						</div>
                    </div>

                    <div class="form-group row">
						<label for="" class="col-2 col-form-label">Keterangan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="keterangan_upah_tetap_pensiun" id="keterangan_upah_tetap_pensiun">
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

@section('detail_upah_tetap_pensiun_script')
{!! JsValidator::formRequest('App\Http\Requests\UpahTetapPensiunStore', '#formUpahTetapPensiun') !!}

<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_upah_tetap_pensiun').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.upah_tetap_pensiun.index.json', ['pekerja' => $pekerja->nopeg]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'ut', name: 'ut'},
			{data: 'mulai', name: 'mulai'},
			{data: 'sampai', name: 'sampai'},
			{data: 'keterangan', name: 'keterangan'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowUpahTetapPensiun').click(function(e) {
		e.preventDefault();
		$('#upahTetapPensiunModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$("#formUpahTetapPensiun").on('submit', function(){
		if($(this).valid()) {
			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.upah_tetap_pensiun.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Upah Tetap";
			} else {
				url = "{{ route('pekerja.upah_tetap_pensiun.update', 
					[
						'pekerja' => $pekerja->nopeg,
						'nilai' => ':nilai',
					]) }}";
				url = url
				.replace(':nilai', $('#nilai_upah_tetap').data('nilai'));

				swal_title = "Update Detail Upah Tetap";
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
					$('#upahTetapPensiunModal').modal('toggle');
					// clear form
					$('#upahTetapPensiunModal').on('hidden.bs.modal', function () {
						$(this).find('form').trigger('reset');
						$('#status_upah_tetap').val('').trigger('change');
						$('#agama_upah_tetap').val('').trigger('change');
						$('#pendidikan_upah_tetap').val('').trigger('change');
						$('#golongan_darah_upah_tetap').val('').trigger('change');
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

	$('#deleteRowUpahTetapPensiun').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_upah_tetap]').is(':checked')) { 
			$("input[name=radio_upah_tetap]:checked").each(function() {
				var nopeg = $(this).val().split('-')[0];
				var ut = $(this).val().split('-')[1];
				
				const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary',
					cancelButton: 'btn btn-danger'
				},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: "Data yang akan dihapus?",
					text: "Upah Tetap : " + ut,
					type: 'warning',
					showCancelButton: true,
					reverseButtons: true,
					confirmButtonText: 'Ya, hapus',
					cancelButtonText: 'Batalkan'
				})
				.then((result) => {
					if (result.value) {
						$.ajax({
							url: "{{ route('pekerja.upah_tetap_pensiun.delete') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"nopeg": nopeg,
								"ut": ut,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail Upah Tetap ' + ut,
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

	

	$('#editRowUpahTetapPensiun').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_upah_tetap]').is(':checked')) { 
			$("input[name=radio_upah_tetap]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('-')[0];
				var ut = $(this).val().split('-')[1];

				$.ajax({
					url: "{{ route('pekerja.upah_tetap_pensiun.show.json') }}",
					type: 'GET',
					data: {
						"nopeg" : "{{ $pekerja->nopeg }}",
						"ut"    : ut,
						"_token": "{{ csrf_token() }}",
					},
					success: function (response) {
						console.log(response);
						// update stuff
						// append value						
						$('#nilai_upah_tetap').val(response.ut);
						$('#mulai_upah_tetap').val(response.mulai);
						$('#sampai_upah_tetap').val(response.sampai);
						$('#keterangan_upah_tetap').val(response.keterangan);
						
						// title
						$('#title_modal').text('Ubah Detail Upah Tetap');
						$('#title_modal').data('state', 'update');
						// for url update
						$('#nilai_upah_tetap').data('nilai', response.ut);
						// open modal
						$('#upahTetapPensiunModal').modal('show');
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