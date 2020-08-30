@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Customer Management </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perusahaan Afiliasi </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Tambah</span>
			</div>
		</div>
	</div>
</div>
<!-- end:: Subheader -->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-plus-1"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Tambah Perusahaan Afiliasi
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<div class="kt-portlet__body">
				<form class="kt-form kt-form--label-right" id="formPerusahaanAfiliasiStore" action="{{ route('perusahaan_afiliasi.store') }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="nama_perusahaan" class="col-2 col-form-label">Nama Perusahaan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nama_perusahaan" id="nama_perusahaan">
						</div>
					</div>

					<div class="form-group row">
						<label for="alamat" class="col-2 col-form-label">Alamat</label>
						<div class="col-10">
							<textarea class="form-control" name="alamat" id="alamat"></textarea>
						</div>
                    </div>
                    
					<div class="form-group row">
						<label for="no_telepon" class="col-2 col-form-label">No Telepon</label>
						<div class="col-10">
							<input class="form-control" type="text" name="no_telepon" id="no_telepon">
						</div>
					</div>

					<div class="form-group row">
						<label for="bidang_usaha" class="col-2 col-form-label">Bidang Usaha</label>
						<div class="col-10">
							<input class="form-control" type="text" name="bidang_usaha" id="bidang_usaha">
						</div>
                    </div>
                    
                    
					<div class="form-group row">
						<label for="modal_dasar" class="col-2 col-form-label">Modal Dasar</label>
						<div class="col-10">
							<input class="form-control" type="number" name="modal_dasar" id="modal_dasar" value="0" min="0">
						</div>
                    </div>

					<div class="form-group row">
						<label for="modal_disetor" class="col-2 col-form-label">Modal Disetor</label>
						<div class="col-10">
							<input class="form-control" type="number" name="modal_disetor" id="modal_disetor" value="0" min="0">
						</div>
                    </div>
                    
                    <div class="form-group row">
						<label for="jumlah_lembar_saham" class="col-2 col-form-label">Jumlah Lembar Saham</label>
						<div class="col-10">
							<input class="form-control" type="number" name="jumlah_lembar_saham" id="jumlah_lembar_saham" value="0" min="0">
						</div>
                    </div>
                    
                    <div class="form-group row">
						<label for="nilai_nominal_per_saham" class="col-2 col-form-label">Nilai Nominal per Saham</label>
						<div class="col-10">
							<input class="form-control" type="number" name="nilai_nominal_per_saham" id="nilai_nominal_per_saham" value="0" min="0">
						</div>
					</div>

					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<a  href="{{ url()->previous() }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
							</div>
						</div>
					</div>
				</form>
		</div>
        {{-- END BODY --}}

        {{-- @include('perusahaan_afiliasi.pemegang_saham.create')
        @include('perusahaan_afiliasi.direksi.create')
        @include('perusahaan_afiliasi.komisaris.create')
        @include('perusahaan_afiliasi.perizinan.create')
        @include('perusahaan_afiliasi.akta.create') --}}
	</div>	
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\PerusahaanAfiliasiStore', '#formPerusahaanAfiliasiStore') !!}

<script type="text/javascript">

	function refreshTable() {
		var table = $('#kt_table').DataTable();
		table.clear();
		table.ajax.url("{{ route('perjalanan_dinas.detail.index.json') }}").load(function() {
			// Callback loads updated row count into a DOM element
			// (a Bootstrap badge on a menu item in this case):
			var rowCount = table.rows().count();
			$('#no_urut').val(rowCount + 1);
		});
	}

	$(document).ready(function () {

		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});

		var t = $('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('perjalanan_dinas.detail.index.json') }}",
			columns: [
				{data: 'action', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'no', name: 'no'},
				{data: 'nopek', name: 'nopek'},
				{data: 'nama', name: 'nama'},
				{data: 'golongan', name: 'golongan'},
				{data: 'jabatan', name: 'jabatan'},
				{data: 'keterangan', name: 'keterangan'}
			],
			order: [[ 0, "asc" ], [ 1, "asc" ]]
		});

	
		$('#openDetail').click(function(e) {
			e.preventDefault();
			refreshTable();
			$('#kt_modal_4').modal('show');
			$('#title_modal').data('state', 'add');
		});

		$("#formPerusahaanAfiliasiStore").on('submit', function(e){
			e.preventDefault();

			if($(this).valid()) {
			const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-primary',
				cancelButton: 'btn btn-danger'
			},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: "Ingin melanjutkan isi detail perusahaan afiliasi?",
				text: "",
				type: 'warning',
				showCancelButton: true,
				reverseButtons: true,
				confirmButtonText: 'Ya, Lanjut Isi Detail Perusahaan Afiliasi',
				cancelButtonText: 'Tidak'
			})
			.then((result) => {
				if (result.value) {
					$(this).append('<input type="hidden" name="url" value="edit" />');
					$(this).unbind('submit').submit();
				}
				else if (result.dismiss === Swal.DismissReason.cancel) {
					$(this).append('<input type="hidden" name="url" value="perusahaan_afiliasi.index" />');
					$(this).unbind('submit').submit();
				}
			});
		}
		});

		$("#formPanjarDinasDetail").on('submit', function(){
			if ($('#nopek_detail-error').length){
				$("#nopek_detail-error").insertAfter("#nopek_detail-nya");
			}

			if ($('#jabatan_detail-error').length){
				$("#jabatan_detail-error").insertAfter("#jabatan_detail-nya");
			}

			if($(this).valid()) {
				// do your ajax stuff here
				var no = $('#no_urut').val();
				var keterangan = $('#keterangan_detail').val();
				var nopek = $('#nopek_detail').val().split('-')[0];
				var nama = $('#nopek_detail').val().split('-')[1];
				var jabatan = $('#jabatan_detail').val();
				var golongan = $('#golongan_detail').val();

				var state = $('#title_modal').data('state');

				var url, session, swal_title;

				if(state == 'add'){
					url = "{{ route('perjalanan_dinas.detail.store') }}";
					session = true;
					swal_title = "Tambah Detail Panjar";
				} else {
					url = "{{ route('perjalanan_dinas.detail.update', [
						'no_panjar' => 'null',
						'no_urut' => ':no_urut',
						'nopek' => ':nopek'
					]) }}";

					url = url
						.replace(':no_urut', $('#no_urut').data('no_urut'))
						.replace(':nopek', $('#nopek_detail').data('nopek_detail'));
					session = true;
					swal_title = "Update Detail Panjar";
				}

				$.ajax({
					url: url,
					type: "POST",
					data: {
						no: no,
						keterangan: keterangan,
						nopek: nopek,
						nama: nama,
						jabatan: jabatan,				
						golongan: golongan,
						session: session,
						_token:"{{ csrf_token() }}"		
					},
					success: function(dataResult){
						Swal.fire({
							type : 'success',
							title: swal_title,
							text : 'Success',
							timer: 2000
						});
						// close modal
						$('#kt_modal_4').modal('toggle');
						// clear form
						$('#kt_modal_4').on('hidden.bs.modal', function () {
							$(this).find('form').trigger('reset');
							$('#nopek_detail').val('').trigger('change');
							$('#jabatan_detail').val('').trigger('change');
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

		$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var no_nopek = $(this).val();
					
					const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-primary',
						cancelButton: 'btn btn-danger'
					},
						buttonsStyling: false
					})

					swalWithBootstrapButtons.fire({
						title: "Data yang akan dihapus?",
						text: "Nopek : " + no_nopek,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('perjalanan_dinas.detail.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"no_nopek": no_nopek,
									"session": true,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : 'Hapus Detail Panjar ' + no_nopek,
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

		$('#editRow').click(function(e) {
			e.preventDefault();

			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					// get value from row					
					var no_urut = $(this).val().split('-')[0];
					var no_nopek = $(this).val().split('-')[1];
					$.ajax({
						url: "{{ route('perjalanan_dinas.detail.show.json') }}",
						type: 'GET',
						data: {
							"no_urut": no_urut,
							"no_nopek": no_nopek,
							"session": true,
							"_token": "{{ csrf_token() }}",
						},
						success: function (response) {
							// update stuff
							// append value
							$('#no_urut').val(response.no);
							$('#keterangan_detail').val(response.keterangan);
							$('#nopek_detail').val(response.nopek + '-' + response.nama).trigger('change');
							$('#jabatan_detail').val(response.jabatan).trigger('change');
							$('#golongan_detail').val(response.status);
							// title
							$('#title_modal').text('Ubah Detail Panjar Dinas');
							$('#title_modal').data('state', 'update');
							$('#no_urut').data('no_urut', response.no);
							$('#nopek_detail').data('nopek_detail', response.nopek);
							// open modal
							$('#kt_modal_4').modal('toggle');
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