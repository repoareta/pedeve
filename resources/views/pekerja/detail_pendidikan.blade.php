<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Pendidikan
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowPendidikan" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowPendidikan" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowPendidikan" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_pendidikan">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Mulai</th>
            <th>Sampai</th>
            <th>Pendidikan</th>
            <th>Tempat Pendidikan</th>
            <th>Nama PT</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="pendidikanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Pendidikan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPekerjaPendidikan">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-3 col-form-label">Tingkat Pendidikan</label>
						<div class="col-9">
							<select class="form-control kt-select2" name="kode_pendidikan_pekerja" id="kode_pendidikan_pekerja" style="width: 100% !important;">
								<option value=""> - Pilih Tingkat Pendidikan - </option>
									@foreach ($pendidikan_list as $pendidikan)
										<option value="{{ $pendidikan->kode }}">{{ $pendidikan->nama }}</option>
									@endforeach
							</select>
							<div id="kode_pendidikan_pekerja-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-3 col-form-label">Jurusan/Program studi</label>
						<div class="col-9">
							<input class="form-control" type="text" name="tempat_didik_pekerja" id="tempat_didik_pekerja">
							<span class="form-text text-muted" id="photo-nya">Isi nama sekolah/institusi jika bukan perguruan tinggi</span>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="spd-input" class="col-3 col-form-label">Nama Lembaga Pendidikan</label>
						<div class="col-9">
							<select class="form-control kt-select2" name="kode_pt_pendidikan_pekerja" id="kode_pt_pendidikan_pekerja" style="width: 100% !important;">
								<option value=""> - Pilih Lembaga Pendidikan - </option>
                                @foreach ($perguruan_tinggi_list as $pt)
                                    <option value="{{ $pt->kode }}">{{ $pt->nama }}</option>
                                @endforeach
							</select>
							<div id="kode_pt_pendidikan_pekerja-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-3 col-form-label">Mulai</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="mulai_pendidikan_pekerja" id="mulai_pendidikan_pekerja">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
                        </div>
                        
                        <label for="spd-input" class="col-1 col-form-label">Sampai</label>
						<div class="col-4">
							<div class="input-group date">
								<input type="text" class="form-control datepicker" readonly="" placeholder="Pilih Tanggal" name="sampai_pendidikan_pekerja" id="sampai_pendidikan_pekerja">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="spd-input" class="col-3 col-form-label">Catatan</label>
						<div class="col-9">
							<input class="form-control" type="text" name="catatan_pendidikan_pekerja" id="catatan_pendidikan_pekerja">
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

@section('detail_pendidikan_script')
{!! JsValidator::formRequest('App\Http\Requests\PekerjaPendidikanStore', '#formPekerjaPendidikan') !!}
<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_pendidikan').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('pekerja.pendidikan.index.json', ['pekerja' => $pekerja->nopeg]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'mulai', name: 'mulai'},
			{data: 'tgllulus', name: 'tgllulus'},
			{data: 'kodedidik', name: 'kodedidik'},
			{data: 'tempatdidik', name: 'tempatdidik'},
			{data: 'namapt', name: 'namapt'},
			{data: 'catatan', name: 'catatan'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});


	$('#addRowPendidikan').click(function(e) {
		e.preventDefault();
		$('#pendidikanModal').modal('show');
		$('#title_modal').data('state', 'add');
	});

	$("#formPekerjaPendidikan").on('submit', function(){
		if ($('#kode_pendidikan_pekerja-error').length){
			$("#kode_pendidikan_pekerja-error").insertAfter("#kode_pendidikan_pekerja-nya");
		}

		if ($('#kode_pt_pendidikan_pekerja-error').length){
			$("#kode_pt_pendidikan_pekerja-error").insertAfter("#kode_pt_pendidikan_pekerja-nya");
		}

		if($(this).valid()) {
			var state = $('#title_modal').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('pekerja.pendidikan.store', ['pekerja' => $pekerja->nopeg]) }}";
				swal_title = "Tambah Detail Pendidikan";
			} else {
				url = "{{ route('pekerja.pendidikan.update', 
					[
						'pekerja'     => $pekerja->nopeg,
						'mulai'       => ':mulai',
						'tempatdidik' => ':tempatdidik',
						'kodedidik'   => ':kodedidik',
					]) }}";
				url = url
				.replace(':mulai', $('#mulai_pendidikan_pekerja').data('mulai'))
				.replace(':tempatdidik', $('#tempat_didik_pekerja').data('tempatdidik'))
				.replace(':kodedidik', $('#kode_pendidikan_pekerja').data('kodedidik'));

				swal_title = "Update Detail Pendidikan";
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
					$('#pendidikanModal').modal('toggle');
					// clear form
					$('#pendidikanModal').on('hidden.bs.modal', function () {
						$(this).find('form').trigger('reset');
						$('#kode_pendidikan_pekerja').val('').trigger('change');
						$('#kode_pt_pendidikan_pekerja').val('').trigger('change');
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

	$('#deleteRowPendidikan').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_pendidikan]').is(':checked')) { 
			$("input[name=radio_pendidikan]:checked").each(function() {
				var nopeg = $(this).val().split('_')[0];
				var mulai = $(this).val().split('_')[1];
				var tempatdidik = $(this).val().split('_')[2];
				var kodedidik = $(this).val().split('_')[3];
				
				const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary',
					cancelButton: 'btn btn-danger'
				},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: "Data yang akan dihapus?",
					text: "Nama : " + tempatdidik,
					type: 'warning',
					showCancelButton: true,
					reverseButtons: true,
					confirmButtonText: 'Ya, hapus',
					cancelButtonText: 'Batalkan'
				})
				.then((result) => {
					if (result.value) {
						$.ajax({
							url: "{{ route('pekerja.pendidikan.delete') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"nopeg"      : "{{ $pekerja->nopeg }}",
								"mulai"      : mulai,
								"tempatdidik": tempatdidik,
								"kodedidik"  : kodedidik,
								"_token"     : "{{ csrf_token() }}",
							},
							success: function () {
								Swal.fire({
									type  : 'success',
									title : 'Hapus Detail Pendidikan ' + tempatdidik,
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

	

	$('#editRowPendidikan').click(function(e) {
		e.preventDefault();

		if($('input[name=radio_pendidikan]').is(':checked')) { 
			$("input[name=radio_pendidikan]:checked").each(function() {
				// get value from row					
				var nopeg = $(this).val().split('_')[0];
				var mulai = $(this).val().split('_')[1];
				var tempatdidik = $(this).val().split('_')[2];
				var kodedidik = $(this).val().split('_')[3];

				$.ajax({
					url: "{{ route('pekerja.pendidikan.show.json') }}",
					type: 'GET',
					data: {
						"nopeg"      : "{{ $pekerja->nopeg }}",
						"mulai"      : mulai,
						"tempatdidik": tempatdidik,
						"kodedidik"  : kodedidik,
						"_token"     : "{{ csrf_token() }}",
					},
					success: function (response) {
						// update stuff
						$('#kode_pendidikan_pekerja').val(response.kodedidik).trigger('change');
						$('#kode_pt_pendidikan_pekerja').val(response.kodept).trigger('change');
						$('#mulai_pendidikan_pekerja').val(response.mulai);
						$('#sampai_pendidikan_pekerja').val(response.tgllulus);
						$('#tempat_didik_pekerja').val(response.tempatdidik);
						$('#catatan_pendidikan_pekerja').val(response.catatan);
						
						// title
						$('#title_modal').text('Ubah Detail Pendidikan');
						$('#title_modal').data('state', 'update');
						// for url update
						$('#mulai_pendidikan_pekerja').data('mulai', response.mulai);
						$('#tempat_didik_pekerja').data('tempatdidik', response.tempatdidik);
						$('#kode_pendidikan_pekerja').data('kodedidik', response.kodedidik);
						// open modal
						$('#pendidikanModal').modal('show');
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