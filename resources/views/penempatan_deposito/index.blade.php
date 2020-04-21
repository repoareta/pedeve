@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Honorarium Komite/Rapat </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Honorarium Komite/Rapat</span>
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
				Tabel Honorarium Komite/Rapat
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{ route('penempatan_deposito.create') }}">
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
			<form action="{{route('penempatan_deposito.search.index')}}" method="post">{{csrf_field()}}
				Bulan: 	<input  style="width:4em;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="bulan" type="text" size="2" maxlength="2" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'>

				Tahun: 	<input style="width:10%;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="tahun"  type="text" size="4" maxlength="4" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'>  
					<button type="submit" style="font-size: 20px;margin-left:5px;border-radius:10px;border-radius:10px;background-color:white;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cari Data"> <i class="fa fa-search"></i></button>  
					
			</form>
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>NO.SERI</th>
					<th>NAMA BANK</th>
					<th>ASAL DANA</th>
					<th>NOMINAL</th>
					<th>TGL.DEPOSITO</th>
					<th>TGL.JTH TEMPO</th>
					<th>HARI BUNGA</th>
					<th>BUNGA %/THN</th>
					<th>BUNGA/BULAN</th>
					<th>PPH 20%/BLN</th>
					<th>NET/BULAN</th>
					<th>ACCRUE HARI</th>
					<th>ACCRUED NOMINAL</th>
				</tr>
			</thead>
			<tbody>
			@foreach($data_list as $data)
			<?php	
			$tanggaltem = date_format(date_create($data->tgltempo),'d/m/Y');
			$tanggalsekarang = date_format(date_create(date(now())),'d/m/Y');
			if(($data->selhari <= 2) and ($data->selhari > 0) and ($data->selbulan == 0) and ($data->seltahun == 0)){
					$warni = "#ff0000";
				}elseif($tanggaltem <= $tanggalsekarang){
					$warni = "#666666";
				}else{ 
					$warni = "000000";
				} ?>
			<tr>
				<td>{{$data->selhari}}'-'{{$data->selbulan}}'-'{{$data->seltahun}}</td>
				<td><font color="{{$warni}}">{{$data->noseri}}</font></td>
				<td><font color="{{$warni}}">{{$data->namabank}}</font></td>
				<td><font color="{{$warni}}">{{$data->asal}}</font></td>
				<td><font color="{{$warni}}">{{number_format($data->nominal,2,',','.')}}</font></td>
				<td><font color="{{$warni}}"><?php echo date_format(date_create($data->tgldep),'d/m/Y') ?></font></td>
				<td><font color="{{$warni}}"><?php echo date_format(date_create($data->tgltempo),'d/m/Y') ?></font></td>
				<td><font color="{{$warni}}">{{$data->haribunga}}</font></td>
				<td><font color="{{$warni}}">{{number_format($data->bungatahun,2,',','.')}}</font></td>
				<td><font color="{{$warni}}">{{number_format($data->bungabulan,2,',','.')}}</font></td>
				<td><font color="{{$warni}}">{{number_format($data->pph20,2,',','.')}}</font></td>
				<td><font color="{{$warni}}">{{number_format($data->netbulan,2,',','.')}}</font></td>
				<td><font color="{{$warni}}">{{$data->accharibunga}}</font></td>
				<td><font color="{{$warni}}">{{number_format($data->accnetbulan,2,',','.')}}</font></td>
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
		$('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
			searching: false,
			lengthChange: false,
			language: {
            	processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
		});
		

//edit potongan Manual
$('#editRow').click(function(e) {
	e.preventDefault();

	if($('input[type=radio]').is(':checked')) { 
		$("input[type=radio]:checked").each(function(){
			var tahun = $(this).attr('tahun');
			var bulan = $(this).attr('bulan');
			var nopek = $(this).attr('nopek');
			var aard  = $(this).attr('aard');
			var nama  = $(this).attr('nama');
			location.replace("{{url('perbendaharaan/penempatan_deposito/edit')}}"+ '/' +bulan+'/' +tahun+ '/' +nopek);
		});
	} else {
		swalAlertInit('ubah');
	}
});

//refresh data
$('#show-data').on('click', function(e) {
	e.preventDefault();
		location.replace("{{ route('penempatan_deposito.index') }}");

});
//delete potongan manual
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
					text: "Detail data : "+bulan+ '-'  + tahun+'-' +nama,
					type: 'warning',
					showCancelButton: true,
					reverseButtons: true,
					confirmButtonText: 'Ya, hapus',
					cancelButtonText: 'Batalkan'
				})
				.then((result) => {
				if (result.value) {
					$.ajax({
						url: "{{ route('penempatan_deposito.delete') }}",
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
								title : "Detail data : "+bulan+ '-'  + tahun+'-' +nama,
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