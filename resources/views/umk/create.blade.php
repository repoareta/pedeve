@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Uang muka Kerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Uang Muka Kerja </a>
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
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Tambah Uang Muka Kerja
				</h3>
			</div>
		</div>
		<!--begin: Datatable -->
		<form  class="kt-form kt-form--label-right" id="form-create-umk">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							<h5 class="kt-portlet__head-title">
								Header Uang Muka Kerja
							</h5>	
						</div>
					</div>
				
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. UMK<span style="color:red;">*</span></label>
						<div class="col-10">
							<?php $data_no_umk = str_replace('/', '-', $no_umk); ?>
							<input  class="form-control" type="hidden" value="{{$data_no_umk}}" id="noumk"  size="25" maxlength="25" readonly>
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$no_umk}}"  name="no_umk" size="25" maxlength="25" readonly required>
						</div>
					</div>
					<div class="form-group row">
						<label for="nopek-input" class="col-2 col-form-label">Tanggal<span style="color:red;">*</span></label>
						<div class="col-10">
							<input class="form-control" type="text" name="tgl_panjar" value="{{ date('d-m-Y') }}" id="datepicker" id="tgl_panjar" size="15" maxlength="15" required>

						</div>
					</div>
					<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Dibayar Kepada<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="kepada" id="kepada" class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Dibayar Kepada Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									@foreach ($vendor as $row)
									<option value="{{ $row->nama }}">{{ $row->nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					<div class="form-group row">
						<label for="example-email-input" class="col-2 col-form-label">Jenis Uang Muka<span style="color:red;">*</span></label>
						<div class="col-6">
							<label class="kt-radio kt-radio--solid">
								<input value="K" type="radio"  name="jenis_um" checked> Uang Muka Kerja
								<span></span>
							</label>
							<label style="margin-left:50px;" class="kt-radio kt-radio--solid">
								<input value="D" type="radio"   name="jenis_um"> Uang Muka Dinas
								<span></span>
							</label>
						</div>
					</div>
					<div class="form-group row">
						<label for="id-pekerja;-input" class="col-2 col-form-label">Bulan Buku<span style="color:red;">*</span></label>
						<div class="col-10">
							<input class="form-control" type="text"  value="{{$bulan_buku}}"  name="bulan_buku" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed" >
						</div>
					</div>
					<div class="form-group row">
						<label for="dari-input" class="col-2 col-form-label">Mata Uang<span style="color:red;">*</span></label>
						<div class="col-10">
							<label class="kt-radio kt-radio--solid">
								<input value="1" type="radio"  name="ci" checked> IDR
								<span></span>
							</label>
							<label style="margin-left:50px;" class="kt-radio kt-radio--solid">
								<input value="2" type="radio"    name="ci"> USD
								<span></span>
							</label>
						</div>
					</div>
					<div class="form-group row">
						<label for="tujuan-input" class="col-2 col-form-label">Kurs <span style="color:red;display:none" id="simbol-kurs">*</span></label>
						<div class="col-10">
							<input class="form-control" type="text" value="1" name="kurs" id="kurs" readonly  size="10" maxlength="10" autocomplete='off' onkeypress="return hanyaAngka(event)" oninvalid="this.setCustomValidity('Kurs Harus Diisi..')" oninput="setCustomValidity('')" >
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-2 col-form-label">Untuk<span style="color:red;">*</span></label>
						<div class="col-10">
							<textarea  class="form-control" type="text" value="" name="untuk" id="untuk" size="70" maxlength="200" onkeyup="this.value = this.value.toUpperCase()" required oninvalid="this.setCustomValidity('Untuk Harus Diisi..')" oninput="setCustomValidity('')"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-2 col-form-label">Jumlah</label>
						<div class="col-10">
							<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" value="Rp. 0"  readonly>
							<input class="form-control" type="hidden" value="0" name="jumlah" id="jumlah" size="70" maxlength="200" readonly>
						</div>
					</div>
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<a  href="{{route('uang_muka_kerja.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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
						Detail Uang Muka Kerja
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
				<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
					<thead class="thead-light">
						<tr>
							<th ><input type="radio" hidden name="btn-radio"  data-id="1" class="btn-radio" checked ></th>
							<th >No.</th>
							<th >Keterangan</th>
							<th >Account</th>
							<th >Bagian</th>
							<th >PK</th>
							<th >JB</th>
							<th >KK</th>
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
		$('#kt_table').DataTable({
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

	// minimum setup
	$('#datepicker').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'dd-mm-yyyy'
	});
	// minimum setup
	$('#bulan_buku').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'yyyymm'
	});

	//create
	$('#form-create-umk').submit(function(){
        var no_umk = $("#noumk").val();
		$.ajax({
			url  : "{{route('uang_muka_kerja.store')}}",
			type : "POST",
			data : $('#form-create-umk').serialize(),
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
					window.location.replace("{{ route('uang_muka_kerja.edit', ['no' => $data_no_umk]) }}");
				});
			}, 
			error : function(){
				alert("Terjadi kesalahan, coba lagi nanti");
			}
		});	
		return false;
	});

	function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
