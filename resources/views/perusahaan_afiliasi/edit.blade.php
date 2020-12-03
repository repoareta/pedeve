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
                    Perusahaan Afiliasi 
                </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
                    Ubah
                </span>
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
					Ubah Perusahaan Afiliasi
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<div class="kt-portlet__body">
				<form class="kt-form kt-form--label-right" id="formPerusahaanAfiliasiUpdate" action="{{ route('perusahaan_afiliasi.update', ['perusahaan_afiliasi' => $perusahaan_afiliasi->id]) }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="nama_perusahaan" class="col-2 col-form-label">Nama Perusahaan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ $perusahaan_afiliasi->nama }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="alamat" class="col-2 col-form-label">Alamat</label>
						<div class="col-10">
							<textarea class="form-control" name="alamat" id="alamat">{{ $perusahaan_afiliasi->alamat }}</textarea>
						</div>
                    </div>
                    
					<div class="form-group row">
						<label for="no_telepon" class="col-2 col-form-label">No Telepon</label>
						<div class="col-10">
							<input class="form-control" type="text" name="no_telepon" id="no_telepon" value="{{ $perusahaan_afiliasi->telepon }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="bidang_usaha" class="col-2 col-form-label">Bidang Usaha</label>
						<div class="col-10">
							<input class="form-control" type="text" name="bidang_usaha" id="bidang_usaha" value="{{ $perusahaan_afiliasi->bidang_usaha }}">
						</div>
                    </div>
                    
                    
					<div class="form-group row">
						<label for="modal_dasar" class="col-2 col-form-label">Modal Dasar</label>
						<div class="col-10">
							<input class="form-control" type="number" name="modal_dasar" id="modal_dasar" min="0" value="{{ nominal_abs($perusahaan_afiliasi->modal_dasar) }}">
						</div>
                    </div>

					<div class="form-group row">
						<label for="modal_disetor" class="col-2 col-form-label">Modal Disetor</label>
						<div class="col-10">
							<input class="form-control" type="number" name="modal_disetor" id="modal_disetor" min="0" value="{{ nominal_abs($perusahaan_afiliasi->modal_disetor) }}">
						</div>
                    </div>
                    
                    <div class="form-group row">
						<label for="jumlah_lembar_saham" class="col-2 col-form-label">Jumlah Lembar Saham</label>
						<div class="col-10">
							<input class="form-control" type="number" name="jumlah_lembar_saham" id="jumlah_lembar_saham" min="0" value="{{ $perusahaan_afiliasi->jumlah_lembar_saham }}">
						</div>
                    </div>
                    
                    <div class="form-group row">
						<label for="nilai_nominal_per_saham" class="col-2 col-form-label">Nilai Nominal per Saham</label>
						<div class="col-10">
							<input class="form-control" type="number" name="nilai_nominal_per_saham" id="nilai_nominal_per_saham" min="0" value="{{ nominal_abs($perusahaan_afiliasi->nilai_nominal_per_saham) }}">
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

        @include('perusahaan_afiliasi.pemegang_saham.edit')
        @include('perusahaan_afiliasi.direksi.edit')
        @include('perusahaan_afiliasi.komisaris.edit')
        @include('perusahaan_afiliasi.perizinan.edit')
        @include('perusahaan_afiliasi.akta.edit')

	</div>	
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\PerusahaanAfiliasiUpdate', '#formPerusahaanAfiliasiUpdate') !!}

@yield('pemegang_saham_script')
@yield('direksi_script')
@yield('komisaris_script')
@yield('perizinan_script')
@yield('akta_script')

@endsection