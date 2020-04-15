@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Potongan Pinjaman Pegawai </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Potongan Pinjaman Pegawai</span>
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
				Tabel Potongan Pinjaman Pegawai
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{ route('potongan_otomatis.create') }}">
							<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
		
						<span style="font-size: 2em;" class="kt-font-warning pointer-link" id="editRow" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
							<i class="fas fa-edit"></i>
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
			<form action="{{route('potongan_otomatis.search.index')}}" method="post">{{csrf_field()}}
			Pegawai:	<select style="width:25%;height:30px;box-radius:50%;border-radius:30px;" name="nopek" class="selectpicker" data-live-search="true">
								<option value="">- Pilih -</option>
								@foreach($data_pegawai as $data)
								<option value="{{$data->nopeg}}">{{$data->nopeg}} - {{$data->nama}}</option>
								@endforeach
						</select>
			Potongan:	<select style="width:25%;height:30px;box-radius:50%;border-radius:30px;" name="aard" class="selectpicker" data-live-search="true">
									<option value="">- Pilih -</option>
								@foreach($data_potongan as $dataa)
									<option value="{{$dataa->kode}}">{{$dataa->nama}}{{$dataa->nama}}</option>
								@endforeach
						</select>
				Bulan: 	<input  style="width:4em;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="bulan" type="text" size="2" maxlength="2" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'>

				Tahun: 	<input style="width:10%;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="tahun" id="tahun" type="text" size="4" maxlength="4" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'>  
					<button type="submit" style="font-size: 20px;margin-left:5px;border-radius:10px;border-radius:10px;background-color:white;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cari Data"> <i class="fa fa-search"></i></button>  
					
			</form>
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>TAHUN</th>
					<th>BULAN</th>
					<th>PEGAWAI</th>
					<th>POTONGAN</th>
					<th>JMLCCL</th>
					<th>CCL KE-</th>
					<th>NILAI CCL</th>
					<th>SISA HUTANG</th>
					<th>TOTAL HUTANG</th>
				</tr>
			</thead>
			<tbody>
			@foreach($data_list as $data)

			<tr>
				<td><?php 
               		 echo '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" tahun="'.$data->tahun.'" bulan="'.$data->bulan.'" nopek="'.$data->nopek.'" aard="'.$data->aardpot.'" nama="'.$data->nama_nopek.'" name="btn-radio"><span></span></label>';
					?></td>
				<td align="center">{{$data->tahun}}</td>
				<td align="center">
					<?php 
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
						echo strtoupper($array_bln[$data->bulan]);
					?>
				</td>
				<td>{{$data->nopek}} - {{$data->nama_nopek}}</td>
				<td>{{$data->aardpot}} - {{$data->nama_aardpot}}</td>
				<td align="center"><?php echo number_format($data->jmlcc, 0, '', '') ?></td>
				<td align="center"><?php echo number_format($data->ccl, 0, '', '') ?></td>
				<td>Rp. <?php echo number_format($data->nilai, 2, '.', ',') ?></td>
				<td>Rp. <?php echo number_format($data->akhir, 2, '.', ',') ?></td>
				<td>Rp. <?php echo number_format($data->totalhut, 2, '.', ',') ?></td>
				
			</tr>
			@endforeach
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
//refresh data
$('#show-data').on('click', function(e) {
	e.preventDefault();
	location.replace("{{ route('potongan_otomatis.index') }}");

});
	//edit potongan Otomatis
	$('#editRow').click(function(e) {
		e.preventDefault();

		if($('input[type=radio]').is(':checked')) { 
			$("input[type=radio]:checked").each(function(){
				var tahun = $(this).attr('tahun');
				var bulan = $(this).attr('bulan');
				var nopek = $(this).attr('nopek');
				var aard  = $(this).attr('aard');
				var nama  = $(this).attr('nama');
				location.replace("{{url('sdm/potongan_otomatis/edit')}}"+ '/' +bulan+'/' +tahun+'/'+aard+ '/' +nopek);
			});
		} else {
			swalAlertInit('ubah');
		}
	});

	// delete potongan otomatis
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
							url: "{{ route('potongan_otomatis.delete') }}",
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