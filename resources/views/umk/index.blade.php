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
							<span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Refresh Ketampilan Tabel Awal">
								<i class="fas fa-sync-alt" id="show-data"></i>
							</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div style="float:right;"><form action="{{route('uang_muka_kerja.search.index')}}" method="post">{{csrf_field()}}
			<p style="font-weight:bold;">No. UMK: <input style="width:20%;height:30px;box-radius:50%;border-radius:10px;"  name="permintaan" type="text" size="18" maxlength="18" value="" autocomplete='off'> Tahun: <input style="width:10%;height:30px;box-radius:50%;border-radius:10px;"  name="tahun" type="text" size="4" maxlength="4" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'> Bulan: <input style="width:10%;height:30px;box-radius:50%;border-radius:10px;"  name="bulan" type="text" size="2" maxlength="2" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'> <button type="submit" style="font-size: 20px;margin-left:5px;border-radius:10px;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cari Data"> <i class="fa fa-search"></i></button>  
			</form>
		</div>
		<!--begin: Datatable -->
		<table id="data-umk-table" class="table table-striped table-bordered table-hover table-checkable" width="100%">
			<thead class="thead-light">
				<tr>
					<th><input type="radio" hidden name="btn-radio"  data-id="1" class="btn-radio" checked ><input type="radio" hidden name="btn-radio-rekap"  data-id-rekap="1" class="btn-radio-rekap" checked ></th>
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
			@foreach($data_list as $data)
				<tr>
					<td>
						<?php if($data->app_pbd == 'Y'){
							echo '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" data-id-rekap="'.str_replace('/', '-', $data->no_umk).'" class="btn-radio-rekap" name="btn-radio-rekap"><span></span></label>';
						}else{
							if($data->app_sdm == 'Y'){
							echo '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" disabled class="btn-radio" ><span></span></label>';
							}else{
								echo '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" dataumk="'.$data->no_umk.'" data-id="'.str_replace('/', '-', $data->no_umk).'" name="btn-radio"><span></span></label>';
							}
						} ?>
					</td>
					<td><?php 
						$tgl = date_create($data->tgl_panjar);
					echo date_format($tgl, 'd F Y') ?></td>
					<td>{{$data->no_umk}}</td>
					<td>{{$data->no_kas}}</td>
					<td>
						<?php if($data->jenis_um == 'K'){
							echo '<p align="center">UM Kerja</p>';
						}else{
							echo '<p align="center">UM Dinas</p>';
						} ?>
					</td>
					<td>{{$data->keterangan}}</td>
					<td>Rp. <?php echo number_format($data->jumlah, 2, ',', '.') ?></td>
					<td>
						<?php if($data->app_pbd == 'Y'){
							echo '<p align="center"><span style="font-size: 2em;" class="kt-font-success"><i class="fas fa-check-circle" title="Data Sudah di proses perbendaharaan"></i></span></p>';
						}else{
							if($data->app_sdm == 'Y'){
								echo '<p align="center"><a href="'. route('uang_muka_kerja.approv',['id' => str_replace('/', '-', $data->no_umk)]).'"><span style="font-size: 2em;" class="kt-font-warning"><i class="fas fa-check-circle" title="Batalkan Approval"></i></span></a></p>';
							}else{
								echo '<p align="center"><a href="'. route('uang_muka_kerja.approv',['id' => str_replace('/', '-', $data->no_umk)]).'"><span style="font-size: 2em;" class="kt-font-danger"><i class="fas fa-ban" title="Klik untuk Approval"></i></span></a></p>';
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
</div>


@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
	$('#data-umk-table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
			searching: false,
			lengthChange: false,
			language: {
            	processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			
		});
});

//report Uang Muka Kerja 
$('#reportRow').on('click', function(e) {
	e.preventDefault();

var allVals = [];  
$(".btn-radio-rekap:checked").each(function() {  
	e.preventDefault();
	var dataid = $(this).attr('data-id-rekap');
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