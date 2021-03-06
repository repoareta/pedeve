@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Kas/Bank </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Perbendaharaan </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Kas/Bank</span>
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
				Tabel Kas/Bank
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',501)->limit(1)->get() as $data_akses)
						@if($data_akses->tambah == 1)
						<a href="{{ route('penerimaan_kas.createmp') }}">
							<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
						@endif

						@if($data_akses->rubah == 1 or $data_akses->lihat == 1)		
						<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data Atau Lihat Data">
							<i class="fas fa-edit" id="editRow"></i>
						</span>
						@endif

						@if($data_akses->hapus == 1)		
						<span style="font-size: 2em;" class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
							<i class="fas fa-times-circle"></i>
						</span>
						@endif

						@if($data_akses->cetak == 1)
						<span style="font-size: 2em;" class="kt-font-info pointer-link" id="exportRow" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
							<i class="fas fa-print"></i>
						</span>
						@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="">
			<form class="kt-form" id="search-form" >
				<div class="form-group row col-12">
					<label for="" class="col-form-label">No. Bukti</label>
					<div class="col-2">
						<input class="form-control" type="text" name="bukti" value="" size="18" maxlength="18" autocomplete='off'>
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
		</div>
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>NO.DOKUMEN</th>
					<th>TANGGAL</th>
					<th>NO.BUKTI</th>
					<th>KEPADA</th>
					<th>JK</th>
					<th>NO.KAS</th>
					<th>CI</th>
					<th>KURS</th>
					<th>NILAI</th>
					<th>STATUS BYR</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

		<!--end: Datatable -->
	</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Cetak Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="{{ route('penerimaan_kas.export') }}" method="GET" id="formCetakData" target="_blank">
				<div class="modal-body">
					<div class="form-group row">
						<label for="" class="col-2 col-form-label">No Dokumen</label>
						<div class="col-10">
							<input class="form-control" type="text" readonly name="no_dokumen" id="no_dokumen">
						</div>
					</div>

					<div class="form-group row" style="margin:0px;">
						<label for="" class="col-2 col-form-label"></label>
						<div class="col-5">Nama</div>
						<div class="col-5">Jabatan</div>
					</div>

					<div class="form-group row">
						<label for="" class="col-2 col-form-label">Pemeriksaan</label>
						<div class="col-5">
							<input class="form-control" type="text" name="pemeriksaan_nama" id="pemeriksaan_nama">
						</div>
						<div class="col-5">
							<input class="form-control" type="text" name="pemeriksaan_jabatan" id="pemeriksaan_jabatan">
						</div>
					</div>
					
                    <div class="form-group row">
						<label for="" class="col-2 col-form-label">Membukukan</label>
						<div class="col-5">
							<input class="form-control" type="text" name="membukukan_nama" id="membukukan_nama">
						</div>
						<div class="col-5">
							<input class="form-control" type="text" name="membukukan_jabatan" id="membukukan_jabatan">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="" class="col-2 col-form-label">Kas/Bank</label>
						<div class="col-5">
							<input class="form-control" type="text" name="kasbank_nama" id="kasbank_nama">
						</div>
						<div class="col-5">
							<input class="form-control" type="text" name="kasbank_jabatan" id="kasbank_jabatan">
						</div>
					</div>					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Batal</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Cetak Data</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal End -->
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function () {
	var t = $('#kt_table').DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			lengthChange: false,
			pageLength: 200,
			scrollX:        true,
			
			language: {
			processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax      : {
				url: "{{route('penerimaan_kas.search.index')}}",
				type : "POST",
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				data: function (d) {
					d.bukti = $('input[name=bukti]').val();
					d.bulan = $('select[name=bulan]').val();
					d.tahun = $('input[name=tahun]').val();
				}
			},
			columns: [
				{data: 'radio', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'docno', name: 'docno'},
				{data: 'tanggal', name: 'tanggal'},
				{data: 'voucher', name: 'voucher'},
				{data: 'kepada', name: 'kepada'},
				{data: 'jk', name: 'jk'},
				{data: 'store', name: 'store'},
				{data: 'ci', name: 'ci'},
				{data: 'rate', name: 'rate'},
				{data: 'nilai_dok', name: 'nilai_dok'},
				{data: 'action', name: 'action'},
			]
			
	});

	$('#search-form').on('submit', function(e) {
		t.draw();
		e.preventDefault();
	});
	$('#kt_table tbody').on( 'click', 'tr', function (event) {
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

	// edit Kas/Bank Otomatis
	$('#editRow').click(function(e) {
		e.preventDefault();

		if($('input[type=radio]').is(':checked')) { 
			$("input[type=radio]:checked").each(function(){
				var nodok = $(this).val().split("/").join("-");

				// var nodok = $(this).attr('nodok');
				location.replace("{{url('perbendaharaan/penerimaan_kas/edit')}}"+ '/' +nodok);
			});
		} else {
			swalAlertInit('ubah');
		}
	});

	// delete Kas/Bank otomatis
	$('#deleteRow').click(function(e) {
		e.preventDefault();
		if($('input[type=radio]').is(':checked')) { 
			$("input[type=radio]:checked").each(function() {
				var nodok = $(this).val();
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
						text: "No Dokumen: "+nodok,
						type: 'warning',
						showCancelButton: true,
						reverseButtons: true,
						confirmButtonText: 'Ya, hapus',
						cancelButtonText: 'Batalkan'
					})
					.then((result) => {
					if (result.value) {
						$.ajax({
							url: "{{ route('penerimaan_kas.delete') }}",
							type: 'DELETE',
							dataType: 'json',
							data: {
								"nodok": nodok,
								"_token": "{{ csrf_token() }}",
							},
							success: function (data) {
								if(data == 1){
									Swal.fire({
										type  : 'success',
										title : "No Dokumen: "+nodok,
										text  : 'Berhasil',
										timer : 2000
									}).then(function() {
										location.reload();
									});
								}else if(data == 2){
									Swal.fire({
										type  : 'info',
										title : 'Penghapusan gagal,data tidak dalam status Opening.',
										text  : 'Failed',
									});
								}else{
									Swal.fire({
										type  : 'info',
										title : 'Sebelum dihapus,status bayar harus dibatalkan dulu.',
										text  : 'Failed',
									});
								}
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

	

	$('#exportRow').click(function(e) {
		e.preventDefault();
		if($('input[type=radio]').is(':checked')) { 
			$("input[type=radio]:checked").each(function() {
				var id = $(this).val();

				// open modal
				$('#cetakModal').modal('show');

				// fill no_panjar to no_panjar field
				$('#no_dokumen').val(id);
			});
		} else {
			swalAlertInit('cetak');
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