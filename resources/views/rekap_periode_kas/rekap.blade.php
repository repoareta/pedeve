@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Mencetak Periode Kas Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Mencetak Periode Kas Bank</span>
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
				Tabel Mencetak Periode Kas Bank
			</h3>			
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<form class="kt-form kt-form--label-right" action="{{route('rekap_periode_kas.exportperiode')}}" method="post">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group row">
					<label for="dari-input" class="col-2 col-form-label">Mulai Tanggal<span style="color:red;">*</span></label>
					<div class="col-10">
						<div class="input-daterange input-group" id="date_range_picker">
							<input type="text" class="form-control" name="tanggal" id="tanggal" autocomplete="off" required oninvalid="this.setCustomValidity('Mulai Harus Diisi..')" onchange="setCustomValidity('')"/>
							<div class="input-group-append">
								<span class="input-group-text">Sampai</span>
							</div>
							<input type="text" class="form-control" name="tanggal2" id="tanggal2" autocomplete="off" required oninvalid="this.setCustomValidity('Sampai Harus Diisi..')" onchange="setCustomValidity('')"/>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="dari-input" class="col-2 col-form-label">Jenis Kartu<span style="color:red;">*</span></label>
					<div class="col-10">
						<select class="form-control kt-select2"  name="jk" id="jk" required oninvalid="this.setCustomValidity('Jenis Kartu Harus Diisi..')" onchange="setCustomValidity('')">
							<option value="">- Pilih -</option>
						</select>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="dari-input" class="col-2 col-form-label">No.Kas/Bank<span style="color:red;">*</span></label>
					<div class="col-10">
						<select class="form-control kt-select2"  name="nokas" id="nokas" required oninvalid="this.setCustomValidity('No.Kas/Bank Harus Diisi..')" onchange="setCustomValidity('')">
							<option value="">- Pilih -</option>
						</select>
					</div>
				</div>
				
				<div class="form-group row">
				<label class="col-2 col-form-label">Setuju<span style="color:red;">*</span></label>
				<div class="col-4">
					<input class="form-control" type="text" value="" name="setuju" id="setuju" size="50" maxlength="50" required oninvalid="this.setCustomValidity('Setuju Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
				</div>
				<label class="col-2 col-form-label">Dibuat Oleh<span style="color:red;">*</span></label>
				<div class="col-4" >
					<input class="form-control" type="text" value="" name="dibuat" id="dibuat" size="50" maxlength="50" required oninvalid="this.setCustomValidity('Dibuat Oleh Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
				</div>
			</div>
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-10">
							<a  href="#" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
							<button type="submit" id="btn-save" onclick="$('form').attr('target', '_blank')" class="btn btn-brand"><i class="fa fa-print" aria-hidden="true"></i>Cetak</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function () {

	$('.kt-select2').select2().on('change', function() {
			$(this).valid();
	});
   
	$('#date_range_picker').datepicker({
		todayHighlight: true,
		autoclose: true,
        format   : 'yyyy-mm-dd',
	});
	

	$("#tanggal").on("change", function(e){
		e.preventDefault();
		var tanggal = $('#tanggal').val();
		var tanggal2 = $('#tanggal2').val();
		$.ajax({
			url : "{{route('rekap_periode_kas.jk.json')}}",
			type : "POST",
			dataType: 'json',
			data : {
				tanggal:tanggal,
				tanggal2:tanggal2,
				},
			headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
			success : function(data){
						var html = '';
						var i;
						html += '<option value="">- Pilih - </option>';
						for(i=0; i<data.length; i++){
							html += '<option value="'+data[i].jk+'">'+data[i].jk+'</option>';
						}
						$('#jk').html(html);		
			},
			error : function(){
				alert("Ada kesalahan controller!");
			}
		})
	});

	$("#tanggal2").on("change", function(e){
		e.preventDefault();
		var tanggal = $('#tanggal').val();
		var tanggal2 = $('#tanggal2').val();
		$.ajax({
			url : "{{route('rekap_periode_kas.jk.json')}}",
			type : "POST",
			dataType: 'json',
			data : {
				tanggal:tanggal,
				tanggal2:tanggal2,
				},
			headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
			success : function(data){
						var html = '';
						var i;
						html += '<option value="">- Pilih - </option>';
						for(i=0; i<data.length; i++){
							html += '<option value="'+data[i].jk+'">'+data[i].jk+'</option>';
						}
						$('#jk').html(html);		
			},
			error : function(){
				alert("Ada kesalahan controller!");
			}
		})
	});

	$("#jk").on("change", function(e){
		e.preventDefault();
		var tanggal = $('#tanggal').val();
		var tanggal2 = $('#tanggal2').val();
		var jk = $('#jk').val();
		$.ajax({
			url : "{{route('rekap_periode_kas.nokas.json')}}",
			type : "POST",
			dataType: 'json',
			data : {
				tanggal:tanggal,
				tanggal2:tanggal2,
				jk:jk
				},
			headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
			success : function(data){
						var html = '';
						var i;
						html += '<option value="">- Pilih - </option>';
						for(i=0; i<data.length; i++){
							html += '<option value="'+data[i].store+'">'+data[i].store+' -- '+data[i].namabank+' -- '+data[i].norekening+'</option>';
						}
						$('#nokas').html(html);		
			},
			error : function(){
				alert("Ada kesalahan controller!");
			}
		})
	});
});
		function hanyaAngka(evt) {
			  var charCode = (evt.which) ? evt.which : event.keyCode
			   if (charCode > 31 && (charCode < 48 || charCode > 57))
	 
				return false;
			  return true;
			}
</script>
@endsection