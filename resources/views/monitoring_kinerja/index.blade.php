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
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Monitoring Kinerja</span>
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
				Tabel Monitoring Kinerja
			</h3>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{ route('monitoring_kinerja.create') }}">
							<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
		
							<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
								<i class="fas fa-edit" id="editRow"></i>
							</span>
		
							<span style="font-size: 2em;"  class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
								<i class="fas fa-times-circle" id="deleteRow"></i>
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
					<label for="" class="col-form-label">Bulan</label>
					<div class="col-2">
						<?php 
							$tgl = date_create(now());
							$bulan = date_format($tgl, 'm'); 
							$tahun = date_format($tgl, 'Y'); 
							$array_bln	 = array (
								1 =>   'Januari',
								'Februari',
								'Maret',
								'April',
								'Mei',
								'Juni',
								'Juli',
								'Agustus',
								'September',
								'Oktober',
								'November',
								'Desember'
							);
							
							$bulan_1 = ($array_bln[ltrim($bulan,0)]);
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
		<table id="data-monitoring_kinerja" class="table table-striped table-bordered table-hover table-checkable" style="background-color:#ECF3F3;" >
			<thead  style="text-align:center;vertical-align:middle;">
				<tr >
					<th style="vertical-align:middle;" rowspan="3">No</th>
					<th style="vertical-align:middle;" rowspan="3">Nama Anak Perusahaan</th>
					<th rowspan="3">BULAN/TAHUN</th>
					<th rowspan="3">CI</th>
				</tr>
				<tr>
					<th colspan="4" >REALISASI</th>
				</tr>
				<tr>
					<th>Total Aset</th>
					<th>Sales</th>
					<th>Laba Bersih</th>
					<th>TKP</th>
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
	var t =$('#data-monitoring_kinerja').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			searching: false,
			lengthChange: false,
			pageLength: 100,
			language: {
            	processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax      : {
				url: "{{ route('monitoring_kinerja.index.json') }}",
				type : "POST",
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				data: function (d) {
					d.bulan = $('select[name=bulan]').val();
					d.tahun = $('input[name=tahun]').val();
				}
			},
			columns: [
				{data: 'action', name: 'action'},
				{data: 'nama', name: 'nama'},
				{data: 'thnbln', name: 'thnbln'},
				{data: 'ci', name: 'ci'},
				{data: 'total_aset', name: 'total_aset'},
				{data: 'sales', name: 'sales'},
				{data: 'laba_bersih', name: 'laba_bersih'},
				{data: 'tkp', name: 'tkp'},
			]
	});
	$('#search-form').on('submit', function(e) {
		t.draw();
		e.preventDefault();
				var bulan = $('select[name=bulan]').val();
		$('#acc').val(bulan);
	});
	$('.kt-select2').select2().on('change', function() {
		$(this).valid();
	});


	//edit monitoring_kinerja
	$('#editRow').click(function(e) {
			e.preventDefault();

			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function(){
					var id = $(this).attr('data-id');
					location.replace("{{url('customer_management/monitoring_kinerja/edit')}}"+ '/' +id);
				});
			} else {
				swalAlertInit('ubah');
			}
		});


	//delete monitoring_kinerja
	$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function() {
					var id = $(this).attr('data-id');
					// delete stuff
					const swalWithBootstrapButtons = Swal.mixin({
						customClass: {
							confirmButton: 'btn btn-primary',
							cancelButton: 'btn btn-danger'
						},
							buttonsStyling: false
						})
						swalWithBootstrapButtons.fire({
							title: "Data yang akan dihapus?",
							text: "No. monitoring kinerja : " + id,
							type: 'warning',
							showCancelButton: true,
							reverseButtons: true,
							confirmButtonText: 'Ya, hapus',
							cancelButtonText: 'Batalkan'
						})
						.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('monitoring_kinerja.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"id": id,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : 'Hapus No. monitoring kinerja ' + id,
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
				});
			} else {
				swalAlertInit('hapus');
			}
			
		});


});		
</script>
@endsection