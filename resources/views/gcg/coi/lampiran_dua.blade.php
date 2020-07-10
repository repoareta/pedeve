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
						<center>
							SURAT PERNYATAAAN INSAN PERTAMINA DANA VENTURA
						</center>
					</p>

					<p>
						Yang bertanda tangan dibawah ini:
						<br>
						Nama: I Made Sunarta
						<br>
						Nomor Pekerja: 213435334
						<br>
						Jabatan: Manajer/Setara
						<br>
						Fungsi: SEKRETARIS PERSEROAN
					</p>

					<p>
						Dengan ini menyatakan dan menjamin bahwa SAYA tidak mempunyai benturan kepentingan terhadap PT. Pertamina Dana Ventura yang membuat SAYA tidak patut untuk melakukan tindakan berikut ini : 
						
						<ul>
							<li>
								Melaksanakan jasa apapun atau memiliki peran apapun dalam perusahaan lain atau usaha pesaing yang sedang atau akan melakukan kerjasama usaha dengan PT. Pertamina Dana Ventura.
							</li>
							<li>
								Memiliki kepentingan ekonomi secara langsung maupun tidak langsunh terhadap persahaan atau organisasi manapun yang saat ini sedang melakukan kerjasama dengan PT. Pertamina Dana Ventura atau ingin melakukan kerjasama dengan PT. Pertamina Dana Ventura.
							</li>
							<li>
								Memiliki anggota keluarga atau teman yang memiliki kepentingan ekonomi secara langsung maupun tidak langsung terhadap perusahaan atau organisasi yang saat ini melakukan usaha dengan PT. Pertamina Dana Ventura.
							</li>
							<li>
								Melakukan transaksi dan/atau menggunakan harta/fasilitas PT. Pertamina Dana Ventura untuk kepentingan diri sendiri, keluarga, atau golongan.
							</li>
							<li>
								Mewakili PT. Pertamina Dana Ventura dalam transaksi dengan perusahaan lain dimana SAYA atau anggota keluarga SAYA atau teman SAYA memiliki kepentingan.
							</li>
							<li>
								Menerima hadiah, uang atau hiburan dari pemasok atau mitra usaha, atau dari agen manapun atau bertindak sebagai atau mewakili pemasok atau mitra usaha dalam transaksinya dengan PT. Pertamina Dana Ventura selain daripada yang diuraikan dalam kebijakan PT. Pertamina Dana Ventura mengenai Hadiah dan Hiburan.
							</li>
							<li>
								Menggunakan informasi rahasia dan data bisnis PT. Pertamina Dana Ventura untuk kepentingan pribadi atau dengan cara yang merugikan kepentingan PT. Pertamina Dana Ventura. 
							</li>
							<li>
								Mengungkapkan kepada individu atau organisasi atau pihak manapun di luar PT. Pertamina Dana Ventura setiap informasi, program, data keuangan, formula, proses atau "Know-How" rahasia milik PT. Pertamina Dana Ventura atau yang dikembangkan oleh SAYA dalam memenuhi tanggung jawab SAYA terhadap PT. Pertamina Dana Ventura.
							</li>
							<li>
								Melaksanakan setiap tindakan lainnya, yang tidak disebutkan secara spesifik diatas ini, yang dianggap merugikan bagi kepentingan PT. Pertamina Dana Ventura. 
							</li>
						</ul>

						SAYA mengerti bahwa apabila SAYA memiliki benturan kepentingan dan sebelumnya SAYA tidak melaporkan hal tersebut kepada atasan atau pihak yang berwenang di PT. Pertamina Dana Ventura. SAYA dapat dikenakan tindakan disiplin sebagaimana yang tercantum dalam peraturan perusahaan PT. Pertamina Dana Ventura yang mana SAYA telah memahami peraturan tersebut.
						
						<br>
						<br>

						Demikian pernyataan ini SAYA buat dengan sebenarnya, dalam keadaan sehat baik jasmani dan rohani dan tanpa ada paksaan dari pihak manapun.

						<br>
						<br>
						<button type="button" class="btn btn-primary">Simpan</button>
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
	$(document).ready(function () {
		$('#kt_table').DataTable();
	});
	</script>
@endsection