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
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
			<form id="search-form">{{csrf_field()}}
			No. Permintaan: 	<input  style="width:14em;height:35px;border: 1px solid #DCDCDC;border-radius:5px;"  name="permintaan" type="text" size="18" maxlength="18" value="" autocomplete='off'> 

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
		
		var t = $('#table-permintaan').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			searching: false,
			lengthChange: false,
			language: {
            	processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax      : {
					url: "{{route('permintaan_bayar.search.index')}}",
					type : "POST",
					dataType : "JSON",
					headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
					},
					data: function (d) {
						d.permintaan = $('input[name=permintaan]').val();
						d.bulan = $('input[name=bulan]').val();
						d.tahun = $('input[name=tahun]').val();
					}
				},
			columns: [
				{data: 'radio', name: 'radio'},
				{data: 'no_bayar', name: 'no_bayar'},
				{data: 'no_kas', name: 'no_kas'},
				{data: 'kepada', name: 'kepada'},
				{data: 'keterangan', name: 'keterangan'},
				{data: 'lampiran', name: 'lampiran'},
				{data: 'nilai', name: 'nilai'},
				{data: 'action', name: 'action'},
			]
				
			
		});
		$('#search-form').on('submit', function(e) {
			t.draw();
			e.preventDefault();
		});
		
	$('#show-data').on('click', function(e) {
	e.preventDefault();
		location.replace("{{ route('permintaan_bayar.index') }}");

	});
		

//report Uang Muka Kerja 
$('#reportRow').on('click', function(e) {
	e.preventDefault();

	if($('input[class=btn-radio]').is(':checked')) { 
		$("input[class=btn-radio]:checked").each(function() {  
			e.preventDefault();
			var dataid = $(this).attr('data-id');
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
											title : 'Hapus No. Bayar ' + id,
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