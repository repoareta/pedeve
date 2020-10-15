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
				<a class="btn btn-primary btn-sm active" href="{{ route('gcg.coi.lampiran_satu') }}" role="button">Lampiran 1</a>
				<a class="btn btn-primary btn-sm" href="{{ route('gcg.coi.lampiran_dua') }}" role="button">Lampiran 2</a>
			</div>
		</div>
		<div class="row">
			<form class="kt-form" id="formPrint" 
			@if(Request::get('tempat'))action="{{ route('gcg.coi.lampiran_dua.print') }}" @endif
			@if(Request::get('tempat')) method="POST" @else method="GET" @endif>
			@csrf
				<div class="col-md-12">
					<p>
						<center>
							<b>
								SURAT PERNYATAAAN INSAN PERTAMINA PEDEVE INDONESIA
							</b>
						</center>
					</p>

					<p>
						Yang bertanda tangan dibawah ini:
						<br>
						Nama: {{ Auth::user()->pekerja->nama }}
						<br>
						Nomor Pekerja: {{ Auth::user()->nopeg }}
						<br>
						Jabatan: {{ Auth::user()->fungsi_jabatan->nama }}
						<br>
						Fungsi: {{ Auth::user()->fungsi->nama }}
					</p>

					<p>
						Dengan ini menyatakan dan menjamin bahwa SAYA tidak mempunyai benturan kepentingan terhadap PT. Pertamina Pedeve Indonesia yang membuat SAYA tidak patut untuk melakukan tindakan berikut ini : 
						
						<ul>
							<li>
								Melaksanakan jasa apapun atau memiliki peran apapun dalam perusahaan lain atau usaha pesaing yang sedang atau akan melakukan kerjasama usaha dengan PT. Pertamina Pedeve Indonesia.
							</li>
							<li>
								Memiliki kepentingan ekonomi secara langsung maupun tidak langsunh terhadap persahaan atau organisasi manapun yang saat ini sedang melakukan kerjasama dengan PT. Pertamina Pedeve Indonesia atau ingin melakukan kerjasama dengan PT. Pertamina Pedeve Indonesia.
							</li>
							<li>
								Memiliki anggota keluarga atau teman yang memiliki kepentingan ekonomi secara langsung maupun tidak langsung terhadap perusahaan atau organisasi yang saat ini melakukan usaha dengan PT. Pertamina Pedeve Indonesia.
							</li>
							<li>
								Melakukan transaksi dan/atau menggunakan harta/fasilitas PT. Pertamina Pedeve Indonesia untuk kepentingan diri sendiri, keluarga, atau golongan.
							</li>
							<li>
								Mewakili PT. Pertamina Pedeve Indonesia dalam transaksi dengan perusahaan lain dimana SAYA atau anggota keluarga SAYA atau teman SAYA memiliki kepentingan.
							</li>
							<li>
								Menerima hadiah, uang atau hiburan dari pemasok atau mitra usaha, atau dari agen manapun atau bertindak sebagai atau mewakili pemasok atau mitra usaha dalam transaksinya dengan PT. Pertamina Pedeve Indonesia selain daripada yang diuraikan dalam kebijakan PT. Pertamina Pedeve Indonesia mengenai Hadiah dan Hiburan.
							</li>
							<li>
								Menggunakan informasi rahasia dan data bisnis PT. Pertamina Pedeve Indonesia untuk kepentingan pribadi atau dengan cara yang merugikan kepentingan PT. Pertamina Pedeve Indonesia. 
							</li>
							<li>
								Mengungkapkan kepada individu atau organisasi atau pihak manapun di luar PT. Pertamina Pedeve Indonesia setiap informasi, program, data keuangan, formula, proses atau "Know-How" rahasia milik PT. Pertamina Pedeve Indonesia atau yang dikembangkan oleh SAYA dalam memenuhi tanggung jawab SAYA terhadap PT. Pertamina Pedeve Indonesia.
							</li>
							<li>
								Melaksanakan setiap tindakan lainnya, yang tidak disebutkan secara spesifik diatas ini, yang dianggap merugikan bagi kepentingan PT. Pertamina Pedeve Indonesia. 
							</li>
						</ul>

						SAYA mengerti bahwa apabila SAYA memiliki benturan kepentingan dan sebelumnya SAYA tidak melaporkan hal tersebut kepada atasan atau pihak yang berwenang di PT. Pertamina Pedeve Indonesia. SAYA dapat dikenakan tindakan disiplin sebagaimana yang tercantum dalam peraturan perusahaan PT. Pertamina Pedeve Indonesia yang mana SAYA telah memahami peraturan tersebut.
						
						<br>
						<br>

						Demikian pernyataan ini SAYA buat dengan sebenarnya, dalam keadaan sehat baik jasmani dan rohani dan tanpa ada paksaan dari pihak manapun.

						<br>
					<br>

					@if (Request::get('tempat'))
						<b>{{ Request::get('tempat') }}</b>
					@else						
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

					{{ Auth::user()->pekerja->nama.' - '.Auth::user()->fungsi_jabatan->nama }}

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