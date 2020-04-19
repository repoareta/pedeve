@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Inisialisasi Saldo </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
				Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Inisialisasi Saldo </a>
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
					Menu Edit Inisialisasi Saldo
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
									Header Menu Edit Inisialisasi Saldo
								</h5>	
							</div>
						</div>
						@foreach($data_list as $data)
						<div class="form-group row">
							<label class="col-2 col-form-label">Jenis Kartu<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="jk" id="jk" class="form-control selectpicker" data-live-search="true" required>
									<option value="">- Pilih -</option>
									<option value="10" <?php if($data->jk == '10' ) echo 'selected' ; ?>>Kas(Rupiah)</option>
									<option value="11" <?php if($data->jk == '11' ) echo 'selected' ; ?>>Bank(Rupiah)</option>
									<option value="13" <?php if($data->jk == '13' ) echo 'selected' ; ?>>Bank(Dollar)</option>
									
								</select>							
							</div>
						</div>

						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Nokas<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="nokas" id="nokas" class="form-control" data-live-search="true" required>
									<option value="">- Pilih -</option>									
								</select>
									<input class="form-control" type="hidden" value="{{$data->nokas}}"   name="nokas1" id="nokas1" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
									<input class="form-control" type="hidden" value="{{$data->namabank}}  -  {{$data->norekening}}"   name="nokas2" id="nokas2" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
							</div>
						</div>
						<div class="form-group row">
							<label for="mulai-input" class="col-2 col-form-label">Saldo Akhir<span style="color:red;">*</span></label>
							<div class="col-10">
								<div class="input-daterange input-group" >
									<input type="text" class="form-control" name="saldoakhir"  value="" required  autocomplete='off' onkeypress="return hanyaAngka(event)"/>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="mulai-input" class="col-2 col-form-label">Tanggal Input<span style="color:red;">*</span></label>
							<div class="col-10">
								<div class="input-daterange input-group" >
									<input type="text" class="form-control" name="tanggal" id="tanggal" value="" size="30" maxlength="30" required  autocomplete='off'/>
								</div>
							</div>
						</div>
						@endforeach
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('inisialisasi_saldo.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
								</div>
							</div>
						</div>
					</div>
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
		var jk = $('#jk').val();
		var nokas1 = $('#nokas1').val();
		var nokas2 = $('#nokas2').val();

	$.ajax({
		url : "{{route('inisialisasi_saldo.nokas.json')}}",
		type : "POST",
		dataType: 'json',
		data : {
			jk:jk,
			},
		headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
			},
		success : function(data){
					var html = '';
                    var i;
					html += '<option value="'+nokas1+'">'+nokas2+'</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].kodestore+'">'+data[i].namabank+'-'+data[i].norekening+'</option>';
                    }
                    $('#nokas').html(html);		
		},
		error : function(){
			alert("Ada kesalahan controller!");
		}
	})

$('#form-create').submit(function(){
	$.ajax({
		url  : "{{route('inisialisasi_saldo.store')}}",
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
				title : 'Data Berhasil DiEdit',
				text  : 'Berhasil',
				timer : 2000
			}).then(function() {
				window.location.replace("{{ route('inisialisasi_saldo.index') }}");;
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

	$("#jk").on("change", function(){
	var jk = $('#jk').val();

	$.ajax({
		url : "{{route('inisialisasi_saldo.nokas.json')}}",
		type : "POST",
		dataType: 'json',
		data : {
			jk:jk,
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
                    $('#nokas').html(html);		
		},
		error : function(){
			alert("Ada kesalahan controller!");
		}
	})
});


$('#tanggal').datepicker({
			todayHighlight: true,
			// autoclose: true,
			// language : 'id',
			format   : 'yyyy-mm-dd'
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
