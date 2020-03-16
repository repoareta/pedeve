@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Panjar Dinas </h3>
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
				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
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
				Menu Tambah Uang Muka Kerja
			</h3>
		</div>
	</div>
	<div class="">
		<div class="card-body table-responsive" >
		<!--begin: Datatable -->
		<form  class="kt-form kt-form--label-right" id="form-update-umk">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							Header Uang Muka Kerja
						</div>
					</div>
                    @foreach($data_umks as $data_umk)
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. UMK</label>
						<div class="col-10">
                            <input  class="form-control" type="text" value="{{$data_umk->no_umk}}" id="no_umk" name="no_umk" size="25" maxlength="25" readonly>
                        </div>
					</div>
					<div class="form-group row">
						<label for="nopek-input" class="col-2 col-form-label">Tanggal</label>
						<div class="col-10">
                            <input class="form-control" type="text" name="tgl_panjar" value="<?php echo date("d/m/Y", strtotime($data_umk->tgl_panjar)) ?>" id="dat"  id="tgl_panjar" size="15" maxlength="15">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-email-input" class="col-2 col-form-label">Jenis Uang Muka</label>
						<div class="col-10">
						    <select class="form-control" id="jenis_um" name="jenis_um">
                                <option value="">-Pilih-</option>
								<option value="K" <?php if ($data_umk->jenis_um == 'K' ) echo 'selected' ; ?> >Uang Muka Kerja</option>
								<option value="D" <?php if ($data_umk->jenis_um == 'D' ) echo 'selected' ; ?>>Uang Muka Dinas</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="id-pekerja;-input" class="col-2 col-form-label">Bulan Buku</label>
						<div class="col-10">
                            <input class="form-control" type="text" value="{{$data_umk->bulan_buku}}"   name="bulan_buku" size="6" maxlength="6">
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
                            <input class="form-control" type="text" value="{{$data_umk->ci}}" name="ci" id="ci" size="1" maxlength="1" >
						</div>
					</div>
					<div class="form-group row">
						<label for="tujuan-input" class="col-2 col-form-label">Kurs</label>
						<div class="col-10">
                            <input class="form-control" type="text" value="<?php echo number_format($data_umk->rate, 0, ',', '.'); ?>" name="kurs" id="kurs" size="10" maxlength="10">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-2 col-form-label">Untuk</label>
						<div class="col-10">
                            <input  class="form-control" type="text" value="{{$data_umk->keterangan}}" name="untuk" id="untuk" size="70" maxlength="200">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-2 col-form-label">Jumlah</label>
						<div class="col-10">
                            <input  class="form-control" type="text" value="Rp. <?php echo number_format($count, 0, ',', '.'); ?>"  size="16" maxlength="16" readonly>
							<input  class="form-control" type="text" value="{{$count}}" name="jumlah" id="jumlah" size="16" maxlength="16" hidden readonly>
						</div>
					</div>
					<div style="float:right;">
						<div class="kt-form__actions">
							<a  href="{{route('uang_muka_kerja.tampil')}}" class="btn btn-warning">Cancel</a>
							<button type="submit" class="btn btn-brand">Save</button>
						</div>
					</div>
                    @endforeach
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
							<th >No.</th>
							<th >Keterangan</th>
							<th >Account</th>
							<th >Bagian</th>
							<th >PK</th>
							<th >JB</th>
							<th >KK</th>
							<th >Jumlah</th>
						</tr>
					</thead>
					<tbody>
                    <?php $no=0; ?>
					@foreach($data_umk_details as $data_umk_detail)
					<?php $no++; ?>
						<tr class="table-info">
							<th scope="row">{{$no}}</th>
							<td id="keterangan">{{$data_umk_detail->keterangan}}</td>
							<td>{{$data_umk_detail->account}}</td>
							<td>{{$data_umk_detail->bagian}}</td>
							<td>{{$data_umk_detail->pk}}</td>
							<td>{{$data_umk_detail->jb}}</td>
							<td>{{$data_umk_detail->pk}}</td>
							<td>Rp. <?php echo number_format($data_umk_detail->nilai, 0, ',', '.'); ?></td>
						</tr>
					@endforeach
					</tbody>
                        <tr>
                            <td colspan="7" align="right">Jumlah Total : </td>
                            <td >Rp. <?php echo number_format($count, 0, ',', '.'); ?></td>
                        </tr>
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
				<h5 class="modal-title" id="exampleModalLabel">Tambah Detail Uang Muka Kerja</h5>
			</div>
			<div class="modal-body">
                <form  class="kt-form" id="form-tambah-umk-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        @foreach($data_umks as $data_umk)
                        <input  class="form-control" hidden type="text" value="{{$data_umk->no_umk}}" id="no_umk" name="no_umk">
                        @endforeach
                    <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-2">
							<input  class="form-control" type="text" value="{{$no_umk_details}}" id="no" name="no" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Keterangan</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" id="keterangan" name="keterangan">
						</div>
					</div>
									
																					
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Account</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-6">
							<select name="acc" id="acc" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
												@foreach($data_account as $row)
								<option value="{{$row->kodeacct}}">{{$row->kodeacct}} - {{$row->descacct}}</option>
												@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Kode Bagian</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-6">
							<select name="bagian" id="bagian" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
												@foreach($data_bagian as $row)
								<option value="{{$row->kode}}">{{$row->kode}} - {{$row->nama}}</option>
												@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Perintah Kerja</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-4">
							<input  class="form-control" type="text" value="000" id="pk" name="pk" size="6" maxlength="6">
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jenis Biaya</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-6">
							<select name="jb" id="jb" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
												@foreach($data_jenisbiaya as $row)
								<option value="{{$row->kode}}">{{$row->kode}} - {{$row->keterangan}}</option>
												@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">C. Judex</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-6">
							<select name="cj" id="cj" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
												@foreach($data_cj as $row)
								<option value="{{$row->kode}}">{{$row->kode}} - {{$row->nama}}</option>
												@endforeach
							</select>
						</div>
					</div>
									

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jumlah</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-4">
							<input  class="form-control" type="text" value="" id="nilai" name="nilai">
						</div>
					</div>

																					
					<div style="float:right;">
						<button type="reset"  class="btn btn-warning" id="btn-cencel" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-brand">Save</button>
					</div>
				</form>
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
    
//update
$('#form-update-umk').submit(function(){
        var no_umk = $("#noumk").val();
		$.ajax({
			url  : "{{route('uang_muka_kerja.addumk')}}",
			type : "POST",
			data : $('#form-update-umk').serialize(),
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
                    window.location.replace("{{route('uang_muka_kerja.tampil')}}");;
                });
			}, 
			error : function(){
				alert("Ada kesalahan aplikasi");
			}
		});	
		return false;
    });

    //create detail
    $('#form-tambah-umk-detail').submit(function(){
		$.ajax({
			url  : "{{route('uang_muka_kerja.addumkdetail')}}",
			type : "POST",
			data : $('#form-tambah-umk-detail').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
                swal({
                    title: "Wow!",
                    text: "Message!",
                    type: "success"
                }).then(function() {
                    location.reload();
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