{{-- PEMEGANG SAHAM START --}}
<div class="kt-portlet__head kt-portlet__head">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon2-sheet"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Akta
        </h3>
        
        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addAkta" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editAkta" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteAkta" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>
    </div>
</div>
<div class="kt-portlet__body">
    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_akta">
        <thead class="thead-light">
            <tr>
                <th></th>
                <th>Jenis</th>
                <th>Nomor Akta</th>
                <th>Tanggal</th>
                <th>Notaris</th>
                <th>TMT Berlaku</th>
                <th>TMT Berakhir</th>
                <th>Dokumen</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- PEMEGANG SAHAM END --}}

<!--begin::Modal-->
<div class="modal fade" id="aktaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal_akta" data-state="add">Tambah Akta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right formAkta" action="" method="POST" id="formAktaStore">
				<div class="modal-body">
					<div class="form-group row">
						<label for="" class="col-3 col-form-label">Jenis</label>
						<div class="col-9">
							<input class="form-control" type="text" name="jenis_akta" id="jenis_akta">
						</div>
                    </div>
                    
                    <div class="form-group row">
						<label for="" class="col-3 col-form-label">Nomor</label>
						<div class="col-9">
							<input class="form-control" type="text" name="nomor_akta" id="nomor_akta">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="" class="col-3 col-form-label">Tanggal Akta</label>
						<div class="col-9">
							<input class="form-control datepicker" type="text" name="tanggal_akta" id="tanggal_akta" autocomplete="off">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="" class="col-3 col-form-label">Notaris</label>
						<div class="col-9">
							<input class="form-control" type="text" name="notaris" id="notaris">
						</div>
                    </div>
                    
                    <div class="form-group row">
						<label for="" class="col-3 col-form-label">TMT Berlaku</label>
						<div class="col-9">
							<input class="form-control datepicker" type="text" name="tmt_berlaku" id="tmt_berlaku" autocomplete="off">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="" class="col-3 col-form-label">TMT Berakhir</label>
						<div class="col-9">
							<input class="form-control datepicker" type="text" name="tmt_berakhir" id="tmt_berakhir" autocomplete="off">
						</div>
                    </div>

                    <div class="form-group row">
						<label for="" class="col-3 col-form-label">Dokumen Upload</label>
						<div class="col-9">
                            <input type="file" name="dokumen_akta" id="dokumen_akta">
                            <span class="form-text text-muted" id="photo-nya">Tipe dokumen: .pdf</span>
                            <div id="dokumen_akta-nya"></div>
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


@section('akta_script')
{!! JsValidator::formRequest('App\Http\Requests\AktaStore', '#formAktaStore') !!}
{!! JsValidator::formRequest('App\Http\Requests\AktaUpdate', '#formAktaUpdate') !!}

<script type="text/javascript">
	$(document).ready(function () {

	var t = $('#kt_table_akta').DataTable({
		scrollX   : true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('perusahaan_afiliasi.akta.index.json', ['perusahaan_afiliasi' => $perusahaan_afiliasi]) }}",
		columns: [
			{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
			{data: 'jenis', name: 'jenis'},
			{data: 'nomor_akta', name: 'nomor_akta'},
			{data: 'tanggal', name: 'tanggal'},
			{data: 'notaris', name: 'notaris'},
			{data: 'tmt_mulai', name: 'tmt_mulai'},
			{data: 'tmt_akhir', name: 'tmt_akhir'},
			{data: 'dokumen', name: 'dokumen'}
		],
		order: [[ 0, "asc" ], [ 1, "asc" ]]
	});

    // minimum setup
    $('.datepicker').datepicker({
        todayHighlight: true,
        orientation: "bottom left",
        autoclose: true,
        // language : 'id',
        format   : 'yyyy-mm-dd'
    });

	$('#addAkta').click(function(e) {
		e.preventDefault();
		$('#aktaModal').modal('show');
		$('#title_modal_akta').data('state', 'add');
	});

	$("#formAktaStore, #formAktaUpdate").on('submit', function(){

        if ($('#dokumen_akta-error').length){
			$("#dokumen_akta-error").insertAfter("#dokumen_akta-nya");
		}

		if($(this).valid()) {
			var state = $('#title_modal_akta').data('state');

			var url, swal_title;

			if(state == 'add'){
				url = "{{ route('perusahaan_afiliasi.akta.store', ['perusahaan_afiliasi' => $perusahaan_afiliasi]) }}";
				swal_title = "Tambah Akta";
			} else {
				url = "{{ route('perusahaan_afiliasi.akta.update', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'akta' => ':id',
					]) }}";
				url = url
				.replace(':id', $('#title_modal_akta').data('id'));

				swal_title = "Update Akta";
			}

			$.ajax({
				url: url,
				type: "POST",
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
				success: function(dataResult){
					Swal.fire({
						type : 'success',
						title: swal_title,
						text : 'Success',
						timer: 2000
					});
					// close modal
					$('#aktaModal').modal('toggle');
					// clear form
					$('#aktaModal').on('hidden.bs.modal', function () {
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

	$('#deleteAkta').click(function(e) {
		e.preventDefault();
		if($('input[name=radio_akta]').is(':checked')) { 
			$("input[name=radio_akta]:checked").each(function() {
				var id = $(this).val();
				var nama = $(this).attr('nama');

                var url = "{{ route('perusahaan_afiliasi.akta.delete', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'akta' => ':id',
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
					text: "Akta : " + nama,
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
									title : 'Hapus Detail Akta ' + nama,
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

	
	$("#editAkta").on('click', function() {
		// e.preventDefault();

		if($('input[name=radio_akta]').is(':checked')) { 
			$("input[name=radio_akta]:checked").each(function() {
				// get value from row					
				var id = $(this).val();
				var nama = $(this).attr('nama');

                var url = "{{ route('perusahaan_afiliasi.akta.show.json', 
					[
						'perusahaan_afiliasi' => $perusahaan_afiliasi,
						'akta' => ':id',
					]) }}";
				url = url.replace(':id', id);

				$.ajax({
					url: url,
					type: 'GET',
					success: function (response) {
						// update stuff
						// append value
						$('#jenis_akta').val(response.jenis);
						$('#nomor_akta').val(response.nomor_akta);
						$('#tanggal_akta').val(response.tanggal);
						$('#notaris').val(response.notaris);
						$('#tmt_berlaku').val(response.tmt_mulai);
						$('#tmt_berakhir').val(response.tmt_akhir);
						
						// title
						$('#title_modal_akta').text('Ubah Akta ' + response.jenis);
						$('#title_modal_akta').data('state', 'update');
						$('#title_modal_akta').data('id', id);
                        $(".formAkta").attr('id','formAktaUpdate');
						// open modal
						$('#aktaModal').modal('show');
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