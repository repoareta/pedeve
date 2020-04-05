@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Panjar Dinas </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum 
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Anggaran 
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
					Ubah Anggaran
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<div class="kt-portlet__body">
				<form class="kt-form kt-form--label-right" id="formAnggaran" action="{{ route('anggaran.update', ['kode_main' => $kode_main]) }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="kode" class="col-2 col-form-label">Kode Anggaran</label>
						<div class="col-10">
							<input class="form-control" type="text" name="kode" id="kode" value="{{ $anggaran->kode_main }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="nama" class="col-2 col-form-label">Nama Anggaran</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nama" id="nama" value="{{ $anggaran->nama_main }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="tahun" class="col-2 col-form-label">Tahun Anggaran</label>
						<div class="col-10">
							<input class="form-control" type="text" name="tahun" id="tahun" value="{{ $anggaran->tahun }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-2 col-form-label">Nilai Anggaran</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nilai" id="nilai" value="{{ abs($anggaran->nilai_real) }}">
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
{!! JsValidator::formRequest('App\Http\Requests\AnggaranUpdate', '#formAnggaran') !!}
@endsection