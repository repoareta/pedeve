@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Lembur </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Lembur</span>
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
				Tabel Payroll Lembur
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{ route('lembur.create') }}">
							<span style="font-size: 2em;" class="kt-font-success">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
	
							<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah data">
								<i class="fas fa-edit" id="editRow"></i>
							</span>
	
							<span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus data">
								<i class="fas fa-times-circle" id="deleteRow"></i>
							</span>
							<!-- <span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cetak data">
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
		<div style="float:right;"><form action="{{route('lembur.search.index')}}" method="post">{{csrf_field()}}
			<p style="font-weight:bold;">
			No. Pegawai: <select style="width:10%;height:30px;box-radius:50%;border-radius:30px;" name="nopek" id="nopek" class="selectpicker" data-live-search="true">
						<option value="">- Pilih -</option>
						@foreach($data_pegawai as $data)
						<option value="{{$data->nopeg}}">{{$data->nopeg}} - {{$data->nama}}</option>
						@endforeach
					</select>
								
			Bulan/Tahun: <input style="width:10%;height:40px;box-radius:20%;border-radius:10px;"  name="tanggal" id="tanggal" type="text" size="4" maxlength="4" value="" onkeypress="return hanyaAngka(event)" autocomplete='off'>  
			<button type="submit" style="font-size: 20px;margin-left:5px;border-radius:10px;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cari Data"> <i class="fa fa-search"></i></button>  
			</form>
		</div>
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>Tanggal</th>
					<th>No.Peg</th>
					<th>Makan Pagi</th>
					<th>Makan Siang</th>
					<th>Makan Malam</th>
					<th>Transport</th>
					<th>Lembur</th>
					<th>Jumlah</th>
				</tr>
			</thead>
			<tbody>
			@foreach($data_list as $data)
				<tr>
					<td>
					<?php 
						$tgl = date_create($data->tanggal);
						$tanggal = date_format($tgl, 'd-m-Y'); 
					?>
						<?php echo '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" data-tanggal="'.$tanggal.'"  data-nopek="'.$data->nopek.'" class="btn-radio" name="btn-radio-rekap"><span></span></label>'; ?>
					</td>
					<td>
					<?php 
						$tgl = date_create($data->tanggal);
					echo date_format($tgl, 'd F Y') ?>
					</td>
					<td>{{$data->nopek}}-{{$data->nama_nopek}}</td>
					<td>Rp. <?php echo number_format($data->makanpg, 2, '.', ',') ?></td>
					<td>Rp. <?php echo number_format($data->makansg, 2, '.', ',') ?></td>
					<td>Rp. <?php echo number_format($data->makanml, 2, '.', ',') ?></td>
					<td>Rp. <?php echo number_format($data->transport, 2, '.', ',') ?></td>
					<td>Rp. <?php echo number_format($data->lembur, 2, '.', ',') ?></td>
					<td>Rp. <?php echo number_format($data->total, 2, '.', ',') ?></td>
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

//refresh data
$('#show-data').on('click', function(e) {
	e.preventDefault();
		location.replace("{{ route('lembur.index') }}");

});

//edit lembur
$('#editRow').click(function(e) {
	e.preventDefault();

	if($('input[class=btn-radio]').is(':checked')) { 
		$("input[class=btn-radio]:checked").each(function(){
			var tanggal = $(this).attr('data-tanggal');
			var nopek = $(this).attr('data-nopek');
			location.replace("{{url('sdm/lembur/edit')}}"+ '/' +tanggal+ '/'+nopek);
		});
	} else {
		swalAlertInit('ubah');
	}
});

//delete lembur
$('#deleteRow').click(function(e) {
e.preventDefault();
if($('input[class=btn-radio]').is(':checked')) { 
	$("input[class=btn-radio]:checked").each(function() {
		var tanggal = $(this).attr('data-tanggal');
		var nopek = $(this).attr('data-nopek');
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
				text: "Tanggal  : " +tanggal+ " nopek : " +nopek,
				type: 'warning',
				showCancelButton: true,
				reverseButtons: true,
				confirmButtonText: 'Ya, hapus',
				cancelButtonText: 'Batalkan'
			})
			.then((result) => {
			if (result.value) {
				$.ajax({
					url: "{{ route('lembur.delete') }}",
					type: 'DELETE',
					dataType: 'json',
					data: {
						"tanggal": tanggal,
						"nopek": nopek,
						"_token": "{{ csrf_token() }}",
					},
					success: function () {
						Swal.fire({
							type  : 'success',
							title : "Data Lembur Tanggal  : " +tanggal+ " Nopek : " +nopek+ " Berhasil DIhapus.",
							text  : 'Berhasil',
							
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


	var KTBootstrapDatepicker = function () {

var arrows;
if (KTUtil.isRTL()) {
	arrows = {
		leftArrow: '<i class="la la-angle-right"></i>',
		rightArrow: '<i class="la la-angle-left"></i>'
	}
} else {
	arrows = {
		leftArrow: '<i class="la la-angle-left"></i>',
		rightArrow: '<i class="la la-angle-right"></i>'
	}
}

// Private functions
var demos = function () {

	// minimum setup
	$('#tanggal').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'mm/yyyy'
	});
};

return {
	// public functions
	init: function() {
		demos(); 
	}
};
}();

KTBootstrapDatepicker.init();
});

function hanyaAngka(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))

	return false;
	return true;
}
</script>
@endsection