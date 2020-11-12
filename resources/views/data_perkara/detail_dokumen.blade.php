<!-- <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_jabatan">
	@foreach($data_list as $data)
		<tr >
			<td style="" align="center"><embed width="960" height="450" src="{{asset('data_perkara/'.$data->file)}}" type="application/pdf"></embed></td>
		</tr>
	@endforeach
</table> -->

<div class="kt-portlet__head" style="padding-left:0px; border-bottom: none;">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon-users-1"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Dokumen Perkara
        </h3>

        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <span class="kt-font-success pointer-link" id="adddokumen" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-plus-circle"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deletedokumen" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>		
    </div>
</div>

<table class="table table-striped table-bordered table-hover table-checkable" id="dokumen">
    <thead class="thead-light">
        <tr>
			<th></th>
            <th>Nama Dokumen</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--begin::Modal-->
<div class="modal fade" id="dokumenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal_jabatan" data-state="add">Tambah Dokumen Perkara</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right"  id="form-create-dokumen" enctype="multipart/form-data">
				@foreach($data_list as $data)
					<input class="form-control" type="hidden" value="{{$data->no_perkara}}"  name="no_perkara">
				@endforeach
				<div class="modal-body">
					<div class="form-group row">
						<label for="" class="col-2 col-form-label">Dokumen Perkara</label>
						<div class="col-8">
							<div class="input-group control-group after-add-more">
									<input type="file" name="filedok[]" class="form-control" title="Dokumen" accept=".pdf,.jpg,.jpeg">
								<div class="input-group-btn"> 
									<button class="btn btn-primary add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
								</div>
							</div>
							@if(count($errors) > 0)
								@foreach ($errors->all() as $error)
								<span style="color:red;">Frotmat harus pdf, jpeg, jpg dan png</span>
								@endforeach
							@else
								<span>Frotmat file pdf, jpeg, jpg dan png</span>
							@endif
						</div>
					</div>
					<div style="display:none;">
						<div class="copy hide">
							<div class="control-group input-group" style="margin-top:10px;">
									<input type="file" name="filedok[]" class="form-control" title="Dokumen" accept=".pdf,.jpg,.jpeg">
								<div class="input-group-btn"> 
									<button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
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

@section('detail_dokumen_script')
<script type="text/javascript">
	$(document).ready(function () {
		var t = $('#dokumen').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			searching: true,
			lengthChange: true,
			language: {
				processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax: "{{ route('data_perkara.search.dokumen', ['no_perkara' => $data->no_perkara]) }}",
			columns: [
				{data: 'radio', name: 'radio'},
				{data: 'nama', name: 'nama'},
				{data: 'file', name: 'file'},
			]
		});
		$('#dokumen tbody').on( 'click', 'tr', function (event) {
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
			} else {
				t.$('tr.selected').removeClass('selected');
				// $(':radio', this).trigger('click');
				if (event.target.type !== 'radio') {
					$(':radio', this).trigger('click');
				}
				$(this).addClass('selected');
			}
		} );

		$('#reload-dokumen').click(function(e) {
			e.preventDefault();
			t.ajax.reload();
		});
		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});

		$(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
		});
		$("body").on("click",".remove",function(){ 
			$(this).parents(".control-group").remove();
		});

		$('#adddokumen').click(function(e) {
			e.preventDefault();
			$('#form-create-dokumen').trigger('reset');
			$('#cek').trigger('reset');
			$('#cek').val('B');
			$('#dokumenModal').modal('show');
			$('#title_modal_jabatan').data('state', 'add');
		});
		$('#form-create-dokumen').submit(function(){
			let formData = new FormData($('#form-create-dokumen')[0]);
			let file = $('input[type=file]')[0].files[0];
			formData.append('file', file, file.name);
			$.ajax({
				url  : "{{route('data_perkara.store.dokumen')}}",
				type : "POST",
				data : formData,
				dataType : "JSON",  
				cache: false,
				contentType: false,
				processData: false,
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
						Swal.fire({
							type : 'success',
							title: "Berhasil di tambah",
							text : 'Success',
						});
						$('#dokumenModal').modal('toggle');
						// clear form
						$('#dokumenModal').on('hidden.bs.modal', function () {
							$('#status_dokumen').trigger('reset');
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

		$("#status_dokumen").on("change", function(){
			var status = $('#status_dokumen').val();
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

		$('#editdokumen').click(function(e) {
		e.preventDefault();

			if($('input[name=btn-radio]').is(':checked')) { 
				$("input[name=btn-radio]:checked").each(function() {
					// get value from row					
					var kd = $(this).attr('data-id');
					$('#cek').trigger('reset');
					$('#cek').val('A');


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
							$('#status_dokumen').val(data.status).trigger('change');
							var status = $('#status_dokumen').val();
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
							$('#dokumenModal').modal('show');
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
		$('#deletedokumen').click(function(e) {
			e.preventDefault();
			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function() {
					var kd_dok = $(this).attr('data-id');
					var filed= $(this).attr('file-id');
					var noperkara= $(this).attr('no-perkara');
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
							text: "Dengan Kode : " + kd_dok,
							type: 'warning',
							showCancelButton: true,
							reverseButtons: true,
							confirmButtonText: 'Ya, hapus',
							cancelButtonText: 'Batalkan'
						})
						.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('data_perkara.delete.dokumen') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"kd_dok": kd_dok,
									"filed": filed,
									"noperkara": noperkara,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : 'Hapus Kode ' + kd_dok,
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
