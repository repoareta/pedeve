@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Data Perkara </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Customer Management </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Data Perkara</span>
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
			INFORMASI DETAIL PERKARA
			</h3>			
		</div>
	</div>
	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th>No. Perkara</th>
					<th>Jenis</th>
					<th>Status Perkara</th>
				</tr>
			</thead>
			<tbody>
			@foreach($data_list as $data)
				<tr>
					<td>{{$data->no_perkara}}</td>
					<td>{{$data->jenis_perkara}}</td>
					<td>{{$data->status_perkara}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
			<div class="kt-portlet__head kt-portlet__head">
				<div class="kt-portlet__head-toolbar">
					<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-primary" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#detail_umum" id="reload-umum" role="tab" aria-selected="true">
							Data Umum
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#detail_pihak" id="reload-pihak" role="tab" aria-selected="false">
							Pihak
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#detail_hakim" id="reload-hakim" role="tab" aria-selected="false">
							Kuasa Hukum
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#detail_dokumen" role="tab" aria-selected="false">
							Dokumen Perkara
							</a>
						</li>
						<li class="nav-item">
						<a  href="{{route('data_perkara.index')}}" class="btn btn-primary"><i class="fa fa-reply" aria-hidden="true"></i>Kembali</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="kt-portlet__body" style="padding-top:10px">
				<div class="tab-content">
					<div class="tab-pane active" id="detail_umum">
						@include('data_perkara.detail_umum')
					</div>

					<div class="tab-pane" id="detail_pihak">
						@include('data_perkara.detail_pihak')
					</div>

					<div class="tab-pane" id="detail_hakim">
						@include('data_perkara.detail_hakim')
					</div>

					<div class="tab-pane" id="detail_dokumen">
						@include('data_perkara.detail_dokumen')
					</div>
				</div>
			</div>

		<!--end: Datatable -->
	</div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function () {
		$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function() {
					var kode = $(this).attr('kode');
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
							text: "Jenis  : " +kode,
							type: 'warning',
							showCancelButton: true,
							reverseButtons: true,
							confirmButtonText: 'Ya, hapus',
							cancelButtonText: 'Batalkan'
						})
						.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('data_perkara.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"kode": kode,
									"_token": "{{ csrf_token() }}",
								},
								success: function (data) {
									Swal.fire({
										type  : 'success',
										title : "Data Data Perkara dengan jenis  : " +kode+" Berhasil Dihapus.",
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

		//edit 
		$('#editRow').click(function(e) {
			e.preventDefault();

			if($('input[class=btn-radio]').is(':checked')) { 
				$("input[class=btn-radio]:checked").each(function(){
					var no = $(this).attr('kode');
					location.replace("{{url('administrator/data_perkara/edit')}}"+ '/' +no);
				});
			} else {
				swalAlertInit('ubah');
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
@yield('detail_pihak_script')
@yield('detail_hakim_script')
@yield('detail_umum_script')
@endsection