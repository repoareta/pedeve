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
	</div>	
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\PerusahaanAfiliasiStore', '#formPerusahaanAfiliasiStore') !!}

<script type="text/javascript">
	$(document).ready(function () {

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
	});
</script>
@endsection