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
				<a name="" id="" class="btn btn-primary" href="#" role="button">Lampiran 1</a>
				<a name="" id="" class="btn btn-primary" href="{{ route('gcg.coc.lampiran_dua') }}" role="button">Lampiran 2</a>
			</div>
		</div>
		<div class="row">
			<form action="" class="form-horizontal">
				<div class="col-md-12">
					<p>
						<center>SURAT PERNYATAAN INSAN PERTAMINA DANA VENTURA</center>
					</p>
					<p>
						Dengan ini saya menyatakan telah menerima, membaca dan memahami
		
						Etika Usaha dan Tata Perilaku (Code of Conduct) PT. Pertamina DANA VENTURA
		
						Tanggal (Efektif) 2020-02-01 12:12:00 dan bersedia untuk mematuhi semua ketentuan yang tercantum di dalamnya dan menerima sanksi atas pelanggaran (jika ada) yang saya lakukan.
						<br>
						<br>
						(Tempat)
						<br>
						<input type="text" class="form-control">, 20-02-01 8:28:25
						<br>
						<br>
						I Made Sunarta - Sekretaris PERSEROAN
						<br>
						<br>
						<button type="button" class="btn btn-primary">Simpan</button>
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