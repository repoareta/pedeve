@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Uang Muka Kerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Uang Muka Kerja</span>
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
				Tabel Uang Muka Kerja
			</h3>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
							<a href="{{ route('uang_muka_kerja.create') }}">
								<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
									<i class="fas fa-plus-circle"></i>
								</span>
							</a>
							<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
								<i class="fas fa-edit" id="btn-edit-umk"></i>
							</span>

							<span style="font-size: 2em;"  class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
								<i class="fas fa-times-circle" id="deleteRow"></i>
							</span>

							<span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
								<i class="fas fa-print" id="reportRow"></i>
							</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="">
			<form class="kt-form" id="search-form" >
				<div class="form-group row col-12">
					<label for="" class="col-form-label">No. UMK</label>
					<div class="col-2">
						<input class="form-control" type="text" name="permintaan" value="" size="18" maxlength="18">
					</div>
					<label for="" class="col-form-label">Bulan</label>
					<div class="col-2">
						<?php 
							$tgl = date_create(now());
							$tahun = date_format($tgl, 'Y'); 
						?>
						<select name="bulan" class="form-control selectpicker" data-live-search="true">
							<option value="" >-- Pilih --</option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
					</div>
	
					<label for="" class="col-form-label">Tahun</label>
					<div class="col-2">
						<input class="form-control" type="text" name="tahun" value="{{$tahun}}" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off'>
					</div>
					<div class="col-2">
						<button type="submit" class="btn btn-brand"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
					</div>
				</div>
			</form>
		</div>
		<!--begin: Datatable -->
		<table id="data-umk-table" class="table table-striped table-bordered table-hover table-checkable" width="100%">
			<thead class="thead-light">
				<tr>
					<th><input type="radio" hidden name="btn-radio"  data-id="1" class="btn-radio" checked ></th>
					<th>Tanggal</th>
					<th>No UMK</th>
					<th>No Kas/Bank</th>
					<th>Jenis</th>
					<th>Keterangan</th>
					<th>Nilai</th>
					<th>Approval</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

		<!--end: Datatable -->
		</div>
	</div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
	var t =$('#data-umk-table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			searching: false,
			lengthChange: false,
			language: {
            	processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax      : {
				url: "{{ route('uang_muka_kerja.search.index') }}",
				type : "POST",
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				data: function (d) {
					d.permintaan = $('input[name=permintaan]').val();
					d.bulan = $('select[name=bulan]').val();
					d.tahun = $('input[name=tahun]').val();
				}
			},
	columns: [
		{data: 'radio', name: 'radio'},
		{data: 'tgl_panjar', name: 'tgl_panjar'},
		{data: 'no_umk', name: 'no_umk'},
		{data: 'no_kas', name: 'no_kas'},
		{data: 'jenis_um', name: 'jenis_um'},
		{data: 'keterangan', name: 'keterangan'},
		{data: 'jumlah', name: 'jumlah'},
		{data: 'action', name: 'action'},
	]
			
		});
		$('#search-form').on('submit', function(e) {
			t.draw();
			e.preventDefault();
		});
});

//report Uang Muka Kerja 
$('#reportRow').on('click', function(e) {
	e.preventDefault();

var allVals = [];  
$(".btn-radio:checked").each(function() {  
	e.preventDefault();
	var dataid = $(this).attr('data-id');
	var dataa = $(this).attr('dataumk');

	if(dataid == 1) 
	{
		swalAlertInit('cetak'); 
	}  else { 
		location.replace("{{url('umum/uang_muka_kerja/rekap')}}"+ '/' +dataid);
	}	
				
});
});

//refresh data
$('#show-data').on('click', function(e) {
	e.preventDefault();
		location.replace("{{ route('uang_muka_kerja.index') }}");

});


//edit
$('#btn-edit-umk').on('click', function(e) {
	e.preventDefault();
var allVals = [];  
$(".btn-radio:checked").each(function() {  
	e.preventDefault();
	var dataid = $(this).attr('data-id');
	var dataa = $(this).attr('data-umk-table');

	if(dataid == 1) 
	{
		swalAlertInit('ubah');  
	}  else {  
		location.replace("{{url('umum/uang_muka_kerja/edit')}}"+ '/' +dataid);
	}	
				
});
});



//delete
//delete
$('#deleteRow').click(function(e) {
			e.preventDefault();
			$(".btn-radio:checked").each(function() {  
				var dataid = $(this).attr('data-id');
				if(dataid == 1)  
				{  
					swalAlertInit('hapus'); 
				}  else { 
					$("input[type=radio]:checked").each(function() {
						var id = $(this).attr('dataumk');
						var status = $(this).attr('data-s');
						// delete stuff
						if(status == 'Y'){
							Swal.fire({
										type  : 'info',
										title : 'Data Tidak Bisa Dihapus, Data Sudah di Proses Perbendaharaan.',
										text  : 'Failed',
									});
						}else{
							const swalWithBootstrapButtons = Swal.mixin({
							customClass: {
								confirmButton: 'btn btn-primary',
								cancelButton: 'btn btn-danger'
							},
								buttonsStyling: false
							})
							swalWithBootstrapButtons.fire({
								title: "Data yang akan dihapus?",
								text: "No. UMK : " + id,
								type: 'warning',
								showCancelButton: true,
								reverseButtons: true,
								confirmButtonText: 'Ya, hapus',
								cancelButtonText: 'Batalkan'
							})
							.then((result) => {
							if (result.value) {
								$.ajax({
									url: "{{ route('uang_muka_kerja.delete') }}",
									type: 'DELETE',
									dataType: 'json',
									data: {
										"id": id,
										"_token": "{{ csrf_token() }}",
									},
									success: function () {
										Swal.fire({
											type  : 'success',
											title : 'Hapus No. UMK ' + id,
											text  : 'Berhasil',
											timer : 2000
										}).then(function() {
											location.reload();
										});
									},
									error: function () {
										alert("Terjadi kesalahan, coba lagi nanti");
									}
								});
							}
						});
					}
				});
			} 
			
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