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
							<h5 class="kt-portlet__head-title">
								Header Uang Muka Kerja
							</h5>	
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
                            <input class="form-control" type="text" value="<?php echo number_format($data_umk->rate, 0, ',', '.'); ?>" name="kurs"  size="10" maxlength="10">
                            <input class="form-control" type="text" hidden value="{{$data_umk->rate}}" name="kurs"  size="10" maxlength="10">
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
							<a  href="{{route('uang_muka_kerja.index')}}" class="btn btn-warning">Cancel</a>
							<button type="submit" class="btn btn-brand">Save</button>
						</div>
					</div>
                    @endforeach
				</div>
			</div>
			</form>


			

				
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
							<a href="#" id="btn-create-detail" data-target="#kt_modal_4">
								<span style="font-size: 2em;" class="kt-font-success">
									<i class="fas fa-plus-circle"></i>
								</span>
							</a>
			
							<a href="#">
								<span style="font-size: 2em;" class="kt-font-warning">
									<i class="fas fa-edit" id="btn-edit-detail"></i>
								</span>
							</a>
			
							<a href="#">
								<span style="font-size: 2em;" class="kt-font-danger">
									<i class="fas fa-times-circle" id="deleteRow"></i>
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
							<th ><input type="radio" hidden name="btn-radio"  data-id="1" class="btn-radio" checked ></th>
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
							<td scope="row" align="center"><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="btn-radio" data-no="{{$data_umk_detail->no}}"  data-id="{{str_replace('/', '-', $data_umk_detail->no_umk)}}" value="{{$data_umk_detail->no_umk}}" class="btn-radio" ><span></span></label></td>
							<td scope="row" align="center">{{$no}}</td>
							<td>{{$data_umk_detail->keterangan}}</td>
							<td align="center">{{$data_umk_detail->account}}</td>
							<td align="center">{{$data_umk_detail->bagian}}</td>
							<td align="center">{{$data_umk_detail->pk}}</td>
							<td align="center">{{$data_umk_detail->jb}}</td>
							<td align="center">{{$data_umk_detail->cj}}</td>
							<td>Rp. <?php echo number_format($data_umk_detail->nilai, 0, ',', '.'); ?></td>
						</tr>
					@endforeach
					</tbody>
                        <tr>
                            <td colspan="8" align="right">Jumlah Total : </td>
                            <td >Rp. <?php echo number_format($count, 0, ',', '.'); ?></td>
                        </tr>
				</table>
			</div>
		<!--end: Datatable -->
		</div>
	</div>
</div>
</div>

<!--begin::Modal creaate--> 
<div class="modal fade modal-create-detail-umk" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail"></h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-tambah-umk-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        @foreach($data_umks as $data_umk)
                        <input  class="form-control" hidden type="text" value="{{$data_umk->no_umk}}"  name="no_umk">
                        @endforeach
                    <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-2">
							<input  class="form-control" type="text" value="{{$no_umk_details}}"  name="no" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Keterangan</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="text" value=""  name="keterangan">
						</div>
					</div>
									
																					
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Account</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div  class="col-3" >
							<select name="acc"  class="form-control selectpicker" data-live-search="true">
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
						<div  class="col-3">
							<select name="bagian"  class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_bagian as $row)
								<option value="{{$row->kode}}" >{{$row->kode}} - {{$row->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Perintah Kerja</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-4">
							<input  class="form-control" type="text" value="000"  name="pk" size="6" maxlength="6">
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jenis Biaya</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div  class="col-3">
							<select name="jb"  class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_jenisbiaya as $row)
								<option value="{{$row->kode}}" >{{$row->kode}} - {{$row->keterangan}}</option>
									@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">C. Judex</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-3">
							<select name="cj" class="form-control selectpicker" data-live-search="true">
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
							<input  class="form-control" type="text" value="" name="nilai" onkeypress="return hanyaAngka(event)" required>
						</div>
					</div>

																					
					<div style="float:right;">
						<button type="reset"  class="btn btn-warning"  data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-brand">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--begin::Modal edit--> 
<div class="modal fade modal-edit-detail-umk" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail">Edit Detail Uang Muka Kerja</h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-edit-tambah-umk-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        @foreach($data_umks as $data_umk)
                        <input  class="form-control" hidden type="text" value="{{$data_umk->no_umk}}"  name="no_umk">
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
						<div class="col-3">
							<input  class="form-control" name="acc" type="text" value="" id="acc" >
						</div>
						<div id="div-acc" class="col-3" style="display:none;">
							<select name="acc" id="select-acc" class="form-control selectpicker" data-live-search="true">
									@foreach($data_account as $row)
								<option value="{{$row->kodeacct}}">{{$row->kodeacct}} - {{$row->descacct}}</option>
									@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Kode Bagian</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-3">
							<input  class="form-control" name="bagian" type="text" value="" id="bagian" >
						</div>
						<div id="div-bagian" class="col-3" style="display:none;">
							<select name="bagian" id="select-bagian"  class="form-control selectpicker" data-live-search="true">
									@foreach($data_bagian as $row)
								<option value="{{$row->kode}}" <?php if( '<input value="$row->kode">' == '<input id="bagian">' ) echo 'selected' ; ?>>{{$row->kode}} - {{$row->nama}}</option>
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
						<div class="col-3">
							<input  class="form-control" name="jb" type="text" value="" id="jb" >
						</div>
						<div id="div-jb" class="col-3" style="display:none;">
							<select name="jb" id="select-jb"  class="form-control selectpicker" data-live-search="true">
									@foreach($data_jenisbiaya as $row)
								<option value="{{$row->kode}}" >{{$row->kode}} - {{$row->keterangan}}</option>
									@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">C. Judex</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-3">
							<input  class="form-control" name="cj" type="text" value="" id="cj" >
						</div>
						<div class="col-3" id="div-cj" style="display:none;">
							<select name="cj" id="select-cj" class="form-control selectpicker" data-live-search="true">
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
							<input  class="form-control" type="text" value="" id="nilai" name="nilai" onkeypress="return hanyaAngka(event)">
						</div>
					</div>

																					
					<div style="float:right;">
						<button type="reset"  class="btn btn-warning"  data-dismiss="modal">Cancel</button>
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
			url  : "{{route('uang_muka_kerja.store')}}",
			type : "POST",
			data : $('#form-update-umk').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
			   console.log(data);
				swal({
                    text: "Edit Data Uang Muka Kerja Berhasil.",
                    type: "success"
                }).then(function() {
                    window.location.replace("{{route('uang_muka_kerja.index')}}");;
                });
			}, 
			error : function(){
				alert("Ada kesalahan aplikasi");
			}
		});	
		return false;
    });

	$('#btn-create-detail').on('click', function(e) {
		e.preventDefault();
		$('#title-detail').html("Tambah Detail Uang Muka Kerja");
		$('.modal-create-detail-umk').modal('show');
	});

    //create detail
    $('#form-tambah-umk-detail').submit(function(){
		$.ajax({
			url  : "{{route('uang_muka_kerja.store.detail')}}",
			type : "POST",
			data : $('#form-tambah-umk-detail').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
                swal({
                    text: "Data Detail Uang Muka Kerja Berhasil Ditambahkan.",
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


    //proses update detail
    $('#form-edit-tambah-umk-detail').submit(function(){
		$.ajax({
			url  : "{{route('uang_muka_kerja.store.detail')}}",
			type : "POST",
			data : $('#form-edit-tambah-umk-detail').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
                swal({
                    text: "Data Detail Uang Muka Kerja Berhasil Diedit.",
                    type: "success"
                }).then(function() {
                    window.location.reload();
                });
			}, 
			error : function(){
				alert("Ada kesalahan aplikasi");
			}
		});	
		return false;
	});

//edit bagian
$('#bagian').on('click', function(e) {
	$('#bagian').attr('disabled', true);
	$('#div-bagian').fadeIn();
	$( "#select-bagian" ).prop( "disabled", false );
});

//edit account
$('#acc').on('click', function(e) {
	$('#acc').attr('disabled', true);
	$('#div-acc').fadeIn();
	$( "#select-acc" ).prop( "disabled", false );
});

//edit jenis bayar
$('#jb').on('click', function(e) {
	$('#jb').attr('disabled', true);
	$('#div-jb').fadeIn();
	$( "#select-jb" ).prop( "disabled", false );
});

//edit cj
$('#cj').on('click', function(e) {
	$('#cj').attr('disabled', true);
	$('#div-cj').fadeIn();
	$( "#select-cj" ).prop( "disabled", false );
});

//tampil edit detail
$('#btn-edit-detail').on('click', function(e) {
	e.preventDefault();
var allVals = [];  
$(".btn-radio:checked").each(function() {  
	var dataid = $(this).attr('data-id');
	var datano = $(this).attr('data-no');
	if(dataid == 1)  
	{  
		swal({
				title: "Tandai baris yang akan diedit!",
				type: "success"
				}) ; 
	}  else { 
		$.ajax({
			url :"/umum/uang_muka_kerja/edit_detail/"+dataid+'/'+datano,
			type : 'get',
			dataType:"json",
			headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
			success:function(data)
			{
				$('#no').val(data.no);
				$('#keterangan').val(data.keterangan);
				$('#acc').val(data.account);
				$('#bagian').val(data.bagian);
				$('#pk').val(data.pk);
				$('#jb').val(data.jb);
				$('#cj').val(data.cj);
				var output=parseInt(data.nilai);
				$('#nilai').val(output);
				$('#title-detail').html("Edit Detail Uang Muka Kerja");
				$('.modal-edit-detail-umk').modal('show');
				$( "#select-bagian" ).prop( "disabled", true );
				$( "#select-acc" ).prop( "disabled", true );
				$( "#select-jb" ).prop( "disabled", true );
				$( "#select-cj" ).prop( "disabled", true );
			}
		})
	}
				
});
});



//delete
$('#deleteRow').click(function(e) {
			e.preventDefault();
			if($('input[type=radio]').is(':checked')) { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).val();
					// delete stuff
					swal({
						title: "Data yang akan di hapus?",
						text: "No. Panjar : " + id,
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								url: "{{ route('uang_muka_kerja.delete.detail') }}",
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
										location.replace("{{ route('uang_muka_kerja.edit',['no' => $data_umk->no_umk]) }}");
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
				swal({
					title: "Tandai baris yang akan dihapus!",
					type: "success"
				}) ; 
			}
			
		});

function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>
@endsection