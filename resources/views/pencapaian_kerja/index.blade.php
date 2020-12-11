@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Pencapaian Kinerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Customer Management </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Pencapaian Kinerja</span>
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
				Tabel Pencapaian Kinerja
			</h3>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',803)->limit(1)->get() as $data_akses)
						@if($data_akses->tambah == 1)
							<span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="modal" data-target="#cetakpencapaian" title="Tambah Data">
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
			<form class="kt-form" action="{{ route('pencapaian_kerja.search') }}" method="POST">
				@csrf
				<div class="form-group row col-12">
					<label for="" class="col-form-label">Bulan</label>
					<div class="col-2">
						<?php 
							$tgl = date_create(now());
							$bulan = date_format($tgl, 'm'); 
							$tahun = date_format($tgl, 'Y'); 
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
							
							$bulan_1 = ($array_bln[ltrim($bulan,0)]);
						?>
						<select class="form-control kt-select2" name="bulan">
							<option value="01" <?php if($bulan  == '01' ) echo 'selected' ; ?>>Januari</option>
							<option value="02" <?php if($bulan  == '02' ) echo 'selected' ; ?>>Februari</option>
							<option value="03" <?php if($bulan  == '03' ) echo 'selected' ; ?>>Maret</option>
							<option value="04" <?php if($bulan  == '04' ) echo 'selected' ; ?>>April</option>
							<option value="05" <?php if($bulan  == '05' ) echo 'selected' ; ?>>Mei</option>
							<option value="06" <?php if($bulan  == '06' ) echo 'selected' ; ?>>Juni</option>
							<option value="07" <?php if($bulan  == '07' ) echo 'selected' ; ?>>Juli</option>
							<option value="08" <?php if($bulan  == '08' ) echo 'selected' ; ?>>Agustus</option>
							<option value="09" <?php if($bulan  == '09' ) echo 'selected' ; ?>>September</option>
							<option value="10" <?php if($bulan  =='10'  ) echo 'selected' ; ?>>Oktober</option>
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
		<table id="kt_table" class="table table-striped table-bordered table-hover table-checkable" style="background-color:#ECF3F3;" >
			<thead  style="text-align:center;vertical-align:middle;">
				<tr>
					<th></th>
					<th>REALISASI</th>
					<th>EVALUASI</th>
				</tr>
			</thead>
			
			<tbody>
				
				@foreach ($data as $row)					
				<tr>
					<th>Perusahaan</th>
					<th>{{$row->nama}}</th>
					<th>{{$row->nama}}</th>
				</tr>
				<tr>
					<td>Aset</td>
					<td>{{number_format($row->aset,2)}}</td>
					<td>{{number_format($row->aset_r,2)}}</td>
				</tr>
				<tr>
					<td>Revenue</td>
					<td>{{number_format($row->revenue,2)}}</td>
					<td>{{number_format($row->revenue_r,2)}}</td>
				</tr>
				<tr>
					<td>Beban Pokok</td>
					<td>{{number_format($row->beban_pokok,2)}}</td>
					<td>{{number_format($row->beban_pokok_r,2)}}</td>
				</tr>
				<tr>
					<td>Laba Kotor</td>
					<td>{{number_format($row->beban_pokok+$row->revenue,2)}}</td>
					<td>{{number_format($row->beban_pokok_r+$row->revenue_r,2)}}</td>
				</tr>
				<tr>
					<td>Biaya Operasi</td>
					<td>{{number_format($row->biaya_operasi,2)}}</td>
					<td>{{number_format($row->biaya_operasi_r,2)}}</td>
				</tr>
				<tr>
					<td>Laba Operasi</td>
					<td>{{number_format($row->biaya_operasi+($row->beban_pokok+$row->revenue),2)}}</td>
					<td>{{number_format($row->biaya_operasi_r+($row->beban_pokok_r+$row->revenue_r),2)}}</td>
				</tr>
				<tr>
					<td>Laba Bersih</td>
					<td>{{number_format($row->laba_bersih,2)}}</td>
					<td>{{number_format($row->laba_bersih_r,2)}}</td>
				</tr>
				<tr>
					<td>TKP</td>
					<td>{{number_format($row->tkp,2)}}</td>
					<td>{{number_format($row->tkp_r,2)}}</td>
				</tr>
				<tr>
					<td>KPI</th>
					<td>{{number_format($row->kpi,2)}}</td>
					<td>{{number_format($row->kpi_r,2)}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<!--end: Datatable -->
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="cetakpencapaian" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Cetak Pencapaian Kinerja</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="{{ route('pencapaian_kerja.export') }}" method="GET" target="_blank">
				<div class="modal-body">
					<div class="form-group row">
						<label for="" class="col-2 col-form-label">Perusahaan</label>
						<div class="col-10">
							<select name="perusahaan" class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Dibayar Kepada Harus Diisi..')" onchange="setCustomValidity('')">
								<option value="A">- ALL -</option>
								@foreach ($data as $row)
								<option value="{{$row->id}}">{{$row->nama}}</option>
								@endforeach
							</select>
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
$(document).ready(function(){
	var t =$('#kt_table').DataTable({
		aaSorting: [],
		scrollX   : true,
		searching: false,
		lengthChange: false,
		pageLength: 100,
	});

	$('.kt-select2').select2().on('change', function() {
		$(this).valid();
	});
});		
</script>
@endsection