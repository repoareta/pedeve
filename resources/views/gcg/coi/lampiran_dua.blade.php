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
                    CoI 
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
				CoI (Code of Interest)
			</h3>			
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="row">
			<div class="col-md-12 text-center">
				<a name="" id="" class="btn btn-primary" href="#" role="button">Lampiran 1</a>
				<a name="" id="" class="btn btn-primary" href="{{ route('gcg.coc.lampiran_dua') }}" role="button">Lampiran 2</a>
			</div>
		</div>
		<div class="row">
			<form action="" class="form-horizontal">
				<div class="col-md-12">
					<p>
						<center>SURAT PERNYATAAN PEJABAT YANG BERTANGGUNG JAWAB ATAS PENERAPAN ATAS ETIKA USAHA DAN TATA PERILAKU (CODE OF CONDUCT)</center>
					</p>
					<p>
						Sehubungan dengan pemberitahuan Etika Usaha dan Tata Perilaku (Code of Conduct) PT. PERTAMINA DANA VENTURA

						<br>
						<br>

						Tanggal (Efektif) 2017-01-11 08:09:07 yang telah saya terima dan pahami sepenuhnya saya menyatakan bahwa pada tahun 2016 

						<br>
						<br>

						1. telah mendistribusikan Etika Usaha dan Tata Perilaku (Code of Conduct) telah diterima dan ditandatangani oleh seluruh insan PERTAMINA DANA VENTURA di fungsi krja yang menjadi tanggung jawab saya;

						<br>

						2. setelah mengkoordinasikan pelaksanaan sosialisasi dan internalisasi dengan Sekretaris Perseroan untuk 45 (orang) insan PERTAMINA DANA VENTURA dengan daftar terlampir;

						<br>

						3. telah melaporkan upaya-upaya untuk menjamin kepatuhan terhadap Etika Usaha dan Tata Perilaku (Code of Conduct) di fungsi kerja yang menjadi tanggung jawab saya;

						<br>

						4. telah melaporkan semua pelanggaran secara lengkap kepada Sekretaris Perseroan Jakarta, 2016-02-01 08:08:07

						<br>

						5. telah melaksanakan semua pemberian sanksi disiplin dan tindakan pembinaan/perbaikan yang harus dilakukan unit kerja yang menjadi tanggung jawab saya.

						<br>

						Nama: I Made Sunarta

						<br>

						Jabatan: Sekretaris Perseroan
						
						<br>

						<button type="button" class="btn btn-primary">Print Preview</button>
					</p>
				</div>
			</form>
		</div>
	</div>
</>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		$('#kt_table').DataTable();
	});
	</script>
@endsection