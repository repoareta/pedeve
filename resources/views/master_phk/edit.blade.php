@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Penyerahan Tabungan </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Kontroler </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Penyerahan Tabungan </a>
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
					Penyerahan Tabungan
				</h3>
			</div>
		</div>
		<!--begin: Datatable -->
		<form  class="kt-form kt-form--label-right" id="form-create">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							<h5 class="kt-portlet__head-title">
								Header Penyerahan Tabungan
							</h5>	
						</div>
					</div>
				
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Bulan/Tahun<span style="color:red;">*</span></label>
						<div class="col-5">
							<select class="form-control" name="bulan" required>
								<option value="1" <?php if($bulan  == 1 ) echo 'selected' ; ?>>Januari</option>
								<option value="2" <?php if($bulan  == 2 ) echo 'selected' ; ?>>Februari</option>
								<option value="3" <?php if($bulan  == 3 ) echo 'selected' ; ?>>Maret</option>
								<option value="4" <?php if($bulan  == 4 ) echo 'selected' ; ?>>April</option>
								<option value="5" <?php if($bulan  == 5 ) echo 'selected' ; ?>>Mei</option>
								<option value="6" <?php if($bulan  == 6 ) echo 'selected' ; ?>>Juni</option>
								<option value="7" <?php if($bulan  == 7 ) echo 'selected' ; ?>>Juli</option>
								<option value="8" <?php if($bulan  == 8 ) echo 'selected' ; ?>>Agustus</option>
								<option value="9" <?php if($bulan  == 9 ) echo 'selected' ; ?>>September</option>
								<option value="10" <?php if($bulan  ==10  ) echo 'selected' ; ?>>Oktober</option>
								<option value="11" <?php if($bulan  == 11 ) echo 'selected' ; ?>>November</option>
								<option value="12" <?php if($bulan  == 12 ) echo 'selected' ; ?>>Desember</option>
							</select>
						</div>
						<div class="col-5" >
							<input class="form-control" type="text" value="{{$tahun}}"   name="tahun" size="4" maxlength="4" onkeypress="return hanyaAngka(event)" autocomplete='off' required>
							<input class="form-control" type="hidden" value="{{Auth::user()->userid}}"  name="userid" autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Jabatan<span style="color:red;">*</span></label>
						<div class="col-10">
							<input  class="form-control" type="text" value="{{$ttd_jabatan}}"  name="ttd_jabatan" required oninvalid="this.setCustomValidity('Jabatan Harus Diisi..')" oninput="setCustomValidity('')" autocomplete='off' onkeyup="this.value = this.value.toUpperCase()">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. Dokumen<span style="color:red;">*</span></label>
						<div class="col-10">
							<input  class="form-control" type="text" value="{{$no_serah}}"  name="no_serah"  required oninvalid="this.setCustomValidity('No. Dokumen Harus Diisi..')" oninput="setCustomValidity('')"  autocomplete='off' onkeyup="this.value = this.value.toUpperCase()">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Tertanda Tangan<span style="color:red;">*</span></label>
						<div class="col-10">
							<input  class="form-control" type="text" value="{{$ttd_oleh}}"  name="ttd_oleh"  required oninvalid="this.setCustomValidity('Tertanda Tangan Harus Diisi..')" oninput="setCustomValidity('')"  autocomplete='off' onkeyup="this.value = this.value.toUpperCase()">
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Jenis PHK<span style="color:red;">*</span></label>
						<div class="col-10">
							<select name="jenis"  class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Jenis PHK Harus Diisi..')" onchange="setCustomValidity('')">
								<option value="">-Pilih-</option>
								<option value="ALAMI" <?php if($jenis  == 'ALAMI' ) echo 'selected' ; ?>>ALAMI</option>
								<option value="MENINGGAL" <?php if($jenis  == 'MENINGGAL' ) echo 'selected' ; ?>>MENINGGAL</option>
								<option value="APS" <?php if($jenis  == 'APS' ) echo 'selected' ; ?>>APS</option>
								<option value="BERMASALAH" <?php if($jenis  == 'BERMASALAH' ) echo 'selected' ; ?>>BERMASALAH</option>
							</select>						
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Keterangan</label>
						<div class="col-10">
							<textarea cols="40" rows="3"  class="form-control" type="text" value=""  name="keterangan"   autocomplete='off' >{{$keterangan}} </textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Tanggal</label>
						<div class="col-10">
							<input class="form-control" type="text" name="tgl_serah" value="{{$tgl_serah}}"  id="tanggal" size="15" maxlength="15" autocomplete='off' required oninvalid="this.setCustomValidity('Tanggal Cetak Harus Diisi..')" onchange="setCustomValidity('')" autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. Urut Awal</label>
						<div class="col-10">
							<input  class="form-control" type="text" value="{{$no_urut_awal}}"  name="no_urut_awal"   autocomplete='off' onkeypress="return hanyaAngka(event)">
						</div>
					</div>
					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<a  href="{{route('master_phk.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
							</div>
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
						Detail Penyerahan Tabungan
					</h3>			
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
			</div>
			<div class="kt-portlet__body">
				<table class="table table-striped table-bordered table-hover table-checkable" id="tabel-detail">
					<thead class="thead-light">
						<tr>
							<th ></th>
							<th>NO.</th>
							<th>PILIH</th>
							<th>PRS</th>
							<th>NOPEK</th>
							<th>NAMA</th>
							<th>BLN TH PHK</th>
							<th>SETORAN</th>
							<th>PENGEMBANGAN</th>
							<th>BUNGA</th>
							<th>PPH 23</th>
							<th>TRANSFER</th>
							<th>PKPP</th>
						</tr>
					</thead>
					<tbody>
					<?php $a=1; ?>
					@foreach($data_detail as $data)
						<tr>
							<td></td>
							<td>{{$a++}}</td>
							<td></td>
							<td>{{$data->kd_prs}}</td>
							<td>{{$data->nopeg}}</td>
							<td>{{$data->nama}}</td>
							<td>{{$data->tmt_phk}}</td>
							<td>{{number_format($data->nilaitab,2,'.',',')}}</td>
							<td>{{number_format($data->nilaihasil,2,'.',',')}}</td>
							<td>{{number_format($data->nilaibunga,2,'.',',')}}</td>
							<td>{{number_format($data->pajak,2,'.',',')}}</td>
							<td>{{number_format($data->pajak+$data->nilaitab+$data->nilaihasil+$data->nilaibunga,2,'.',',')}}</td>
							<td></td>
						</tr>
					@endforeach
						
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>


<!--begin::Modal-->
<div class="modal fade" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail">Tambah Menu Rincian Penyerahan Tabungan</h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-tambah-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
					<input  class="form-control" hidden type="text" value=""  name="kode">
                    <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut</label>
						<div class="col-8">
							<input class="form-control" type="hidden" name="tanggal" value="{{ date('Y-m-d') }}" size="15" maxlength="15">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$nu}}"  name="nourut" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Perusahaan<span style="color:red;">*</span></label>
						<div  class="col-8" >
							<select name="perusahaan" id="perusahaan"  class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Perusahaan Harus Diisi..')" onchange="setCustomValidity('')">
								<option value="">-Pilih-</option>
									@foreach($data_perusahaan as $data_prshn)
								<option value="{{$data_prshn->kode}}">{{$data_prshn->kode}} - {{$data_prshn->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>			
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Unit<span style="color:red;">*</span></label>
						<div  class="col-8" >
							<select name="unitkrm" id="unitkrm"  class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Unit Harus Diisi..')" onchange="setCustomValidity('')">
								<option value="">-Pilih-</option>
									@foreach($data_unit as $data_unt)
								<option value="{{$data_unt->kode}}">{{$data_unt->kode}} - {{$data_unt->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>			
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Nopek<span style="color:red;">*</span></label>
						<div  class="col-8" >
							<select name="nopek" id="pegawai"  class="form-control" data-live-search="true" required oninvalid="this.setCustomValidity('Unit Harus Diisi..')" onchange="setCustomValidity('')">
								<option value="">-Pilih-</option>
							</select>
						</div>
					</div>			

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Bank</label>
						<div class="col-8">
							<input  class="form-control" type="text" value=""  name="bank" autocomplete='off' size="50" maxlength="100">
						</div>
					</div>	

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Rekening</label>
						<div class="col-8">
							<input  class="form-control" type="text" value=""  name="norek" size="25" maxlength="25" autocomplete='off' onkeypress="return hanyaAngka(event)">
						</div>
					</div>	
					
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Atas Nama</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="atasnama" size="30" maxlength="50"  autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Ahli Waris</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="ahliwaris" size="30" maxlength="30"  autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No SK</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="no_sk" size="50" maxlength="100"  autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">SK Dari</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="sk_dari" size="50" maxlength="100"  autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Tgl SK</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="tgl_sk" size="50" maxlength="100"  autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">TMT PHK</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="tmt_phk" size="50" maxlength="100"  autocomplete='off'>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Alamat</label>
						<div class="col-8">
							<textarea  class="form-control" type="text" value="" name="alamat" autocomplete='off'></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Tembusan</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="tembusan" size="50" maxlength="50"  autocomplete='off'>
						</div>
					</div>
																					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								<button type="submit" class="btn btn-brand"><i class="fa fa-reply" aria-hidden="true"></i>Save</button>
							</div>
						</div>
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
		$('#tabel-detail').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
		});
		$('#tanggal').datepicker({
		todayHighlight: true,
		// orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'yyyy-mm-dd'
		});

		$('#form-create').submit(function(){
			var nosurat = $("#no_serah").val();
			$.ajax({
			url  : "{{route('master_phk.store')}}",
			type : "POST",
			data : $('#form-create').serialize(),
			dataType : "JSON",
			headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
			},
				success : function(data){
					if(data == 1){
						Swal.fire({
						type  : 'success',
						title : 'Data Berhasil Ditambah',
						text  : 'Berhasil',
						timer : 2000
						}).then(function(data) {
							window.location.replace("{{ route('master_phk.edit', ['kode' => ":nosurat"] ) }}");
							});
					}else{
						Swal.fire({
							type  : 'info',
							title : 'Kode Unit Sudah Di Gunakan.',
							text  : 'Info',
							timer : 2000
						})
					}
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});

		$("#unitkrm").on("change", function(){
		var unit = $('#unitkrm').val();
		var perusahaan = $('#perusahaan').val();
			$.ajax({
			url : "{{route('master_phk.nopek.json')}}",
			type : "POST",
			dataType: 'json',
			data : {
				unit:unit,
				perusahaan:perusahaan
				},
			headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
			success : function(data){
						var html = '';
						var i;
							html += '<option value="">- Pilih - </option>';
						for(i=0; i<data.length; i++){
							html += '<option value="'+data[i].nopek+'">'+data[i].nama+'  -  '+data[i].perusahaan+'</option>';
						}
						$('#pegawai').html(html);		
			},
			error : function(){
				alert("Ada kesalahan controller!");
			}
			})
		})
		
	});



	function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection
