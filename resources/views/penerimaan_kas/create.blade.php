@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Perbendaharaan - Kas/Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
				Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan - Kas/Bank </a>
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
					Menu Tambah Perbendaharaan - Kas/Bank
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
		<div class="card-body table-responsive" >
			<!--begin: Datatable -->
			<form  class="kt-form kt-form--label-right" id="form-create">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Menu Tambah Perbendaharaan - Kas/Bank
								</h5>	
							</div>
						</div>
					
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">No.Dokumen</label>
							<div class="col-10">
								<input type="hidden" class="form-control"  value="{{date('Y-m-d')}}" size="1" maxlength="1" name="tanggal" id="tanggal" readonly style="background-color:#DCDCDC; cursor:not-allowed"></td>
								<input type="text" class="form-control"  value="{{$request->mp}}" size="1" maxlength="1" name="mp" id="mp" readonly style="background-color:#DCDCDC; cursor:not-allowed"></td>
							</div>
						</div>

						<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
						<div class="col-4">
							<input class="form-control" type="text" value="{{$bulan}}"   name="bulan" id="bulan" size="2" maxlength="2" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							<input class="form-control" type="hidden" value="{{$bulan_buku}}"   name="bulanbuku" id="bulanbuku" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							
						</div>
							<div class="col-6" >
								<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" id="tahun" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
								<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
							</div>
						</div>

						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Bagian<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="bagian" id="bagian" class="form-control kt-select2" style="width: 100% !important;" required oninvalid="this.setCustomValidity('Bagian Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									@foreach($data_bagian as $data)
									<option value="{{$data->kode}}">{{$data->kode}} - {{$data->nama}}</option>
									@endforeach
									
								</select>
									<input class="form-control" type="hidden" value=""   name="nomor" id="nomor" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
						</div>

						<div class="form-group row">
							<label class="col-2 col-form-label">Jenis Kartu<span style="color:red;">*</span></label>
							<div class="col-3">
								<select name="jk" id="jk" class="form-control kt-select2" style="width: 100% !important;" required oninvalid="this.setCustomValidity('Jenis Kartu Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									<option value="10">Kas(Rupiah)</option>
									<option value="11">Bank(Rupiah)</option>
									<option value="13">Bank(Dollar)</option>
									
								</select>							</div>
							<label class="col-2 col-form-label">Currency Index</label>
							<div class="col-2" >
								<input class="form-control" type="text" name="ci" value=""  id="ci" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							<label class="col-1 col-form-label">Kurs<span style="color:red;">*</span></label>
							<div class="col-2" >
								<input class="form-control" type="text" name="kurs" value=""  id="kurs" size="7" maxlength="7" >
							</div>
						</div>
						
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Lokasi<span style="color:red;">*</span></label>
							<div class="col-4">
								<select name="lokasi" id="lokasi" class="form-control kt-select2" style="width: 100% !important;" required oninvalid="this.setCustomValidity('Lokasi Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									
								</select>
							</div>
							@if($request->mp == 'P')
							<label class="col-1 col-form-label">No Bukti</label>
							<div class="col-2" >
								<input class="form-control" type="text" name="nobukti" value=""  id="nobukti" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							<label class="col-1 col-form-label">No Ver</label>
							<div class="col-2" >
								<input class="form-control" type="text" name="nover" value="{{$nover}}"  id="nover" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							@else
							<label class="col-1 col-form-label">No Bukti</label>
							<div class="col-5" >
								<input class="form-control" type="text" name="nobukti" value=""  id="nobukti" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							<div class="col-1" >
								<input class="form-control" type="hidden" name="nover" value="{{$nover}}"  id="nover" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
							@endif
						</div>

						<div class="form-group row">
							<label class="col-2 col-form-label">
							@if($request->mp == "M") {{$darkep}} @else {{$darkep}} @endif<span style="color:red;">*</span></label>
							<div class="col-10">
							<select class="kepada form-control" style="width: 100% !important;" name="kepada" ></select>
								<!-- <input class="form-control" type="text" name="kepada" id="kepada" value="" size="40" maxlength="40" required oninvalid="this.setCustomValidity('{{$darkep}} Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'> -->
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Sejumlah</label>
							<div class="col-10">
								<input class="form-control" type="text" name="nilai" id="nilai" value="0" size="16" maxlength="16" autocomplete='off' readonly>
								<input class="form-control" type="hidden" name="iklan" value=""  id="iklan" size="4" maxlength="4" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Catatan 1</label>
							<div class="col-10">
								<textarea class="form-control" type="text" name="ket1" id="ket1"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Catatan 2</label>
							<div class="col-10">
								<textarea class="form-control" type="text" name="ket2" id="ket2"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">Catatan 3</label>
							<div class="col-10">
								<textarea class="form-control" type="text" name="ket3" id="ket3"></textarea>
							</div>
						</div>
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('penerimaan_kas.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
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
							Detail Perbendaharaan - Kas/Bank
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
								<th>No</th>
								<th>Rincian</th>	
								<th>KL</th>
								<th>Sanper</th>
								<th>Bagian</th>
								<th>PK</th>
								<th>JB</th>
								<th>Jumlah</th>
								<th>CJ</th>	
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
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		$('.kt-select2').select2().on('change', function() {
			// $(this).valid();
		});
		$("#jk").on("change", function(){ 
		var ci = $(this).val();
		console.log(ci);
		if(ci != 13)
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
	var mp = $("#mp").val();
	var bagian = $("#bagian").val();
	var nomor = $("#nomor").val();
	var scurrdoc = mp+'-'+bagian+'-'+nomor;

	$.ajax({
		url  : "{{route('penerimaan_kas.store')}}",
		type : "POST",
		data : $('#form-create').serialize(),
		dataType : "JSON",
		headers: {
		'X-CSRF-Token': '{{ csrf_token() }}',
		},
		success : function(data){
		console.log(data);
		if(data == 1){
			Swal.fire({
				type  : 'success',
				title : 'Data Berhasil Ditambah',
				text  : 'Berhasil',
				timer : 2000
			}).then(function() {
				location.replace("{{url('perbendaharaan/penerimaan_kas/edit')}}"+ '/' +scurrdoc);
				});
		}else if(data = 2){
			Swal.fire({
				type  : 'info',
				title : 'Bulan Buku Tidak Ada Atau Sudah Di Posting.',
				text  : 'Failed',
			});
		}else{
			Swal.fire({
				type  : 'info',
				title : 'Data Yang Diinput Sudah Ada.',
				text  : 'Failed',
			});
		}
		}, 
		error : function(){
			alert("Terjadi kesalahan, coba lagi nanti");
		}
	});	
	return false;
});

$("#bagian").on("change", function(){
var bagian = $('#bagian').val();
var mp = $('#mp').val();
var bulan = $('#bulan').val();
var bulanbuku = $('#bulanbuku').val();
	$.ajax({
		url : "{{route('penerimaan_kas.createJson')}}",
		type : "POST",
		dataType: 'json',
		data : {
			bagian:bagian,
			mp:mp,
			bulanbuku:bulanbuku
			},
		headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
			},
		success : function(data){
			var tahun = bulanbuku.substr(2,2);
			var nodata = tahun+''+bulan+''+data;
			var nomor = parseInt(nodata)+parseInt(1);
			$("#nomor").val(nomor);
		},
		error : function(){
			alert("Ada kesalahan controller!");
		}
	})
});

$("#jk").on("change", function(){
var jk = $('#jk').val();
	if(jk == '13'){
		$("#ci").val('2');
		$("#kurs").val('0');
		$("#jnskas").val('2');
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	} else if (jk == '11'){
		$("#ci").val('1');
		$("#kurs").val('1');
		$("#jnskas").val('2');
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	}else if (jk == '10'){
		$("#ci").val('1');
		$("#kurs").val('1');
		$("#jnskas").val('1');
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	}else{
		$("#ci").val("");
		$("#kurs").val("");
		$("#jnskas").val("");
		$("#nokas").val("");
		$("#nobukti1").val("");
		$("#nama_kas").val("");
	}	

	var ci = $('#ci').val();

	$.ajax({
		url : "{{route('penerimaan_kas.lokasiJson')}}",
		type : "POST",
		dataType: 'json',
		data : {
			jk:jk,
			ci:ci
			},
		headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
			},
		success : function(data){
					var html = '';
                    var i;
						html += '<option value="">- Pilih - </option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].kodestore+'">'+data[i].namabank+'-'+data[i].norekening+'</option>';
                    }
                    $('#lokasi').html(html);		
		},
		error : function(){
			alert("Ada kesalahan controller!");
		}
	})
});

$("#lokasi").on("change", function(){
var lokasi = $('#lokasi').val();
var mp = $('#mp').val();
var tahun = $('#tahun').val();

	$.ajax({
		url : "{{route('penerimaan_kas.nobuktiJson')}}",
		type : "POST",
		dataType: 'json',
		data : {
			lokasi:lokasi,
			mp:mp,
			tahun:tahun
			},
		headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
			},
		success : function(data){
		var nobukti = data;
			$("#nobukti").val(nobukti);
		},
		error : function(){
			alert("Ada kesalahan controller!");
		}
	})
});


 $('.kepada').select2({
	placeholder: '-Pilih-',
	allowClear: true,
	tags: true,
	ajax: {
		url: "{{route('penerimaan_kas.kepadaJson')}}",
		type : "post",
		dataType : "JSON",
		headers: {
		'X-CSRF-Token': '{{ csrf_token() }}',
		},
		delay: 250,
	processResults: function (data) {
		console.log(data.length);
		return {
		results:  $.map(data, function (item) {
			return {
			text: item.kepada,
			id: item.kepada
			}
		})
		};
	},
	cache: true
	}
});

$('#nilai').keyup(function(){
	var nilai = $('#nilai').val();
	if(nilai < '0'){
		$("#iklan").val('CR');
	}else if(nilai > '0'){
		$("#iklan").val('DR');
	}else{
		$("#iklan").val('');
	}
});

    var KTBootstrapDatepicker = function () {

var arrows;
if (KTUtil.isRTL()) {
	arrows = {
		leftArrow: '<i class="la la-angle-right"></i>',
		rightArrow: '<i class="la la-angle-left"></i>'
	}
} else {
	arrows = {
		leftArrow: '<i class="la la-angle-left"></i>',
		rightArrow: '<i class="la la-angle-right"></i>'
	}
}

// Private functions
var demos = function () {



	// minimum setup
	$('#tanggal').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'yyyy-mm-dd'
	});
	
	$('#bulanbuku').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'yyyymm'
	});
};

return {
	// public functions
	init: function() {
		demos(); 
	}
};
}();

KTBootstrapDatepicker.init();
});

		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
