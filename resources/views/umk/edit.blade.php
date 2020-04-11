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
				<a href="" class="kt-subheader__breadcrumbs-link">
					Uang Muka Kerja </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edit</span>
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
				Menu Uang Muka Kerja
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
						<label for="spd-input" class="col-2 col-form-label">No. UMK<span style="color:red;">*</span></label>
						<div class="col-10">
                            <input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$data_umk->no_umk}}" id="no_umk" name="no_umk" size="25" maxlength="25" readonly>
                        </div>
					</div>
					<div class="form-group row">
						<label for="nopek-input" class="col-2 col-form-label">Tanggal<span style="color:red;">*</span></label>
						<div class="col-10">
                            <input class="form-control" type="text" name="tgl_panjar" id="tgl_panjar" value="<?php echo date("Y-m-d", strtotime($data_umk->tgl_panjar)) ?>" size="15" maxlength="15">
						</div>
					</div>
					<div class="form-group row">
						<label for="jenis-dinas-input" class="col-2 col-form-label">Dibayar Kepada<span style="color:red;">*</span></label>
						<div class="col-10">
								<select name="kepada" id="kepada" class="form-control selectpicker" data-live-search="true" required>
									<option value="">- Pilih -</option>
									@foreach ($vendor as $row)
									<option value="{{ $row->nama }}"  <?php if($row->nama  == $data_umk->kepada ) echo 'selected' ; ?>>{{ $row->nama }}</option>
									@endforeach
								</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-email-input" class="col-2 col-form-label">Jenis Uang Muka<span style="color:red;">*</span></label>
						<div class="col-6">
							<input style=" width: 17px;height: 26px;margin-left:50px;" value="K" <?php if ($data_umk->jenis_um == 'K' )  echo 'checked' ; ?> type="radio" id="jenis_um" name="jenis_um" />  <label style="font-size:12px; margin-left:10px;">Uang Muka Kerja</label>
							<input style=" width: 17px;height: 26px;margin-left:50px;" value="D" <?php if ($data_umk->jenis_um == 'D' )  echo 'checked' ; ?> type="radio"  id="jenis_um" name="jenis_um"/><label style="font-size:12px; margin-left:10px;"> Uang Muka Dinas</label>
						</div>
					</div>
					<div class="form-group row">
						<label for="id-pekerja;-input" class="col-2 col-form-label">Bulan Buku<span style="color:red;">*</span></label>
						<div class="col-5">
                            <input class="form-control" type="text" value="{{$data_umk->bulan_buku}}"   name="bulan_buku" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
						</div>
					</div>
					<div class="form-group row">
						<label for="dari-input" class="col-2 col-form-label">Mata Uang<span style="color:red;">*</span></label>
						<div class="col-10">
							<input id="ci"   style=" width: 17px;height: 26px;margin-left:50px;" value="1" <?php if ($data_umk->ci == '1' )  echo 'checked' ; ?> type="radio"  name="ci" onclick="displayResult(1)"  />  <label style="font-size:12px; margin-left:10px;">IDR</label>
							<input  id="ci" style=" width: 17px;height: 26px;margin-left:50px;" value="2" <?php if ($data_umk->ci == '2' )  echo 'checked' ; ?> type="radio"    name="ci"  onclick="displayResult(2)" /><label style="font-size:12px; margin-left:10px;"> USD</label>
						</div>
					</div>
					<div class="form-group row">
						<label for="tujuan-input" class="col-2 col-form-label">Kurs<span style="color:red;">*</span></label>
						<div class="col-2">
                            <input class="form-control" type="text" value="<?php echo number_format($data_umk->rate, 0, ',', '.'); ?>" name="kurs"  id="kurs" size="10" maxlength="10">
                            <input class="form-control" type="text" hidden value="{{$data_umk->rate}}" name="kurs"  size="10" maxlength="10">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-2 col-form-label">Untuk<span style="color:red;">*</span></label>
						<div class="col-10">
							<textarea  class="form-control" type="text"  name="untuk" id="untuk" size="70" maxlength="200" required oninvalid="this.setCustomValidity('Untuk Harus Diisi..')" oninput="setCustomValidity('')">{{$data_umk->keterangan}}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-2 col-form-label">Jumlah<span style="color:red;">*</span></label>
						<div class="col-5">
                            <input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" value="Rp. <?php echo number_format($count, 0, ',', '.'); ?>"  size="16" maxlength="16" readonly>
							<input  class="form-control" type="text" value="<?php echo number_format($count, 0, '', ''); ?>" name="jumlah" id="jumlah" size="16" maxlength="16" hidden readonly>
						</div>
					</div>
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<a  href="{{route('uang_muka_kerja.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
							</div>
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
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions">
								<a href="#" id="btn-create-detail" data-target="#kt_modal_4">
									<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
										<i class="fas fa-plus-circle"></i>
									</span>
								</a>
				
								<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
									<i class="fas fa-edit" id="btn-edit-detail"></i>
								</span>
				
								<span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
									<i class="fas fa-times-circle" id="deleteRow"></i>
								</span>
							</div>
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
							<td scope="row" align="center"><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="btn-radio" data-no="{{$data_umk_detail->no}}"  data-id="{{str_replace('/', '-', $data_umk_detail->no_umk)}}" noumk="{{$data_umk_detail->no_umk}}" class="btn-radio" ><span></span></label></td>
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
                    <div class="form-group row ">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-2">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$no_umk_details}}"  name="no" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Keterangan<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<textarea  class="form-control" type="text" value=""  name="keterangan" required oninvalid="this.setCustomValidity('Keterangan Harus Diisi..')" oninput="setCustomValidity('')"></textarea>
						</div>
					</div>
									
																					
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Account</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div  class="col-8" >
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
						<div  class="col-8">
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
						<div class="col-8">
							<input  class="form-control" type="text" value="000"  name="pk" size="6" maxlength="6">
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jenis Biaya</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div  class="col-8">
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
						<div class="col-8">
							<select name="cj" class="form-control selectpicker" data-live-search="true">
								<option value="">-Pilih-</option>
									@foreach($data_cj as $row)
								<option value="{{$row->kode}}">{{$row->kode}} - {{$row->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>
									

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jumlah<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="nilai" onkeypress="return hanyaAngka(event)" required oninvalid="this.setCustomValidity('Jumlah Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off'>
						</div>
					</div>

																					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
							</div>
						</div>
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
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$no_umk_details}}" id="no" name="no" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Keterangan</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<textarea  class="form-control" type="text" value="" id="keterangan" name="keterangan"></textarea>
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
							<input  class="form-control" type="text" value="" id="nilai" name="nilai" onkeypress="return hanyaAngka(event)" autocomplete='off'>
						</div>
					</div>

																					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
							</div>
						</div>
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
			   Swal.fire({
					type  : 'success',
					title : 'Data Berhasil Disimpan',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
                    window.location.replace("{{route('uang_muka_kerja.index')}}");;
                });
			}, 
			error : function(){
				alert("Terjadi kesalahan, coba lagi nanti");
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
                Swal.fire({
					type  : 'success',
					title : 'Data Detail UMK Berhasil Ditambah',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
					location.reload();
				});
			}, 
			error : function(){
				alert("Terjadi kesalahan, coba lagi nanti");
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
                Swal.fire({
					type  : 'success',
					title : 'Data Detail UMK Berhasil Diubah',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
					location.reload();
				});
			}, 
			error : function(){
				alert("Terjadi kesalahan, coba lagi nanti");
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
		swalAlertInit('ubah');  
	}  else { 
		$.ajax({
			url :"{{url('umum/uang_muka_kerja/edit_detail')}}"+ '/' +dataid+'/'+datano,
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
			$(".btn-radio:checked").each(function() {  
			var dataid = $(this).attr('data-id');
				if(dataid == 1)  
				{  
					swalAlertInit('hapus'); 
				}  else { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).attr('noumk');
                    var no = $(this).attr('data-no');
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
							text: "No. UMK : " + id+"dan NO urut :"+no,
							type: 'warning',
							showCancelButton: true,
							reverseButtons: true,
							confirmButtonText: 'Ya, hapus',
							cancelButtonText: 'Batalkan'
						})
						.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('uang_muka_kerja.delete.detail') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"id": id,
									"no": no,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : 'Hapus Data Detail UMK',
										text  : 'Berhasil',
										timer : 2000
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

// Class definition
var KTBootstrapDatepicker = function () {

var arrows;
if (KTUtil.isRTL()) {
	arrows = {
		leftArrow: '<i class="la la-angle-right"></i>',
		rightArrow: '<i class="la la-angle-left"></i>'
	}
} else {
	arrows = {
		leftArrow: '<i class="la la-angle-left"></i>',
		rightArrow: '<i class="la la-angle-right"></i>'
	}
}
// Private functions
var demos = function () {

// minimum setup
$('#tgl_panjar').datepicker({
	rtl: KTUtil.isRTL(),
	todayHighlight: true,
	orientation: "bottom left",
	templates: arrows,
	autoclose: true,
	// language : 'id',
	format   : 'yyyy-mm-dd'
});
// minimum setup
$('#bulan_buku').datepicker({
	rtl: KTUtil.isRTL(),
	todayHighlight: true,
	orientation: "bottom left",
	templates: arrows,
	autoclose: true,
	// language : 'id',
	format   : 'yyyymm'
});
};

return {
// public functions
init: function() {
	demos(); 
}
};
}();

KTBootstrapDatepicker.init();
function displayResult(ci){ 
			if(ci == 1)
			{
				$('#kurs').val(1);
				$('#simbol-kurs').hide();
				$( "#kurs" ).prop( "required", false );

			}else{
				$('#kurs').val("");
				$('#simbol-kurs').show();
				$( "#kurs" ).prop( "required", true );
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