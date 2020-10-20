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
<form  class="kt-form kt-form--label-right"  id="form-create">
{{csrf_field()}}
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
			User ID : {{$userid}}<input name="jumlah" value="{{$jumlah}}" type="hidden">
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
									<a  href="{{route('set_menu.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-text="true"></i>Cancel</a>
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
					<th style=" width: 17px;height: 26px;margin-left:50px;">ABILITY ALL<br>
						<input style=" width: 17px;height: 26px;margin-left:50px;" type="checkbox" id="checkedall">
					</th>
					<th>MENU ID</th>
					<th>MENU NAME  </th>
					<th>USER APPLICATION</th>
				</tr>
			</thead>
			<tbody>
			<?php $a=0; ?>
			@foreach($data_user as $data)
			<?php $a++; ?>
			<tr>
			<input class="checksingle1" name="userid{{$a}}" value="{{$data->userid}}" type="hidden">
			<input style=" width: 17px;height: 26px;margin-left:50px;" class="checksingle2" name="menuid{{$a}}" type="hidden" value="{{$data->menuid}}">
				<td>
					<input style=" width: 17px;height: 26px;margin-left:50px;" class="checksingle3" name="ability{{$a}}" type="checkbox" value="1" <?php if ($data->ability == '1' )  echo 'checked' ; ?>></td>
					
				</td>
				<td>{{$data->menuid}}</td>
				<td>{{$data->menunm}}</td>
				<td>
				<?php
					if($data->userap == 'UMU'){
						$userap = 'UMUM';
					}elseif($data->userap == 'SDM'){
						$userap = 'SDM & Payroll';
					}elseif($data->userap == 'PBD'){
						$userap = 'PERBENDAHARAAN';
					}elseif($data->userap == 'AKT'){
						$userap = 'KONTROLER';
					}else{
						$userap = 'CUSTOMER MANAGEMENT';
					}
					echo $userap;
				?>
				</td>
			</tr>
			@endforeach
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
			pageLength: 200,
		});

		$("#checkedall").change(function() {
			if (this.checked) {
				$(".checksingle1").each(function() {
					this.checked=true;
				});
				$(".checksingle2").each(function() {
					this.checked=true;
				});
				$(".checksingle3").each(function() {
					this.checked=true;
				});
			} else {
				$(".checksingle1").each(function() {
					this.checked=false;
				});
				$(".checksingle2").each(function() {
					this.checked=false;
				});
				$(".checksingle3").each(function() {
					this.checked=false;
				});
			}
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