@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Implementasi GCG </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Gratifikasi
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Pemberian</span>
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
					Pemberian Hadiah/Cindera Mata dan Hiburan (Entertaiment)
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<div class="kt-portlet__body">
				<form class="kt-form kt-form--label-right" id="formPemberian" action="{{ route('gcg.gratifikasi.pemberian.store') }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="pemberian_bulan_lalu" class="col-3 col-form-label">Tidak ada pemberian bulan lalu</label>
						<div class="col-9">
							<div class="kt-checkbox-inline">
								<label class="kt-checkbox kt-checkbox--brand">
									<input type="checkbox" name="pemberian_bulan_lalu" value="1"> *Klik pada kotak jika tidak ada pemberian untuk periode bulan lalu
									<span></span>
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="tanggal_pemberian" class="col-3 col-form-label">Tanggal Pemberian</label>
						<div class="col-9">
							<input class="form-control" type="text" name="tanggal_pemberian" id="tanggal_pemberian">
						</div>
					</div>

					<div class="form-group row">
						<label for="bentuk_jenis_pemberian" class="col-3 col-form-label">Bentuk/Jenis yang diberikan</label>
						<div class="col-9">
							<input class="form-control" type="text" name="bentuk_jenis_pemberian" id="bentuk_jenis_pemberian">
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-3 col-form-label">Nilai Pemberian</label>
						<div class="col-9">
							<input class="form-control" type="text" name="nilai" id="nilai">
						</div>
					</div>

					<div class="form-group row">
						<label for="jumlah" class="col-3 col-form-label">Jumlah yang diberikan</label>
						<div class="col-9">
							<input class="form-control" type="text" name="jumlah" id="jumlah">
						</div>
					</div>

					<div class="form-group row">
						<label for="penerima_hadiah" class="col-3 col-form-label">Penerima Hadiah</label>
						<div class="col-9">
							<input class="form-control" type="text" name="penerima_hadiah" id="penerima_hadiah">
						</div>
					</div>

					<div class="form-group row">
						<label for="keterangan" class="col-3 col-form-label">Keterangan</label>
						<div class="col-9">
							<input class="form-control" type="text" name="keterangan" id="keterangan">
						</div>
					</div>

					<div class="kt-form__actions">
						<div class="row">
							<div class="col-3"></div>
							<div class="col-9">
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
{!! JsValidator::formRequest('App\Http\Requests\GcgPemberianStore', '#formPemberian') !!}

<script type="text/javascript">
	$(document).ready(function () {
		// minimum setup
		$('#tanggal_pemberian').datepicker({
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
			// language : 'id',
			format   : 'yyyy-mm-dd'
		});
	});
</script>
@endsection