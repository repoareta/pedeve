@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Master Pekerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					SDM & Payroll 
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Pekerja </a>
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
					Tambah Pekerja
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>		
		<div class="kt-portlet__body">
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form class="kt-form kt-form--label-right" id="formPekerja" action="{{ route('pekerja.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-lg-5">
						<div class="form-group row">
							<label for="kode" class="col-4 col-form-label">Nomor Pegawai</label>
							<div class="col-8">
								<input class="form-control" type="text" name="nomor" id="nomor">
							</div>
						</div>
		
						<div class="form-group row">
							<label for="nama" class="col-4 col-form-label">Bagian</label>
							<div class="col-8">
								<select class="form-control kt-select2" name="bagian" id="bagian">
									<option value=""> - Pilih Bagian- </option>
									@foreach ($kode_bagian_list as $kode_bagian)
										<option value="{{ $kode_bagian->kode }}">{{ $kode_bagian->kode.' - '.$kode_bagian->nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
		
						<div class="form-group row">
							<label for="tahun" class="col-4 col-form-label">Status</label>
							<div class="col-8">
								<select class="form-control kt-select2" name="status" id="status">
									<option value=""> - Pilih Status- </option>
									<option value="K">Aktif</option>
									<option value="K">Kontrak</option>
									<option value="P">Pensiun</option>
								</select>
								<div id="status-nya"></div>
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">Jabatan</label>
							<div class="col-8">
								<select class="form-control kt-select2" name="jabatan" id="jabatan">
									<option value=""> - Pilih Jabatan- </option>
									@foreach ($kode_jabatan_list as $kode_jabatan)
										<option value="{{ $kode_jabatan->kdjab }}">{{ $kode_jabatan->kdjab.' - '.$kode_jabatan->keterangan }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="" class="col-4 col-form-label">Golongan</label>
							<div class="col-8">
								<input class="form-control" type="text" name="golongan" id="golongan" readonly>
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">Tgl Aktif Dinas</label>
							<div class="col-8">
								<div class="input-group date">
									<input type="text" class="form-control" readonly="" placeholder="Pilih Tanggal Aktif Dinas" name="tanggal_aktif_dinas" id="tanggal_aktif_dinas">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar-check-o"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">No. YDP</label>
							<div class="col-8">
								<input class="form-control" type="text" name="no_ydp" id="no_ydp">
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">NPWP</label>
							<div class="col-8">
								<input class="form-control" type="text" name="npwp" id="npwp">
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">No. Astek</label>
							<div class="col-8">
								<input class="form-control" type="text" name="no_astek" id="no_astek">
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">Gelar</label>
							<div class="col-8">
								<select class="form-control kt-select2" name="gelar_1" id="gelar_1">
									<option value="">- Pilih Gelar -</option>
									@foreach ($pendidikan_list as $pendidikan)
										<option value="{{ $pendidikan->kode }}">{{ $pendidikan->nama }}</option>
									@endforeach
								</select>
								<div id="gelar_1-nya"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-4 col-form-label"></label>
							<div class="col-8">
								<select class="form-control kt-select2" name="gelar_2" id="gelar_2">
									<option value="">- Pilih Gelar -</option>
									@foreach ($pendidikan_list as $pendidikan)
										<option value="{{ $pendidikan->kode }}">{{ $pendidikan->nama }}</option>
									@endforeach
								</select>
								<div id="gelar_2-nya"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-4 col-form-label"></label>
							<div class="col-8">
								<select class="form-control kt-select2" name="gelar_3" id="gelar_3">
									<option value="">- Pilih Gelar -</option>
									@foreach ($pendidikan_list as $pendidikan)
										<option value="{{ $pendidikan->kode }}">{{ $pendidikan->nama }}</option>
									@endforeach
								</select>
								<div id="gelar_3-nya"></div>
							</div>
						</div>
					</div>
	
					<div class="col-lg-5">
						<div class="form-group row">
							<label for="kode" class="col-4 col-form-label">Nama Pegawai</label>
							<div class="col-8">
								<input class="form-control" type="text" name="nama" id="nama">
							</div>
						</div>
		
						<div class="form-group row">
							<label for="nama" class="col-4 col-form-label">Tempat Lahir</label>
							<div class="col-8">
								<input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir">
							</div>
						</div>

						<div class="form-group row">
							<label for="nama" class="col-4 col-form-label">Tanggal Lahir</label>
							<div class="col-8">
								<div class="input-group date">
									<input type="text" class="form-control" readonly="" placeholder="Pilih Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar-check-o"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
		
						<div class="form-group row">
							<label for="tahun" class="col-4 col-form-label">Provinsi Lahir</label>
							<div class="col-8">
								<select class="form-control kt-select2" name="provinsi" id="provinsi">
									<option value=""> - Pilih Provinsi- </option>
									@foreach ($provinsi_list as $provinsi)
										<option value="{{ $provinsi->kode }}">{{ $provinsi->nama }}</option>
									@endforeach
								</select>
								<div id="provinsi-nya"></div>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">Agama</label>
							<div class="col-8">
								<select class="form-control kt-select2" name="agama" id="agama">
									<option value=""> - Pilih Agama- </option>
									@foreach ($agama_list as $agama)
										<option value="{{ $agama->kode }}">{{ $agama->nama }}</option>
									@endforeach
								</select>
								<div id="agama-nya"></div>
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">Jenis Kelamin</label>
							<div class="col-8">
								<div class="kt-radio-inline">
									<label class="kt-radio kt-radio--solid">
										<input type="radio" name="jenis_kelamin" checked value="L"> Laki-laki
										<span></span>
									</label>
									<label class="kt-radio kt-radio--solid">
										<input type="radio" name="jenis_kelamin" value="P"> Perempuan
										<span></span>
									</label>
								</div>
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">Golongan Darah</label>
							<div class="col-8">
								<select class="form-control kt-select2" name="golongan_darah" id="golongan_darah">
									<option value=""> - Pilih Golongan Darah- </option>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="AB">AB</option>
									<option value="O">O</option>
								</select>
								<div id="golongan_darah-nya"></div>
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">Kode Keluarga</label>
							<div class="col-8">
								<input class="form-control" type="text" name="kode_keluarga" id="kode_keluarga">
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">Alamat</label>
							<div class="col-8">
								<input class="form-control" placeholder="Alamat 1" type="text" name="alamat_1" id="alamat_1">
							</div>
						</div>

						<div class="form-group row">
							<label for="" class="col-4 col-form-label"></label>
							<div class="col-8">
								<input class="form-control" placeholder="Alamat 2" type="text" name="alamat_2" id="alamat_2">
							</div>
						</div>

						<div class="form-group row">
							<label for="" class="col-4 col-form-label"></label>
							<div class="col-8">
								<input class="form-control" placeholder="Alamat 3" type="text" name="alamat_3" id="alamat_3">
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">No. Handphone</label>
							<div class="col-8">
								<input class="form-control" type="text" name="no_handphone" id="no_handphone">
							</div>
						</div>
		
						<div class="form-group row">
							<label for="" class="col-4 col-form-label">No. Telepon</label>
							<div class="col-8">
								<input class="form-control" type="text" name="no_telepon" id="no_telepon">
							</div>
						</div>
					</div>

					<div class="col-lg-2">
						<div class="kt-avatar" id="kt_user_avatar_2">
							<div class="kt-avatar__holder" style="background-image: url(assets/media/users/default.jpg)"></div>
							<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Ubah foto">
								<i class="fa fa-pen"></i>
								<input type="file" name="photo" accept=".png, .jpg, .jpeg">
							</label>
							<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Hapus foto">
								<i class="fa fa-times"></i>
							</span>
						</div>
						<span class="form-text text-muted" id="photo-nya">Tipe berkas: .png, .jpg, jpeg.</span>
					</div>
				</div>

				<div class="kt-form__actions">
					<div class="col-lg-5">
						<div class="row">
							<div class="col-4"></div>
							<div class="col-8">
								<a  href="{{ url()->previous() }}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		{{-- END BODY --}}		
	</div>	
</div>


@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\PekerjaStore', '#formPekerja') !!}

<script>
$(document).ready(function () {
	$('.kt-select2').select2().on('change', function() {
		$(this).valid();
	});

	// minimum setup
	$('#tanggal_aktif_dinas, #tanggal_lahir').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'yyyy-mm-dd'
	});

	// Class definition
	var KTAvatarDemo = function () {
		// Private functions
		var initDemos = function () {
			var avatar1 = new KTAvatar('kt_user_avatar_1');
			var avatar2 = new KTAvatar('kt_user_avatar_2');
			var avatar3 = new KTAvatar('kt_user_avatar_3');
			var avatar4 = new KTAvatar('kt_user_avatar_4');
		}

		return {
			// public functions
			init: function() {
				initDemos();
			}
		};
	}();

	KTUtil.ready(function() {
		KTAvatarDemo.init();
	});

	$('#gelar_1, #gelar_2, #gelar_3').select2().on('change', function() {
		if ($('#gelar_1-error').length){
			$("#gelar_1-error").insertAfter("#gelar_1-nya");
		} else {
			$(this).valid();
		}

		if ($('#gelar_2-error').length){
			$("#gelar_2-error").insertAfter("#gelar_2-nya");
		} else {
			$(this).valid();
		}
		
		if ($('#gelar_3-error').length){
			$("#gelar_3-error").insertAfter("#gelar_3-nya");
		} else {
			$(this).valid();
		}
	});


	$("#formPekerja").on('submit', function(e){
		e.preventDefault();

		if ($('#status-error').length){
			$("#status-error").insertAfter("#status-nya");
		}

		if ($('#provinsi-error').length){
			$("#provinsi-error").insertAfter("#provinsi-nya");
		}

		if ($('#agama-error').length){
			$("#agama-error").insertAfter("#agama-nya");
		}

		if ($('#golongan_darah-error').length){
			$("#golongan_darah-error").insertAfter("#golongan_darah-nya");
		}

		if ($('#gelar_1-error').length){
			$("#gelar_1-error").insertAfter("#gelar_1-nya");
		}
		
		if ($('#gelar_2-error').length){
			$("#gelar_2-error").insertAfter("#gelar_2-nya");
		}
		
		if ($('#gelar_3-error').length){
			$("#gelar_3-error").insertAfter("#gelar_3-nya");
		}

		if ($('#photo-error').length){
			$("#photo-error").insertAfter("#photo-nya");
		}

		if($(this).valid()) {
			const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-primary',
				cancelButton: 'btn btn-danger'
			},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: "Ingin melanjutkan isi detail pegawai?",
				text: "",
				type: 'warning',
				showCancelButton: true,
				reverseButtons: true,
				confirmButtonText: 'Ya, Lanjut Isi Detail Pegawai',
				cancelButtonText: 'Tidak'
			})
			.then((result) => {
				if (result.value) {
					$(this).append('<input type="hidden" name="url" value="edit" />');
					$(this).unbind('submit').submit();
				}
				else if (result.dismiss === Swal.DismissReason.cancel) {
					$(this).append('<input type="hidden" name="url" value="pekerja.index" />');
					$(this).unbind('submit').submit();
				}
			});
		}
	});

});
</script>
@endsection