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
				<a class="btn btn-primary" href="{{ route('gcg.coc.lampiran_satu') }}" role="button">Lampiran 1</a>
				<a class="btn btn-primary active" href="{{ route('gcg.coc.lampiran_dua') }}" role="button">Lampiran 2</a>
			</div>
		</div>
		<div class="row">
			<form class="kt-form" id="formPrint" 
			@if(Request::get('orang'))action="{{ route('gcg.coc.lampiran_dua.print') }}" @endif
			 method="get">
				<div class="col-md-12">
					<p>
						<center>
							<b>
								SURAT PERNYATAAN PEJABAT YANG BERTANGGUNG JAWAB
								<br>
								ATAS PENERAPAN ATAS ETIKA USAHA DAN TATA PERILAKU (CODE OF CONDUCT)
							</b>
						</center>
					</p>
					<p>
						Sehubungan dengan pemberitahuan Etika Usaha dan Tata Perilaku (Code of Conduct) PT. PERTAMINA DANA VENTURA

						<br>
						<br>

						Tanggal (Efektif) 
						<b>{{ date('Y-m-d H:i:s') }}</b> 
						yang telah saya terima dan pahami sepenuhnya saya menyatakan bahwa pada tahun
						<b>{{ date('Y') }}</b> 

						<br>
						<br>

						1. telah mendistribusikan Etika Usaha dan Tata Perilaku (Code of Conduct) telah diterima dan ditandatangani oleh seluruh insan PERTAMINA DANA VENTURA di fungsi krja yang menjadi tanggung jawab saya;

						<br>

						2. setelah mengkoordinasikan pelaksanaan sosialisasi dan internalisasi dengan Sekretaris Perseroan untuk 
						@if (Request::get('orang'))
							{{ Request::get('orang') }}
						@else
						<input class="form-control col-1" style="display:inline" type="text" name="orang" placeholder="jumlah" required> 
						@endif
						(orang) insan PERTAMINA DANA VENTURA dengan daftar terlampir;

						<br>

						3. telah melaporkan upaya-upaya untuk menjamin kepatuhan terhadap Etika Usaha dan Tata Perilaku (Code of Conduct) di fungsi kerja yang menjadi tanggung jawab saya;

						<br>

						4. telah melaporkan semua pelanggaran secara lengkap kepada Sekretaris Perseroan 
						<b>Jakarta, {{ date('Y-m-d H:i:s') }}</b> 

						<br>

						5. telah melaksanakan semua pemberian sanksi disiplin dan tindakan pembinaan/perbaikan yang harus dilakukan unit kerja yang menjadi tanggung jawab saya.

						<br>
						<br>

						Nama: {{ ucwords(strtolower(Auth::user()->usernm)) }}

						<br>

						Jabatan: Sekretaris Perseroan
						
						<br>
						<br>
						<br>

						@if (Request::get('orang'))
							<input type="hidden" name="orang" value="{{ Request::get('orang') }}" required>
							<input type="hidden" name="tanggal_efektif" value="{{ Request::get('tanggal_efektif') }}" required>
							<button type="submit" onclick="printPDF()" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
						@else
							<input type="hidden" name="tanggal_efektif" value="{{ date('Y-m-d H:i:s') }}" required>
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