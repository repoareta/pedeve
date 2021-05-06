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
							@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',741)->limit(1)->get() as $data_akses)
							@if($data_akses->tambah == 1)
							<a href="{{ route('permintaan_bayar.create') }}">
								<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
									<i class="fas fa-plus-circle"></i>
								</span>
							</a>
							@endif

							@if($data_akses->rubah == 1)
							<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
								<i class="fas fa-edit" id="editRow"></i>
							</span>
							@endif

							@if($data_akses->hapus == 1)
							<span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
								<i class="fas fa-times-circle" id="deleteRow"></i>
							</span>
							@endif

							@if($data_akses->cetak == 1)
							<span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
								<i class="fas fa-print" id="reportRow"></i>
							</span>
							@endif
							@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
			<form class="kt-form" id="search-form" >
				<div class="form-group row col-12">
					<label for="" class="col-form-label">No. Permintaan</label>
					<div class="col-2">
						<input class="form-control" type="text" name="permintaan" value="" size="18" maxlength="18">
					</div>
					<label for="" class="col-form-label">Bulan</label>
					<div class="col-2">
						<select name="bulan" class="form-control selectpicker" data-live-search="true">
							<option value="" >-- Pilih --</option>
							<option value="01" <?php if($bulan  == '01' ) echo 'selected' ; ?>>Januari</option>
							<option value="02" <?php if($bulan  == '02' ) echo 'selected' ; ?>>Februari</option>
							<option value="03" <?php if($bulan  == '03' ) echo 'selected' ; ?>>Maret</option>
							<option value="04" <?php if($bulan  == '04' ) echo 'selected' ; ?>>April</option>
							<option value="05" <?php if($bulan  == '05' ) echo 'selected' ; ?>>Mei</option>
							<option value="06" <?php if($bulan  == '06' ) echo 'selected' ; ?>>Juni</option>
							<option value="07" <?php if($bulan  == '07' ) echo 'selected' ; ?>>Juli</option>
							<option value="08" <?php if($bulan  == '08' ) echo 'selected' ; ?>>Agustus</option>
							<option value="09" <?php if($bulan  == '09' ) echo 'selected' ; ?>>September</option>
							<option value="10" <?php if($bulan  == '10' ) echo 'selected' ; ?>>Oktober</option>
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

		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="table-permintaan" width="100%">
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
		
		var t = $('#table-permintaan').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			searching: false,
			lengthChange: false,
			pageLength: 200,
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
						d.bulan = $('select[name=bulan]').val();
						d.tahun = $('input[name=tahun]').val();
					}
				},
			columns: [
				{data: 'radio', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
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

		$('#table-permintaan tbody').on( 'click', 'tr', function (event) {
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
			} else {
				t.$('tr.selected').removeClass('selected');
				// $(':radio', this).trigger('click');
				if (event.target.type !== 'radio') {
					$(':radio', this).trigger('click');
				}
				$(this).addClass('selected');
			}
		} );
		
	$('#show-data').on('click', function(e) {
	e.preventDefault();
		location.replace("{{ route('permintaan_bayar.index') }}");

	});
		

//report permintaan bayar
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