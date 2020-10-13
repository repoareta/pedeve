<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Kuasa Hukum
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="addRowhakim" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-warning pointer-link" id="editRowhakim" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRowhakim" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="hakim">
    <thead class="thead-light">
        <tr>
			<th></th>
            <th>Nama Pihak</th>
            <th>Nama Kuasa Hukum</th>
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
<div class="modal fade" id="hakimModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal_hakim" data-state="add"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right"  id="form-create-hakim" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Nama</label>
						<div class="col-10">
							<input class="form-control" type="text"  name="nama" id="nama_hakim" size="100" maxlength="100" autocomplete='off'>
							<input class="form-control" type="hidden" value=""  name="kd_hakim" id="kd_hakim">
							<input class="form-control" type="hidden" value=""  name="cekhakim" id="cekhakim">
							@foreach($data_list as $data)
							<input class="form-control" type="hidden" value="{{$data->no_perkara}}"  name="no_perkara" id="no_perkara_hakim">
							@endforeach
						</div>
					</div>
                    
                    <div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Alamat</label>
						<div class="col-10">
							<textarea class="form-control" type="text"  name="alamat" id="alamat_hakim" size="100" maxlength="100" autocomplete='off'></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Telp</label>
						<div class="col-10">
							<input class="form-control" type="text" name="telp" id="telp_hakim" onkeypress="return hanyaAngka(event)" autocomplete='off' autocomplete='off'>
						</div>
                    </div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Keterangan</label>
						<div class="col-10">
							<textarea class="form-control" type="text" name="keterangan" id="keterangan_hakim" autocomplete='off'></textarea>
						</div>
                    </div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Status</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="status" id="status_hakim" style="width: 100% !important;" required oninvalid="this.setCustomValidity('Status Harus Diisi...')" onchange="setCustomValidity('')">
								<option value=""> - Pilih - </option>
								<option value="1">Penggugat</option>
								<option value="2">Tergugat</option>
								<option value="3">Turut Tergugat</option>
                               
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Pihak</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="kd_pihak" id="pihak_hakim" style="width: 100% !important;" required oninvalid="this.setCustomValidity('Pihak Harus Diisi...')" onchange="setCustomValidity('')">
								<option value=""> - Pilih - </option>
                               
							</select>
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

@section('detail_hakim_script')
<script type="text/javascript">
	$(document).ready(function () {
		var t = $('#hakim').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			searching: true,
			lengthChange: true,
			language: {
				processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax: "{{ route('data_perkara.search.hakim', ['no_perkara' => $data->no_perkara]) }}",
			columns: [
				{data: 'radio', name: 'radio'},
				{data: 'nama_p', name: 'nama_p'},
				{data: 'nama', name: 'nama'},
				{data: 'alamat', name: 'alamat'},
				{data: 'telp', name: 'telp'},
				{data: 'keterangan', name: 'keterangan'},
				{data: 'status', name: 'status'},
			]
		});

		$('#reload-hakim').click(function(e) {
			e.preventDefault();
			t.ajax.reload();
		});
		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});

		$('#addRowhakim').click(function(e) {
			e.preventDefault();
			$('#form-create-hakim').trigger('reset');
			$('#cekhakim').trigger('reset');
			$('#cekhakim').val('B');
			$('#title_modal_hakim').text('Tambah Kuasa Hukum');
			$('#hakimModal').modal('show');
			$('#title_modal_hakim').data('state', 'add');
		});
		$('#form-create-hakim').submit(function(){
			$.ajax({
				url  : "{{route('data_perkara.store.hakim')}}",
				type : "POST",
				data : $('#form-create-hakim').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
					if(data == 1){
						Swal.fire({
							type : 'success',
							title: "Berhasil di ubah",
							text : 'Success',
							timer: 2000
						});
						$('#hakimModal').modal('toggle');
						// clear form
						$('#hakimModal').on('hidden.bs.modal', function () {
							$('#status_hakim').trigger('reset');
						});
						// append to datatable
						t.ajax.reload();
					}else if(data == 2){
						Swal.fire({
							type : 'success',
							title: "Berhasil di tambah",
							text : 'Success',
							timer: 2000
						});
						$('#hakimModal').modal('toggle');
						// clear form
						$('#hakimModal').on('hidden.bs.modal', function () {
							$('#status_hakim').trigger('reset');
						});
						// append to datatable
						t.ajax.reload();
					}else{
						$('#hakimModal').modal('toggle');
						$('#hakimModal').on('hidden.bs.modal', function () {
							$('#status_hakim').trigger('reset');
							$('#status_hakim').val("").trigger('change');
						});
						Swal.fire({
							type  : 'info',
							title : 'Duplikasi data dokumen, entri dibatalkan.',
							text  : 'Info',
						});
					}
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});

		$("#status_hakim").on("change", function(){
			var status = $('#status_hakim').val();
			var no_perkara = $('#no_perkara_hakim').val();
			$.ajax({
				url : "{{route('data_perkara.pihakJson')}}",
				type : "POST",
				dataType: 'json',
				data : {
					status:status,
					no_perkara:no_perkara
					},
				headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
					},
				success : function(data){
							var html = '';
							var i;
							html += '<option value="">- Pilih - </option>';
							for(i=0; i<data.length; i++){
								html += '<option value="'+data[i].kd_pihak+'">'+data[i].nama+'</option>';
							}
							$('#pihak_hakim').html(html);		
				},
				error : function(){
					alert("Ada kesalahan controller!");
				}
			})
        });

		$('#editRowhakim').click(function(e) {
		e.preventDefault();

			if($('input[name=btn-radio]').is(':checked')) { 
				$("input[name=btn-radio]:checked").each(function() {
					// get value from row					
					var kd = $(this).attr('data-id');
					$('#cekhakim').trigger('reset');
					$('#cekhakim').val('A');
					$('#title_modal_hakim').text('Ubah Kuasa Hukum');
					$('#title_modal_hakim').data('state', 'update');


					$.ajax({
						url: "{{ route('data_perkara.show.json') }}",
						type: 'POST',
						dataType: 'json',
						data: {
							"kd" : kd,
							"_token": "{{ csrf_token() }}",
						},
						success: function (data) {
							$('#kd_hakim').val(data.kd_hakim);
							$('#nama_hakim').val(data.nama);
							$('#alamat_hakim').val(data.alamat);
							$('#telp_hakim').val(data.telp);
							$('#keterangan_hakim').val(data.keterangan);
							$('#no_perkara').val(data.no_perkara);
							$('#status_hakim').val(data.status).trigger('change');
							var status = $('#status_hakim').val();
							var no_perkara = $('#no_perkara_hakim').val();
							$.ajax({
								url : "{{route('data_perkara.pihakJson')}}",
								type : "POST",
								dataType: 'json',
								data : {
									status:status,
									no_perkara:no_perkara
									},
								headers: {
									'X-CSRF-Token': '{{ csrf_token() }}',
									},
								success : function(data){
											var html = '1';
											var i;
											for(i=0; i<data.length; i++){
												html += '<option value="'+data[i].kd_pihak+'">'+data[i].nama+'</option>';
											}
											$('#pihak_hakim').html(html);		
								},
								error : function(){
									alert("Ada kesalahan controller!");
								}
							})
							// open modal
							$('#hakimModal').modal('show');
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
		$('#deleteRowhakim').click(function(e) {
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
								url: "{{ route('data_perkara.delete.hakim') }}",
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