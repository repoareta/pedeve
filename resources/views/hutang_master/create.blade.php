@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Master Hutang </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum 
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Master Hutang </a>
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
					Tambah Master Hutang
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<div class="kt-portlet__body">
				<form class="kt-form kt-form--label-right" id="formHutangMaster" action="{{ route('hutang.store') }}" method="POST">
					@csrf

					<div class="form-group row">
						<label for="tahun" class="col-2 col-form-label">Bulan</label>
						<div class="col-4">
							<select class="form-control kt-select2" name="bulan" id="bulan">
								<option value="">- Pilih Bulan -</option>
								<option value="1">Januari</option>
								<option value="2">Februari</option>
								<option value="3">Maret</option>
								<option value="4">April</option>
								<option value="5">Mei</option>
								<option value="6">Juni</option>
								<option value="7">Juli</option>
								<option value="8">Agustus</option>
								<option value="9">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
							<div id="bulan-nya"></div>
						</div>

						<label for="tahun" class="col-2 col-form-label">Tahun</label>
						<div class="col-4">
							<input class="form-control" type="text" name="tahun" id="tahun" value="{{ date('Y') }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="kode" class="col-2 col-form-label">Pegawai</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="pegawai" id="pegawai">
								<option value="">- Pilih Pegawai -</option>
								@foreach ($pekerja_list as $pekerja)
									<option value="{{ $pekerja->nopeg }}">{{ $pekerja->nopeg.' - '.$pekerja->nama.' - '.pekerja_status($pekerja->status) }}</option>
								@endforeach
							</select>
							<div id="pegawai-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="nama" class="col-2 col-form-label">AARD</label>
						<div class="col-10">
							<select class="form-control kt-select2" name="aard" id="aard">
								<option value="">- Pilih AARD -</option>
								@foreach ($aard_list as $aard)
									<option value="{{ $aard->kode }}">{{ $aard->kode.' - '.$aard->nama }}</option>
								@endforeach
							</select>
							<div id="aard-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-2 col-form-label">Last Amount</label>
						<div class="col-10">
							<input class="form-control" type="number" name="last_amount" id="last_amount">
						</div>
					</div>

					<div class="form-group row">
						<label for="nilai" class="col-2 col-form-label">Current Amount</label>
						<div class="col-10">
							<input class="form-control" type="number" name="current_amount" id="current_amount">
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
{!! JsValidator::formRequest('App\Http\Requests\HutangMasterStore', '#formHutangMaster') !!}

<script type="text/javascript">
	$(document).ready(function () {
		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});

		$("#formHutangMaster").on('submit', function(){
			if ($('#bulan-error').length){
				$("#bulan-error").insertAfter("#bulan-nya");
			}

			if ($('#pegawai-error').length){
				$("#pegawai-error").insertAfter("#pegawai-nya");
			}

			if ($('#aard-error').length){
				$("#aard-error").insertAfter("#aard-nya");
			}
		});
	});
</script>
@endsection