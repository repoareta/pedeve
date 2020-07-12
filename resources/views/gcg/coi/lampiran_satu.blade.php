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
				CoI (Conflict of Interest)
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
			@if(Request::get('tempat'))action="{{ route('gcg.coi.lampiran_satu.print') }}" @endif
			 method="get">
				<div class="col-md-12">
					<p>
						<center>
							<b>
								SURAT PERNYATAAN INSAN PERTAMINA DANA VENTURA
							</b>
						</center>
					</p>
					<p>
						Yang bertanda tangan dibawah ini, Saya 
						<b>{{ Auth::user()->usernm }}</b> 
						Nomor Pekerja 
						<b>{{ Auth::user()->nopeg }}</b>
						, menyatakan bahwa :
					</p>
					<p>
						1. Atasan saya telah menjelaskan mengenai apa yang dimaksud dengan Konflik Kepentingan.

						<br>

						2. Saya juga telah membaca dan mengerti bahwa berikut ini merupakan Konflik kepentingan yaitu sebagai berikut : 

						<ol type="a">
							<li>
								Melaksanakan jasa apapun atau memainkan peran apapun dalam perusahaan atau usaha pesaing yang memalukan atau ingin melakukan usaha dengan PT. Pertamina Dana Ventura;
							</li>
							<li>
								Memiliki kepentingan apapun (komersial atau lainnya) dalam perusahaan atau organisasi manapun yang saat ini sedang melakukan usaha dengan PT. Pertamina Dana Ventura atau ingin melakukan usaha dengan PT. Pertamina Dana Ventura;
							</li>
							<li>
								Memiliki anggota keluarga atau teman yang memiliki kepentingan dalam perusahaan atau organisasi yang saat ini melakukan usaha dengan PT. Pertamina Dana Ventura; 
							</li>
							<li>
								Melakukan transaksi dan/atau menggunakan harga/fasilitas PT. Pertamina Dana Ventura untuk kepentingan diri sendiri, keluarga, atau golongan;
							</li>
							<li>
								Mewakili PT Pertamina Dana Ventura dalam transaksi dengan perusahaan lain dimana saya atau anggota keluarga saya atau teman saya memiliki kepentingan;
							</li>
							<li>
								Menerima hadiah, uang atau hiburan dan pemasok atau mitra usaha, atau dari agen manapun atau bertindak sebagai atau mewakili pemasok atau mitra usaha dalam transaksinya dengan PT. Pertamina Dana Ventura, selain daripada yang diuraikan dalam kebijakan Hadiah dan Hiburan;
							</li>
							<li>
								Menggunakan informasi rahasia dan data bisnis PT. Pertamina Dana Ventura untuk kepentingan pribadi atau dengan cara yang merugikan kepentingan PT. Pertamina Dana Ventura;  
							</li>
							<li>
								Mengungkapkan kepada individu atau organisasi manapun di luar PT. Pertamina Dana Ventura setiap informasi, program, data keuangan, formula, proses atau "Know-How" rahasia milik PT. Pertamina Dana Ventura atau yang dikembangkan oleh saya dalam memenuhi tanggung jawab saya terhadap PT. Pertamina Dana Ventura.
							</li>
						</ol>

						3. Saya juga ingin mengambil kesempatan ini untuk menyatakan bahwa saya mempunyai Potensial Konflik Kepentingan sebagai berikut :

						@if (Request::get('konflik'))
							<textarea name="konflik" class="form-control col-4">{{ Request::get('konflik') }}</textarea>
						@else
							<textarea name="konflik" class="form-control col-4"></textarea>
						@endif
						
						<br>
						4. Saya mengerti bahwa apabila PT. Pertamina Dana Ventura mengetahui bahwa saya memiliki benturan kepentingan dan sebelumnya saya tidak melaporkan hal tersebut kepada atasan atau pihak yang berwenang, saya dapat dikenakan tindakan disiplin yang tercantum dalam peraturan perusahaan PT. Pertamina Dana Ventura. Saya juga sudah membaca dan memahami peraturan tsb.

						<br>
						<br>

						Demikian Deklarasi ini saya buat dengan sebenarnya dalam keadaan sehat baik jasmani dan rohani dan tanpa ada paksaan dari pihak manapun.
					</p>

					<br>
					<br>

					@if (Request::get('tempat'))
						<b>{{ Request::get('tempat') }}</b>
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

					{{ Auth::user()->usernm.' - '.$jabatan->keterangan }}

					<br>
					<br>
					@if (Request::get('tempat'))
						<input type="hidden" name="tempat" value="{{ Request::get('tempat') }}" required>
						<input type="hidden" name="tanggal_efektif" value="{{ Request::get('tanggal_efektif') }}" required>
						<button type="submit" onclick="printPDF()" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
					@else
						<button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
					@endif
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