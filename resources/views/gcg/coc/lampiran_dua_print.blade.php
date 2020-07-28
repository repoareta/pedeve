<html>
    <head>
        <style>
            .row {
              display: -ms-flexbox;
              display: flex;
              -ms-flex-wrap: wrap;
              flex-wrap: wrap;
              margin-right: -5px;
              margin-left: -5px;
            }

            .text-center {
              text-align: center;
            }

            .text-justify {
              text-align: justify;
            }
        </style>
    </head>
    <body>
        <div class="">
          <p>
            <center>
							<b>
								SURAT PERNYATAAN PEJABAT YANG BERTANGGUNG JAWAB
								<br>
								ATAS PENERAPAN ATAS ETIKA USAHA DAN TATA PERILAKU (CODE OF CONDUCT)
							</b>
						</center>
          </p>

          <br>

          <p class="text-justify">
            Sehubungan dengan pemberitahuan Etika Usaha dan Tata Perilaku (Code of Conduct) PT. PERTAMINA DANA VENTURA

						<br>
						<br>

            Tanggal (Efektif) 
            <b>{{ $tanggal_efektif }}</b> 
            yang telah saya terima dan pahami sepenuhnya saya menyatakan bahwa pada tahun
            <b>{{ date('Y') }}</b> 
            
            <br>
						<br>

						1. telah mendistribusikan Etika Usaha dan Tata Perilaku (Code of Conduct) telah diterima dan ditandatangani oleh seluruh insan PERTAMINA DANA VENTURA di fungsi krja yang menjadi tanggung jawab saya;

						<br>

						2. setelah mengkoordinasikan pelaksanaan sosialisasi dan internalisasi dengan Sekretaris Perseroan untuk 
            {{ $orang }}
						(orang) insan PERTAMINA DANA VENTURA dengan daftar terlampir;

						<br>

						3. telah melaporkan upaya-upaya untuk menjamin kepatuhan terhadap Etika Usaha dan Tata Perilaku (Code of Conduct) di fungsi kerja yang menjadi tanggung jawab saya;

						<br>

						4. telah melaporkan semua pelanggaran secara lengkap kepada Sekretaris Perseroan;

						<br>

						5. telah melaksanakan semua pemberian sanksi disiplin dan tindakan pembinaan/perbaikan yang harus dilakukan unit kerja yang menjadi tanggung jawab saya.

						<br>
            <br>
            <br>
            <br>
            
            <b>Jakarta, {{ $tanggal_efektif }}</b> 
            
            <br>
            <br>
            <br>
            <br>

						Nama: {{ ucwords(strtolower(Auth::user()->usernm)) }}

						<br>

						Jabatan: Sekretaris Perseroan
          </p>
        </div>
    </body>
</html>