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
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edit</span>
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
					List Outstanding
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<div class="kt-portlet__body">
				<form class="kt-form kt-form--label-right" id="formAgama" action="{{ route('gcg.gratifikasi.update', ['gratifikasi' => $gratifikasi->id]) }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="" class="col-3 col-form-label">Nopek - Nama:</label>
						<div class="col-9">
							<label class="col-form-label">
								{{ $gratifikasi->nopeg.' - '.$gratifikasi->pekerja->nama }}
							</label>
						</div>
					</div>

					<div class="form-group row">
						<label for="" class="col-3 col-form-label">Tanggal:</label>
						<div class="col-9">
							<label class="col-form-label">
								{{ Carbon\Carbon::parse($gratifikasi->tgl_gratifikasi)->translatedFormat('d F Y') }}
							</label>
						</div>
					</div>

					<div class="form-group row">
						<label for="" class="col-3 col-form-label">Bentuk/Jenis yang diterima:</label>
						<div class="col-9">
							<label class="col-form-label">
								{{ $gratifikasi->bentuk }}
							</label>
						</div>
					</div>

					<div class="form-group row">
						<label for="" class="col-3 col-form-label">Perkiraan Nilai (Rp):</label>
						<div class="col-9">
							<label class="col-form-label">
								{{ $gratifikasi->nilai }}
							</label>
						</div>
					</div>

					<div class="form-group row">
						<label for="" class="col-3 col-form-label">Jumlah Hadiah:</label>
						<div class="col-9">
							<label class="col-form-label">
								{{ $gratifikasi->jumlah }}
							</label>
						</div>
					</div>

					<div class="form-group row">
						<label for="" class="col-3 col-form-label">Pemberi Hadiah:</label>
						<div class="col-9">
							<label class="col-form-label">
								{{ $gratifikasi->pemberi }}
							</label>
						</div>
					</div>

					<div class="form-group row">
						<label for="" class="col-3 col-form-label">Keterangan:</label>
						<div class="col-9">
							<label class="col-form-label">
								{{ $gratifikasi->keterangan }}
							</label>
						</div>
					</div>

					<div class="form-group row">
						<label for="status" class="col-3 col-form-label">Status:</label>
						<div class="col-9">
							<select class="form-control kt-select2" name="status" id="status">
								<option value="">- Pilih -</option>
								<option value="Sudah diserahkan ke keuangan">Sudah diserahkan ke keuangan</option>
								<option value="Di CS">Di CS</option>
								<option value="Di atasan langsung yang bersangkutan">Di atasan langsung yang bersangkutan</option>
								<option value="Di kembalikan ke ybs">Di kembalikan ke ybs</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="catatan" class="col-3 col-form-label">Catatan:</label>
						<div class="col-9">
							<textarea class="form-control" name="catatan" id="catatan"></textarea>
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
{{-- {!! JsValidator::formRequest('App\Http\Requests\InsentifMasterStore', '#formInsentifMaster') !!} --}}

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

		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});
	});
</script>
@endsection