@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Koreksi Gaji </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Payroll </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Koreksi Gaji</span>
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
				Tabel Koreksi Gaji
			</h3>			
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<a href="{{ route('perjalanan_dinas.create') }}">
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

					<span style="font-size: 2em;" class="kt-font-info pointer-link" id="exportRow" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
						<i class="fas fa-print"></i>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">

		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
		<!-- <th colspan="4"><form action="" method="post" enctype="multipart/form-data">
          <p style="padding-top:15px;"><input style="height:25px; border-radius:10px;" maxlength="16" onkeypress="return number(event)"  required name="ktp"  type="text" placeholder="No KTP/NPWP" autocomplete="off" >  
            <select style="height:25px; border-radius:10px;" name="reason"  required>
                <option value="">Pilih Reason</option> 
                <option value="1">Borrower Baru</option> 
                <option value="2">Monitoring Borrower </option>
            </select> 
            <input style="height:25px; border-radius:10px;" name="submit" type="submit"  value="Search">
            </p>
        </form></th> -->
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>Bulan</th>
					<th>Pegawai</th>
					<th>AARD</th>
					<th>Nilai</th>
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
			searching: false,
			scrollX   : true,
			processing: true,
			serverSide: true,
			language: {
            	processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax      : "{{ route('potongan_koreksi_gaji.index.json') }}",
			columns: [
				{data: 'tahunbulan', name: 'tahunbulan'},
				{data: 'bulan', name: 'bulan'},
				{data: 'nama', name: 'nama'},
				{data: 'aard', name: 'aard'},
				{data: 'nilai', name: 'nilai'},
			]
    	});			
	});

	</script>
@endsection