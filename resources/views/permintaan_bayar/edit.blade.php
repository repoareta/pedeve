@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Permintaan Bayar </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Permintaan Bayar </a>
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
					<i class="kt-font-brand flaticon2-plus-1"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Tambah Permintaan Bayar
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
		<div class="card-body table-responsive" >
			<!--begin: Datatable -->
			<form  class="kt-form kt-form--label-right" id="form-update-permintaan-bayar">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Permintaan Bayar
								</h5>	
							</div>
						</div>
                        @foreach($data_bayars as $data_bayar)
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">No. Permintaan</label>
							<div class="col-5">
								<input class="form-control" type="text" name="nobayar" value="{{$data_bayar->no_bayar}}" id="nobayar">
							</div>

							<label for="spd-input" class="col-2 col-form-label">Tanggal</label>
							<div class="col-3">
								<input class="form-control" type="text" name="tanggal" id="tanggal" value="<?php echo date("d/m/Y", strtotime($data_bayar->tgl_bayar)) ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="nopek-input" class="col-2 col-form-label">Terlampir</label>
							<div class="col-10">
								<input class="form-control" type="text" name="lampiran" value="{{$data_bayar->lampiran}}"  id="lampiran"  required>
							</div>
						</div>
						<div class="form-group row">
							<label for="id-pekerja;-input" class="col-2 col-form-label">Keterangan</label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$data_bayar->keterangan}}"  name="keterangan" size="50" maxlength="200" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Dibayar Kepada</label>
							<div class="col-10">
								<input class="form-control" type="text" value="{{$data_bayar->kepada}}" name="dibayar" id="dibayar" size="50" maxlength="200">
							</div>
						</div>
                        @endforeach
                        @foreach($data_bayars as $data_bayar)
						<div class="form-group row">
							<label for="dari-input" class="col-2 col-form-label">Debet Dari</label>
							<div class="col-10">
								<select name="debetdari" id="select-debetdari" class="form-control selectpicker" data-live-search="true">
                                    <option value="">- Pilih Nopek -</option>
									@foreach ($debit_nota as $row)
									<option value="{{ $row->kode }}">{{ $row->kode.' - '.$row->keterangan }}</option>
									@endforeach
									
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">No. Debet</label>
							<div class="col-5">
								<input class="form-control" type="text" name="nodebet" id="nodebet" value="{{$data_bayar->debet_no}}" size="15" maxlength="15" required>
							</div>
							<label class="col-2 col-form-label">Tgl Debet</label>
							<div class="col-3" >
								<input class="form-control" type="text" name="tgldebet" value="<?php echo date("d/m/Y", strtotime($data_bayar->debet_tgl)) ?>" data-date-format="dd/MM/yyyy" id="tgldebet" size="15" maxlength="15" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input"  class="col-2 col-form-label">No. Kas</label>
							<div class="col-5">
								<input  class="form-control" name="nokas" type="text" value="{{$data_bayar->no_kas}}" id="nokas" size="10" maxlength="25">
							</div>
							<label for="spd-input"  class="col-2 col-form-label">Bulan Buku</label>
							<div class="col-3" >
								<input class="form-control" type="text" value="{{$data_bayar->bulan_buku}}" data-date-format="yyyymm" id="bulanbuku" name="bulanbuku" size="6" maxlength="6" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">CI</label>
							<div class="col-5">
								<input class="form-control" type="text" name="ci" value="{{$data_bayar->ci}}" id="ci" size="1" maxlength="1">
							</div>

							<label for="spd-input" class="col-2 col-form-label">Kurs</label>
							<div class="col-3">
								<input class="form-control" type="text" name="kurs" id="kurs" value="{{$data_bayar->rate}}" size="10" maxlength="10">
							</div>
						</div>
						<div class="form-group row">
							<label for="mulai-input" class="col-2 col-form-label">Periode</label>
							<div class="col-10">
								<div class="input-daterange input-group" id="date_range_picker">
									<input type="text" class="form-control" name="mulai" value="<?php echo date("d/m/Y", strtotime($data_bayar->mulai)) ?>" />
									<div class="input-group-append">
										<span class="input-group-text">s/d</span>
									</div>
									<input type="text" class="form-control" name="sampai"  value="<?php echo date("d/m/Y", strtotime($data_bayar->sampai)) ?>"/>
								</div>
							</div>
						</div>
                        @endforeach
						<div class="form-group row">
							<label class="col-2 col-form-label">Total Nilai</label>
							<div class="col-4">
								<input  class="form-control" name="totalnilai" type="text" id="totalnilai" value="Rp. <?php echo number_format($count, 0, ',', '.'); ?>"  readonly>
							</div>
						</div>
						<div style="float:right;">
							<div class="kt-form__actions">
								<a  href="{{route('permintaan_bayar.index')}}" class="btn btn-warning">Cancel</a>
								<button type="submit" class="btn btn-brand">Save</button>
							</div>
						</div>
					</div>
				</div>
			</form>

				

					
				<div class="kt-portlet__head kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon2-line-chart"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Detail Permintaan Bayar
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
				
								<a href="#" id="editRow">
									<span style="font-size: 2em;" class="kt-font-warning">
										<i class="fas fa-edit"></i>
									</span>
								</a>
				
								<a href="#" id="deleteRow">
									<span style="font-size: 2em;" class="kt-font-danger">
										<i class="fas fa-times-circle"></i>
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<table class="table table-striped table-bordered table-hover table-checkable" id="tabel-detail-permintaan">
						<thead class="thead-light">
							<tr>
								<th ><input type="radio" hidden name="btn-radio"  data-id="1" class="btn-radio" checked ></th>
								<th >No.</th>
								<th >Keterangan</th>
								<th >Bagian</th>
								<th >Account</th>
								<th >JB</th>
								<th >PK</th>
								<th >CJ</th>
								<th >Jumlah</th>
							</tr>
						</thead>
						<tbody>
                            <?php $no=0; ?>
                            @foreach($data_bayar_details as $data_bayar_detail)
                            <?php $no++; ?>
                                <tr class="table-info">
                                    <td scope="row" align="center"><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="btn-radio" data-no="{{$data_bayar_detail->no}}"  data-id="{{str_replace('/', '-', $data_bayar_detail->no_bayar)}}" nobayar="{{$data_bayar_detail->no_bayar}}" class="btn-radio" ><span></span></label></td>
                                    <td scope="row" align="center">{{$no}}</td>
                                    <td>{{$data_bayar_detail->keterangan}}</td>
                                    <td align="center">{{$data_bayar_detail->bagian}}</td>
                                    <td align="center">{{$data_bayar_detail->account}}</td>
                                    <td align="center">{{$data_bayar_detail->jb}}</td>
                                    <td align="center">{{$data_bayar_detail->pk}}</td>
                                    <td align="center">{{$data_bayar_detail->cj}}</td>
                                    <td>Rp. <?php echo number_format($data_bayar_detail->nilai, 0, ',', '.'); ?></td>
                                </tr>
                            @endforeach
                        </tbody>
                                <tr>
                                    <td colspan="8" align="right">Jumlah Total : </td>
                                    <td >Rp. <?php echo number_format($count, 0, ',', '.'); ?></td>
                                </tr>
						</tbody>
					</table>
				</div>
			<!--end: Datatable -->
		</div>
	</div>
</div>

<!--begin::Modal-->
<div class="modal fade modal-create-detail-umk" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail">Tambah Menu Rincian Minta Bayar</h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-tambah-bayar-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        @foreach($data_bayars as $data_bayar)
                        <input  class="form-control" hidden type="text" value="{{$data_bayar->no_bayar}}"  name="nobayar">
                        @endforeach
                    <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-2">
							<input  class="form-control" type="text" value="{{$no_bayar_details}}"  name="no" readonly>
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

<!--end::Modal-->
<div class="modal fade modal-edit-detail-bayar" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail">Edit Menu Rincian Minta Bayar</h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-edit-bayar-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        @foreach($data_bayars as $data_bayar)
                        <input  class="form-control" hidden type="text" value="{{$data_bayar->no_bayar}}"  name="nobayar">
                        @endforeach
                    <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-2">
							<input  class="form-control" type="text" value="{{$no_bayar_details}}" id="no" name="no" readonly>
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


@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		$('#tabel-detail-permintaan').DataTable();


// proses update permintaan bayar
		$('#form-update-permintaan-bayar').submit(function(){
        	var no_umk = $("#noumk").val();
			$.ajax({
				url  : "{{route('permintaan_bayar.store')}}",
				type : "POST",
				data : $('#form-update-permintaan-bayar').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
				console.log(data);
					swal({
						title: "Data Berhasil Diedit!",
						text: "Success!",
						type: "success"
					}).then(function() {
						window.location.replace("{{ route('permintaan_bayar.index')}}");;
					});
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});
	

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

 //prosess create detail
 $('#form-tambah-bayar-detail').submit(function(){
		$.ajax({
			url  : "{{route('permintaan_bayar.store.detail')}}",
			type : "POST",
			data : $('#form-tambah-bayar-detail').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
                swal({
                    text: "Data Detail Permintaan Biaya Berhasil Ditambahkan.",
                    type: "success"
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
 $('#form-edit-bayar-detail').submit(function(){
		$.ajax({
			url  : "{{route('permintaan_bayar.store.detail')}}",
			type : "POST",
			data : $('#form-edit-bayar-detail').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
                swal({
                    text: "Data Detail Permintaan Bayar Berhasil Diedit.",
                    type: "success"
                }).then(function() {
                    window.location.reload();
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
$('#editRow').on('click', function(e) {
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
			url :"/umum/permintaan_bayar/editdetail/"+dataid+'/'+datano,
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
				$('.modal-edit-detail-bayar').modal('show');
				$( "#select-bagian" ).prop( "disabled", true );
				$( "#select-acc" ).prop( "disabled", true );
				$( "#select-jb" ).prop( "disabled", true );
				$( "#select-cj" ).prop( "disabled", true );
			}
		})
	}
				
});
});


//delete permintaan bayar detail
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
                    var id = $(this).attr('nobayar');
                    var no = $(this).attr('data-no');
					// delete stuff
					swal({
						title: "Data yang akan di hapus?",
						text: "No. Permintaan : " + id+" Dan No Urut :"+no,
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								url: "{{ route('permintaan_bayar.delete.detail') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"id": id,
									"no": no,
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

// Private functions
var demos = function () {

	// range picker
	$('#date_range_picker').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		templates: arrows,
		// autoclose: true,
		// language : 'id',
		format   : 'yyyy-mm-dd'
	});

	// minimum setup
	$('#tanggal').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'yyyy-mm-dd'
	});
	// minimum setup
	$('#tgldebet').datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: true,
		orientation: "bottom left",
		templates: arrows,
		autoclose: true,
		// language : 'id',
		format   : 'yyyy-mm-dd'
	});
	$('#bulanbuku').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
	$('#bulanbuku').datepicker("setDate", new Date());
};

return {
	// public functions
	init: function() {
		demos(); 
	}
};
}();

KTBootstrapDatepicker.init();

});
        function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection