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
                    LHKPN
                </a>
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
					Tambah Data LHKPN
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<div class="kt-portlet__body">
				<form class="kt-form kt-form--label-right" id="formLHKPN" action="{{ route('gcg.lhkpn.store') }}" method="POST" enctype="multipart/form-data">
					@csrf

					<div class="form-group row">
						<label for="keterangan" class="col-4 col-form-label">Apakah anda sudah melakukan <b>Laporan LHKPN</b></label>
						<div class="col-8">
							<div class="kt-radio-inline">
								<label class="kt-radio kt-radio--solid">
									<input value="sudah" type="radio" name="status_lhkpn" >Sudah
									<span></span>
								</label>
								<label class="kt-radio kt-radio--solid">
									<input value="belum" type="radio" name="status_lhkpn">Belum
									<span></span>
								</label>
							</div>
							<div id="status_lhkpn-nya"></div>
						</div>
					</div>

					<div class="form-group row">
						<label for="keterangan" class="col-4 col-form-label">Tanggal</label>
						<div class="col-8">
							<input class="form-control" type="text" name="tanggal" id="tanggal">
						</div>
					</div>

					<div class="form-group row">
						<label for="dokumen" class="col-4 col-form-label">Dokumen</label>
						<div class="col-8">
							<input type="file" name="dokumen" id="dokumen">
							<div id="dokumen-nya"></div>
						</div>
					</div>

					<div class="kt-form__actions">
						<div class="row">
							<div class="col-4"></div>
							<div class="col-8">
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
{!! JsValidator::formRequest('App\Http\Requests\GcgLhkpnStore', '#formLHKPN') !!}

<script type="text/javascript">
$(document).ready(function () {
	// minimum setup
	$('#tanggal').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'yyyy-mm-dd'
	});

	$("#formLHKPN").on('submit', function(){
		if ($('#status_lhkpn-error').length){
			$("#status_lhkpn-error").insertAfter("#status_lhkpn-nya");
		}

		if ($('#dokumen-error').length){
			$("#dokumen-error").insertAfter("#dokumen-nya");
		}
	});
});
</script>
@endsection