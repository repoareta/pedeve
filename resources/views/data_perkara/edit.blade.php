@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				data Perkara </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Customer Management </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					data Perkara </a>
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
					Tambah data Perkara
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<form  class="kt-form kt-form--label-right" method="post" action="{{ route('data_perkara.update')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				@foreach($data_list as $data)
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">					
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">No. Perkara<span style="color:red;">*</span></label>
							<div class="col-8">
								<input class="form-control" type="text" value="{{ $data->no_perkara }}" name="no_perkara" size="100" maxlength="100" title="No. Perkara" autocomplete='off' required oninvalid="this.setCustomValidity('No. Perkara Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Tanggal Perkara</label>
							<div class="col-8">
								<input class="form-control" type="text" value="{{ $data->tgl_perkara }}" name="tanggal" id="tanggal" size="15" maxlength="10" title="Tanggal Perkara" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Jenis</label>
							<div class="col-8">
								<select name="jenis_perkara" class="form-control kt-select2">
									<option value="">- Pilih -</option>		
									<option value="perdata" <?php if( $data->jenis_perkara  == 'perdata' ) echo 'selected' ; ?>>Perdata</option>		
									<option value="pidana" <?php if( $data->jenis_perkara  == 'pidana' ) echo 'selected' ; ?>>Pidana</option>
									<option value="kepailitan" <?php if( $data->jenis_perkara  == 'kepailitan' ) echo 'selected' ; ?>>Kepailitan</option>
									<option value="arbitrase" <?php if( $data->jenis_perkara  == 'arbitrase' ) echo 'selected' ; ?>>Arbitrase</option>
									<option value="hubungan industrial" <?php if( $data->jenis_perkara  == 'hubungan industrial' ) echo 'selected' ; ?>>Hubungan Industrial</option>						
								</select>							
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Klasifikasi Perkara</label>
							<div class="col-8">						
								<input class="form-control" type="text" value="{{ $data->klasifikasi_perkara }}" name="klasifikasi_perkara"  size="100" maxlength="100" title="Klasifikasi Perkara" autocomplete='off'>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Status Perkara</label>
							<div class="col-8">
								<select name="status_perkara" class="form-control kt-select2">
									<option value="">- Pilih -</option>		
									<option value="Pemeriksaan" <?php if( $data->status_perkara  == 'Pemeriksaan' ) echo 'selected' ; ?>>Pemeriksaan</option>		
									<option value="Mediasi" <?php if( $data->status_perkara  == 'Mediasi' ) echo 'selected' ; ?>>Mediasi</option>
									<option value="Persidangan" <?php if( $data->status_perkara  == 'Persidangan' ) echo 'selected' ; ?>>Persidangan</option>
									<option value="Selesai" <?php if( $data->status_perkara  == 'Selesai' ) echo 'selected' ; ?>>Selesai</option>
									<option value="Inkracht" <?php if( $data->status_perkara  == 'Inkracht' ) echo 'selected' ; ?>>Inkracht</option>						
									<option value="Banding" <?php if( $data->status_perkara  == 'Banding' ) echo 'selected' ; ?>>Banding</option>						
									<option value="Kasasi" <?php if( $data->status_perkara  == 'Kasasi' ) echo 'selected' ; ?>>Kasasi</option>						
									<option value="Peninjauan Kembali" <?php if( $data->status_perkara  == 'Peninjauan Kembali' ) echo 'selected' ; ?>>Peninjauan Kembali</option>						
									<option value="Arbitrase" <?php if( $data->status_perkara  == 'Arbitrase' ) echo 'selected' ; ?>>Arbitrase</option>						
								</select>							
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Ringkasan Perkara</label>
							<div class="col-8">
								<textarea class="form-control" type="text" value="" name="ringkasan_perkara" title="Ringkasan Perkara"  autocomplete='off'>{{ $data->r_perkara }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Ringkasan Petitum</label>
							<div class="col-8">
								<textarea class="form-control" type="text" value="" name="ringkasan_petitum" title="Ringkasan Petitum" autocomplete='off'>{{ $data->r_patitum }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Ringkasan Putusan</label>
							<div class="col-8">
								<textarea class="form-control" type="text" value="" name="ringkasan_putusan" title="Ringkasan Putusan" autocomplete='off'>{{ $data->r_putusan }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">CI</label>
							<div class="col-8">
								<div class="kt-radio-inline">
									<label class="kt-radio kt-radio--solid">
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
							<label for="" class="col-2 col-form-label">Kurs<span style="color:red;">*</span></label>
							<div class="col-8">
								<input class="form-control" type="text" value="{{$data->rate}}" name="kurs" id="kurs"  size="25" maxlength="20" title="Kurs"  autocomplete='off' onkeypress="return hanyaAngka(event)" required oninvalid="this.setCustomValidity('User Name Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Nilai Perkara<span style="color:red;">*</span></label>
							<div class="col-8">
								<input class="form-control" type="text" value="{{$data->nilai_perkara}}" name="nilai_perkara"  size="25" maxlength="20" title="Nilai Perkara" autocomplete='off' onkeypress="return hanyaAngka(event)" autocomplete='off required oninvalid="this.setCustomValidity('User Name Harus Diisi...')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Dokumen Perkara<span style="color:red;">*</span></label>
							<div class="col-8">
								<input class="form-control" type="hidden" value="{{$data->file}}" name="file_1"  title="Dokumen" accept=".pdf,.jpg,.jpeg">
								<input class="form-control" type="file" value="{{$data->file}}" name="file"  title="Dokumen" accept=".pdf,.jpg,.jpeg">
								@if(count($errors) > 0)
									@foreach ($errors->all() as $error)
									<span style="color:red;">Frotmat harus pdf or jpg</span>
									@endforeach
								@else
									<span>Frotmat file pdf or jpg size 2 MB</span>
								@endif
							</div>
						</div>
						
												
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('data_perkara.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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

		

		$('#form-create').submit(function(){
			$.ajax({
				url  : "{{route('data_perkara.store')}}",
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
						window.location.replace("{{ route('data_perkara.index') }}");
						});
				}else{
					Swal.fire({
						type  : 'info',
						title : 'User ID '+data+' Sudah Ada.',
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
</script>

@endsection
