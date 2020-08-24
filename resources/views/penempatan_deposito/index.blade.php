@extends('layout.global')
@section('content')
<style>
/* td{
        font-weight: bold;
        background-color: #666666;
    } */
</style>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Penempatan Deposito </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Penempatan Deposito</span>
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
				Tabel Penempatan Deposito
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',509)->limit(1)->get() as $data_akses)
						@if($data_akses->tambah == 1)
						<a href="{{ route('penempatan_deposito.create') }}">
							<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
						@endif

						@if($data_akses->rubah == 1 or $data_akses->lihat == 1)		
						<span style="font-size: 2em;" class="kt-font-warning pointer-link" id="editRow" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data Atau Lihat Data">
							<i class="fas fa-edit"></i>
						</span>
						@endif

						@if($data_akses->hapus == 1)		
						<span style="font-size: 2em;" class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
							<i class="fas fa-times-circle"></i>
						</span>
						@endif

						@if($data_akses->tambah == 1)
						<span style="font-size: 2em;" class=" pointer-link" id="dolarRow" data-toggle="kt-tooltip" data-placement="top" title="Perpanjang Deposito">
						<i class="fas fa-dollar-sign"></i>
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
					<label for="" class="col-form-label">Bulan</label>
					<div class="col-2">
						<select name="bulan" class="form-control selectpicker" data-live-search="true">
							<option value="" >-- Pilih --</option>
							<option value="01" <?php if($bulan  == '01' ) echo 'selected' ; ?>>Januari</option>
							<option value="02" <?php if($bulan  == '02' ) echo 'selected' ; ?>>Februari</option>
							<option value="03" <?php if($bulan  == '03' ) echo 'selected' ; ?>>Maret</option>
							<option value="04" <?php if($bulan  == '04' ) echo 'selected' ; ?>>April</option>
							<option value="05" <?php if($bulan  == '05' ) echo 'selected' ; ?>>Mei</option>
							<option value="06" <?php if($bulan  == '05' ) echo 'selected' ; ?>>Juni</option>
							<option value="07" <?php if($bulan  == '07' ) echo 'selected' ; ?>>Juli</option>
							<option value="08" <?php if($bulan  == '08' ) echo 'selected' ; ?>>Agustus</option>
							<option value="09" <?php if($bulan  == '09' ) echo 'selected' ; ?>>September</option>
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
					<th>NO.SERI</th>
					<th>NAMA BANK</th>
					<th>NOMINAL</th>
					<th>TGL.DEPOSITO</th>
					<th>TGL.JTH TEMPO</th>
					<th>HARI BUNGA</th>
					<th>RATE</th>
					<th>BUNGA %/THN</th>
					<th>BUNGA/BULAN</th>
					<th>PPH 20%/BLN</th>
					<th>NET/BULAN</th>
					<th>ACCRUE HARI</th>
					<th>ACCRUED NOMINAL</th>
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
		var t = $('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: true,
			searching: false,
			lengthChange: false,
			pageLength: 100,
			scrollY:        "500px",
			scrollCollapse: true,
			language: {
			processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax      : {
				url: "{{route('penempatan_deposito.search.index')}}",
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
				{data: 'radio', name: 'radio'},
				{data: 'noseri', name: 'noseri'},
				{data: 'namabank', name: 'namabank'},
				{data: 'nominal', name: 'nominal'},
				{data: 'tgldep', name: 'tgldep'},
				{data: 'tgltempo', name: 'tgltempo'},
				{data: 'haribunga', name: 'haribunga'},
				{data: 'rate', name: 'rate'},
				{data: 'bungatahun', name: 'bungatahun'},
				{data: 'bungabulan', name: 'bungabulan'},
				{data: 'pph20', name: 'pph20'},
				{data: 'netbulan', name: 'netbulan'},
				{data: 'accharibunga', name: 'accharibunga'},
				{data: 'accnetbulan', name: 'accnetbulan'},
			],
			columnDefs: [
                        {"className": "dt-center", "targets": "_all"}
                      ],
			createdRow: function( row, data, dataIndex ) {
                if(data["warna"] == 1){
					$( row ).css( "background-color", "#FF0000" );
					$('td', row ).css( "color", "#FFFEFE" );
				}else if(data["warna"] == 2){
					$( row ).css( "background-color", "#666666" );
					$('td', row ).css( "color", "#FFFEFE" );
				}else{
					$( row ).css( "background-color", "#000000" );
					$('td', row ).css( "color", "#FFFEFE" );
				}
            },
			
	});
	$('#search-form').on('submit', function(e) {
		t.draw();
		e.preventDefault();
	});
		

//edit penempatan deposito
$('#editRow').click(function(e) {
	e.preventDefault();

	if($('input[type=radio]').is(':checked')) { 
		$("input[type=radio]:checked").each(function(){
			var nodok = $(this).attr('nodok').split("/").join("-");
			var lineno = $(this).attr('lineno');
			var pjg = $(this).attr('pjg');
			location.replace("{{url('perbendaharaan/penempatan_deposito/edit')}}"+ '/' +nodok+'/' +lineno+ '/' +pjg);
		});
	} else {
		swalAlertInit('ubah');
	}
});
//exportRow penempatan deposito
$('#exportRow').on('click', function(e) {
	e.preventDefault();

	if($('input[class=btn-radio]').is(':checked')) { 
		$("input[class=btn-radio]:checked").each(function() {  
			e.preventDefault();
			var no = $(this).attr('nodok').split("/").join("-");
			var id = $(this).attr('lineno');
				location.replace("{{url('perbendaharaan/penempatan_deposito/rekaprc')}}"+ '/' +no+'/'+id);
		});
	} else{
		swalAlertInit('cetak');
	}
	
});


//perpanjang deposito
$('#dolarRow').click(function(e) {
	e.preventDefault();

	if($('input[type=radio]').is(':checked')) { 
		$("input[type=radio]:checked").each(function(){
			var nodok = $(this).attr('nodok').split("/").join("-");
			var lineno = $(this).attr('lineno');
			var pjg = $(this).attr('pjg');
			location.replace("{{url('perbendaharaan/penempatan_deposito/depopjg')}}"+ '/' +nodok+'/' +lineno+ '/' +pjg);
		});
	} else {
		swalAlertInit('perpanjangan deposito');
	}
});

//refresh data
$('#show-data').on('click', function(e) {
	e.preventDefault();
		location.replace("{{ route('penempatan_deposito.index') }}");

});
//delete penempatan deposito
$('#deleteRow').click(function(e) {
	e.preventDefault();
	if($('input[type=radio]').is(':checked')) { 
		$("input[type=radio]:checked").each(function() {
			var nodok = $(this).attr('nodok').split("/").join("-");
			var lineno = $(this).attr('lineno');
			var pjg = $(this).attr('pjg');
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
					text: "Detail data No. dokumen : "+nodok+ ' nomer lineno : '  +lineno,
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
							"nodok": nodok,
							"lineno": lineno,
							"pjg": pjg,
							"_token": "{{ csrf_token() }}",
						},
						success: function () {
							Swal.fire({
								type  : 'success',
								title : "Detail data No. dokumen : "+nodok+ ' nomer lineno : '  +lineno,
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