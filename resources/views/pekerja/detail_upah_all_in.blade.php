<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Upah All In
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowUpahAllIn" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowUpahAllIn" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowUpahAllIn" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_upah_all_in">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Nilai</th>
            <th>Mulai</th>
            <th>Sampai</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="upahAllInModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title title_modal" data-state="add">Tambah Detail Upah All In</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formUpahAllIn" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nilai</label>
						<div class="col-10">
							<input class="form-control" type="number" name="nilai_upah_all_in" id="nilai_upah_all_in">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Mulai</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="mulai_upah_all_in" id="mulai_upah_all_in">
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
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="sampai_upah_all_in" id="sampai_upah_all_in">
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

@section('detail_upah_all_in_script')
{!! JsValidator::formRequest('App\Http\Requests\UPahAllInStore', '#formUpahAllIn') !!}
<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_upah_all_in').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.upah_all_in.index.json', ['pekerja' => $pekerja->nopeg]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'nilai', name: 'nilai'},
			{data: 'mulai', name: 'mulai'},
			{data: 'sampai', name: 'sampai'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowUpahAllIn').click(function(e) {
		e.preventDefault();
		$('#upahAllInModal').modal('show');
		$('.title_modal').data('state', 'add');
	});

	$("#formUpahAllIn").on('submit', function(){
		if($(this).valid()) {
			// do your ajax stuff here
			var state = $('.title_modal').data('state');
			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.upah_all_in.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Upah All In";
			} else {
				url = "{{ route('pekerja.upah_all_in.update', 
					[
						'pekerja' => $pekerja->nopeg,
						'nilai' => ':nilai'
					]) }}";
				url = url
				.replace(':nilai', $('#nilai_upah_all_in').data('nilai'));

				swal_title = "Update Detail Upah All In";
			}

			$.ajax({
				url: url,
				type: "POST",
				headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				data: $(this).serializeArray(),
				success: function(response){
					Swal.fire({
						type : 'success',
						title: swal_title,
						text : 'Success',
						timer: 2000
					});
					// close modal
					$('#upahAllInModal').modal('toggle');
					// clear form
					$('#upahAllInModal').on('hidden.bs.modal', function () {
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

	$('#deleteRowUpahAllIn').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_upah_all_in]').is(':checked')) { 
			$("input[name=radio_upah_all_in]:checked").each(function() {
				var nopeg = $(this).val().split('-')[0];
				var nilai = $(this).val().split('-')[1];
				
				const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary',
					cancelButton: 'btn btn-danger'
				},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: "Data yang akan dihapus?",
					text: "Nilai : " + nilai,
					type: 'warning',
					showCancelButton: true,
					reverseButtons: true,
					confirmButtonText: 'Ya, hapus',
					cancelButtonText: 'Batalkan'
				})
				.then((result) => {
					if (result.value) {
						$.ajax({
							url: "{{ route('pekerja.upah_all_in.delete') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"nopeg": nopeg,
								"nilai": nilai,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail Upah All In ' + nilai,
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

	

	$('#editRowUpahAllIn').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_upah_all_in]').is(':checked')) { 
			$("input[name=radio_upah_all_in]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('-')[0];
				var nilai = $(this).val().split('-')[1];

				$.ajax({
					url: "{{ route('pekerja.upah_all_in.show.json') }}",
					type: 'GET',
					data: {
						"nopeg" : "{{ $pekerja->nopeg }}",
						"nilai" : nilai,
						"_token": "{{ csrf_token() }}",
					},
					success: function (response) {
						console.log(response);
						$('#nilai_upah_all_in').val(response.nilai);
						$('#mulai_upah_all_in').val(response.mulai_date);
						$('#sampai_upah_all_in').val(response.sampai_date);
						// title
						$('.title_modal').text('Ubah Detail Upah All In');
						$('.title_modal').data('state', 'update');
						// for url update
						$('#nilai_upah_all_in').data('nilai', response.nilai);
						// open modal
						$('#upahAllInModal').modal('show');
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