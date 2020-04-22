<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            SMK
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowSMK" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowSMK" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowSMK" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_smk">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Tahun</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="smkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail SMK</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formSMK" enctype="multipart/form-data">
				<div class="modal-body">
                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Tahun</label>
						<div class="col-10">
							<input class="form-control" type="text" readonly name="tahun_smk" id="tahun_smk" value="{{ date('Y') }}">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nilai</label>
						<div class="col-10">
							<input class="form-control" type="number" name="nilai_smk" id="nilai_smk">
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

@section('detail_smk_script')
{!! JsValidator::formRequest('App\Http\Requests\SMKStore', '#formSMK') !!}
<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_smk').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.smk.index.json', ['pekerja' => $pekerja->nopeg]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'tahun', name: 'tahun'},
			{data: 'nilai', name: 'nilai'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowSMK').click(function(e) {
		e.preventDefault();
		$('#smkModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$("#formSMK").on('submit', function(){
		if($(this).valid()) {
			// do your ajax stuff here
			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.smk.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail SMK";
			} else {
				url = "{{ route('pekerja.smk.update', 
					[
						'pekerja' => $pekerja->nopeg,
						'tahun' => ':tahun',
					]) }}";
				url = url
				.replace(':tahun', $('#tahun_smk').data('tahun'));

				swal_title = "Update Detail SMK";
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
					$('#smkModal').modal('toggle');
					// clear form
					$('#smkModal').on('hidden.bs.modal', function () {
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

	$('#deleteRowSMK').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_smk]').is(':checked')) { 
			$("input[name=radio_smk]:checked").each(function() {
				var nopeg = $(this).val().split('-')[0];
				var tahun = $(this).val().split('-')[1];
				
				const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary',
					cancelButton: 'btn btn-danger'
				},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: "Data yang akan dihapus?",
					text: "SMK Tahun : " + tahun,
					type: 'warning',
					showCancelButton: true,
					reverseButtons: true,
					confirmButtonText: 'Ya, hapus',
					cancelButtonText: 'Batalkan'
				})
				.then((result) => {
					if (result.value) {
						$.ajax({
							url: "{{ route('pekerja.smk.delete') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"nopeg": "{{ $pekerja->nopeg }}",
								"tahun": tahun,
								"_token": "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail SMK ' + tahun,
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

	

	$('#editRowSMK').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_smk]').is(':checked')) { 
			$("input[name=radio_smk]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('-')[0];
				var tahun = $(this).val().split('-')[1];

				$.ajax({
					url: "{{ route('pekerja.smk.show.json') }}",
					type: 'GET',
					data: {
						"nopeg" : "{{ $pekerja->nopeg }}",
						"tahun" : tahun,
						"_token": "{{ csrf_token() }}",
					},
					success: function (response) {
						console.log(response);
						// update stuff						
						$('#tahun_smk').val(response.tahun);
						$('#nilai_smk').val(response.nilai);
						
						// title
						$('#title_modal').text('Ubah Detail SMK');
						$('#title_modal').data('state', 'update');
						// for url update
						$('#tahun_smk').data('tahun', response.tahun);
						// open modal
						$('#smkModal').modal('show');
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