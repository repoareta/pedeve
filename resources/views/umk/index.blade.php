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
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<a href="{{ route('uang_muka_kerja.create') }}">
						<span style="font-size: 2em;" class="kt-font-success">
							<i class="fas fa-plus-circle"></i>
						</span>
					</a>
	
					<a href="#">
						<span style="font-size: 2em;" class="kt-font-warning">
							<i class="fas fa-edit" id="btn-edit-umk"></i>
						</span>
					</a>
	
					<a href="#">
						<span style="font-size: 2em;"  class="kt-font-danger">
							<i class="fas fa-times-circle" id="deleteRow"></i>
						</span>
					</a>

					<a href="#">
						<span style="font-size: 2em;" class="kt-font-info">
							<i class="fas fa-file-export"></i>
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="card-body table-responsive">
		<!--begin: Datatable -->
		<table id="data-umk-table" class="table table-striped table-bordered table-hover table-checkable">
			<thead class="thead-light">
				<tr>
					<th><input type="radio" hidden name="btn-radio"  data-id="1" class="btn-radio" checked ></th>
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
				
			</tbody>
		</table>

		<!--end: Datatable -->
		</div>
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
			serverSide: true,
			language: {
            	processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
		ajax: {
            url: "{{ route('uang_muka_kerja.index.json') }}",
		},
		columns: [
			{
				data: 'radio',
				name: 'radio',
				// orderable: false
			},
			{
				data: 'tgl_panjar',
				name: 'tgl_panjar'
			},
			{
				data: 'noumk',
				name: 'noumk'
			},
			{
				data: 'no_kas',
				name: 'no_kas'
			},
			{
				data: 'jenisum',
				name: 'jenisum'
			},
			{
				data: 'keterangan',
				name: 'keterangan'
			},
			{
				data: 'jumlah',
				name: 'jumlah'
			},
			{
				data: 'action',
				name: 'action',
				orderable: false
			}
		]
    });
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
		swal({
				title: "Tandai baris yang akan diedit!",
				type: "success"
				}) ;  
	}  else {  
		location.replace("/umum/uang_muka_kerja/edit/"+dataid);
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
					swal({
						title: "Tandai baris yang akan dihapus!",
						type: "success"
					}) ; 
				}  else { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).attr('dataumk');
					// delete stuff
					swal({
						title: "Data yang akan di hapus?",
						text: "No. UMK : " + id,
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								url: "{{ route('uang_muka_kerja.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"id": id,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									swal({
											title: "Delete",
											text: "Success",
											type: "success"
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
</script>
@endsection