@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Set Menu </h3>
			<span class="kt-subheader__separator kt-text"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Administrator </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Set Menu</span>
			</div>
		</div>
	</div>
</div>
<!-- end:: Subheader -->
<!-- <formmmm  class="kt-form kt-form--label-right" method="post" action="{{route('set_menu.update')}}"  id="form-creates"> -->
<form  class="kt-form kt-form--label-right" method="post" action="{{route('set_menu.update')}}"  id="form-creates">
{{csrf_field()}}
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
			User ID : {{$userid}}
			</h3>			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-4">
									<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-text="true"></i>Save</button>
								</div>
								<div class="col-4">
									<a  href="{{route('set_user.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-text="true"></i>Cancel</a>
								</div>
							</div>
						</div>
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
					<th>ABILITY</th>
					<th>MENU ID</th>
					<th>MENU NAME  </th>
				</tr>
			</thead>
			<tbody>
			<?php $a=0; ?>
			@foreach($data_user as $data)
			<?php $a++; ?>
			<tr>
			<input name="userid{{$a}}" value="{{$userid}}" type="hidden">
			<input style=" width: 17px;height: 26px;margin-left:50px;" name="menuid{{$a}}" type="hidden" value="{{$data->menuid}}">
				<td>
					<input style=" width: 17px;height: 26px;margin-left:50px;" name="ability{{$a}}" type="checkbox" value="1" <?php if ($data->ability == '1' )  echo 'checked' ; ?>></td>
					
				</td>
				<td>{{$data->menuid}}</td>
				<td>{{$data->menunm}}</td>
			</tr>
			@endforeach
			<input name="a" value="{{$a[$a]}}" type="hidden">
			</tbody>
		</table>

		<!--end: Datatable -->
	</div>
</div>
</div>
</from>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function () {
		$('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
		});

		$('#form-create').submit(function(){
			$.ajax({
				url  : "{{route('set_menu.update')}}",
				type : "POST",
				data : $('#form-create').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
					console.log(data);
					Swal.fire({
						type  : 'success',
						title : 'Data Berhasil Diubah',
						text  : 'Berhasil',
						timer : 2000
					}).then(function(data) {
						window.location.replace("{{ route('set_menu.index') }}");
						});

				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
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