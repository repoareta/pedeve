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
                    CoC 
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
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
			<h3 class="kt-portlet__head-title">
				CoC (Code of Conduct)
			</h3>			
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="row">
			<div class="col-md-12 text-center">
				<a class="btn btn-primary btn-sm active" href="{{ route('gcg.coc.lampiran_satu') }}" role="button">Lampiran 1</a>
				<a class="btn btn-primary btn-sm" href="{{ route('gcg.coc.lampiran_dua') }}" role="button">Lampiran 2</a>
			</div>
		</div>
		<div class="row">
			<form class="kt-form" id="formPrint" 
			@if(Request::get('tempat'))action="{{ route('gcg.coc.lampiran_satu.print') }}" @endif
			 method="get">
				<div class="col-md-12">
					<p>
						<center><b>SURAT PERNYATAAN INSAN PERTAMINA DANA VENTURA</b></center>
					</p>

					<p class="text-justify">
						Dengan ini saya menyatakan telah menerima, membaca dan memahami
		
						Etika Usaha dan Tata Perilaku (Code of Conduct) PT. Pertamina DANA VENTURA
		
						Tanggal (Efektif) 
						@if(Request::get('tanggal_efektif'))
							<b>{{ Request::get('tanggal_efektif') }}</b>
						@else
							<b>{{ date('Y-m-d H:i:s') }}</b>
						@endif
						dan bersedia untuk mematuhi semua ketentuan yang tercantum di dalamnya dan menerima sanksi atas pelanggaran (jika ada) yang saya lakukan.
						
						<br>
						<br>
						<br>
						<br>
						<br>
						
						@if (Request::get('tempat'))
							{{ Request::get('tempat') }}
						@else
							(Tempat)
							<br>
							
							<input class="form-control col-2" style="display:inline" type="text" name="tempat" placeholder="lokasi kerja anda" required>
							
							<input type="hidden" name="tanggal_efektif" value="{{ date('Y-m-d H:i:s') }}" required>
						@endif
						, 
						@if(Request::get('tanggal_efektif'))
							<b>{{ Request::get('tanggal_efektif') }}</b>
						@else
							<b>{{ date('Y-m-d H:i:s') }}</b>
						@endif

						<br>
						<br>
						
						{{ Auth::user()->usernm }} - Sekretaris PERSEROAN
						
						<br>
						<br>

						@if (Request::get('tempat'))
							<input type="hidden" name="tempat" value="{{ Request::get('tempat') }}" required>
							<input type="hidden" name="tanggal_efektif" value="{{ Request::get('tanggal_efektif') }}" required>
							<button type="submit" onclick="printPDF()" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
						@else
							<button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
						@endif
					</p>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		function printPDF() {
			$("#formPrint").attr("target", "_blank");
		}
	</script>
@endsection