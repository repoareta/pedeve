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
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Permintaan Bayar</span>
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
				Tabel Umum Permintaan Bayar
			</h3>			
			<div class="kt-portlet__head-actions">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
							<a href="{{ route('permintaan_bayar.create') }}">
								<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
									<i class="fas fa-plus-circle"></i>
								</span>
							</a>
		
							<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
								<i class="fas fa-edit" id="editRow"></i>
							</span>
		
							<span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
								<i class="fas fa-times-circle" id="deleteRow"></i>
							</span>

							<span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
								<i class="fas fa-print" id="reportRow"></i>
							</span>
							<span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Refresh Ketampilan Tabel Awal">
								<i class="fas fa-sync-alt" id="show-data"></i>
							</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
			<form action="{{route('permintaan_bayar.search.index')}}" method="post">{{csrf_field()}}
			No. UMK: 	<input  style="width:14em;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="permintaan" type="text" size="18" maxlength="18" value="" autocomplete='off'> 

				Bulan: 	<input  style="width:4em;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="bulan" type="text" size="2" maxlength="2" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'>

				Tahun: 	<input style="width:10%;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="tahun" id="tahun" type="text" size="4" maxlength="4" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'>  
					<button type="submit" style="font-size: 20px;margin-left:5px;border-radius:10px;border-radius:10px;background-color:white;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cari Data"> <i class="fa fa-search"></i></button>  
					
			</form>

		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="table-permintaan">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>No. Permintaan</th>
					<th>No. Kas/Bank</th>
					<th>Kepada</th>
					<th>Keterangan</th>
					<th>Lampiran</th>
					<th>Nilai</th>
					<th>Approval</th>
				</tr>
			</thead>
			<tbody class="thead-light">
				@foreach($bayar_list as $data)
				<tr>
					<td>
						<?php if($data->app_pbd == 'Y'){
							 echo'<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" data-id-rekap="'.str_replace('/', '-', $data->no_bayar).'" class="btn-radio-rekap" name="btn-radio-rekap"><span></span></label>';
						}else{
							if($data->app_sdm == 'Y'){
							echo '<label class="kt-radio kt-radio--bold kt-radio--brand"><input class="btn-radio" type="radio" disabled class="btn-radio" ><span></span></label>';
							}else{
							 echo '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" databayar="'.$data->no_bayar.'" data-id="'.str_replace('/', '-', $data->no_bayar).'" name="btn-radio"><span></span></label>';
							}
						} ?>
					</td>
					<td>{{$data->no_bayar}}</td>
					<td>{{$data->no_kas}}</td>
					<td>{{$data->kepada}}</td>
					<td>{{$data->keterangan}}</td>
					<td>{{$data->lampiran}}</td>
					<td>Rp. <?php echo number_format($data->nilai, 2, '.', ',') ?></td>
					<td>
						<?php if($data->app_pbd == 'Y'){
							echo '<p align="center"><span style="font-size: 2em;" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Data Sudah di proses perbendaharaan"><i class="fas fa-check-circle" ></i></span></p>';
						}else{
							if($data->app_sdm == 'Y'){
								echo '<p align="center"><a href="'. route('permintaan_bayar.approv',['id' => str_replace('/', '-', $data->no_bayar)]).'"><span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Batalkan Approval"><i class="fas fa-check-circle" ></i></span></a></p>';
							}else{
								echo '<p align="center"><a href="'. route('permintaan_bayar.approv',['id' => str_replace('/', '-', $data->no_bayar)]).'"><span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Klik untuk Approval"><i class="fas fa-ban" ></i></span></a></p>';
							}
						} ?>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<!--end: Datatable -->
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		
		$('#table-permintaan').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
			searching: false,
			lengthChange: false,
			language: {
            	processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			
		});
		
	$('#show-data').on('click', function(e) {
	e.preventDefault();
		location.replace("{{ route('permintaan_bayar.index') }}");

	});
		

//report Uang Muka Kerja 
$('#reportRow').on('click', function(e) {
	e.preventDefault();

	if($('input[class=btn-radio-rekap]').is(':checked')) { 
		$("input[class=btn-radio-rekap]:checked").each(function() {  
			e.preventDefault();
			var dataid = $(this).attr('data-id-rekap');
				location.replace("{{url('umum/permintaan_bayar/rekap')}}"+ '/' +dataid);
		});
	} else{
		swalAlertInit('cetak');
	}
	
});

		//edit permintaan bayar
		$('#editRow').click(function(e) {
			e.preventDefault();

			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function(){
					var id = $(this).attr('data-id');
					location.replace("{{url('umum/permintaan_bayar/edit')}}"+ '/' +id);
				});
			} else {
				swalAlertInit('ubah');
			}
		});

		//delete permintaan bayar
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
							text: "No. bayar : " + id,
							type: 'warning',
							showCancelButton: true,
							reverseButtons: true,
							confirmButtonText: 'Ya, hapus',
							cancelButtonText: 'Batalkan'
						})
						.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('permintaan_bayar.delete') }}",
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