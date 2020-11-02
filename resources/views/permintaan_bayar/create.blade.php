@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Permintaan Bayar </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Permintaan Bayar </a>
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
					Tambah Permintaan Bayar
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<!--begin: Datatable -->
			<form  class="kt-form kt-form--label-right" id="form-create-permintaan-bayar">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Permintaan Bayar
								</h5>	
							</div>
						</div>
					
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">No. Permintaan</label>
							<div class="col-5">
							<?php $data_no_bayar = str_replace('/', '-', $permintaan_header_count); ?>
								<input  class="form-control" type="hidden" value="{{$data_no_bayar}}" id="noumk"  size="25" maxlength="25" readonly>
								<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" name="nobayar" value="{{ $permintaan_header_count }}" id="nobayar" readonly>
							</div>

							<label for="spd-input" class="col-2 col-form-label">Tanggal</label>
							<div class="col-3">
								<input class="form-control" type="text" name="tanggal" id="tanggal" value="{{ date('d-m-Y') }}">
							</div>
						</div>
						<div class="form-group row">
							<label for="nopek-input" class="col-2 col-form-label">Terlampir</label>
							<div class="col-10">
								<textarea class="form-control" type="text" name="lampiran" value=""  id="lampiran" onkeyup="this.value = this.value.toUpperCase()"  required oninvalid="this.setCustomValidity('Terlampir Harus Diisi..')" oninput="setCustomValidity('')">-</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="id-pekerja;-input" class="col-2 col-form-label">Keterangan</label>
							<div class="col-10">
								<textarea class="form-control" type="text" value=""  id="keterangan" name="keterangan" size="50" maxlength="200" onkeyup="this.value = this.value.toUpperCase()" required oninvalid="this.setCustomValidity('Keterangan Harus Diisi..')" oninput="setCustomValidity('')">-</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Dibayar Kepada<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="dibayar" id="dibayar" class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Dibayar Kepada Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									@foreach ($vendor as $row)
									<option value="{{ $row->nama }}">{{ $row->nama }}</option>
									@endforeach
								</select>
								<input name="rekyes" type="hidden" id="rekyes" value="1"></td>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Rekening Bank</label>
							<div class="col-10">
								<input style=" width: 17px;height: 26px;margin-left:50px;" name="rekyes" type="checkbox"  id="rekyes" value="1"></td>
							</div>
						</div>
						<div class="form-group row">
							<label for="dari-input" class="col-2 col-form-label">Debet Dari</label>
							<div class="col-10">
								<select name="debetdari" id="select-debetdari" class="form-control selectpicker" data-live-search="true" >
									<option value="">- Pilih -</option>
									@foreach ($debit_nota as $row)
									<option value="{{ $row->kode }}">{{ $row->kode.' - '.$row->keterangan }}</option>
									@endforeach
								</select>
								
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">No. Debet</label>
							<div class="col-5">
								<input class="form-control" type="text" name="nodebet" id="nodebet" value="-" size="15" maxlength="15" onkeyup="this.value = this.value.toUpperCase()" autocomplete='off'>
							</div>
							<label class="col-2 col-form-label">Tgl Debet</label>
							<div class="col-3" >
								<input class="form-control" type="text" name="tgldebet" value="{{ date('d-m-Y') }}"  id="tgldebet" size="15" maxlength="15" autocomplete='off' >
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input"  class="col-2 col-form-label">No. Kas</label>
							<div class="col-5">
								<input style="background-color:#DCDCDC; cursor:not-allowed" readonly  class="form-control" name="nokas" type="text" value="" id="nokas" size="10" maxlength="25" autocomplete='off'>
							</div>
							<label for="spd-input"  class="col-2 col-form-label">Bulan Buku<span style="color:red;">*</span></label>
							<div class="col-3" >
								<input style="background-color:#DCDCDC; cursor:not-allowed" readonly class="form-control" type="text" value="{{$bulan_buku}}"   name="bulanbuku" size="6" maxlength="6"  >
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">CI</label>
							<div class="col-5">
								<label class="kt-radio kt-radio--solid">
									<input  value="1" type="radio"  name="ci" onclick="displayResult(1)"  checked> IDR
									<span></span>
								</label>
								<label style="margin-left:50px;" class="kt-radio kt-radio--solid">
									<input  value="2" type="radio"    name="ci"  onclick="displayResult(2)"> USD
									<span></span>
								</label>
							</div>
							<label for="spd-input" class="col-2 col-form-label">Kurs<span style="color:red;display:none" id="simbol-kurs">*</span></label>
							<div class="col-3">
								<input class="form-control" type="text" value="1" name="kurs" id="kurs" size="10" maxlength="10" autocomplete='off' onkeypress="return hanyaAngka(event)" >
							</div>
						</div>
						<div class="form-group row">
							<label for="mulai-input" class="col-2 col-form-label">Periode <span style="color:red;">*</span></label>
							<div class="col-10">
								<div class="input-daterange input-group" id="date_range_picker">
									<input type="text" class="form-control" name="mulai" value="{{ date('d-m-Y') }}" required autocomplete='off' oninvalid="this.setCustomValidity('Priode Harus Diisi..')" onchange="setCustomValidity('')"/>
									<div class="input-group-append">
										<span class="input-group-text">s/d</span>
									</div>
									<input type="text" class="form-control" name="sampai" value="{{ date('d-m-Y') }}" required autocomplete='off' oninvalid="this.setCustomValidity('Priode Harus Diisi..')" onchange="setCustomValidity('')"/>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Total Nilai</label>
							<div class="col-10">
								<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" value="0" readonly>
								<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" name="totalnilai" type="hidden" value="" id="totalnilai"  readonly>
							</div>
						</div>
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('permintaan_bayar.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				

					
				<div class="kt-portlet__head kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon2-line-chart"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Detail Permintaan Bayar
						</h3>			
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<span style="font-size: 2em;cursor:not-allowed" class="kt-font-success">
										<i class="fas fa-plus-circle"></i>
									</span>
				
									<span style="font-size: 2em;cursor:not-allowed" class="kt-font-warning">
										<i class="fas fa-edit"></i>
									</span>
				
									<span style="font-size: 2em;cursor:not-allowed" class="kt-font-danger">
										<i class="fas fa-times-circle"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<table class="table table-striped table-bordered table-hover table-checkable" id="tabel-detail-permintaan">
						<thead class="thead-light">
							<tr>
								<th ><input type="radio" hidden name="btn-radio"  data-id="1" class="btn-radio" checked ></th>
								<th >No.</th>
								<th >Keterangan</th>
								<th >Bagian</th>
								<th >Account</th>
								<th >JB</th>
								<th >PK</th>
								<th >CJ</th>
								<th >Jumlah</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</form>
			<!--end: Datatable -->
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


		


		$('#form-create-permintaan-bayar').submit(function(){
        	var no_umk = $("#noumk").val();
			$.ajax({
				url  : "{{route('permintaan_bayar.store')}}",
				type : "POST",
				data : $('#form-create-permintaan-bayar').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
				console.log(data);
				Swal.fire({
					type  : 'success',
					title : 'Data Berhasil Ditambah',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
						window.location.replace("{{ route('permintaan_bayar.edit', ['no' => $data_no_bayar] ) }}");
					});
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});
	

   
	// range picker
	$('#date_range_picker').datepicker({
		todayHighlight: true,
		autoclose: true,
		// language : 'id',
		format   : 'dd-mm-yyyy'
	});

	// minimum setup
	$('#tanggal').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'dd-mm-yyyy'
	});
	// minimum setup
	$('#tgldebet').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'dd-mm-yyyy'
	});
	$('#bulanbuku').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'yyyymm'
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
