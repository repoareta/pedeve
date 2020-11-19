@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Set User </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Administrator </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Set User</span>
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
				Tabel Set User
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{ route('set_user.create') }}">
							<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
								<i class="fas fa-plus-circle"></i>
							</span>
						</a>
						<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
							<i class="fas fa-edit" id="editRow"></i>
						</span>

						<span style="font-size: 2em;"  class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
							<i class="fas fa-times-circle" id="deleteRow"></i>
						</span>
						<span style="font-size: 2em;" class="kt-font-info pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Cetak Data">
								<i class="fas fa-print" id="exportRow"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table" width="100%">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>USER ID</th>
					<th>USER NAME  </th>
					<th>USER GROUP </th>
					<th>USER LEVEL</th>
					<th>USER APPLICATION</th>
					<th>RESET PASSWORD</th>
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
			<form class="kt-form kt-form--label-right" action="{{ route('set_user.export') }}" method="post" target="_blank">
			{{csrf_field()}}
				<div class="modal-body">

					<div class="form-group row">
						<label for="" class="col-2 col-form-label"></label>
						<div class="col-8">
							<div class="kt-radio-inline">
								<label class="kt-radio kt-radio--solid">
									<input type="radio"  name="cetak" value="A" onclick="displayResult(1)" checked/> Cetak All
									<span></span>
								</label>
								<label class="kt-radio kt-radio--solid">
									<input type="radio"    name="cetak" value="B" onclick="displayResult(2)" /> Cetak Per User
									<span></span>
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="" class="col-2 col-form-label"></label>
						<div class="col-8" id="userid">
							<select name="userid"  class="form-control selectpicker" data-live-search="true" oninvalid="this.setCustomValidity('Dibayar Kepada Harus Diisi..')" onchange="setCustomValidity('')">
								@foreach ($data as $row)
								<option value="{{ $row->userid }}">{{ $row->userid }}</option>
								@endforeach
							</select>
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
			scrollX   : true,
			processing: true,
			serverSide: true,
			searching: true,
			lengthChange: true,
			pageLength: 200,
			language: {
				processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
			},
			ajax      : {
						url: "{{ route('set_user.search.index') }}",
						type : "POST",
						dataType : "JSON",
						headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
						},
						data: function (d) {
							d.pencarian = $('input[name=pencarian]').val();
						}
					},
			columns: [
				{data: 'radio', name: 'aksi', orderable: false, searchable: false, class:'radio-button'},
				{data: 'userid', name: 'userid'},
				{data: 'usernm', name: 'usernm'},
				{data: 'kode', name: 'kode'},
				{data: 'userlv', name: 'userlv'},
				{data: 'userap', name: 'userap'},
				{data: 'reset', name: 'reset'},
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
								url: "{{ route('set_user.delete') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"kode": kode,
									"_token": "{{ csrf_token() }}",
								},
								success: function (data) {
									Swal.fire({
										type  : 'success',
										title : "Data Set User dengan jenis  : " +kode+" Berhasil Dihapus.",
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
					location.replace("{{url('administrator/set_user/edit')}}"+ '/' +no);
				});
			} else {
				swalAlertInit('ubah');
			}
		});

		$('#exportRow').click(function(e) {
			e.preventDefault();
				$('#cetakModal').modal('show');
				$('#userid').hide();
		});

	});
	function displayResult(cetak){ 
		if(cetak == 1)
		{
			$('#userid').val(1);
			$('#userid').hide();
		}else{
			$('#userid').val("");
			$('#userid').show();
		}
	}

	function hanyaAngka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

		return false;
		return true;
	}

</script>
@endsection