@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Master Data </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					SDM & Payroll 
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kode Jabatan 
				</a>
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
					Tambah Kode Jabatan
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<div class="kt-portlet__body">
				<form class="kt-form kt-form--label-right" id="formKodeJabatan" action="{{ route('kode_jabatan.store') }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="kode" class="col-2 col-form-label">Kode Bagian</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="kode_bagian" id="kode_bagian">
								<option value="">- Pilih Kode Bagian -</option>
								@foreach ($kode_bagian_list as $kode_bagian)
									<option value="{{ $kode_bagian->kode }}">{{ $kode_bagian->kode.' - '.$kode_bagian->nama }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="kode" class="col-2 col-form-label">Kode Jabatan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="kode_jabatan" id="kode_jabatan">
						</div>
					</div>

					<div class="form-group row">
						<label for="nama" class="col-2 col-form-label">Nama</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nama" id="nama">
						</div>
					</div>

					<div class="form-group row">
						<label for="nama" class="col-2 col-form-label">Golongan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="golongan" id="golongan">
						</div>
					</div>

					<div class="form-group row">
						<label for="nama" class="col-2 col-form-label">Tunjangan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="tunjangan" id="tunjangan">
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
{!! JsValidator::formRequest('App\Http\Requests\KodeJabatanStore', '#formKodeJabatan') !!}

<script type="text/javascript">
	$(document).ready(function () {
		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});
	});
</script>
@endsection