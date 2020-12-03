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
				<a href="" class="kt-subheader__breadcrumbs-link">
					Submain
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
					Tambah
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
					Tambah Anggaran Submain
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<div class="kt-portlet__body">
				<form class="kt-form kt-form--label-right" id="formAnggaranSubmain" action="{{ route('anggaran.submain.store') }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="tahun" class="col-2 col-form-label">Tahun</label>
						<div class="col-10">
							<input class="form-control" type="text" name="tahun" id="tahun" value="{{ date('Y') }}" onkeyup="getMasterAnggaran(this.value)">
						</div>
					</div>

					<div class="form-group row">
						<label for="kode_main" class="col-2 col-form-label">Master Anggaran</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="kode_main" id="kode_main">
								<option value="">- Pilih Master Anggaran -</option>
								@foreach ($anggaran_main_list as $anggaran)
									<option value="{{ $anggaran->kode_main }}">{{ $anggaran->kode_main.' - '.$anggaran->nama_main }}</option>
								@endforeach
							</select>
							<div id="kode_main-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="kode" class="col-2 col-form-label">Kode Sub</label>
						<div class="col-10">
							<input class="form-control" type="text" name="kode" id="kode">
						</div>
					</div>

					<div class="form-group row">
						<label for="nama" class="col-2 col-form-label">Nama Sub</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nama" id="nama">
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-2 col-form-label">Nilai</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nilai" id="nilai">
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
					</>
				</form>
		</div>
		{{-- END BODY --}}		
	</div>	
</div>


@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\AnggaranSubmainStore', '#formAnggaranSubmain') !!}

<script>
	$(document).ready(function () {
		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});

		$("#formAnggaranSubmain").on('submit', function(){
			if ($('#kode_main-error').length){
				$("#kode_main-error").insertAfter("#kode_main-nya");
			}
		});

		$("#tahun").inputFilter(function(value) {
			return /^\d*$/.test(value);    // Allow digits only, using a RegExp
		});

		
	});

	function getMasterAnggaran(tahun) {
		alert(tahun);
	}
</script>
@endsection