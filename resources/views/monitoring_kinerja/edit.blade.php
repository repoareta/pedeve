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
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edit</span>
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
					Edit Monitoring Kinerja
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<form  class="kt-form kt-form--label-right" id="form-update">
				{{csrf_field()}}
				@foreach($data_list as $data)
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="form-group row">
							<label class="col-2 col-form-label">Nama Perusahaan</label>
							<div class="col-8">					
								<input class="form-control" type="text" value="{{$data->kd_perusahaan}}" name="nama"  size="200" maxlength="200" title="Nama Perusahaan" readonly style="background-color:#DCDCDC; cursor:not-allowed">												
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun</label>
							<div class="col-4">
								<input class="form-control" type="text" value="{{$data->bulan}}"   name="bulan" size="2" maxlength="2" readonly style="background-color:#DCDCDC; cursor:not-allowed"> 
							</div>
							<div class="col-4" >
								<input class="form-control" type="text" value="{{$data->tahun}}"   name="tahun" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed"> 
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">CI</label>
							<div class="col-8">
								<div class="kt-radio-inline">
									<label class="kt-radio kt-radio--solid">
										<input class="form-control" type="hidden" value="{{ $data->kd_monitoring }}" name="kd_monitoring">
										<input value="1" type="radio"  name="ci" id="ci" onclick="displayResult(1)" <?php if( $data->ci  == 1 ) echo 'checked' ; ?>> Rp
										<span></span>
									</label>
									<label class="kt-radio kt-radio--solid">
										<input value="2" type="radio"    name="ci" id="ci" onclick="displayResult(2)" <?php if( $data->ci  == 2 ) echo 'checked' ; ?>> US$
										<span></span>
									</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Total Aset</label>
							<div class="col-8">
								<input class="form-control" type="text" value="{{number_format($data->total_aset,0,',','.')}}" name="total_aset" id="total_aset"  size="25" maxlength="25" title="Total Aset" autocomplete='off' onkeypress="return hanyaAngka(event)" autocomplete='off' >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Sales</label>
							<div class="col-8">						
								<input class="form-control" type="text" value="{{ number_format($data->sales ,0,',','.')}}" name="sales" id="sales" size="200" maxlength="200" title="Sales" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Laba Bersih</label>
							<div class="col-8">
								<input class="form-control" type="text" value="{{number_format($data->laba_bersih,0,',','.')}}" name="laba_bersih" id="laba_bersih" size="25" maxlength="25" title="Laba Bersih" autocomplete='off' onkeypress="return hanyaAngka(event)" autocomplete='off' >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">TKP</label>
							<div class="col-8">						
								<input class="form-control" type="text" value="{{ number_format($data->tkp ,0,',','.')}}" name="tkp" id="tkp"  title="TKP" autocomplete='off'>
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
				@endforeach
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

		

		$('#form-update').submit(function(){
			$.ajax({
				url  : "{{route('monitoring_kinerja.update')}}",
				type : "POST",
				data : $('#form-update').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
					
					Swal.fire({
						type  : 'success',
						title : 'Data Berhasil Diubah',
						text  : 'Berhasil',
						timer : 2000
					}).then(function(data) {
						window.location.replace("{{ route('monitoring_kinerja.index') }}");
						});
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
