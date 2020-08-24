<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Pihak
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowpihak" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowpihak" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table width="100%" class="table table-striped table-bordered table-hover table-checkable" id="pihak">
    <thead class="thead-light">
        <tr>
			<th></th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Telp</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="pihakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal_jabatan" data-state="add">Tambah pihak</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="form-create" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nama</label>
						<div class="col-10">
							<input class="form-control" type="text"  name="nama" id="nama_pihak" size="100" maxlength="100" autocomplete='off'>
							<input class="form-control" type="hidden"  name="kd_pihak" id="kd_pihak">
							@foreach($data_list as $data)
							<input class="form-control" type="hidden" value="{{$data->no_perkara}}"  name="no_perkara" id="no_perkara">
							@endforeach
							<div id="bagian_pekerja-nya"></div>
						</div>
					</div>
                    
                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Alamat</label>
						<div class="col-10">
							<textarea class="form-control" type="text"  name="alamat" id="alamat_pihak" size="100" maxlength="100" autocomplete='off'></textarea>
							<div id="jabatan_pekerja-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Telp</label>
						<div class="col-10">
							<input class="form-control" type="text" name="telp" id="telp_pihak" onkeypress="return hanyaAngka(event)" autocomplete='off'>
						</div>
                    </div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Keterangan</label>
						<div class="col-10">
							<textarea class="form-control" type="text" name="keterangan" id="keterangan_pihak" autocomplete='off'></textarea>
						</div>
                    </div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Status</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="status" id="status_pihak" style="width: 100% !important;">
								<option value=""> - Pilih - </option>
								<option value="1">Penggugat</option>
								<option value="2">Tergugat</option>
								<option value="3">Turut Tergugat</option>
                               
							</select>
						</div>
					</div>

					<div class="form-group row">
							<label for="" class="col-2 col-form-label">Menggunakan Kuasa Hukum</label>
							<div class="col-8">
								<div class="kt-radio-inline">
									<label class="kt-radio kt-radio--solid">
										<input value="1" type="radio"  name="kuasa" id="kuasa" onclick="displayResult(1)" checked> Ya
										<span></span>
									</label>
									<label class="kt-radio kt-radio--solid">
										<input value="2" type="radio"    name="kuasa" id="kuasa" onclick="displayResult(2)"> Tidak
										<span></span>
									</label>
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

@section('detail_pihak_script')
<script type="text/javascript">
	$(document).ready(function () {
		var t = $('#pihak').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			searching: true,
			lengthChange: true,
			language: {
				processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax: "{{ route('data_perkara.search.pihak', ['no_perkara' => $data->no_perkara]) }}",
			columns: [
				{data: 'radio', name: 'radio'},
				{data: 'nama', name: 'nama'},
				{data: 'alamat', name: 'alamat'},
				{data: 'telp', name: 'telp'},
				{data: 'keterangan', name: 'keterangan'},
				{data: 'status', name: 'status'},
			]
		});

		$('#reload-pihak').click(function(e) {
			e.preventDefault();
			t.ajax.reload();
		});

		$('#addRowpihak').click(function(e) {
			e.preventDefault();
			$('#form-create').trigger('reset');
			$('#cek').trigger('reset');
			$('#cek').val('B');
			$('#pihakModal').modal('show');
			$('#title_modal_jabatan').data('state', 'add');
		});
		$('#form-create').submit(function(){
			$.ajax({
				url  : "{{route('data_perkara.store.pihak')}}",
				type : "POST",
				data : $('#form-create').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
					Swal.fire({
							type : 'success',
							title: "swal_title",
							text : 'Success',
							timer: 2000
						});
						$('#pihakModal').modal('toggle');
						// clear form
						$('#pihakModal').on('hidden.bs.modal', function () {
							$(this).find('form').trigger('reset');
						});
						// append to datatable
						t.ajax.reload();
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});

		$('#editRowpihak').click(function(e) {
		e.preventDefault();

			if($('input[name=btn-radio]').is(':checked')) { 
				$("input[name=btn-radio]:checked").each(function() {
					// get value from row					
					var kd = $(this).attr('data-id');
					$('#cek').trigger('reset');
					$('#cek').val('A');

					$.ajax({
						url: "{{ route('data_perkara.show.pihak.json') }}",
						type: 'POST',
						dataType: 'json',
						data: {
							"kd" : kd,
							"_token": "{{ csrf_token() }}",
						},
						success: function (data) {
							$('#kd_pihak').val(data.kd_pihak);
							$('#nama_pihak').val(data.nama);
							$('#alamat_pihak').val(data.alamat);
							$('#telp_pihak').val(data.telp);
							$('#keterangan_pihak').val(data.keterangan);
							$('#no_perkara').val(data.no_perkara);
							$('#status_pihak').val(data.status).trigger('change');
							
							// open modal
							$('#pihakModal').modal('show');
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

		//delete vendor
		$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function() {
					var id = $(this).attr('data-id');
					// delete stuff
					const swalWithBootstrapButtons = Swal.mixin({
						customClass: {
							confirmButton: 'btn btn-primary',
							cancelButton: 'btn btn-danger'
						},
							buttonsStyling: false
						})
						swalWithBootstrapButtons.fire({
							title: "Data yang akan dihapus?",
							text: "Dengan Kode : " + id,
							type: 'warning',
							showCancelButton: true,
							reverseButtons: true,
							confirmButtonText: 'Ya, hapus',
							cancelButtonText: 'Batalkan'
						})
						.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('data_perkara.delete.pihak') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"id": id,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : 'Hapus Kode ' + id,
										text  : 'Berhasil',
										timer : 2000
									});
									t.ajax.reload();

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
});
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>
@endsection