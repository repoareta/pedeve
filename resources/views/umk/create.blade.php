@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Uang muka Kerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Uang Muka Kerja </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Tambah</span>
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
				Tambah Uang Muka Kerja
			</h3>
		</div>
	</div>
	<div class="">
		<div class="card-body table-responsive" >
		<!--begin: Datatable -->
		<form  class="kt-form kt-form--label-right" id="form-create-umk">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							Header Uang Muka Kerja
						</div>
					</div>
				
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. UMK</label>
						<div class="col-10">
							<?php $a = str_replace('/', '-', $no_umk); ?>
							<input  class="form-control" type="hidden" value="{{$a}}" id="noumk"  size="25" maxlength="25" readonly>
							<input  class="form-control" type="text" value="{{$no_umk}}" id="no_umk" name="no_umk" size="25" maxlength="25" readonly required>
						</div>
					</div>
					<div class="form-group row">
						<label for="nopek-input" class="col-2 col-form-label">Tanggal</label>
						<div class="col-10">
							<input class="form-control" type="text" name="tgl_panjar" value="" data-date-format="dd/MM/yyyy" id="datepicker" id="tgl_panjar" size="15" maxlength="15" required>

						</div>
					</div>
					<div class="form-group row">
						<label for="example-email-input" class="col-2 col-form-label">Jenis Uang Muka</label>
						<div class="col-10">
						<select class="form-control" id="jenis_um" name="jenis_um" required>
							<option value="">-Pilih-</option>
							<option value="K" >Uang Muka Kerja</option>
							<option value="D" >Uang Muka Dinas</option>
						</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="id-pekerja;-input" class="col-2 col-form-label">Bulan Buku</label>
						<div class="col-10">
							<input class="form-control" type="text" value="" data-date-format="yyyymm" id="bulan_buku" name="bulan_buku" size="6" maxlength="6" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="jenis-dinas-input" class="col-2 col-form-label">No. Panjar</label>
						<div class="col-10">
							<input class="form-control" type="text" value="" name="no_panjar" id="no_panjar">
						</div>
					</div>
					<div class="form-group row">
						<label for="dari-input" class="col-2 col-form-label">Mata Uang</label>
						<div class="col-10">
							<input class="form-control" type="text" value="" name="ci" id="ci" size="1" maxlength="1" >
						</div>
					</div>
					<div class="form-group row">
						<label for="tujuan-input" class="col-2 col-form-label">Kurs</label>
						<div class="col-10">
							<input class="form-control" type="text" value="" name="kurs" id="kurs" size="10" maxlength="10">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-2 col-form-label">Untuk</label>
						<div class="col-10">
							<input  class="form-control" type="text" value="" name="untuk" id="untuk" size="70" maxlength="200" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-2 col-form-label">Jumlah</label>
						<div class="col-10">
							<input  class="form-control" type="text" value="" name="jumlah" id="jumlah" size="70" maxlength="200" readonly value="Rp. 0,-">
						</div>
					</div>
					<div style="float:right;">
						<div class="kt-form__actions">
							<a  href="{{route('uang_muka_kerja.index')}}" class="btn btn-warning">Cancel</a>
							<button type="submit" class="btn btn-brand">Save</button>
						</div>
					</div>
				</div>
			</div>

			

				
			<div class="kt-portlet__head kt-portlet__head">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="kt-font-brand flaticon2-line-chart"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						Detail Uang Muka Kerja
					</h3>			
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<div class="kt-portlet__head-actions">
							<a href="#" data-toggle="modal" data-target="#kt_modal_4">
								<span style="font-size: 2em;" class="kt-font-success">
									<i class="fas fa-plus-circle"></i>
								</span>
							</a>
			
							<a href="#">
								<span style="font-size: 2em;" class="kt-font-warning">
									<i class="fas fa-edit"></i>
								</span>
							</a>
			
							<a href="#">
								<span style="font-size: 2em;" class="kt-font-danger">
									<i class="fas fa-times-circle"></i>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
					<thead class="thead-light">
						<tr>
							<th>No</th>
							<th>Nopek</th>
							<th>Nama</th>
							<th>Gol</th>
							<th>Jabatan</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</form>
		<!--end: Datatable -->
		</div>
	</div>
</div>
</div>

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New message</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Recipient:</label>
						<input type="text" class="form-control" id="recipient-name">
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Message:</label>
						<textarea class="form-control" id="message-text"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Send message</button>
			</div>
		</div>
	</div>
</div>

<!--end::Modal-->
@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		$('#kt_table').DataTable();
	});

    $('#datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#dat').datepicker({
        
    });
    $('#datepicker').datepicker("setDate", new Date());
    $('#bulan_buku').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
	$('#bulan_buku').datepicker("setDate", new Date());
	
	//create
	$('#form-create-umk').submit(function(){
        var no_umk = $("#noumk").val();
		$.ajax({
			url  : "{{route('uang_muka_kerja.store')}}",
			type : "POST",
			data : $('#form-create-umk').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
			   console.log(data);
				swal({
                    title: "Wow!",
                    text: "Message!",
                    type: "success"
                }).then(function() {
                    window.location.replace("/umum/uang_muka_kerja/detail/"+no_umk);;
                });
			}, 
			error : function(){
				alert("Ada kesalahan aplikasi");
			}
		});	
		return false;
	});
</script>

@endsection
