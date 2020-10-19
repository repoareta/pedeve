@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Monitoring Kinerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Customer Management </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Monitoring Kinerja </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Tambah</span>
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
					Tambah Monitoring Kinerja
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<form  class="kt-form kt-form--label-right" id="form-create">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Nama Perusahaan<span style="color:red;">*</span></label>
							<div class="col-8">
								<select name="nama" class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Nama Perusahaan Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									@foreach ($data_perusahaan as $row)
									<option value="{{ $row->id }}">{{ $row->nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun</label>
							<div class="col-4">
									<?php 
										$tahun =date('Y');
										$bulan = date('m');
									?>
									<select class="form-control kt-select2" name="bulan">
										<option value="01" <?php if($bulan  == '01' ) echo 'selected' ; ?>>Januari</option>
										<option value="02" <?php if($bulan  == '02' ) echo 'selected' ; ?>>Februari</option>
										<option value="03" <?php if($bulan  == '03' ) echo 'selected' ; ?>>Maret</option>
										<option value="04" <?php if($bulan  == '04' ) echo 'selected' ; ?>>April</option>
										<option value="05" <?php if($bulan  == '05' ) echo 'selected' ; ?>>Mei</option>
										<option value="06" <?php if($bulan  == '06' ) echo 'selected' ; ?>>Juni</option>
										<option value="07" <?php if($bulan  == '07' ) echo 'selected' ; ?>>Juli</option>
										<option value="08" <?php if($bulan  == '08' ) echo 'selected' ; ?>>Agustus</option>
										<option value="09" <?php if($bulan  == '09' ) echo 'selected' ; ?>>September</option>
										<option value="10" <?php if($bulan  =='10'  ) echo 'selected' ; ?>>Oktober</option>
										<option value="11" <?php if($bulan  == '11' ) echo 'selected' ; ?>>November</option>
										<option value="12" <?php if($bulan  == '12' ) echo 'selected' ; ?>>Desember</option>
									</select>
							</div>
							<div class="col-4" >
								<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off' required> 
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">CI</label>
							<div class="col-8">
								<div class="kt-radio-inline">
									<label class="kt-radio kt-radio--solid">
										<input value="1" type="radio"  name="ci" id="ci" onclick="displayResult(1)" checked> Rp
										<span></span>
									</label>
									<label class="kt-radio kt-radio--solid">
										<input value="2" type="radio"    name="ci" id="ci" onclick="displayResult(2)"> US$
										<span></span>
									</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Total Aset</label>
							<div class="col-8">
								<input class="form-control" type="hidden" value="1" name="kurs" id="kurs"  size="25" maxlength="20" title="Kurs" >
								<input class="form-control" type="text" value="" name="total_aset" id="total_aset" size="25" maxlength="25" title="Total Aset" onkeypress="return hanyaAngka(event)" autocomplete='off' >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Sales</label>
							<div class="col-8">						
								<input class="form-control" type="text" value="{{ old('sales') }}" name="sales" id="sales"  size="200" maxlength="200" title="Sales" onkeypress="return hanyaAngka(event)" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Laba Bersih</label>
							<div class="col-8">
								<input class="form-control" type="text" value="" name="laba_bersih" id="laba_bersih"  size="25" maxlength="25" title="Laba Bersih" onkeypress="return hanyaAngka(event)" autocomplete='off' >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">TKP</label>
							<div class="col-8">						
								<input class="form-control" type="text" value="{{ old('tkp') }}" name="tkp" id="tkp"  title="TKP" onkeypress="return hanyaAngka(event)" autocomplete='off'>
							</div>
						</div>
						
												
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('monitoring_kinerja.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
	</div>
</div>

@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		$('#tabel-detail-permintaan').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
		});

		$('.kt-select2').select2().on('change', function() {
			$(this).valid();
		});

		
		$("input[name=ci]:checked").each(function() {  
			var ci = $(this).val();
			if(ci == 1)
			{
				$('#kurs').val(1);
				$('#simbol-kurs').hide();
				$( "#kurs" ).prop( "required", false );
				$( "#kurs" ).prop( "readonly", true );
				$('#kurs').css("background-color","#DCDCDC");
				$('#kurs').css("cursor","not-allowed");

			}else{
				var kurs1 = $('#data-kurs').val();
				$('#kurs').val(kurs1);
				$('#simbol-kurs').show();
				$( "#kurs" ).prop( "required", true );
				$( "#kurs" ).prop( "readonly", false );
				$('#kurs').css("background-color","#ffffff");
				$('#kurs').css("cursor","text");
			}
				
		});

		

		$('#form-create').submit(function(){
			$.ajax({
				url  : "{{route('monitoring_kinerja.store')}}",
				type : "POST",
				data : $('#form-create').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
				if(data == 1){					
					Swal.fire({
						type  : 'success',
						title : 'Data Berhasil Ditambah',
						text  : 'Berhasil',
						timer : 2000
					}).then(function(data) {
						window.location.replace("{{ route('monitoring_kinerja.index') }}");
						});
				}else{
					Swal.fire({
						type  : 'info',
						title : 'Data sudah ada, entri dibatalkan.',
						text  : 'Info',
					});
				}
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});
		
		$('#tanggal').datepicker({
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
			// language : 'id',
			format   : 'yyyy-mm-dd'
		});
	});
	

  

		function displayResult(ci){ 
			if(ci == 1)
			{
				$('#kurs').val(1);
				$('#simbol-kurs').hide();
				$( "#kurs" ).prop( "required", false );
				$( "#kurs" ).prop( "readonly", true );
				$('#kurs').css("background-color","#DCDCDC");
				$('#kurs').css("cursor","not-allowed");

			}else{
				$('#kurs').val("");
				$('#simbol-kurs').show();
				$( "#kurs" ).prop( "required", true );
				$( "#kurs" ).prop( "readonly", false );
				$('#kurs').css("background-color","#ffffff");
				$('#kurs').css("cursor","text");
			}
		}
		
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}

		var total_aset = document.getElementById('total_aset');
		total_aset.addEventListener('keyup', function(e){
			total_aset.value = formatRupiahtotal_aset(this.value, '');
		});

		/* Fungsi formatRupiahtotal_aset */
		function formatRupiahtotal_aset(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			nilai     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				nilai += separator + ribuan.join('.');
			}

			nilai = split[1] != undefined ? nilai + ',' + split[1] : nilai;
			return prefix == undefined ? nilai : (nilai ? nilai: '');
		}

		var sales = document.getElementById('sales');
		sales.addEventListener('keyup', function(e){
			sales.value = formatRupiahsales(this.value, '');
		});

		/* Fungsi formatRupiahsales */
		function formatRupiahsales(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			nilai     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				nilai += separator + ribuan.join('.');
			}

			nilai = split[1] != undefined ? nilai + ',' + split[1] : nilai;
			return prefix == undefined ? nilai : (nilai ? nilai: '');
		}

		var laba_bersih = document.getElementById('laba_bersih');
		laba_bersih.addEventListener('keyup', function(e){
			laba_bersih.value = formatRupiahlaba_bersih(this.value, '');
		});

		/* Fungsi formatRupiahlaba_bersih */
		function formatRupiahlaba_bersih(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			nilai     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				nilai += separator + ribuan.join('.');
			}

			nilai = split[1] != undefined ? nilai + ',' + split[1] : nilai;
			return prefix == undefined ? nilai : (nilai ? nilai: '');
		}


		var tkp = document.getElementById('tkp');
		tkp.addEventListener('keyup', function(e){
			tkp.value = formatRupiahtkp(this.value, '');
		});

		/* Fungsi formatRupiahtkp */
		function formatRupiahtkp(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			nilai     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				nilai += separator + ribuan.join('.');
			}

			nilai = split[1] != undefined ? nilai + ',' + split[1] : nilai;
			return prefix == undefined ? nilai : (nilai ? nilai: '');
		}
</script>

@endsection
