@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Dafta Pencairan Poko </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Dafta Pencairan Poko</span>
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
				Tabel Dafta Pencairan Poko
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{ route('pembayaran_pkpp.create') }}">
							<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
		
						<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
							<i class="fas fa-edit" id="editRow"></i>
						</span>
		
						<span style="font-size: 2em;" class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
							<i class="fas fa-times-circle"></i>
						</span>

						<!-- <span style="font-size: 2em;" class="kt-font-info pointer-link" id="exportRow" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
							<i class="fas fa-print"></i>
						</span> -->
						<span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Refresh Ketampilan Tabel Awal">
							<i class="fas fa-sync-alt" id="show-data"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
			<form action="{{route('pembayaran_pkpp.search.index')}}" method="post">{{csrf_field()}}
				
				Bulan: 	<input  style="width:4em;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="bulan" type="text" size="2" maxlength="2" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'>

				Tahun: 	<input style="width:10%;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="tahun" id="tahun" type="text" size="4" maxlength="4" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'>  
					<button type="submit" style="font-size: 20px;margin-left:5px;border-radius:10px;border-radius:10px;background-color:white;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cari Data"> <i class="fa fa-search"></i></button>  
					
			</form>
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th>STATUS BYR</th>
					<th>NO.DOKUMEN</th>
					<th>TANGGAL</th>
					<th>NO.BUKTI</th>
					<th>KEPADA</th>
					<th>JK</th>
					<th>NO.KAS</th>
					<th>CI</th>
					<th>KURS</th>
					<th>NILAI</th>
				</tr>
			</thead>
			@foreach($data_list as $data)
				<tr>
					<td>
						<?php if($data->verified == 'Y'){
							echo '<p align="center"><span style="font-size: 2em;" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Data Sudah Diverifikasi"><i class="fas fa-check-circle" ></i></span></p>';
						}else{
							if($data->paid == 'Y'){
								echo '<p align="center"><a href=""><span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top"  title="Batalkan Pembayaran"><i class="fas fa-check-circle" ></i></span></a></p>';
							}else{
								echo '<p align="center"><a href=""><span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Klik Untuk Pembayaran"><i class="fas fa-ban" ></i></span></a></p>';
							}
						} ?>
					</td>
					<td>{{$data->docno}}</td>
					<td>{{$data->originaldate}}</td>
					<td>{{$data->voucher}}</td>
					<td>{{$data->kepada}}</td>
					<td>{{$data->jk}}</td>
					<td>{{$data->store}}</td>
					<td>{{$data->ci}}</td>
					<td>{{$data->rate}}</td>
					<td>{{$data->nilai_dok}}</td>					
				</tr>
			@endforeach
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
$(document).ready(function () {
var t = $('#kt_table').DataTable({
	scrollX   : true,
	processing: true,
	serverSide: false,
	searching: false,
	lengthChange: false,
	language: {
	processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
},
});

// edit Dafta Pencairan Poko Otomatis
$('#editRow').click(function(e) {
	e.preventDefault();

	if($('input[type=radio]').is(':checked')) { 
		$("input[type=radio]:checked").each(function(){
			var tahun = $(this).attr('tahun');
			var bulan = $(this).attr('bulan');
			var nopek = $(this).attr('nopek');
			var aard  = $(this).attr('aard');
			var nama  = $(this).attr('nama');
			location.replace("{{url('sdm/pembayaran_pkpp/edit')}}"+ '/' +bulan+'/' +tahun+'/'+aard+ '/' +nopek);
		});
	} else {
		swalAlertInit('ubah');
	}
});

//refresh data
$('#show-data').on('click', function(e) {
	e.preventDefault();
		location.replace("{{ route('pembayaran_pkpp.index') }}");

});

// delete Dafta Pencairan Poko otomatis
$('#deleteRow').click(function(e) {
e.preventDefault();
if($('input[type=radio]').is(':checked')) { 
	$("input[type=radio]:checked").each(function() {
		var tahun = $(this).attr('tahun');
		var bulan = $(this).attr('bulan');
		var nopek = $(this).attr('nopek');
		var aard  = $(this).attr('aard');
		var nama  = $(this).attr('nama');
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
				text: "Detail data Bulan: "+bulan+ ' Tahun '  + tahun+' Nama ' +nama,
				type: 'warning',
				showCancelButton: true,
				reverseButtons: true,
				confirmButtonText: 'Ya, hapus',
				cancelButtonText: 'Batalkan'
			})
			.then((result) => {
			if (result.value) {
				$.ajax({
					url: "{{ route('pembayaran_pkpp.delete') }}",
					type: 'DELETE',
					dataType: 'json',
					data: {
						"bulan": bulan,
						"tahun": tahun,
						"nopek": nopek,
						"aard": aard,
						"nama": nama,
						"_token": "{{ csrf_token() }}",
					},
					success: function () {
						Swal.fire({
							type  : 'success',
							title : "Detail data Bulan: "+bulan+ ' Tahun '  + tahun+' Nama ' +nama,
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

function hanyaAngka(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))

	return false;
	return true;
}

</script>
@endsection