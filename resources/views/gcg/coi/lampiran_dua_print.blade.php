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
								SURAT PERNYATAAAN INSAN PERTAMINA DANA VENTURA
							</b>
						</center>
          </p>

          <br>

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

          <p class="text-justify">
						Dengan ini menyatakan dan menjamin bahwa SAYA tidak mempunyai benturan kepentingan terhadap PT. Pertamina Dana Ventura yang membuat SAYA tidak patut untuk melakukan tindakan berikut ini : 
						
						<ul class="text-justify">
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
					</p>

          <br>
          <br>
		<div style="text-align:right;">
			{{ ucwords($tempat).', '.$tanggal_efektif }}
		</div>
		  
		<div style="text-align:left;">
		Mengetahui,
		<br>
		Atasan
		<span style="float:right;">
			Pekerja
		</span>
		</div>
		<br>
		<br>
		<br>
		<div style="text-align: left">
			{{ Auth::user()->pekerja->nama.' - '.Auth::user()->fungsi_jabatan->nama }}

			<span style="float:right;">
				{{ Auth::user()->pekerja->nama.' - '.Auth::user()->fungsi_jabatan->nama }}
			</span>
		</div>
          
        </div>
    </body>
</html>