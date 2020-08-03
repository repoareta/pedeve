@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Posisi Saldo Deposito PT.Pertamina Dana Ventura </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Posisi Saldo Deposito</span>
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
				Tabel Posisi Saldo Deposito
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',509)->limit(1)->get() as $data_akses)
						@if($data_akses->hapus == 1)		
						<span style="font-size: 2em;" class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
							<i class="fas fa-trash"></i>
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
			<form class="kt-form" method="post" action="{{ route('perhitungan_bagihasil.index.search')}}" >
			{{csrf_field()}}
				<div class="form-group row col-12">	
					<label for="" class="col-form-label">Tanggal</label>
					<div class="col-2">
						<input class="form-control" type="text" name="tanggal" id="tanggal" value="{{$date}}" size="10" maxlength="10" onkeypress="return hanyaAngka(event)" autocomplete='off'>
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
					<th>NAMA BANK</th>
					<th>NO SERI/REKENING</th>
					<th>ASAL DANA</th>
					<th>CURRENCY INDEX</th>
					<th>NOM DEPOSITO(Rp.)</th>
					<th>KURS</th>
					<th>TGL. DEP</th>
					<th>TGL. J.T</th>
					<th>BUNGA %/THN</th>
					<th>RATA TERTIMBANG</th>
				</tr>
			</thead>
			<tbody>
			@foreach($data_list as $data)
				<tr>
					<td><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" name="btn-radio" nodok="{{$data->docno}}" lineno="{{$data->lineno}}"><span></span></label></td>
					<td>{{ $data->nmbank }}</td>
					<td>{{ $data->noseri }}</td>
					<td>{{ $data->asal }}</td>
					<?php
						 if ($data->kurs > "1") {
							$nmkurs = "DOLLAR";
						}else{
							$nmkurs = "RUPIAH";
						}

						$tgldep = date_create($data->tgldepo);
						$tgldepo = date_format($tgldep, 'd/m/Y');
						$tgltem = date_create($data->tgltempo);
						$tgltempo = date_format($tgltem, 'd/m/Y');
					?>
					<td>{{ $nmkurs }}</td>
					<td>{{ number_format($data->asli,2) }}</td>
					<td>{{ number_format($data->kurs,2) }}</td>
					<td>{{ $tgldepo }}</td>
					<td>{{ $tgltempo }}</td>
					<td>{{ number_format($data->bungatahun,2) }}</td>
					<td>{{ number_format($data->rtimbang,2) }}</td>
				</tr>
			@endforeach
			</tbody>
			<?php 
				$a=0;
				foreach($data_list as $dat)
				{
					$a++;
					$totalrupiah[$a] = $dat->totalrupiah;
					$totaldollar[$a] = $dat->totaldollar;
					$totalrata[$a] = $dat->totalrata;
					$total[$a] = $dat->total;
					$ekivalen[$a] = $dat->ekivalen;
				}
			?>
			@if(!empty($data_list))
			<tr><td colspan="5"><b>Total Rupiah : Rp.</b></td><td align="right" bgcolor="#CCFF99">{{number_format(array_sum($totalrupiah),2)}}</td><td colspan="4"><b>Total Rata Tertimbang:</b><td align="center" bgcolor="#CCFF99"><b>{{number_format(array_sum($totalrata),2)}}</b></td></tr>
			<tr><td colspan="5"><b>Total Dollar   : $.</b></td><td align="right" bgcolor="#CCFF99"> {{number_format(array_sum($totaldollar),2)}}</td><td colspan="5"></td></tr>
			<tr><td colspan="5"><b>Ekivalen       : Rp.</b></td><td align="right" bgcolor="#CCFF99">{{number_format(array_sum($ekivalen),2)}}</td><td colspan="5"></td></tr>
			<tr><td colspan="5"><b>Total          : Rp.</b></td><td align="right" bgcolor="#CCFF99"><b>{{number_format(array_sum($total),2)}}</b></td><td colspan="5"></td></tr>
			@endif
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
	$('#search-form').on('submit', function(e) {
		
	});
	
		

		// minimum setup
		$('#tanggal').datepicker({
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
			// language : 'id',
			format   : 'yyyy-mm-dd'
		});

//delete Posisi Saldo Deposito PT.Pertamina Dana Ventura
$('#deleteRow').click(function(e) {
	e.preventDefault();
	if($('input[type=radio]').is(':checked')) { 
		$("input[type=radio]:checked").each(function() {
			var nodok = $(this).attr('nodok').split("/").join("-");
			var lineno = $(this).attr('lineno');
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
						url: "{{ route('perhitungan_bagihasil.delete') }}",
						type: 'DELETE',
						dataType: 'json',
						data: {
							"nodok": nodok,
							"lineno": lineno,
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

		$('#exportRow').click(function(e) {
			e.preventDefault();
			location.replace("{{route('perhitungan_bagihasil.rekap')}}");
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