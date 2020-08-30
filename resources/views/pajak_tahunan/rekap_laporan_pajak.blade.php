@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Form Cetak 1721-A1 Tahunan </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
				Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Form Cetak 1721-A1 Tahunan</span>
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
					Form Cetak 1721-A1 Tahunan
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
		<div class="card-body table-responsive" >
			<!--begin: Datatable -->
			<form  class="kt-form kt-form--label-right"  action="{{route('laporan_pajak.export.laporan')}}" method="post">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Tahun<span style="color:red;">*</span></label>
							<div class="col-8">
								<select name="tahun" class="form-control kt-select2" required oninvalid="this.setCustomValidity('Tahun Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									@for ($i = 2004; $i <= date('Y'); $i++)
									<option value="{{$i}}" <?php if($i == date('Y')) echo 'selected'; ?>>{{$i}}</option>
									@endfor
									
									
								</select>
							</div>
						</div>

						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('data_pajak.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Kembali</a>
									<button type="submit" class="btn btn-brand" onclick="$('form').attr('target', '_blank')"><i class="fa fa-print" aria-hidden="true"></i>Cetak</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			<!--end: Datatable -->
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function () {
		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});
		
	});

		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
